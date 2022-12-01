<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Sheets\PublicationCitationSheetImport;
use App\Imports\Sheets\PublicationFirstSheetImport;
use App\Imports\Sheets\PublicationSecondSheetImport;
use App\Imports\Sheets\PublicationThirdSheetImport;
use App\Imports\Sheets\PublicationFourthSheetImport;
use App\Imports\Sheets\PublicationFifthSheetImport;
use App\Imports\Sheets\PublicationSixthSheetImport;
use App\Imports\Sheets\PublicationSeventhSheetImport;
use App\Imports\Sheets\PublicationEighthSheetImport;
use App\Imports\Sheets\PublicationNinethSheetImport;
use App\Models\MasterList\MasterlistPublication;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class PublicationImport implements WithMultipleSheets, SkipsUnknownSheets 
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
        MasterlistPublication::where('ml_end_year', $this->year)->delete();
    }

    public function sheets(): array
    {
        return [
            0 => new PublicationCitationSheetImport($this->year),
            1 => new PublicationFirstSheetImport($this->year),
            2 => new PublicationSecondSheetImport($this->year),
            3 => new PublicationThirdSheetImport($this->year),
            4 => new PublicationFourthSheetImport($this->year),
            5 => new PublicationFifthSheetImport($this->year),
            6 => new PublicationSixthSheetImport($this->year),
            7 => new PublicationSeventhSheetImport($this->year),
            8 => new PublicationEighthSheetImport($this->year),
            9 => new PublicationNinethSheetImport($this->year),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet 
    }
}