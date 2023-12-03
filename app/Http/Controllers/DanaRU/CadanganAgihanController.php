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

class CadanganAgihanController extends Controller
{
    public function index(Request $request ,$year=null)
    {
        DB::statement("SET SQL_MODE=''");
        if(!$year)$year = date('Y');
        if($request->status == 'submitted'&& $request->role != 'approver')session()->flash('success', "Borang Cadangan Agihan telah berjaya dihantar");
        if($request->status == 'verified' && $request->role == 'approver')session()->flash('success', "Borang Cadangan Agihan telah berjaya disemak");
        if($request->status == 'amendment' && $request->role == 'approver')session()->flash('success', "Borang Cadangan Agihan telah berjaya disemak");
        if($request->action == 'save')session()->flash('success', "Data telah berjaya dikemaskini");
        $plan = DruDistributionPlan::where('year', $year)->first();
        // dd($plan->log);
        $plan_forms = DruDistributionPlanForm::from('dru_distribution_plan_forms as plan_form')
            ->select([
                'plan_form.id as plan_form_id',
                'mrun.parameter_name as mrun_code', 'bpki.parameter_name as bpki_code',
                'pic.name as pic_name', 'member.name as member_name',
                'ptj.parameter_name as ptj','ptj.original_code as ptj_code',
                DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(main_kpi_template.title,": RM", FORMAT(main_kpi.amount, 2), " x ", main_kpi.count, " = RM", FORMAT(main_kpi.total, 2))) ORDER BY main_kpi.id ASC SEPARATOR "<br>") as main_kpi_details'),
                DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(kpi_template.title,": RM", FORMAT(kpi.amount, 2), " x ", kpi.count, " = RM", FORMAT(kpi.total, 2))) ORDER BY kpi.id ASC SEPARATOR "<br>") as kpi_details'),
                'pro.status as pro_status','pro.code as pro_code','pro.title as pro_title','pro.code_2 as pro_code_2','plan_form.notes','plan_form.amount as plan_form_amount',
            ])
            ->join('dru_distribution_plans as plan', function ($join) use ($year) {
                $join->on('plan.id', '=', 'plan_form.distribution_plan_id')
                    ->where('plan.year',$year);
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
            ->join('dru_projects as pro','pro.id', '=', 'plan_form.project_id')
            ->groupBy('plan_form.id')->where('plan.year', $year)
            ->get();
            // dd($plan_forms);
        // $plan_forms = DruDistributionPlanForm::get();

        return view('dana-ru.cadangan-agihan.index', compact('year', 'request', 'plan','plan_forms'));
    }

    public function form($year=null, $id = null)
    {
        if(!$year)$year = date('Y');
        $plan_form = DruDistributionPlanForm::find($id);
        // dd($plan_form->projectInputData);
        return view('dana-ru.cadangan-agihan.form', compact('year', 'plan_form'));
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
            $plan->status = 'draft';
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
        // dd($request->all());
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
            $plan->status = 'draft';
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
        $order = ApprovalApp::whereAppId($id)->orderBy('index', 'desc')->first()->index ?? 0;
        $order++;
        $status = '';
        if($type == 'submit') $status = 'submitted';
        else $status = $request->status;
        // dd($order);
        $plan = DruDistributionPlan::find($id);
        if($plan){
            $approvalApp = new ApprovalApp;
            $approvalApp->index = $order;
            $approvalApp->app_id = $id;
            $approvalApp->c_id = user()->id;
            $approvalApp->status = $status;
            $approvalApp->comment = $request->comment ?? null;
            $approvalApp->save();
            $plan->status = $status;
            $plan->save();
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
        // dd(storage_path());
        

        $order = ApprovalApp::whereAppId($request->plan_id)->orderBy('index', 'desc')->first()->index ?? 0;
        $order++;
        $status = $request->status;
        $plan = DruDistributionPlan::find($request->plan_id);
        if($plan){
            $approvalApp = new ApprovalApp;
            $approvalApp->index = $order;
            $approvalApp->app_id = $request->plan_id;
            $approvalApp->c_id = user()->id;
            $approvalApp->status = $status;
            $approvalApp->comment = $request->comment ?? null;
            $approvalApp->save();
            $plan->status = $status;
            $plan->save();
            $data = new DruDataAttachment;
            $data->parent_id = $approvalApp->id;
            $file = collect(json_decode($request->file_upload));
            if($request->file_upload){
                $data->filename = $file['filename'];
                $file = collect(json_decode($request->file_upload));
                $temporaryFile = TemporaryFile::where('folder', $file['folder'])->first();

                if($temporaryFile){
                    $data->addMedia(storage_path('app/data/tmp/'.$file['folder'].'/'.$temporaryFile->filename))->toMediaCollection('druDataAttachment');
                    // unlink(storage_path('app/data/tmp/'.$temporaryFile->folder.'/'.$temporaryFile->filename));
                    // rmdir(storage_path('app/data/tmp/'.$temporaryFile->folder));
                    $temporaryFile->delete();
                }
            }
            $data->save();
        }
        else{
            session()->flash('error', "Something went wrong");
            return back();
        }
        session()->flash('success', "Borang telah berjaya disahkan.");
        return redirect()->back();
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
