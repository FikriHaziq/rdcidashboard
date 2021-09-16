<?php

namespace App\Http\Controllers\Grant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResearchProcessController extends Controller
{
    public function activity()
    {
        return view('dashboard.pages.project-management.research-activity');
    }

    public function talent()
    {
        return view('dashboard.pages.project-management.research-talent');
    }
}
