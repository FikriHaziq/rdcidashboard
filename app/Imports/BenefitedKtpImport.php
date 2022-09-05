<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\BenefitedKtpFirstSheetImport;
use App\Models\MasterList\MasterlistBenefitedKtp;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class BenefitedKtpImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistBenefitedKtp::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new BenefitedKtpFirstSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}
