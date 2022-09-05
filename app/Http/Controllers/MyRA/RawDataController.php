<?php

namespace App\Http\Controllers\MyRA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\MasterListMyraTrait;

class RawDataController extends Controller
{
    use MasterListMyraTrait;

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
        // dd($data);
        return view('myra.self-assessment.section-b', compact('year', 'data'));
    }

    public function sectionC($year = null)
    {
        if(!$year)$year = date('Y');
        $data = $this->myraSectionC($year);
        return view('myra.self-assessment.section-c', compact('year', 'data'));
    }

    public function sectionD($year = null)
    {
        if(!$year)$year = date('Y');
        $data = $this->myraSectionD($year);
        return view('myra.self-assessment.section-d', compact('year', 'data'));
    }

    public function sectionE($year = null)
    {
        if(!$year)$year = date('Y');
        $data = $this->myraSectionE($year);
        return view('myra.self-assessment.section-e', compact('year', 'data'));
    }

    public function sectionF($year = null)
    {
        if(!$year)$year = date('Y');
        $data = $this->myraSectionF($year);
        return view('myra.self-assessment.section-f', compact('year', 'data'));
    }

    public function sectionG($year = null)
    {
        if(!$year)$year = date('Y');
        $data = $this->myraSectionG($year);
        return view('myra.self-assessment.section-g', compact('year', 'data'));
    }

    public function sectionH($year = null)
    {
        if(!$year)$year = date('Y');
        $data = $this->myraSectionH($year);
        return view('myra.self-assessment.section-h', compact('year', 'data'));
    }

    public function summary($year = null)
    {
        if(!$year)$year = date('Y');
        return view('myra.self-assessment.summary', compact('year'));
    }
}
