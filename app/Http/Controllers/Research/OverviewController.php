<?php

namespace App\Http\Controllers\Research;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
    // Research Overview
    public function index() {
        return view('dashboard.pages.research.overview');
    }

    public function proposal() {
        return view('dashboard.pages.research.proposal');
    }

    public function myra() {
        return view('dashboard.pages.research.myra');
    }
}
