<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
    // Research Overview
    public function index() {
        return view('dashboard.pages.dashboard.overview');
    }

    public function proposal() {
        return view('dashboard.pages.dashboard.proposal');
    }

    public function myra() {
        return view('dashboard.pages.dashboard.myra');
    }
}
