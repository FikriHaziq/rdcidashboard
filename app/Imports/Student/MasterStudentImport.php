<?php

namespace App\Imports\Student;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\MasterStudentFirstSheetImport;
use App\Models\MasterList\MasterListStudent;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class MasterStudentImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterListStudent::whereType('master_student')->where('ml_start_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new MasterStudentFirstSheetImport($this->year),
            1 => new MasterStudentFirstSheetImport($this->year),
            2 => new MasterStudentFirstSheetImport($this->year),
            3 => new MasterStudentFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}