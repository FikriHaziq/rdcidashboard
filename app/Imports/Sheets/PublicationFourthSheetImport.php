<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterListPublication;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PublicationFourthSheetImport implements ToModel, WithStartRow, WithChunkReading
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
                'publication_type' => 'citation',
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'document_id' => null,
                'staff_id' => null,
                'staff_name' => null,
                'co_author_staff_id' => null,
                'authors' => $row[3],
                'industrial' => null,
                'international' => null,
                'national' => null,
                'document_title' => $row[2],
                'source_title' => $row[5],
                'document_type_scopus' => null,
                'document_type' => null,
                'volume' => $row[6],
                'issue' => $row[7],
                'citation_y1' => $row[8],
                'citation_y2' => $row[9],
                'citation_y3' => $row[10],
                'citation_y4' => $row[11],
                'citation_y5' => $row[12],
                'citation_total' => (int)($row[8]??0)+(int)($row[9]??0)+(int)($row[10]??0)+(int)($row[11]??0)+(int)($row[12]??0),
                'page_start' => null,
                'page_end' => null,
                'book_editor' => null,
                'book_status' => null,
                'publisher' => null,
                'stakeholder' => null,
                'level' => null,
                'year' => $row[1],
                'issn' => $row[4],
                'quartile' => null,
                'quartile_link' => null,
                'remark' =>$row[14],
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