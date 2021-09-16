<?php

namespace App\Http\Controllers\Grant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacultyAchievementController extends Controller
{
    public function by_year()
    {
        return view('dashboard.pages.project-management.faculty-year');
    }

    public function active_grant()
    {
        return view('dashboard.pages.project-management.faculty-active');
    }

    public function all_grant()
    {
        return view('dashboard.pages.project-management.faculty-all');
    }
}
