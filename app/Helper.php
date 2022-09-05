<?php


if (!function_exists('getUtmApiUrl')) {
    function getUtmApiUrl()
    {
        return "https://dgmicro.utm.my/api/";
    }
}

if (!function_exists('excelDate')) {
    function excelDate($date)
    {
        if(is_numeric($date)){
            $result = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($date)->format('Y-m-d');
        }
        else{
            if($date == '-')
                $result = null;
            else if($date != null)
                $result = date('Y-m-d', strtotime($date));
            else $result = null;
        }
        return $result;
    }
}