<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\ElnptGrantApplicationFirstSheetImport;
use App\Models\MasterList\MasterlistElnptGrantApplication;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class ElnptGrantApplicationImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistElnptGrantApplication::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new ElnptGrantApplicationFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}