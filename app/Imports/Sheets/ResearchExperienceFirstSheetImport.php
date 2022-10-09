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
                'position' => $row[14],
                'grade' => $row[15],
                'first_appointment_date' => excelDate($row[16]),
                'current_position_appointment_date' => excelDate($row[17]),
                'service_end_date' => excelDate($row[18]),
                'dob' => excelDate($row[19]),
                'age' => is_numeric($row[20]) ? $row[20]: null,
                'cohort' => $row[21],
                'acad_qualification' => $row[22],
                'professional_qualification_1' => $row[23],
                'professional_qualification_2' => $row[24],
                'reg_number' => $row[25],
                'st' => $row[26],
                'status1' => $row[27],
                'status2' => $row[28],
                'status3' => $row[29],
                'citizenship' => $row[30],
                'country' => $row[31],
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