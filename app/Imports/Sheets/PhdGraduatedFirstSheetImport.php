<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistPhdGraduate;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PhdGraduatedFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistPhdGraduate([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'matric_no' => $row[1],
                'ic_no' => $row[2],
                'name' => $row[3],
                'faculty_code' => $row[4] == '-' ? null: $row[4],
                'faculty_short' => $row[5] == '-' ? null: $row[5],
                'faculty_long' => $row[6] == '-' ? null: $row[6],
                'school_code' => $row[7] == '-' ? null: $row[7],
                'school_short' => $row[8] == '-' ? null: $row[8],
                'school_long' => $row[9] == '-' ? null: $row[9],
                'research_group' => $row[10] == '-' ? null: $row[10],
                'institute_short' => $row[11] == '-' ? null: $row[11],
                'institute_long' => $row[12] == '-' ? null: $row[12],
                'rc_short' => $row[13] == '-' ? null: $row[13],
                'rc_long' => $row[14] == '-' ? null: $row[14],
                'bachelor_cgpa_act' => $row[15],
                'bachelor_cgpa_eq' => $row[16],
                'cgpa_status' => $row[17],
                'bachelor_uni' => $row[18],
                'master_uni' => $row[19],
                'degree_registered_for' => $row[20],
                'study_type' => $row[21],
                'study_mode' => $row[22],
                'mixed_mode_ratio' => $row[23],
                'st' => $row[24],
                'study_area' => $row[25],
                'sponsorship' => $row[26],
                'sponsorship_status' => $row[27],
                'year_enrolled' => is_numeric($row[28]) ? $row[28] : null,
                'acedemic_year' => is_numeric($row[29]) ? $row[29] : null,
                'sem_no' => is_numeric($row[30]) ? $row[30] : null,
                'citizenship' => $row[31],
                'country' => $row[32],
                'entry_date' => excelDate($row[33]),
                'senate_approval_date' => excelDate($row[34]),
                'study_duration' => is_numeric($row[35]) ? $row[35] : null,
                'got' => $row[36],
                'status' => $row[37],
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