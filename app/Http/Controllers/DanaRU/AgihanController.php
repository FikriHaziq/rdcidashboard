<?php

namespace App\Http\Controllers\DanaRU;

use App\Http\Controllers\Controller;
use App\Models\DanaRU\DruDistributionPlan;
use App\Models\DanaRU\DruDistributionPlanForm;
use Illuminate\Http\Request;

class AgihanController extends Controller
{
    public function index(Request $request ,$year=null)
    {
        if(!$year)$year = date('Y');
        $plan = DruDistributionPlan::where('year', $year)->first();
        $plan_forms = getDistributionFormPlans($year)->where('pic.email', user()->email)->get();
        // $plan_forms = DruDistributionPlanForm::get();

        return view('dana-ru.senarai-agihan.index', compact('year', 'request', 'plan', 'plan_forms'));
    }

    public function form($year=null, $id = null)
    {
        if(!$year)$year = date('Y');
        $plan_form = DruDistributionPlanForm::find($id);
        $plan = $plan_form->distribution_plan;
        // dd($plan_form->projectInputData);
        return view('dana-ru.senarai-agihan.form', compact('year', 'plan_form', 'plan'));
    }
}
