<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistTotalExpenditure;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;


class TotalExpenditureFirstSheetImport implements ToModel, WithStartRow, WithChunkReading, WithCalculatedFormulas
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[0]){
            return new MasterlistTotalExpenditure([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'type' => $row[1],
                'title' => $row[2],
                'amount' => is_numeric($row[3]) ? $row[3] : 0,
                'cost_center' => $row[4],
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