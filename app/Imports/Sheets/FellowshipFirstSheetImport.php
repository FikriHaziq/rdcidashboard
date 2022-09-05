<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistFellowship;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class FellowshipFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistFellowship([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'matric_no' => $row[1],
                'name' => $row[2],
                'faculty_code' => $row[3] == '-' ? null: $row[3],
                'school_code' => $row[4] == '-' ? null: $row[4],
                'institute_code' => $row[5] == '-' ? null: $row[5],
                'rc_code' => $row[6] == '-' ? null: $row[6],
                'bachelor_cgpa_act' => $row[7],
                'bachelor_cgpa_eq' => $row[8],
                'cgpa_status' => $row[9],
                'bachelor_uni' => $row[10],
                'master_uni' => $row[11],
                'degree_registered_for' => $row[12],
                'study_type' => $row[13],
                'study_mode' => $row[14],
                'mixed_mode_ratio' => $row[15],
                'st' => $row[16],
                'faculty' => $row[17],
                'study_area' => $row[18],
                'sponsorship' => $row[19],
                'sponsorship_status' => $row[20],
                'year_enrolled' => is_numeric($row[21]) ? $row[21] : null,
                'acedemic_year' => is_numeric($row[22]) ? $row[22] : null,
                'sem_no' => is_numeric($row[23]) ? $row[23] : null,
                'citizenship' => $row[24],
                'country' => $row[25],
                'entry_date' => excelDate($row[26]),
                'senate_approval_date' => excelDate($row[27]),
                'study_duration' => is_numeric($row[28]) ? $row[28] : null,
                'got' => $row[29],
                'status' => $row[30],
                'remark' => $row[32],
                'ic_no' => $row[33],
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