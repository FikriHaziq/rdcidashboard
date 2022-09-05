<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\PhdGraduatedFirstSheetImport;
use App\Models\MasterList\MasterlistPhdGraduate;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class PhdGraduatedImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistPhdGraduate::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new PhdGraduatedFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}