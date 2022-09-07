<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistElnptActiveGrant;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ElnptActiveGrantFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[0]){
            return new MasterlistElnptActiveGrant([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'vot' => $row[0],
                'project_refno' => $row[1],
                'cost_center' => $row[2],
                'staff_id' => $row[3],
                'gelaran_rasmi' => $row[4],
                'staff_name' => $row[5],
                'faculty' => $row[6],
                'school' => $row[7],
                'ra' => $row[8],
                'st_nonst' => $row[9],
                'service_due_date' => $row[10] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[10])->format('Y-m-d') : null,
                'rm_staff_no' => $row[11],
                'rm_name' => $row[12],
                'arm_staff_no' => $row[13],
                'arm_name' => $row[14],
                'research_title' => $row[15],
                'date_generate_cc' => $row[16] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[16])->format('Y-m-d') : null,
                'submission_date' => $row[17] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[17])->format('Y-m-d') : null,
                'start_date' => $row[18] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[18])->format('Y-m-d') : null,
                'end_date' => $row[19] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[19])->format('Y-m-d') : null,
                'original_date' => $row[20] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[20])->format('Y-m-d') : null,
                'new_end_date_request' => $row[21] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[21])->format('Y-m-d') : null,
                'new_end_date_approved' => $row[22] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[22])->format('Y-m-d') : null,
                'year_duration' => is_numeric($row[23]) ? $row[23] : 0,
                'project_status' => $row[24],
                'proposal_status' => $row[25],
                'grant_acronym' => $row[26],
                'grant_type' => $row[27],
                'collaboration_name' => $row[28],
                'sponsor_category' => $row[29],
                'subsponsor' => $row[30],
                'sdg' => $row[31],
                'nkea' => $row[32],
                'npa' => $row[33],
                'research_area' => $row[34],
                'research_class_1' => $row[35],
                'commercialisation' => $row[36],
                'amount_approved' => is_numeric($row[37]) ? $row[37] : 0,
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