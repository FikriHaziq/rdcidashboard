<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistPgFee;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class PgFeeFirstSheetImport implements ToModel, WithStartRow, WithChunkReading, WithCalculatedFormulas
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
                'faculty_short' => $row[4] == '-' ? null: $row[4],
                'faculty_long' => $row[5] == '-' ? null: $row[5],
                'school_code' => $row[6] == '-' ? null: $row[6],
                'school_short' => $row[7] == '-' ? null: $row[7],
                'school_long' => $row[8] == '-' ? null: $row[8],
                'study_mode' => $row[9],
                'payment_date' => excelDate($row[10]),
                'reference_no' => $row[11],
                'gross_income' => is_numeric($row[12]) ? $row[12] : 0,
                'degree_registered' => $row[13],
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