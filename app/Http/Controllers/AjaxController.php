<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\API\GeneralController as Api;

class AjaxController extends Controller
{
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

}
