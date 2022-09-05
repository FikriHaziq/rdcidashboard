<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistBenefitedKtp;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BenefitedKtpFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistBenefitedKtp([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'staff_id' => $row[1],
                'name' => $row[2],
                'faculty_code' => $row[3] == '-' ? null: $row[3],
                'school_code' => $row[4] == '-' ? null: $row[4],
                'institute_code' => $row[5] == '-' ? null: $row[5],
                'rc_code' => $row[6] == '-' ? null: $row[6],
                'faculty' => $row[7],
                'industry' => $row[8],
                'project_id' => $row[9],
                'project_name' => $row[10],
                'project_description' => $row[11],
                'star_rating' => $row[12],
                'organizer' => $row[13],
                'sponsorship_value' => is_numeric($row[14]) ? $row[14] : 0,
                'start_date' => excelDate($row[15]),
                'end_date' => excelDate($row[16]),
                'remark' => $row[18],
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