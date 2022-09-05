<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\MasterGraduatedFirstSheetImport;
use App\Models\MasterList\MasterlistMasterGraduate;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class MasterGraduatedImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistMasterGraduate::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new MasterGraduatedFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}