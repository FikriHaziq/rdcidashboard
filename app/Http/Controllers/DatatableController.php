<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;

class DatatableController extends Controller
{
    public static function allocations($year)
    {
        $tabung_induk_sql = getMainFundByFormula('mda.project', 'mda.sub_project', 'MYSQL', 'formula_tabung_induk');
        $query = DB::table('masterlist_dru_allocations AS mda')
            ->select([
                'mda.id',
                DB::raw($tabung_induk_sql),
                'p.code as program',
                'b.code as bpki',
                'mda.ptj',
                'mda.ptj_code',
                DB::raw('RPAD(ptj_code, 7, "0") AS ptj_fullcode'),
                'dmf.id as dmf_id',
                'dmf.code as dmf_code',
                'dmf.is_draft as dmf_is_draft',
                'dmf.status as dmf_status',
                'f.id as f_id',
                'f.original_code as f_original_code',
                'mda.project',
                'mda.sub_project',
                'mda.jenis_agihan',
                'mda.expenditure_type',
                'mda.year',
                'mda.amount',
                DB::raw("FORMAT(mda.amount, 2) as mda_amount"),
            ])
            ->leftJoin('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', DB::raw(getMainFundByFormula('mda.project', 'mda.sub_project', 'MYSQL')));
            })
            ->leftJoin('parameters AS f', function ($join){
                $join->on('f.original_code', '=', 'mda.ptj_code');
            })
            ->leftJoin('parameters AS p', function ($join){
                $join->on('p.id', '=', 'mda.program_id');
            })
            ->leftJoin('parameters AS b', function ($join){
                $join->on('b.id', '=', 'mda.bpki_id');
            })
            ->where('mda.year', $year);
        $query = $query->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('tabung_induk', function ($row) {
                $text_color = 'text-theme-6';
                if($row->dmf_id && $row->dmf_is_draft != 1 && $row->dmf_status == "active") $text_color = '';
                return '<span class="'.$text_color.'">'.$row->formula_tabung_induk.'</span>';
            })
            ->addColumn('faculty_short', function ($row) {
                if($row->f_id) $html = '<a href="'.route('dana-ru.maintenance.faculty.edit', $row->f_id).'" class="btn-link text-theme-10">'.$row->ptj.'</a>';
                else $html = '<a href="'.route('dana-ru.maintenance.faculty.create', ['original_code' => $row->ptj_code, 'short' => $row->ptj]).'" class="btn-link text-theme-6">'.$row->ptj.'</a>';
                return $html;
            })
            ->addColumn('faculty_code', function ($row) {
                if($row->f_id) $html = '<a href="'.route('dana-ru.maintenance.faculty.edit', $row->f_id).'" class="btn-link text-theme-10">'.$row->ptj_fullcode.'</a>';
                else $html = '<a href="'.route('dana-ru.maintenance.faculty.create', ['original_code' => $row->ptj_code, 'short' => $row->ptj]).'" class="btn-link text-theme-6">'.$row->ptj_fullcode.'</a>';
                return $html;
            })
            ->rawColumns(['tabung_induk', 'faculty_short','faculty_code'])
            ->make(true);
    }

    public static function expenses($year)
    {
        $tabung_induk_sql = getMainFundByFormula('mde.project', 'mde.sub_project', 'MYSQL', 'formula_tabung_induk');
        $query = DB::table('masterlist_dru_expenses AS mde')
            ->select([
                'mde.id',
                DB::raw("CONCAT('Q.',RPAD(mde.ptj, 7, '0'),'.',mde.project,'.',mde.sub_project) as pusat_kos"),
                'mde.jenis_agihan',
                'mde.ptj',
                DB::raw('RPAD(mde.ptj, 7, "0") AS ptj_fullcode'),
                'dmf.id as dmf_id',
                'dmf.is_draft as dmf_is_draft',
                'dmf.status as dmf_status',
                'f.id as f_id',
                'f.original_code as f_original_code',
                'mde.project',
                'mde.sub_project',
                'mde.sodo_long as sodo',
                'mde.month',
                'mde.amount',
                DB::raw("FORMAT(mde.amount, 2) as mde_amount"),
                DB::raw($tabung_induk_sql)
                // 'mde.tabung_induk',
            ])
            ->leftJoin('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', 'mde.tabung_induk');
            })
            ->leftJoin('parameters AS f', function ($join){
                $join->on('f.original_code', '=', 'mde.ptj');
            })
            ->where('mde.year', $year);
        $query = $query->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('tabung_induk', function ($row) {
                $text_color = 'text-theme-6';
                if($row->dmf_id && $row->dmf_is_draft != 1 && $row->dmf_status == "active") $text_color = '';
                return '<span class="'.$text_color.'">'.$row->formula_tabung_induk.'</span>';
            })
            ->addColumn('faculty_code', function ($row) {
                if($row->f_id) $html = '<a href="'.route('dana-ru.maintenance.faculty.edit', $row->f_id).'" class="btn-link text-theme-10">'.$row->ptj_fullcode.'</a>';
                else $html = '<a href="'.route('dana-ru.maintenance.faculty.create', ['original_code' => $row->ptj]).'" class="btn-link text-theme-6">'.$row->ptj_fullcode.'</a>';
                return $html;
            })
            ->rawColumns(['tabung_induk','faculty_code'])
            ->make(true);
    }

    public static function mainFund()
    {
        $query = DB::table('dru_main_funds AS dmf')
            ->select([
                'dmf.id as dmf_id',
                'p.code as program',
                'b.code as bpki',
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
            })
            ->leftJoin('parameters AS b', function ($join){
                $join->on('b.id', '=', 'dmf.bpki_id')->where('b.active', 'Y');
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
                'ddf.title',
                'ddf.code as ddf_code',
                'ddf.code_2 as ddf_code_2',
                'ddf.tabung_induk',
                DB::raw('RPAD(ddf.faculty_code, 7, "0") AS ptj_fullcode'),
                'ddf.faculty_code as ddf_faculty_code',
                'p.code as program',
                'b.code as bpki',
                'dmf.id as dmf_id',
                'dmf.code as dmf_code',
                'f.id as f_id',
                'f.code as f_code',
                'f.code as f_original_code',
                'ddf.is_draft as ddf_is_draft',
                'ddf.status as ddf_status',
                'ddf.created_at as ddf_created_at',
                'ddf.updated_at as ddf_updated_at',
            ])
            ->leftJoin('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', 'ddf.tabung_induk');
            })
            ->leftJoin('parameters AS f', function ($join){
                $join->on('f.original_code', '=', 'ddf.faculty_code');
            })
            ->leftJoin('parameters AS p', function ($join){
                $join->on('p.id', '=', 'ddf.program_id')->where('p.active', 'Y');
            })
            ->leftJoin('parameters AS b', function ($join){
                $join->on('b.id', '=', 'ddf.bpki_id')->where('b.active', 'Y');
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
                if($row->f_id) $html = '<a href="'.route('dana-ru.maintenance.faculty.edit', $row->f_id).'" class="btn-link text-theme-10">'.$row->ptj_fullcode.'</a>';
                else $html = '<a href="'.route('dana-ru.maintenance.faculty.create', $row->ddf_faculty_code).'" class="btn-link text-theme-6">'.$row->ptj_fullcode.'</a>';
                return $html;
            })
            ->addColumn('tabung_induk', function ($row) {
                if($row->dmf_id) $html = '<a href="'.route('dana-ru.maintenance.tabung-induk.edit', $row->dmf_id).'" class="btn-link text-theme-10">'.$row->dmf_code.'</a>';
                else $html = '<span class="text-theme-6">'.$row->tabung_induk.'</span>';
                return $html;
            })
            ->addColumn('status_label', function ($row) {
                if($row->ddf_status == 'active') $html = '<div class="bg-theme-9 bg-opacity-60 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Active</div>';
                else if($row->ddf_status == 'not-active') $html = '<div class="bg-gray-600 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Not Active</div>';
                else $html = '<div class="bg-theme-6 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Temporary</div>';
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
                $copy_to_kpi_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-right-up w-4 h-4"><polyline points="10 9 15 4 20 9"></polyline><path d="M4 20h7a4 4 0 0 0 4-4V4"></path></svg>';
                $edit_icon ='<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit w-4 h-4"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>';
                $delete_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash w-4 h-4"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>';
                $html = '<button onclick="copyToKPI(`'.$row->title.'`)" class="btn btn-sm btn-warning-soft ms-2" data-toggle="tooltip" data-tippy-content="Simpan Sebagai KPI">'.$copy_to_kpi_icon.'</button>';
                $html .= '<a href="'.route('dana-ru.maintenance.asas-agihan.edit', $row->id).'" class="btn btn-sm btn-primary ms-2">'.$edit_icon.'</a>';
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

    public static function faculty()
    {
        $query = DB::table('parameters AS f')
            ->select([
                'f.id as f_id',
                'f.code',
                'f.original_code',
                'f.parameter_name as f_name',
                'f.description_1 as f_desc',
                'pf.id as pf_id',
                DB::raw("IFNULL(pf.parameter_name, '') as p_faculty"),
                'f.active',
                'f.created_at',
                'f.updated_at',
            ])
            ->leftJoin('parameters AS pf', function ($join){
                $join->on('pf.id', '=', 'f.parent_id');
            })
            ->whereIn('f.group_id', [1, 2]);
        $query = $query->get();
            return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('main_faculty', function ($row) {
                if($row->pf_id) $html = '<a href="'.route('dana-ru.maintenance.faculty.edit', $row->pf_id).'" class="btn-link text-theme-10">'.$row->p_faculty.'</a>';
                else $html = '<span></span>';
                return $html;
            })
            ->addColumn('status_label', function ($row) {
                if($row->active == 'Y') $html = '<div class="bg-theme-9 bg-opacity-60 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Active</div>';
                else $html = '<div class="bg-gray-600 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Not Active</div>';
                return $html;
            })
            ->addColumn('action', function ($row) {
                $edit_icon ='<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit w-4 h-4"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>';
                $delete_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash w-4 h-4"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>';
                $html = '<a href="'.route('dana-ru.maintenance.faculty.edit', $row->f_id).'" class="btn btn-sm btn-primary ms-2">'.$edit_icon.'</a>';
                $html .= '<button onclick="deleteData('.$row->f_id.')" class="btn btn-sm btn-danger ms-2">'.$delete_icon.'</button>';
                return $html;
            })
            ->rawColumns(['main_faculty', 'status_label', 'action'])
            ->make(true);
    }

    public static function allocationSearchList($request)
    {
        // Base query with the search form filters, shared by the table and the summary
        $base = DB::table('masterlist_dru_allocations AS mda')
            ->leftJoin('parameters AS f', function ($join){
                $join->on('f.original_code', '=', 'mda.ptj_code')->whereIn('f.group_id', [1, 2]);
            })
            ->leftJoin('parameters AS p', function ($join){
                $join->on('p.id', '=', 'mda.program_id');
            })
            ->leftJoin('parameters AS b', function ($join){
                $join->on('b.id', '=', 'mda.bpki_id');
            })
            ->whereIn('mda.type', array_keys(allocationTypes()));
        if($request->title) $base->where('mda.jenis_agihan', 'like', '%'.$request->title.'%');
        if($request->start_year) $base->where('mda.year', '>=', $request->start_year);
        if($request->end_year) $base->where('mda.year', '<=', $request->end_year);
        if($request->program) $base->where('p.code', $request->program);
        if($request->bpki) $base->where('b.code', $request->bpki);
        if($request->ptj) $base->where('mda.ptj', $request->ptj);
        if($request->type) $base->where('mda.type', $request->type);
        if($request->expenditure_type) $base->where('mda.expenditure_type', $request->expenditure_type);
        if($request->code) $base->where('mda.project', 'like', $request->code.'%');
        if($request->code2) $base->where('mda.sub_project', 'like', $request->code2.'%');

        $summary = (clone $base)->selectRaw('COUNT(*) AS records, COALESCE(SUM(mda.amount), 0) AS total, COUNT(DISTINCT mda.ptj) AS ptj, COUNT(DISTINCT mda.jenis_agihan) AS programmes, MIN(mda.year) AS min_year, MAX(mda.year) AS max_year')->first();
        $summary->by_bpki = (clone $base)->selectRaw("COALESCE(b.code, '-') AS code, SUM(mda.amount) AS total")->groupBy('b.code')->orderByDesc('total')->get();

        $tabung_induk_sql = getMainFundByFormula('mda.project', 'mda.sub_project', 'MYSQL', 'formula_tabung_induk');
        $query = (clone $base)
            ->leftJoin('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', DB::raw(getMainFundByFormula('mda.project', 'mda.sub_project', 'MYSQL')));
            })
            ->select([
                'mda.id',
                DB::raw($tabung_induk_sql),
                'p.code as program',
                'b.code as bpki',
                'mda.type',
                'mda.ptj',
                'mda.ptj_code',
                DB::raw('RPAD(mda.ptj_code, 7, "0") AS ptj_fullcode'),
                'dmf.id as dmf_id',
                'dmf.is_draft as dmf_is_draft',
                'dmf.status as dmf_status',
                'f.id as f_id',
                'mda.project',
                'mda.sub_project',
                'mda.jenis_agihan',
                'mda.expenditure_type',
                'mda.year',
                'mda.amount',
            ]);

        $types = allocationTypes();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('tabung_induk', function ($row) {
                // Red when the tabung induk is not registered/active in Tabung Induk maintenance
                $text_color = 'text-theme-6';
                if($row->dmf_id && $row->dmf_is_draft != 1 && $row->dmf_status == "active") $text_color = '';
                return '<span class="fw-medium '.$text_color.'">'.$row->formula_tabung_induk.'</span>';
            })
            ->addColumn('type_label', function ($row) use ($types) {
                return '<span class="alloc-type alloc-type-'.$row->type.'">'.($types[$row->type] ?? 'Jenis '.$row->type).'</span>';
            })
            ->addColumn('faculty_short', function ($row) {
                if($row->f_id) $html = '<a href="'.route('dana-ru.maintenance.faculty.edit', $row->f_id).'" class="btn-link text-theme-10">'.$row->ptj.'</a>';
                else $html = '<a href="'.route('dana-ru.maintenance.faculty.create', ['original_code' => $row->ptj_code, 'short' => $row->ptj]).'" class="btn-link text-theme-6">'.$row->ptj.'</a>';
                return $html.'<div class="text-gray-600 fs-xs">'.$row->ptj_fullcode.'</div>';
            })
            ->addColumn('kod', function ($row) {
                return $row->project.'.'.$row->sub_project;
            })
            ->addColumn('mda_amount', function ($row) {
                return '<span class="'.($row->amount < 0 ? 'text-theme-6' : '').'">'.number_format($row->amount, 2).'</span>';
            })
            ->filterColumn('kod', function ($query, $keyword) {
                $query->whereRaw("CONCAT(mda.project, '.', mda.sub_project) LIKE ?", ['%'.$keyword.'%']);
            })
            ->orderColumn('kod', 'mda.project $1, mda.sub_project $1')
            ->rawColumns(['tabung_induk', 'type_label', 'faculty_short', 'mda_amount'])
            ->with('summary', $summary)
            ->make(true);
    }

    public static function expensesSearchList($request)
    {
        // Small lookup tables are loaded once and matched in PHP, so the 245k-row expenses table is queried alone (uses its indexes)
        // Program & BPKI are not stored on expenses, they come from the tabung induk (dru_main_funds)
        $main_funds = DB::table('dru_main_funds AS dmf')
            ->leftJoin('parameters AS p', function ($join){
                $join->on('p.id', '=', 'dmf.program_id');
            })
            ->leftJoin('parameters AS b', function ($join){
                $join->on('b.id', '=', 'dmf.bpki_id');
            })
            ->select('dmf.id', 'dmf.code', 'dmf.is_draft', 'dmf.status', 'p.code as program', 'b.code as bpki')
            ->get()->keyBy('code');
        $ptj_list = DB::table('parameters')->whereIn('group_id', [1, 2])->get(['id', 'original_code', 'parameter_name'])->keyBy('original_code');

        $base = DB::table('masterlist_dru_expenses AS mde');
        if($request->title) $base->where('mde.jenis_agihan', 'like', '%'.$request->title.'%');
        if($request->start_year) $base->where('mde.year', '>=', $request->start_year);
        if($request->end_year) $base->where('mde.year', '<=', $request->end_year);
        if($request->month) $base->where('mde.month', $request->month);
        if($request->program) $base->whereIn('mde.tabung_induk', $main_funds->where('program', $request->program)->keys());
        if($request->bpki) $base->whereIn('mde.tabung_induk', $main_funds->where('bpki', $request->bpki)->keys());
        if($request->ptj) $base->where('mde.ptj', $request->ptj);
        if($request->sodo) $base->where('mde.sodo_short', $request->sodo);
        if($request->code) $base->where('mde.project', 'like', $request->code.'%');
        if($request->code2) $base->where('mde.sub_project', 'like', $request->code2.'%');

        $summary = (clone $base)->selectRaw('COUNT(*) AS records, COALESCE(SUM(mde.amount), 0) AS total, COUNT(DISTINCT mde.ptj) AS ptj, COUNT(DISTINCT mde.tabung_induk) AS programmes, MIN(mde.year) AS min_year, MAX(mde.year) AS max_year')->first();
        $summary->by_bpki = (clone $base)->selectRaw('mde.tabung_induk, SUM(mde.amount) AS total')->groupBy('mde.tabung_induk')->get()
            ->groupBy(function ($row) use ($main_funds) {
                return $main_funds[$row->tabung_induk]->bpki ?? '-';
            })
            ->map(function ($rows, $code) {
                return (object)['code' => $code, 'total' => round($rows->sum('total'), 2)];
            })
            ->sortByDesc('total')->values();

        $query = (clone $base)->select([
            'mde.id',
            DB::raw("CONCAT('Q.', RPAD(mde.ptj, 7, '0'), '.', mde.project, '.', mde.sub_project) AS pusat_kos"),
            'mde.jenis_agihan',
            'mde.ptj',
            'mde.tabung_induk',
            DB::raw('RPAD(mde.ptj, 7, "0") AS ptj_fullcode'),
            'mde.project',
            'mde.sub_project',
            'mde.sodo_long',
            'mde.year',
            'mde.month',
            'mde.amount',
        ]);

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('period', function ($row) {
                return '<span class="fw-medium">'.date('M', mktime(0, 0, 0, $row->month, 1)).'</span> '.$row->year;
            })
            ->addColumn('tabung_induk_label', function ($row) use ($main_funds) {
                // Red when the tabung induk is not registered/active in Tabung Induk maintenance
                $dmf = $main_funds[$row->tabung_induk] ?? null;
                $text_color = 'text-theme-6';
                if($dmf && $dmf->is_draft != 1 && $dmf->status == "active") $text_color = '';
                return '<span class="fw-medium '.$text_color.'">'.$row->tabung_induk.'</span>';
            })
            ->addColumn('faculty_short', function ($row) use ($ptj_list) {
                $ptj = $ptj_list[$row->ptj] ?? null;
                if($ptj) $html = '<a href="'.route('dana-ru.maintenance.faculty.edit', $ptj->id).'" class="btn-link text-theme-10">'.$ptj->parameter_name.'</a>';
                else $html = '<a href="'.route('dana-ru.maintenance.faculty.create', ['original_code' => $row->ptj]).'" class="btn-link text-theme-6">'.$row->ptj.'</a>';
                return $html.'<div class="text-gray-600 fs-xs">'.$row->ptj_fullcode.'</div>';
            })
            ->addColumn('mde_amount', function ($row) {
                return '<span class="'.($row->amount < 0 ? 'text-theme-6' : '').'">'.number_format($row->amount, 2).'</span>';
            })
            ->filterColumn('pusat_kos', function ($query, $keyword) {
                $query->whereRaw("CONCAT('Q.', RPAD(mde.ptj, 7, '0'), '.', mde.project, '.', mde.sub_project) LIKE ?", ['%'.$keyword.'%']);
            })
            ->orderColumn('period', 'mde.year $1, mde.month $1')
            ->orderColumn('pusat_kos', 'mde.ptj $1, mde.project $1, mde.sub_project $1')
            ->rawColumns(['period', 'tabung_induk_label', 'faculty_short', 'mde_amount'])
            ->with('summary', $summary)
            ->make(true);
    }

    public static function expensesRecord($year, $ptj, $code, $code_2)
    {
        $query = DB::table('masterlist_dru_expenses AS mde')
            ->select([
                'mde.id',
                DB::raw("CONCAT('Q.',RPAD(mde.ptj, 7, '0'),'.',mde.project,'.',mde.sub_project) as pusat_kos"),
                'mde.sodo_long as sodo',
                'mde.month',
                'mde.amount',
                DB::raw("FORMAT(mde.amount, 2) as mde_amount")
            ])
            ->where('mde.year', $year)->where('mde.ptj', $ptj)->where('mde.project', $code)->where('mde.sub_project', $code_2)->orderBy('month');
        $query = $query->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }

    public static function userList()
    {
        $query = User::latest()->get();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('applied_year', function ($row) {
                if($row->apply_to_all) $html = '<div class="bg-gray-600 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">ALL</div>';
                else if($row->year) $html = '<div class="bg-theme-10 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">'.$row->year.'</div>';
                else $html = '';
                return $html;
            })
            ->addColumn('role_label', function ($row) {
                $html = '';
                $role = json_decode($row->role_radis ?? '[]');
                if(count($role) > 0) {
                    if($role[0] == 'STAF') $html = '<div class="bg-gray-600 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">'.$role[0].'</div>';
                    else $html = '<div class="bg-theme-10 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">'.$role[0].'</div>';
                }
                return $html;
            })
            ->addColumn('system_role_label', function ($row) {
                if(in_array($row->role, ['super_admin', 'admin'])) $html = '<div class="bg-theme-1 bg-opacity-60 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">'.$row->role.'</div>';
                else $html = '<div class="bg-warning bg-opacity-60 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">'.$row->role.'</div>';
                return $html;
            })
            ->addColumn('status_label', function ($row) {
                if($row->status == 'verified') $html = '<div class="bg-theme-9 bg-opacity-60 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Verified</div>';
                else $html = '<div class="bg-gray-600 rounded-pill justify-content-center fs-xs text-white d-flex align-items-center px-2 ms-1">Pending</div>';
                return $html;
            })
            ->addColumn('action', function ($row) {
                $edit_icon ='<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit w-4 h-4"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>';
                $delete_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash w-4 h-4"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>';
                $html = '<a href="'.route('dana-ru.maintenance.user.edit', $row->id).'" class="btn btn-sm btn-primary ms-2">'.$edit_icon.'</a>';
                return $html;
            })
            ->rawColumns(['role_label', 'system_role_label', 'status_label', 'action'])
            ->make(true);
    }

    public static function cadanganAgihanSearchList($request)
    {
        // One row per plan form (programme proposed in a distribution plan)
        $base = DB::table('dru_distribution_plan_forms AS plan_form')
            ->join('dru_distribution_plans AS plan', 'plan.id', '=', 'plan_form.distribution_plan_id')
            ->leftJoin('parameters AS mrun', 'mrun.id', '=', 'plan_form.mrun')
            ->leftJoin('parameters AS bpki', 'bpki.id', '=', 'plan_form.bpki')
            ->leftJoin('parameters AS ptj', 'ptj.id', '=', 'plan_form.ptj_id')
            ->leftJoin('dru_dist_funds AS ddf', 'ddf.id', '=', 'plan_form.project_id')
            ->whereIn('plan.type', array_keys(planTypes()));
        if($request->title){
            $base->where(function ($query) use ($request) {
                $query->where('ddf.title', 'like', '%'.$request->title.'%')
                    ->orWhere('plan_form.reference_no', 'like', '%'.$request->title.'%')
                    ->orWhereExists(function ($member) use ($request) {
                        $member->select(DB::raw(1))->from('dru_members AS m')
                            ->whereColumn('m.distribution_plan_form_id', 'plan_form.id')
                            ->where(function ($m) use ($request) {
                                $m->where('m.name', 'like', '%'.$request->title.'%')->orWhere('m.email', 'like', '%'.$request->title.'%');
                            });
                    });
            });
        }
        if($request->start_year) $base->where('plan.year', '>=', $request->start_year);
        if($request->end_year) $base->where('plan.year', '<=', $request->end_year);
        if($request->type) $base->where('plan.type', $request->type);
        if($request->status) $base->where('plan.status', $request->status);
        if($request->approved) $base->where('plan_form.approved', $request->approved);
        if($request->program) $base->where('mrun.code', $request->program);
        if($request->bpki) $base->where('bpki.code', $request->bpki);
        if($request->ptj) $base->where('plan_form.ptj_id', $request->ptj);
        if($request->code) $base->where('ddf.code', 'like', $request->code.'%');
        if($request->code2) $base->where('ddf.code_2', 'like', $request->code2.'%');

        $summary = (clone $base)->selectRaw('COUNT(*) AS records, COALESCE(SUM(plan_form.amount), 0) AS total, COUNT(DISTINCT plan_form.ptj_id) AS ptj, COUNT(DISTINCT plan_form.project_id) AS programmes, MIN(plan.year) AS min_year, MAX(plan.year) AS max_year')->first();
        $summary->by_bpki = (clone $base)->selectRaw("COALESCE(bpki.code, '-') AS code, SUM(plan_form.amount) AS total")->groupBy('bpki.code')->orderByDesc('total')->get();

        $query = (clone $base)
            ->leftJoin('statuses AS status', 'status.id', '=', 'plan.status')
            ->select([
                'plan_form.id',
                'plan_form.reference_no',
                'plan_form.amount',
                'plan_form.approved',
                'plan.id AS plan_id',
                'plan.year',
                'plan.type',
                'plan.status',
                'status.name AS status_name',
                'status.description AS status_description',
                'mrun.code AS program',
                'bpki.code AS bpki',
                'ptj.parameter_name AS ptj',
                'ptj.original_code AS ptj_code',
                'ddf.title AS project_title',
                'ddf.code AS project_code',
                'ddf.code_2 AS project_code_2',
                DB::raw("(SELECT CONCAT(m.name, '|', m.email) FROM dru_members AS m WHERE m.distribution_plan_form_id = plan_form.id AND m.type = 'leader' LIMIT 1) AS pic"),
            ]);

        $types = planTypes();
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('type_label', function ($row) use ($types) {
                return '<span class="alloc-type plan-type-'.$row->type.'">'.($types[$row->type] ?? '-').'</span>';
            })
            ->addColumn('status_label', function ($row) {
                $label = $row->status_description ?: ($row->status_name ?: 'Draft');
                return '<span class="alloc-type plan-status-'.($row->status ?: 1).'">'.$label.'</span>';
            })
            ->addColumn('project', function ($row) {
                if(!$row->project_title) return '-';
                return '<div class="fw-medium">'.e($row->project_title).'</div><div class="text-gray-600 fs-xs">'.$row->project_code.'.'.$row->project_code_2.'</div>';
            })
            ->addColumn('pic_label', function ($row) {
                if(!$row->pic) return '-';
                [$name, $email] = array_pad(explode('|', $row->pic, 2), 2, '');
                return '<div>'.e($name).'</div><div class="text-gray-600 fs-xs">'.e($email).'</div>';
            })
            ->addColumn('ptj_label', function ($row) {
                return ($row->ptj ?? '-').'<div class="text-gray-600 fs-xs">'.$row->ptj_code.'</div>';
            })
            ->addColumn('ref_label', function ($row) {
                $approved = $row->approved == 'Y' ? '<i data-feather="check-circle" class="w-4 h-4 text-theme-9 ms-1" title="Approved"></i>' : '';
                return '<span class="fw-medium">'.($row->reference_no ?: '-').'</span>'.$approved;
            })
            ->addColumn('pf_amount', function ($row) {
                return '<span class="'.($row->amount < 0 ? 'text-theme-6' : '').'">'.number_format($row->amount, 2).'</span>';
            })
            ->addColumn('action', function ($row) {
                return '<a href="'.route('dana-ru.cadangan-agihan.form', ['year' => $row->year, 'id' => $row->id, 'view' => true]).'" class="btn btn-sm btn-filter-back" title="View"><i data-feather="eye" class="w-4 h-4"></i></a>';
            })
            ->filterColumn('project', function ($query, $keyword) {
                $query->whereRaw("CONCAT(ddf.title, ' ', ddf.code, '.', ddf.code_2) LIKE ?", ['%'.$keyword.'%']);
            })
            ->orderColumn('project', 'ddf.title $1')
            ->rawColumns(['type_label', 'status_label', 'project', 'pic_label', 'ptj_label', 'ref_label', 'pf_amount', 'action'])
            ->with('summary', $summary)
            ->make(true);
    }
}
