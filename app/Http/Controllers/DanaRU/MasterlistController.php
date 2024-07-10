<?php

namespace App\Http\Controllers\DanaRU;

use App\Http\Controllers\Controller;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DruAllocationImport;
use App\Imports\DruExpensesImport;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Http\Request;
use App\Models\MasterList\MasterlistDruExpenses;
use App\Models\MasterList\MasterlistDruExpensesYear;
use App\Models\DanaRU\DruProject;
use App\Models\DanaRU\DruMainFund;
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
        return view('dana-ru.masterlist.allocation', compact('files'));
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

    public function expensesIndex()
    {
        DB::statement("SET SQL_MODE=''");
        $files = DataAttachment::whereModule('expenses')->get();
        $migration_years = MasterlistDruExpensesYear::from('masterlist_dru_expenses_years as mdeu')->select([
            'mdeu.year','mdeu.amount_status','mdeu.project_status','mdeu.main_fund_status',
            DB::raw("(SELECT COUNT(id) FROM dru_projects AS dp WHERE dp.year=mdeu.year AND dp.is_draft=1) AS draft_project"),
            DB::raw("(SELECT COUNT(id) FROM dru_projects AS dp WHERE dp.year=mdeu.year limit 1) AS project_count"),
        ])
        ->orderBy('mdeu.year', 'desc')->get();
        // dd($migration_years);
        return view('dana-ru.masterlist.expenses', compact('files', 'migration_years'));
    }

    public function expensesImport($id)
    {
        $masterlist = DataAttachment::find($id);
        if($masterlist){
            $mediaItems = $masterlist->getFirstMedia('dataAttachment');
            $filepath = $mediaItems->getPath();
            Excel::import(new DruExpensesImport($masterlist->value1), $filepath);
            $this->updateExpensesYear($masterlist->value1);
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
        $this->updateExpensesYear($masterlist->value1);
        MasterlistDruExpenses::whereMigration($masterlist->value1)->delete();
        $masterlist->delete();
        session()->flash('success', "Masterlist is successfully deleted");
        return back();
    }

    public function expensesYearIndex($year = null, Request $request)
    {
        $yearOptions = MasterlistDruExpensesYear::select('year')->distinct()->pluck('year')->toArray();
        $expenses_year = MasterlistDruExpensesYear::from('masterlist_dru_expenses_years as mdeu')->select([
            'mdeu.year','mdeu.amount_status','mdeu.project_status','mdeu.main_fund_status',
        DB::raw("(SELECT COUNT(id) FROM dru_projects AS dp WHERE dp.year=mdeu.year AND dp.is_draft=1) draft_project"),
            DB::raw("(SELECT COUNT(id) FROM dru_projects AS dp WHERE dp.year=mdeu.year limit 1) AS project_count"),
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
            $expenses_year = MasterlistDruExpensesYear::where('year', $year)->first();
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
            $expenses_year = MasterlistDruExpensesYear::where('year', $year)->first();
            $expenses_year->main_fund_status = 1;
            $expenses_year->save();
        }
        else if($type == 'expenses'){
            $expenses = MasterlistDruExpenses::
                select(DB::raw('SUM(ABS(amount)) as total_amount'))
                ->where('year', $year)->first();
            $expenses_year = MasterlistDruExpensesYear::where('year', $year)->first();
            $expenses_year->total = $expenses->total_amount;
            $expenses_year->amount_status = 1;
            $expenses_year->save();
        }

        session()->flash('success', "Data is successfully processed");
        return back();
    }

    public function updateExpensesYear($migration_code){
        $migration_years = MasterlistDruExpenses::select('year')->whereMigration($migration_code)->distinct()->get();
        foreach ($migration_years as $key => $migration_years) {
            MasterlistDruExpensesYear::updateOrCreate(
                ['year' => $migration_years->year],
                ['amount_status' => 0, 'project_status' => 0, 'main_fund_status' => 0, 'updated_at' => now()]
            );
        }
    }
}
