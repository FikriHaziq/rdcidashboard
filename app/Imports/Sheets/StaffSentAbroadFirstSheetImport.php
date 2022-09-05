<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistStaffSentAbroad;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class StaffSentAbroadFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistStaffSentAbroad([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'staff_id' => $row[1],
                'name' => $row[2],
                'faculty_code' => $row[3] == '-' ? null: $row[3],
                'school_code' => $row[4] == '-' ? null: $row[4],
                'institute_code' => $row[5] == '-' ? null: $row[5],
                'rc_code' => $row[6] == '-' ? null: $row[6],
                'faculty' => $row[7],
                'organisation' => $row[8],
                'country' => $row[9],
                'type' => $row[10],
                'sponsor' => $row[11],
                'start_date' => excelDate($row[12]),
                'end_date' => excelDate($row[13]),
                'total_day' => $row[14],
                'remark' => $row[15],
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