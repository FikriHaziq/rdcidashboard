<?php

namespace App\Http\Controllers\DanaRU;

use App\Http\Controllers\Controller;
use App\Models\DanaRU\DruDistributionPlan;
use App\Models\DanaRU\DruDistributionPlanForm;
use App\Models\DanaRU\DruDataAttachment;
use App\Models\TemporaryFile;
use App\Models\MasterList\MasterlistDruAllocation;
use App\Models\MasterList\MasterlistDruExpenses;
use App\Models\MasterList\MasterlistDruYear;
use App\Models\DanaRU\DruMainFund;
use App\Models\ApprovalApp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    public function pengesahanAgihanIndex($year = null)
    {
        if(!$year){
            $plan = DruDistributionPlan::orderBy('year', 'desc')->first();
            $year = $plan->year ?? date('Y');
        }
        $plan = DruDistributionPlan::where('year', $year)->whereStatus(6)->first();
        $plan_forms = getDistributionFormPlans($year)->get();
        $plan_forms_count = DruDistributionPlanForm::whereDistributionPlanId($plan->id ?? 0)->whereApproved('N')->count();
        return view('dana-ru.kewangan.pengesahan-agihan', compact('year', 'plan', 'plan_forms', 'plan_forms_count'));
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

    public function agihanProgramIndex()
    {
        DB::statement("SET SQL_MODE=''");
        $year_options = MasterlistDruAllocation::select('year')->orderBy('year', 'desc')->distinct()->get();
        $tabung_induk_allocation_sql = getMainFundByFormula('mda.project', 'mda.sub_project', 'MYSQL', 'formula_tabung_induk');
        $title_options = DB::table('masterlist_dru_allocations as mda')
        ->select(['b.code as bpki', 'p.code as program', 'dmf.name as jenis_agihan', 'dmf.code as tabung_induk'])
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
        // dd($title_options);
        $allocations = [];
        foreach ($title_options as $key => $options) {
            $amount = MasterlistDruAllocation::select(['amount'])->where('tabung_induk',$options->tabung_induk)->sum('amount');
            array_push($allocations, [
                'bpki'=> $options->bpki,
                'program'=> $options->program,
                'tabung_induk'=> $options->tabung_induk,
                'jenis_agihan'=> $options->jenis_agihan,
                'amount'=> $amount,
            ]);
        }
        usort($allocations, function($a, $b) {return $a['amount'] < $b['amount'];});
        // dd($allocations);
        $allocation_bar1_year = DB::table('masterlist_dru_allocations as mda')
            ->select(['mda.year'])
            ->join('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', 'mda.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
            })->orderBy('mda.year')->distinct()->pluck('year')->toArray();
            
        // $allocation_bar1_year = MasterlistDruAllocation::select('year')->orderBy('year')->distinct()->pluck('year')->toArray();
        // dd($allocation_bar1_year);
        $allocation_bar1_title = [];
        $allocation_bar1_year_allocation = [];
        $allocation_bar1_allocation = [];
        $allocation_bar1_year_expenses = [];
        $allocation_bar1_expenses = [];
        foreach ($allocation_bar1_year as $key => $year) {
            $allocation = DB::table('masterlist_dru_allocations as mda')
            ->select(['mda.amount'])
            ->join('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', 'mda.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
            })->where('mda.year',$year)->sum('amount');
            $expense = DB::table('masterlist_dru_expenses as mde')
            ->select(['mde.amount'])
            ->join('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', 'mde.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
            })->where('mde.year',$year)->sum('amount');
            array_push($allocation_bar1_year_allocation, (float)$allocation);
            array_push($allocation_bar1_year_expenses, (float)$expense);
        }
        foreach ($allocations as $key => $allocation) {
            if($key < 20){
                array_push($allocation_bar1_title, $allocation['jenis_agihan']);
                array_push($allocation_bar1_allocation, (float)$allocation['amount']);
                array_push($allocation_bar1_expenses, (float)$allocation['amount']);
            }
        }
        $total_allocation = DB::table('masterlist_dru_allocations as mda')
            ->select(['mda.amount'])
            ->join('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', 'mda.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
            })->sum('amount');
        $total_expenses = DB::table('masterlist_dru_expenses as mde')
            ->select(['mde.amount'])
            ->join('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', 'mde.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
            })->sum('amount');
        $chart_data = [
            "total_allocation"=>(float)$total_allocation,
            "total_expenses"=>(float)$total_expenses,
            "total_balance"=>(float)$total_allocation-(float)$total_expenses,
            "total_expenses_percent"=>(float)$total_allocation > 0?(float)$total_expenses/(float)$total_allocation*100:0,
            "bar1_year"=>$allocation_bar1_year,
            "bar1_year_allocation"=>$allocation_bar1_year_allocation,
            "bar1_year_expenses"=>$allocation_bar1_year_expenses,
            "bar1_title"=>$allocation_bar1_title,
            "bar1_allocation"=>$allocation_bar1_allocation,
            "bar1_expenses"=>$allocation_bar1_expenses,
        ];
        return view('dana-ru.kewangan.agihan-dashboard', compact('year_options', 'title_options','allocations','chart_data'));
    }

    public function program($year = null)
    {
        if(!$year){
            $plan = DruDistributionPlan::whereStatus(6)->orderBy('year', 'desc')->first();
            $year = $plan->year ?? date('Y');
        }
        $plan = DruDistributionPlan::where('year', $year)->whereStatus(6)->first();
        $plan_forms = getDistributionFormPlans($year)->where('plan_form.pic_declaration_date','!=', NULL)->get();
        return view('dana-ru.kewangan.perbelanjaan.program', compact('year', 'plan_forms'));
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
}
