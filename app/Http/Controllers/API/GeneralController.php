<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public static function getReq($endpoint, $data)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => getUtmApiUrl().$endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => $data,
          ));

        // dd($curl);

        $response = curl_exec($curl);
        $result = json_decode($response, true);
        
        $err = curl_error($curl);
        curl_close($curl);
        return $result;
    }

    // public static function postReq($endpoint, $data)
    // {
    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //     CURLOPT_URL => 'https://dgmicro.utm.my/api/grant/GetGrantMestecc' . $endpoint,
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_CUSTOMREQUEST => "POST",
    //     CURLOPT_HTTPHEADER => array(
    //         "Authorization: Bearer ". getUitmToken(),
    //         'Content-Type: application/json'
    //     ),
    //     CURLOPT_POSTFIELDS => json_encode($data)
    //     ));

    //     $response = curl_exec($curl);
    //     $result = json_decode($response, true);
    //     // dd($response);
    //     $err = curl_error($curl);
    //     curl_close($curl);
    //     return $result;
    // }
    public static function getGrantMestecc($year){
        $param = [
            "system"=>"GRANTS",
            "validation"=>"KEYAPI-MESTECC-2021-0002",
            "year"=>$year
        ];

        $data = self::getReq('grant/GetGrantMestecc', $param);

        $finalData = array_filter($data['GrantMesteccItems'], function ($var){
            return ($var['SPONSOR_CATEGORY'] == 'UNIVERSITY'||$var['SPONSOR_CATEGORY'] == 'PRIVATE'||
            $var['SPONSOR_CATEGORY'] == 'NATIONAL'||$var['SPONSOR_CATEGORY'] == 'INTERNATIONAL');
        }); 

        return self::processGrantMestecc($finalData);
    }

    public static function processGrantMestecc($finalData){
        $totalGrant = count($finalData);
        $totalApproved = 0;
        $university_faculty_count = [];
        $private_faculty_count = [];
        $national_faculty_count = [];
        $international_faculty_count = [];
        foreach ($finalData as $key => $grant) {
            $totalApproved += $grant['AMOUNT_APPROVED'];
        }

        $faculties = array_count_values(array_filter(array_column($finalData, "FACULTY")));
        arsort($faculties);

        $staff = array_count_values(array_filter(array_column($finalData, "STAFF_NAME")));
        arsort($staff);
        $kp = array_keys($staff);
        $kp_project = array_values($staff);
        $project_leader = [];
        $total_project_by_pl = 0;
        foreach ($kp as $key => $value) {
            array_push($project_leader, ["name"=>trim($value), "project"=>(int)$kp_project[$key]]);
            $total_project_by_pl += (int)$kp_project[$key];
        }
        $university = array_filter($finalData, function ($var){
            return ($var['SPONSOR_CATEGORY'] == "UNIVERSITY");
        });
        $university_approved = array_sum(array_filter(array_column($university, "AMOUNT_APPROVED")));
        $university_faculties = array_count_values(array_filter(array_column($university, "FACULTY")));

        $private = array_filter($finalData, function ($var){
            return ($var['SPONSOR_CATEGORY'] == "PRIVATE");
        });
        $private_approved = array_sum(array_filter(array_column($private, "AMOUNT_APPROVED")));
        $private_faculties = array_count_values(array_filter(array_column($private, "FACULTY")));

        $national = array_filter($finalData, function ($var){
            return ($var['SPONSOR_CATEGORY'] == "NATIONAL");
        });
        $national_approved = array_sum(array_filter(array_column($national, "AMOUNT_APPROVED")));
        $national_faculties = array_count_values(array_filter(array_column($national, "FACULTY")));

        $international = array_filter($finalData, function ($var){
            return ($var['SPONSOR_CATEGORY'] == "INTERNATIONAL");
        });
        $international_approved = array_sum(array_filter(array_column($international, "AMOUNT_APPROVED")));
        $international_faculties = array_count_values(array_filter(array_column($international, "FACULTY")));

        foreach (array_keys($faculties) as $key => $faculty) {
            array_push($university_faculty_count, isset($university_faculties[$faculty])? $university_faculties[$faculty] : 0);
            array_push($private_faculty_count, isset($private_faculties[$faculty])? $private_faculties[$faculty] : 0);
            array_push($national_faculty_count, isset($national_faculties[$faculty])? $national_faculties[$faculty] : 0);
            array_push($international_faculty_count, isset($international_faculties[$faculty])? $international_faculties[$faculty] : 0);
        }

        $result = [
            "raw_data" => $finalData,
            "total_grant" => $totalGrant,
            "total_approved" => $totalApproved,
            "faculties" => array_keys($faculties),
            "project_leader" => $project_leader,
            "total_project_by_pl" => $total_project_by_pl,
            "sponsor_category" =>[
                [
                    "sponsor" => "UNIVERSITY",
                    "total" => count($university),
                    "approved" => $university_approved,
                    "faculty" => $university_faculty_count
                ],
                [
                    "sponsor" => "PRIVATE",
                    "total" => count($private),
                    "approved" => $private_approved,
                    "faculty" => $private_faculty_count
                ],
                [
                    "sponsor" => "NATIONAL",
                    "total" => count($national),
                    "approved" => $national_approved,
                    "faculty" => $national_faculty_count
                ],
                [
                    "sponsor" => "INTERNATIONAL",
                    "total" => count($international),
                    "approved" => $international_approved,
                    "faculty" => $international_faculty_count
                ],
            ]
        ];
        return $result;
    }
}
