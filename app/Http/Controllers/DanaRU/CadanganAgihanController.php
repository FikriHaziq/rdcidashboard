<?php

namespace App\Http\Controllers\DanaRU;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DanaRU\DruProject;
use App\Models\DanaRU\DruSubProject;
use App\Models\DanaRU\DruDistributionPlan;
use App\Models\DanaRU\DruDistributionPlanForm;
use App\Models\DanaRU\DruMember;
use App\Models\DanaRU\DruKpi;
use App\Models\DanaRU\DruKpiTemplate;
use App\Models\DanaRU\DruDataAttachment;
use App\Models\TemporaryFile;
use App\Models\ApprovalApp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Validator;

class CadanganAgihanController extends Controller
{
    public function index(Request $request ,$year=null, $tab=null)
    {
        if(!$year){
            $plan = DruDistributionPlan::orderBy('year', 'desc')->first();
            $year = $plan->year ?? date('Y');
        }
        if($request->status == 2 && $request->role != 'approver')session()->flash('success', "Borang Cadangan Agihan telah berjaya dihantar");
        if($request->status == 4 && $request->role == 'approver')session()->flash('success', "Borang Cadangan Agihan telah berjaya disemak");
        if($request->status == 5 && $request->role == 'approver')session()->flash('success', "Borang Cadangan Agihan telah berjaya disemak");
        if($request->action == 'save')session()->flash('success', "Data telah berjaya dikemaskini");
        $plan = DruDistributionPlan::where('year', $year)->first();
        // dd($plan->log);
        $plan_forms = getDistributionFormPlans($year)->get();
            // dd($plan_forms);
        // $plan_forms = DruDistributionPlanForm::get();

        return view('dana-ru.cadangan-agihan.index', compact('year', 'request', 'plan', 'plan_forms', 'tab'));
    }

    public function form($year=null, $id = null)
    {
        if(!$year)$year = date('Y');
        $plan_form = DruDistributionPlanForm::find($id);
        $plan = $plan_form->distribution_plan ?? null;
        // dd($plan_form->projectInputData);
        return view('dana-ru.cadangan-agihan.form', compact('year', 'plan_form', 'plan'));
    }

    public function storePlan(Request $request, $year=null)
    {
        $request->validate([
            'fund' => 'required',
        ],
        [
            'fund.required' => 'Sila masukkan dana yang diterima.',
        ]);
        $plan = DruDistributionPlan::where('year', $year)->first();
        if(!$plan){
            $plan = new DruDistributionPlan();
            $plan->year = $year;
            $plan->amount = (float)str_replace( ",", "", $request->fund);
            $plan->c_id = user()->id;
            $plan->status = 1;
            $plan->save();
        }
        else{
            $plan->amount = (float)str_replace( ",", "", $request->fund);
            $plan->c_id = user()->id;
            $plan->save();
        }
        return redirect()->back();
    }

    public function store(Request $request, $year=null)
    {
        $request->validate([
            'mrun' => 'required',
            'bpki' => 'required',
            'kp_name' => 'required',
            'kp_email' => 'required|email',
            'kp_ic' => 'required',
            'pb_name' => 'required',
            'pb_email' => 'required|email',
            'pb_ic' => 'required',
            'ptj' => 'required',
            'project' => 'required',
        ],
        [
            'mrun.required' => 'Sila pilih program utama.',
            'bpki.required' => 'Sila pilih skop perbelanjaan.',
            'kp_name.required' => 'Sila masukkan nama.',
            'kp_email.required' => 'Sila masukkan emel.',
            'kp_email.email' => 'Sila masukkan format emel.',
            'kp_ic.required' => 'Sila masukkan ic.',
            'pb_name.required' => 'Sila masukkan nama.',
            'pb_email.required' => 'Sila masukkan emel.',
            'pb_email.email' => 'Sila masukkan format emel.',
            'pb_ic.required' => 'Sila masukkan ic.',
            'ptj.required' => 'Sila pilih PTJ.',
            'project.required' => 'Sila pilih projek.',
        ]);
        $plan = DruDistributionPlan::where('year', $year)->first();
        if(!$plan){
            $plan = new DruDistributionPlan;
            $plan->year = $year;
            $plan->c_id = user()->id;
            $plan->status = 1;
            $plan->save();
        }
        $ptj = explode('_',$request->ptj);
        $ptj_id = $ptj[0];
        $project = explode('_',$request->project);
        if(count($project) == 4){
            $project_id = $project[0];
        }
        else{
            $dru_project = new DruProject;
            $dru_project->year = $year;
            $dru_project->title = $project[0];
            $dru_project->code = 'TMP';
            $dru_project->program_id = $request->mrun;
            $dru_project->is_fixed_subproject = 'N';
            $dru_project->type = 'single';
            $dru_project->status = 'temp';
            $dru_project->save();

            $project_id = $dru_project->id;
        }
        $plan_form = DruDistributionPlanForm::find($request->plan_form_id);
        if(!$plan_form)$plan_form = new DruDistributionPlanForm;
        $plan_form->distribution_plan_id = $plan->id;
        $plan_form->c_id = user()->id;
        $plan_form->mrun = $request->mrun;
        $plan_form->bpki = $request->bpki;
        $plan_form->ptj_id = $ptj_id;
        $plan_form->project_id = $project_id;
        $plan_form->amount = (float)str_replace( ",", "", $request->total_dist);
        $plan_form->notes = $request->note;
        $plan_form->save();

        $pic = DruMember::whereDistributionPlanFormId($request->plan_form_id)->whereType('leader')->first();
        if(!$pic)$pic = new DruMember;
        $pic->type = 'leader';
        $pic->distribution_plan_form_id = $plan_form->id;
        $pic->name = $request->kp_name;
        $pic->email = $request->kp_email;
        $pic->nric = $request->kp_ic;
        $pic->save();

        $member = DruMember::whereDistributionPlanFormId($request->plan_form_id)->whereType('member')->first();
        if(!$member)$member = new DruMember;
        $member->type = 'member';
        $member->distribution_plan_form_id = $plan_form->id;
        $member->name = $request->pb_name;
        $member->email = $request->pb_email;
        $member->nric = $request->pb_ic;
        $member->save();

        $main_kpi = $plan_form->main_kpi;
        $kpi = $plan_form->kpi;
        $kpi_arr = [];

        foreach (($request->main_dist ?? []) as $key => $main_dist_data) {
            if($main_dist_data['id'])$main_dist = DruKpi::find($main_dist_data['id']);
            else $main_dist = new DruKpi;
            $main_dist->type = 'main';
            $main_dist->distribution_plan_form_id = $plan_form->id;
            $main_dist->kpi_template_id = $main_dist_data['item'];
            $main_dist->count = $main_dist_data['bil'];
            $main_dist->amount = (float)str_replace( ",", "", $main_dist_data['amount']);
            $main_dist->total = (float)str_replace( ",", "", $main_dist_data['total']);
            $main_dist->status = 'active';
            $main_dist->save();
            array_push($kpi_arr, $main_dist_data['id']);
        }

        foreach (($request->kpi ?? []) as $key => $kpi_data) {
            if($kpi_data['id'])$kpi = DruKpi::find($kpi_data['id']);
            else $kpi = new DruKpi;
            $kpi->type = 'kpi';
            $kpi->distribution_plan_form_id = $plan_form->id;
            $kpi->kpi_template_id = $kpi_data['item'];
            $kpi->count = $kpi_data['bil'];
            $kpi->amount = (float)str_replace( ",", "", $kpi_data['amount']);
            $kpi->total = (float)str_replace( ",", "", $kpi_data['total']);
            $kpi->status = 'active';
            $kpi->save();
            array_push($kpi_arr, $kpi_data['id']);
        }
        DruKpi::whereDistributionPlanFormId($plan_form->id)->whereNotIn('id', $kpi_arr)->delete();

        $approvalApp = ApprovalApp::whereAppId($plan->id)->whereModuleId(1)->orderBy('index', 'desc')->first();
        if($approvalApp)storeLogData($plan, $approvalApp->id, 'UPDATE', 'Kemaskini Cadangan Agihan', ['plan_form_id' => $plan_form->id]);
        // dd(DruKpi::whereDistributionPlanFormId($plan_form->id)->whereNotIn('id', $kpi_arr)->get(), $kpi_arr, $request->all());
        // dd(DruKpi::whereDistributionPlanFormId($plan_form->id)->whereNotIn('id', $kpi_arr)->get());

        session()->flash('success', "Borang telah berjaya disimpan");
        return redirect()->route('dana-ru.cadangan-agihan.index', $year);
    }

    public function deletePlan($id)
    {
        $plan_form = DruDistributionPlanForm::find($id);
        if($plan_form){
            DruMember::whereDistributionPlanFormId($id)->delete();
            DruKpi::whereDistributionPlanFormId($id)->delete();
            $plan_form->delete();
            session()->flash('success', "Data is successfully deleted");
            return back();
        }
        else{
            session()->flash('error', "Something went wrong");
            return back();
        }
    }

    public function verification(Request $request, $id, $type)
    {
        $order = ApprovalApp::whereAppId($id)->whereModuleId(1)->orderBy('index', 'desc')->first()->index ?? 0;
        $status = 0;
        if($type == 'submit') {
            if($order > 0)$status = 3;
            else $status = 2;
        }
        else $status = $request->status;
        $order++;
        // dd($order);
        $plan = DruDistributionPlan::find($id);
        if($plan){
            $approvalApp = new ApprovalApp;
            $approvalApp->index = $order;
            $approvalApp->module_id = 1;
            $approvalApp->app_id = $id;
            $approvalApp->c_id = user()->id;
            $approvalApp->status = $status;
            $approvalApp->comment = $request->comment ?? null;
            $approvalApp->save();
            $plan->status = $status;
            $plan->save();

            storeLogData($plan, $approvalApp->id, 'SUBMIT');
        }
        else{
            session()->flash('error', "Something went wrong");
            return back();
        }
        session()->flash('success', "Borang telah berjaya dihantar.");
        return back();
    }

    public function verificationPost(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'file_upload' => 'required',
            'status' => 'required',
        ],
        [
            'file_upload.required' => 'Sila muat naik cabutan minit.',
            'status.required' => 'Sila pilih status.',
        ]);
        if ($validator->fails()) {
            return redirect()->route('dana-ru.cadangan-agihan.index', ['year'=>$request->year, 'tab'=>'verification'])
                ->withErrors($validator)
                ->withInput();
        }
        $order = ApprovalApp::whereAppId($request->plan_id)->whereModuleId(1)->orderBy('index', 'desc')->first()->index ?? 0;
        $order++;
        $status = $request->status;
        $plan = DruDistributionPlan::find($request->plan_id);
        if($plan){
            $approvalApp = new ApprovalApp;
            $approvalApp->index = $order;
            $approvalApp->module_id = 1;
            $approvalApp->app_id = $request->plan_id;
            $approvalApp->c_id = user()->id;
            $approvalApp->status = $status;
            $approvalApp->comment = $request->comment ?? null;
            $approvalApp->save();
            $plan->status = $status;
            $plan->save();
            $data = new DruDataAttachment;
            $data->table = 'approval_app';
            $data->parent_id = $approvalApp->id;
            $file = collect(json_decode($request->file_upload));
            if($request->file_upload){
                $data->filename = $file['filename'];
                $file = collect(json_decode($request->file_upload));
                $temporaryFile = TemporaryFile::where('folder', $file['folder'])->first();

                if($temporaryFile){
                    $data->addMedia(storage_path('app/data/tmp/'.$file['folder'].'/'.$temporaryFile->filename))->toMediaCollection('druDataAttachment');
                    $temporaryFile->delete();
                }
            }
            $data->save();
        }
        else{
            session()->flash('error', "Something went wrong");
            // return back();
        }
        session()->flash('success', "Borang telah berjaya disahkan.");
        return redirect()->route('dana-ru.cadangan-agihan.index', ['year'=>$request->year]);
    }

    public function downloadFile($id)
    {
        $file = DruDataAttachment::find($id);
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
