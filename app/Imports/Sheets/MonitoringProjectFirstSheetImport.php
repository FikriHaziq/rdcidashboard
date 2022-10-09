<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistMonitoringProject;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MonitoringProjectFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistMonitoringProject([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'project_id' => $row[1],
                'staff_id' => $row[2],
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
                'name' => $row[14],
                'st' => $row[15],
                'status' => $row[16],
                'research_title' => $row[17],
                'start_date' => excelDate($row[18]),
                'end_date' => excelDate($row[19]),
                'duration_month' => is_numeric($row[20]) ? $row[20]: 0,
                'project_status' => $row[21],
                'project_extension' => $row[22],
                'extension_start_date' => excelDate($row[23]),
                'extension_end_date' => excelDate($row[24]),
                'sponsor' => $row[25],
                'sponsor_category' => $row[26],
                'grant_name' => $row[27],
                'amount_pledged' => is_numeric($row[28]) ? $row[28]: 0,
                'amount_received' => is_numeric($row[29]) ? $row[29]: 0,
                'amount_spent' => is_numeric($row[30]) ? $row[30]: 0,
                'pi' => $row[31],
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