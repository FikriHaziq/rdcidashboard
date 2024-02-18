<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\DruAllocationFirstSheetImport;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class DruAllocationImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public function  __construct()
    {
        // MasterlistDruAllocation::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new DruAllocationFirstSheetImport(),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}