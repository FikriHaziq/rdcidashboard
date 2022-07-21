<?php

namespace App\Http\Controllers\Grant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataAttachment;

class OverviewController extends Controller
{
    // Research Overview
    public function index() {
        return view('grant.overview');
    }

    public function proposal() {
        $file = DataAttachment::whereModule('proposal_in_year')->whereStatus('selected')->first();
        return view('grant.proposal', compact('file'));
    }

    public function myra() {
        $file = DataAttachment::whereModule('myra')->whereStatus('selected')->first();
        return view('grant.myra', compact('file'));
    }

    public function proposalFile() {
        $module = "Proposal In Year";
        $module_code = "proposal_in_year";
        $files = DataAttachment::whereModule($module_code)->latest()->get();
        $path = 'grant.proposal';
        return view('components.file-upload', compact('module', 'module_code', 'files', 'path'));
    }

    public function myRAFile() {
        $module = "Research MyRA";
        $module_code = "myra";
        $path = 'grant.myra';
        $files = DataAttachment::whereModule($module_code)->latest()->get();
        return view('components.file-upload', compact('module', 'module_code', 'files', 'path'));
    }
}
