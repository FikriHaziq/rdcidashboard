<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistLabService;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class LabServiceFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistLabService([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'lab' => $row[1],
                'ptj' => $row[2],
                'faculty_code' => $row[3] == '-' ? null: $row[3],
                'school_code' => $row[4] == '-' ? null: $row[4],
                'institute_code' => $row[5] == '-' ? null: $row[5],
                'rc_code' => $row[6] == '-' ? null: $row[6],
                'utmfin_ref_no' => $row[7],
                'bill_ref_no' => $row[8],
                'receipt_ref_no' => $row[9],
                'gross_income' => is_numeric($row[10]) ? $row[10] : 0,
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