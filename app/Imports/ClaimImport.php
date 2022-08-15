<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\ClaimFirstSheetImport;
use App\Models\MasterList\MasterListClaim;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class ClaimImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterListClaim::where('ml_start_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new ClaimFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}