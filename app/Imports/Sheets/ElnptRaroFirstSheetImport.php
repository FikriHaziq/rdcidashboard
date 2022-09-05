<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistElnptRaro;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ElnptRaroFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistElnptRaro([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'pusat_kos' => $row[0],
                'center_code' => $row[1],
                'reference_no' => $row[2],
                'lantikan_refno' => $row[3],
                'status_permohonan' => $row[4],
                'staff_lantikan' => $row[5],
                'kod_jawatan' => $row[6],
                'tkh_mula_kuatkuasa' => $row[7] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[7])->format('Y-m-d') : null,
                'tkh_tamat_kuatkuasa' => $row[8] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8])->format('Y-m-d') : null,
                'gaji_pokok' => $row[9] != '' ? $row[9] : 0,
                'submit_status' => $row[10],
                'submit_remark' => $row[11],
                'submit_date' => $row[12] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[12]))) : null,
                'clerk_process_status' => $row[13],
                'clerk_remark' => $row[14],
                'clerk_date_approve' => $row[15] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[15]))) : null,
                'office_process_status' => $row[16],
                'office_remark' => $row[17],
                'office_date_approve' => $row[18] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[18]))) : null,
                'nationality' => $row[19],
                'rm' => $row[20],
                'kerani' => $row[21],
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