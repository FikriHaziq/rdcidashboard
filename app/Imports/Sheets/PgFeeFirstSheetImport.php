<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistPgFee;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PgFeeFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistPgFee([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'matric_no' => $row[1],
                'name' => $row[2],
                'faculty_code' => $row[3] == '-' ? null: $row[3],
                'school_code' => $row[4] == '-' ? null: $row[4],
                'study_mode' => $row[5],
                'payment_date' => excelDate($row[6]),
                'reference_no' => $row[7],
                'gross_income' => is_numeric($row[8]) ? $row[8] : 0,
                'remark' => $row[9],
                'ic_no' => $row[10],
                'degree_registered' => $row[11],
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