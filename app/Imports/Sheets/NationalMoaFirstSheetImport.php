<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistNationalMoa;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class NationalMoaFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistNationalMoa([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'organisation' => $row[1],
                // 'faculty_code' => $row[3] == '-' ? null: $row[3],
                // 'school_code' => $row[4] == '-' ? null: $row[4],
                // 'institute_code' => $row[5] == '-' ? null: $row[5],
                // 'rc_code' => $row[6] == '-' ? null: $row[6],
                'title' => $row[2],
                'type' => $row[3],
                'category' => $row[4],
                'amount' => is_numeric($row[5]) ? $row[5] : 0,
                'start_date' => excelDate($row[6]),
                'expiry_date' => excelDate($row[7]),
                'period' => $row[8],
                'agreement_link' => $row[9],
                'activity_link' => $row[10],
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