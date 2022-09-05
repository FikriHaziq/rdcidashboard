<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\ProductCommServiceFirstSheetImport;
use App\Models\MasterList\MasterlistProductCommRef;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class ProductCommServiceImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistProductCommRef::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new ProductCommServiceFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}