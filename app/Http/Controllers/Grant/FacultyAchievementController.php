<?php

namespace App\Http\Controllers\Grant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\GeneralController as Api;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use App\Models\DataAttachment;
>>>>>>> master

class FacultyAchievementController extends Controller
{
    public function by_year($year=1995)
    {
        $result = Api::getgrantMestecc($year);
<<<<<<< HEAD
        // dd($result);
        return view('grant.faculty-year', compact('result', 'year'));
=======
        $file = DataAttachment::whereModule('faculty_year')->whereStatus('selected')->first();
        // dd($result);
        return view('grant.faculty-year', compact('result', 'year', 'file'));
>>>>>>> master
    }

    public function active_grant()
    {
        $result = Api::getgrantMestecc(2002);
<<<<<<< HEAD
        return view('grant.faculty-active', compact('result'));
=======
        $file = DataAttachment::whereModule('faculty_active')->whereStatus('selected')->first();
        return view('grant.faculty-active', compact('result', 'file'));
>>>>>>> master
    }

    public function all_grant()
    {
        $result = Api::getgrantMestecc(1995);
<<<<<<< HEAD
        return view('grant.faculty-all', compact('result'));
=======
        $file = DataAttachment::whereModule('faculty_all')->whereStatus('selected')->first();
        return view('grant.faculty-all', compact('result', 'file'));
    }

    public function by_year_file()
    {
        $module = "Faculty By Year";
        $module_code = "faculty_year";
        $files = DataAttachment::whereModule($module_code)->latest()->get();
        $path = 'grant.faculty-year';
        return view('components.file-upload', compact('module', 'module_code', 'files', 'path'));
    }

    public function active_grant_file()
    {
        $module = "Active Grant";
        $module_code = "faculty_active";
        $files = DataAttachment::whereModule($module_code)->latest()->get();
        $path = 'grant.faculty-active';
        return view('components.file-upload', compact('module', 'module_code', 'files', 'path'));
    }

    public function all_grant_file()
    {
        $module = "All Grant";
        $module_code = "faculty_all";
        $files = DataAttachment::whereModule($module_code)->latest()->get();
        $path = 'grant.faculty-all';
        return view('components.file-upload', compact('module', 'module_code', 'files', 'path'));
>>>>>>> master
    }
}
