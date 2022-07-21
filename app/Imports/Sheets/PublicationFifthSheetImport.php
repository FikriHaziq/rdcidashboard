<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterListPublication;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PublicationFifthSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterListPublication([
                'publication_type' => 'research_book',
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'document_id' => $row[1],
                'staff_id' => $row[2],
                'staff_name' => $row[3],
                'co_author_staff_id' => $row[4],
                'authors' => $row[5],
                'industrial' => $row[6],
                'international' => $row[7],
                'national' => $row[8],
                'document_title' => $row[9],
                'source_title' => null,
                'document_type_scopus' => null,
                'document_type' => null,
                'volume' => null,
                'issue' => null,
                'citation_y1' => null,
                'citation_y2' => null,
                'citation_y3' => null,
                'citation_y4' => null,
                'citation_y5' => null,
                'citation_total' => null,
                'page_start' => null,
                'page_end' => null,
                'book_editor' => null,
                'book_status' => $row[12],
                'publisher' => $row[10],
                'stakeholder' => null,
                'level' => null,
                'year' => null,
                'issn' => $row[11],
                'quartile' => null,
                'quartile_link' => null,
                'remark' =>$row[15],
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