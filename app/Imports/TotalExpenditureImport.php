<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\TotalExpenditureFirstSheetImport;
use App\Models\MasterList\MasterlistTotalExpenditure;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class TotalExpenditureImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistTotalExpenditure::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new TotalExpenditureFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}