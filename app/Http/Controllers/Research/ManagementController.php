<?php

namespace App\Http\Controllers\Research;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    public function proposalManagement() {
        return view('research.management.proposal');
    }

    public function grantManagement() {
        return view('research.management.grant');
    }

    public function activityManagement() {
        return view('research.management.activity');
    }

    public function raroAppointment() {
        return view('research.management.raro');
    }

    public function graSRAAppointment() {
        return view('research.management.raro');
    }
}
