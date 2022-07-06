<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasterlistController extends Controller
{
    public function index()
    {
        return view('masterlist.index');
    }
}
