<?php

namespace App\Imports\Student;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\DocStudentFirstSheetImport;
use App\Models\MasterList\MasterListStudent;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class DocStudentImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterListStudent::whereType('doc_student')->where('ml_start_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new DocStudentFirstSheetImport($this->year),
            1 => new DocStudentFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}