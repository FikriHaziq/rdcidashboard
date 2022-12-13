<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\OperationalExpenditureFirstSheetImport;
use App\Models\MasterList\MasterlistOperationalExpenditure;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class OperationalExpenditureImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistOperationalExpenditure::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new OperationalExpenditureFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}