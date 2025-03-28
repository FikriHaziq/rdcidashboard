<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\API\GeneralController as Api;
use App\Http\Traits\MasterListMyraTrait;
use App\Models\DataAttachment;
use App\Models\Parameter;
use App\Models\MyraCalculation;
use App\Models\DanaRU\DruProject;
use App\Models\DanaRU\DruDistFund;
use App\Models\DanaRU\DruKpiTemplate;
use App\Models\DanaRU\DruDistributionPlanForm;
use App\Models\DanaRU\DruMember;
use Illuminate\Support\Facades\DB;
use App\Traits\MailTrait;

class AjaxController extends Controller
{
    use MasterListMyraTrait;
    use MailTrait;
    
    public function getGrantMestec(Request $request)
    {
        $data2 = json_decode($request->data);
        $data = json_decode(json_encode($data2), true);
        $filter_data = json_decode($request->filter);
        if(isset($filter_data->sponsor_category)){
            $data = array_filter($data, function ($var) use ($filter_data){
                if($filter_data->sponsor_category == "ALL") return true;
                else return ($var['SPONSOR_CATEGORY'] == $filter_data->sponsor_category);
            });
        }
        $result = Api::processGrantMestecc($data);
        $result['sponsor_category'] = array_values(array_filter($result['sponsor_category'], function ($var) use ($filter_data){
            if($filter_data->sponsor_category == "ALL") return true;
            else return ($var['sponsor'] == $filter_data->sponsor_category);
        }));
        return response()->json([
            "result" => $result,
            "filter" => $filter_data
        ], 200);
    }

    public function selectData($id)
    {
        $status = false;
        $file = DataAttachment::find($id);
        if($file){
            $module = $file->module;
            $others = DataAttachment::where('year', $file->year)->whereModule($module)->whereNull('d_ts')->get();
            foreach ($others as $key => $other) {
                $other->status = 'not-selected';
                $other->save();
            }
            $file->status = 'selected';
            $file->save();
            $status = true;
        }
        return response()->json([
            "status" => $status,
        ], 200);
    }

    public function updateMyraMark(Request $request)
    {
        $status_code = 500;
        $data = null;
        $final = null;
        if($request->section == "section_b"){
            $rawData = $this->myraSectionB($request->year);
            if(isset($rawData->calculation)){
                $data = $rawData->calculation;
                $final = [
                    "benchmark_target" => [
                        "critical_mass" => [
                            "university" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[1],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[1],
                            ],
                            "national" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[2],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[2],
                            ],
                            "private" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[3],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[3],
                            ],
                            "international" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[4],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[4],
                            ],
                        ],
                        "phd_pro" => [
                            "phd" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_2[0],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_2[0],
                            ],
                            "professional" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_2[1],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_2[1],
                            ],
                        ],
                        "research_experience" => [
                            "above_50" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_3[1],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_3[1],
                            ],
                            "middle_50" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_3[2],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_3[2],
                            ],
                            "below_40" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_3[3],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_3[3], 
                            ],
                        ],
                        "award" => [
                            "award_international" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_4[0],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_4[0],
                            ],
                            "recog_international" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_4[1],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_4[1],
                            ],
                            "award_national" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_4[2],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_4[2], 
                            ],
                            "recog_national" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_4[3],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_4[3], 
                            ],
                            "exhibition" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_4[4],
                            ],
                            "other" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_4[5],
                            ],
                        ],
                    ],
                    "benchmark_mark" => [
                        "critical_mass" => [
                            "university" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[1],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[1],
                            ],
                            "national" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[2],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[2],
                            ],
                            "private" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[3],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[3],
                            ],
                            "international" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[4],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[4],
                            ],
                        ],
                        "phd_pro" => [
                            "phd" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_2[0],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_2[0],
                            ],
                            "professional" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_2[1],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_2[1],
                            ],
                        ],
                        "research_experience" => [
                            "above_50" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_3[1],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_3[1],
                            ],
                            "middle_50" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_3[2],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_3[2],
                            ],
                            "below_40" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_3[3],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_3[3], 
                            ],
                        ],
                        "award" => [
                            "award_international" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_4[0],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_4[0],
                            ],
                            "recog_international" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_4[1],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_4[1],
                            ],
                            "award_national" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_4[2],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_4[2], 
                            ],
                            "recog_national" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_4[3],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_4[3], 
                            ],
                            "exhibition" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_4[4],
                            ],
                            "other" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_4[5],
                            ],
                        ],
                    ],
                    "mark" => [
                        "critical_mass" => [
                            "university" => [
                                "myra1_mark" => $data->myra1_mark_1[1],
                                "myra2_mark" => $data->myra2_mark_1[1],
                            ],
                            "national" => [
                                "myra1_mark" => $data->myra1_mark_1[2],
                                "myra2_mark" => $data->myra2_mark_1[2],
                            ],
                            "private" => [
                                "myra1_mark" => $data->myra1_mark_1[3],
                                "myra2_mark" => $data->myra2_mark_1[3],
                            ],
                            "international" => [
                                "myra1_mark" => $data->myra1_mark_1[4],
                                "myra2_mark" => $data->myra2_mark_1[4],
                            ],
                        ],
                        "phd_pro" => [
                            "phd" => [
                                "myra1_mark" => $data->myra1_mark_2[0],
                                "myra2_mark" => $data->myra2_mark_2[0],
                            ],
                            "professional" => [
                                "myra1_mark" => $data->myra1_mark_2[1],
                                "myra2_mark" => $data->myra2_mark_2[1],
                                
                            ],
                        ],
                        "research_experience" => [
                            "above_50" => [
                                "myra1_mark" => $data->myra1_mark_3[1],
                                "myra2_mark" => $data->myra2_mark_3[1],
                            ],
                            "middle_50" => [
                                "myra1_mark" => $data->myra1_mark_3[2],
                                "myra2_mark" => $data->myra2_mark_3[2],
                            ],
                            "below_40" => [
                                "myra1_mark" => $data->myra1_mark_3[3],
                                "myra2_mark" => $data->myra2_mark_3[3],
                                
                            ],
                        ],
                        "award" => [
                            "award_international" => [
                                "myra1_mark" => $data->myra1_mark_4[0],
                                "myra2_mark" => $data->myra2_mark_4[0],
                            ],
                            "recog_international" => [
                                "myra1_mark" => $data->myra1_mark_4[1],
                                "myra2_mark" => $data->myra2_mark_4[1],
                            ],
                            "award_national" => [
                                "myra1_mark" => $data->myra1_mark_4[2],
                                "myra2_mark" => $data->myra2_mark_4[2], 
                            ],
                            "recog_national" => [
                                "myra1_mark" => $data->myra1_mark_4[3],
                                "myra2_mark" => $data->myra2_mark_4[3], 
                            ],
                            "exhibition" => [
                                "myra1_mark" => $data->myra1_mark_4[4],
                            ],
                            "other" => [
                                "myra1_mark" => $data->myra1_mark_4[5],
                            ],
                        ],
                    ],
                    "achievement" => [
                        "critical_mass" => [
                            "university" => [
                                "myra1_achievement" => $data->myra1_achievement_1[0],
                                "myra2_achievement" => $data->myra2_achievement_1[0],
                            ],
                            "national" => [
                                "myra1_achievement" => $data->myra1_achievement_1[1],
                                "myra2_achievement" => $data->myra2_achievement_1[1],
                            ],
                            "private" => [
                                "myra1_achievement" => $data->myra1_achievement_1[2],
                                "myra2_achievement" => $data->myra2_achievement_1[2],
                            ],
                            "international" => [
                                "myra1_achievement" => $data->myra1_achievement_1[3],
                                "myra2_achievement" => $data->myra2_achievement_1[3],
                            ],
                        ],
                        "phd_pro" => [
                            "phd" => [
                                "myra1_achievement" => $data->myra1_achievement_2[0],
                                "myra2_achievement" => $data->myra2_achievement_2[0],
                            ],
                            "professional" => [
                                "myra1_achievement" => $data->myra1_achievement_2[1],
                                "myra2_achievement" => $data->myra2_achievement_2[1],
                            ],
                        ],
                        "research_experience" => [
                            "above_50" => [
                                "myra1_achievement" => $data->myra1_achievement_3[0],
                                "myra2_achievement" => $data->myra2_achievement_3[0],
                            ],
                            "middle_50" => [
                                "myra1_achievement" => $data->myra1_achievement_3[1],
                                "myra2_achievement" => $data->myra2_achievement_3[1],
                            ],
                            "below_40" => [
                                "myra1_achievement" => $data->myra1_achievement_3[2],
                                "myra2_achievement" => $data->myra2_achievement_3[2],
                                
                            ],
                        ],
                        "award" => [
                            "award_international" => [
                                "myra1_achievement" => $data->myra1_achievement_4[0],
                                "myra2_achievement" => $data->myra2_achievement_4[0],
                            ],
                            "recog_international" => [
                                "myra1_achievement" => $data->myra1_achievement_4[1],
                                "myra2_achievement" => $data->myra2_achievement_4[1],
                            ],
                            "award_national" => [
                                "myra1_achievement" => $data->myra1_achievement_4[2],
                                "myra2_achievement" => $data->myra2_achievement_4[2], 
                            ],
                            "recog_national" => [
                                "myra1_achievement" => $data->myra1_achievement_4[3],
                                "myra2_achievement" => $data->myra2_achievement_4[3], 
                            ],
                            "exhibition" => [
                                "myra1_achievement" => $data->myra1_achievement_4[4],
                            ],
                            "other" => [
                                "myra1_achievement" => $data->myra1_achievement_4[5],
                            ],
                        ],
                    ],
                    "overall_mark" => [
                        "myra1_benchmark_mark" => $data->total_myra1_benchmark_mark,
                        "myra1_mark" => $data->total_myra1_mark,
                        "myra1_achievement" => $data->total_myra1_benchmark_mark > 0? (float)number_format($data->total_myra1_mark/$data->total_myra1_benchmark_mark*100, 2) : 0,
                        "myra2_benchmark_mark" => $data->total_myra2_benchmark_mark,
                        "myra2_mark" => $data->total_myra2_mark,
                        "myra2_achievement" => $data->total_myra2_benchmark_mark > 0? (float)number_format($data->total_myra2_mark/$data->total_myra2_benchmark_mark*100, 2) : 0,
                    ]
                ];
                $status_code = 200;
            }
        }
        else if($request->section == "section_c"){
            $rawData = $this->myraSectionC($request->year);
            if(isset($rawData->calculation)){
                $data = $rawData->calculation;
                $final = [
                    "benchmark_target" => [
                        "publication" => [
                            "journal" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[0],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[0],
                            ],
                            "proceeding" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[1],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[1],
                            ],
                            "joint_industrial" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[2],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[2],
                            ],
                            "joint_international" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[3],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[3],
                            ],
                            "joint_national" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[4],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[4],
                            ],
                            "total_citation" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[5],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[5],
                            ],
                            "article" => [
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[6],
                            ],
                            "mycite" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[6],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[7],
                            ],
                            "indexed_book" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[7],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[8],
                            ],
                            "non_indexed_book" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[8],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[9],
                            ],
                            "indexed_chapter" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[9],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[10],
                            ],
                            "non_indexed_chapter" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[10],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[11],
                            ],
                            "case_studies" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[11] ?? 0,
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[12] ?? 0,
                            ],
                            "policy_paper" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[12] ?? 0,
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[13] ?? 0,
                            ],
                            "other" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[13] ?? 0,
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[14] ?? 0,
                            ],
                        ],
                        "research_grant" => [
                            "public_received" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_2[0],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_2[0],
                            ],
                            "private_received" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_2[1],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_2[1],
                            ],
                            "international_received" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_2[2],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_2[2],
                            ],
                        ],
                        "monitor_research" => [
                            "percent_complete" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_3[0],
                            ],
                        ],
                        
                    ],
                    "benchmark_mark" => [
                        "publication" => [
                            "journal" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[0],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[0],
                            ],
                            "proceeding" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[1],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[1],
                            ],
                            "joint_industrial" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[2],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[2],
                            ],
                            "joint_international" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[3],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[3],
                            ],
                            "joint_national" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[4],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[4],
                            ],
                            "total_citation" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[5],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[5],
                            ],
                            "article" => [
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[6],
                            ],
                            "mycite" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[6],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[7],
                            ],
                            "indexed_book" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[7],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[8],
                            ],
                            "non_indexed_book" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[8],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[9],
                            ],
                            "indexed_chapter" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[9],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[10],
                            ],
                            "non_indexed_chapter" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[10],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[11],
                            ],
                            "case_studies" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[11] ?? 0,
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[12] ?? 0,
                            ],
                            "policy_paper" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[12] ?? 0,
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[13] ?? 0,
                            ],
                            "other" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[13] ?? 0,
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[14] ?? 0,
                            ],
                        ],
                        "research_grant" => [
                            "public_received" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_2[0],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_2[0],
                            ],
                            "private_received" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_2[1],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_2[1],
                            ],
                            "international_received" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_2[2],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_2[2],
                            ],
                        ],
                        "monitor_research" => [
                            "percent_complete" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_3[0],
                            ],
                        ],
                        
                    ],
                    "mark" => [
                        "publication" => [
                            "journal" => [
                                "myra1_mark" => $data->myra1_mark_1[0],
                                "myra2_mark" => $data->myra2_mark_1[0],
                            ],
                            "proceeding" => [
                                "myra1_mark" => $data->myra1_mark_1[1],
                                "myra2_mark" => $data->myra2_mark_1[1],
                            ],
                            "joint_industrial" => [
                                "myra1_mark" => $data->myra1_mark_1[2],
                                "myra2_mark" => $data->myra2_mark_1[2],
                            ],
                            "joint_international" => [
                                "myra1_mark" => $data->myra1_mark_1[3],
                                "myra2_mark" => $data->myra2_mark_1[3],
                            ],
                            "joint_national" => [
                                "myra1_mark" => $data->myra1_mark_1[4],
                                "myra2_mark" => $data->myra2_mark_1[4],
                            ],
                            "total_citation" => [
                                "myra1_mark" => $data->myra1_mark_1[5],
                                "myra2_mark" => $data->myra2_mark_1[5],
                            ],
                            "article" => [
                                "myra2_mark" => $data->myra2_mark_1[6],
                            ],
                            "mycite" => [
                                "myra1_mark" => $data->myra1_mark_1[6],
                                "myra2_mark" => $data->myra2_mark_1[7],
                            ],
                            "indexed_book" => [
                                "myra1_mark" => $data->myra1_mark_1[7],
                                "myra2_mark" => $data->myra2_mark_1[8],
                            ],
                            "non_indexed_book" => [
                                "myra1_mark" => $data->myra1_mark_1[8],
                                "myra2_mark" => $data->myra2_mark_1[9],
                            ],
                            "indexed_chapter" => [
                                "myra1_mark" => $data->myra1_mark_1[9],
                                "myra2_mark" => $data->myra2_mark_1[10],
                            ],
                            "non_indexed_chapter" => [
                                "myra1_mark" => $data->myra1_mark_1[10],
                                "myra2_mark" => $data->myra2_mark_1[11],
                            ],
                            "case_studies" => [
                                "myra1_mark" => $data->myra1_mark_1[11] ?? 0,
                                "myra2_mark" => $data->myra2_mark_1[12] ?? 0,
                            ],
                            "policy_paper" => [
                                "myra1_mark" => $data->myra1_mark_1[12] ?? 0,
                                "myra2_mark" => $data->myra2_mark_1[13] ?? 0,
                            ],
                            "other" => [
                                "myra1_mark" => $data->myra1_mark_1[13] ?? 0,
                                "myra2_mark" => $data->myra2_mark_1[14] ?? 0,
                            ],
                        ],
                        "research_grant" => [
                            "public_received" => [
                                "myra1_mark" => $data->myra1_mark_2[0],
                                "myra2_mark" => $data->myra2_mark_2[0],
                            ],
                            "private_received" => [
                                "myra1_mark" => $data->myra1_mark_2[1],
                                "myra2_mark" => $data->myra2_mark_2[1],
                            ],
                            "international_received" => [
                                "myra1_mark" => $data->myra1_mark_2[2],
                                "myra2_mark" => $data->myra2_mark_2[2],
                            ],
                        ],
                        "monitor_research" => [
                            "percent_complete" => [
                                "myra1_mark" => $data->myra1_mark_3[0],
                            ],
                        ],
                    ],
                    "achievement" => [
                        "publication" => [
                            "journal" => [
                                "myra1_achievement" => $data->myra1_achievement_1[0],
                                "myra2_achievement" => $data->myra2_achievement_1[0],
                            ],
                            "proceeding" => [
                                "myra1_achievement" => $data->myra1_achievement_1[1],
                                "myra2_achievement" => $data->myra2_achievement_1[1],
                            ],
                            "joint_industrial" => [
                                "myra1_achievement" => $data->myra1_achievement_1[2],
                                "myra2_achievement" => $data->myra2_achievement_1[2],
                            ],
                            "joint_international" => [
                                "myra1_achievement" => $data->myra1_achievement_1[3],
                                "myra2_achievement" => $data->myra2_achievement_1[3],
                            ],
                            "joint_national" => [
                                "myra1_achievement" => $data->myra1_achievement_1[4],
                                "myra2_achievement" => $data->myra2_achievement_1[4],
                            ],
                            "total_citation" => [
                                "myra1_achievement" => $data->myra1_achievement_1[5],
                                "myra2_achievement" => $data->myra2_achievement_1[5],
                            ],
                            "article" => [
                                "myra2_achievement" => $data->myra2_achievement_1[6],
                            ],
                            "mycite" => [
                                "myra1_achievement" => $data->myra1_achievement_1[6],
                                "myra2_achievement" => $data->myra2_achievement_1[7],
                            ],
                            "indexed_book" => [
                                "myra1_achievement" => $data->myra1_achievement_1[7],
                                "myra2_achievement" => $data->myra2_achievement_1[8],
                            ],
                            "non_indexed_book" => [
                                "myra1_achievement" => $data->myra1_achievement_1[8],
                                "myra2_achievement" => $data->myra2_achievement_1[9],
                            ],
                            "indexed_chapter" => [
                                "myra1_achievement" => $data->myra1_achievement_1[9],
                                "myra2_achievement" => $data->myra2_achievement_1[10],
                            ],
                            "non_indexed_chapter" => [
                                "myra1_achievement" => $data->myra1_achievement_1[10],
                                "myra2_achievement" => $data->myra2_achievement_1[11],
                            ],
                            "case_studies" => [
                                "myra1_achievement" => $data->myra1_achievement_1[11] ?? 0,
                                "myra2_achievement" => $data->myra2_achievement_1[12] ?? 0,
                            ],
                            "policy_paper" => [
                                "myra1_achievement" => $data->myra1_achievement_1[12] ?? 0,
                                "myra2_achievement" => $data->myra2_achievement_1[13] ?? 0,
                            ],
                            "other" => [
                                "myra1_achievement" => $data->myra1_achievement_1[13] ?? 0,
                                "myra2_achievement" => $data->myra2_achievement_1[14] ?? 0,
                            ],
                        ],
                        "research_grant" => [
                            "public_received" => [
                                "myra1_achievement" => $data->myra1_achievement_2[0],
                                "myra2_achievement" => $data->myra2_achievement_2[0],
                            ],
                            "private_received" => [
                                "myra1_achievement" => $data->myra1_achievement_2[1],
                                "myra2_achievement" => $data->myra2_achievement_2[1],
                            ],
                            "international_received" => [
                                "myra1_achievement" => $data->myra1_achievement_2[2],
                                "myra2_achievement" => $data->myra2_achievement_2[2],
                            ],
                        ],
                        "monitor_research" => [
                            "percent_complete" => [
                                "myra1_achievement" => $data->myra1_achievement_3[0],
                            ],
                        ],
                    ],
                    "overall_mark" => [
                        "myra1_benchmark_mark" => $data->total_myra1_benchmark_mark,
                        "myra1_mark" => $data->total_myra1_mark,
                        "myra1_achievement" => $data->total_myra1_benchmark_mark > 0? (float)number_format($data->total_myra1_mark/$data->total_myra1_benchmark_mark*100, 2) : 0,
                        "myra2_benchmark_mark" => $data->total_myra2_benchmark_mark,
                        "myra2_mark" => $data->total_myra2_mark,
                        "myra2_achievement" => $data->total_myra2_benchmark_mark > 0? (float)number_format($data->total_myra2_mark/$data->total_myra2_benchmark_mark*100, 2) : 0,
                    ]
                ];
                $status_code = 200;
            }
        }
        else if($request->section == "section_d"){
            $rawData = $this->myraSectionD($request->year);
            if(isset($rawData->calculation)){
                $data = $rawData->calculation;
                $final = [
                    "benchmark_target" => [
                        "phd_graduate" => [
                            "ratio_phd_staff" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[0],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[0],
                            ],
                            "percent_phd_7_sem" => [
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[1],
                            ],
                        ],
                        "phd_enrolled" => [
                            "ratio_phd_staff" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_3[0],
                            ],
                        ],
                        "pg_enrolled" => [
                            "ratio_staff" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_4[0],
                            ],
                        ],
                        "pg_international" => [
                            "percentage_enrolled" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_5[0],
                            ],
                        ],
                        "pg_entry" => [
                            "percentage_enrolled" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_6[0],
                            ],
                        ],
                        "pg_research" => [
                            "percentage_enrolled" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_7[0],
                            ],
                        ],
                        "postdoc" => [
                            "percentage_enrolled" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_8[0],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_8[0],
                            ],
                        ],
                    ],
                    "benchmark_mark" => [
                        "phd_graduate" => [
                            "ratio_phd_staff" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[0],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[0],
                            ],
                            "percent_phd_7_sem" => [
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[1],
                            ],
                        ],
                        "phd_enrolled" => [
                            "ratio_phd_staff" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_3[0],
                            ],
                        ],
                        "pg_enrolled" => [
                            "ratio_staff" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_4[0],
                            ],
                        ],
                        "pg_international" => [
                            "percentage_enrolled" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_5[0],
                            ],
                        ],
                        "pg_entry" => [
                            "percentage_enrolled" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_6[0],
                            ],
                        ],
                        "pg_research" => [
                            "percentage_enrolled" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_7[0],
                            ],
                        ],
                        "postdoc" => [
                            "percentage_enrolled" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_8[0],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_8[0],
                            ],
                        ],
                    ],
                    "mark" => [
                        "phd_graduate" => [
                            "ratio_phd_staff" => [
                                "myra1_mark" => $data->myra1_mark_1[0],
                                "myra2_mark" => $data->myra2_mark_1[0],
                            ],
                            "percent_phd_7_sem" => [
                                "myra2_mark" => $data->myra2_mark_1[1],
                            ],
                        ],
                        "phd_enrolled" => [
                            "ratio_phd_staff" => [
                                "myra1_mark" => $data->myra1_mark_3[0],
                            ],
                        ],
                        "pg_enrolled" => [
                            "ratio_staff" => [
                                "myra1_mark" => $data->myra1_mark_4[0],
                            ],
                        ],
                        "pg_international" => [
                            "percentage_enrolled" => [
                                "myra1_mark" => $data->myra1_mark_5[0],
                            ],
                        ],
                        "pg_entry" => [
                            "percentage_enrolled" => [
                                "myra1_mark" => $data->myra1_mark_6[0],
                            ],
                        ],
                        "pg_research" => [
                            "percentage_enrolled" => [
                                "myra1_mark" => $data->myra1_mark_7[0],
                            ],
                        ],
                        "postdoc" => [
                            "percentage_enrolled" => [
                                "myra1_mark" => $data->myra1_mark_8[0],
                                "myra2_mark" => $data->myra2_mark_8[0],
                            ],
                        ],
                    ],
                    "achievement" => [
                        "phd_graduate" => [
                            "ratio_phd_staff" => [
                                "myra1_achievement" => $data->myra1_achievement_1[0],
                                "myra2_achievement" => $data->myra2_achievement_1[0],
                            ],
                            "percent_phd_7_sem" => [
                                "myra2_achievement" => $data->myra2_achievement_1[1],
                            ],
                        ],
                        "phd_enrolled" => [
                            "ratio_phd_staff" => [
                                "myra1_achievement" => $data->myra1_achievement_3[0],
                            ],
                        ],
                        "pg_enrolled" => [
                            "ratio_staff" => [
                                "myra1_achievement" => $data->myra1_achievement_4[0],
                            ],
                        ],
                        "pg_international" => [
                            "percentage_enrolled" => [
                                "myra1_achievement" => $data->myra1_achievement_5[0],
                            ],
                        ],
                        "pg_entry" => [
                            "percentage_enrolled" => [
                                "myra1_achievement" => $data->myra1_achievement_6[0],
                            ],
                        ],
                        "pg_research" => [
                            "percentage_enrolled" => [
                                "myra1_achievement" => $data->myra1_achievement_7[0],
                            ],
                        ],
                        "postdoc" => [
                            "percentage_enrolled" => [
                                "myra1_achievement" => $data->myra1_achievement_8[0],
                                "myra2_achievement" => $data->myra2_achievement_8[0],
                            ],
                        ],
                    ],
                    "overall_mark" => [
                        "myra1_benchmark_mark" => $data->total_myra1_benchmark_mark,
                        "myra1_mark" => $data->total_myra1_mark,
                        "myra1_achievement" => $data->total_myra1_benchmark_mark > 0? (float)number_format($data->total_myra1_mark/$data->total_myra1_benchmark_mark*100, 2) : 0,
                        "myra2_benchmark_mark" => $data->total_myra2_benchmark_mark,
                        "myra2_mark" => $data->total_myra2_mark,
                        "myra2_achievement" => $data->total_myra2_benchmark_mark > 0? (float)number_format($data->total_myra2_mark/$data->total_myra2_benchmark_mark*100, 2) : 0,
                    ]
                ];
                $status_code = 200;
            }
        }
        else if($request->section == "section_e"){
            $rawData = $this->myraSectionE($request->year);
            if(isset($rawData->calculation)){
                $data = $rawData->calculation;
                $final = [
                    "benchmark_target" => [
                        "patent" => [
                            "granted" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[0],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[0],
                            ],
                            "filed" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[1],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[1],
                            ],
                        ],
                        "commercialized_product" => [
                            "total" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_2[0],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_2[0],
                            ],
                        ],
                        "tech_know_how" => [
                            "total" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_3[0],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_3[0],
                            ],
                        ],
                        "other_ipr" => [
                            "total" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_4[0],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_4[0],
                            ],
                        ],
                    ],
                    "benchmark_mark" => [
                        "patent" => [
                            "granted" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[0],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[0],
                            ],
                            "filed" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[1],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[1],
                            ],
                        ],
                        "commercialized_product" => [
                            "total" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_2[0],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_2[0],
                            ],
                        ],
                        "tech_know_how" => [
                            "total" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_3[0],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_3[0],
                            ],
                        ],
                        "other_ipr" => [
                            "total" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_4[0],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_4[0],
                            ],
                        ],
                    ],
                    "mark" => [
                        "patent" => [
                            "granted" => [
                                "myra1_mark" => $data->myra1_mark_1[0],
                                "myra2_mark" => $data->myra2_mark_1[0],
                            ],
                            "filed" => [
                                "myra1_mark" => $data->myra1_mark_1[1],
                                "myra2_mark" => $data->myra2_mark_1[1],
                            ],
                        ],
                        "commercialized_product" => [
                            "total" => [
                                "myra1_mark" => $data->myra1_mark_2[0],
                                "myra2_mark" => $data->myra2_mark_2[0],
                            ],
                        ],
                        "tech_know_how" => [
                            "total" => [
                                "myra1_mark" => $data->myra1_mark_3[0],
                                "myra2_mark" => $data->myra2_mark_3[0],
                            ],
                        ],
                        "other_ipr" => [
                            "total" => [
                                "myra1_mark" => $data->myra1_mark_4[0],
                                "myra2_mark" => $data->myra2_mark_4[0],
                            ],
                        ],
                    ],
                    "achievement" => [
                        "patent" => [
                            "granted" => [
                                "myra1_achievement" => $data->myra1_achievement_1[0],
                                "myra2_achievement" => $data->myra2_achievement_1[0],
                            ],
                            "filed" => [
                                "myra1_achievement" => $data->myra1_achievement_1[1],
                                "myra2_achievement" => $data->myra2_achievement_1[1],
                            ],
                        ],
                        "commercialized_product" => [
                            "total" => [
                                "myra1_achievement" => $data->myra1_achievement_2[0],
                                "myra2_achievement" => $data->myra2_achievement_2[0],
                            ],
                        ],
                        "tech_know_how" => [
                            "total" => [
                                "myra1_achievement" => $data->myra1_achievement_3[0],
                                "myra2_achievement" => $data->myra2_achievement_3[0],
                            ],
                        ],
                        "other_ipr" => [
                            "total" => [
                                "myra1_achievement" => $data->myra1_achievement_4[0],
                                "myra2_achievement" => $data->myra2_achievement_4[0],
                            ],
                        ],
                    ],
                    "overall_mark" => [
                        "myra1_benchmark_mark" => $data->total_myra1_benchmark_mark,
                        "myra1_mark" => $data->total_myra1_mark,
                        "myra1_achievement" => $data->total_myra1_benchmark_mark > 0? (float)number_format($data->total_myra1_mark/$data->total_myra1_benchmark_mark*100, 2) : 0,
                        "myra2_benchmark_mark" => $data->total_myra2_benchmark_mark,
                        "myra2_mark" => $data->total_myra2_mark,
                        "myra2_achievement" => $data->total_myra2_benchmark_mark > 0? (float)number_format($data->total_myra2_mark/$data->total_myra2_benchmark_mark*100, 2) : 0,
                    ]
                ];
                $status_code = 200;
            }
        }
        else if($request->section == "section_f"){
            $rawData = $this->myraSectionF($request->year);
            if(isset($rawData->calculation)){
                $data = $rawData->calculation;
                $final = [
                    "benchmark_target" => [
                        "gross_income_item_1_to_3" => [
                            "myra1_benchmark_target" => $data->myra1_benchmark_1[0],
                        ],
                        "pg_fee" => [
                            "myra2_benchmark_target" => $data->myra2_benchmark_1[0],
                        ],
                        "seminar" => [
                            "myra2_benchmark_target" => $data->myra2_benchmark_2[0],
                        ],
                        "product_commerce" => [
                            "myra2_benchmark_target" => $data->myra2_benchmark_3[0],
                        ],
                        "consultancy" => [
                            "consultancies" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_4[0],
                                "myra2_benchmark_target" => $data->myra2_benchmark_4[0],
                            ],
                            "hospital" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_4[1] ?? 0,
                                "myra2_benchmark_target" => $data->myra2_benchmark_4[1] ?? 0,
                            ],
                            "lab" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_4[2] ?? 0,
                                "myra2_benchmark_target" => $data->myra2_benchmark_4[2] ?? 0,
                            ],
                        ],
                        "endowment" => [
                            "myra1_benchmark_target" => $data->myra1_benchmark_5[0],
                            "myra2_benchmark_target" => $data->myra2_benchmark_5[0],
                        ],
                        "gift" => [
                            "myra1_benchmark_target" => $data->myra1_benchmark_6[0],
                            "myra2_benchmark_target" => $data->myra2_benchmark_6[0],
                        ],
                        "oe_rnd" => [
                            "myra1_benchmark_target" => $data->myra1_benchmark_7[0],
                            "myra2_benchmark_target" => $data->myra2_benchmark_7[0],
                        ],
                    ],
                    "benchmark_mark" => [
                        "gross_income_item_1_to_3" => [
                            "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[0],
                        ],
                        "pg_fee" => [
                            "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[0],
                        ],
                        "seminar" => [
                            "myra2_benchmark_mark" => $data->myra2_benchmark_mark_2[0],
                        ],
                        "product_commerce" => [
                            "myra2_benchmark_mark" => $data->myra2_benchmark_mark_3[0],
                        ],
                        "consultancy" => [
                            "consultancies" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_4[0],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_4[0],
                            ],
                            "hospital" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_4[1] ?? 0,
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_4[1] ?? 0,
                            ],
                            "lab" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_4[2] ?? 0,
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_4[2] ?? 0,
                            ],
                        ],
                        "endowment" => [
                            "myra1_benchmark_mark" => $data->myra1_benchmark_mark_5[0],
                            "myra2_benchmark_mark" => $data->myra2_benchmark_mark_5[0],
                        ],
                        "gift" => [
                            "myra1_benchmark_mark" => $data->myra1_benchmark_mark_6[0],
                            "myra2_benchmark_mark" => $data->myra2_benchmark_mark_6[0],
                        ],
                        "oe_rnd" => [
                            "myra1_benchmark_mark" => $data->myra1_benchmark_mark_7[0],
                            "myra2_benchmark_mark" => $data->myra2_benchmark_mark_7[0],
                        ],
                    ],
                    "mark" => [
                        "gross_income_item_1_to_3" => [
                            "myra1_mark" => $data->myra1_mark_1[0],
                        ],
                        "pg_fee" => [
                            "myra2_mark" => $data->myra2_mark_1[0],
                        ],
                        "seminar" => [
                            "myra2_mark" => $data->myra2_mark_2[0],
                        ],
                        "product_commerce" => [
                            "myra2_mark" => $data->myra2_mark_3[0],
                        ],
                        "consultancy" => [
                            "consultancies" => [
                                "myra1_mark" => $data->myra1_mark_4[0],
                                "myra2_mark" => $data->myra2_mark_4[0],
                            ],
                            "hospital" => [
                                "myra1_mark" => $data->myra1_mark_4[1] ?? 0,
                                "myra2_mark" => $data->myra2_mark_4[1] ?? 0,
                            ],
                            "lab" => [
                                "myra1_mark" => $data->myra1_mark_4[2] ?? 0,
                                "myra2_mark" => $data->myra2_mark_4[2] ?? 0,
                            ],
                        ],
                        "endowment" => [
                            "myra1_mark" => $data->myra1_mark_5[0],
                            "myra2_mark" => $data->myra2_mark_5[0],
                        ],
                        "gift" => [
                            "myra1_mark" => $data->myra1_mark_6[0],
                            "myra2_mark" => $data->myra2_mark_6[0],
                        ],
                        "oe_rnd" => [
                            "myra1_mark" => $data->myra1_mark_7[0],
                            "myra2_mark" => $data->myra2_mark_7[0],
                        ],
                    ],
                    "achievement" => [
                        "gross_income_item_1_to_3" => [
                            "myra1_achievement" => $data->myra1_achievement_1[0],
                        ],
                        "pg_fee" => [
                            "myra2_achievement" => $data->myra2_achievement_1[0],
                        ],
                        "seminar" => [
                            "myra2_achievement" => $data->myra2_achievement_2[0],
                        ],
                        "product_commerce" => [
                            "myra2_achievement" => $data->myra2_achievement_3[0],
                        ],
                        "consultancy" => [
                            "consultancies" => [
                                "myra1_achievement" => $data->myra1_achievement_4[0],
                                "myra2_achievement" => $data->myra2_achievement_4[0],
                            ],
                            "hospital" => [
                                "myra1_achievement" => $data->myra1_achievement_4[1] ?? 0,
                                "myra2_achievement" => $data->myra2_achievement_4[1] ?? 0,
                            ],
                            "lab" => [
                                "myra1_achievement" => $data->myra1_achievement_4[2] ?? 0,
                                "myra2_achievement" => $data->myra2_achievement_4[2] ?? 0,
                            ],
                        ],
                        "endowment" => [
                            "myra1_achievement" => $data->myra1_achievement_5[0],
                            "myra2_achievement" => $data->myra2_achievement_5[0],
                        ],
                        "gift" => [
                            "myra1_achievement" => $data->myra1_achievement_6[0],
                            "myra2_achievement" => $data->myra2_achievement_6[0],
                        ],
                        "oe_rnd" => [
                            "myra1_achievement" => $data->myra1_achievement_7[0],
                            "myra2_achievement" => $data->myra2_achievement_7[0],
                        ],
                    ],
                    "overall_mark" => [
                        "myra1_benchmark_mark" => $data->total_myra1_benchmark_mark,
                        "myra1_mark" => $data->total_myra1_mark,
                        "myra1_achievement" => $data->total_myra1_benchmark_mark > 0? (float)number_format($data->total_myra1_mark/$data->total_myra1_benchmark_mark*100, 2) : 0,
                        "myra2_benchmark_mark" => $data->total_myra2_benchmark_mark,
                        "myra2_mark" => $data->total_myra2_mark,
                        "myra2_achievement" => $data->total_myra2_benchmark_mark > 0? (float)number_format($data->total_myra2_mark/$data->total_myra2_benchmark_mark*100, 2) : 0,
                    ]
                ];
                $status_code = 200;
            }
        }
        else if($request->section == "section_g"){
            $rawData = $this->myraSectionG($request->year);
            if(isset($rawData->calculation)){
                $data = $rawData->calculation;
                $final = [
                    "benchmark_target" => [
                        "international_moa" => [
                            "total_moa" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[0],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[0],
                            ],
                            "percent_staff_involved" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_1[1],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_1[1],
                            ],
                        ],
                        "staff_sent_abroad" => [
                            "myra1_benchmark_target" => $data->myra1_benchmark_target_2[0],
                        ],
                        "international_membership" => [
                            "staff_members" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_3[0],
                            ],
                            "staff_upper_member" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_3[1],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_3[0],
                            ],
                        ],
                        "national_moa" => [
                            "total_moa" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_4[0],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_4[0],
                            ],
                            "percent_staff_involved" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_4[1],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_4[1],
                            ],
                        ],
                        "national_membership" => [
                            "staff_members" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_5[0],
                            ],
                            "staff_upper_member" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_5[1],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_5[0],
                            ],
                        ],
                        "social_innovation" => [
                            "community_research" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_6[0],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_6[0],
                            ],
                            "community_benefit" => [
                                "myra1_benchmark_target" => $data->myra1_benchmark_target_6[1],
                                "myra2_benchmark_target" => $data->myra2_benchmark_target_6[1],
                            ],
                        ],
                        "research_project" => [
                            "myra1_benchmark_target" => $data->myra1_benchmark_target_7[0],
                        ],
                        "research_project_ru" => [
                            "myra2_benchmark_target" => $data->myra2_benchmark_target_8[0],
                        ],
                    ],
                    "benchmark_mark" => [
                        "international_moa" => [
                            "total_moa" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[0],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[0],
                            ],
                            "percent_staff_involved" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[1],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[1],
                            ],
                        ],
                        "staff_sent_abroad" => [
                            "myra1_benchmark_mark" => $data->myra1_benchmark_mark_2[0],
                        ],
                        "international_membership" => [
                            "staff_members" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_3[0],
                            ],
                            "staff_upper_member" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_3[1],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_3[0],
                            ],
                        ],
                        "national_moa" => [
                            "total_moa" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_4[0],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_4[0],
                            ],
                            "percent_staff_involved" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_4[1],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_4[1],
                            ],
                        ],
                        "national_membership" => [
                            "staff_members" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_5[0],
                            ],
                            "staff_upper_member" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_5[1],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_5[0],
                            ],
                        ],
                        "social_innovation" => [
                            "community_research" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_6[0],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_6[0],
                            ],
                            "community_benefit" => [
                                "myra1_benchmark_mark" => $data->myra1_benchmark_mark_6[1],
                                "myra2_benchmark_mark" => $data->myra2_benchmark_mark_6[1],
                            ],
                        ],
                        "research_project" => [
                            "myra1_benchmark_mark" => $data->myra1_benchmark_mark_7[0],
                        ],
                        "research_project_ru" => [
                            "myra2_benchmark_mark" => $data->myra2_benchmark_mark_8[0],
                        ],
                    ],
                    "mark" => [
                        "international_moa" => [
                            "total_moa" => [
                                "myra1_mark" => $data->myra1_mark_1[0],
                                "myra2_mark" => $data->myra2_mark_1[0],
                            ],
                            "percent_staff_involved" => [
                                "myra1_mark" => $data->myra1_mark_1[1],
                                "myra2_mark" => $data->myra2_mark_1[1],
                            ],
                        ],
                        "staff_sent_abroad" => [
                            "myra1_mark" => $data->myra1_mark_2[0],
                        ],
                        "international_membership" => [
                            "staff_members" => [
                                "myra1_mark" => $data->myra1_mark_3[0],
                            ],
                            "staff_upper_member" => [
                                "myra1_mark" => $data->myra1_mark_3[1],
                                "myra2_mark" => $data->myra2_mark_3[0],
                            ],
                        ],
                        "national_moa" => [
                            "total_moa" => [
                                "myra1_mark" => $data->myra1_mark_4[0],
                                "myra2_mark" => $data->myra2_mark_4[0],
                            ],
                            "percent_staff_involved" => [
                                "myra1_mark" => $data->myra1_mark_4[1],
                                "myra2_mark" => $data->myra2_mark_4[1],
                            ],
                        ],
                        "national_membership" => [
                            "staff_members" => [
                                "myra1_mark" => $data->myra1_mark_5[0],
                            ],
                            "staff_upper_member" => [
                                "myra1_mark" => $data->myra1_mark_5[1],
                                "myra2_mark" => $data->myra2_mark_5[0],
                            ],
                        ],
                        "social_innovation" => [
                            "community_research" => [
                                "myra1_mark" => $data->myra1_mark_6[0],
                                "myra2_mark" => $data->myra2_mark_6[0],
                            ],
                            "community_benefit" => [
                                "myra1_mark" => $data->myra1_mark_6[1],
                                "myra2_mark" => $data->myra2_mark_6[1],
                            ],
                        ],
                        "research_project" => [
                            "myra1_mark" => $data->myra1_mark_7[0],
                        ],
                        "research_project_ru" => [
                            "myra2_mark" => $data->myra2_mark_8[0],
                        ],
                    ],
                    "achievement" => [
                        "international_moa" => [
                            "total_moa" => [
                                "myra1_achievement" => $data->myra1_achievement_1[0],
                                "myra2_achievement" => $data->myra2_achievement_1[0],
                            ],
                            "percent_staff_involved" => [
                                "myra1_achievement" => $data->myra1_achievement_1[1],
                                "myra2_achievement" => $data->myra2_achievement_1[1],
                            ],
                        ],
                        "staff_sent_abroad" => [
                            "myra1_achievement" => $data->myra1_achievement_2[0],
                        ],
                        "international_membership" => [
                            "staff_members" => [
                                "myra1_achievement" => $data->myra1_achievement_3[0],
                            ],
                            "staff_upper_member" => [
                                "myra1_achievement" => $data->myra1_achievement_3[1],
                                "myra2_achievement" => $data->myra2_achievement_3[0],
                            ],
                        ],
                        "national_moa" => [
                            "total_moa" => [
                                "myra1_achievement" => $data->myra1_achievement_4[0],
                                "myra2_achievement" => $data->myra2_achievement_4[0],
                            ],
                            "percent_staff_involved" => [
                                "myra1_achievement" => $data->myra1_achievement_4[1],
                                "myra2_achievement" => $data->myra2_achievement_4[1],
                            ],
                        ],
                        "national_membership" => [
                            "staff_members" => [
                                "myra1_achievement" => $data->myra1_achievement_5[0],
                            ],
                            "staff_upper_member" => [
                                "myra1_achievement" => $data->myra1_achievement_5[1],
                                "myra2_achievement" => $data->myra2_achievement_5[0],
                            ],
                        ],
                        "social_innovation" => [
                            "community_research" => [
                                "myra1_achievement" => $data->myra1_achievement_6[0],
                                "myra2_achievement" => $data->myra2_achievement_6[0],
                            ],
                            "community_benefit" => [
                                "myra1_achievement" => $data->myra1_achievement_6[1],
                                "myra2_achievement" => $data->myra2_achievement_6[1],
                            ],
                        ],
                        "research_project" => [
                            "myra1_achievement" => $data->myra1_achievement_7[0],
                        ],
                        "research_project_ru" => [
                            "myra2_achievement" => $data->myra2_achievement_8[0],
                        ],
                    ],
                    "overall_mark" => [
                        "myra1_benchmark_mark" => $data->total_myra1_benchmark_mark,
                        "myra1_mark" => $data->total_myra1_mark,
                        "myra1_achievement" => $data->total_myra1_benchmark_mark > 0? (float)number_format($data->total_myra1_mark/$data->total_myra1_benchmark_mark*100, 2) : 0,
                        "myra2_benchmark_mark" => $data->total_myra2_benchmark_mark,
                        "myra2_mark" => $data->total_myra2_mark,
                        "myra2_achievement" => $data->total_myra2_benchmark_mark > 0? (float)number_format($data->total_myra2_mark/$data->total_myra2_benchmark_mark*100, 2) : 0,
                    ]
                ];
                $status_code = 200;
            }
        }
        else if($request->section == "section_h"){
            $rawData = $this->myraSectionH($request->year);
            if(isset($rawData->calculation)){
                $data = $rawData->calculation;
                $final = [
                    "benchmark_target" => [
                        "lab" => [
                            "myra1_benchmark_target" => $data->myra1_benchmark_target_1[0],
                            "myra2_benchmark_target" => $data->myra2_benchmark_target_1[0],
                        ],
                        "library" => [
                            "myra1_benchmark_target" => $data->myra1_benchmark_target_2[0],
                        ],
                    ],
                    "benchmark_mark" => [
                        "lab" => [
                            "myra1_benchmark_mark" => $data->myra1_benchmark_mark_1[0],
                            "myra2_benchmark_mark" => $data->myra2_benchmark_mark_1[0],
                        ],
                        "library" => [
                            "myra1_benchmark_mark" => $data->myra1_benchmark_mark_2[0],
                        ],
                    ],
                    "mark" => [
                        "lab" => [
                            "myra1_mark" => $data->myra1_mark_1[0],
                            "myra2_mark" => $data->myra2_mark_1[0],
                        ],
                        "library" => [
                            "myra1_mark" => $data->myra1_mark_2[0],
                        ],
                    ],
                    "achievement" => [
                        "lab" => [
                            "myra1_achievement" => $data->myra1_achievement_1[0],
                            "myra2_achievement" => $data->myra2_achievement_1[0],
                        ],
                        "library" => [
                            "myra1_achievement" => $data->myra1_achievement_2[0],
                        ],
                    ],
                    "overall_mark" => [
                        "myra1_benchmark_mark" => $data->total_myra1_benchmark_mark,
                        "myra1_mark" => $data->total_myra1_mark,
                        "myra1_achievement" => $data->total_myra1_benchmark_mark > 0? (float)number_format($data->total_myra1_mark/$data->total_myra1_benchmark_mark*100, 2) : 0,
                        "myra2_benchmark_mark" => $data->total_myra2_benchmark_mark,
                        "myra2_mark" => $data->total_myra2_mark,
                        "myra2_achievement" => $data->total_myra2_benchmark_mark > 0? (float)number_format($data->total_myra2_mark/$data->total_myra2_benchmark_mark*100, 2) : 0,
                    ]
                ];
                $status_code = 200;
            }
        }
        if($final){
            try {
                $calculation = MyraCalculation::updateOrCreate(
                    ['year' => $request->year, 'type' => $request->section],
                    [
                        'benchmark_target' => json_encode(isset($final['benchmark_target']) ? $final['benchmark_target']: []),
                        'benchmark_mark' => json_encode(isset($final['benchmark_mark']) ? $final['benchmark_mark']: []),
                        'mark' => json_encode(isset($final['mark']) ? $final['mark']: []),
                        'achievement' => json_encode(isset($final['achievement']) ? $final['achievement']: []),
                        'overall' => json_encode(isset($final['overall_mark']) ? $final['overall_mark']: []),
                    ]
                );
            } catch (\Illuminate\Database\QueryException $e) {
                $status_code = 500;
            }
            
        }
        return response()->json([
            "final" => $final,
        ], $status_code);
    }

    public function getSchool($faculty_id)
    {
        $schools = getSchoolByFaculty($faculty_id);
        return response()->json([
            "result" => $schools->toArray()
        ], 200);
    }

    public function getProjectList($program_id = 0, $faculty)
    {
        // $projects = DruDistFund::from('dru_dist_funds as ddf')
        //     ->select('*')
        //     ->where('ddf.')
        if($program_id != 0){
            $query = DB::table('dru_dist_funds AS ddf')
            ->select([
                'ddf.id as id',
                DB::raw('UPPER(ddf.title) as title'),
                'ddf.code as code',
                'ddf.code_2 as code_2',
                'f.original_code as f_original_code',
                // DB::raw('RPAD(f.original_code, 7, "0") AS f_original_code'),
                // DB::raw('RPAD(ddf.faculty_code, 7, "0") AS ptj_fullcode'),
                // 'ddf.faculty_code as ddf_faculty_code',
                // 'p.code as program',
                // 'dmf.id as dmf_id',
                // 'dmf.code as dmf_code',
                // 'f.id as f_id',
                // 'f.code as f_code',
                // 'f.code as f_original_code',
                // 'ddf.is_draft as ddf_is_draft',
                // 'ddf.status as ddf_status',
                // 'ddf.created_at as ddf_created_at',
                // 'ddf.updated_at as ddf_updated_at',
            ])
            ->join('dru_main_funds AS dmf', function ($join) use ($program_id){
                $join->on('dmf.code', '=', 'ddf.tabung_induk')->where('dmf.program_id', $program_id);
            })
            ->join('parameters AS f', function ($join) use ($faculty){
                $join->on('f.original_code', '=', 'ddf.faculty_code')->where('f.id', $faculty);
            })
            ->join('parameters AS p', function ($join){
                $join->on('p.id', '=', 'ddf.program_id')->where('p.active', 'Y');
            })->orderBy('ddf.year', 'desc')->groupBy('dmf.code')->get();
        }
        else {
            $query = DB::table('dru_dist_funds AS ddf')
            ->select([
                'ddf.id as id',
                DB::raw('UPPER(ddf.title) as title'),
                'ddf.code as code',
                'ddf.code_2 as code_2',
                'f.original_code as f_original_code',
                // DB::raw('RPAD(f.original_code, 7, "0") AS f_original_code'),
                // DB::raw('RPAD(ddf.faculty_code, 7, "0") AS ptj_fullcode'),
                // 'ddf.faculty_code as ddf_faculty_code',
                // 'p.code as program',
                // 'dmf.id as dmf_id',
                // 'dmf.code as dmf_code',
                // 'f.id as f_id',
                // 'f.code as f_code',
                // 'f.code as f_original_code',
                // 'ddf.is_draft as ddf_is_draft',
                // 'ddf.status as ddf_status',
                // 'ddf.created_at as ddf_created_at',
                // 'ddf.updated_at as ddf_updated_at',
            ])
            ->join('dru_main_funds AS dmf', function ($join){
                $join->on('dmf.code', '=', 'ddf.tabung_induk');
            })
            ->join('parameters AS f', function ($join) use ($faculty){
                $join->on('f.original_code', '=', 'ddf.faculty_code')->where('f.id', $faculty);
            })
            ->join('parameters AS p', function ($join){
                $join->on('p.id', '=', 'ddf.program_id')->where('p.active', 'Y');
            })->orderBy('ddf.year', 'desc')->groupBy('dmf.code')->get();
        }
            // dd($query);
        // $projects = DruProject::from('dru_projects as pro')
        // ->select([
        //     DB::raw('UPPER(pro.title) as title'), 'pro.id as id', 'pro.code as code', DB::raw('IFNULL(pro.code_2, "00000") as code_2'), 'pro.is_fixed_subproject as fixed_subproject'
        // ])
        // ->where('pro.year', $year)->where('pro.program_id', $program_id)->where('pro.status','active')->get();
        return response()->json([
            "result" => $query
        ], 200);
    }

    public function approveDruDistributionPlanForm(Request $request)
    {
        $status_code = 500;
        $data = null;
        $result = null;
        $plan_form = DruDistributionPlanForm::find($request->plan_id);
        
        $this->sendingMail($plan_form->id);
        if($plan_form){
            $plan_form->approved = 'Y';
            $plan_form->reference_no = $request->ref_no;
            $plan_form->save();
            $status_code = 200;
            $result = 'Passed';
        }
        return response()->json([
            "result" => $result,
        ], $status_code);
    }

    public function updateUtmFinRefNo(Request $request)
    {
        $status_code = 500;
        $data = null;
        $result = null;

        $plan_form = DruDistributionPlanForm::find($request->plan_id);
        if($plan_form){
            $plan_form->reference_no = $request->ref_no;
            $plan_form->save();
            $status_code = 200;
            $result = 'Passed';
        }
        return response()->json([
            "result" => $result,
        ], $status_code);
    }

    public function addDistFund(Request $request)
    {
        $status_code = 500;
        $data = null;
        $result = null;
        $projects = DruProject::whereIn('id', $request->project_id)->get();
        $insert_data = [];
        foreach ($projects as $project) {
            $data = [
                'year' => $project->year,
                'title' => $project->title,
                'code' => $project->code,
                'code_2' => $project->code_2,
                'program_id' => $project->program_id,
                'main_fund_id' => $project->main_fund_id,
                'is_draft' => 1,
                'updated_at' => now()
            ];
            $insert_data[] = $data;
        }
        $insert_data = collect($insert_data);
        $chunks = $insert_data->chunk(100);
        foreach ($chunks as $chunk) {
            foreach ($chunk as $key => $item) {
                DruDistFund::updateOrCreate(
                    ['year' => $item['year'], 'code' => $item['code'], 'code_2' => $item['code_2'], 'faculty_code' => null],
                    $item
                ); 
            }
        }
        $status_code = 200;
        $result = 'Passed';
        return response()->json([
            "result" => $result,
        ], $status_code);
    }

    public function searchKpi($type, $name)
    {
        $status_code = 500;
        $data = null;
        $result = null;
        $templates = DruKpiTemplate::select('id', 'title', 'active')->whereType($type == "main_dist" ? "main": "kpi")->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($name) . '%'])->where('active', '!=', 'N')->get();
        $status_code = 200;
        $result = 'Passed';
        return response()->json([
            "templates" => $templates,
        ], $status_code);
    }

    public function getBalanceByChargeline(Request $request)
    {
        $status_code = 500;
        $total_allocation = DB::table('masterlist_dru_allocations as mda')
        ->select(['mda.amount'])
        ->join('dru_main_funds AS dmf', function ($join){
            $join->on('dmf.code', '=', 'mda.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
        })
        ->where('dmf.id', $request->main_fund_id)->where('mda.ptj_code', $request->ptj_code)->sum('mda.amount');
        $total_expenses = DB::table('masterlist_dru_expenses as mde')
        ->select(['mde.amount'])
        ->join('dru_main_funds AS dmf', function ($join){
            $join->on('dmf.code', '=', 'mde.tabung_induk')->where('dmf.is_draft',0)->where('dmf.status','active');
        })
        ->where('dmf.id', $request->main_fund_id)->where('mde.ptj', $request->ptj_code)->sum('mde.amount');
        $status_code = 200;
        return response()->json([
            "total_allocation" => $total_allocation,
            "total_expenses" => $total_expenses,
        ], $status_code);
    }

    public function validateNric(Request $request)
    {
        $result = 0;
        $member = DruMember::whereDistributionPlanFormId($request->plan_id)->whereNric($request->nric)->whereEmail(user()->email)->first();
        if($member){
            $result = 1;
        }
        return response()->json([
            "result" => $result,
        ], 200);
    }

    public function broadcastEmail(Request $request)
    {
        $status_code = 500;
        $data = null;
        $result = null;
        $plan_form = DruDistributionPlanForm::find($request->plan_id);
        
        $this->sendingMail($plan_form->id);
        $status_code = 200;
        $result = 'Passed';
        return response()->json([
            "result" => $result,
        ], $status_code);
    }
}
