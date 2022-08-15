<?php

namespace App\Http\Controllers\Research;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function proposalManagement() {
        return view('research.management.proposal');
    }
}
