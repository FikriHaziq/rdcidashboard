<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterListRaroProcess;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class RaroProcessFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[0]){
            return new MasterListRaroProcess([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'no_rujukan' => $row[0],
                'pusat_kos' => $row[1],
                'lantikan_refno' => $row[2],
                'status_fk' => $row[3],
                'status_permohonan' => $row[4],
                'no_pekerja' => $row[5],
                'nama_staf_lantikan' => $row[6],
                'no_ic' => $row[7],
                'birth_date' => $row[8] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[8])->format('Y-m-d') : null,
                'gender' => $row[9],
                'position_code' => $row[10],
                'position' => $row[11],
                'faculty' => $row[12],
                'email_pemohon' => $row[13],
                'email_kedua' => $row[14],
                'no_tel_bimbit' => $row[15],
                'no_tel_bimbit_1' => $row[16],
                'appointment_type' => $row[17],
                'curr_employment_status' => $row[18],
                'tkh_mula_kuatkuasa' => $row[19] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[19])->format('Y-m-d') : null,
                'tkh_tamat_kuatkuasa' => $row[20] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[20])->format('Y-m-d') : null,
                'peringkat_gaji' => $row[21],
                'gaji_pokok' => is_numeric($row[22]) ? $row[22] : 0,
                'nama_kp' => $row[23],
                'no_pekerja_kp' => $row[24],
                'no_pekerja_rm' => $row[25],
                'nama_rm' => $row[26],
                'no_pekerja_arm' => $row[27],
                'nama_arm' => $row[28],
                'module_name' => $row[29],
                'submit_by' => $row[30],
                'no_pekerja_1' => $row[31],
                'nama_penilai' => $row[32],
                'status_penilaian' => $row[33],
                'remark' => $row[34],
                'tkh_submit' => $row[35] ?\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[35])->format('Y-m-d') : null,
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