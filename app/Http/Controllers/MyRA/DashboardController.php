<?php

namespace App\Http\Controllers\MyRA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\GraphMyraTrait;

class DashboardController extends Controller
{
    use GraphMyraTrait;

    public function index(Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if(in_array(user()->role, ['super_admin', 'admin']))$faculty = $request_data->faculty;
        else $faculty = getFacultyByCode(user()->faculty_code)->short_overall;
        $data = $this->overview_data($start_year, $end_year, $faculty);
        return view('myra.index', compact('start_year', 'end_year', 'faculty', 'data'));
    }

    public function staffInfo(Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if(in_array(user()->role, ['super_admin', 'admin']))$faculty = $request_data->faculty;
        else $faculty = getFacultyByCode(user()->faculty_code)->short_overall;
        $data = $this->staff_data($start_year, $end_year, $faculty);
        return view('myra.info-staff', compact('start_year', 'end_year', 'faculty', 'data'));
    }

    public function studentInfo(Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if(in_array(user()->role, ['super_admin', 'admin']))$faculty = $request_data->faculty;
        else $faculty = getFacultyByCode(user()->faculty_code)->short_overall;
        $data = $this->student_data($start_year, $end_year, $faculty);
        return view('myra.info-student', compact('start_year', 'end_year', 'faculty', 'data'));
    }

    public function eMyRA()
    {
        return view('myra.emyra');
    }

    public function sectionB($tabs, Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if(in_array(user()->role, ['super_admin', 'admin']))$faculty = $request_data->faculty;
        else $faculty = getFacultyByCode(user()->faculty_code)->short_overall;
        if ($tabs == 'INVESTIGATOR') {
            $data = $this->sectionB_data_PI($start_year, $end_year, $faculty);
            return view('myra.section-b-pi', compact('start_year', 'end_year', 'faculty', 'data')); 
        }
        elseif ($tabs == 'COHORT') {
            $data = $this->sectionB_data_QC($start_year, $end_year, $faculty);
             return view('myra.section-b-cohort', compact('start_year', 'end_year', 'faculty', 'data')); 
        }
        elseif ($tabs == 'AWARD') { 
            $data = $this->sectionB_data_A($start_year, $end_year, $faculty);
            return view('myra.section-b-award', compact('start_year', 'end_year', 'faculty', 'data')); 
        }
    }

    public function sectionC($tabs, Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if(in_array(user()->role, ['super_admin', 'admin']))$faculty = $request_data->faculty;
        else $faculty = getFacultyByCode(user()->faculty_code)->short_overall;

        if ($tabs == 'PUBLICATION-ALL') {
            $data = $this->sectionC_data_P($start_year, $end_year, $faculty);
            return view('myra.section-c-puboverall', compact('start_year', 'end_year', 'faculty', 'data')); 
        }
        elseif ($tabs == 'PUBLICATION-FACULTY') {
            $data = $this->sectionC_data_P($start_year, $end_year);
             return view('myra.section-c-pubfaculty', compact('start_year', 'end_year', 'faculty', 'data')); 
        }
        elseif ($tabs == 'FUNDING-ALL') { 
            $data = $this->sectionC_data_F($start_year, $end_year, $faculty);
            return view('myra.section-c-fundoverall', compact('start_year', 'end_year', 'faculty', 'data')); 
        }
        elseif ($tabs == 'FUNDING-FACULTY') { 
            $data = $this->sectionC_data_P($start_year, $end_year);
            return view('myra.section-c-fundfaculty', compact('start_year', 'end_year', 'faculty', 'data')); 
        }
    }

    public function sectionD($tabs, Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if(in_array(user()->role, ['super_admin', 'admin']))$faculty = $request_data->faculty;
        else $faculty = getFacultyByCode(user()->faculty_code)->short_overall;
        if ($tabs == 'ABSORPTION') {
            $data = $this->sectionD_data_A($start_year, $end_year, $faculty);
            return view('myra.section-d-absorption', compact('start_year', 'end_year', 'faculty', 'data')); 
        }
        elseif ($tabs == 'ENROLLMENT') { 
            $data = $this->sectionD_data_E($start_year, $end_year, $faculty);
            return view('myra.section-d-enrollment', compact('start_year', 'end_year', 'faculty', 'data')); 
        }
    }

    public function sectionE(Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if(in_array(user()->role, ['super_admin', 'admin']))$faculty = $request_data->faculty;
        else $faculty = getFacultyByCode(user()->faculty_code)->short_overall;
        $data = $this->sectionE_data($start_year, $end_year, $faculty);
        return view('myra.section-e', compact('start_year', 'end_year', 'faculty', 'data'));
    }

    public function sectionF($tabs, Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if(in_array(user()->role, ['super_admin', 'admin']))$faculty = $request_data->faculty;
        else $faculty = getFacultyByCode(user()->faculty_code)->short_overall;
        if ($tabs == 'UNIVERSITY') { 
            $data = $this->sectionF_data($start_year, $end_year, $faculty);
            return view('myra.section-f-university', compact('start_year', 'end_year', 'faculty', 'data')); }
    }

    public function sectionG($tabs, Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if(in_array(user()->role, ['super_admin', 'admin']))$faculty = $request_data->faculty;
        else $faculty = getFacultyByCode(user()->faculty_code)->short_overall;
        if ($tabs == 'STAFFOVERALL') { 
            $data = $this->sectionG_data_S($start_year, $end_year, $faculty);
            return view('myra.section-g-staffoverall', compact('start_year', 'end_year', 'faculty', 'data')); }
        else if ($tabs == 'PROJECTOVERALL') { 
            $data = $this->sectionG_data_P($start_year, $end_year, $faculty);
            return view('myra.section-g-projectoverall', compact('start_year', 'end_year', 'faculty', 'data')); }
    }

    public function sectionH(Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if(in_array(user()->role, ['super_admin', 'admin']))$faculty = $request_data->faculty;
        else $faculty = getFacultyByCode(user()->faculty_code)->short_overall;
        $data = $this->sectionE_data($start_year, $end_year, $faculty);
        return view('myra.section-h', compact('start_year', 'end_year', 'faculty', 'data'));
    }

    public function searching_request(Request $request)
    {
        $start_year = date('Y', strtotime('-6 years'));
        $end_year = date('Y', strtotime('-1 years'));
        $faculty = null;
        if($request->search){
            $start_year = $request->start_year;
            $end_year = $request->end_year;
            $faculty = $request->faculty ?? null;
        }

        return (object)['start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty];
    }
}
