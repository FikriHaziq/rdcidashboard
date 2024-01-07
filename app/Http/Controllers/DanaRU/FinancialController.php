<?php

namespace App\Http\Controllers\DanaRU;

use App\Http\Controllers\Controller;
use App\Models\DanaRU\DruDistributionPlan;
use App\Models\DanaRU\DruDistributionPlanForm;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    public function pengesahanAgihanIndex($year = null)
    {
        if(!$year)$year = date('Y');
        $plan = DruDistributionPlan::where('year', $year)->whereStatus(6)->first();
        // dd($plan);
        // dd($plan->log);
        $plan_forms = getDistributionFormPlans($year)->get();
        $plan_forms_count = DruDistributionPlanForm::whereDistributionPlanId($plan->id ?? 0)->whereApproved('N')->count();
        return view('dana-ru.kewangan.pengesahan-agihan', compact('year', 'plan', 'plan_forms', 'plan_forms_count'));
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
        return view('dana-ru.kewangan.perbelanjaan.program', compact('year'));
    }

    public function subProject($year = null)
    {
        if(!$year)$year = date('Y');
        return view('dana-ru.kewangan.perbelanjaan.subproject', compact('year'));
    }
}
