<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistPgStudent;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PGStudentFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistPgStudent([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'matric_no' => strtoupper($row[1]),
                'name' => $row[2],
                'faculty_code' => $row[3] == '-' ? null: $row[3],
                'school_code' => $row[4] == '-' ? null: $row[4],
                'institute_code' => $row[5] == '-' ? null: $row[5],
                'rc_code' => $row[6] == '-' ? null: $row[6],
                'bachelor_cgpa_act' => $row[7],
                'bachelor_cgpa_eq' => $row[8],
                'cgpa_status' => $row[9],
                'bachelor_uni' => $row[10] == 'N/A' ? null: $row[10],
                'master_uni' => $row[11] == 'N/A' ? null: $row[11],
                'degree_registered_for' => $row[12],
                'study_type' => $row[13],
                'study_mode' => $row[14],
                'mixed_mode_ratio' => $row[15],
                'st' => $row[16],
                'faculty' => $row[17],
                'study_area' => $row[18],
                'sponsorship' => $row[19],
                'sponsorship_status' => $row[20],
                'year_enrolled' => (int)($row[21] ?? 0),
                'acedemic_year' => (int)($row[22] ?? 0),
                'sem_no' => (int)($row[23] ?? 0),
                'citizenship' => $row[24],
                'country' => $row[25],
                'entry_date' => excelDate($row[26]),
                'senate_approval_date' =>excelDate($row[27]),
                'study_duration' => (int)($row[28] ?? 0),
                'got' => $row[29],
                'status' => $row[30],
                'remark' => $row[31],
                'ic_no' => $row[32],
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