<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistPublication;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PublicationSecondSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[0]){
            return new MasterlistPublication([
                'publication_type' => 'proceeding',
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'document_id' => strtoupper($row[1]),
                'staff_id' => strtoupper($row[2]),
                'faculty_code' => $row[3] == '-' ? null: $row[3],
                'faculty_short' => $row[4] == '-' ? null: $row[4],
                'faculty_long' => $row[5] == '-' ? null: $row[5],
                'school_code' => $row[6] == '-' ? null: $row[6],
                'school_short' => $row[7] == '-' ? null: $row[7],
                'school_long' => $row[8] == '-' ? null: $row[8],
                'research_group' => $row[9] == '-' ? null: $row[9],
                'institute_short' => $row[10] == '-' ? null: $row[10],
                'institute_long' => $row[11] == '-' ? null: $row[11],
                'rc_short' => $row[12] == '-' ? null: $row[12],
                'rc_long' => $row[13] == '-' ? null: $row[13],
                'staff_name' => $row[14],
                'co_author_staff_id' => $row[15],
                'authors' => $row[16],
                'industrial' => $row[17],
                'international' => $row[18],
                'national' => $row[19],
                'document_title' => $row[20],
                'source_title' => $row[21],
                'document_type' => $row[22],
                'volume' => $row[23],
                'issue' => $row[24],
                'page_start' => $row[25],
                'page_end' => $row[26],
                'year' => is_numeric($row[27]) ? $row[27]: null,
                'issn' => $row[28],
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