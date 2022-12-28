<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistAcademicStaff;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AcadStaffFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[0]){
            return new MasterlistAcademicStaff([
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
                'current_position_appointment_date' => excelDate($row[18]),
                'service_end_date' => excelDate($row[19]),
                'dob' => excelDate($row[20]),
                'age' => is_numeric($row[21]) ? $row[21]: null,
                'cohort' => $row[22],
                'acad_qualification' => $row[23],
                'professional_qualification_1' => $row[24],
                'professional_qualification_2' => $row[25],
                'reg_number' => $row[26],
                'st' => $row[27],
                'status1' => $row[28],
                'status2' => $row[29],
                'status3' => $row[30],
                'citizenship' => $row[31],
                'country' => $row[32],
                'ori_faculty_code' => $row[34] == '-' ? null: $row[34],
                'ori_faculty_name' => $row[35] == '-' ? null: $row[35],
                'ori_school_code' => $row[36] == '-' ? null: $row[36],
                'ori_school_name' => $row[37] == '-' ? null: $row[37],
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