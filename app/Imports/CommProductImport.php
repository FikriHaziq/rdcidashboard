<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\CommProductFirstSheetImport;
use App\Models\MasterList\MasterlistCommProduct;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class CommProductImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistCommProduct::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new CommProductFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}