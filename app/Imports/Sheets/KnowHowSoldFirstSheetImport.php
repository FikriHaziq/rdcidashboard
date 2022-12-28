<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistKnowHowSold;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class KnowHowSoldFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[0]){
            return new MasterlistKnowHowSold([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'staff_id' => $row[1],
                'name' => $row[2],
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
                'tech_id' => $row[14],
                'tech_name' => $row[15],
                'type' => $row[16],
                'start_date' => excelDate($row[17]),
                'end_date' => excelDate($row[18]),
                'date_threshold_achieved' => excelDate($row[19]),
                'license' => $row[20],
                'gross_income' => is_numeric($row[21]) ? $row[21] : null,
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