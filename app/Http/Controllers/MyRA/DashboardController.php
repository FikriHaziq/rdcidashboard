<?php

namespace App\Http\Controllers\MyRA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\GraphMyraTrait;

class DashboardController extends Controller
{
    use GraphMyraTrait;

    public function index()
    {
        return view('myra.index');
    }

    public function staffInfo()
    {
        return view('myra.info-staff');
    }

    public function studentInfo()
    {
        return view('myra.info-student');
    }

    public function eMyRA()
    {
        return view('myra.emyra');
    }

    public function sectionB($tabs, Request $request)
    {
        $start_year = date('Y', strtotime('-6 years'));
        $end_year = date('Y', strtotime('-1 years'));
        if($request->search){
            $start_year = $request->start_year;
            $end_year = $request->end_year;
        }

        // dd($request->start_year == null);
        if ($tabs == 'INVESTIGATOR') {
            $data = $this->sectionB_PI($start_year, $end_year);
            // dd($data);
            return view('myra.section-b-pi', compact('start_year', 'end_year', 'data')); 
        }
        elseif ($tabs == 'COHORT') {
             return view('myra.section-b-cohort', compact('start_year', 'end_year', 'data')); 
        }
        elseif ($tabs == 'AWARD') { 
            return view('myra.section-b-award', compact('start_year', 'end_year', 'data')); 
        }
    }

    public function sectionC()
    {
        return view('myra.section-c');
    }

    public function sectionD($tabs)
    {
        if ($tabs == 'ABSORPTION') { return view('myra.section-d-absorption'); }
        elseif ($tabs == 'ENROLLMENT') { return view('myra.section-d-enrollment'); }
    }

    public function sectionE()
    {
        return view('myra.section-e');
    }

    public function sectionF()
    {
        return view('myra.section-f');
    }

    public function sectionG()
    {
        return view('myra.section-g');
    }

    public function sectionH()
    {
        return view('myra.section-h');
    }
}
