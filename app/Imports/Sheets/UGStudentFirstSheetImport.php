<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterListStudent;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UGStudentFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterListStudent([
                'type' => 'ug_student',
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'matric_no' => strtoupper($row[1]),
                'name' => $row[2],
                'faculty' => $row[3],
                'school' => $row[4],
                'year_enrolled' => (int)($row[5] ?? 0),
                'acedemic_year' => (int)($row[6] ?? 0),
                'citizenship' => $row[7],
                'country' => $row[8],
                'status' => $row[9],
                'remark' => $row[11],
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