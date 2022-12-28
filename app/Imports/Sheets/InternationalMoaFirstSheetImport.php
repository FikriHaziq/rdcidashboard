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
        if($row[0]){
            return new MasterlistInternationalMoa([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'organisation' => $row[1],
                'country' => $row[2],
                'faculty_code' => $row[3] == '-' ? null: $row[3],
                'faculty_short' => $row[4] == '-' ? null: $row[4],
                'faculty_long' => $row[5] == '-' ? null: $row[5],
                'school_code' => $row[6] == '-' ? null: $row[6],
                'school_short' => $row[7] == '-' ? null: $row[7],
                'school_long' => $row[8] == '-' ? null: $row[8],
                'research_group' => $row[9] == '-' ? null: $row[9],
                'institute_short' => $row[10] == '-' ? null: $row[10],
                'institute_long' => $row[11] == '-' ? null: $row[11],
                'rc_short' => $row[12] == '-' ? null: $row[12],
                'rc_long' => $row[13] == '-' ? null: $row[13],
                'title' => $row[14],
                'type' => $row[15],
                'activity' => $row[16],
                'category' => $row[17],
                'amount_original' => is_numeric($row[18]) ? $row[18] : 0,
                'amount' => is_numeric($row[19]) ? $row[19] : 0,
                'start_date' => excelDate($row[20]),
                'expiry_date' => excelDate($row[21]),
                'period' => $row[22],
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