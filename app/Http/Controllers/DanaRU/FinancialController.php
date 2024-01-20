<?php

namespace App\Http\Controllers\DanaRU;

use App\Http\Controllers\Controller;
use App\Models\DanaRU\DruDistributionPlan;
use App\Models\DanaRU\DruDistributionPlanForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    public function pengesahanAgihanIndex($year = null)
    {
        if(!$year)$year = date('Y');
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
                'pro.status as pro_status','pro.code as pro_code','pro.title as pro_title','pro.code_2 as pro_code_2','plan_form.notes','plan_form.amount as plan_form_amount',
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
            ->join('dru_projects as pro','pro.id', '=', 'plan_form.project_id')
            ->groupBy('plan_form.id')->where('plan_form.id', $plan_id)->first();
        // dd($plan_form);
        return view('dana-ru.kewangan.pengesahan-agihan-show', compact('plan_form'));
    }

    public function pengesahanAgihanPost(Request $request)
    {
        $fill_count = 0;
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
        return view('dana-ru.kewangan.overall');
    }

    public function agihanProgramIndex()
    {
        return view('dana-ru.kewangan.overall');
    }

    public function program($year = null)
    {
        if(!$year)$year = date('Y');
        $plan = DruDistributionPlan::where('year', $year)->whereStatus(6)->first();
        $plan_forms = getDistributionFormPlans($year)->where('plan_form.pic_declaration_date','!=', NULL)->get();
        return view('dana-ru.kewangan.perbelanjaan.program', compact('year', 'plan_forms'));
    }

    public function subProject($year = null)
    {
        if(!$year)$year = date('Y');
        return view('dana-ru.kewangan.perbelanjaan.subproject', compact('year'));
    }
}
