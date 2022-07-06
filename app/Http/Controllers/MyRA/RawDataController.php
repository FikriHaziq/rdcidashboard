<?php

namespace App\Http\Controllers\MyRA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RawDataController extends Controller
{
    public function sectionA()
    {
        return view('myra.self-assessment.section-a');
    }

    public function sectionB()
    {
        return view('myra.self-assessment.section-b');
    }

    public function sectionC()
    {
        return view('myra.self-assessment.section-c');
    }

    public function sectionD()
    {
        return view('myra.self-assessment.section-d');
    }

    public function sectionE()
    {
        return view('myra.self-assessment.section-e');
    }

    public function sectionF()
    {
        return view('myra.self-assessment.section-f');
    }

    public function sectionG()
    {
        return view('myra.self-assessment.section-g');
    }

    public function sectionH()
    {
        return view('myra.self-assessment.section-h');
    }

    public function summary()
    {
        return view('myra.self-assessment.summary');
    }
}
