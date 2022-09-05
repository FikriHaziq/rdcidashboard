<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\InternationalMembershipFirstSheetImport;
use App\Models\MasterList\MasterlistMembershipInternational;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class InternationalMembershipImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistMembershipInternational::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new InternationalMembershipFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}