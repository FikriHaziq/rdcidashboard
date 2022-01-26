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

        $totalGrant = count($data['GrantMesteccItems']);
        $totalApproved = 0;
        $university_faculty_count = [];
        $private_faculty_count = [];
        $national_faculty_count = [];
        $international_faculty_count = [];
        foreach ($data['GrantMesteccItems'] as $key => $grant) {
            $totalApproved += $grant['AMOUNT_APPROVED'];
        }

        $faculties = array_count_values(array_filter(array_column($data['GrantMesteccItems'], "FACULTY")));
        arsort($faculties);

        $university = array_filter($data['GrantMesteccItems'], function ($var){
            return ($var['SPONSOR_CATEGORY'] == "UNIVERSITY");
        });
        $university_approved = array_sum(array_filter(array_column($university, "AMOUNT_APPROVED")));
        $university_faculties = array_count_values(array_filter(array_column($university, "FACULTY")));

        $private = array_filter($data['GrantMesteccItems'], function ($var){
            return ($var['SPONSOR_CATEGORY'] == "PRIVATE");
        });
        $private_approved = array_sum(array_filter(array_column($private, "AMOUNT_APPROVED")));
        $private_faculties = array_count_values(array_filter(array_column($private, "FACULTY")));

        $national = array_filter($data['GrantMesteccItems'], function ($var){
            return ($var['SPONSOR_CATEGORY'] == "NATIONAL");
        });
        $national_approved = array_sum(array_filter(array_column($national, "AMOUNT_APPROVED")));
        $national_faculties = array_count_values(array_filter(array_column($national, "FACULTY")));

        $international = array_filter($data['GrantMesteccItems'], function ($var){
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
            "total_grant" => $totalGrant,
            "total_approved" => $totalApproved,
            "faculties" => array_keys($faculties),
            "university" => [
                "total" => count($university),
                "approved" => $university_approved,
                "faculty" => $university_faculty_count
            ],
            "private" => [
                "total" => count($private),
                "approved" => $private_approved,
                "faculty" => $private_faculty_count
            ],
            "national" => [
                "total" => count($national),
                "approved" => $national_approved,
                "faculty" => $national_faculty_count
            ],
            "international" => [
                "total" => count($international),
                "approved" => $international_approved,
                "faculty" => $international_faculty_count
            ],
        ];
        return $result;
    }

}
