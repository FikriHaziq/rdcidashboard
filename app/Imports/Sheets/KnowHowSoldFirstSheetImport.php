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
        if($row[1]){
            return new MasterlistKnowHowSold([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'staff_id' => $row[1],
                'name' => $row[2],
                'faculty_code' => $row[3] == '-' ? null: $row[3],
                'school_code' => $row[4] == '-' ? null: $row[4],
                'institute_code' => $row[5] == '-' ? null: $row[5],
                'rc_code' => $row[6] == '-' ? null: $row[6],
                'tech_id' => $row[7],
                'tech_name' => $row[8],
                'type' => $row[9],
                'start_date' => excelDate($row[10]),
                'end_date' => excelDate($row[11]),
                'date_threshold_achieved' => excelDate($row[12]),
                'license' => $row[13],
                'gross_income' => is_numeric($row[14]) ? $row[14] : null,
                'remark' => $row[16],
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