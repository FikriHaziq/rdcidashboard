<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\RaroProcessFirstSheetImport;
use App\Models\MasterList\MasterListRaroProcess;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class RaroProcessImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterListRaroProcess::where('ml_start_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new RaroProcessFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}