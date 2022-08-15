<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterListClaim;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ClaimFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterListClaim([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'kerani' => $row[0],
                'officer' => $row[1],
                'jenis_tuntutan' => $row[2],
                'no_rujukan_eform' => $row[3],
                'reference_no' => $row[4],
                'status' => $row[5],
                'cost_center_code' => $row[6],
                'rm_name' => $row[7],
                'nama_kp' => $row[8],
                'utmfin_refno' => $row[9],
                'latest_pending_to_counter' => $row[10] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[10])->format('Y-m-d') : null,
                'latest_return_counter' => $row[11] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[11]))) : null,
                'latest_accepted' => $row[12] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[12]))) : null,
                'latest_return_payment_clerk' => $row[13] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[13]))) : null,
                'latest_pending_payment_clerk' => $row[14] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[14]))) : null,
                'latest_pending_ru' => $row[15] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[15]))) : null,
                'latest_check_ru' => $row[16] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[16]))) : null,
                'latest_return_ru' => $row[17] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[17]))) : null,
                'latest_verify_ru' => $row[18] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[18]))) : null,
                'latest_pending_officer' => $row[19] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[19]))) : null,
                'latest_return_officer' => $row[20] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[20]))) : null,
                'latest_kiv_officer' => $row[21] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[21]))) : null,
                'latest_pending_director' => $row[22] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[22]))) : null,
                'latest_just_approve_dir' => $row[23] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[23]))) : null,
                'latest_just_reject_dir' => $row[24] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[24]))) : null,
                'latest_just_approve_ho' => $row[25] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[25]))) : null,
                'latest_just_reject_ho' => $row[26] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[26]))) : null,
                'latest_return_appointment' => $row[27] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[27]))) : null,
                'latest_reject_appointment' => $row[28] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[28]))) : null,
                'latest_pending_appointment' => $row[29] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[29]))) : null,
                'latest_approve_appointment' => $row[30] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[30]))) : null,
                'voucher_prepared' => $row[31] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[31]))) : null,
                'voucher_approved' => $row[32] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[32]))) : null,
                'voucher_approved_ho' => $row[33] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[33]))) : null,
                'tkh_send_to_bursar' => $row[34] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[34]))) : null,
                'latest_to_payment_clerk' => $row[35] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[35]))) : null,
                'tkh_complete' => $row[36] ? date('Y-m-d H:i:s', strtotime(str_replace('/','-',$row[36]))) : null,
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