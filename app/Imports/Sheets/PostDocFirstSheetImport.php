<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistPostDoc;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PostDocFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistPostDoc([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'postdoc_id' => $row[1],
                'name' => $row[2],
                'faculty_code' => $row[3] == '-' ? null: $row[3],
                'school_code' => $row[4] == '-' ? null: $row[4],
                'institute_code' => $row[5] == '-' ? null: $row[5],
                'rc_code' => $row[6] == '-' ? null: $row[6],
                'citizenship' => $row[7],
                'country' => $row[8],
                'first_appointment_date' => excelDate($row[9]),
                'current_appointment_date' => excelDate($row[10]),
                'end_date' => excelDate($row[11]),
                'appointment_duration' => is_numeric($row[12]) ? $row[12] : null,
                'award_institution' => $row[13],
                'year_award' => is_numeric($row[14]) ? $row[14] : null,
                'remark' => $row[15],
                'sv_id' => $row[16],
                'sv' => $row[17],
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