<?php

namespace App\Http\Controllers\DanaRU;

use App\Http\Controllers\Controller;
use App\Models\DanaRU\DruDistributionPlan;
use App\Models\DanaRU\DruDistributionPlanForm;
use App\Models\DanaRU\DruKpiPic;
use Illuminate\Support\Facades\DB;
use App\Models\DanaRU\DruDataAttachment;
use App\Models\MasterList\MasterlistDruExpenses;
use App\Models\TemporaryFile;
use App\Models\ApprovalApp;
use App\Http\Controllers\DatatableController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Http\Request;

class AgihanController extends Controller
{
    public function index(Request $request ,$year=null)
    {
        if(!$year){
            $plan = DruDistributionPlan::orderBy('year', 'desc')->first();
            $year = $plan->year ?? date('Y');
        }
        $plans = getDruPlanList($year)->where('status', 6);
        $plan_form_raw = null;
        foreach ($plans as $key => $plan) {
            $plan_form = getDistributionFormPlans($year, $plan->id);
            if(!$plan_form_raw)$plan_form_raw = $plan_form;
            else $plan_form_raw = $plan_form_raw->concat($plan_form);
        }
        $plan_forms = $plan_form_raw;
        $plan_forms = $plan_forms->where('pic_email', user()->email)->where('plan_form_approved', 'Y');
        // dd($plan_forms);
        // dd($plan_forms[0]->plan_form_pic_submission_status == null);
        return view('dana-ru.senarai-agihan.index', compact('year', 'request', 'plans', 'plan_forms'));
    }

    public function show($plan_id)
    {
        DB::statement("SET SQL_MODE=''");
        $plan_form_model = DruDistributionPlanForm::find($plan_id);
        $plan_form = DruDistributionPlanForm::from('dru_distribution_plan_forms as plan_form')
            ->select([
                'plan.year as plan_year', 'plan_form.id as plan_form_id', 'plan_form.reference_no as plan_form_ref_no', 'plan_form.approved as plan_form_approved', 'plan_form.updated_at as plan_form_updated_at', 'plan_form.pic_declaration_date as plan_form_declaration_date',
                'mrun.description_1 as mrun_desc', 'bpki.parameter_name as bpki_code',
                'pic.name as pic_name', 
                'ptj.description_1 as ptj','ptj.original_code as ptj_code',
                DB::raw('IF(COUNT(DISTINCT member.name) > 1,GROUP_CONCAT(DISTINCT CONCAT("- ", member.name) SEPARATOR "<br>"),GROUP_CONCAT(DISTINCT member.name)) as member_name'),
                DB::raw('(SELECT SUM(total) FROM dru_kpi_pics as pic_kpi WHERE pic_kpi.distribution_plan_form_id = plan_form.id) AS total_expenses'),
                DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(main_kpi_template.title,": RM", FORMAT(main_kpi.amount, 2), " x ", main_kpi.count, " = RM", FORMAT(main_kpi.total, 2))) ORDER BY main_kpi.id ASC SEPARATOR "<br>") as main_kpi_details'),
                DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(kpi_template.title,": RM", FORMAT(kpi.amount, 2), " x ", kpi.count, " = RM", FORMAT(kpi.total, 2))) ORDER BY kpi.id ASC SEPARATOR "<br>") as kpi_details'),
                'ddf.status as ddf_status','ddf.code as ddf_code','ddf.title as ddf_title','ddf.code_2 as ddf_code_2','plan_form.output','plan_form.outcome','plan_form.notes','plan_form.amount as plan_form_amount',
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
            ->leftjoin('dru_kpi_pics as kpi_pic', function ($join) {
                $join->on('kpi_pic.distribution_plan_form_id', '=', 'plan_form.id')
                ->where('kpi_pic.status','active');
            })
            ->leftjoin('dru_kpi_templates as kpi_template', function ($join) {
                $join->on('kpi_template.id', '=', 'kpi.kpi_template_id')
                ->where('kpi_template.active','Y');
            })
            ->join('dru_dist_funds as ddf','ddf.id', '=', 'plan_form.project_id')
            ->groupBy('plan_form.id')->where('plan_form.id', $plan_id)->first();
        // dd(user());
        return view('dana-ru.senarai-agihan.show', compact('plan_form', 'plan_form_model'));
    }

    public function form($year=null, $id = null, $tab = null)
    {
        if(!$year)$year = date('Y');
        $plan_form = DruDistributionPlanForm::find($id);
        $plan = $plan_form->distribution_plan;
        $edit = in_array($plan_form->pic_submission_status, [null, 7, 10, 11]);
        $expenses_record_histories = $plan_form->expenses_record_history;
        return view('dana-ru.senarai-agihan.form', compact('year', 'plan_form', 'expenses_record_histories', 'plan', 'tab', 'edit'));
    }

    public function declare(Request $request, $plan_id)
    {
        // dd($request->all());
        
        $validator = Validator::make($request->all(), [
            'file_upload' => 'required',
        ], [
            'file_upload.required' => 'Sila muat naik lampiran A yang telah ditandatangan.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->withFragment('signed_lampiran_a'); // no leading #
        }

        $plan_form = DruDistributionPlanForm::find($plan_id);
        $plan_form->pic_declaration_date = now();

        $data = new DruDataAttachment;
        $data->table = 'plan_form';
        $data->parent_id = $plan_form->id;
        $data->category = "lampiran_a";
        $file = collect(json_decode($request->file_upload));
        $data->filename = $file['filename'];
        $temporaryFile = TemporaryFile::where('folder', $file['folder'])->first();
        if($temporaryFile){
            $data->addMedia(storage_path('app/data/tmp/'.$file['folder'].'/'.$temporaryFile->filename))->toMediaCollection('druDataAttachment');
            $temporaryFile->delete();
            $data->save();
            Storage::deleteDirectory('data/tmp/'.$file['folder']);
        }

        $plan_form->save();
        session()->flash('success', "Lampiran A telah berjaya disahkan.");
        return back();
    }

    public function kpiUpdate($plan_id, Request $request)
    {
        $request->validate([
            'justification' => 'required_with:balance',
            'term' => 'required',
            'output' => 'required',
            'outcome' => 'required',
            'balance' => 'nullable',
            'mykpi' => 'required',
            'file_upload' => 'required',
        ],
        [
            'output.required' => 'Sila isi maklumat ini.',
            'output.required' => 'Sila isi maklumat ini.',
            'outcome.required' => 'Sila isi maklumat ini.',
            'term.required' => 'Sila pilih penggal.',
            'justification.required_with' => 'Sila masukkan justifikasi baki agihan belum belanja.',
            'mykpi.required' => 'Sila masukkan KPI.',
            'file_upload.required' => 'Sila muat naik bukti.',
        ]);

        $order = ApprovalApp::whereAppId($plan_id)->whereModuleId(2)->orderBy('index', 'desc')->first()->index ?? 0;
        $order++;
        $status = $request->submit_btn;
        $plan_form = DruDistributionPlanForm::find($plan_id);
        if($plan_form){
            if($status != 7){
                $approvalApp = new ApprovalApp;
                $approvalApp->index = $order;
                $approvalApp->module_id = 2;
                $approvalApp->app_id = $plan_form->id;
                $approvalApp->c_id = user()->id;
                $approvalApp->status = $status;
                $approvalApp->save();

                foreach (array_diff($plan_form->pic_evidences_id_array, ($request->existing_files ?? [])) as $key => $deleted_file) {
                    $existing_data = DruDataAttachment::find($deleted_file);
                    $existing_data->is_active = 'N';
                    $existing_data->save();
                }
            }
            else{
                foreach (array_diff($plan_form->pic_evidences_id_array, ($request->existing_files ?? [])) as $key => $deleted_file) {
                    DruDataAttachment::find($deleted_file)->delete();
                }
            }
            $plan_form->output = $request->output;
            $plan_form->outcome = $request->outcome;
            $plan_form->pic_justification = $request->justification;
            $plan_form->pic_submission_status = $status;
            $plan_form->pic_submission_term = $request->term;
            $plan_form->commitment = (float)str_replace( ",", "", $request->commitment);
            $plan_form->save();
            
            foreach ($request->file_upload as $key => $file) {
                $data = new DruDataAttachment;
                $data->table = 'plan_form';
                $data->category = "expenses_evidence";
                $data->parent_id = $plan_form->id;
                $fileRaw = collect(json_decode($file));
                if(count($fileRaw)){
                    $data->filename = $fileRaw[0]->filename;
                    $temporaryFile = TemporaryFile::where('folder', $fileRaw[0]->folder)->first();
                    if($temporaryFile){
                        $data->addMedia(storage_path('app/data/tmp/'.$fileRaw[0]->folder.'/'.$temporaryFile->filename))->toMediaCollection('druDataAttachment');
                        $temporaryFile->delete();
                        $data->save();
                        Storage::deleteDirectory('data/tmp/'.$fileRaw[0]->folder);
                    }
                }
            }
        }
        $kpi_arr = [];
        foreach (($request->mykpi ?? []) as $key => $kpi_data) {
            if($kpi_data['id'])$kpi = DruKpiPic::find($kpi_data['id']);
            else $kpi = new DruKpiPic;
            $kpi->distribution_plan_form_id = $plan_id;
            $kpi->kpi_template_id = $kpi_data['item_id'];
            $kpi->count = $kpi_data['bil'];
            $kpi->amount = (float)str_replace( ",", "", $kpi_data['amount']);
            $kpi->total = (float)str_replace( ",", "", $kpi_data['total']);
            $kpi->status = 'active';
            $kpi->c_id = user()->id;
            $kpi->save();
            array_push($kpi_arr, $kpi_data['id']);
        }
        DruKpiPic::whereDistributionPlanFormId($plan_id)->whereNotIn('id', $kpi_arr)->delete();
        if($status != 7){
            $targeted_data = [
                'plan_form_id' => $plan_form->id,
                'kpi_pics' => $plan_form->pic_kpi
            ];
            storeLogData($plan_form->distribution_plan, $approvalApp->id, 'SUBMIT', 'Kemaskini KPI PIC', $targeted_data, 2);
        }

        session()->flash('success', "KPI telah berjaya disimpan.");
        return back();
    }

    public function expensesRecord(Request $request, $plan_id)
    {
        $plan_form = DruDistributionPlanForm::find($plan_id);
        $plan = $plan_form->distribution_plan;
        $dru_dist_fund = $plan_form->project;
        $total = MasterlistDruExpenses::select('amount')->where('year', $plan->year)
        ->where('ptj', $dru_dist_fund->faculty_code)
        ->where('project', $dru_dist_fund->code)
        ->where('sub_project', $dru_dist_fund->code_2)->sum('amount');
        if ($request->ajax()) {
            return DatatableController::expensesRecord($plan->year, $dru_dist_fund->faculty_code, $dru_dist_fund->code, $dru_dist_fund->code_2);
        }
        return view('dana-ru.senarai-agihan.expenses-record', compact('plan_form', 'total'));
    }
}
