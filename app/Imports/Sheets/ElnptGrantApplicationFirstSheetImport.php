<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterListElnptGrantApplication;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ElnptGrantApplicationFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterListElnptGrantApplication([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'rm_staff_no' => $row[0],
                'rm_name' => $row[1],
                'status_proposal' => $row[2],
                'reference_no' => $row[3],
                'submission_date' => $row[4] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])->format('Y-m-d') : null,
                'sponsor_category' => $row[5],
                'subsponsor' => $row[6],
                'grant_name' => $row[7],
                'date_generate_cc' => $row[8] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8])->format('Y-m-d') : null,
                'date_declaration_letter' => $row[9] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9])->format('Y-m-d') : null,
                'date_agree_letter' => $row[10] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[10])->format('Y-m-d') : null,
                'prodate_activated' => $row[11] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11])->format('Y-m-d') : null,
                'submit_status' => $row[12],
                'submit_date' => $row[13] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[13]))) : null,
                'ra_fc_ins_h_process_status' => $row[14],
                'ra_fc_ins_h_t_remark' => $row[15],
                'ra_fc_ins_h_date_approve' => $row[16] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[16]))) : null,
                'clerk_process_status' => $row[17],
                'clerk_remark' => $row[18],
                'clerk_date_approve' => $row[19] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[19]))) : null,
                'officer_process_status' => $row[20],
                'officer_remark' => $row[21],
                'officer_date_approve' => $row[22] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[22]))) : null,
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