<?php

namespace App\Imports\Sheets;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use App\Models\MasterList\MasterlistDruExpenses;
use App\Models\Parameter;

class DruExpensesFirstSheetImport implements ToModel, WithStartRow, WithBatchInserts, WithChunkReading
{
    public $migration_code;
    public $ptj;

    public function  __construct($migration_code)
    {
        $this->ptj = Parameter::select(['id', 'original_code', 'parameter_name as name'])->whereIn('group_id',[1,2])->get()->toArray();
        $this->migration_code = $migration_code;
    }

    public function model(array $row)
    {
        $ptj_check = [];
        $ptj_check = array_filter($this->ptj, function($parameter) use ($row) {
            return strpos($parameter['original_code'], rtrimMinLength(trim($row[2]),'0')) !== false;
        });

        $ptj_check = array_values($ptj_check);
        $ptj_code = !empty($ptj_check) ? $ptj_check[0]['original_code']: rtrimMinLength(trim($row[2]),'0');
        $tabung_induk = getMainFundByFormula(trim($row[3]), trim($row[4]));

        return new MasterlistDruExpenses([
            'jenis_agihan' => $row[1],
            'ptj' => $ptj_code,
            'project' => trim($row[3]),
            'sub_project' => trim($row[4]),
            'sodo_long' => $row[5],
            'sodo_short' => $row[6],
            'month' => $row[7],
            'year' => $row[8],
            'amount' => $row[9],
            'tabung_induk' => $tabung_induk,
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