<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistConsultancy;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ConsultancyFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistConsultancy([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'staff_id' => $row[1],
                'name' => $row[2],
                'faculty_code' => $row[3] == '-' ? null: $row[3],
                'school_code' => $row[4] == '-' ? null: $row[4],
                'institute_code' => $row[5] == '-' ? null: $row[5],
                'rc_code' => $row[6] == '-' ? null: $row[6],
                'faculty' => $row[7],
                'consultancy_title' => $row[8],
                'stakeholder' => $row[9],
                'start_date' => excelDate($row[10]),
                'end_date' => excelDate($row[11]),
                'utmfin_ref_no' => $row[12],
                'bill_ref_no' => $row[13],
                'receipt_ref_no' => $row[14],
                'gross_income' => is_numeric($row[15]) ? $row[15] : 0,
                'remark' => $row[16],
                'ptj' => $row[17],
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