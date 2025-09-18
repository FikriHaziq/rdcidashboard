<?php

namespace App\Http\Controllers\DanaRU;

use App\Http\Controllers\Controller;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DruAllocationImport;
use App\Imports\DruExpensesImport;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Http\Request;
use App\Models\MasterList\MasterlistDruAllocation;
use App\Models\MasterList\MasterlistDruExpenses;
use App\Models\MasterList\MasterlistDruYear;
use App\Models\DanaRU\DruProject;
use App\Models\DanaRU\DruMainFund;
use App\Models\DanaRU\DruDistFund;
use App\Http\Controllers\DatatableController;
use Illuminate\Support\Facades\DB;

class MasterlistController extends Controller
{
    public function __construct()
    {
        // set_time_limit(300);
        ini_set('max_execution_time', 500);
        ini_set('memory_limit', '-1');
    }

    public function allocationIndex()
    {
        $files = DataAttachment::whereModule('allocation')->latest()->get();
        $migration_years = MasterlistDruYear::from('masterlist_dru_years as mdeu')->select([
            'mdeu.year','mdeu.allocation_main_fund_status','mdeu.allocation_dist_fund_status',
        ])
        ->orderBy('mdeu.year', 'desc')->get();
        return view('dana-ru.masterlist.allocation', compact('files', 'migration_years'));
    }

    public function allocationYearIndex($year = null, Request $request)
    {
        $yearOptions = MasterlistDruAllocation::select('year')->distinct()->pluck('year')->toArray();
        $tabung_induk_sql = getMainFundByFormula('mda.project', 'mda.sub_project', 'MYSQL', 'formula_tabung_induk');
        $allocations_year = MasterlistDruYear::from('masterlist_dru_years as mdeu')->select([
            'mdeu.year','mdeu.allocation_main_fund_status','mdeu.allocation_dist_fund_status',
        ])->where('mdeu.year', $year)->first();
        if ($request->ajax()) {
            return DatatableController::allocations($year);
        }
        return view('dana-ru.masterlist.allocations-year', compact('allocations_year', 'yearOptions', 'year'));
    }

    public function allocationImport($id)
    {
        $masterlist = DataAttachment::find($id);
        if($masterlist){
            $mediaItems = $masterlist->getFirstMedia('dataAttachment');
            $filepath = $mediaItems->getPath();
            // $headings = (new HeadingRowImport)->toArray($filepath);
            // dd($headings);
            Excel::import(new DruAllocationImport(), $filepath);
        }
        else{
            session()->flash('info', "This module will be available soon");
            return back();
        }
        $prev_data = DataAttachment::whereId($id)->whereStatus('selected')->first();
        if($prev_data){
            $prev_data->status = 'not-selected';
            $prev_data->save();
        }
        $masterlist->status = 'selected';
        $masterlist->save();
        $this->updateDruYears();
        session()->flash('success', "Masterlist is successfully imported");
        return back();
    }

    public function allocationDelete($id)
    {
        $masterlist = DataAttachment::find($id);
        $masterlist->delete();
        session()->flash('success', "Masterlist is successfully deleted");
        return back();
    }

    public function processData($fund_type, $type, $year){
        if($type == 'expenses'){
            if($fund_type == "main_fund"){
                $tabung_induk_sql = getMainFundByFormula('mde.project', 'mde.sub_project', 'MYSQL', 'formula_tabung_induk');
                $main_funds = DB::table('masterlist_dru_expenses AS mde')
                    ->select(
                        'mde.id', 'mde.year','mde.jenis_agihan as main_fund_name',
                        DB::raw($tabung_induk_sql),
                    )
                    ->where('mde.year', $year)->groupBy('formula_tabung_induk')->get();
                $insert_data = [];
                foreach ($main_funds as $main_fund) {
                    $expenses_data = [
                        'id' => $main_fund->id,
                        'main_fund_id' => null,
                    ];
                    $data = [
                        'apply_to_all' => 1,
                        'code' => $main_fund->formula_tabung_induk,
                        'name' => $main_fund->main_fund_name,
                        'is_draft' => 1,
                        'updated_at' => now()
                    ];
                    $insert_data[] = $data;
                }
                $insert_data = collect($insert_data);
                $chunks = $insert_data->chunk(100);

                foreach ($chunks as $main_key => $chunk) {
                    foreach ($chunk as $key => $item) {
                        DruMainFund::updateOrCreate(
                            ['code' => $item['code']],
                            $item
                        ); 
                    }
                }
                $expenses_year = MasterlistDruYear::where('year', $year)->first();
                $expenses_year->main_fund_status = 1;
                $expenses_year->save();
            }
        }
        else if($type == 'allocation'){
            if($fund_type == "main_fund"){
                $tabung_induk_sql = getMainFundByFormula('mda.project', 'mda.sub_project', 'MYSQL', 'formula_tabung_induk');
                $main_funds = DB::table('masterlist_dru_allocations AS mda')
                    ->select(
                        'mda.id', 'mda.year', 'mda.program_id', 'mda.bpki_id', 'mda.jenis_agihan as main_fund_name',
                        DB::raw($tabung_induk_sql),
                    )
                    ->where('mda.year', $year)->get();
                $insert_data = [];
                foreach ($main_funds as $main_fund) {
                    $data = [
                        'program_id' => $main_fund->program_id,
                        'bpki_id' => $main_fund->bpki_id,
                        'apply_to_all' => 1,
                        'code' => $main_fund->formula_tabung_induk,
                        'name' => $main_fund->main_fund_name,
                        'is_draft' => 1,
                        'updated_at' => now()
                    ];
                    $insert_data[] = $data;
                }
                $insert_data = collect($insert_data);
                $chunks = $insert_data->chunk(100);

                foreach ($chunks as $main_key => $chunk) {
                    foreach ($chunk as $key => $item) {
                        $dmf = DruMainFund::updateOrCreate(
                            ['code' => $item['code']],
                            $item
                        ); 
                    }
                }
                $allocation_year = MasterlistDruYear::where('year', $year)->first();
                $allocation_year->allocation_main_fund_status = 1;
                $allocation_year->save();
            }
            else if($fund_type == "dist_fund"){
                $dist_funds = DB::table('masterlist_dru_allocations AS mda')
                    ->select(
                        'mda.year', 'mda.tabung_induk', 'mda.ptj_code', 'mda.project', 'mda.sub_project', 'mda.program_id', 'mda.bpki_id', 'mda.main_fund_id', 'mda.jenis_agihan as dist_fund_name',
                        'dmf.id as dmf_id'
                    )
                    ->leftJoin('dru_main_funds AS dmf', function ($join){
                        $join->on('dmf.id', '=', 'mda.tabung_induk');
                    })
                    ->where('mda.year', $year)->get();
                    $insert_data = [];
                foreach ($dist_funds as $dist_fund) {
                    $data = [
                        'title' => $dist_fund->dist_fund_name,
                        'faculty_code' => $dist_fund->ptj_code,
                        'code' => $dist_fund->project,
                        'code_2' => $dist_fund->sub_project,
                        'program_id' => $dist_fund->program_id,
                        'bpki_id' => $dist_fund->bpki_id,
                        'tabung_induk' => $dist_fund->tabung_induk,
                        'is_draft' => 1,
                        'status' => "active",
                        'updated_at' => now()
                    ];
                    $insert_data[] = $data;
                }
                $insert_data = collect($insert_data);
                $chunks = $insert_data->chunk(100);
                foreach ($chunks as $chunk) {
                    foreach ($chunk as $key => $item) {
                        DruDistFund::updateOrCreate(
                            ['faculty_code' => $item['faculty_code'], 'code' => $item['code'], 'code_2' => $item['code_2']],
                            $item
                        ); 
                    }
                }
                $allocation_year = MasterlistDruYear::where('year', $year)->first();
                $allocation_year->allocation_dist_fund_status = 1;
                $allocation_year->save();
            }
        }

        session()->flash('success', "Data is successfully processed");
        return back();
    }

    public function expensesIndex()
    {
        DB::statement("SET SQL_MODE=''");
        $files = DataAttachment::whereModule('expenses')->get();
        $migration_years = MasterlistDruYear::from('masterlist_dru_years as mdeu')->select([
            'mdeu.year','mdeu.main_fund_status',
        ])
        ->orderBy('mdeu.year', 'desc')->get();
        return view('dana-ru.masterlist.expenses', compact('files', 'migration_years'));
    }

    public function expensesImport($id)
    {
        $masterlist = DataAttachment::find($id);
        if($masterlist){
            $mediaItems = $masterlist->getFirstMedia('dataAttachment');
            $filepath = $mediaItems->getPath();
            Excel::import(new DruExpensesImport($masterlist->value1), $filepath);
        }
        else{
            session()->flash('info', "This module will be available soon");
            return back();
        }
        $masterlist->status = 'selected';
        $masterlist->save();
        session()->flash('success', "Masterlist is successfully imported");
        return back();
    }

    public function expensesDelete($id)
    {
        $masterlist = DataAttachment::find($id);
        MasterlistDruExpenses::whereMigration($masterlist->value1)->delete();
        $masterlist->delete();
        session()->flash('success', "Masterlist is successfully deleted");
        return back();
    }

    public function expensesYearIndex($year = null, Request $request)
    {
        $yearOptions = MasterlistDruYear::select('year')->distinct()->pluck('year')->toArray();
        $expenses_year = MasterlistDruYear::from('masterlist_dru_years as mdeu')->select([
            'mdeu.year','mdeu.main_fund_status',
        ])
        ->where('mdeu.year', $year)->first();
        if ($request->ajax()) {
            return DatatableController::expenses($year);
        }
        return view('dana-ru.masterlist.expenses-year', compact('expenses_year', 'yearOptions', 'year'));
    }

    public function expensesProcessData($type, $year){
        if($type == 'project'){
            $projects = DB::table('masterlist_dru_expenses AS mde')
                ->select([
                    'mde.id','mde.jenis_agihan','mde.project','mde.sub_project',
                    DB::raw("CONCAT(mde.project,'.',mde.sub_project) as pusat_kos"),
                    'dmf.id as main_fund_id','dmf.program_id as dmf_program_id'
                ])
                ->leftJoin('dru_main_funds AS dmf', function ($join) use ($year){
                    $join->on('dmf.code', '=', 'mde.tabung_induk')
                        ->where(function ($q) use ($year) {
                            $q->where('dmf.apply_to_all', 1)->orWhere(function ($q2) use ($year) {
                                $q2->where('dmf.apply_to_all', 0)->where('dmf.year', $year);
                            });
                        })
                        ->where('dmf.status', 'active');
                })
                ->where('mde.year', $year)->groupBy('pusat_kos')->get();
            $insert_data = [];
            foreach ($projects as $project) {
                $data = [
                    'year' => $year,
                    'title' => $project->jenis_agihan,
                    'code' => $project->project,
                    'code_2' => $project->sub_project,
                    'program_id' => $project->dmf_program_id,
                    'is_fixed_subproject' => 'Y',
                    'main_fund_id' => $project->main_fund_id,
                    'is_draft' => 1,
                    'updated_at' => now()
                ];
                $insert_data[] = $data;
            }
            $insert_data = collect($insert_data);
            $chunks = $insert_data->chunk(100);
            foreach ($chunks as $chunk) {
                foreach ($chunk as $key => $item) {
                    DruProject::updateOrCreate(
                        ['year' => $year, 'code' => $item['code'], 'code_2' => $item['code_2']],
                        $item
                    ); 
                }
            }
            $expenses_year = MasterlistDruYear::where('year', $year)->first();
            $expenses_year->project_status = 1;
            $expenses_year->save();
        }
        else if($type == 'main_fund'){
            $main_funds = DB::table('masterlist_dru_expenses AS mde')
                ->select(
                    'p.id as program_id', 'mde.tabung_induk as expenses_tabung_induk', 'mda.jenis_agihan as main_fund_name'
                )
                ->leftJoin('masterlist_dru_allocations AS mda', 'mda.tabung_induk', '=', 'mde.tabung_induk')
                ->leftJoin('parameters AS p', function ($join){
                    $join->on('p.code', '=', 'mda.program')->where('p.active', 'Y');
                })
                ->where('mde.year', $year)->groupBy('mde.tabung_induk')->get();
                $insert_data = [];
            foreach ($main_funds as $main_fund) {
                $data = [
                    'program_id' => $main_fund->program_id,
                    'apply_to_all' => 1,
                    'code' => $main_fund->expenses_tabung_induk,
                    'name' => $main_fund->main_fund_name,
                    'is_draft' => 1,
                    'updated_at' => now()
                ];
                $insert_data[] = $data;
            }
            $insert_data = collect($insert_data);
            $chunks = $insert_data->chunk(100);
            foreach ($chunks as $chunk) {
                foreach ($chunk as $key => $item) {
                    DruMainFund::updateOrCreate(
                        ['code' => $item['code']],
                        $item
                    ); 
                }
            }
            $expenses_year = MasterlistDruYear::where('year', $year)->first();
            $expenses_year->main_fund_status = 1;
            $expenses_year->save();
        }
        else if($type == 'expenses'){
            $expenses = MasterlistDruExpenses::
                select(DB::raw('SUM(ABS(amount)) as total_amount'))
                ->where('year', $year)->first();
            $expenses_year = MasterlistDruYear::where('year', $year)->first();
            $expenses_year->total = $expenses->total_amount;
            $expenses_year->amount_status = 1;
            $expenses_year->save();
        }

        session()->flash('success', "Data is successfully processed");
        return back();
    }

    public function updateDruYears(){
        $migration_years = MasterlistDruAllocation::select('year')->distinct()->get();
        foreach ($migration_years as $key => $migration_years) {
            MasterlistDruYear::updateOrCreate(
                ['year' => $migration_years->year],
                [
                    'amount_status' => 0,
                    'project_status' => 0, 
                    'main_fund_status' => 0, 
                    'allocation_main_fund_status' => 0, 
                    'allocation_dist_fund_status' => 0, 
                    'updated_at' => now()
                ]
            );
        }
    }
}
