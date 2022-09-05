<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistInternationalMoa;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class InternationalMoaFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistInternationalMoa([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'organisation' => $row[1],
                'country' => $row[2],
                'faculty_code' => $row[3] == '-' ? null: $row[3],
                'school_code' => $row[4] == '-' ? null: $row[4],
                'institute_code' => $row[5] == '-' ? null: $row[5],
                'rc_code' => $row[6] == '-' ? null: $row[6],
                'title' => $row[7],
                'type' => $row[8],
                'activity' => $row[9],
                'category' => $row[10],
                'amount_original' => is_numeric($row[11]) ? $row[11] : 0,
                'amount' => is_numeric($row[12]) ? $row[12] : 0,
                'start_date' => excelDate($row[13]),
                'expiry_date' => excelDate($row[14]),
                'period' => $row[15],
                'agreement_id' => $row[16],
                'activity_id' => $row[17],
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