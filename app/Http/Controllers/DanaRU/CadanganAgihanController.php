<?php

namespace App\Http\Controllers\DanaRU;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CadanganAgihanController extends Controller
{
    public function index(Request $request ,$year=null)
    {
        if(!$year)$year = date('Y');
        // $data = $this->myraSectionA($year);
        if($request->status == 'submitted'&& $request->role != 'approver')session()->flash('success', "Borang Cadangan Agihan telah berjaya dihantar");
        if($request->status == 'verified' && $request->role == 'approver')session()->flash('success', "Borang Cadangan Agihan telah berjaya disemak");
        if($request->status == 'amendment' && $request->role == 'approver')session()->flash('success', "Borang Cadangan Agihan telah berjaya disemak");
        if($request->action == 'save')session()->flash('success', "Data telah berjaya dikemaskini");

        return view('dana-ru.cadangan-agihan.index', compact('year', 'request'));
    }

    public function create($year=null)
    {
        if(!$year)$year = date('Y');
        // $data = $this->myraSectionA($year);
        return view('dana-ru.cadangan-agihan.form', compact('year'));
    }
}
