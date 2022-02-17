<?php

namespace App\Http\Controllers\Grant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\GeneralController as Api;
use Illuminate\Http\Request;

class FacultyAchievementController extends Controller
{
    public function by_year($year=1995)
    {
        $result = Api::getgrantMestecc($year);
        // dd($result);
        return view('dashboard.pages.grant.faculty-year', compact('result', 'year'));
    }

    public function active_grant()
    {
        $result = Api::getgrantMestecc(2002);
        return view('dashboard.pages.grant.faculty-active', compact('result'));
    }

    public function all_grant()
    {
        $result = Api::getgrantMestecc(1995);
        return view('dashboard.pages.grant.faculty-all', compact('result'));
    }
}
