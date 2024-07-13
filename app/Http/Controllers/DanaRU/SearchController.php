<?php

namespace App\Http\Controllers\DanaRU;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DatatableController;
use Illuminate\Support\Facades\DB;

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

    public function allocationList(Request $request)
    {
        $search_params = collect([
            "title" => "",
            "start_year" => "",
            "end_year" => "",
            "faculty" => "",
            "code" => "",
            "code2" => "",
        ]);
        if($request){
            $search_params->title = $request->title;
            $search_params->start_year = $request->start_year;
            $search_params->end_year = $request->end_year;
            $search_params->faculty = $request->faculty;
            $search_params->code = $request->code;
            $search_params->code2 = $request->code2;
        }
        if ($request->ajax()) {
            return DatatableController::allocationSearchList($search_params);
        }
        return view('dana-ru.search.allocation', compact('search_params'));
    }

    public function expensesList(Request $request)
    {
        $search_params = collect([
            "title" => "",
            "start_year" => "",
            "end_year" => "",
            "faculty" => "",
            "code" => "",
            "code2" => "",
        ]);
        if($request){
            $search_params->title = $request->title;
            $search_params->start_year = $request->start_year;
            $search_params->end_year = $request->end_year;
            $search_params->faculty = $request->faculty;
            $search_params->code = $request->code;
            $search_params->code2 = $request->code2;
        }
        if ($request->ajax()) {
            return DatatableController::expensesSearchList($search_params);
        }
        return view('dana-ru.search.expenses', compact('search_params'));
    }
}
