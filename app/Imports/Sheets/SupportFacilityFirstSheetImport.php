<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistSupportFacility;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SupportFacilityFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistSupportFacility([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'facility' => $row[1],
                'faculty' => $row[2],
                // 'faculty_code' => $row[1],
                // 'school_code' => $row[1],
                // 'institute_code' => $row[1],
                // 'rc_code' => $row[1],
                'type' => $row[3],
                'registration_no' => $row[4],
                'awarding_body' => $row[5],
                'first_issue_date' => excelDate($row[6]),
                'start_date' => excelDate($row[7]),
                'expiry_date' => excelDate($row[8]),
                'remark' => $row[9],
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