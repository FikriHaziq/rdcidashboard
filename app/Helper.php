<?php
/**
 * Save authenticate user
 *
 * * @param object data
 *
 * @return object;
 */
if (!function_exists('saveUser')) {
    function saveUser($data)
    {
        if (isset($data['email'])) {
            $user = (object) [
                'id' => $data['id'],
                'staff_id' => $data['staff_id'],
                'email' => $data['email'],
                'name' => $data['name'],
                'nric' => $data['nric'],
                'role' => $data['role'],
                'faculty' => $data['faculty'],
                'faculty_code' => $data['faculty_code'],
                'school' => $data['school'],
                'school_code' => $data['school_code'],
            ];
        }
        session()->put('user', $user);
    }
}

/**
 * Get authenticate user
 *
 * * @param none
 *
 * @return User user;
 */
if (!function_exists('user')) {
    function user()
    {
        return session()->get('user');
    }
}

if (!function_exists('dummyUserEmail')) {
    function dummyUserEmail()
    {
        return [
            'superadmin@rdci.com',
            'admin@rdci.com',
            'jtncpiadmin@rdci.com',
            'jtncpistaff@rdci.com',
            'fkt@rdci.com',
        ];
    }
}

if (!function_exists('getUtmApiUrl')) {
    function getUtmApiUrl()
    {
        return "https =>//dgmicro.utm.my/api/";
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

if (!function_exists('getFaculty')) {
    function getFaculty()
    {
        $result = [
            (object) ["code" => '01', "long" => 'CANSELORI', "short" => 'CAN', "short_overall" => 'CAN', "year" => NULL],
            (object) ["code" => '02', "long" => 'PEJABAT PENDAFTAR', "short" => 'PP', "short_overall" => 'PP', "year" => NULL],
            (object) ["code" => '03', "long" => 'PEJABAT BENDAHARI', "short" => 'PB', "short_overall" => 'PB', "year" => NULL],
            (object) ["code" => '04', "long" => 'PERPUSTAKAAN SULTANAH ZANARIAH', "short" => 'PSZ', "short_overall" => 'PSZ', "year" => NULL],
            (object) ["code" => '05', "long" => 'PEJABAT PENGARAH KERJA', "short" => 'PPK', "short_overall" => 'PPK', "year" => NULL],
            (object) ["code" => '06', "long" => 'PEJABAT HAL EHWAL MAHASISWA', "short" => 'HEM', "short_overall" => 'HEM', "year" => NULL],
            (object) ["code" => '07', "long" => 'PUSAT TEKNOLOGI MAKLUMAT DAN KOMUNIKASI', "short" => 'CICT', "short_overall" => 'CICT', "year" => NULL],
            (object) ["code" => '08', "long" => 'PEJABAT TIMBALAN NAIB CANSELOR (A&A)', "short" => 'TNCAA', "short_overall" => 'TNCAA', "year" => NULL],
            (object) ["code" => '09', "long" => 'PEJABAT TIMBALAN NAIB CANSELOR (P&I)', "short" => 'TNCPI', "short_overall" => 'TNCPI', "year" => NULL],
            (object) ["code" => '10', "long" => 'SEKOLAH PENGAJIAN SISWAZAH', "short" => 'SPS', "short_overall" => 'SPS', "year" => NULL],
            (object) ["code" => '12', "long" => 'PENERBIT', "short" => 'PENERBIT', "short_overall" => 'PENERBIT', "year" => NULL],
            (object) ["code" => '13', "long" => 'PUSAT PENGURUSAN PENYELIDIKAN', "short" => 'RMC', "short_overall" => 'RMC', "year" => NULL],
            (object) ["code" => '14', "long" => 'PUSAT INOVASI DAN PENGKOMERSILAN', "short" => 'ICC', "short_overall" => 'ICC', "year" => NULL],
            (object) ["code" => '16', "long" => 'PUSAT PENGAJARAN DAN PEMBELAJARAN', "short" => 'CTL', "short_overall" => 'CTL', "year" => NULL],
            (object) ["code" => '17', "long" => 'PEJABAT TIMBALAN NAIB CANSELOR (PEMBANGUNAN)', "short" => 'TNCP', "short_overall" => 'TNCP', "year" => NULL],
            (object) ["code" => '21', "long" => 'FAKULTI ALAM BINA', "short" => 'FAB', "short_overall" => 'FABU', "year" => 2017],
            (object) ["code" => '22', "long" => 'FAKULTI KEJURUTERAAN AWAM', "short" => 'FKA', "short_overall" => 'FKA', "year" => 2017],
            (object) ["code" => '23', "long" => 'FAKULTI KEJURUTERAAN ELEKTRIK', "short" => 'FKE', "short_overall" => 'FKE', "year" => 2017],
            (object) ["code" => '24', "long" => 'FAKULTI KEJURUTERAAN MEKANIKAL', "short" => 'FKM', "short_overall" => 'FKM', "year" => 2017],
            (object) ["code" => '25', "long" => 'FAKULTI KEJURUTERAAN KIMIA DAN KEJURUTERAAN SUMBER ASLI', "short" => 'FKKKSA', "short_overall" => 'FKT', "year" => 2017],
            (object) ["code" => '26', "long" => 'FAKULTI SAINS', "short" => 'FS', "short_overall" => 'FS', "year" => 2017],
            (object) ["code" => '27', "long" => 'FAKULTI GEOINFORMASI DAN HARTA TANAH', "short" => 'FGHT', "short_overall" => 'FABU', "year" => 2017],
            (object) ["code" => '28', "long" => 'FAKULTI KOMPUTERAN', "short" => 'FC', "short_overall" => 'FC', "year" => 2017],
            (object) ["code" => '29', "long" => 'FAKULTI PENGURUSAN', "short" => 'FM', "short_overall" => 'FM', "year" => 2017],
            (object) ["code" => '31', "long" => 'FAKULTI PENDIDIKAN', "short" => 'FP', "short_overall" => 'FSSK', "year" => 2017],
            (object) ["code" => '33', "long" => 'FAKULTI TAMADUN ISLAM', "short" => 'FTI', "short_overall" => 'FSSK', "year" => 2017],
            (object) ["code" => '35', "long" => 'FAKULTI BIOSAINS DAN BIOKEJURUTERAAN', "short" => 'FBB', "short_overall" => 'FBB', "year" => 2017],
            (object) ["code" => '36', "long" => 'FAKULTI KEJURUTERAAN BIOPERUBATAN & SAINS KESIHATAN', "short" => 'FKBSK', "short_overall" => 'FKBSK', "year" => 2017],
            (object) ["code" => '38', "long" => 'SEKOLAH INFORMATIK TERMAJU UTM', "short" => 'AIS', "short_overall" => 'FTIR', "year" => 2017],
            (object) ["code" => '39', "long" => 'UTM PERDANA SCHOOL', "short" => 'UTM Perdana', "short_overall" => 'FTIR', "year" => 2017],
            (object) ["code" => '40', "long" => 'UTM RAZAK SCHOOL', "short" => 'UTM Razak', "short_overall" => 'FTIR', "year" => 2017],
            (object) ["code" => '41', "long" => 'AKADEMI BAHASA', "short" => 'ABahasa', "short_overall" => 'FSSK', "year" => 2017],
            (object) ["code" => '42', "long" => 'FAKULTI KEJURUTERAAN PETROLEUM DAN KEJURUTERAAN TENAGA DIPERBAHARUI', "short" => 'FPREE', "short_overall" => 'FKT', "year" => 2017],
            (object) ["code" => '43', "long" => 'INSTITUT TEKNOLOGI ANTARABANGSA MALAYSIA-JEPUN', "short" => 'MJIIT', "short_overall" => 'MJIIT', "year" => 2017],
            (object) ["code" => '44', "long" => 'FAKULTI KEJURUTERAAN KIMIA', "short" => 'FKK', "short_overall" => 'FKT', "year" => 2017],
            (object) ["code" => '45', "long" => 'FAKULTI BIOSAINS DAN KEJURUTERAAN PERUBATAN', "short" => 'FBME', "short_overall" => 'FBME', "year" => 2017],
            (object) ["code" => '46', "long" => 'FAKULTI KEJURUTERAAN KIMIA DAN KEJURUTERAAN TENAGA', "short" => 'FKT', "short_overall" => 'FKT', "year" => 2017],
            (object) ["code" => '60', "long" => 'SEKOLAH PENDIDIKAN PROFESIONAL DAN PENDIDIKAN BERTERUSAN', "short" => 'SPACE', "short_overall" => 'SPACE', "year" => 2017],
            (object) ["code" => '62', "long" => 'BUSINESS ADVANCED TECHNOLOGY CENTRE', "short" => 'BATC', "short_overall" => 'BATC', "year" => 2017],
            (object) ["code" => '63', "long" => 'SEKOLAH PERNIAGAAN ANTARABANGSA AZMAN HASHIM', "short" => 'AHIBS', "short_overall" => 'AHIBS', "year" => 2017],
            (object) ["code" => '5100', "long" => 'FAKULTI KEJURUTERAAN', "short" => 'FE', "short_overall" => 'FE', "year" => 2021],
            (object) ["code" => '5102', "long" => 'SEKOLAH KEJURUTERAAN AWAM', "short" => 'SKA', "short_overall" => 'FKA', "year" => 2021],
            (object) ["code" => '5103', "long" => 'SEKOLAH KEJURUTERAAN BIOPERUBATAN & SAINS KESIHATAN', "short" => 'SKBSK', "short_overall" => 'FKBSK', "year" => 2021],
            (object) ["code" => '5104', "long" => 'SEKOLAH KEJURUTERAAN ELEKTRIK', "short" => 'SKE', "short_overall" => 'FKE', "year" => 2021],
            (object) ["code" => '5105', "long" => 'SEKOLAH KEJURUTERAAN KIMIA & KEJURUTERAAN TENAGA', "short" => 'SKT', "short_overall" => 'FKT', "year" => 2021],
            (object) ["code" => '5106', "long" => 'SEKOLAH KEJURUTERAAN MEKANIKAL', "short" => 'SKM', "short_overall" => 'FKM', "year" => 2021],
            (object) ["code" => '5107', "long" => 'SEKOLAH KOMPUTERAN', "short" => 'SK', "short_overall" => 'FC', "year" => 2021],
            (object) ["code" => '5200', "long" => 'FAKULTI ALAM BINA DAN UKUR', "short" => 'FABU', "short_overall" => 'FABU', "year" => 2021],
            (object) ["code" => '5300', "long" => 'FAKULTI SAINS SOSIAL DAN KEMANUSIAAN', "short" => 'FSSK', "short_overall" => 'FSSK', "year" => 2021],
            (object) ["code" => '5302', "long" => 'AKADEMI BAHASA', "short" => 'AB', "short_overall" => 'FSSK', "year" => 2021],
            (object) ["code" => '5303', "long" => 'AKADEMI TAMADUN ISLAM', "short" => 'ATI', "short_overall" => 'FSSK', "year" => 2021],
            (object) ["code" => '5304', "long" => 'SEKOLAH PEMBANGUNAN SUMBER MANUSIA & PSIKOLOGI', "short" => 'SPSMP', "short_overall" => 'FSSK', "year" => 2021],
            (object) ["code" => '5305', "long" => 'SEKOLAH PENDIDIKAN', "short" => 'SP', "short_overall" => 'FSSK', "year" => 2021],
            (object) ["code" => '5400', "long" => 'FAKULTI SAINS', "short" => 'FS', "short_overall" => 'FS', "year" => 2021],
            (object) ["code" => '5500', "long" => 'SEKOLAH PERNIAGAAN ANTARABANGSA AZMAN HASHIM', "short" => 'AHIBS', "short_overall" => 'AHIBS', "year" => 2021],
            (object) ["code" => '5600', "long" => 'FAKULTI TEKNOLOGI DAN INFORMATIK RAZAK', "short" => 'FTIR', "short_overall" => 'FTIR', "year" => 2021],
            (object) ["code" => '5700', "long" => 'INSTITUT TEKNOLOGI ANTARABANGSA MALAYSIA-JEPUN', "short" => 'MJIIT', "short_overall" => 'MJIIT', "year" => 2021],
            (object) ["code" => '5800', "long" => 'FAKULTI KEJURUTERAAN AWAM', "short" => 'FKA', "short_overall" => 'FKA', "year" => 2022],
            (object) ["code" => '5900', "long" => 'FAKULTI KEJURUTERAAN ELEKTRIK', "short" => 'FKE', "short_overall" => 'FKE', "year" => 2022],
            (object) ["code" => '6000', "long" => 'FAKULTI KEJURUTERAAN KIMIA & KEJURUTERAAN TENAGA', "short" => 'FKT', "short_overall" => 'FKT', "year" => 2022],
            (object) ["code" => '6100', "long" => 'FAKULTI KEJURUTERAAN MEKANIKAL', "short" => 'FKM', "short_overall" => 'FKM', "year" => 2022],
            (object) ["code" => '6200', "long" => 'FAKULTI KOMPUTERAN', "short" => 'FC', "short_overall" => 'FC', "year" => 2022],
            (object) ["code" => '6300', "long" => 'FAKULTI ALAM BINA DAN UKUR', "short" => 'FABU', "short_overall" => 'FABU', "year" => 2022],
            (object) ["code" => '6400', "long" => 'FAKULTI SAINS SOSIAL DAN KEMANUSIAAN', "short" => 'FSSK', "short_overall" => 'FSSK', "year" => 2022],
            (object) ["code" => '6500', "long" => 'AKADEMI BAHASA', "short" => 'AB', "short_overall" => 'FSSK', "year" => 2022],
            (object) ["code" => '6600', "long" => 'AKADEMI TAMADUN ISLAM', "short" => 'ATI', "short_overall" => 'FSSK', "year" => 2022],
            (object) ["code" => '6700', "long" => 'SEKOLAH PEMBANGUNAN SUMBER MANUSIA & PSIKOLOGI', "short" => 'SPSMP', "short_overall" => 'FSSK', "year" => 2022],
            (object) ["code" => '6800', "long" => 'SEKOLAH PENDIDIKAN', "short" => 'SP', "short_overall" => 'FSSK', "year" => 2022],
            (object) ["code" => '6900', "long" => 'FAKULTI SAINS', "short" => 'FS', "short_overall" => 'FS', "year" => 2022],
            (object) ["code" => '7000', "long" => 'FAKULTI PENGURUSAN', "short" => 'FM', "short_overall" => 'FM', "year" => 2022],
            (object) ["code" => '7100', "long" => 'SEKOLAH PERNIAGAAN ANTARABANGSA AZMAN HASHIM', "short" => 'AHIBS', "short_overall" => 'AHIBS', "year" => 2022],
            (object) ["code" => '7200', "long" => 'FAKULTI TEKNOLOGI DAN INFORMATIK RAZAK', "short" => 'FTIR', "short_overall" => 'FTIR', "year" => 2022],
            (object) ["code" => '7300', "long" => 'INSTITUT TEKNOLOGI ANTARABANGSA MALAYSIA-JEPUN', "short" => 'MJIIT', "short_overall" => 'MJIIT', "year" => 2022],
        ];
        
        usort($result, function($a, $b) {return strcmp($a->long, $b->long);});
        return $result;
    }
}

if (!function_exists('getFaculty2')) {
    function getFaculty2($all = false, $active = false)
    {
        $active_arr = ['Y'];
        if($active) $active_arr = ['Y', 'N'];
        if($all) return \App\Models\Parameter::whereIn('group_id',[1,2])->whereIn('active', $active_arr)->orderBy('description_1')->get();
        return \App\Models\Parameter::whereGroupId(1)->whereIn('active', $active_arr)->orderBy('description_1')->get();
    }
}

if (!function_exists('getSchoolByFaculty')) {
    function getSchoolByFaculty($faculty_code)
    {
        $faculty = \App\Models\Parameter::whereCode($faculty_code)->first();
        return \App\Models\Parameter::whereGroupId(2)->whereParentId($faculty->id ?? '')->whereActive('Y')->orderBy('description_1')->get();
    }
}

if (!function_exists('getFacultyByCode')) {
    function getFacultyByCode($code)
    {
        return \App\Models\Parameter::whereCode($code)->first();
    }
}

if (!function_exists('getSchoolByCode')) {
    function getSchoolByCode($code)
    {
        return \App\Models\Parameter::whereGroupId(2)->whereCode($code)->first();
    }
}

if (!function_exists('getFacultyByYear')) {
    function getFacultyByYear($year)
    {
        $year_filter = 2017;
        if($year >= 2018) $year_filter = 2018;
        if($year >= 2021) $year_filter = 2021;
        if($year >= 2022) $year_filter = 2022;
        $faculties = collect(getFaculty())->whereIn('year', [$year_filter, NULL]);
        return $faculties->values();
    }
}

if (!function_exists('getMainFund')) {
    function getMainFund()
    {
        return \App\Models\DanaRU\DruMainFund::whereNotNull('program_id')->whereStatus('active')->orderBy('code')->get();
    }
}

if (!function_exists('getMainFundByFormula')) {
    function getMainFundByFormula($code, $code_2, $mode="STD", $alias = null)
    {
        $alias_data = '';
        if($alias) $alias_data = 'as '.$alias;
        if($mode == "STD"){
            $tabung_induk_code = '';
            if(in_array($code, ["21A2","21A3","21A4","21A5","21A6","22B2","22B3","22B4","22B5","22B7","22B8","22B9","22C2","22C3","23C1","23C3","23C6","23C7","23C9","24C1","24C2","24C3","24C4","3801"])) $tabung_induk_code = $code;
            else if($code == '21A1' && $code_2 == '00A00') $tabung_induk_code = $code . '.' . $code_2;
            else if($code == '21A1' && $code_2 == '00A36') $tabung_induk_code = $code . '.' . $code_2;
            else if($code == "22B6" && $code_2 == "00D24") $tabung_induk_code = $code . '.' . $code_2;
            else if($code == "22B6" && $code_2 == "00D27") $tabung_induk_code = $code . '.' . $code_2;
            else if($code == "23C4" && $code_2 == "00B54") $tabung_induk_code = $code . '.' . $code_2;
            else if($code == "23C4" && $code_2 == "01D31") $tabung_induk_code = $code . '.' . $code_2;
            else if($code == "23C5" && $code_2 == "00D95") $tabung_induk_code = $code . '.' . $code_2;
            else if($code == "23C5" && $code_2 != "00D95") $tabung_induk_code = "23C5.00000";
            else if($code == "23C8" && $code_2 == "00B56") $tabung_induk_code = $code . '.' . $code_2;
            else if($code == "23C8" && $code_2 == "01D42") $tabung_induk_code = $code . '.' . $code_2;
            else if((substr($code, 0, 2).'00' == '3100') && $code_2 == '00A37') $tabung_induk_code = '3100.00A37';
            else if(substr($code, 0, 2).'00' == '3100') $tabung_induk_code = '3100.00000';
            else if((substr($code, 0, 2).'00' == '3000') && substr($code_2, 2, 1) == 'D') $tabung_induk_code = '3000.01D29';
            else if(substr($code, 0, 2).'00' == '3000') $tabung_induk_code = '3000.00000';
            else $tabung_induk_code = substr($code, 0, 2).'00';
            return $tabung_induk_code;
        }
        else if($mode == "MYSQL"){
            return "CASE 
            WHEN ".$code." IN ('21A2','21A3','21A4','21A5','21A6','22B2','22B3','22B4','22B5','22B7','22B8','22B9','22C2','22C3','23C1','23C3','23C6','23C7','23C9','24C1','24C2','24C3','24C4','3801') THEN ".$code."
            WHEN ".$code." = '21A1' AND ".$code_2." = '00A00' THEN CONCAT(".$code.", '.', ".$code_2.")
            WHEN ".$code." = '21A1' AND ".$code_2." = '00A36' THEN CONCAT(".$code.", '.', ".$code_2.")
            WHEN ".$code." = '22B6' AND ".$code_2." = '00D24' THEN CONCAT(".$code.", '.', ".$code_2.")
            WHEN ".$code." = '22B6' AND ".$code_2." = '00D27' THEN CONCAT(".$code.", '.', ".$code_2.")
            WHEN ".$code." = '23C4' AND ".$code_2." = '00B54' THEN CONCAT(".$code.", '.', ".$code_2.")
            WHEN ".$code." = '23C4' AND ".$code_2." = '01D31' THEN CONCAT(".$code.", '.', ".$code_2.")
            WHEN ".$code." = '23C5' AND ".$code_2." = '00D95' THEN CONCAT(".$code.", '.', ".$code_2.")
            WHEN ".$code." = '23C5' AND ".$code_2." != '00D95' THEN '23C5.00000'
            WHEN ".$code." = '23C8' AND ".$code_2." = '00B56' THEN CONCAT(".$code.", '.', ".$code_2.")
            WHEN ".$code." = '23C8' AND ".$code_2." = '01D42' THEN CONCAT(".$code.", '.', ".$code_2.")
            WHEN CONCAT(LEFT(".$code.", 2), '00') = '3100' AND ".$code_2." = '00A37' THEN '3100.00A37'
            WHEN CONCAT(LEFT(".$code.", 2), '00') = '3100' THEN '3100.00000'
            WHEN CONCAT(LEFT(".$code.", 2), '00') = '3000' AND SUBSTRING(".$code_2.",3,1) = 'D' THEN '3000.01D29'
            WHEN CONCAT(LEFT(".$code.", 2), '00') = '3000' THEN '3000.00000'
            ELSE CONCAT(LEFT(".$code.", 2), '00') END ".$alias_data;
        }
    }
}

if (!function_exists('getMrunList')) {
    function getMrunList()
    {
        return \App\Models\Parameter::whereGroupId(3)->whereActive('Y')->get();
    }
}

if (!function_exists('getBpkiList')) {
    function getBpkiList()
    {
        return \App\Models\Parameter::whereGroupId(4)->orderBy('code')->whereActive('Y')->get();
    }
}

if (!function_exists('getKpiTemplate')) {
    function getKpiTemplate($type)
    {
        return \App\Models\DanaRU\DruKpiTemplate::whereType($type)->whereActive('Y')->get();
    }
}

if (!function_exists('getAppendedPtjCode')) {
    function getAppendedPtjCode($code, $length)
    {
        $ptj_code = $code;
        $res = $ptj_code;
        for ($i=0; $i < ($length - strlen($ptj_code)); $i++) { 
            $res .= '0';
        }
        return $res;
    }
}

if (!function_exists('getProjectSecondCode')) {
    function getProjectSecondCode($code)
    {
        if($code)return $code;
        else return '00000';
    }
}

if (!function_exists('getStatusOptions')) {
    function getStatusOptions($pending_status, $plan_type = null)
    {
        if(in_array($pending_status, [2, 3]) && $plan_type == 3)return \App\Models\Status::whereIn('id', [5,6])->orderBy('sort')->get();
        else if(in_array($pending_status, [2, 3]) && $plan_type == 4)return \App\Models\Status::whereIn('id', [5,6])->orderBy('sort')->get();
        else if(in_array($pending_status, [2, 3]) && $plan_type == 5)return \App\Models\Status::whereIn('id', [5,6])->orderBy('sort')->get();
        else if(in_array($pending_status, [2, 3]))return \App\Models\Status::whereIn('id', [4,5])->orderBy('sort')->get();
        else if(in_array($pending_status, [4]))return \App\Models\Status::whereIn('id', [5,6])->orderBy('sort')->get();
        else if(in_array($pending_status, [8, 9]))return \App\Models\Status::whereIn('id', [10,11,12])->orderBy('sort')->get();
    }
}

if (!function_exists('storeLogData')) {
    function storeLogData($plan, $approval_app_id, $type, $category = null, $targeted_data = null)
    {
        $status = $plan->getStatus;
        $log_data = [
            'dru_distribution_plan' => [
                'id' => $plan->id,
                'year' => $plan->year,
                'amount' => $plan->amount,
                'status' => $plan->getStatus->description ?? $plan->getStatus->name,
                'infographic_data' => infographicData($plan)
            ],
            'dru_distribution_plan_form' => [],
        ];
        \Illuminate\Support\Facades\DB::statement("SET SQL_MODE=''");
        $plan_forms = \App\Models\DanaRU\DruDistributionPlanForm::from('dru_distribution_plan_forms as plan_form')
            ->select([
                'plan_form.id as plan_form_id',
                'mrun.id as mrun_id', 'mrun.parameter_name as mrun_code', 'bpki.id as bpki_id', 'bpki.parameter_name as bpki_code',
                'pic.name as pic_name', 'pic.nric as pic_nric', 'pic.email as pic_email', 'member.name as member_name', 'member.nric as member_nric', 'member.email as member_email',
                'ptj.parameter_name as ptj','ptj.original_code as ptj_code',
                \Illuminate\Support\Facades\DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(main_kpi_template.title,": RM", FORMAT(main_kpi.amount, 2), " x ", main_kpi.count, " = RM", FORMAT(main_kpi.total, 2))) ORDER BY main_kpi.id ASC SEPARATOR "<br>") as main_kpi_details'),
                \Illuminate\Support\Facades\DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(kpi_template.title,": RM", FORMAT(kpi.amount, 2), " x ", kpi.count, " = RM", FORMAT(kpi.total, 2))) ORDER BY kpi.id ASC SEPARATOR "<br>") as kpi_details'),
                \Illuminate\Support\Facades\DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(pic_kpi_template.title,": RM", FORMAT(pic_kpi.amount, 2), " x ", pic_kpi.count, " = RM", FORMAT(pic_kpi.total, 2))) ORDER BY pic_kpi.id ASC SEPARATOR "<br>") as pic_kpi_details'),
                'ddf.status as ddf_status','ddf.code as ddf_code','ddf.title as ddf_title','ddf.code_2 as ddf_code_2','plan_form.notes','plan_form.amount as plan_form_amount',
            ])
            ->join('dru_distribution_plans as plan', function ($join) use ($plan) {
                $join->on('plan.id', '=', 'plan_form.distribution_plan_id')
                    ->where('plan.year',$plan->year);
            })
            ->join('parameters as mrun', function ($join) {
                $join->on('mrun.id', '=', 'plan_form.mrun')
                    ->where('mrun.active','Y');
            })
            ->join('parameters as bpki', function ($join) {
                $join->on('bpki.id', '=', 'plan_form.bpki')
                    ->where('bpki.active','Y');
            })
            ->join('parameters as ptj', function ($join) {
                $join->on('ptj.id', '=', 'plan_form.ptj_id')
                    ->where('ptj.active','Y');
            })
            ->join('dru_members as pic', function ($join) {
                $join->on('pic.distribution_plan_form_id', '=', 'plan_form.id')->where('pic.type','leader');
            })
            ->leftjoin('dru_members as member', function ($join) {
                $join->on('member.distribution_plan_form_id', '=', 'plan_form.id')->where('member.type','member');
            })
            ->leftjoin('dru_kpis as main_kpi', function ($join) {
                $join->on('main_kpi.distribution_plan_form_id', '=', 'plan_form.id')
                ->where('main_kpi.type','main')->where('main_kpi.status','active');
            })
            ->leftjoin('dru_kpi_templates as main_kpi_template', function ($join) {
                $join->on('main_kpi_template.id', '=', 'main_kpi.kpi_template_id')
                ->where('main_kpi_template.active','Y');
            })
            ->leftjoin('dru_kpis as kpi', function ($join) {
                $join->on('kpi.distribution_plan_form_id', '=', 'plan_form.id')
                ->where('kpi.type','kpi')->where('kpi.status','active');
            })
            ->leftjoin('dru_kpi_templates as kpi_template', function ($join) {
                $join->on('kpi_template.id', '=', 'kpi.kpi_template_id')
                ->where('kpi_template.active','Y');
            })
            ->leftjoin('dru_kpi_pics as pic_kpi', function ($join) {
                $join->on('pic_kpi.distribution_plan_form_id', '=', 'plan_form.id')
                ->where('pic_kpi.status','active');
            })
            ->leftjoin('dru_kpi_templates as pic_kpi_template', function ($join) {
                $join->on('pic_kpi_template.id', '=', 'pic_kpi.kpi_template_id')
                ->where('pic_kpi_template.active','Y');
            })
            ->join('dru_dist_funds as ddf','ddf.id', '=', 'plan_form.project_id')
            ->groupBy('plan_form.id')->where('plan.year', $plan->year)
            ->get();
        foreach ($plan_forms as $key => $plan_form) {
            $form_data = [
                'id' => $plan_form->plan_form_id,
                'mrun' => $plan_form->mrun_code,
                'bpki' => $plan_form->bpki_code,
                'pic_name' => $plan_form->pic_name,
                'pic_nric' => $plan_form->pic_nric,
                'pic_email' => $plan_form->pic_email,
                'member_name' => $plan_form->member_name,
                'member_nric' => $plan_form->member_nric,
                'member_email' => $plan_form->member_email,
                'ptj' => $plan_form->ptj,
                'project_title' => strtoupper($plan_form->ddf_title),
                'chargeline' => $plan_form->ddf_status == 'active' ? 'Q'.getAppendedPtjCode($plan_form->ptj_code, 7).'.'. $plan_form->ddf_code .'.'. getProjectSecondCode($plan_form->ddf_code_2) : '',
                'main_kpi_details' => $plan_form->main_kpi_details,
                'kpi_details' => $plan_form->kpi_details,
                'pic_kpi_details' => $plan_form->pic_kpi_details,
                'amount' => number_format($plan_form->plan_form_amount, 2, '.', ','),
                'notes' => $plan_form->notes,
            ];
            array_push($log_data['dru_distribution_plan_form'], $form_data);
        }
        $log = new \App\Models\DruLog;
        $log->approval_app_id = $approval_app_id;
        $log->data = json_encode($log_data);
        $log->targeted_data = $targeted_data ? json_encode($targeted_data) : null;
        $log->type = $type;
        $log->category = $category;
        $log->c_id = user()->id;
        $log->save();
    }
}

if (!function_exists('getDistributionFormPlans')) {
    function getDistributionFormPlans($year, $plan_id = null, $type = null, $plan_form_id = null){
        \Illuminate\Support\Facades\DB::statement("SET SQL_MODE=''");
        if($type == 4){
            $query = \App\Models\DanaRU\DruDistributionPlanForm::from('dru_distribution_plan_forms as plan_form')
                ->select([
                    'plan_form.id as plan_form_id', 'plan_form.reference_no as plan_form_ref_no', 'plan_form.approved as plan_form_approved', 'plan_form.pic_declaration_date as plan_form_declaration_date','plan_form.pic_submission_status as plan_form_pic_submission_status',
                    'ptjf.parameter_name as ptjf','ptjf.original_code as ptjf_code',
                    'ptjt.parameter_name as ptjt','ptjt.original_code as ptjt_code',
                    'ddff.status as ddff_status','ddff.code as ddff_code','ddff.title as ddff_title','ddff.code_2 as ddff_code_2',
                    'ddft.status as ddft_status','ddft.code as ddft_code','ddft.title as ddft_title','ddft.code_2 as ddft_code_2',
                    'plan_form.notes','plan_form.amount as plan_form_amount','plan_form.commitment as plan_form_commitment',
                ])
                ->join('dru_distribution_plans as plan', function ($join) use ($year) {
                    $join->on('plan.id', '=', 'plan_form.distribution_plan_id')
                        ->where('plan.year',$year);
                })
                ->join('parameters as ptjf', function ($join) {
                    $join->on('ptjf.id', '=', 'plan_form.ptj_id')
                        ->where('ptjf.active','Y');
                })
                ->join('parameters as ptjt', function ($join) {
                    $join->on('ptjt.id', '=', 'plan_form.ptj_id_transfer')
                        ->where('ptjt.active','Y');
                })
                ->join('dru_dist_funds as ddff','ddff.id', '=', 'plan_form.project_id')
                ->join('dru_dist_funds as ddft','ddft.id', '=', 'plan_form.project_id_transfer')
                ->groupBy('plan_form.id')->where('plan.year', $year);
            $query = $query->where('plan_form.distribution_plan_id', $plan_id);
            $query = $query->get();    
            // dd($query->get());
        }
        else if($type == 5){
            $query = \App\Models\DanaRU\DruDistributionPlanForm::from('dru_distribution_plan_forms as plan_form')
                ->select([
                    'plan_form.id as plan_form_id', 'plan_form.reference_no as plan_form_ref_no', 'plan_form.approved as plan_form_approved', 'plan_form.pic_declaration_date as plan_form_declaration_date','plan_form.pic_submission_status as plan_form_pic_submission_status',
                    'ptj.parameter_name as ptj','ptj.original_code as ptj_code',
                    'ddf.status as ddf_status','ddf.code as ddf_code','ddf.title as ddf_title','ddf.code_2 as ddf_code_2',
                    'plan_form.notes','plan_form.amount as plan_form_amount','plan_form.commitment as plan_form_commitment',
                ])
                ->join('dru_distribution_plans as plan', function ($join) use ($year) {
                    $join->on('plan.id', '=', 'plan_form.distribution_plan_id')
                        ->where('plan.year',$year);
                })
                ->join('parameters as ptj', function ($join) {
                    $join->on('ptj.id', '=', 'plan_form.ptj_id')
                        ->where('ptj.active','Y');
                })
                ->join('dru_dist_funds as ddf','ddf.id', '=', 'plan_form.project_id')
                ->groupBy('plan_form.id')->where('plan.year', $year);
            $query = $query->where('plan_form.distribution_plan_id', $plan_id);
            $query = $query->get();    
            // dd($query->get());
        }
        else{
            $query = \App\Models\DanaRU\DruDistributionPlanForm::from('dru_distribution_plan_forms as plan_form')
                ->select([
                    'plan_form.id as plan_form_id', 'plan_form.reference_no as plan_form_ref_no', 'plan_form.approved as plan_form_approved', 'plan_form.pic_declaration_date as plan_form_declaration_date','plan_form.pic_submission_status as plan_form_pic_submission_status',
                    'mrun.id as mrun_id', 'mrun.parameter_name as mrun_code', 'bpki.id as bpki_id', 'bpki.parameter_name as bpki_code',
                    'pic.name as pic_name', 'member.name as member_name', 'pic.email as pic_email', 'member.email as member_email',
                    'pic_status.description as pic_submission_status_label',
                    'ptj.parameter_name as ptj','ptj.original_code as ptj_code',
                    \Illuminate\Support\Facades\DB::raw('(SELECT SUM(total) FROM dru_kpi_pics as pic_kpi WHERE pic_kpi.distribution_plan_form_id = plan_form.id) AS total_expenses'),
                    \Illuminate\Support\Facades\DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(main_kpi_template.title,": RM", FORMAT(main_kpi.amount, 2), " x ", main_kpi.count, " = RM", FORMAT(main_kpi.total, 2))) ORDER BY main_kpi.id ASC SEPARATOR "<br>") as main_kpi_details'),
                    \Illuminate\Support\Facades\DB::raw('GROUP_CONCAT(DISTINCT(main_kpi.remark) ORDER BY main_kpi.id ASC SEPARATOR "<br>") as main_kpi_remarks'),
                    \Illuminate\Support\Facades\DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(kpi_template.title,": RM", FORMAT(kpi.amount, 2), " x ", kpi.count, " = RM", FORMAT(kpi.total, 2))) ORDER BY kpi.id ASC SEPARATOR "<br>") as kpi_details'),
                    \Illuminate\Support\Facades\DB::raw('GROUP_CONCAT(DISTINCT(kpi.remark) ORDER BY kpi.id ASC SEPARATOR "<br>") as kpi_remarks'),
                    'ddf.status as ddf_status','ddf.code as ddf_code','ddf.title as ddf_title','ddf.code_2 as ddf_code_2','plan_form.notes','plan_form.amount as plan_form_amount','plan_form.commitment as plan_form_commitment',
                    'main_kpi.id as main_kpi_id','main_kpi_template.id as main_kpi_template_id','main_kpi_template.title as main_kpi_template_title','main_kpi_template.active as main_kpi_template_active','main_kpi.count as main_kpi_count','main_kpi.amount as main_kpi_amount','main_kpi.total as main_kpi_total','main_kpi.remark as main_kpi_remark',
                    'kpi.id as kpi_id','kpi_template.id as kpi_template_id','kpi_template.title as kpi_template_title','kpi_template.active as kpi_template_active','kpi.count as kpi_count','kpi.amount as kpi_amount','kpi.total as kpi_total','kpi.remark as kpi_remark',
                ])
                ->join('dru_distribution_plans as plan', function ($join) use ($year) {
                    $join->on('plan.id', '=', 'plan_form.distribution_plan_id')
                        ->where('plan.year',$year);
                })
                ->join('parameters as mrun', function ($join) {
                    $join->on('mrun.id', '=', 'plan_form.mrun')
                        ->where('mrun.active','Y');
                })
                ->join('parameters as bpki', function ($join) {
                    $join->on('bpki.id', '=', 'plan_form.bpki')
                        ->where('bpki.active','Y');
                })
                ->join('parameters as ptj', function ($join) {
                    $join->on('ptj.id', '=', 'plan_form.ptj_id')
                        ->where('ptj.active','Y');
                })
                ->join('dru_members as pic', function ($join) {
                    $join->on('pic.distribution_plan_form_id', '=', 'plan_form.id')->where('pic.type','leader');
                })
                ->leftjoin('dru_members as member', function ($join) {
                    $join->on('member.distribution_plan_form_id', '=', 'plan_form.id')->where('member.type','member');
                })
                ->leftjoin('dru_kpis as main_kpi', function ($join) {
                    $join->on('main_kpi.distribution_plan_form_id', '=', 'plan_form.id')
                    ->where('main_kpi.type','main')->where('main_kpi.status','active');
                })
                ->leftjoin('dru_kpi_templates as main_kpi_template', function ($join) {
                    $join->on('main_kpi_template.id', '=', 'main_kpi.kpi_template_id')
                    ->where('main_kpi_template.active','Y');
                })
                ->leftjoin('dru_kpis as kpi', function ($join) {
                    $join->on('kpi.distribution_plan_form_id', '=', 'plan_form.id')
                    ->where('kpi.type','kpi')->where('kpi.status','active');
                })
                ->leftjoin('dru_kpi_templates as kpi_template', function ($join) {
                    $join->on('kpi_template.id', '=', 'kpi.kpi_template_id')
                    ->where('kpi_template.active','Y');
                })
                ->leftjoin('statuses as pic_status', function ($join) {
                    $join->on('pic_status.id', '=', 'plan_form.pic_submission_status');
                })
                ->join('dru_dist_funds as ddf','ddf.id', '=', 'plan_form.project_id')
                ->groupBy('plan_form.id')->where('plan.year', $year);
            if($plan_id)$query = $query->where('plan_form.distribution_plan_id', $plan_id);
            if($plan_form_id)$query = $query->where('plan_form.id', $plan_form_id);
            // dd($query->get());
            $query = $query->get();
            $query = $query->map(function ($item) {
                $main_kpis = \App\Models\DanaRU\DruKpi::from('dru_kpis as main_kpi')
                ->select([
                    'main_kpi.id as id', 'main_kpi.count as bil', 'main_kpi.amount as amount', 'main_kpi.total as total', 'main_kpi.remark as remark', 
                    'main_kpi_template.id as item_id', 'main_kpi_template.title as item_name', 'main_kpi_template.active as active',
                ])
                ->leftjoin('dru_kpi_templates as main_kpi_template', function ($join) {
                    $join->on('main_kpi_template.id', '=', 'main_kpi.kpi_template_id')
                    ->where('main_kpi_template.active','Y');
                })->where('main_kpi.distribution_plan_form_id', $item->plan_form_id)->where('main_kpi.type', 'main')->get();
                $kpis = \App\Models\DanaRU\DruKpi::from('dru_kpis as kpi')
                ->select([
                    'kpi.id as id', 'kpi.count as bil', 'kpi.amount as amount', 'kpi.total as total', 'kpi.remark as remark', 
                    'kpi_template.id as item_id', 'kpi_template.title as item_name', 'kpi_template.active as active',
                ])
                ->leftjoin('dru_kpi_templates as kpi_template', function ($join) {
                    $join->on('kpi_template.id', '=', 'kpi.kpi_template_id')
                    ->where('kpi_template.active','Y');
                })->where('kpi.distribution_plan_form_id', $item->plan_form_id)->where('kpi.type', 'kpi')->get();
                $item->main_kpi_dataset = $main_kpis;
                $item->kpi_dataset = $kpis;
                return $item;
            });
        }
        
        return $query;
    }
}

if (!function_exists('getAccessControl')) {
    function getAccessControl($code)
    {
        $users = \App\Models\AccessControlLevel::from('access_control_levels as aclv')
            ->select('aclt.user_id as user_id')
            ->leftjoin('access_control_lists as aclt', function ($join) {
                $join->on('aclt.access_control_level_id', '=', 'aclv.id');
            })
            ->where('aclv.code', $code)->where('aclv.active', 'Y')->get()->toArray();

        $user = user()->id;
        $filtered_array = array_filter($users, function ($obj) use ($user) {
            return $obj['user_id'] == $user;
        });

        if(count($filtered_array) > 0) return true;
        else return false;
    }
}

if (!function_exists('getColorAmount')) {
    function getColorAmount($amount)
    {
        $result = ['opacity'=>1, 'text_color'=>'white'];
        $count = 0;
        for ($i=100000000; $i > 0; $i -= 5000000) { 
            $count++;
            if($amount < $i){
                $opacity = (1-0.045*$count);
                $text_color = $opacity > 0.65 ? 'white': 'black';
                $result = ['opacity'=>$opacity, 'text_color'=>$text_color];
            }
        }
        return $result;
    }
}

if (!function_exists('rtrimMinLength')) {
    function rtrimMinLength($string, $character = ' ', $minLength = 3)
    {
        $first_substring = substr($string, 0, $minLength);
        $second_substring = substr($string, 3);
        $trimmedString = rtrim($second_substring, $character);
        return $first_substring.$trimmedString;
    }
}

if (!function_exists('infographicData')) {
    function infographicData($plan)
    {
        $fund = 0;
        $do = 0;
        $gp = 0;
        $pp = 0;
        $do_percent = 0;
        $gp_percent = 0;
        $pp_percent = 0;
        $total = 0;
        $agihan_semula_lists = [];
        $pindahan_lists = [];

        if($plan instanceof Illuminate\Database\Eloquent\Collection){
            foreach ($plan as $key => $p) {
                $plan_type = $p->type;
                if(in_array($p->type, [1,2])){
                    $fund += $p->amount;
                    foreach ($p->forms as $key => $form) {
                        if($form->bpki == 50)$do += $form->amount;
                        elseif($form->bpki == 51)$gp += $form->amount;
                        elseif($form->bpki == 52)$pp += $form->amount;
                        $total += $form->amount;
                    }
                    $do_percent = $fund > 0 ? $do/$fund*100 : 0;
                    $gp_percent = $fund > 0 ? $gp/$fund*100 : 0;
                    $pp_percent = $fund > 0 ? $pp/$fund*100 : 0;
                }
                else if($p->type == 3){
                    $fund_as = $p->amount;
                    $do_as = 0;
                    $gp_as = 0;
                    $pp_as = 0;
                    $total_as = 0;
                    foreach ($p->forms as $key => $form) {
                        if($form->bpki == 50)$do_as += $form->amount;
                        elseif($form->bpki == 51)$gp_as += $form->amount;
                        elseif($form->bpki == 52)$pp_as += $form->amount;
                        $total_as += $form->amount;
                    }
                    $do_as_percent = $fund_as > 0 ? $do_as/$fund_as*100 : 0;
                    $gp_as_percent = $fund_as > 0 ? $gp_as/$fund_as*100 : 0;
                    $pp_as_percent = $fund_as > 0 ? $pp_as/$fund_as*100 : 0;
                    $agihan_semula_lists[] = [
                        'fund'=>$fund_as,
                        'label' => $p->created_at,
                        'do' => $do_as,
                        'gp' => $gp_as,
                        'pp' => $pp_as,
                        'do_percent' => $do_as_percent,
                        'gp_percent' => $gp_as_percent,
                        'pp_percent' => $pp_as_percent,
                        'do_color' => $do_as_percent > 20 ? 6 : 10,
                        'gp_color' => $gp_as_percent > 60 ? 6 : 10,
                        'pp_color' => $pp_as_percent > 20 ? 6 : 10,
                        'do_baseline' =>  baselineCost($total_as, 20),
                        'gp_baseline' => baselineCost($total_as, 60),
                        'pp_baseline' => baselineCost($total_as, 20),
                        'total' => $total_as,
                    ];
                }
                else if($p->type == 4){
                    $total_p = 0;
                    foreach ($p->forms as $key => $form) {
                        $total_p += $form->amount;
                    }
                    $pindahan_lists[] = [
                        'label' => $p->created_at,
                        'total' => $total_p,
                    ];
                }
            }
        }

        else if($plan instanceof Illuminate\Database\Eloquent\Model){
            if(in_array($plan->type, [1,2])){
                $fund = $plan->amount;
                foreach ($plan->forms as $key => $form) {
                    if($form->bpki == 50)$do += $form->amount;
                    elseif($form->bpki == 51)$gp += $form->amount;
                    elseif($form->bpki == 52)$pp += $form->amount;
                    $total += $form->amount;
                }
                $do_percent = $fund > 0 ? $do/$fund*100 : 0;
                $gp_percent = $fund > 0 ? $gp/$fund*100 : 0;
                $pp_percent = $fund > 0 ? $pp/$fund*100 : 0;
            }
            else if($plan->type == 3){
                $fund_as = $plan->amount;
                $do_as = 0;
                $gp_as = 0;
                $pp_as = 0;
                $total_as = 0;
                foreach ($plan->forms as $key => $form) {
                    if($form->bpki == 50)$do_as += $form->amount;
                    elseif($form->bpki == 51)$gp_as += $form->amount;
                    elseif($form->bpki == 52)$pp_as += $form->amount;
                    $total_as += $form->amount;
                }
                $do_as_percent = $fund_as > 0 ? $do_as/$fund_as*100 : 0;
                $gp_as_percent = $fund_as > 0 ? $gp_as/$fund_as*100 : 0;
                $pp_as_percent = $fund_as > 0 ? $pp_as/$fund_as*100 : 0;
                $agihan_semula_lists[] = [
                    'fund'=>$fund_as,
                    'label' => $plan->created_at,
                    'do' => $do_as,
                    'gp' => $gp_as,
                    'pp' => $pp_as,
                    'do_percent' => $do_as_percent,
                    'gp_percent' => $gp_as_percent,
                    'pp_percent' => $pp_as_percent,
                    'do_color' => $do_as_percent > 20 ? 6 : 10,
                    'gp_color' => $gp_as_percent > 60 ? 6 : 10,
                    'pp_color' => $pp_as_percent > 20 ? 6 : 10,
                    'do_baseline' =>  baselineCost($total_as, 20),
                    'gp_baseline' => baselineCost($total_as, 60),
                    'pp_baseline' => baselineCost($total_as, 20),
                    'total' => $total_as,
                ];
            }
            else if($plan->type == 4){
                $total_p = 0;
                foreach ($plan->forms as $key => $form) {
                    $total_p += $form->amount;
                }
                $pindahan_lists[] = [
                    'label' => $plan->created_at,
                    'total' => $total_p,
                ];
            }
            // if($plan->type == 1) {
            //     $do = 0;
            //     $gp = 0;
            //     $pp = 0;
            //     $total = 0;
            //     $plans = \App\Models\DanaRU\DruDistributionPlan::whereIn('type', [1,2])->get();
            //     $fund = $plans->sum('amount');
            //     foreach ($plans as $key => $plan) {
            //         foreach ($plan->forms as $key => $form) {
            //             if($form->bpki == 50)$do += $form->amount;
            //             elseif($form->bpki == 51)$gp += $form->amount;
            //             elseif($form->bpki == 52)$pp += $form->amount;
            //             $total += $form->amount;
            //         }
            //     }
            // }
            // dd($do);
        }

        return $data = [
            'fund'=>$fund,
            'do'=>$do,
            'gp'=>$gp,
            'pp'=>$pp,
            'do_percent' => $do_percent,
            'gp_percent' => $gp_percent,
            'pp_percent' => $pp_percent,
            'do_color' => $do_percent > 20 ? 6 : 10,
            'gp_color' => $gp_percent > 60 ? 6 : 10,
            'pp_color' => $pp_percent > 20 ? 6 : 10,
            'total' => $total,
            'agihan_semula_lists' => $agihan_semula_lists,
            'pindahan_lists' => $pindahan_lists
        ];
    }
}

if (!function_exists('baselineCost')) {
    function baselineCost($amount, $percent)
    {
        return $amount * $percent/100;
    }
}

if (!function_exists('getPlanType')) {
    function getPlanType($type)
    {
        if($type == 1) return "cadangan_agihan";
        if($type == 2) return "cadangan_agihan";
        if($type == 3) return "agihan_semula";
        if($type == 4) return "pindahan";
        if($type == 5) return "pengumpulan_dana";
    }
}

if (!function_exists('getDruPlanList')) {
    function getDruPlanList($year)
    {
        $plans = \App\Models\DanaRU\DruDistributionPlan::where('year', $year)->oldest()->get();
        return $plans;
    }
}

if (!function_exists('refactorPlanFormList')) {
    function refactorPlanFormList($plan_forms)
    {
        if($plan_forms){
            $results = $plan_forms->groupBy(function ($item) {
                return $item->mrun_code . '-' . $item->bpki_code . '-' . $item->ptj_code . '-' . $item->ddf_code . '-' . $item->ddf_code_2;
            });
            // dd($results);
            // Sum the amount for each group
            $filtered = $results->map(function ($group) {
                $firstItem = $group->first();
                $firstItem->plan_form_amount = $group->sum('plan_form_amount');
                
                    // $main_kpi_dataset[] = $group;
                // dd($group->count());
    
                $concatenatedString = $group->reduce(function ($carry, $item) {
                    return $carry . $item->main_kpi_details . '<br>';
                }, '');
            
                // Trim the last space
                $concatenatedString = trim($concatenatedString);
                $firstItem->main_kpi_details = $concatenatedString;
    
                return $firstItem;
    
            })->values();
            // dd($filtered);
            return $filtered;
        }
        return $plan_forms;   
    }
}

if (!function_exists('getExpensesReportInfo')) {
    function getExpensesReportInfo($year, $penggal){
        $datefilter = $penggal == 1 ? date('Y')."-06-30 23:59:59" : date('Y')."-12-31 23:59:59";
        $plans = getDruPlanList($year)->where('status', 6);
        $plan_form_raw = null;
        foreach ($plans as $key => $plan) {
            $plan_form = getDistributionFormPlans($year, $plan->id);
            if(!$plan_form_raw)$plan_form_raw = $plan_form;
            else $plan_form_raw = $plan_form_raw->concat($plan_form);
        }
        $plan_forms = $plan_form_raw;

        $plan_forms = refactorPlanFormList($plan_form_raw);

        $expenses = \App\Models\DanaRU\DruExpensesRecord::from('dru_expenses_records as expenses')
                ->select([
                    'expenses.distribution_plan_form_id', 'expenses.kpi_template_id', 'expenses.total', 'expenses.commitment', 'ddf.code as ddf_code','ddf.title as ddf_title','ddf.code_2 as ddf_code_2','ddf.faculty_code as faculty_code',
                    // 'plan_form.id as plan_form_id', 'plan_form.reference_no as plan_form_ref_no', 'plan_form.approved as plan_form_approved', 'plan_form.pic_declaration_date as plan_form_declaration_date','plan_form.pic_submission_status as plan_form_pic_submission_status',
                    // 'mrun.id as mrun_id', 'mrun.parameter_name as mrun_code', 'bpki.id as bpki_id', 'bpki.parameter_name as bpki_code',
                    // 'pic.name as pic_name', 'member.name as member_name', 'pic.email as pic_email', 'member.email as member_email',
                    // 'pic_status.description as pic_submission_status_label',
                    // 'ptj.parameter_name as ptj','ptj.original_code as ptj_code',
                    // \Illuminate\Support\Facades\DB::raw('(SELECT SUM(total) FROM dru_kpi_pics as pic_kpi WHERE pic_kpi.distribution_plan_form_id = plan_form.id) AS total_expenses'),
                    // \Illuminate\Support\Facades\DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(main_kpi_template.title,": RM", FORMAT(main_kpi.amount, 2), " x ", main_kpi.count, " = RM", FORMAT(main_kpi.total, 2))) ORDER BY main_kpi.id ASC SEPARATOR "<br>") as main_kpi_details'),
                    // \Illuminate\Support\Facades\DB::raw('GROUP_CONCAT(DISTINCT(main_kpi.remark) ORDER BY main_kpi.id ASC SEPARATOR "<br>") as main_kpi_remarks'),
                    \Illuminate\Support\Facades\DB::raw('CONCAT(kpi_template.title,": RM", FORMAT(expenses.amount, 2), " x ", expenses.count, " = RM", FORMAT(expenses.total, 2)) as kpi_details'),
                    // \Illuminate\Support\Facades\DB::raw('GROUP_CONCAT(DISTINCT(kpi.remark) ORDER BY kpi.id ASC SEPARATOR "<br>") as kpi_remarks'),
                    // 'ddf.status as ddf_status','ddf.code as ddf_code','ddf.title as ddf_title','ddf.code_2 as ddf_code_2','plan_form.notes','plan_form.amount as plan_form_amount','plan_form.commitment as plan_form_commitment',
                    // 'main_kpi.id as main_kpi_id','main_kpi_template.id as main_kpi_template_id','main_kpi_template.title as main_kpi_template_title','main_kpi_template.active as main_kpi_template_active','main_kpi.count as main_kpi_count','main_kpi.amount as main_kpi_amount','main_kpi.total as main_kpi_total','main_kpi.remark as main_kpi_remark',
                    // 'kpi.id as kpi_id','kpi_template.id as kpi_template_id','kpi_template.title as kpi_template_title','kpi_template.active as kpi_template_active','kpi.count as kpi_count','kpi.amount as kpi_amount','kpi.total as kpi_total','kpi.remark as kpi_remark',
                ])
                ->join('dru_distribution_plan_forms as plan_form', function ($join) use ($year) {
                    $join->on('plan_form.id', '=', 'expenses.distribution_plan_form_id');
                })
                ->join('dru_distribution_plans as plan', function ($join) use ($year) {
                    $join->on('plan.id', '=', 'plan_form.distribution_plan_id')
                        ->where('plan.year',$year);
                })
                ->leftjoin('dru_kpi_templates as kpi_template', function ($join) {
                    $join->on('kpi_template.id', '=', 'expenses.kpi_template_id')
                    ->where('kpi_template.active','Y');
                })
                ->join('dru_dist_funds as ddf','ddf.id', '=', 'plan_form.project_id')
                // ->orderBy('expenses.created_at')
                ->whereRaw('expenses.created_at = (SELECT MAX(e2.created_at) FROM dru_expenses_records e2 WHERE e2.distribution_plan_form_id = expenses.distribution_plan_form_id AND e2.kpi_template_id = expenses.kpi_template_id)')
                ->where('expenses.created_at', '<', $datefilter)
                ->where('plan.year', $year);
            // dd($query->get());
            $expenses = $expenses->get();
        // dd($expenses);
        // dd($plan_forms->where('mrun_code', "TD"));

        $data = [];
        $td = [
            "mrun" => "TALENT DEVELOPMENT",
            "programs" => []
        ];
        $rp = [
            "mrun" => "RESEARCH PROMINENT",
            "programs" => []
        ];
        $wc = [
            "mrun" => "WEALTH CREATION",
            "programs" => []
        ];
        $bgc = [
            "mrun" => "BRIDGING THE GRAND CHALLENGES",
            "programs" => []
        ];
        foreach($plan_forms->where('mrun_code', "TD") as $key => $program){
            $expenses_datas = $expenses->where('ddf_code', $program->ddf_code)->where('ddf_code_2', $program->ddf_code_2)->where('faculty_code', $program->ptj_code);
            $total_expenses = 0;
            $commitment = 0;
            $kpi_pic_details = "";
            foreach ($expenses_datas as $key => $expenses_data) {
                $total_expenses += $expenses_data->total;
                $kpi_pic_details .= $expenses_data->kpi_details . "<br>";
                $commitment = $expenses_data->commitment;
            }
            $td["programs"][] = [
                "title" => $program->ddf_title,
                "main_kpi_details" => $program->main_kpi_details,
                "kpi_details" => $program->kpi_details,
                "allocation" => $program->plan_form_amount,
                "total_expenses" => $total_expenses,
                "commitment" => (float)$commitment,
                "balance" => $program->plan_form_amount - (float)$commitment - (float)$total_expenses,
                "kpi_pic_details" => $kpi_pic_details,
            ];
        }

        foreach($plan_forms->where('mrun_code', "RP") as $key => $program){
            $expenses_datas = $expenses->where('ddf_code', $program->ddf_code)->where('ddf_code_2', $program->ddf_code_2)->where('faculty_code', $program->ptj_code);
            $total_expenses = 0;
            $commitment = 0;
            $kpi_pic_details = "";
            foreach ($expenses_datas as $key => $expenses_data) {
                $total_expenses += $expenses_data->total;
                $kpi_pic_details .= $expenses_data->kpi_details . "<br>";
                $commitment = $expenses_data->commitment;
            }
            $rp["programs"][] = [
                "title" => $program->ddf_title,
                "main_kpi_details" => $program->main_kpi_details,
                "kpi_details" => $program->kpi_details,
                "allocation" => $program->plan_form_amount,
                "total_expenses" => $total_expenses,
                "commitment" => (float)$commitment,
                "balance" => $program->plan_form_amount - (float)$commitment - (float)$total_expenses,
                "kpi_pic_details" => $kpi_pic_details,
            ];
        }

        foreach($plan_forms->where('mrun_code', "WC") as $key => $program){
            $expenses_datas = $expenses->where('ddf_code', $program->ddf_code)->where('ddf_code_2', $program->ddf_code_2)->where('faculty_code', $program->ptj_code);
            $total_expenses = 0;
            $commitment = 0;
            $kpi_pic_details = "";
            foreach ($expenses_datas as $key => $expenses_data) {
                $total_expenses += $expenses_data->total;
                $kpi_pic_details .= $expenses_data->kpi_details . "<br>";
                $commitment = $expenses_data->commitment;
            }
            $wc["programs"][] = [
                "title" => $program->ddf_title,
                "main_kpi_details" => $program->main_kpi_details,
                "kpi_details" => $program->kpi_details,
                "allocation" => $program->plan_form_amount,
                "total_expenses" => $total_expenses,
                "commitment" => (float)$commitment,
                "balance" => $program->plan_form_amount - (float)$commitment - (float)$total_expenses,
                "kpi_pic_details" => $kpi_pic_details,
            ];
        }

        foreach($plan_forms->where('mrun_code', "BGC") as $key => $program){
            $expenses_datas = $expenses->where('ddf_code', $program->ddf_code)->where('ddf_code_2', $program->ddf_code_2)->where('faculty_code', $program->ptj_code);
            $total_expenses = 0;
            $commitment = 0;
            $kpi_pic_details = "";
            foreach ($expenses_datas as $key => $expenses_data) {
                $total_expenses += $expenses_data->total;
                $kpi_pic_details .= $expenses_data->kpi_details . "<br>";
                $commitment = $expenses_data->commitment;
            }
            $bgc["programs"][] = [
                "title" => $program->ddf_title,
                "main_kpi_details" => $program->main_kpi_details,
                "kpi_details" => $program->kpi_details,
                "allocation" => $program->plan_form_amount,
                "total_expenses" => $total_expenses,
                "commitment" => (float)$commitment,
                "balance" => $program->plan_form_amount - (float)$commitment - (float)$total_expenses,
                "kpi_pic_details" => $kpi_pic_details,
            ];
        }

        if(count($td['programs']) > 0) $data[] = $td;
        if(count($rp['programs']) > 0) $data[] = $rp;
        if(count($wc['programs']) > 0) $data[] = $wc;
        if(count($bgc['programs']) > 0) $data[] = $bgc; 
        
        return $data;
    }
}

if (!function_exists('getAvailableFacultyFromPlan')) {
    function getAvailableFacultyFromPlan($year){
        return \App\Models\Parameter::from('parameters as faculty')
            ->select('faculty.*')
            ->join('dru_distribution_plan_forms as plan_form','faculty.id', '=', 'plan_form.ptj_id')
            ->join('dru_distribution_plans as plan', function ($join) use ($year) {
                $join->on('plan.id', '=', 'plan_form.distribution_plan_id')
                    ->where('plan.year',$year)->whereIn('type', [1,2,3])->where('status', 6);
            })
            ->groupBy('faculty.id')->orderBy('faculty.description_1')->get();
    }
}