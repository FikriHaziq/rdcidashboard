<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistLibraryFacility;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class LibraryFacilityFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistLibraryFacility([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'title' => $row[1],
                'type' => $row[2],
                'no_of_title' => is_numeric($row[3]) ? $row[3] : null,
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