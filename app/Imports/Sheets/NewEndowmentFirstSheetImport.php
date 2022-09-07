<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistNewEndowment;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class NewEndowmentFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistNewEndowment([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'contributor_name' => $row[1],
                'contributor_details' => $row[2],
                'faculty_code' => $row[3] == '-' ? null: $row[3],
                'school_code' => $row[4] == '-' ? null: $row[4],
                'type' => $row[5],
                'amount_endowed' => is_numeric($row[6]) ? $row[6] : 0,
                'amount_endowed_percent_research' => is_numeric($row[7]) ? $row[7] : 0,
                'remark' => $row[8],
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