<?php

namespace App\Imports\Sheets;

use App\Models\DataAttachment;
use App\Models\Parameter;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\MasterList\MasterlistDruAllocation;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class DruAllocationFirstSheetImport implements ToCollection, WithStartRow, WithChunkReading, WithCalculatedFormulas
{
    public $ptj;
    public $program;
    public $bpki;
    public function  __construct()
    {
        $this->ptj = Parameter::select(['id', 'original_code', 'parameter_name as name'])->whereIn('group_id',[1,2])->get()->toArray();
        $this->program = Parameter::select(['id', 'code'])->whereIn('group_id',[3])->get()->toArray();
        $this->bpki = Parameter::select(['id', 'code'])->whereIn('group_id',[4])->get()->toArray();
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            if($row[1]){
                $ptj_check = [];
                $program_check = [];
                $bpki_check = [];
                $ptj_check = array_filter($this->ptj, function($parameter) use ($row) {
                    return strpos($parameter['original_code'], rtrimMinLength(trim($row[5]),'0')) !== false;
                });
                $program_check = array_filter($this->program, function($parameter) use ($row) {
                    return strpos($parameter['code'], rtrimMinLength(trim($row[2]),'0')) !== false;
                });
                $bpki_check = array_filter($this->bpki, function($parameter) use ($row) {
                    return strpos($parameter['code'], rtrimMinLength(trim($row[3]),'0')) !== false;
                });

                $ptj_check = array_values($ptj_check);
                $program_check = array_values($program_check);
                $bpki_check = array_values($bpki_check);

                $program_id = !empty($program_check) ? $program_check[0]['id'] : null;
                $bpki_id = !empty($bpki_check) ? $bpki_check[0]['id'] : null;
                $ptj = !empty($ptj_check) ? $ptj_check[0]['name']: $row[4];
                $ptj_code = !empty($ptj_check) ? $ptj_check[0]['original_code']: rtrimMinLength(trim($row[5]),'0');
                $project = trim($row[6]);
                $sub_project = trim($row[7]);
                $tabung_induk = getMainFundByFormula($project, $sub_project);
                $jenis_agihan = $row[8];
                $expenditure_type = $row[9];

                //2011
                if($row[10] && $row[10] != 0){
                    MasterListDruAllocation::create([
                        'tabung_induk' => $tabung_induk,
                        'program_id' => $program_id,
                        'bpki_id' => $bpki_id, 
                        'ptj' => $ptj, 
                        'ptj_code' => $ptj_code, 
                        'project' => $project, 
                        'sub_project' => $sub_project, 
                        'jenis_agihan' => $jenis_agihan, 
                        'expenditure_type' => $expenditure_type,
                        'year' => 2011,
                        'year_desc' => null,
                        'amount' => $row[10],
                    ]);
                }

                //2012
                if($row[11] && $row[11] != 0){
                    MasterListDruAllocation::create([
                        'tabung_induk' => $tabung_induk,
                        'program_id' => $program_id,
                        'bpki_id' => $bpki_id, 
                        'ptj' => $ptj, 
                        'ptj_code' => $ptj_code, 
                        'project' => $project, 
                        'sub_project' => $sub_project, 
                        'jenis_agihan' => $jenis_agihan, 
                        'expenditure_type' => $expenditure_type,
                        'year' => 2012,
                        'year_desc' => null,
                        'amount' => $row[11],
                    ]);
                }

                //2013
                if($row[12] && $row[12] != 0){
                    MasterListDruAllocation::create([
                        'tabung_induk' => $tabung_induk,
                        'program_id' => $program_id,
                        'bpki_id' => $bpki_id, 
                        'ptj' => $ptj, 
                        'ptj_code' => $ptj_code, 
                        'project' => $project, 
                        'sub_project' => $sub_project, 
                        'jenis_agihan' => $jenis_agihan, 
                        'expenditure_type' => $expenditure_type,
                        'year' => 2013,
                        'year_desc' => null,
                        'amount' => $row[12],
                    ]);
                }

                //2014
                if($row[13] && $row[13] != 0){
                    MasterListDruAllocation::create([
                        'tabung_induk' => $tabung_induk,
                        'program_id' => $program_id,
                        'bpki_id' => $bpki_id, 
                        'ptj' => $ptj, 
                        'ptj_code' => $ptj_code, 
                        'project' => $project, 
                        'sub_project' => $sub_project, 
                        'jenis_agihan' => $jenis_agihan, 
                        'expenditure_type' => $expenditure_type,
                        'year' => 2014,
                        'year_desc' => null,
                        'amount' => $row[13],
                    ]);
                }

                //2015
                if($row[14] && $row[14] != 0){
                    MasterListDruAllocation::create([
                        'tabung_induk' => $tabung_induk,
                        'program_id' => $program_id,
                        'bpki_id' => $bpki_id, 
                        'ptj' => $ptj, 
                        'ptj_code' => $ptj_code, 
                        'project' => $project, 
                        'sub_project' => $sub_project, 
                        'jenis_agihan' => $jenis_agihan, 
                        'expenditure_type' => $expenditure_type,
                        'year' => 2015,
                        'year_desc' => null,
                        'amount' => $row[14],
                    ]);
                }

                //2016
                if($row[15] && $row[15] != 0){
                    MasterListDruAllocation::create([
                        'tabung_induk' => $tabung_induk,
                        'program_id' => $program_id,
                        'bpki_id' => $bpki_id, 
                        'ptj' => $ptj, 
                        'ptj_code' => $ptj_code, 
                        'project' => $project, 
                        'sub_project' => $sub_project, 
                        'jenis_agihan' => $jenis_agihan, 
                        'expenditure_type' => $expenditure_type,
                        'year' => 2016,
                        'year_desc' => null,
                        'amount' => $row[15],
                    ]);
                }

                //2016 ii
                if($row[16] && $row[16] != 0){
                    MasterListDruAllocation::create([
                        'tabung_induk' => $tabung_induk,
                        'program_id' => $program_id,
                        'bpki_id' => $bpki_id, 
                        'ptj' => $ptj, 
                        'ptj_code' => $ptj_code, 
                        'project' => $project, 
                        'sub_project' => $sub_project, 
                        'jenis_agihan' => $jenis_agihan, 
                        'expenditure_type' => $expenditure_type,
                        'year' => 2016,
                        'year_desc' => null,
                        'amount' => $row[16],
                    ]);
                }
                //2017
                if($row[17] && $row[17] != 0){
                    MasterListDruAllocation::create([
                        'tabung_induk' => $tabung_induk,
                        'program_id' => $program_id,
                        'bpki_id' => $bpki_id, 
                        'ptj' => $ptj, 
                        'ptj_code' => $ptj_code, 
                        'project' => $project, 
                        'sub_project' => $sub_project, 
                        'jenis_agihan' => $jenis_agihan, 
                        'expenditure_type' => $expenditure_type,
                        'year' => 2017,
                        'year_desc' => null,
                        'amount' => $row[17],
                    ]);
                }
                //2017 ii
                if($row[18] && $row[18] != 0){
                    MasterListDruAllocation::create([
                        'tabung_induk' => $tabung_induk,
                        'program_id' => $program_id,
                        'bpki_id' => $bpki_id, 
                        'ptj' => $ptj, 
                        'ptj_code' => $ptj_code, 
                        'project' => $project, 
                        'sub_project' => $sub_project, 
                        'jenis_agihan' => $jenis_agihan, 
                        'expenditure_type' => $expenditure_type,
                        'year' => 2017,
                        'year_desc' => null,
                        'amount' => $row[18],
                    ]);
                }
                //2017 iii
                if($row[19] && $row[19] != 0){
                    MasterListDruAllocation::create([
                        'tabung_induk' => $tabung_induk,
                        'program_id' => $program_id,
                        'bpki_id' => $bpki_id, 
                        'ptj' => $ptj, 
                        'ptj_code' => $ptj_code, 
                        'project' => $project, 
                        'sub_project' => $sub_project, 
                        'jenis_agihan' => $jenis_agihan, 
                        'expenditure_type' => $expenditure_type,
                        'year' => 2017,
                        'year_desc' => null,
                        'amount' => $row[19],
                    ]);
                }
                //2018 
                if($row[20] && $row[20] != 0){
                    MasterListDruAllocation::create([
                        'tabung_induk' => $tabung_induk,
                        'program_id' => $program_id,
                        'bpki_id' => $bpki_id, 
                        'ptj' => $ptj, 
                        'ptj_code' => $ptj_code, 
                        'project' => $project, 
                        'sub_project' => $sub_project, 
                        'jenis_agihan' => $jenis_agihan, 
                        'expenditure_type' => $expenditure_type,
                        'year' => 2018,
                        'year_desc' => null,
                        'amount' => $row[20],
                    ]);
                }
                //2019
                if($row[21] && $row[21] != 0){
                    MasterListDruAllocation::create([
                        'tabung_induk' => $tabung_induk,
                        'program_id' => $program_id,
                        'bpki_id' => $bpki_id, 
                        'ptj' => $ptj, 
                        'ptj_code' => $ptj_code, 
                        'project' => $project, 
                        'sub_project' => $sub_project, 
                        'jenis_agihan' => $jenis_agihan, 
                        'expenditure_type' => $expenditure_type,
                        'year' => 2019,
                        'year_desc' => null,
                        'amount' => $row[21],
                    ]);
                }
                //2019 ii
                if($row[22] && $row[22] != 0){
                    MasterListDruAllocation::create([
                        'tabung_induk' => $tabung_induk,
                        'program_id' => $program_id,
                        'bpki_id' => $bpki_id, 
                        'ptj' => $ptj, 
                        'ptj_code' => $ptj_code, 
                        'project' => $project, 
                        'sub_project' => $sub_project, 
                        'jenis_agihan' => $jenis_agihan, 
                        'expenditure_type' => $expenditure_type,
                        'year' => 2019,
                        'year_desc' => null,
                        'amount' => $row[22],
                    ]);
                }
                //2020
                if($row[23] && $row[23] != 0){
                    MasterListDruAllocation::create([
                        'tabung_induk' => $tabung_induk,
                        'program_id' => $program_id,
                        'bpki_id' => $bpki_id, 
                        'ptj' => $ptj, 
                        'ptj_code' => $ptj_code, 
                        'project' => $project, 
                        'sub_project' => $sub_project, 
                        'jenis_agihan' => $jenis_agihan, 
                        'expenditure_type' => $expenditure_type,
                        'year' => 2020,
                        'year_desc' => null,
                        'amount' => $row[23],
                    ]);
                }
                //2021
                if($row[24] && $row[24] != 0){
                    MasterListDruAllocation::create([
                        'tabung_induk' => $tabung_induk,
                        'program_id' => $program_id,
                        'bpki_id' => $bpki_id, 
                        'ptj' => $ptj, 
                        'ptj_code' => $ptj_code, 
                        'project' => $project, 
                        'sub_project' => $sub_project, 
                        'jenis_agihan' => $jenis_agihan, 
                        'expenditure_type' => $expenditure_type,
                        'year' => 2021,
                        'year_desc' => null,
                        'amount' => $row[24],
                    ]);
                }
                //2021 ii
                if($row[25] && $row[25] != 0){
                    MasterListDruAllocation::create([
                        'tabung_induk' => $tabung_induk,
                        'program_id' => $program_id,
                        'bpki_id' => $bpki_id, 
                        'ptj' => $ptj, 
                        'ptj_code' => $ptj_code, 
                        'project' => $project, 
                        'sub_project' => $sub_project, 
                        'jenis_agihan' => $jenis_agihan, 
                        'expenditure_type' => $expenditure_type,
                        'year' => 2021,
                        'year_desc' => null,
                        'amount' => $row[25],
                    ]);
                }
                //2022
                if($row[26] && $row[26] != 0){
                    MasterListDruAllocation::create([
                        'tabung_induk' => $tabung_induk,
                        'program_id' => $program_id,
                        'bpki_id' => $bpki_id, 
                        'ptj' => $ptj, 
                        'ptj_code' => $ptj_code, 
                        'project' => $project, 
                        'sub_project' => $sub_project, 
                        'jenis_agihan' => $jenis_agihan, 
                        'expenditure_type' => $expenditure_type,
                        'year' => 2022,
                        'year_desc' => null,
                        'amount' => $row[26],
                    ]);
                }
                //2023
                if($row[27] && $row[27] != 0){
                    MasterListDruAllocation::create([
                        'tabung_induk' => $tabung_induk,
                        'program_id' => $program_id,
                        'bpki_id' => $bpki_id, 
                        'ptj' => $ptj, 
                        'ptj_code' => $ptj_code, 
                        'project' => $project, 
                        'sub_project' => $sub_project, 
                        'jenis_agihan' => $jenis_agihan, 
                        'expenditure_type' => $expenditure_type,
                        'year' => 2023,
                        'year_desc' => null,
                        'amount' => $row[27],
                    ]);
                }
            }
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