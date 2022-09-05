<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\StaffSentAbroadFirstSheetImport;
use App\Models\MasterList\MasterlistStaffSentAbroad;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class StaffSentAbroadImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistStaffSentAbroad::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new StaffSentAbroadFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}