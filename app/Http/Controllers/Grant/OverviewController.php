<?php

namespace App\Http\Controllers\Grant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
<<<<<<< HEAD
=======
use App\Models\DataAttachment;
>>>>>>> master

class OverviewController extends Controller
{
    // Research Overview
    public function index() {
        return view('grant.overview');
    }

    public function proposal() {
<<<<<<< HEAD
        return view('grant.proposal');
    }

    public function myra() {
        return view('grant.myra');
=======
        $file = DataAttachment::whereModule('proposal_in_year')->whereStatus('selected')->first();
        return view('grant.proposal', compact('file'));
    }

    public function myra() {
        $file = DataAttachment::whereModule('myra')->whereStatus('selected')->first();
        return view('grant.myra', compact('file'));
>>>>>>> master
    }

    public function proposalFile() {
        $module = "Proposal In Year";
<<<<<<< HEAD
        return view('components.file-upload', compact('module'));
=======
        $module_code = "proposal_in_year";
        $files = DataAttachment::whereModule($module_code)->latest()->get();
        $path = 'grant.proposal';
        return view('components.file-upload', compact('module', 'module_code', 'files', 'path'));
>>>>>>> master
    }

    public function myRAFile() {
        $module = "Research MyRA";
<<<<<<< HEAD
        return view('components.file-upload', compact('module'));
=======
        $module_code = "myra";
        $path = 'grant.myra';
        $files = DataAttachment::whereModule($module_code)->latest()->get();
        return view('components.file-upload', compact('module', 'module_code', 'files', 'path'));
>>>>>>> master
    }
}
