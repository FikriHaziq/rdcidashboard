<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterListElnptProposal;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ElnptProposalFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[0]){
            return new MasterListElnptProposal([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'reference_no' => $row[0],
                'grant_name' => $row[1],
                'staff_id' => $row[2],
                'staff_name' => $row[3],
                'faculty' => $row[4],
                'school' => $row[5],
                'ra' => $row[6],
                'research_title' => $row[7],
                'subsponsor' => $row[8],
                'total_sodo_item_in_proposal' => is_numeric($row[9]) ? $row[9] : 0,
                'status_proposal' => $row[10],
                'unit' => $row[11],
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