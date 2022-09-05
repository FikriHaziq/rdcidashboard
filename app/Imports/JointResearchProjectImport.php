<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\JointResearchProjectFirstSheetImport;
use App\Models\MasterList\MasterlistJointResearchProject;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class JointResearchProjectImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistJointResearchProject::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new JointResearchProjectFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}