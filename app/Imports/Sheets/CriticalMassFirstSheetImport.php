<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistCriticalMass;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CriticalMassFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistCriticalMass([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'project_id' => $row[1],
                'staff_id' => $row[2],
                'faculty_code' => $row[3] == '-' ? null: $row[3],
                'school_code' => $row[4] == '-' ? null: $row[4],
                'institute_code' => $row[5] == '-' ? null: $row[5],
                'rc_code' => $row[6] == '-' ? null: $row[6],
                'name' => $row[7],
                'faculty' => $row[8],
                'st' => $row[9],
                'status' => $row[10],
                'research_title' => $row[11],
                'start_date' => excelDate($row[12]),
                'end_date' => excelDate($row[13]),
                'duration_month' => is_numeric($row[14]) ? $row[14]: null,
                'project_status' => $row[15],
                'project_extension' => $row[16],
                'extension_start_date' => excelDate($row[17]),
                'extension_end_date' => excelDate($row[18]),
                'sponsor' => $row[19],
                'sponsor_category' => $row[20],
                'grant_name' => $row[21],
                'amount_pledged' => is_numeric($row[22]) ? $row[22]: 0,
                'amount_received' => is_numeric($row[23]) ? $row[23]: 0,
                'amount_spent' => is_numeric($row[24]) ? $row[24]: 0,
                'remark' => $row[26],
                'pi' => $row[27],
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