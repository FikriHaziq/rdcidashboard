<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistGift;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class GiftFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistGift([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'faculty' => $row[1],
                'gift' => $row[2],
                'faculty_code' => $row[3] == '-' ? null: $row[3],
                'school_code' => $row[4] == '-' ? null: $row[4],
                'institute_code' => $row[5] == '-' ? null: $row[5],
                'rc_code' => $row[6] == '-' ? null: $row[6],
                'donor' => $row[7],
                'type' => $row[8],
                'date_received' => excelDate($row[9]),
                'reference' => $row[10],
                'value' => is_numeric($row[11]) ? $row[11] : 0,
                'remark' => $row[13],
                'proof_reference' => $row[14],
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