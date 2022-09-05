<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistResearchExperience;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ResearchExperienceFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistResearchExperience([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'staff_id' => $row[1],
                'name' => $row[2],
                'faculty_code' => $row[3] == '-' ? null: $row[3],
                'school_code' => $row[4] == '-' ? null: $row[4],
                'institute_code' => $row[5] == '-' ? null: $row[5],
                'rc_code' => $row[6] == '-' ? null: $row[6],
                'position' => $row[7],
                'grade' => $row[8],
                'first_appointment_date' => excelDate($row[9]),
                'current_position_appointment_date' => excelDate($row[10]),
                'service_end_date' => excelDate($row[11]),
                'dob' => excelDate($row[12]),
                'age' => is_numeric($row[13]) ? $row[13]: null,
                'cohort' => $row[14],
                'acad_qualification' => $row[15],
                'professional_qualification_1' => $row[16],
                'professional_qualification_2' => $row[17],
                'reg_number' => $row[18],
                'faculty' => $row[19],
                'department' => $row[20],
                'st' => $row[21],
                'status1' => $row[22],
                'status2' => $row[23],
                'status3' => $row[24],
                'citizenship' => $row[25],
                'country' => $row[26],
                'remark' => $row[28],
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