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
    function getFaculty2($all = false)
    {
        if($all) return \App\Models\Parameter::whereIn('group_id',[1,2])->whereActive('Y')->orderBy('description_1')->get();
        return \App\Models\Parameter::whereGroupId(1)->whereActive('Y')->orderBy('description_1')->get();
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
    function getStatusOptions($pending_status)
    {
        if(in_array($pending_status, [2, 3]))return \App\Models\Status::whereIn('id', [4,5])->orderBy('sort')->get();
        else if(in_array($pending_status, [4]))return \App\Models\Status::whereIn('id', [5,6])->orderBy('sort')->get();
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
                'infographic_data' => $plan->infographicData()
            ],
            'dru_distribution_plan_form' => [],
        ];
        \Illuminate\Support\Facades\DB::statement("SET SQL_MODE=''");
        $plan_forms = \App\Models\DanaRU\DruDistributionPlanForm::from('dru_distribution_plan_forms as plan_form')
            ->select([
                'plan_form.id as plan_form_id',
                'mrun.parameter_name as mrun_code', 'bpki.parameter_name as bpki_code',
                'pic.name as pic_name', 'pic.nric as pic_nric', 'pic.email as pic_email', 'member.name as member_name', 'member.nric as member_nric', 'member.email as member_email',
                'ptj.parameter_name as ptj','ptj.original_code as ptj_code',
                \Illuminate\Support\Facades\DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(main_kpi_template.title,": RM", FORMAT(main_kpi.amount, 2), " x ", main_kpi.count, " = RM", FORMAT(main_kpi.total, 2))) ORDER BY main_kpi.id ASC SEPARATOR "<br>") as main_kpi_details'),
                \Illuminate\Support\Facades\DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(kpi_template.title,": RM", FORMAT(kpi.amount, 2), " x ", kpi.count, " = RM", FORMAT(kpi.total, 2))) ORDER BY kpi.id ASC SEPARATOR "<br>") as kpi_details'),
                'pro.status as pro_status','pro.code as pro_code','pro.title as pro_title','pro.code_2 as pro_code_2','plan_form.notes','plan_form.amount as plan_form_amount',
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
            ->join('dru_projects as pro','pro.id', '=', 'plan_form.project_id')
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
                'project_title' => strtoupper($plan_form->pro_title),
                'chargeline' => $plan_form->pro_status == 'active' ? 'Q'.getAppendedPtjCode($plan_form->ptj_code, 7).'.'. $plan_form->pro_code .'.'. getProjectSecondCode($plan_form->pro_code_2) : '',
                'main_kpi_details' => $plan_form->main_kpi_details,
                'kpi_details' => $plan_form->kpi_details,
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
    function getDistributionFormPlans($year){
        \Illuminate\Support\Facades\DB::statement("SET SQL_MODE=''");
        return \App\Models\DanaRU\DruDistributionPlanForm::from('dru_distribution_plan_forms as plan_form')
            ->select([
                'plan_form.id as plan_form_id', 'plan_form.reference_no as plan_form_ref_no', 'plan_form.approved as plan_form_approved', 'plan_form.pic_declaration_date as plan_form_declaration_date',
                'mrun.parameter_name as mrun_code', 'bpki.parameter_name as bpki_code',
                'pic.name as pic_name', 'member.name as member_name',
                'ptj.parameter_name as ptj','ptj.original_code as ptj_code',
                \Illuminate\Support\Facades\DB::raw('(SELECT SUM(total) FROM dru_kpi_pics as pic_kpi WHERE pic_kpi.distribution_plan_form_id = plan_form.id) AS total_expenses'),
                \Illuminate\Support\Facades\DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(main_kpi_template.title,": RM", FORMAT(main_kpi.amount, 2), " x ", main_kpi.count, " = RM", FORMAT(main_kpi.total, 2))) ORDER BY main_kpi.id ASC SEPARATOR "<br>") as main_kpi_details'),
                \Illuminate\Support\Facades\DB::raw('GROUP_CONCAT(DISTINCT(CONCAT(kpi_template.title,": RM", FORMAT(kpi.amount, 2), " x ", kpi.count, " = RM", FORMAT(kpi.total, 2))) ORDER BY kpi.id ASC SEPARATOR "<br>") as kpi_details'),
                'pro.status as pro_status','pro.code as pro_code','pro.title as pro_title','pro.code_2 as pro_code_2','plan_form.notes','plan_form.amount as plan_form_amount',
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
            ->join('dru_projects as pro','pro.id', '=', 'plan_form.project_id')
            ->groupBy('plan_form.id')->where('plan.year', $year);
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