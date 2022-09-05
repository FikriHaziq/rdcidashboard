<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\MonitoringProjectFirstSheetImport;
use App\Models\MasterList\MasterlistMonitoringProject;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class MonitoringProjectImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistMonitoringProject::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new MonitoringProjectFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}