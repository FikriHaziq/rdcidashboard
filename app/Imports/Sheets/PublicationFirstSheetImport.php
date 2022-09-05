<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistPublication;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PublicationFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistPublication([
                'publication_type' => 'journal',
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'document_id' => strtoupper($row[1]),
                'staff_id' => strtoupper($row[2]),
                'faculty_code' => $row[3] == '-' ? null: $row[3],
                'school_code' => $row[4] == '-' ? null: $row[4],
                'institute_code' => $row[5] == '-' ? null: $row[5],
                'rc_code' => $row[6] == '-' ? null: $row[6],
                'staff_name' => $row[7],
                'co_author_staff_id' => $row[8],
                'authors' => $row[9],
                'industrial' => $row[10],
                'international' => $row[11],
                'national' => $row[12],
                'document_title' => $row[13],
                'source_title' => $row[14],
                'document_type_scopus' => $row[15],
                'document_type' => null,
                'volume' => $row[16],
                'issue' => $row[17],
                'citation_y1' => null,
                'citation_y2' => null,
                'citation_y3' => null,
                'citation_y4' => null,
                'citation_y5' => null,
                'citation_total' => null,
                'page_start' => $row[18],
                'page_end' => $row[19],
                'book_editor' => null,
                'book_status' => null,
                'publisher' => null,
                'stakeholder' => null,
                'level' => null,
                'year' => $row[20],
                'issn' => $row[21],
                'quartile' => $row[22],
                'quartile_link' => null,
                'remark' =>$row[24],
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