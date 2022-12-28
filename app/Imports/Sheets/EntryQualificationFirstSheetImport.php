<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistEntryQualification;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class EntryQualificationFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[0]){
            return new MasterlistEntryQualification([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'matric_no' => $row[1],
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
                'bachelor_cgpa_act' => $row[14],
                'bachelor_cgpa_eq' => $row[15],
                'cgpa_status' => $row[16],
                'bachelor_uni' => $row[17],
                'master_uni' => $row[18],
                'degree_registered_for' => $row[19],
                'study_type' => $row[20],
                'study_mode' => $row[21],
                'mixed_mode_ratio' => $row[22],
                'st' => $row[23],
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