<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistElnptActivity;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ElnptActivityFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistElnptActivity([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'application_pk' => $row[0],
                'rm' => $row[1],
                'arm' => $row[2],
                'activity_no' => $row[3],
                'cost_center_code' => $row[4],
                'pro_refno' => $row[5],
                'grant_acronym' => $row[6],
                'grant_type' => $row[7],
                'faculty_code' => $row[8],
                'faculty' => $row[9],
                'niche_area' => $row[10],
                'activity_type' => $row[11],
                'application_type' => $row[12],
                'staffno_applicant' => $row[13],
                'staff_applicant' => $row[14],
                'student_applicant' => $row[15],
                'matric_no' => $row[16],
                'guest_applicant_name' => $row[17],
                'ic_no' => $row[18],
                'activity_name' => $row[19],
                'bandar' => $row[20],
                'negeri' => $row[21],
                'negara' => $row[22],
                'estimated_cost' => $row[23] != '' ? $row[23] : 0,
                'act_start_date' => $row[24] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[24])->format('Y-m-d') : null,
                'act_end_date' => $row[25] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[25])->format('Y-m-d') : null,
                'paper_title' => $row[26],
                'status_fk' => $row[27],
                'act_app_status' => $row[28],
                'submit_status' => $row[29],
                'submit_remark' => $row[30],
                'submit_date' => $row[31] ? date('Y-m-d', strtotime($row[31])) : null,
                'arm_process_status' => $row[32],
                'arm_remark' => $row[33],
                'arm_date_approval' => $row[34] ? date('Y-m-d', strtotime($row[34])) : null,
                'clerk_process_status' => $row[35],
                'clerk_remark' => $row[36],
                'clerk_date_approval' => $row[37] ? date('Y-m-d', strtotime($row[37])) : null,
                'dd_status' => $row[38],
                'dd_remark' => $row[39],
                'dd_date_approval' => $row[40] ? date('Y-m-d', strtotime($row[40])) : null,
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