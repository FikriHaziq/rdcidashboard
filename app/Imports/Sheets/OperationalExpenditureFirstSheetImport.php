<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistOperationalExpenditure;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;


class OperationalExpenditureFirstSheetImport implements ToModel, WithStartRow, WithChunkReading, WithCalculatedFormulas
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[0]){
            return new MasterlistOperationalExpenditure([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'amount' => is_numeric($row[1]) ? $row[1] : 0,
                'percentage' => $row[2],
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