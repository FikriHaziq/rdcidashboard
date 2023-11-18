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
use Illuminate\Support\Facades\DB;

class CadanganAgihanController extends Controller
{
    public function index(Request $request ,$year=null)
    {
        if(!$year)$year = date('Y');
        if($request->status == 'submitted'&& $request->role != 'approver')session()->flash('success', "Borang Cadangan Agihan telah berjaya dihantar");
        if($request->status == 'verified' && $request->role == 'approver')session()->flash('success', "Borang Cadangan Agihan telah berjaya disemak");
        if($request->status == 'amendment' && $request->role == 'approver')session()->flash('success', "Borang Cadangan Agihan telah berjaya disemak");
        if($request->action == 'save')session()->flash('success', "Data telah berjaya dikemaskini");
        // $plan_form = DruDistributionPlanForm::from('dru_distribution_plan_forms as plan_form')
        //     ->select([
        //         'mrun.code as mrun_code', 'bpki.code as bpki_code',
        //         'pic.name as pic_name', 'member.name as member_name',
        //         'ptj.parameter_name as ptj','ptj.original_code as ptj_code',
        //         'sub.title as sub_title','sub.code as sub_code',
        //         'main_kpi_template.title as main_kpi_title','main_kpi.count as main_kpi_count','main_kpi.amount as main_kpi_amount','main_kpi.total as main_kpi_total',
        //         'kpi_template.title as kpi_title','kpi.count as kpi_count','kpi.amount as kpi_amount','kpi.total as kpi_total',
        //         'pro.code as pro_code','plan_form.notes','plan_form.amount as plan_form_amount',
        //     ])
        //     ->join('dru_distribution_plans as plan', function ($join) use ($year) {
        //         $join->on('plan.id', '=', 'plan_form.distribution_plan_id')
        //             ->where('plan.year',$year);
        //     })
        //     ->join('parameters as mrun', function ($join) {
        //         $join->on('mrun.id', '=', 'plan_form.mrun')
        //             ->where('mrun.active','Y');
        //     })
        //     ->join('parameters as bpki', function ($join) {
        //         $join->on('bpki.id', '=', 'plan_form.bpki')
        //             ->where('bpki.active','Y');
        //     })
        //     ->join('parameters as ptj', function ($join) {
        //         $join->on('ptj.id', '=', 'plan_form.ptj_id')
        //             ->where('ptj.active','Y');
        //     })
        //     ->join('dru_members as pic', function ($join) {
        //         $join->on('pic.distribution_plan_form_id', '=', 'plan_form.id')->where('pic.type','leader');
        //     })
        //     ->leftjoin('dru_members as member', function ($join) {
        //         $join->on('member.distribution_plan_form_id', '=', 'plan_form.id')->where('pic.type','member');
        //     })
        //     ->leftjoin('dru_kpis as main_kpi', function ($join) {
        //         $join->on('main_kpi.distribution_plan_form_id', '=', 'plan_form.id')
        //         ->where('main_kpi.type','main')->where('main_kpi.status','active');
        //     })
        //     ->leftjoin('dru_kpi_templates as main_kpi_template', function ($join) {
        //         $join->on('main_kpi_template.id', '=', 'main_kpi.id')
        //         ->where('main_kpi_template.active','Y');
        //     })
        //     ->leftjoin('dru_kpis as kpi', function ($join) {
        //         $join->on('kpi.distribution_plan_form_id', '=', 'plan_form.id')
        //         ->where('kpi.type','kpi')->where('kpi.status','active');
        //     })
        //     ->leftjoin('dru_kpi_templates as kpi_template', function ($join) {
        //         $join->on('kpi_template.id', '=', 'kpi.id')
        //         ->where('kpi_template.active','Y');
        //     })
        //     ->join('dru_sub_projects as sub','sub.id', '=', 'plan_form.sub_project_id')
        //     ->join('dru_projects as pro','pro.id', '=', 'sub.project_id')
        //     ->get();
        $plan_forms = DruDistributionPlanForm::get();

        return view('dana-ru.cadangan-agihan.index', compact('year', 'request', 'plan_forms'));
    }

    public function create($year=null)
    {
        if(!$year)$year = date('Y');
        // $data = $this->myraSectionA($year);
        return view('dana-ru.cadangan-agihan.form', compact('year'));
    }

    public function store(Request $request, $year=null)
    {
        // dd($request->all(), (float)str_replace( ",", "", $request->total_dist ));
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
            $sub_project_id = $project[0];
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

            $dru_sub_project = new DruSubProject;
            $dru_sub_project->year = $year;
            $dru_sub_project->title = $project[0];
            $dru_sub_project->code = 'TMP';
            $dru_sub_project->project_id = $dru_project->id;
            $dru_sub_project->status = 'temp';
            $dru_sub_project->save();

            $sub_project_id = $dru_sub_project->id;
        }
        $plan_form = new DruDistributionPlanForm;
        $plan_form->distribution_plan_id = $plan->id;
        $plan_form->c_id = user()->id;
        $plan_form->mrun = $request->mrun;
        $plan_form->bpki = $request->bpki;
        $plan_form->ptj_id = $ptj_id;
        $plan_form->sub_project_id = $sub_project_id;
        $plan_form->amount = (float)str_replace( ",", "", $request->total_dist);
        $plan_form->notes = $request->note;
        $plan_form->save();

        $pic = new DruMember;
        $pic->type = 'leader';
        $pic->distribution_plan_form_id = $plan_form->id;
        $pic->name = $request->kp_name;
        $pic->email = $request->kp_email;
        $pic->nric = $request->kp_ic;
        $pic->save();

        if($request->pb_name){
            $member = new DruMember;
            $member->type = 'member';
            $member->distribution_plan_form_id = $plan_form->id;
            $member->name = $request->pb_name;
            $member->email = $request->pb_email;
            $member->nric = $request->pb_ic;
            $member->save();
        }

        foreach (($request->main_dist_item ?? []) as $key => $main_dist_item) {
            $main_dist = new DruKpi;
            $main_dist->type = 'main';
            $main_dist->distribution_plan_form_id = $plan_form->id;
            $main_dist->kpi_template_id = $request->main_dist_item[$key];
            $main_dist->count = $request->main_dist_bil[$key];
            $main_dist->amount = (float)str_replace( ",", "", $request->main_dist_amount[$key]);
            $main_dist->total = (float)str_replace( ",", "", $request->main_dist_total[$key]);
            $main_dist->status = 'active';
            $main_dist->save();
        }

        foreach (($request->kpi_item ?? []) as $key => $kpi_item) {
            $kpi = new DruKpi;
            $kpi->type = 'main';
            $kpi->distribution_plan_form_id = $plan_form->id;
            $kpi->kpi_template_id = $request->kpi_item[$key];
            $kpi->count = $request->kpi_bil[$key];
            $kpi->amount = (float)str_replace( ",", "", $request->kpi_amount[$key]);
            $kpi->total = (float)str_replace( ",", "", $request->kpi_total[$key]);
            $kpi->status = 'active';
            $kpi->save();
        }

        session()->flash('success', "Borang telah berjaya disimpan");
        return redirect()->route('dana-ru.cadangan-agihan.index', $year);
    }
}
