<?php

namespace App\Http\Controllers\MyRA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataAttachment;
use App\Http\Traits\MasterListMyraTrait;
use App\Exports\AcadStaffExport;
use Illuminate\Support\Facades\File;

class ReportController extends Controller
{
    use MasterListMyraTrait;

    public function __construct()
    {
        // set_time_limit(300);
        ini_set('max_execution_time', 500);
        ini_set('memory_limit', '-1');
    }

    public function index($year = null)
    {
        if($year == null)$year = date('Y');
        $modules = $this->getMyraModuleAvailability($year);
        return view('myra.report.index', compact('year', 'modules'));
    }

    public function downloadMasterlist($masterlist, $year, $all = false)
    {
        if($all){
            $modules = $this->getMyraModuleAvailability($year, $masterlist);
            $zip_file = date('dmY') . '_' . $masterlist . '.zip';
            $zip = new \ZipArchive();
            $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

            foreach ($modules->modules as $key => $module) {
                if($module->available){
                    $file = DataAttachment::whereModule($module->code)->where('year', $year)->where('status', 'selected')->latest()->first();
                    if($file){
                        $mediaItem = $file->getFirstMedia('dataAttachment');
                        $filepath = $mediaItem->getPath();
                        $filename = date('dmY') . '_' . $module->code . '.' . pathinfo($filepath, PATHINFO_EXTENSION);
                        $zip->addFile($filepath, $filename);
                    }
                }
            }
            $zip->close();
            return response()->download($zip_file)->deleteFileAfterSend(true);
        }
        else{
            $file = DataAttachment::whereModule($masterlist)->where('year', $year)->where('status', 'selected')->latest()->first();
            if($file){
                $mediaItem = $file->getFirstMedia('dataAttachment');
                $filepath = $mediaItem->getPath();
                $filename = date('dmY') . '_' . $masterlist . '.' . pathinfo($filepath, PATHINFO_EXTENSION);
                return response()->download($filepath, $filename);
            }
            else{
                session()->flash('error', "File not found");
                return back();
            }
        }
    }
}
