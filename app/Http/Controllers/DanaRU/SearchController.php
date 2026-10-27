<?php

namespace App\Http\Controllers\DanaRU;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DatatableController;
use Illuminate\Support\Facades\DB;
use App\Models\MasterList\MasterlistDruAllocation;
use App\Models\MasterList\MasterlistDruExpenses;
use App\Models\Status;

class SearchController extends Controller
{
    public function __construct()
    {
        // set_time_limit(300);
        ini_set('max_execution_time', 500);
        ini_set('memory_limit', '-1');
    }

    public function index()
    {
        return view('dana-ru.search.index');
    }

    public function cadanganAgihanList(Request $request)
    {
        $search_params = (object)[];
        foreach (["title", "start_year", "end_year", "type", "status", "approved", "program", "bpki", "ptj", "code", "code2"] as $key) {
            $search_params->$key = trim((string)$request->$key);
        }
        if ($request->ajax()) {
            return DatatableController::cadanganAgihanSearchList($search_params);
        }

        $options = (object)[
            'years' => DB::table('dru_distribution_plans')->distinct()->orderByDesc('year')->pluck('year'),
            'types' => planTypes(),
            'statuses' => Status::whereModuleId(1)->orderBy('sort')->get(),
            'ptj' => DB::table('dru_distribution_plan_forms AS plan_form')
                ->join('parameters AS ptj', 'ptj.id', '=', 'plan_form.ptj_id')
                ->select('ptj.id', 'ptj.parameter_name', 'ptj.original_code')->distinct()->orderBy('ptj.parameter_name')->get(),
        ];
        $active_filters = collect((array)$search_params)->filter()->count();
        return view('dana-ru.search.cadangan-agihan', compact('search_params', 'options', 'active_filters'));
    }

    public function allocationList(Request $request)
    {
        $search_params = (object)[];
        foreach (["title", "start_year", "end_year", "program", "bpki", "ptj", "type", "expenditure_type", "code", "code2"] as $key) {
            $search_params->$key = trim((string)$request->$key);
        }
        if ($request->ajax()) {
            return DatatableController::allocationSearchList($search_params);
        }

        $options = (object)[
            'years' => MasterlistDruAllocation::distinct()->orderByDesc('year')->pluck('year'),
            'ptj' => MasterlistDruAllocation::distinct()->orderBy('ptj')->pluck('ptj'),
            'expenditure_types' => MasterlistDruAllocation::distinct()->whereNotNull('expenditure_type')->orderBy('expenditure_type')->pluck('expenditure_type'),
            'types' => allocationTypes(),
        ];
        $active_filters = collect((array)$search_params)->filter()->count();
        return view('dana-ru.search.allocation', compact('search_params', 'options', 'active_filters'));
    }

    public function expensesList(Request $request)
    {
        $search_params = (object)[];
        foreach (["title", "start_year", "end_year", "month", "program", "bpki", "ptj", "sodo", "code", "code2"] as $key) {
            $search_params->$key = trim((string)$request->$key);
        }
        if ($request->ajax()) {
            return DatatableController::expensesSearchList($search_params);
        }

        $options = (object)[
            'years' => MasterlistDruExpenses::distinct()->orderByDesc('year')->pluck('year'),
            'ptj' => MasterlistDruExpenses::from('masterlist_dru_expenses AS mde')
                ->leftJoin('parameters AS f', function ($join){
                    $join->on('f.original_code', '=', 'mde.ptj')->whereIn('f.group_id', [1, 2]);
                })
                ->select('mde.ptj', 'f.parameter_name AS name')->distinct()->orderBy('mde.ptj')->get(),
            'sodo' => MasterlistDruExpenses::distinct()->whereNotNull('sodo_short')->orderBy('sodo_short')->pluck('sodo_short'),
        ];
        $active_filters = collect((array)$search_params)->filter()->count();
        return view('dana-ru.search.expenses', compact('search_params', 'options', 'active_filters'));
    }
}
