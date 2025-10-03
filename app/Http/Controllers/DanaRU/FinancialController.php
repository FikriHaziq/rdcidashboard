<?php

namespace App\Http\Controllers\DanaRU;

use App\Http\Controllers\Controller;
use App\Models\DanaRU\DruDistributionPlan;
use App\Models\DanaRU\DruDistributionPlanForm;
use App\Models\DanaRU\DruExpensesRecord;
use App\Models\DanaRU\DruDataAttachment;
use App\Models\TemporaryFile;
use App\Models\MasterList\MasterlistDruAllocation;
use App\Models\MasterList\MasterlistDruExpenses;
use App\Models\MasterList\MasterlistDruYear;
use App\Models\DanaRU\DruMainFund;
use App\Models\DanaRU\DruMailTemplate;
use App\Models\ApprovalApp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Http\Request;
use App\Traits\MailTrait;
use App\Http\Traits\GraphDanaRUTrait;
use PhpOffice\PhpPresentation\PhpPresentation;
use PhpOffice\PhpPresentation\IOFactory;
use PhpOffice\PhpPresentation\Style\Alignment;
use PhpOffice\PhpPresentation\Style\Color;
use PhpOffice\PhpPresentation\Style\Fill;
use PhpOffice\PhpPresentation\Style\Font;
use PhpOffice\PhpPresentation\Style\Border;
use Illuminate\Support\Facades\File;

class FinancialController extends Controller
{
    use MailTrait, GraphDanaRUTrait;

    public function pengesahanAgihanIndex($year = null)
    {
        if(!$year){
            $plan = DruDistributionPlan::orderBy('year', 'desc')->first();
            $year = $plan->year ?? date('Y');
        }
        $plans = getDruPlanList($year)->where('status', 6);
        $plan_form_raw = null;
        $plan_forms = null;
        $plan_forms_count = null;
        foreach ($plans as $key => $plan) {
            $plan_form = getDistributionFormPlans($year, $plan->id);
            if(!$plan_form_raw)$plan_form_raw = $plan_form;
            else $plan_form_raw = $plan_form_raw->concat($plan_form);
        }
        $plan_forms = $plan_form_raw;
        if($plan_forms){
            $plan_forms_count = $plan_forms->where('plan_form_approved', 'N')->count();
        }
        if(!$plan_forms) {
            session()->flash('info', "Tiada cadangan agihan yang telah lulus pada tahun ini.");
            return back();
        }
        $mail_template = DruMailTemplate::where('year', $year)->first();
        // dd($mail_template);
        return view('dana-ru.kewangan.pengesahan-agihan', compact('year', 'plans', 'plan_forms', 'plan_forms_count', 'mail_template'));
    }

    public function pengesahanAgihanShow($plan_id)
    {
        DB::statement("SET SQL_MODE=''");
        $plan_form = DruDistributionPlanForm::from('dru_distribution_plan_forms as plan_form')
            ->select([
                'plan.year as plan_year', 'plan_form.id as plan_form_id', 'plan_form.reference_no as plan_form_ref_no', 'plan_form.approved as plan_form_approved', 'plan_form.updated_at as plan_form_updated_at', 'plan_form.pic_declaration_date as plan_form_declaration_date',
                'mrun.description_1 as mrun_desc', 'bpki.parameter_name as bpki_code',
                'pic.name as pic_name', 'member.name as member_name',
                'ptj.description_1 as ptj','ptj.original_code as ptj_code',
                DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(main_kpi_template.title,": RM", FORMAT(main_kpi.amount, 2), " x ", main_kpi.count, " = RM", FORMAT(main_kpi.total, 2))) ORDER BY main_kpi.id ASC SEPARATOR "<br>") as main_kpi_details'),
                DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(kpi_template.title,": RM", FORMAT(kpi.amount, 2), " x ", kpi.count, " = RM", FORMAT(kpi.total, 2))) ORDER BY kpi.id ASC SEPARATOR "<br>") as kpi_details'),
                'ddf.status as ddf_status','ddf.code as ddf_code','ddf.title as ddf_title','ddf.code_2 as ddf_code_2','plan_form.notes','plan_form.amount as plan_form_amount',
            ])
            ->join('dru_distribution_plans as plan', function ($join) {
                $join->on('plan.id', '=', 'plan_form.distribution_plan_id');
            })
            ->join('parameters as mrun', function ($join) {
                $join->on('mrun.id', '=', 'plan_form.mrun')
                    ->where('mrun.active','Y');
            })
            ->join('parameters as bpki', function ($join) {
                $join->on('bpki.id', '=', 'plan_form.bpki')
                    ->where('bpki.active','Y');
            })
            ->join('parameters as ptj', function ($join) {
                $join->on('ptj.id', '=', 'plan_form.ptj_id')
                    ->where('ptj.active','Y');
            })
            ->join('dru_members as pic', function ($join) {
                $join->on('pic.distribution_plan_form_id', '=', 'plan_form.id')->where('pic.type','leader');
            })
            ->leftjoin('dru_members as member', function ($join) {
                $join->on('member.distribution_plan_form_id', '=', 'plan_form.id')->where('member.type','member');
            })
            ->leftjoin('dru_kpis as main_kpi', function ($join) {
                $join->on('main_kpi.distribution_plan_form_id', '=', 'plan_form.id')
                ->where('main_kpi.type','main')->where('main_kpi.status','active');
            })
            ->leftjoin('dru_kpi_templates as main_kpi_template', function ($join) {
                $join->on('main_kpi_template.id', '=', 'main_kpi.kpi_template_id')
                ->where('main_kpi_template.active','Y');
            })
            ->leftjoin('dru_kpis as kpi', function ($join) {
                $join->on('kpi.distribution_plan_form_id', '=', 'plan_form.id')
                ->where('kpi.type','kpi')->where('kpi.status','active');
            })
            ->leftjoin('dru_kpi_templates as kpi_template', function ($join) {
                $join->on('kpi_template.id', '=', 'kpi.kpi_template_id')
                ->where('kpi_template.active','Y');
            })
            ->join('dru_dist_funds as ddf','ddf.id', '=', 'plan_form.project_id')
            ->groupBy('plan_form.id')->where('plan_form.id', $plan_id)->first();
        // dd($plan_form);
        return view('dana-ru.kewangan.pengesahan-agihan-show', compact('plan_form'));
    }

    public function pengesahanAgihanPost(Request $request)
    {
        $fill_count = 0;
        // dd($request->all());
        foreach ($request->plan_form_id as $key => $id) {
            if($request->ref_no[$key]){
                $plan_form = DruDistributionPlanForm::whereId($id)->whereApproved('N')->first();
                if($plan_form)
                {
                    $plan_form->reference_no = $request->ref_no[$key];
                    if($request->type == 'approve')$plan_form->approved = 'Y';
                    $plan_form->save();
                    $fill_count++;
                }
            }
        }
        if($fill_count > 0){
            if($request->type == 'update')session()->flash('success', "No. Rujukan UTMFIN telah berjaya dikemaskini.");
            else if($request->type == 'approve')session()->flash('success', "Semua borang telah berjaya disahkan.");
        }
        else session()->flash('info', "Sila isi No. Rujukan UTMFIN.");
        return back();
        
    }

    public function pengesahanAgihanSingleApprove($plan_id)
    {
        $plan_form = DruDistributionPlanForm::find($plan_id);
        $this->sendingMail($plan_form->id);
        $plan_form->approved = 'Y';
        $plan_form->save();
        session()->flash('success', "Borang ini telah berjaya disahkan.");
        return back();
    }

    public function overall()
    {
        DB::statement("SET SQL_MODE=''");
        $year_options = MasterlistDruAllocation::select('year')->orderBy('year', 'desc')->distinct()->get();
        $program_options = MasterlistDruAllocation::select('program')->orderBy('program')->distinct()->get();
        $bpki_options = MasterlistDruAllocation::select('bpki')->orderBy('bpki')->distinct()->get();
        $years = [];
        $allocations = [];
        $pelarasan = [];
        $pie1_value = [];
        $bar2_title = [];
        $bar2_expenses = [];
        $bar2_allocations = [];
        $pie2_value = [];
        $bar3_title = [];
        $bar3_expenses = [];
        $bar3_allocations = [];
        $pie3_value = [];
        foreach ($year_options as $key => $options) {
            $amount = MasterlistDruAllocation::select(['amount'])->where('year',$options->year)->sum('amount');
            $kpt = (float)$amount;
            $value_pelarasan = $kpt;
            array_push($years, $options->year);
            array_push($allocations, $kpt);
            array_push($pelarasan, $value_pelarasan);
            array_push($pie1_value, $kpt + $value_pelarasan);
        }
        foreach ($program_options as $key => $options) {
            $amount = MasterlistDruAllocation::select(['amount'])->where('program',$options->program)->sum('amount');
            $bar2_value1 = (float)$amount;
            $bar2_value2 = (float)$amount;
            array_push($bar2_title, $options->program);
            array_push($bar2_expenses, $bar2_value1);
            array_push($bar2_allocations, $bar2_value2);
            array_push($pie2_value, $bar2_value1 + $bar2_value2);
        }
        foreach ($bpki_options as $key => $options) {
            $amount = MasterlistDruAllocation::select(['amount'])->where('bpki',$options->bpki)->sum('amount');
            $bar3_value1 = (float)$amount;
            $bar3_value2 = (float)$amount;
            array_push($bar3_title, $options->bpki);
            array_push($bar3_expenses, $bar3_value1);
            array_push($bar3_allocations, $bar3_value2);
            array_push($pie3_value, $bar3_value1 + $bar3_value2);
        }
        $total_allocation = MasterlistDruAllocation::select(['amount'])->sum('amount');
        $chart_data = [
            "total_allocation"=>(float)$total_allocation,
            "bar1_title"=>$years,
            "bar1_kpt"=>$allocations,
            "bar1_pelarasan"=>$pelarasan,
            "pie1_value"=>$pie1_value,
            "bar2_title"=>$bar2_title,
            "bar2_expenses"=>$bar2_expenses,
            "bar2_allocations"=>$bar2_allocations,
            "pie2_value"=>$pie2_value,
            "bar3_title"=>$bar3_title,
            "bar3_expenses"=>$bar3_expenses,
            "bar3_allocations"=>$bar3_allocations,
            "pie3_value"=>$pie3_value,
        ];
        // dd($chart_data);
        // foreach ($title_options as $key => $options) {
        //     $amount = MasterlistDruAllocation::select(['amount'])->where('tabung_induk',$options->tabung_induk)->sum('amount');
        //     array_push($allocations, [
        //         'bpki'=> $options->bpki,
        //         'program'=> $options->program,
        //         'tabung_induk'=> $options->tabung_induk,
        //         'jenis_agihan'=> $options->jenis_agihan,
        //         'amount'=> $amount,
        //     ]);
        // }
        // usort($allocations, function($a, $b) {return $a['amount'] < $b['amount'];});
        // $allocation_bar1_title = [];
        // $allocation_bar1_allocation = [];
        // $allocation_bar1_expenses = [];
        // foreach ($allocations as $key => $allocation) {
        //     if($key < 10){
        //         array_push($allocation_bar1_title, $allocation['jenis_agihan']);
        //         array_push($allocation_bar1_allocation, (float)$allocation['amount']);
        //         array_push($allocation_bar1_expenses, (float)$allocation['amount']);
        //     }
        // }
        // $total_expenses = 0;
        // $chart_data = [
        //     "total_allocation"=>(float)$total_allocation,
        //     "total_expenses"=>(float)$total_expenses,
        //     "bar1_title"=>$allocation_bar1_title,
        //     "bar1_allocation"=>$allocation_bar1_allocation,
        //     "bar1_expenses"=>$allocation_bar1_expenses,
        // ];
        return view('dana-ru.kewangan.overall', compact('chart_data'));
    }

    public function agihanProgramIndex(Request $request, $category = null)
    {
        DB::statement("SET SQL_MODE=''");
        $faculty_code = null;
        if(user()->role != 'super_admin' && user()->faculty_code){
            $faculty_code = getFacultyByCode(user()->faculty_code);
        }
        $chart_data = [];
        $search_params = (object)[
            "title" => $request->title,
            "start_year" => $request->start_year,
            "end_year" => $request->end_year,
            "faculty_code" => $faculty_code->original_code ?? null
        ];
        $title_options = DB::table('masterlist_dru_allocations as mda')
        ->select(['dmf.code', 'dmf.name as jenis_agihan'])
        ->join('dru_main_funds AS dmf', function ($join){
            $join->on('dmf.code', '=', 'mda.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
        })
        ->leftJoin('parameters AS p', function ($join){
            $join->on('p.id', '=', 'mda.program_id');
        })
        ->leftJoin('parameters AS b', function ($join){
            $join->on('b.id', '=', 'mda.bpki_id');
        })
        ->whereNotNull('p.id')->groupBy('dmf.code')->get();
        $categories = [
            (object)["value" => null, "name" => "Jumlah Peruntukan Keseluruhan"],
            (object)["value" => 1, "name" => "Jumlah Peruntukan Mengikut BPKI and Jenis Program"],
            (object)["value" => 2, "name" => "Jumlah Peruntukan Mengikut PTJ"],
            (object)["value" => 3, "name" => "Jumlah Peruntukan Mengikut Program"],
            (object)["value" => 4, "name" => "Jumlah Perbelanjaan Mengikut SODO"],
        ];
        $year_options = MasterlistDruAllocation::select('year')->orderBy('year', 'desc')->distinct()->get();
        
        $total_allocation = DB::table('masterlist_dru_allocations as mda')
            ->select(['mda.amount'])
            ->join('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', 'mda.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
            });
        $total_expenses = DB::table('masterlist_dru_expenses as mde')
            ->select(['mde.amount'])
            ->join('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', 'mde.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
            });
        if($search_params->title) {
            $total_allocation = $total_allocation->where('dmf.code', $search_params->title);
            $total_expenses = $total_expenses->where('dmf.code', $search_params->title);
        }
        if($search_params->start_year) {
            $total_allocation = $total_allocation->where('mda.year', '>=', $search_params->start_year);
            $total_expenses = $total_expenses->where('mde.year', '>=', $search_params->start_year);
        }
        if($search_params->end_year) {
            $total_allocation = $total_allocation->where('mda.year', '<=', $search_params->end_year);
            $total_expenses = $total_expenses->where('mde.year', '<=', $search_params->end_year);
        }
        if($search_params->faculty_code) {
            $total_allocation = $total_allocation->where('mda.ptj_code', $search_params->faculty_code);
            $total_expenses = $total_expenses->where('mde.ptj', $search_params->faculty_code);
        }
        $total_allocation = $total_allocation->sum('amount');
        $total_expenses = $total_expenses->sum('amount');
        $chart_data["total_allocation"] = (float)$total_allocation;
        $chart_data["total_expenses"] = (float)$total_expenses;
        $chart_data["total_balance"] = (float)$total_allocation-(float)$total_expenses;
        $chart_data["total_expenses_percent"] = (float)$total_allocation > 0?(float)$total_expenses/(float)$total_allocation*100:0;
        
        if ($category == 1) $chart_data = array_merge($chart_data, $this->bpkiProgram($total_allocation, $search_params));
        else if ($category == 2) $chart_data = array_merge($chart_data, $this->ptj($total_allocation, $search_params));
        else if ($category == 3) $chart_data = array_merge($chart_data, $this->project($search_params));
        else if ($category == 4) $chart_data = array_merge($chart_data, $this->sodo($search_params));
        else $chart_data = array_merge($chart_data, $this->tncpiOverall($search_params));
        // dd($chart_data);
        return view('dana-ru.kewangan.agihan-dashboard', compact('title_options', 'search_params', 'category', 'categories', 'year_options','chart_data'));
    }

    public function program($year = null)
    {
        if(!$year){
            $plan = DruDistributionPlan::whereStatus(6)->orderBy('year', 'desc')->first();
            $year = $plan->year ?? date('Y');
        }
        $plans = getDruPlanList($year)->where('status', 6)->whereIn('type', [1,2,3]);
        $plan_form_raw = null;
        $agihan_lists = [];
        $agihan_semula_lists = [];
        foreach ($plans as $key => $plan) {
            $plan_form = getDistributionFormPlans($year, $plan->id, $plan->type);
            if(count($plan_form) > 0) $plan_form = $plan_form->where('plan_form_declaration_date','!=', NULL);
            if(count($plan_form) > 0){
                if(in_array($plan->type, [1,2])){
                    $agihan_lists[] = (object)[
                        "plan_id" => $plan->id,
                        "plan_date" => $plan->created_at,
                        "plan_forms" => $plan_form
                    ];
                }
                else if($plan->type == 3){
                    $agihan_semula_lists[] = (object)[
                        "plan_id" => $plan->id,
                        "plan_date" => $plan->created_at,
                        "plan_forms" => $plan_form
                    ];
                }
            }
        }
        // if($plan_forms) $plan_forms = $plan_forms->where('plan_form_declaration_date','!=', NULL);
        // dd($agihan_lists[0]->plan_forms);
        return view('dana-ru.kewangan.perbelanjaan.program', compact('year', 'agihan_lists', 'agihan_semula_lists'));
    }

    public function programShow($id, $tab = null)
    {
        $plan_form = DruDistributionPlanForm::find($id);
        $plan = $plan_form->distribution_plan;
        $year = $plan->year;
        $edit = false;
        return view('dana-ru.kewangan.perbelanjaan.program-show', compact('year', 'plan_form', 'plan', 'tab', 'edit'));
    }

    public function programVerificationPost(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ],
        [
            'status.required' => 'Sila pilih status.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('dana-ru.kewangan.perbelanjaan.program.show', ['id'=>$id, 'tab'=>'verification'])
                ->withErrors($validator)
                ->withInput();
        }

        $order = ApprovalApp::whereAppId($id)->whereModuleId(2)->orderBy('index', 'desc')->first()->index ?? 0;
        $order++;
        $status = $request->status;
        $plan_form = DruDistributionPlanForm::find($id);
        if($plan_form){
            $approvalApp = new ApprovalApp;
            $approvalApp->index = $order;
            $approvalApp->module_id = 2;
            $approvalApp->app_id = $id;
            $approvalApp->c_id = user()->id;
            $approvalApp->status = $status;
            $approvalApp->comment = $request->comment ?? null;
            $approvalApp->save();
            $plan_form->pic_submission_status = $status;
            $plan_form->save();
            
            if($request->file_upload){
                $data = new DruDataAttachment;
                $data->table = 'approval_app';
                $data->parent_id = $approvalApp->id;
                $file = collect(json_decode($request->file_upload));
                $data->filename = $file['filename'];
                $temporaryFile = TemporaryFile::where('folder', $file['folder'])->first();

                if($temporaryFile){
                    $data->addMedia(storage_path('app/data/tmp/'.$file['folder'].'/'.$temporaryFile->filename))->toMediaCollection('druDataAttachment');
                    $temporaryFile->delete();
                    $data->save();
                    Storage::deleteDirectory('data/tmp/'.$file['folder']);
                }
            }
            if(in_array($request->status, [10, 12])){
                foreach ($plan_form->pic_kpi as $key => $kpi) {
                    DruExpensesRecord::create([
                        "distribution_plan_form_id" => $kpi->distribution_plan_form_id,
                        "kpi_template_id" => $kpi->kpi_template_id,
                        "count" => $kpi->count,
                        "amount" => $kpi->amount,
                        "commitment" => $plan_form->commitment,
                        "pic_justification" => $plan_form->pic_justification,
                        "total" => $kpi->total,
                        "cid" => $kpi->cid,
                    ]);
                }
            }
        }
        else{
            session()->flash('error', "Something went wrong");
            // return back();
        }
        session()->flash('success', "Borang telah berjaya disahkan.");
        return redirect()->route('dana-ru.kewangan.perbelanjaan.program', ['year'=>$request->year]);
    }

    public function subProject($year = null)
    {
        if(!$year)$year = date('Y');
        return view('dana-ru.kewangan.perbelanjaan.subproject', compact('year'));
    }

    public function laporanPerbelanjaan($plan_id, $penggal)
    {
        $plan = DruDistributionPlan::find($plan_id);
        $year = $plan->year;
        $expenses_data = getExpensesReportInfo($plan, $penggal);
        $total_allocation = $plan->amount;
        // $bpki = $this->bpkiProgram($total_allocation, (object)["title"=> null,"start_year" => null,"end_year" => null]);
        $td = 0; // 46
        $rp = 0; // 47
        $wc = 0; // 48
        $bgc = 0; // 49
        $do = 0; // 50
        $gp = 0; // 51
        $pp = 0; // 52

        $td_expenses = 0; // 46
        $rp_expenses = 0; // 47
        $wc_expenses = 0; // 48
        $bgc_expenses = 0; // 49
        $do_expenses = 0; // 50
        $gp_expenses = 0; // 51
        $pp_expenses = 0; // 52

        $td_commitment = 0; // 46
        $rp_commitment = 0; // 47
        $wc_commitment = 0; // 48
        $bgc_commitment = 0; // 49
        $do_commitment = 0; // 50
        $gp_commitment = 0; // 51
        $pp_commitment = 0; // 52

        $td_array = array_values(array_filter($expenses_data, function ($item) {return $item['mrun'] === "TALENT DEVELOPMENT";}));
        $rp_array = array_values(array_filter($expenses_data, function ($item) {return $item['mrun'] === "RESEARCH PROMINENCE";}));
        $wc_array = array_values(array_filter($expenses_data, function ($item) {return $item['mrun'] === "WEALTH CREATION";}));
        $bgc_array = array_values(array_filter($expenses_data, function ($item) {return $item['mrun'] === "BRIDGING IN THE CHALLENGES";}));
        foreach (($td_array[0]['programs'] ?? []) as $key => $program) {
            $td += $program['allocation'];
            $td_expenses += $program['total_expenses'];
            $td_commitment += $program['commitment'];
            if($program['bpki'] == 50) {
                $do += $program['allocation'];
                $do_expenses += $program['total_expenses'];
                $do_commitment += $program['commitment'];
            }
            else if($program['bpki'] == 51) {
                $gp += $program['allocation'];
                $gp_expenses += $program['total_expenses'];
                $gp_commitment += $program['commitment'];
            }
            else if($program['bpki'] == 52) {
                $pp += $program['allocation'];
                $pp_expenses += $program['total_expenses'];
                $pp_commitment += $program['commitment'];
            }
        }
        foreach (($rp_array[0]['programs'] ?? []) as $key => $program) {
            $rp += $program['allocation'];
            $rp_expenses += $program['total_expenses'];
            $rp_commitment += $program['commitment'];
            if($program['bpki'] == 50) {
                $do += $program['allocation'];
                $do_expenses += $program['total_expenses'];
                $do_commitment += $program['commitment'];
            }
            else if($program['bpki'] == 51) {
                $gp += $program['allocation'];
                $gp_expenses += $program['total_expenses'];
                $gp_commitment += $program['commitment'];
            }
            else if($program['bpki'] == 52) {
                $pp += $program['allocation'];
                $pp_expenses += $program['total_expenses'];
                $pp_commitment += $program['commitment'];
            }
        }
        foreach (($wc_array[0]['programs'] ?? []) as $key => $program) {
            $wc += $program['allocation'];
            $wc_expenses += $program['total_expenses'];
            $wc_commitment += $program['commitment'];
            if($program['bpki'] == 50) {
                $do += $program['allocation'];
                $do_expenses += $program['total_expenses'];
                $do_commitment += $program['commitment'];
            }
            else if($program['bpki'] == 51) {
                $gp += $program['allocation'];
                $gp_expenses += $program['total_expenses'];
                $gp_commitment += $program['commitment'];
            }
            else if($program['bpki'] == 52) {
                $pp += $program['allocation'];
                $pp_expenses += $program['total_expenses'];
                $pp_commitment += $program['commitment'];
            }
        }
        foreach (($bgc_array[0]['programs'] ?? []) as $key => $program) {
            $bgc += $program['allocation'];
            $bgc_expenses += $program['total_expenses'];
            $bgc_commitment += $program['commitment'];
            if($program['bpki'] == 50) {
                $do += $program['allocation'];
                $do_expenses += $program['total_expenses'];
                $do_commitment += $program['commitment'];
            }
            else if($program['bpki'] == 51) {
                $gp += $program['allocation'];
                $gp_expenses += $program['total_expenses'];
                $gp_commitment += $program['commitment'];
            }
            else if($program['bpki'] == 52) {
                $pp += $program['allocation'];
                $pp_expenses += $program['total_expenses'];
                $pp_commitment += $program['commitment'];
            }
        }
        
        // dd($bpki);
        $penggal_month = $penggal == 1 ? "JAN - JUN" : "JUL - DEC";
        $report_data = [
            "program" => [
                "TD" => ["amount"=>$td, "expenses"=>$td_expenses, "commitment"=>$td_commitment, "balance"=> $td-$td_expenses-$td_commitment],
                "RP" => ["amount"=>$rp, "expenses"=>$rp_expenses, "commitment"=>$rp_commitment, "balance"=> $rp-$rp_expenses-$rp_commitment],
                "WC" => ["amount"=>$wc, "expenses"=>$wc_expenses, "commitment"=>$wc_commitment, "balance"=> $wc-$wc_expenses-$wc_commitment],
                "BGC" => ["amount"=>$bgc, "expenses"=>$bgc_expenses, "commitment"=>$bgc_commitment, "balance"=> $bgc-$bgc_expenses-$bgc_commitment],
            ],
            "bpki" => [
                'DO' => ["amount"=>$do, "expenses"=>$do_expenses, "commitment"=>$do_commitment, "balance"=> $do-$do_expenses-$do_commitment],
                'GP' => ["amount"=>$gp, "expenses"=>$gp_expenses, "commitment"=>$gp_commitment, "balance"=> $gp-$gp_expenses-$gp_commitment],
                'PP' => ["amount"=>$pp, "expenses"=>$pp_expenses, "commitment"=>$pp_commitment, "balance"=> $pp-$pp_expenses-$pp_commitment],
            ],
            "total" => [
                'amount' => $do+$gp+$pp,
                'expenses' => $do_expenses+$gp_expenses+$pp_expenses,
                'commitment' => $do_commitment+$gp_commitment+$pp_commitment,
                'balance' => ($do-$do_expenses-$do_commitment)+($gp-$gp_expenses-$gp_commitment)+($pp-$pp_expenses-$pp_commitment),
            ]
        ];
        $presentation = new PhpPresentation();
        // ✅ Create a slide
        
        
        $slide1 = $presentation->getActiveSlide();
        $titleBox = $slide1->createRichTextShape()
            ->setHeight(100)
            ->setWidth(940)
            ->setOffsetX(10)
            ->setOffsetY(10);

        // ✅ Set position
        $titleBox->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $titleBox->getFill()->setFillType(Fill::FILL_SOLID)
        ->setRotation(90)
        ->setStartColor(new Color('FF1A3160'))
        ->setEndColor(new Color('FF1A3160'));

        // ✅ Add text content
        $title = $titleBox->createTextRun('LAPORAN PERBELANJAAN BERKALA DANA UNIVERSITI PENYELIDIKAN BAGI TAHUN '.$year.' (SUMMARY)');
        $title->getFont()
            ->setSize(24)
            ->setColor(new Color('ffff00'))
            ->setName('Arial');

        $descBox = $slide1->createRichTextShape()
            ->setHeight(100)
            ->setWidth(700)
            ->setOffsetX(130)
            ->setOffsetY(130);

        // ✅ Set position
        $descBox->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        
        $descBox->createTextRun('LAPORAN PEMANTAUAN BAGI PENGGAL '.$penggal.'/'.$year.' ('.$penggal_month.')')
            ->getFont()
            ->setSize(14)
            ->setColor(new Color('FF000000'))
            ->setName('Arial');
        $descBox->createBreak();
        $descBox->createTextRun('UNIVERSITI : UNIVERSITI TEKNOLOGI MALAYSIA')
            ->getFont()->setBold(true)
            ->setSize(14)
            ->setColor(new Color('FF000000'))
            ->setName('Arial');
        $descBox->createBreak();
        $descBox->createTextRun('TARIKH LAPORAN : '.strtoupper(date('d M Y')))
            ->getFont()->setBold(true)
            ->setSize(14)
            ->setColor(new Color('FF000000'))
            ->setName('Arial');
        $descBox->createBreak();
        $descBox->createTextRun('TEMPOH LAPORAN : '.$penggal_month.' '.$year)
            ->getFont()->setBold(true)
            ->setSize(14)
            ->setColor(new Color('FF000000'))
            ->setName('Arial');
        $descBox->createBreak();
        $descBox->createTextRun('PEGAWAI BERTANGGUNJAWAB : '.strtoupper(user()->name))
            ->getFont()->setBold(true)
            ->setSize(14)
            ->setColor(new Color('FF000000'))
            ->setName('Arial');

            $titleBox = $slide1->createRichTextShape()
            ->setHeight(100)
            ->setWidth(940)
            ->setOffsetX(10)
            ->setOffsetY(10);

        // ✅ DANA
        $danaBox = $slide1->createRichTextShape()
            ->setHeight(33)
            ->setWidth(940)
            ->setOffsetX(10)
            ->setOffsetY(283);
        $danaBox->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        $danaBox->getFill()->setFillType(Fill::FILL_SOLID)
        ->setRotation(90)
        ->setStartColor(new Color('FF8A8A8A'))
        ->setEndColor(new Color('FF8A8A8A'));

        // ✅ Add text content
        $dana = $danaBox->createTextRun('JUMLAH PERUNTUKAN DANA RU YANG DITERIMA : RM '. number_format($total_allocation, 2, '.', ','));
        $dana->getFont()
            ->setSize(14)
            ->setColor(new Color('ffff00'))
            ->setName('Arial');

        $table = $slide1->createTableShape(5);
        $table->setHeight(200);
        $table->setWidth(940);
        $table->setOffsetX(10);
        $table->setOffsetY(325);

        // ✅ Add header row
        $headerRow = $table->createRow();
        $headerRow->getFill()->setFillType(Fill::FILL_SOLID)
            ->setRotation(90)
            ->setStartColor(new Color('FF8EBCD4'))
            ->setEndColor(new Color('FF8EBCD4'));

        $headerTitles = ['PROGRAM UTAMA', 'KPI PERBELANJAAN (RM)', 'JUMLAH PERBELANJAAN SEBENAR (RM)', 'JUMLAH KOMITMEN (RM)', 'BAKI PERUNTUKAN (RM)'];
        foreach ($headerTitles as $key => $headerTitle) {
            $cell = $headerRow->nextCell();
            $cell->createTextRun($headerTitle)->getFont()->setBold(true)->setSize(12)->setColor(new Color('FF000000'));
            $cell->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $cell->getActiveParagraph()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        }

        // ✅ Add table rows
        $rows = [
            ['TALENT DEVELOPMENT', 'RM' . number_format($report_data["program"]["TD"]["amount"], 2, '.', ','), 'RM' . number_format($report_data["program"]["TD"]["expenses"], 2, '.', ','), 'RM' . number_format($report_data["program"]["TD"]["commitment"], 2, '.', ','), 'RM' . number_format($report_data["program"]["TD"]["balance"], 2, '.', ','),], 
            ['RESEARCH PROMINENCE', 'RM' . number_format($report_data["program"]["RP"]["amount"], 2, '.', ','), 'RM' . number_format($report_data["program"]["RP"]["expenses"], 2, '.', ','), 'RM' . number_format($report_data["program"]["RP"]["commitment"], 2, '.', ','), 'RM' . number_format($report_data["program"]["RP"]["balance"], 2, '.', ','),],
            ['WEALTH CREATION', 'RM' . number_format($report_data["program"]["WC"]["amount"], 2, '.', ','), 'RM' . number_format($report_data["program"]["WC"]["expenses"], 2, '.', ','), 'RM' . number_format($report_data["program"]["WC"]["commitment"], 2, '.', ','), 'RM' . number_format($report_data["program"]["WC"]["balance"], 2, '.', ','),],
            ['BRIDGING IN THE CHALLENGES', 'RM' . number_format($report_data["program"]["BGC"]["amount"], 2, '.', ','), 'RM' . number_format($report_data["program"]["BGC"]["expenses"], 2, '.', ','), 'RM' . number_format($report_data["program"]["BGC"]["commitment"], 2, '.', ','), 'RM' . number_format($report_data["program"]["BGC"]["balance"], 2, '.', ','),],
            ['JUMLAH KESELURUHAN', 'RM' . number_format($report_data["total"]["amount"], 2, '.', ','), 'RM' . number_format($report_data["total"]["expenses"], 2, '.', ','), 'RM' . number_format($report_data["total"]["commitment"], 2, '.', ','), 'RM' . number_format($report_data["total"]["balance"], 2, '.', ','),],
        ];

        foreach ($rows as $key => $rowData) {
            $row = $table->createRow();
            $color = $key % 2 == 0 ? 'FFE7E7E9' : 'FFCBCCD1';
            $row->getFill()->setFillType(Fill::FILL_SOLID)
                ->setStartColor(new Color($color))
                ->setEndColor(new Color($color));

            foreach ($rowData as $child_key => $text) {
                $cell = $row->nextCell();
                if($key == count($rows)-1)$cell->createTextRun($text)->getFont()->setBold(true)->setSize(14);
                else $cell->createTextRun($text)->getFont()->setSize(14);
                $cell->getActiveParagraph()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $cell->getActiveParagraph()->getAlignment()->setMarginLeft(10);
                $cell->getActiveParagraph()->getAlignment()->setMarginRight(10);
                $cell->getActiveParagraph()->getAlignment()->setHorizontal($child_key == 0 ? Alignment::HORIZONTAL_LEFT : Alignment::HORIZONTAL_RIGHT);

            }
        }

        foreach ($expenses_data as $key => $pic_data) {
            $slide_arr = $presentation->createSlide();
            $titleBox = $slide_arr->createRichTextShape()
                ->setHeight(100)
                ->setWidth(940)
                ->setOffsetX(10)
                ->setOffsetY(10);

            // ✅ Set position
            $titleBox->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

            $titleBox->getFill()->setFillType(Fill::FILL_SOLID)
            ->setRotation(90)
            ->setStartColor(new Color('FF1A3160'))
            ->setEndColor(new Color('FF1A3160'));

            // ✅ Add text content
            $title = $titleBox->createTextRun('LAPORAN PERBELANJAAN BERKALA DANA UNIVERSITI PENYELIDIKAN BAGI TAHUN '.$year);
            $title->getFont()
                ->setSize(24)
                ->setColor(new Color('ffff00'))
                ->setName('Arial');

            $descBox = $slide_arr->createRichTextShape()
                ->setHeight(100)
                ->setWidth(700)
                ->setOffsetX(130)
                ->setOffsetY(130);

            // ✅ Set position
            $descBox->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            
            $descBox->createTextRun('LAPORAN PEMANTAUAN BAGI PENGGAL '.$penggal.'/'.$year.' ('.$penggal_month.')')
                ->getFont()
                ->setSize(14)
                ->setColor(new Color('FF000000'))
                ->setName('Arial');
            $descBox->createBreak();
            $descBox->createTextRun('UNIVERSITI : UNIVERSITI TEKNOLOGI MALAYSIA')
                ->getFont()->setBold(true)
                ->setSize(14)
                ->setColor(new Color('FF000000'))
                ->setName('Arial');
            $descBox->createBreak();
            $descBox->createTextRun('TARIKH LAPORAN : '.strtoupper(date('d M Y')))
                ->getFont()->setBold(true)
                ->setSize(14)
                ->setColor(new Color('FF000000'))
                ->setName('Arial');
            $descBox->createBreak();
            $descBox->createTextRun('TEMPOH LAPORAN : '.$penggal_month.' '.$year)
                ->getFont()->setBold(true)
                ->setSize(14)
                ->setColor(new Color('FF000000'))
                ->setName('Arial');
            $descBox->createBreak();
            $descBox->createTextRun('PEGAWAI BERTANGGUNJAWAB : '.strtoupper(user()->name))
                ->getFont()->setBold(true)
                ->setSize(14)
                ->setColor(new Color('FF000000'))
                ->setName('Arial');

                $titleBox = $slide_arr->createRichTextShape()
                ->setHeight(100)
                ->setWidth(940)
                ->setOffsetX(10)
                ->setOffsetY(10);

            $table = $slide_arr->createTableShape(8);
            $table->setHeight(200);
            $table->setWidth(940);
            $table->setOffsetX(10);
            $table->setOffsetY(283);

            // ✅ Add header row
            $headerRow = $table->createRow();
            $headerRow->getFill()->setFillType(Fill::FILL_SOLID)
                ->setRotation(90)
                ->setStartColor(new Color('FF4A452A'))
                ->setEndColor(new Color('FF4A452A'));

            $headerTitles = ['PROGRAM UTAMA', 'PROGRAM/PROJEK', 'KPI PENGGAL'.$penggal.'/'.$year, 'PENCAPAIAN PENGGAL '.$penggal.'/'.$year, 'KPI PERBELANJAAN (RM JUTA)', 'JUMLAH PERBELANJAAN SEBENAR', 'JUMLAH KOMITMEN', 'BAKI PERUNTUKAN'];
            foreach ($headerTitles as $key => $headerTitle) {
                $cell = $headerRow->nextCell();
                $cell->createTextRun($headerTitle)->getFont()->setBold(true)->setSize(8)->setColor(new Color('FFFFFFFF'));
                $cell->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $cell->getActiveParagraph()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
            }

            foreach ($pic_data["programs"] as $keyp => $program) {
                $row = $table->createRow();
                $row->getFill()->setFillType(Fill::FILL_SOLID)
                    ->setStartColor(new Color('FFD8E3BC'))
                    ->setEndColor(new Color('FFD8E3BC'));
                if($keyp == 0){
                    $cell1 = $row->nextCell();
                    $cell1->createTextRun($pic_data['mrun'])->getFont()->setBold(true)->setSize(9);
                    $cell1->getActiveParagraph()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                    $cell1->getActiveParagraph()->getAlignment()->setMarginLeft(4);
                    $cell1->getActiveParagraph()->getAlignment()->setMarginTop(8);
                    $cell1->getActiveParagraph()->getAlignment()->setMarginBottom(8);
                    $cell1->getActiveParagraph()->getAlignment()->setMarginRight(4);
                    $cell1->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }
                else{
                    $cell1 = $row->nextCell();
                    $cell1->setWidth($columnWidths[0]);
                    $cell1->setVisible(false);
                }
                $main_kpi_details = $program['main_kpi_details'] . $program['kpi_details'];
                $cell2 = $row->nextCell();
                $cell2->createTextRun($program['title'])->getFont()->setSize(9);
                $cell2->getActiveParagraph()->getAlignment()->setMarginLeft(4);
                $cell2->getActiveParagraph()->getAlignment()->setMarginTop(8);
                $cell2->getActiveParagraph()->getAlignment()->setMarginBottom(8);
                $cell2->getActiveParagraph()->getAlignment()->setMarginRight(4);
                $cell2->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

                $cell3 = $row->nextCell();
                $cell3->createTextRun(str_replace("<br>", " ", $main_kpi_details))->getFont()->setSize(9);
                $cell3->getActiveParagraph()->getAlignment()->setMarginLeft(4);
                $cell3->getActiveParagraph()->getAlignment()->setMarginTop(8);
                $cell3->getActiveParagraph()->getAlignment()->setMarginBottom(8);
                $cell3->getActiveParagraph()->getAlignment()->setMarginRight(4);
                $cell3->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

                $cell4 = $row->nextCell();
                $cell4->createTextRun(str_replace("<br>", " ", $program['kpi_pic_details']))->getFont()->setSize(9);
                $cell4->getActiveParagraph()->getAlignment()->setMarginLeft(4);
                $cell4->getActiveParagraph()->getAlignment()->setMarginTop(8);
                $cell4->getActiveParagraph()->getAlignment()->setMarginBottom(8);
                $cell4->getActiveParagraph()->getAlignment()->setMarginRight(4);
                $cell4->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

                $cell5 = $row->nextCell();
                $cell5->createTextRun('RM ' . number_format($program['allocation'], 2, '.', ','))->getFont()->setSize(9);
                $cell5->getActiveParagraph()->getAlignment()->setMarginLeft(4);
                $cell5->getActiveParagraph()->getAlignment()->setMarginTop(8);
                $cell5->getActiveParagraph()->getAlignment()->setMarginBottom(8);
                $cell5->getActiveParagraph()->getAlignment()->setMarginRight(4);
                $cell5->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $cell6 = $row->nextCell();
                $cell6->createTextRun('RM ' . number_format($program['total_expenses'], 2, '.', ','))->getFont()->setSize(9);
                $cell6->getActiveParagraph()->getAlignment()->setMarginLeft(4);
                $cell6->getActiveParagraph()->getAlignment()->setMarginTop(8);
                $cell6->getActiveParagraph()->getAlignment()->setMarginBottom(8);
                $cell6->getActiveParagraph()->getAlignment()->setMarginRight(4);
                $cell6->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $cell7 = $row->nextCell();
                $cell7->createTextRun('RM ' . number_format($program['commitment'], 2, '.', ','))->getFont()->setSize(9);
                $cell7->getActiveParagraph()->getAlignment()->setMarginLeft(4);
                $cell7->getActiveParagraph()->getAlignment()->setMarginTop(8);
                $cell7->getActiveParagraph()->getAlignment()->setMarginBottom(8);
                $cell7->getActiveParagraph()->getAlignment()->setMarginRight(4);
                $cell7->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $cell8 = $row->nextCell();
                $cell8->createTextRun('RM ' . number_format($program['balance'], 2, '.', ','))->getFont()->setSize(9);
                $cell8->getActiveParagraph()->getAlignment()->setMarginLeft(4);
                $cell8->getActiveParagraph()->getAlignment()->setMarginTop(8);
                $cell8->getActiveParagraph()->getAlignment()->setMarginBottom(8);
                $cell8->getActiveParagraph()->getAlignment()->setMarginRight(4);
                $cell8->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }
        }

        $slide2 = $presentation->createSlide();
        $titleBox = $slide2->createRichTextShape()
            ->setHeight(100)
            ->setWidth(940)
            ->setOffsetX(10)
            ->setOffsetY(10);

        // ✅ Set position
        $titleBox->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $titleBox->getFill()->setFillType(Fill::FILL_SOLID)
        ->setRotation(90)
        ->setStartColor(new Color('FF1A3160'))
        ->setEndColor(new Color('FF1A3160'));

        // ✅ Add text content
        $title = $titleBox->createTextRun('LAPORAN PERBELANJAAN BERKALA DANA UNIVERSITI PENYELIDIKAN BAGI TAHUN '.$year.' (SUMMARY)');
        $title->getFont()
            ->setSize(24)
            ->setColor(new Color('ffff00'))
            ->setName('Arial');

        $descBox = $slide2->createRichTextShape()
            ->setHeight(100)
            ->setWidth(700)
            ->setOffsetX(130)
            ->setOffsetY(130);

        // ✅ Set position
        $descBox->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        
        $descBox->createTextRun('LAPORAN PEMANTAUAN BAGI PENGGAL '.$penggal.'/'.$year.' ('.$penggal_month.')')
            ->getFont()
            ->setSize(14)
            ->setColor(new Color('FF000000'))
            ->setName('Arial');
        $descBox->createBreak();
        $descBox->createTextRun('UNIVERSITI : UNIVERSITI TEKNOLOGI MALAYSIA')
            ->getFont()->setBold(true)
            ->setSize(14)
            ->setColor(new Color('FF000000'))
            ->setName('Arial');
        $descBox->createBreak();
        $descBox->createTextRun('TARIKH LAPORAN : '.strtoupper(date('d M Y')))
            ->getFont()->setBold(true)
            ->setSize(14)
            ->setColor(new Color('FF000000'))
            ->setName('Arial');
        $descBox->createBreak();
        $descBox->createTextRun('TEMPOH LAPORAN : '.$penggal_month.' '.$year)
            ->getFont()->setBold(true)
            ->setSize(14)
            ->setColor(new Color('FF000000'))
            ->setName('Arial');
        $descBox->createBreak();
        $descBox->createTextRun('PEGAWAI BERTANGGUNJAWAB : '.strtoupper(user()->name))
            ->getFont()->setBold(true)
            ->setSize(14)
            ->setColor(new Color('FF000000'))
            ->setName('Arial');

            $titleBox = $slide2->createRichTextShape()
            ->setHeight(100)
            ->setWidth(940)
            ->setOffsetX(10)
            ->setOffsetY(10);

        // ✅ DANA
        $danaBox = $slide2->createRichTextShape()
            ->setHeight(33)
            ->setWidth(940)
            ->setOffsetX(10)
            ->setOffsetY(283);
        $danaBox->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        $danaBox->getFill()->setFillType(Fill::FILL_SOLID)
        ->setRotation(90)
        ->setStartColor(new Color('FF45CAE8'))
        ->setEndColor(new Color('FF45CAE8'));

        // ✅ Add text content
        $dana = $danaBox->createTextRun('JUMLAH PERUNTUKAN DANA RU YANG DITERIMA : RM '.number_format($total_allocation, 2, '.', ','));
        $dana->getFont()
            ->setSize(14)
            ->setColor(new Color('ffff00'))
            ->setName('Arial');

        $table = $slide2->createTableShape(5);
        $table->setHeight(200);
        $table->setWidth(940);
        $table->setOffsetX(10);
        $table->setOffsetY(325);

        // ✅ Add header row
        $headerRow = $table->createRow();
        $headerRow->getFill()->setFillType(Fill::FILL_SOLID)
            ->setRotation(90)
            ->setStartColor(new Color('FFCEECF5'))
            ->setEndColor(new Color('FFCEECF5'));

        $headerTitles = ['KOMPONEN', 'KPI PERBELANJAAN (RM)', 'JUMLAH PERBELANJAAN SEBENAR (RM)', 'JUMLAH KOMITMEN (RM)', 'BAKI PERUNTUKAN (RM)'];
        foreach ($headerTitles as $key => $headerTitle) {
            $cell = $headerRow->nextCell();
            $cell->createTextRun($headerTitle)->getFont()->setBold(true)->setSize(12)->setColor(new Color('FF000000'));
            $cell->getActiveParagraph()->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $cell->getActiveParagraph()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        }

        // ✅ Add table rows
        $rows = [
            ['PROJEK PENYELIDIKAN (60%)', 'RM' . number_format($report_data["bpki"]["GP"]["amount"], 2, '.', ','), 'RM' . number_format($report_data["bpki"]["GP"]["expenses"], 2, '.', ','), 'RM' . number_format($report_data["bpki"]["GP"]["commitment"], 2, '.', ','), 'RM' . number_format($report_data["bpki"]["GP"]["balance"], 2, '.', ','),], 
            ['OPERASI (20%)', 'RM' . number_format($report_data["bpki"]["DO"]["amount"], 2, '.', ','), 'RM' . number_format($report_data["bpki"]["DO"]["expenses"], 2, '.', ','), 'RM' . number_format($report_data["bpki"]["DO"]["commitment"], 2, '.', ','), 'RM' . number_format($report_data["bpki"]["DO"]["balance"], 2, '.', ','),],
            ['PEMBELIAN & PENYELENGGARAAN ALATAN PENYELIDIKAN (20%)', 'RM' . number_format($report_data["bpki"]["PP"]["amount"], 2, '.', ','), 'RM' . number_format($report_data["bpki"]["PP"]["expenses"], 2, '.', ','), 'RM' . number_format($report_data["bpki"]["PP"]["commitment"], 2, '.', ','), 'RM' . number_format($report_data["bpki"]["PP"]["balance"], 2, '.', ','),],
            ['JUMLAH KESELURUHAN', 'RM' . number_format($report_data["total"]["amount"], 2, '.', ','), 'RM' . number_format($report_data["total"]["expenses"], 2, '.', ','), 'RM' . number_format($report_data["total"]["commitment"], 2, '.', ','), 'RM' . number_format($report_data["total"]["balance"], 2, '.', ','),],
        ];

        foreach ($rows as $key => $rowData) {
            $row = $table->createRow();
            $color = $key % 2 == 0 ? 'FFE8F6FB' : 'FFCEECF5';
            $row->getFill()->setFillType(Fill::FILL_SOLID)
                ->setStartColor(new Color($color))
                ->setEndColor(new Color($color));

            foreach ($rowData as $child_key => $text) {
                $cell = $row->nextCell();
                if($key == count($rows)-1)$cell->createTextRun($text)->getFont()->setBold(true)->setSize(14);
                else $cell->createTextRun($text)->getFont()->setSize(14);
                $cell->getActiveParagraph()->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $cell->getActiveParagraph()->getAlignment()->setMarginLeft(10);
                $cell->getActiveParagraph()->getAlignment()->setMarginRight(10);
                $cell->getActiveParagraph()->getAlignment()->setHorizontal($child_key == 0 ? Alignment::HORIZONTAL_LEFT : Alignment::HORIZONTAL_RIGHT);

            }
        }
    
        // Create a temporary file
        $tempFile = tempnam(sys_get_temp_dir(), 'PHPPresentation');

        // Save the PowerPoint presentation
        $writer = IOFactory::createWriter($presentation, 'PowerPoint2007');
        $writer->save($tempFile);

        // Define filename
        $filename = 'Presentation_' . date('d_m_Y') . '.pptx';

        // Ensure temp directory exists
        File::ensureDirectoryExists(storage_path('/app/data/tmp'));
        File::cleanDirectory(storage_path('/app/data/tmp'));

        // Return the PowerPoint file as a download response
        return response()->download($tempFile, $filename)->deleteFileAfterSend(true);
    }

    public function mailTemplate($year){
        return view('dana-ru.kewangan.mail-template', compact('year'));
    }

    public function mailTemplatePost(Request $request)
    {
        // if($request->status==6){
        //     $plan = DruDistributionPlan::find($request->plan_id);
        //     dd($plan->forms);
        // }
        $request->validate([
            'file_upload' => 'required',
        ],
        [
            'file_upload.required' => 'Sila muat naik template surat.',
        ]);

        $mail_template = DruMailTemplate::where('year', $request->year)->first();
        // dd($mail_template);

        $file = collect(json_decode($request->file_upload));

        if(!$mail_template) $mail_template = new DruMailTemplate; 
        $mail_template->year = $request->year;
        $mail_template->c_id = user()->id;
        $mail_template->filename = $file['filename'];
        $mail_template->save();
        DruDataAttachment::whereTable('mail_template')->whereParentId($mail_template->id)->delete();
        $data = new DruDataAttachment;
        $data->table = 'mail_template';
        $data->parent_id = $mail_template->id;
        if($request->file_upload){
            $data->filename = $file['filename'];
            $file = collect(json_decode($request->file_upload));
            $temporaryFile = TemporaryFile::where('folder', $file['folder'])->first();

            if($temporaryFile){
                $data->addMedia(storage_path('app/data/tmp/'.$file['folder'].'/'.$temporaryFile->filename))->toMediaCollection('druDataAttachment');
                $temporaryFile->delete();
                $data->save();
                Storage::deleteDirectory('data/tmp/'.$file['folder']);
            }
        }
        session()->flash('success', "Template surat telah berjaya dimuatnaik.");
        return redirect()->route('dana-ru.kewangan.pengesahan-agihan.index');
    }

    public function downloadFile($id)
    {
        $file = DruDataAttachment::whereParentId($id)->whereTable('mail_template')->first();
        if($file){
            $mediaItem = $file->getFirstMedia('druDataAttachment');
            $filepath = $mediaItem->getPath();
            $filename = $file->filename;
            return response()->download($filepath, $filename);
        }
        else{
            session()->flash('error', "File not found");
            return back();
        }
    }
}
