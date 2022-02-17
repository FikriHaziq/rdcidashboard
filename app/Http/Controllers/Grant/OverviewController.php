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

    public function proposalFile() {
        $module = "Proposal In Year";
        return view('components.file-upload', compact('module'));
    }

    public function myRAFile() {
        $module = "Research MyRA";
        return view('components.file-upload', compact('module'));
    }
}
