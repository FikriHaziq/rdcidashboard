<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\JointResearchProjectRuFirstSheetImport;
use App\Models\MasterList\MasterlistJointResearchRu;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class JointResearchProjectRuImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistJointResearchRu::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new JointResearchProjectRuFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}