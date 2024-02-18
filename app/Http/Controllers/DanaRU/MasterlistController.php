<?php

namespace App\Http\Controllers\DanaRU;

use App\Http\Controllers\Controller;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DruAllocationImport;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Http\Request;

class MasterlistController extends Controller
{
    public function __construct()
    {
        // set_time_limit(300);
        ini_set('max_execution_time', 500);
        ini_set('memory_limit', '-1');
    }

    public function allocationIndex()
    {
        $files = DataAttachment::whereModule('allocation')->latest()->get();
        return view('dana-ru.masterlist.allocation', compact('files'));
    }

    public function expensesIndex()
    {
        return view('dana-ru.kewangan.overall');
    }

    public function allocationImport($id)
    {
        $masterlist = DataAttachment::find($id);
        if($masterlist){
            $mediaItems = $masterlist->getFirstMedia('dataAttachment');
            $filepath = $mediaItems->getPath();
            // $headings = (new HeadingRowImport)->toArray($filepath);
            // dd($headings);
            Excel::import(new DruAllocationImport(), $filepath);
        }
        else{
            session()->flash('info', "This module will be available soon");
            return back();
        }
        $prev_data = DataAttachment::whereId($id)->whereStatus('selected')->first();
        if($prev_data){
            $prev_data->status = 'not-selected';
            $prev_data->save();
        }
        $masterlist->status = 'selected';
        $masterlist->save();
        session()->flash('success', "Masterlist is successfully imported");
        return back();
    }

    public function allocationDelete($id)
    {
        $masterlist = DataAttachment::find($id);
        $masterlist->delete();
        session()->flash('success', "Masterlist is successfully deleted");
        return back();
    }
}
