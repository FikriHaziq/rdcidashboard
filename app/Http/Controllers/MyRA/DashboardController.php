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

    public function eMyRA()
    {
        return view('myra.emyra');
    }

    public function sectionB()
    {
        return view('myra.section-b');
    }

    public function sectionC()
    {
        return view('myra.section-c');
    }

    public function sectionD()
    {
        return view('myra.section-d');
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
