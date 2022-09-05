<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\KnowHowSoldFirstSheetImport;
use App\Models\MasterList\MasterlistKnowHowSold;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class KnowHowSoldImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistKnowHowSold::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new KnowHowSoldFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}