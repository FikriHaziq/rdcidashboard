<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterlistAward;
use App\Models\DataAttachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class AwardFirstSheetImport implements ToModel, WithStartRow, WithChunkReading
{
    public $year;

    public function  __construct($year)
    {
        $this->year= $year;
    }

    public function model(Array $row)
    {
        // $start_date = null;
        // $end_date = null;
        // if($row[11]){
        //     $str = explode('-',$row[11]);
        //     if(count($str) < 2){
        //         $start_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($str[0])->format('Y-m-d');
        //         $end_date = $start_date;
        //     }
        //     else{
        //         $end_date = date('Y-m-d', strtotime(str_replace('/','-',trim($str[1]))));
        //         if(strpos($str[0], '/') !== false){
        //             $start_date = date('Y-m-d', strtotime(trim($str[0])));
        //         }
        //         else{
        //             $start_date = date('Y-m-d', strtotime(trim($str[0]).'-'.date('m', strtotime($end_date)).'-'.date('Y', strtotime($end_date))));
        //         }
        //     }
        // }
        if($row[1]){
            return new MasterlistAward([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'staff_id' => $row[1],
                'staff_name' => $row[2],
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
                'award_name' => strtoupper($row[14]),
                'award_type' => strtoupper($row[15]),
                'conferring_body' => strtoupper($row[16]),
                'nat_int' => strtoupper($row[17]),
                'title' => strtoupper($row[18]),
                'event' => strtoupper($row[19]),
                'start_date' => excelDate($row[20]),
                'end_date' => excelDate($row[21]),
            ]);
        }
    }

    public function startRow(): int
    {
        return 3;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}