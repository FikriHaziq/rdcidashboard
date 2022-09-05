<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\PhdEnrolledFirstSheetImport;
use App\Models\MasterList\MasterlistPhdEnroll;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class PhdEnrolledImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistPhdEnroll::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new PhdEnrolledFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}