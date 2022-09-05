<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistPublication;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PublicationThirdSheetImport implements ToModel, WithStartRow, WithChunkReading
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
                'publication_type' => 'others_journal',
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
                'industrial' => null,
                'international' => null,
                'national' => null,
                'document_title' => $row[10],
                'source_title' => $row[11],
                'document_type_scopus' => null,
                'document_type' => $row[12],
                'volume' => $row[13],
                'issue' => $row[14],
                'citation_y1' => null,
                'citation_y2' => null,
                'citation_y3' => null,
                'citation_y4' => null,
                'citation_y5' => null,
                'citation_total' => null,
                'page_start' => $row[15],
                'page_end' => $row[16],
                'book_editor' => null,
                'book_status' => null,
                'publisher' => null,
                'stakeholder' => null,
                'level' => null,
                'year' => $row[17],
                'issn' => $row[18],
                'quartile' => null,
                'quartile_link' => null,
                'remark' =>$row[20],
                'remark_scopus' => null,
                'remark_wos' => null,
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