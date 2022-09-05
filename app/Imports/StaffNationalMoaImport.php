<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\StaffNationalMoaFirstSheetImport;
use App\Models\MasterList\MasterlistStaffNationalMoa;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class StaffNationalMoaImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistStaffNationalMoa::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new StaffNationalMoaFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}