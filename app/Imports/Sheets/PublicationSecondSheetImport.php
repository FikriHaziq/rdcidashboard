<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterListPublication;
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
        if($row[1]){
            return new MasterListPublication([
                'publication_type' => 'proceeding',
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'document_id' => strtoupper($row[1]),
                'staff_id' => strtoupper($row[2]),
                'staff_name' => $row[3],
                'co_author_staff_id' => $row[4],
                'authors' => $row[5],
                'industrial' => $row[6],
                'international' => $row[7],
                'national' => $row[8],
                'document_title' => $row[9],
                'source_title' => null,
                'document_type_scopus' => $row[10],
                'document_type' => $row[11],
                'volume' => $row[12],
                'issue' => $row[13],
                'citation_y1' => null,
                'citation_y2' => null,
                'citation_y3' => null,
                'citation_y4' => null,
                'citation_y5' => null,
                'citation_total' => null,
                'page_start' => $row[14],
                'page_end' => $row[15],
                'book_editor' => null,
                'book_status' => null,
                'publisher' => null,
                'stakeholder' => null,
                'level' => null,
                'year' => $row[16],
                'issn' => $row[17],
                'quartile' => null,
                'quartile_link' => null,
                'remark' =>$row[20],
                'remark_scopus' => $row[21],
                'remark_wos' => $row[22],
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