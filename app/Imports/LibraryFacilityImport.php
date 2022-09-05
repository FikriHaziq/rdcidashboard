<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\LibraryFacilityFirstSheetImport;
use App\Imports\Sheets\LibraryFacilitySecondSheetImport;
use App\Imports\Sheets\LibraryFacilityThirdSheetImport;
use App\Models\MasterList\MasterlistLibraryFacility;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class LibraryFacilityImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistLibraryFacility::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new LibraryFacilityFirstSheetImport($this->year),
            1 => new LibraryFacilitySecondSheetImport($this->year),
            2 => new LibraryFacilityThirdSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}