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
        else {
            $request_data->faculty = user()->faculty_code;
            if(!$request_data->school)$request_data->school = user()->school_code;
        }
        $data = $this->overview_data($request_data);
        $faculty = $request_data->faculty;
        $school = $request_data->school;
        return view('myra.index', compact('start_year', 'end_year', 'faculty', 'school', 'data'));
    }

    public function staffInfo(Request $request)
    {
        // dd(user());
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if(in_array(user()->role, ['super_admin', 'admin']))$faculty = $request_data->faculty;
        else {
            $request_data->faculty = user()->faculty_code;
            if(!$request_data->school)$request_data->school = user()->school_code;
        }
        $data = $this->staff_data($request_data);
        $faculty = $request_data->faculty;
        $school = $request_data->school;
        return view('myra.info-staff', compact('start_year', 'end_year', 'faculty', 'school', 'data'));
    }

    public function studentInfo(Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if(in_array(user()->role, ['super_admin', 'admin']))$faculty = $request_data->faculty;
        else {
            $request_data->faculty = user()->faculty_code;
            if(!$request_data->school)$request_data->school = user()->school_code;
        }
        $data = $this->student_data($request_data);
        $faculty = $request_data->faculty;
        $school = $request_data->school;
        return view('myra.info-student', compact('start_year', 'end_year', 'faculty', 'school', 'data'));
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
        else {
            $request_data->faculty = user()->faculty_code;
            if(!$request_data->school)$request_data->school = user()->school_code;
        }
        $faculty = $request_data->faculty;
        $school = $request_data->school;
        if ($tabs == 'INVESTIGATOR') {
            $data = $this->sectionB_data_PI($request_data);
            return view('myra.section-b-pi', compact('start_year', 'end_year', 'faculty', 'school', 'data')); 
        }
        elseif ($tabs == 'COHORT') {
            $data = $this->sectionB_data_QC($request_data);
             return view('myra.section-b-cohort', compact('start_year', 'end_year', 'faculty', 'school', 'data')); 
        }
        elseif ($tabs == 'AWARD') { 
            $data = $this->sectionB_data_A($request_data);
            return view('myra.section-b-award', compact('start_year', 'end_year', 'faculty', 'school', 'data')); 
        }
    }

    public function sectionC($tabs, Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if(in_array(user()->role, ['super_admin', 'admin']))$faculty = $request_data->faculty;
        else {
            $request_data->faculty = user()->faculty_code;
            if(!$request_data->school)$request_data->school = user()->school_code;
        }
        $faculty = $request_data->faculty;
        $school = $request_data->school;
        if ($tabs == 'PUBLICATION-ALL') {
            $data = $this->sectionC_data_P($request_data);
            return view('myra.section-c-puboverall', compact('start_year', 'end_year', 'faculty', 'school', 'data')); 
        }
        elseif ($tabs == 'PUBLICATION-FACULTY') {
            $data = $this->sectionC_data_P($start_year, $end_year);
             return view('myra.section-c-pubfaculty', compact('start_year', 'end_year', 'faculty', 'school', 'data')); 
        }
        elseif ($tabs == 'FUNDING-ALL') { 
            $data = $this->sectionC_data_F($request_data);
            return view('myra.section-c-fundoverall', compact('start_year', 'end_year', 'faculty', 'school', 'data')); 
        }
        elseif ($tabs == 'FUNDING-FACULTY') { 
            $data = $this->sectionC_data_P($start_year, $end_year);
            return view('myra.section-c-fundfaculty', compact('start_year', 'end_year', 'faculty', 'school', 'data')); 
        }
    }

    public function sectionD($tabs, Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if(in_array(user()->role, ['super_admin', 'admin']))$faculty = $request_data->faculty;
        else {
            $request_data->faculty = user()->faculty_code;
            if(!$request_data->school)$request_data->school = user()->school_code;
        }
        $faculty = $request_data->faculty;
        $school = $request_data->school;
        if ($tabs == 'ABSORPTION') {
            $data = $this->sectionD_data_A($request_data);
            // dd($data);
            return view('myra.section-d-absorption', compact('start_year', 'end_year', 'faculty', 'school', 'data')); 
        }
        elseif ($tabs == 'ENROLLMENT') { 
            $data = $this->sectionD_data_E($request_data);
            return view('myra.section-d-enrollment', compact('start_year', 'end_year', 'faculty', 'school', 'data')); 
        }
    }

    public function sectionE(Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if(in_array(user()->role, ['super_admin', 'admin']))$faculty = $request_data->faculty;
        else {
            $request_data->faculty = user()->faculty_code;
            if(!$request_data->school)$request_data->school = user()->school_code;
        }
        $faculty = $request_data->faculty;
        $school = $request_data->school;
        $data = $this->sectionE_data($request_data);
        return view('myra.section-e', compact('start_year', 'end_year', 'faculty', 'school', 'data'));
    }

    public function sectionF($tabs, Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if(in_array(user()->role, ['super_admin', 'admin']))$faculty = $request_data->faculty;
        else {
            $request_data->faculty = user()->faculty_code;
            if(!$request_data->school)$request_data->school = user()->school_code;
        }
        $faculty = $request_data->faculty;
        $school = $request_data->school;
        if ($tabs == 'UNIVERSITY') { 
            $data = $this->sectionF_data($request_data);
            return view('myra.section-f-university', compact('start_year', 'end_year', 'faculty', 'school', 'data')); }
    }

    public function sectionG($tabs, Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if(in_array(user()->role, ['super_admin', 'admin']))$faculty = $request_data->faculty;
        else {
            $request_data->faculty = user()->faculty_code;
            if(!$request_data->school)$request_data->school = user()->school_code;
        }
        $faculty = $request_data->faculty;
        $school = $request_data->school;
        if ($tabs == 'STAFFOVERALL') { 
            $data = $this->sectionG_data_S($request_data);
            return view('myra.section-g-staffoverall', compact('start_year', 'end_year', 'faculty', 'school', 'data')); }
        else if ($tabs == 'PROJECTOVERALL') { 
            $data = $this->sectionG_data_P($request_data);
            return view('myra.section-g-projectoverall', compact('start_year', 'end_year', 'faculty', 'school', 'data')); }
    }

    public function sectionH(Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if(in_array(user()->role, ['super_admin', 'admin']))$faculty = $request_data->faculty;
        else {
            $request_data->faculty = user()->faculty_code;
            if(!$request_data->school)$request_data->school = user()->school_code;
        }
        $faculty = $request_data->faculty;
        $school = $request_data->school;
        $data = $this->sectionH_data($request_data);
        return view('myra.section-h', compact('start_year', 'end_year', 'faculty', 'school', 'data'));
    }

    public function searching_request(Request $request)
    {
        $start_year = date('Y', strtotime('-6 years'));
        $end_year = date('Y', strtotime('-1 years'));
        $faculty = null;
        $school = null;
        if($request->search){
            $start_year = $request->start_year;
            $end_year = $request->end_year;
            $faculty = $request->faculty ?? null;
            $school = $request->school ?? null;
        }
        return (object)['start_year'=>$start_year, 'end_year'=>$end_year, 'faculty'=>$faculty, 'school'=>$school];
    }

    public function glossary($item)
    {
        if ($item == 'MyRAI') { return response()->file("glossary/Glosari MyRA I (Pindaan 2018) FINAL 6.12.2019.pdf"); }
        else if ($item == 'MyRAII') { return response()->file("glossary/Glosari MyRA II (Pindaan 2018) FINAL 6.12.2019.pdf"); }
        else if ($item == 'EM') { return response()->file("glossary/SENARAI BAHAN BUKTI MyRA I _ II (PINDAAN 2018).pdf"); }
    }
}
