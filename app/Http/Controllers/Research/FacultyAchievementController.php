<?php

namespace App\Http\Controllers\Research;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FacultyAchievementController extends Controller
{
    public function by_year()
    {
        return view('dashboard.pages.research.faculty-year');
    }

    public function active_grant()
    {
        return view('dashboard.pages.research.faculty-active');
    }

    public function all_grant()
    {
        return view('dashboard.pages.research.faculty-all');
    }
}
