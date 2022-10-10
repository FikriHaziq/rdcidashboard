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
        $data = $this->overview_data($start_year, $end_year);
        return view('myra.index', compact('start_year', 'end_year', 'data'));
    }

    public function staffInfo(Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        $data = $this->staff_data($start_year, $end_year);
        return view('myra.info-staff', compact('start_year', 'end_year', 'data'));
    }

    public function studentInfo(Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        $data = $this->student_data($start_year, $end_year);
        return view('myra.info-student', compact('start_year', 'end_year', 'data'));
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
        if ($tabs == 'INVESTIGATOR') {
            $data = $this->sectionB_data_PI($start_year, $end_year);
            return view('myra.section-b-pi', compact('start_year', 'end_year', 'data')); 
        }
        elseif ($tabs == 'COHORT') {
            $data = $this->sectionB_data_QC($start_year, $end_year);
             return view('myra.section-b-cohort', compact('start_year', 'end_year', 'data')); 
        }
        elseif ($tabs == 'AWARD') { 
            $data = $this->sectionB_data_A($start_year, $end_year);
            return view('myra.section-b-award', compact('start_year', 'end_year', 'data')); 
        }
    }

    public function sectionC(Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        $data = $this->sectionC_data($start_year, $end_year);
        return view('myra.section-c', compact('start_year', 'end_year', 'data'));
    }

    public function sectionD($tabs, Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if ($tabs == 'ABSORPTION') {
            $data = $this->sectionD_data_A($start_year, $end_year);
            return view('myra.section-d-absorption', compact('start_year', 'end_year', 'data')); 
        }
        elseif ($tabs == 'ENROLLMENT') { 
            $data = $this->sectionD_data_E($start_year, $end_year);
            return view('myra.section-d-enrollment', compact('start_year', 'end_year', 'data')); 
        }
    }

    public function sectionE(Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        $data = $this->sectionE_data($start_year, $end_year);
        return view('myra.section-e', compact('start_year', 'end_year', 'data'));
    }

    public function sectionF($tabs, Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        if ($tabs == 'INCOME') { 
            $data = $this->sectionF_data_I($start_year, $end_year);
            return view('myra.section-f-income', compact('start_year', 'end_year', 'data')); }
        elseif ($tabs == 'PARTICIPATION') { 
            $data = $this->sectionF_data_P($start_year, $end_year);
            return view('myra.section-f-participation', compact('start_year', 'end_year', 'data')); }
        elseif ($tabs == 'COMMUNITY') { 
            $data = $this->sectionF_data_C($start_year, $end_year);
            return view('myra.section-f-community', compact('start_year', 'end_year', 'data')); }
    }

    public function sectionG(Request $request)
    {
        $request_data = $this->searching_request($request);
        $start_year = $request_data->start_year;
        $end_year = $request_data->end_year;
        $data = $this->sectionG_data($start_year, $end_year);
        return view('myra.section-g', compact('start_year', 'end_year', 'data'));
    }

    public function sectionH()
    {
        return view('myra.section-h');
    }

    public function searching_request(Request $request)
    {
        $start_year = date('Y', strtotime('-6 years'));
        $end_year = date('Y', strtotime('-1 years'));
        if($request->search){
            $start_year = $request->start_year;
            $end_year = $request->end_year;
        }

        return (object)['start_year'=>$start_year, 'end_year'=>$end_year];
    }
}
