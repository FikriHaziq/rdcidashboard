<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistTrainingCourse;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TrainingCourseFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistTrainingCourse([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'organizer' => $row[1],
                'title' => $row[2],
                'faculty_code' => $row[3] == '-' ? null: $row[3],
                'school_code' => $row[4] == '-' ? null: $row[4],
                'institute_code' => $row[5] == '-' ? null: $row[5],
                'rc_code' => $row[6] == '-' ? null: $row[6],
                'start_date' => excelDate($row[7]),
                'end_date' => excelDate($row[8]),
                'reference_no_bill' => $row[9],
                'reference_no_journal' => $row[10],
                'gross_income' => is_numeric($row[11]) ? $row[11] : 0,
                'remark' => $row[12],
                'ptj' => $row[13],
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