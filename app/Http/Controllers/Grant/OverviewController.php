<?php

namespace App\Http\Controllers\Grant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
    // Research Overview
    public function index() {
        return view('dashboard.pages.grant.overview');
    }

    public function proposal() {
        return view('dashboard.pages.grant.proposal');
    }

    public function myra() {
        return view('dashboard.pages.grant.myra');
    }
}
