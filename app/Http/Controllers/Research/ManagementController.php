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

    public function graSraAppointment() {
        return view('research.management.gra-sra');
    }

    public function wagesClaimManagement() {
        return view('research.management.wages-claim');
    }

    public function grantDistribution() {
        return view('research.management.distribution');
    }

    public function listOfAction() {
        return view('research.management.action');
    }
}
