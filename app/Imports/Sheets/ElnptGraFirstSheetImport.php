<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistElnptGra;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ElnptGraFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[0]){
            return new MasterlistElnptGra([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'vot_number' => $row[0],
                'grant_code' => $row[1],
                'rm_name' => $row[2],
                'app_refno' => $row[3],
                'gender' => $row[4],
                'student_name' => $row[5],
                'study_mode' => $row[6],
                'country' => $row[7],
                'citizenship' => $row[8],
                'app_type' => $row[9],
                'app_start_date' => $row[10] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[10])->format('Y-m-d') : null,
                'app_end_date' => $row[11] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11])->format('Y-m-d') : null,
                'app_status' => $row[12],
                'pk' => $row[13],
                'curr_employment_status' => $row[14],
                'faculty' => $row[15],
                'rate_per_hour' => $row[16] != '' ? $row[16] : 0,
                'allowance_amt' => $row[17] != '' ? $row[17] : 0,
                'total_payment' => $row[18] != '' ? $row[18] : 0,
                'project_leader_id' => $row[19],
                'project_leader_name' => $row[20],
                'submit_status' => $row[21],
                'submit_remark' => $row[22],
                'submit_date' => $row[23] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[23]))) : null,
                'ra_fc_ins_h_process_status' => $row[24],
                'ra_fc_ins_h_t_remark' => $row[25],
                'ra_fc_ins_h_date_approve' => $row[26] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[26]))) : null,
                'clerk_process_status' => $row[27],
                'clerk_remark' => $row[28],
                'clerk_date_approve' => $row[29] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[29]))) : null,
                'officer_process_status' => $row[30],
                'officer_remark' => $row[31],
                'officer_date_approve' => $row[32] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[32])->format('Y-m-d') : null,
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