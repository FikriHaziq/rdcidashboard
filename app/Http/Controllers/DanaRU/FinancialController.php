<?php

namespace App\Http\Controllers\DanaRU;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    public function overall()
    {
        return view('dana-ru.kewangan.overall');
    }

    public function agihanProgramIndex()
    {
        return view('dana-ru.kewangan.overall');
    }

    public function program($year = null)
    {
        if(!$year)$year = date('Y');
        return view('dana-ru.kewangan.perbelanjaan.program', compact('year'));
    }

    public function subProject($year = null)
    {
        if(!$year)$year = date('Y');
        return view('dana-ru.kewangan.perbelanjaan.subproject', compact('year'));
    }
}
