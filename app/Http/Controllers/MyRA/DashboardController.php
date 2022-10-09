<?php

namespace App\Http\Controllers\MyRA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
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

    public function sectionB($tabs)
    {
        if ($tabs == 'INVESTIGATOR') { return view('myra.section-b-pi'); }
        elseif ($tabs == 'COHORT') { return view('myra.section-b-cohort'); }
        elseif ($tabs == 'AWARD') { return view('myra.section-b-award'); }
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
