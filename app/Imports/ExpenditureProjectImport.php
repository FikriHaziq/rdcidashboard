<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\ExpenditureProjectFirstSheetImport;
use App\Models\MasterList\MasterlistExpenditureProject;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class ExpenditureProjectImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistExpenditureProject::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new ExpenditureProjectFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}