<?php

namespace App\Http\Controllers\Grant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\GeneralController as Api;
use Illuminate\Http\Request;

class FacultyAchievementController extends Controller
{
    public function by_year()
    {
        $result = Api::getgrantMestecc(1995);
        return view('dashboard.pages.grant.faculty-year', compact('result'));
    }

    public function active_grant()
    {
        return view('dashboard.pages.grant.faculty-active');
    }

    public function all_grant()
    {
        return view('dashboard.pages.grant.faculty-all');
    }
}
