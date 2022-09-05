<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\StaffInternationalMoaFirstSheetImport;
use App\Models\MasterList\MasterlistStaffInternationalMoa;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class StaffInternationalMoaImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistStaffInternationalMoa::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new StaffInternationalMoaFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}