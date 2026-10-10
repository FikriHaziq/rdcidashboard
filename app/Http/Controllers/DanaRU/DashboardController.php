<?php

namespace App\Http\Controllers\DanaRU;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function bpki(Request $request)
    {
        
        return view('dana-ru.dashboard.bpki');
    }

    public function mrun(Request $request)
    {
        
        return view('dana-ru.dashboard.mrun');
    }
}
