<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterListStudent;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PhdStudentFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterListStudent([
                'type' => 'phd_student',
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'matric_no' => strtoupper($row[1]),
                'ic_no' => strtoupper($row[2]),
                'name' => $row[3],
                'bachelor_cgpa_act' => $row[4],
                'bachelor_cgpa_eq' => $row[5],
                'cgpa_status' => $row[6],
                'bachelor_uni' => $row[7] == 'N/A' ? null: $row[7],
                'master_uni' => $row[8] == 'N/A' ? null: $row[8],
                'degree_registered_for' => $row[9],
                'study_type' => $row[10],
                'study_mode' => $row[11],
                'mixed_mode_ratio' => $row[12],
                'st' => $row[13],
                'faculty' => $row[14],
                'study_area' => $row[15],
                'sponsorship' => $row[16],
                'sponsorship_status' => $row[17],
                'school' => null,
                'year_enrolled' => (int)($row[18] ?? 0),
                'acedemic_year' => (int)($row[19] ?? 0),
                'sem_no' => (int)($row[20] ?? 0),
                'citizenship' => $row[21],
                'country' => $row[22],
                'entry_date' => $row[23] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[23])->format('Y-m-d') : null,
                'senate_approval_date' =>$row[24] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[24])->format('Y-m-d'): null,
                'study_duration' => (int)($row[25] ?? 0),
                'got' => $row[26],
                'status' => $row[27],
                'remark' => $row[29],
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