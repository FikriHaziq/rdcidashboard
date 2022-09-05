<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistJointResearchProject;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class JointResearchProjectFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        if($row[1]){
            return new MasterlistJointResearchProject([
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
                'staff_status' => $row[10],
                'staff_type' => $row[11],
                'research_title' => $row[12],
                'start_date' => excelDate($row[13]),
                'end_date' => excelDate($row[14]),
                'duration' => is_numeric($row[15]) ? $row[15] : null,
                'project_status' => $row[16],
                'project_extension' => $row[17],
                'sponsor' => $row[18],
                'sponsor_category' => $row[19],
                'grant_name' => $row[20],
                'amount_pledged' => is_numeric($row[21]) ? $row[21] : 0,
                'amount_received' => is_numeric($row[22]) ? $row[22] : 0,
                'amount_spent' => is_numeric($row[23]) ? $row[23] : 0,
                'organizer_1' => $row[24],
                'organizer_2' => $row[25],
                'organizer_3' => $row[26],
                'remark' => $row[28],
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