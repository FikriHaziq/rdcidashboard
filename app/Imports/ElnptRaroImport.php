<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\ElnptRaroFirstSheetImport;
use App\Models\MasterList\MasterListElnptRaro;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class ElnptRaroImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterListElnptRaro::where('ml_start_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new ElnptRaroFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}