<?php

namespace App\Http\Controllers\MyRA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\GraphMyraTrait;

class ReportController extends Controller
{
    use GraphMyraTrait;

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

    public function downloadMasterlist($masterlist, $year, $faculty = null)
    {
        
        if($masterlist = 'acad_staff') return (new InvoicesExport(2018))->download('invoices.xlsx');
    }
}
