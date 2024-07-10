<?php

namespace App\Http\Controllers\DanaRU;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DanaRU\DruMainFund;
use App\Models\DanaRU\DruDistFund;
use App\Models\DanaRU\DruProject;
use App\Models\DanaRU\DruKpiTemplate;
use App\Models\MasterList\MasterlistDruExpensesYear;
use App\Http\Controllers\DatatableController;

class MaintenanceController extends Controller
{
    public function tabungIndukIndex(Request $request){
        if ($request->ajax()) {
            return DatatableController::mainFund();
        }
        return view('dana-ru.maintenance.main-fund.index');
    }

    public function tabungIndukCreate(){
        return view('dana-ru.maintenance.main-fund.create');
    }

    public function tabungIndukStore(Request $request){
        $request->validate([
            'program_id' => 'required',
            'code' => 'required|unique:dru_main_funds,code',
            'name' => 'required',
            'status' => 'required',
        ],
        [
            'program_id.required' => 'Sila pilih program utama.',
            'code.required' => 'Sila masukkan kod.',
            'code.unique' => 'Kod ini telah didaftar.',
            'name.required' => 'Sila masukkan deskripsi.',
            'status.required' => 'Sila pilih status.',
        ]);
        $main_fund = new DruMainFund;
        $main_fund->program_id = $request->program_id;
        $main_fund->code = $request->code;
        $main_fund->name = $request->name;
        $main_fund->apply_to_all = 1;
        $main_fund->is_draft = $request->submit_btn;
        $main_fund->status = $request->status;
        $main_fund->save();
        session()->flash('success', "Tabung Induk telah berjaya disimpan.");
        return redirect()->route('dana-ru.maintenance.tabung-induk');
    }

    public function tabungIndukEdit($id){
        $main_fund = DruMainFund::find($id);
        return view('dana-ru.maintenance.main-fund.edit', compact('main_fund'));
    }

    public function tabungIndukUpdate($id, Request $request){
        $request->validate([
            'program_id' => 'required',
            'code' => 'required|unique:dru_main_funds,code,'.$id,
            'name' => 'required',
            'status' => 'required',
        ],
        [
            'program_id.required' => 'Sila pilih program utama.',
            'code.required' => 'Sila masukkan kod.',
            'code.unique' => 'Kod ini telah didaftar.',
            'name.required' => 'Sila masukkan deskripsi.',
            'status.required' => 'Sila pilih status.',
        ]);
        $main_fund = DruMainFund::find($id);
        $main_fund->program_id = $request->program_id;
        $main_fund->code = $request->code;
        $main_fund->name = $request->name;
        $main_fund->apply_to_all = 1;
        $main_fund->is_draft = $request->submit_btn;
        $main_fund->status = $request->status;
        $main_fund->save();
        session()->flash('success', "Tabung Induk telah berjaya disimpan.");
        return redirect()->route('dana-ru.maintenance.tabung-induk');
    }

    public function tabungIndukDelete($id){
        $main_fund = DruMainFund::find($id)->delete();
        session()->flash('success', "Tabung Induk telah berjaya dipadam.");
        return redirect()->route('dana-ru.maintenance.tabung-induk');
    }

    public function tabungIndukActivateAll(){
        DruMainFund::whereIsDraft(1)->whereNotNull('program_id')
        ->chunkById(100, function ($chunks) {
            foreach ($chunks as $chunk) {
                DruMainFund::where('id', $chunk->id)
                    ->update(['is_draft' => 0]);
            }
        });
        session()->flash('success', "Data is successfully activated");
        return back();
    }

    public function projectIndex(Request $request, $year = null){
        $yearData = MasterlistDruExpensesYear::select('year')->distinct()->first();
        $yearOptions = [];
        for ($i=$yearData->year; $i <= date('Y'); $i++) { 
            array_push($yearOptions, $i);
        }
        if(!$year) $year = $yearOptions[count($yearOptions)-1] ?? date('Y');
        if ($request->ajax()) {
            return DatatableController::project($year);
        }
        return view('dana-ru.maintenance.project.index', compact('year', 'yearOptions'));
    }

    public function projectCreate($year = null){
        $yearData = MasterlistDruExpensesYear::select('year')->distinct()->first();
        $yearOptions = [];
        for ($i=$yearData->year; $i <= date('Y'); $i++) { 
            array_push($yearOptions, $i);
        }
        if(!$year) $year = $yearOptions[count($yearOptions)-1] ?? date('Y');
        return view('dana-ru.maintenance.project.create', compact('year', 'yearOptions'));
    }

    public function projectStore(Request $request){
        $request->validate([
            'code' => 'required',
            'code_2' => 'required',
            'title' => 'required',
            'status' => 'required',
        ],
        [
            'code.required' => 'Sila masukkan kod projek.',
            'code_2.required' => 'Sila masukkan kod subprojek.',
            'title.required' => 'Sila nama projek.',
            'status.required' => 'Sila pilih status.',
        ]);
        $check_project = DruProject::where('year', $request->year)->where('code', $request->code)->where('code_2', $request->code_2)->where('status', 'active')->first();
        if($check_project){
            session()->flash('error', "Projek ini telah berdaftar.");
            return redirect()->back()->withInput($request->input());
        }
        $main_fund_code = getMainFundByFormula($request->code, $request->code_2);

        $main_fund = DruMainFund::whereCode($main_fund_code)->whereStatus('active')->first();
        if(!$main_fund){
            $main_fund = new DruMainFund;
            $main_fund->apply_to_all = 1; 
            $main_fund->is_draft = 1; 
            $main_fund->code = $main_fund_code; 
            $main_fund->save();
        }
        $project = new DruProject;
        $project->program_id = $main_fund->program_id ?? null;
        $project->main_fund_id = $main_fund->id;
        $project->code = $request->code;
        $project->year = $request->year;
        $project->code_2 = $request->code_2;
        $project->title = $request->title;
        $project->is_fixed_subproject = 'Y';
        $project->type = 'single';
        $project->is_draft = $request->submit_btn;
        $project->status = $request->status;
        $project->save();
        session()->flash('success', "Projek telah berjaya disimpan.");
        return redirect()->route('dana-ru.maintenance.project', $request->year);
    }

    public function projectEdit($id){
        $project = DruProject::find($id);
        return view('dana-ru.maintenance.project.edit', compact('project'));
    }

    public function projectUpdate($id, Request $request){
        $request->validate([
            'code' => 'required',
            'code_2' => 'required',
            'title' => 'required',
            'status' => 'required',
        ],
        [
            'code.required' => 'Sila masukkan kod projek.',
            'code_2.required' => 'Sila masukkan kod subprojek.',
            'title.required' => 'Sila nama projek.',
            'status.required' => 'Sila pilih status.',
        ]);
        $check_project = DruProject::where('year', $request->year)->where('code', $request->code)->where('id', '!=', $id)->where('code_2', $request->code_2)->where('status', 'active')->first();
        if($check_project){
            session()->flash('error', "Projek ini telah berdaftar.");
            return redirect()->back()->withInput($request->input());
        }
        $main_fund_code = getMainFundByFormula($request->code, $request->code_2);

        $main_fund = DruMainFund::whereCode($main_fund_code)->whereStatus('active')->first();
        if(!$main_fund){
            $main_fund = new DruMainFund;
            $main_fund->apply_to_all = 1; 
            $main_fund->is_draft = 1; 
            $main_fund->code = $main_fund_code; 
            $main_fund->save();
        }
        $project = DruProject::find($id);
        $project->program_id = $main_fund->program_id ?? null;
        $project->main_fund_id = $main_fund->id;
        $project->code = $request->code;
        $project->year = $request->year;
        $project->code_2 = $request->code_2;
        $project->title = $request->title;
        $project->is_fixed_subproject = 'Y';
        $project->type = 'single';
        $project->is_draft = $request->submit_btn;
        $project->status = $request->status;
        $project->save();
        session()->flash('success', "Projek telah berjaya disimpan.");
        return redirect()->route('dana-ru.maintenance.project', $request->year);
    }

    public function projectDelete($id){
        $main_fund = DruProject::find($id);
        $year = $main_fund->year;
        $main_fund->delete();
        session()->flash('success', "Tabung Induk telah berjaya dipadam.");
        return redirect()->route('dana-ru.maintenance.project', $year);
    }

    public function projectActivateAll($year){
        DruProject::from('dru_projects as dp')
        ->select('dp.id as dp_id')
        ->leftJoin('dru_main_funds AS dmf', 'dmf.id', '=', 'dp.main_fund_id')
        ->where('dp.is_draft', 1)->whereNotNull('dmf.program_id')->where('dmf.is_draft', 0)->where('dp.year', $year)
        ->chunkById(100, function ($chunks) {
            foreach ($chunks as $chunk) {
                DruProject::where('id', $chunk->dp_id)
                    ->update(['is_draft' => 0]);
            }
        }, 'dp_id');
        session()->flash('success', "Data is successfully activated");
        return back();
    }

    public function projectDuplicate($from_year, $to_year){
        DruProject::where('year',$from_year)
        ->chunkById(100, function ($chunks) use ($to_year){
            foreach ($chunks as $chunk) {
                DruProject::updateOrCreate(
                    ['year' => $to_year, 'code' => $chunk->code, 'code_2' => $chunk->code_2],
                    [
                        'year' => $to_year, 
                        'title' => $chunk->title, 
                        'code' => $chunk->code, 
                        'code_2' => $chunk->code_2,
                        'program_id' => $chunk->program_id,
                        'is_fixed_subproject' => $chunk->is_fixed_subproject,
                        'type' => $chunk->type,
                        'main_fund_id' => $chunk->main_fund_id,
                        'status' => $chunk->status,
                        'is_draft' => $chunk->is_draft,
                    ]
                ); 
            }
        });
        session()->flash('success', "Data is successfully activated");
        return redirect()->route('dana-ru.maintenance.project', $to_year);
    }

    public function tabungAgihanIndex(Request $request){
        if ($request->ajax()) {
            return DatatableController::distFund();
        }
        return view('dana-ru.maintenance.dist-fund.index');
    }

    public function tabungAgihanCreate(){
        return view('dana-ru.maintenance.dist-fund.create');
    }

    public function tabungAgihanStore(Request $request){
        // $request->validate([
        //     'program_id' => 'required',
        //     'code' => 'required|unique:dru_main_funds,code',
        //     'name' => 'required',
        //     'status' => 'required',
        // ],
        // [
        //     'program_id.required' => 'Sila pilih program utama.',
        //     'code.required' => 'Sila masukkan kod.',
        //     'code.unique' => 'Kod ini telah didaftar.',
        //     'name.required' => 'Sila masukkan deskripsi.',
        //     'status.required' => 'Sila pilih status.',
        // ]);
        // $main_fund = new DruMainFund;
        // $main_fund->program_id = $request->program_id;
        // $main_fund->code = $request->code;
        // $main_fund->name = $request->name;
        // $main_fund->apply_to_all = 1;
        // $main_fund->is_draft = $request->submit_btn;
        // $main_fund->status = $request->status;
        // $main_fund->save();
        session()->flash('success', "Tabung agihan telah berjaya disimpan.");
        return redirect()->route('dana-ru.maintenance.tabung-agihan');
    }

    public function tabungAgihanEdit($id){
        $dist_fund = DruDistFund::find($id);
        return view('dana-ru.maintenance.dist-fund.edit', compact('dist_fund'));
    }

    public function tabungAgihanUpdate($id, Request $request){
        // $request->validate([
        //     'program_id' => 'required',
        //     'code' => 'required|unique:dru_main_funds,code,'.$id,
        //     'name' => 'required',
        //     'status' => 'required',
        // ],
        // [
        //     'program_id.required' => 'Sila pilih program utama.',
        //     'code.required' => 'Sila masukkan kod.',
        //     'code.unique' => 'Kod ini telah didaftar.',
        //     'name.required' => 'Sila masukkan deskripsi.',
        //     'status.required' => 'Sila pilih status.',
        // ]);
        // $main_fund = DruMainFund::find($id);
        // $main_fund->program_id = $request->program_id;
        // $main_fund->code = $request->code;
        // $main_fund->name = $request->name;
        // $main_fund->apply_to_all = 1;
        // $main_fund->is_draft = $request->submit_btn;
        // $main_fund->status = $request->status;
        // $main_fund->save();
        session()->flash('success', "Tabung Agihan telah berjaya disimpan.");
        return redirect()->route('dana-ru.maintenance.tabung-agihan');
    }

    public function tabungAgihanDelete($id){
        // $main_fund = DruMainFund::find($id)->delete();
        session()->flash('success', "Tabung Agihan telah berjaya dipadam.");
        return redirect()->route('dana-ru.maintenance.tabung-agihan');
    }

    public function tabungAgihanActivateAll(){
        // DruMainFund::whereIsDraft(1)->whereNotNull('program_id')
        // ->chunkById(100, function ($chunks) {
        //     foreach ($chunks as $chunk) {
        //         DruMainFund::where('id', $chunk->id)
        //             ->update(['is_draft' => 0]);
        //     }
        // });
        session()->flash('success', "Data is successfully activated");
        return back();
    }
    
    public function asasAgihanIndex(Request $request){
        if ($request->ajax()) {
            return DatatableController::mainKpi();
        }
        return view('dana-ru.maintenance.main-kpi.index');
    }

    public function asasAgihanCreate(){
        return view('dana-ru.maintenance.main-kpi.create');
    }

    public function asasAgihanStore(Request $request){
        $request->validate([
            'title' => 'required',
        ],
        [
            'title.required' => 'Sila isi tajuk.',
        ]);
        $main_kpi = new DruKpiTemplate;
        $main_kpi->title = $request->title;
        $main_kpi->type = "main";
        $main_kpi->display_level = "all";
        $main_kpi->active = $request->active;
        $main_kpi->save();
        session()->flash('success', "Asas agihan telah berjaya disimpan.");
        return redirect()->route('dana-ru.maintenance.asas-agihan');
    }

    public function asasAgihanEdit($id){
        $main_kpi = DruKpiTemplate::find($id);
        return view('dana-ru.maintenance.main-kpi.edit', compact('main_kpi'));
    }

    public function asasAgihanUpdate($id, Request $request){
        $request->validate([
            'title' => 'required',
        ],
        [
            'title.required' => 'Sila isi tajuk.',
        ]);
        $main_kpi = DruKpiTemplate::find($id);
        $main_kpi->title = $request->title;
        $main_kpi->active = $request->active;
        $main_kpi->updated_at = now();
        $main_kpi->save();
        session()->flash('success', "Asas Agihan telah berjaya disimpan.");
        return redirect()->route('dana-ru.maintenance.asas-agihan');
    }

    public function asasAgihanDelete($id){
        $main_kpi = DruKpiTemplate::find($id)->delete();
        session()->flash('success', "Asas Agihan telah berjaya dipadam.");
        return redirect()->route('dana-ru.maintenance.asas-agihan');
    }

    public function kpiIndex(Request $request){
        if ($request->ajax()) {
            return DatatableController::kpi();
        }
        return view('dana-ru.maintenance.kpi.index');
    }

    public function kpiCreate(){
        return view('dana-ru.maintenance.kpi.create');
    }

    public function kpiStore(Request $request){
        $request->validate([
            'title' => 'required',
        ],
        [
            'title.required' => 'Sila isi tajuk.',
        ]);
        $kpi = new DruKpiTemplate;
        $kpi->title = $request->title;
        $kpi->type = "kpi";
        $kpi->display_level = "all";
        $kpi->active = $request->active;
        $kpi->save();
        session()->flash('success', "KPI telah berjaya disimpan.");
        return redirect()->route('dana-ru.maintenance.kpi');
    }

    public function kpiEdit($id){
        $kpi = DruKpiTemplate::find($id);
        return view('dana-ru.maintenance.kpi.edit', compact('kpi'));
    }

    public function kpiUpdate($id, Request $request){
        $request->validate([
            'title' => 'required',
        ],
        [
            'title.required' => 'Sila isi tajuk.',
        ]);
        $kpi = DruKpiTemplate::find($id);
        $kpi->title = $request->title;
        $kpi->active = $request->active;
        $kpi->updated_at = now();
        $kpi->save();
        session()->flash('success', "KPI telah berjaya disimpan.");
        return redirect()->route('dana-ru.maintenance.kpi');
    }

    public function kpiDelete($id){
        $kpi = DruKpiTemplate::find($id)->delete();
        session()->flash('success', "KPI telah berjaya dipadam.");
        return redirect()->route('dana-ru.maintenance.kpi');
    }
}
