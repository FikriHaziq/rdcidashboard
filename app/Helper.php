<?php
if (!function_exists('user')) {
    function user()
    {
        return auth()->user();
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

if (!function_exists('getFacultyByCode')) {
    function getFacultyByCode($code)
    {
        return collect(getFaculty())->where('code', $code)->first();
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