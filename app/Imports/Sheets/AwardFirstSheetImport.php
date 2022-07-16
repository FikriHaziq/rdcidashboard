<?php

namespace App\Imports\Sheets;

use App\Models\MasterList\MasterListAward;
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
        $start_date = null;
        $end_date = null;
        if($row[11]){
            $str = explode('-',$row[11]);
            if(count($str) < 2){
                $start_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($str[0])->format('Y-m-d');
                $end_date = $start_date;
            }
            else{
                $end_date = date('Y-m-d', strtotime(str_replace('/','-',trim($str[1]))));
                if(strpos($str[0], '/') !== false){
                    $start_date = date('Y-m-d', strtotime(trim($str[0])));
                }
                else{
                    $start_date = date('Y-m-d', strtotime(trim($str[0]).'-'.date('m', strtotime($end_date)).'-'.date('Y', strtotime($end_date))));
                }
            }
        }
        if($row[1]){
            return new MasterListAward([
                'ml_start_year' => $this->year,
                'ml_end_year' => $this->year,
                'staff_id' => $row[1],
                'staff_name' => $row[2],
                'faculty' => $row[3],
                'award_name' => $row[4],
                'award_level' => $row[5],
                'award_type' => $row[6],
                'conferring_body' => $row[7],
                'nat_int' => $row[8],
                'title' => $row[9],
                'event' => $row[10],
                'start_date' => $start_date,
                'end_date' => $end_date,
                'remark' => $row[16],
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