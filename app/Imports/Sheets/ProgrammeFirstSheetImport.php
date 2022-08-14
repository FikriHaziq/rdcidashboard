<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterListProgramme;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MasterStudentFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterListProgramme([
                'type' => 'master_student',
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'organizer' => $row[1],
                'title' => $row[2],
                'start_date' => $row[3] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3])->format('Y-m-d') : null,
                'end_date' => $row[4] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])->format('Y-m-d') : null,
                'reference_no' => strtoupper($row[5]),
                'gross_income' => $row[6],
                'remark' => $row[7],
            ]);
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}