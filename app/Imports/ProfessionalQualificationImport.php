<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\ProfessionalQualificationFirstSheetImport;
use App\Models\MasterList\MasterlistProfessionalQualification;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class ProfessionalQualificationImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistProfessionalQualification::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new ProfessionalQualificationFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}