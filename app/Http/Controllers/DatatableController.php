<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DatatableController extends Controller
{
    public static function expenses($year)
    {
        $tabung_induk_sql = getMainFundByFormula('mde.project', 'mde.sub_project', 'MYSQL', 'formula_tabung_induk');
        $query = DB::table('masterlist_dru_expenses AS mde')
            ->select([
                'mde.id',
                DB::raw("CONCAT('Q.',mde.ptj,'.',mde.project,'.',mde.sub_project) as pusat_kos"),
                'mde.jenis_agihan',
                'mde.ptj',
                'mde.project',
                'mde.sub_project',
                'mde.sodo_long as sodo',
                'mde.month',
                'mde.amount',
                DB::raw("FORMAT(mde.amount, 2) as mde_amount"),
                DB::raw($tabung_induk_sql)
                // 'mde.tabung_induk',
            ])->where('mde.year', $year);
        $query = $query->get();
        return DataTables::of($query)
            ->addIndexColumn()
            // ->addColumn('date_start', function ($row) {
            //     return date("d/m/Y", strtotime($row->request_start_date));
            // })
            // ->addColumn('date_end', function ($row) {
            //     return date("d/m/Y", strtotime($row->request_end_date));
            // })
            // ->rawColumns(['date_start', 'date_end'])
            ->make(true);
    }

    public static function mainFund()
    {
        $query = DB::table('dru_main_funds AS dmf')
            ->select([
                'dmf.id as dmf_id',
                'p.code as program',
                'dmf.apply_to_all',
                'dmf.year',
                'dmf.is_draft',
                'dmf.status',
                'dmf.code as dmf_code',
                'dmf.name as dmf_name',
                'dmf.created_at as dmf_created_at',
                'dmf.updated_at as dmf_updated_at',
            ])
            ->leftJoin('parameters AS p', function ($join){
                $join->on('p.id', '=', 'dmf.program_id')->where('p.active', 'Y');
            });
        $query = $query->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('applied_year', function ($row) {
                if($row->apply_to_all) $html = '<div class="bg-gray-600 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">ALL</div>';
                else if($row->year) $html = '<div class="bg-theme-10 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">'.$row->year.'</div>';
                else $html = '';
                return $html;
            })
            ->addColumn('draft', function ($row) {
                if($row->is_draft) $html = '<div class="bg-warning bg-opacity-60 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Draft</div>';
                else $html = '<div class="bg-theme-1 bg-opacity-60 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Done</div>';
                return $html;
            })
            ->addColumn('status_label', function ($row) {
                if($row->status == 'active') $html = '<div class="bg-theme-9 bg-opacity-60 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Active</div>';
                else $html = '<div class="bg-gray-600 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Not Active</div>';
                return $html;
            })
            ->addColumn('action', function ($row) {
                $edit_icon ='<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit w-4 h-4"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>';
                $delete_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash w-4 h-4"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>';
                $html = '<a href="'.route('dana-ru.maintenance.tabung-induk.edit', $row->dmf_id).'" class="btn btn-sm btn-primary ms-2">'.$edit_icon.'</a>';
                $html .= '<button onclick="deleteData('.$row->dmf_id.')" class="btn btn-sm btn-danger ms-2">'.$delete_icon.'</button>';
                return $html;
            })
            ->rawColumns(['applied_year', 'draft', 'status_label', 'action'])
            ->make(true);
    }

    public static function project($year)
    {
        $query = DB::table('dru_projects AS dp')
            ->select([
                'dp.id as dp_id',
                'dp.year as dp_year',
                'dp.title',
                'dp.code as dp_code',
                'dp.code_2 as dp_code_2',
                'p.code as program',
                'dmf.id as dmf_id',
                'dmf.code as dmf_code',
                'dp.is_draft as dp_is_draft',
                'dp.status as dp_status',
                'dmf.is_draft as dmf_is_draft',
                'dmf.status as dmf_status',
                'dp.created_at as dp_created_at',
                'dp.updated_at as dp_updated_at',
            ])
            ->leftJoin('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.id', '=', 'dp.main_fund_id');
            })
            ->leftJoin('parameters AS p', function ($join){
                $join->on('p.id', '=', 'dmf.program_id')->where('p.active', 'Y');
            })
            ->where('dp.year', $year);
        $query = $query->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('draft', function ($row) {
                if($row->dp_is_draft) $html = '<div class="bg-warning bg-opacity-60 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Draft</div>';
                else $html = '<div class="bg-theme-1 bg-opacity-60 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Done</div>';
                return $html;
            })
            ->addColumn('tabung_induk', function ($row) {
                if($row->dmf_id) $html = '<a href="'.route('dana-ru.maintenance.tabung-induk.edit', $row->dmf_id).'" class="btn-link text-theme-10">'.$row->dmf_code.'</a>';
                else $html = '';
                return $html;
            })
            ->addColumn('status_label', function ($row) {
                if($row->dp_status == 'active') $html = '<div class="bg-theme-9 bg-opacity-60 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Active</div>';
                else $html = '<div class="bg-gray-600 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Not Active</div>';
                return $html;
            })
            ->addColumn('action', function ($row) {
                $edit_icon ='<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit w-4 h-4"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>';
                $delete_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash w-4 h-4"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>';
                $html = '<a href="'.route('dana-ru.maintenance.project.edit', $row->dp_id).'" class="btn btn-sm btn-primary ms-2">'.$edit_icon.'</a>';
                $html .= '<button onclick="deleteData('.$row->dp_id.')" class="btn btn-sm btn-danger ms-2">'.$delete_icon.'</button>';
                return $html;
            })
            ->rawColumns(['draft', 'tabung_induk', 'status_label', 'action'])
            ->make(true);
    }

    public static function distFund()
    {
        $query = DB::table('dru_dist_funds AS ddf')
            ->select([
                'ddf.id as ddf_id',
                'ddf.year as ddf_year',
                'ddf.title',
                'ddf.code as ddf_code',
                'ddf.code_2 as ddf_code_2',
                'p.code as program',
                'dmf.id as dmf_id',
                'dmf.code as dmf_code',
                'f.id as f_id',
                'f.code as f_code',
                'ddf.is_draft as ddf_is_draft',
                'ddf.status as ddf_status',
                'ddf.created_at as ddf_created_at',
                'ddf.updated_at as ddf_updated_at',
            ])
            ->leftJoin('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.id', '=', 'ddf.main_fund_id');
            })
            ->leftJoin('parameters AS f', function ($join){
                $join->on('f.code', '=', 'ddf.faculty_code');
            })
            ->leftJoin('parameters AS p', function ($join){
                $join->on('p.id', '=', 'ddf.program_id')->where('p.active', 'Y');
            });
        $query = $query->get();
            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('draft', function ($row) {
                if($row->ddf_is_draft) $html = '<div class="bg-warning bg-opacity-60 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Draft</div>';
                else $html = '<div class="bg-theme-1 bg-opacity-60 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Done</div>';
                return $html;
            })
            ->addColumn('faculty', function ($row) {
                if($row->f_id) $html = '<a href="'.route('dana-ru.maintenance.tabung-induk.edit', $row->f_id).'" class="btn-link text-theme-10">'.$row->f_code.'</a>';
                else $html = '<span>N/A</span>';
                return $html;
            })
            ->addColumn('tabung_induk', function ($row) {
                if($row->dmf_id) $html = '<a href="'.route('dana-ru.maintenance.tabung-induk.edit', $row->dmf_id).'" class="btn-link text-theme-10">'.$row->dmf_code.'</a>';
                else $html = '';
                return $html;
            })
            ->addColumn('status_label', function ($row) {
                if($row->ddf_status == 'active') $html = '<div class="bg-theme-9 bg-opacity-60 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Active</div>';
                else $html = '<div class="bg-gray-600 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Not Active</div>';
                return $html;
            })
            ->addColumn('action', function ($row) {
                $edit_icon ='<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit w-4 h-4"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>';
                $delete_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash w-4 h-4"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>';
                $html = '<a href="'.route('dana-ru.maintenance.tabung-agihan.edit', $row->ddf_id).'" class="btn btn-sm btn-primary ms-2">'.$edit_icon.'</a>';
                $html .= '<button onclick="deleteData('.$row->ddf_id.')" class="btn btn-sm btn-danger ms-2">'.$delete_icon.'</button>';
                return $html;
            })
            ->rawColumns(['draft', 'faculty', 'tabung_induk', 'status_label', 'action'])
            ->make(true);
    }

    public static function mainKpi()
    {
        $query = DB::table('dru_kpi_templates AS dkt')
            ->select([
                'dkt.id',
                'dkt.title',
                'dkt.active',
                'dkt.created_at',
                'dkt.updated_at',
            ])->where('dkt.type', 'main');
        $query = $query->get();
            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('status_label', function ($row) {
                if($row->active == 'Y') $html = '<div class="bg-theme-9 bg-opacity-60 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Active</div>';
                else $html = '<div class="bg-gray-600 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Not Active</div>';
                return $html;
            })
            ->addColumn('action', function ($row) {
                $edit_icon ='<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit w-4 h-4"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>';
                $delete_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash w-4 h-4"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>';
                $html = '<a href="'.route('dana-ru.maintenance.asas-agihan.edit', $row->id).'" class="btn btn-sm btn-primary ms-2">'.$edit_icon.'</a>';
                $html .= '<button onclick="deleteData('.$row->id.')" class="btn btn-sm btn-danger ms-2">'.$delete_icon.'</button>';
                return $html;
            })
            ->rawColumns(['status_label', 'action'])
            ->make(true);
    }

    public static function kpi()
    {
        $query = DB::table('dru_kpi_templates AS dkt')
            ->select([
                'dkt.id',
                'dkt.title',
                'dkt.active',
                'dkt.created_at',
                'dkt.updated_at',
            ])->where('dkt.type', 'kpi');
        $query = $query->get();
            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('status_label', function ($row) {
                if($row->active == 'Y') $html = '<div class="bg-theme-9 bg-opacity-60 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Active</div>';
                else $html = '<div class="bg-gray-600 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Not Active</div>';
                return $html;
            })
            ->addColumn('action', function ($row) {
                $edit_icon ='<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit w-4 h-4"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>';
                $delete_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash w-4 h-4"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>';
                $html = '<a href="'.route('dana-ru.maintenance.kpi.edit', $row->id).'" class="btn btn-sm btn-primary ms-2">'.$edit_icon.'</a>';
                $html .= '<button onclick="deleteData('.$row->id.')" class="btn btn-sm btn-danger ms-2">'.$delete_icon.'</button>';
                return $html;
            })
            ->rawColumns(['status_label', 'action'])
            ->make(true);
    }

    public static function projectSearchList($request)
    {
        $query = DB::table('dru_projects AS dp')
            ->select([
                'dp.id as dp_id',
                'dp.year as dp_year',
                'dp.title',
                'dp.code as dp_code',
                'dp.code_2 as dp_code_2',
                'p.code as program',
                'dmf.id as dmf_id',
                'dmf.code as dmf_code',
                'dp.status as dp_status',
                'dmf.status as dmf_status',
                'dp.created_at as dp_created_at',
                'dp.updated_at as dp_updated_at',
            ])
            ->leftJoin('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.id', '=', 'dp.main_fund_id');
            })
            ->leftJoin('parameters AS p', function ($join){
                $join->on('p.id', '=', 'dmf.program_id')->where('p.active', 'Y');
            })
            ->where('dp.is_draft', 0)->where('dmf.is_draft', 0)->where('dp.status', 'active')->orderBy('dp.year', 'desc')->orderBy('dp.title');
            // $query = $query->where('dp.year', '<=', $request->end_year);
        // if($request->start_year)$query = $query->where('dp.year', '>=', $request->start_year);
        // if($request->end_year)$query = $query->where('dp.year', '<=', $request->end_year);
        $query = $query->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('tabung_induk', function ($row) {
                if($row->dmf_id) $html = '<a href="'.route('dana-ru.maintenance.tabung-induk.edit', $row->dmf_id).'" class="btn-link text-theme-10">'.$row->dmf_code.'</a>';
                else $html = '';
                return $html;
            })
            ->addColumn('checkbox', function($row){
                return '<input type="checkbox" name="projects[]" value="'.$row->dp_id.'">';
            })
            // ->addColumn('action', function ($row) {
            //     // $edit_icon ='<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit w-4 h-4"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>';
            //     // $delete_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash w-4 h-4"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>';
            //     // $html = '<a href="'.route('dana-ru.maintenance.project.edit', $row->dp_id).'" class="btn btn-sm btn-primary ms-2">'.$edit_icon.'</a>';
            //     $html = '';
            //     return $html;
            // })
            ->rawColumns(['checkbox', 'tabung_induk', 'action'])
            ->make(true);
    }
}
