<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\ElnptActiveGrantFirstSheetImport;
use App\Models\MasterList\MasterListElnptActiveGrant;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class ElnptActiveGrantImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterListElnptActiveGrant::where('ml_start_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new ElnptActiveGrantFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}