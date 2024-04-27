<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\DruExpensesFirstSheetImport;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use App\Models\MasterList\MasterlistDruExpenses;

class DruExpensesImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $migration_code;
    
    public function  __construct($migration_code)
    {
        MasterlistDruExpenses::whereMigration($migration_code)->delete();
        $this->migration_code = $migration_code;
    }

    public function sheets(): array
    {
        return [
            0 => new DruExpensesFirstSheetImport($this->migration_code),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}