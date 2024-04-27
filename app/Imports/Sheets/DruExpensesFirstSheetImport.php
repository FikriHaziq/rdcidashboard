<?php

namespace App\Imports\Sheets;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use App\Models\MasterList\MasterlistDruExpenses;

class DruExpensesFirstSheetImport implements ToModel, WithStartRow, WithBatchInserts, WithChunkReading
{
    public $migration_code;

    public function  __construct($migration_code)
    {
        $this->migration_code = $migration_code;
    }

    public function model(array $row)
    {
        return new MasterlistDruExpenses([
            'jenis_agihan' => $row[1],
            'ptj' => $row[2],
            'project' => $row[3],
            'sub_project' => $row[4],
            'sodo_long' => $row[5],
            'sodo_short' => $row[6],
            'month' => $row[7],
            'year' => $row[8],
            'amount' => $row[9],
            'tabung_induk' => $row[10],
            'migration' => $this->migration_code,
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function batchSize(): int
    {
        return 500;
    }
    
    public function chunkSize(): int
    {
        return 500;
    }
}