<?php

namespace App\Http\Controllers\MyRA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\MasterListTrait;

class RawDataController extends Controller
{
    use MasterListTrait;

    public function sectionA($year = null)
    {
        if(!$year)$year = date('Y');
        $data = $this->myraSectionA($year);
        return view('myra.self-assessment.section-a', compact('year', 'data'));
    }

    public function sectionB($year = null)
    {
        if(!$year)$year = date('Y');
        $data = $this->myraSectionB($year);
        return view('myra.self-assessment.section-b', compact('year', 'data'));
    }

    public function sectionC($year = null)
    {
        if(!$year)$year = date('Y');
        $data = $this->myraSectionC($year);
        // dd($data);
        return view('myra.self-assessment.section-c', compact('year', 'data'));
    }

    public function sectionD($year = null)
    {
        if(!$year)$year = date('Y');
        return view('myra.self-assessment.section-d', compact('year'));
    }

    public function sectionE($year = null)
    {
        if(!$year)$year = date('Y');
        return view('myra.self-assessment.section-e', compact('year'));
    }

    public function sectionF($year = null)
    {
        if(!$year)$year = date('Y');
        return view('myra.self-assessment.section-f', compact('year'));
    }

    public function sectionG($year = null)
    {
        if(!$year)$year = date('Y');
        return view('myra.self-assessment.section-g', compact('year'));
    }

    public function sectionH($year = null)
    {
        if(!$year)$year = date('Y');
        return view('myra.self-assessment.section-h', compact('year'));
    }

    public function summary($year = null)
    {
        if(!$year)$year = date('Y');
        return view('myra.self-assessment.summary', compact('year'));
    }
}
