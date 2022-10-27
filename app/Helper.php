<?php


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
            (object)[
                "short" => "CAN",
                "code" => 1,
                "long" => "CANSELORI"
            ],
            (object)[
                "short" => "PP",
                "code" => 2,
                "long" => "JABATAN PENDAFTAR"
            ],
            (object)[
                "short" => "PB",
                "code" => 3,
                "long" => "JABATAN BENDAHARI"
            ],
            (object)[
                "short" => "PSZ",
                "code" => 4,
                "long" => "PERPUSTAKAAN SULTANAH ZANARIAH"
            ],
            (object)[
                "short" => "PPK",
                "code" => 5,
                "long" => "JABATAN PENGARAH KERJA"
            ],
            (object)[
                "short" => "JTNCHEP",
                "code" => 6,
                "long" => "JABATAN TIMBALAN NAIB CANSELOR (HAL EHWAL PELAJAR)"
            ],
            (object)[
                "short" => "UTMDigital",
                "code" => 7,
                "long" => "PUSAT TEKNOLOGI MAKLUMAT DAN KOMUNIKASI"
            ],
            (object)[
                "short" => "JTNCAA",
                "code" => 8,
                "long" => "JABATAN TIMBALAN NAIB CANSELOR (A&amp;A)"
            ],
            (object)[
                "short" => "JTNCPI",
                "code" => 9,
                "long" => "JABATAN TIMBALAN NAIB CANSELOR (P&amp;I)"
            ],
            (object)[
                "short" => "SPS",
                "code" => 10,
                "long" => "SEKOLAH PENGAJIAN SISWAZAH"
            ],
            (object)[
                "short" => "UTMSPACE",
                "code" => 11,
                "long" => "SEKOLAH PENDIDIKAN PROFESIONAL DAN PENDIDIKAN BERTERUSAN"
            ],
            (object)[
                "short" => "UTM PRESS",
                "code" => 12,
                "long" => "PENERBIT",
            ],
            (object)[
                "short" => "RMC",
                "code" => 13,
                "long" => "PUSAT PENGURUSAN PENYELIDIKAN"
            ],
            (object)[
                "short" => "ICC",
                "code" => 14,
                "long" => "PUSAT INOVASI DAN PENGKOMERSILAN"
            ],
            (object)[
                "short" => "CTL",
                "code" => 16,
                "long" => "PUSAT PENGAJARAN DAN PEMBELAJARAN"
            ],
            (object)[
                "short" => "JTNCP",
                "code" => 17,
                "long" => "JABATAN TIMBALAN NAIB CANSELOR (PEMBANGUNAN)"
            ],
            (object)[
                "short" => "UTMLEAD",
                "code" => 18,
                "long" => "PUSAT KEPIMPINAN AKADEMIK"
            ],
            (object)[
                "short" => "UTMCS",
                "code" => 19,
                "long" => "UTM CAMPUS SUSTAINABILITY "
            ],
            (object)[
                "short" => "CCIN",
                "code" => 20,
                "long" => "UTM CENTRE FOR COMMUNITY &amp; INDUSTRY NETWOK "
            ],
            (object)[
                "short" => "FAB",
                "code" => 21,
                "long" => "FAKULTI ALAM BINA"
            ],
            (object)[
                "short" => "FKA",
                "code" => 22,
                "long" => "FAKULTI KEJURUTERAAN AWAM"
            ],
            (object)[
                "short" => "FKE",
                "code" => 23,
                "long" => "FAKULTI KEJURUTERAAN ELEKTRIK"
            ],
            (object)[
                "short" => "FKM",
                "code" => 24,
                "long" => "FAKULTI KEJURUTERAAN MEKANIKAL"
            ],
            (object)[
                "short" => "FKKKSA",
                "code" => 25,
                "long" => "FAKULTI KEJURUTERAAN KIMIA DAN KEJURUTERAAN SUMBER ASLI"
            ],
            (object)[
                "short" => "FS.",
                "code" => 26,
                "long" => "FAKULTI SAINS."
            ],
            (object)[
                "short" => "FGHT",
                "code" => 27,
                "long" => "FAKULTI GEOINFORMASI DAN HARTA TANAH"
            ],
            (object)[
                "short" => "FC",
                "code" => 28,
                "long" => "FAKULTI KOMPUTERAN"
            ],
            (object)[
                "short" => "FM",
                "code" => 29,
                "long" => "FAKULTI PENGURUSAN"
            ],
            (object)[
                "short" => "PPTS",
                "code" => 30,
                "long" => "PUSAT PENGAJIAN TAHUN ASAS"
            ],
            (object)[
                "short" => "FP",
                "code" => 31,
                "long" => "FAKULTI PENDIDIKAN"
            ],
            (object)[
                "short" => "KST",
                "code" => 32,
                "long" => "KOLEJ SAINS DAN TEKNOLOGI"
            ],
            (object)[
                "short" => "FTI",
                "code" => 33,
                "long" => "FAKULTI TAMADUN ISLAM"
            ],
            (object)[
                "short" => "FBB",
                "code" => 35,
                "long" => "FAKULTI BIOSAINS DAN BIOKEJURUTERAAN"
            ],
            (object)[
                "short" => "FKBSK",
                "code" => 36,
                "long" => "FAKULTI KEJURUTERAAN BIOPERUBATAN &amp; SAINS KESIHATAN"
            ],
            (object)[
                "short" => "SPPS",
                "code" => 37,
                "long" => "SEKOLAH PENGAJIAN PRA SISWAZAH"
            ],
            (object)[
                "short" => "UTM AIS",
                "code" => 38,
                "long" => "SEKOLAH INFORMATIK TERMAJU"
            ],
            (object)[
                "short" => "UTM Perdana",
                "code" => 39,
                "long" => "UTM PERDANA SCHOOL",
            ],
            (object)[
                "short" => "UTM Razak",
                "code" => 40,
                "long" => "UTM RAZAK SCHOOL"
            ],
            (object)[
                "short" => "ABahasa",
                "code" => 41,
                "long" => "AKADEMI BAHASA."
            ],
            (object)[
                "short" => "FPREE",
                "code" => 42,
                "long" => "FAKULTI KEJURUTERAAN PETROLEUM DAN KEJURUTERAAN TENAGA DIPERBAHARUI"
            ],
            (object)[
                "short" => "MJIIT",
                "code" => 43,
                "long" => "INSTITUT TEKNOLOGI ANTARABANGSA MALAYSIA-JEPUN"
            ],
            (object)[
                "short" => "FKK",
                "code" => 44,
                "long" => "FAKULTI KEJURUTERAAN KIMIA"
            ],
            (object)[
                "short" => "FBME",
                "code" => 45,
                "long" => "FAKULTI BIOSAINS DAN KEJURUTERAAN PERUBATAN"
            ],
            (object)[
                "short" => "FKT",
                "code" => 46,
                "long" => "FAKULTI KEJURUTERAAN KIMIA DAN KEJURUTERAAN TENAGA"
            ],
            (object)[
                "short" => "FK",
                "code" => 5100,
                "long" => "FAKULTI KEJURUTERAAN",
            ],
            (object)[
                "short" => "SKA",
                "code" => 5102,
                "long" => "SEKOLAH KEJURUTERAAN AWAM"
            ],
            (object)[
                "short" => "SKBSK",
                "code" => 5103,
                "long" => "SEKOLAH KEJURUTERAAN BIOPERUBATAN &amp; SAINS KESIHATAN"
            ],
            (object)[
                "short" => "SKE",
                "code" => 5104,
                "long" => "SEKOLAH KEJURUTERAAN ELEKTRIK"
            ],
            (object)[
                "short" => "SKT",
                "code" => 5105,
                "long" => "SEKOLAH KEJURUTERAAN KIMIA &amp; KEJURUTERAAN TENAGA"
            ],
            (object)[
                "short" => "SKM",
                "code" => 5106,
                "long" => "SEKOLAH KEJURUTERAAN MEKANIKAL"
            ],
            (object)[
                "short" => "SC",
                "code" => 5107,
                "long" => "SEKOLAH KOMPUTERAN"
            ],
            (object)[
                "short" => "FABU",
                "code" => 5200,
                "long" => "FAKULTI ALAM BINA DAN UKUR"
            ],
            (object)[
                "short" => "FSSK",
                "code" => 5300,
                "long" => "FAKULTI SAINS SOSIAL DAN KEMANUSIAAN"
            ],
            (object)[
                "short" => "CASIS",
                "code" => 5301,
                "long" => "PUSAT KAJIAN TINGGI ISLAM, SAINS DAN PERADABAN"
            ],
            (object)[
                "short" => "AB",
                "code" => 5302,
                "long" => "AKADEMI BAHASA"
            ],
            (object)[
                "short" => "ATI",
                "code" => 5303,
                "long" => "AKADEMI TAMADUN ISLAM"
            ],
            (object)[
                "short" => "SPSMP",
                "code" => 5304,
                "long" => "SEKOLAH PEMBANGUNAN SUMBER MANUSIA &amp; PSIKOLOGI"
            ],
            (object)[
                "short" => "SP",
                "code" => 5305,
                "long" => "SEKOLAH PENDIDIKAN"
            ],
            (object)[
                "short" => "FS",
                "code" => 5400,
                "long" => "FAKULTI SAINS"
            ],
            (object)[
                "short" => "AHIBS",
                "code" => 5500,
                "long" => "SEKOLAH PERNIAGAAN ANTARABANGSA AZMAN HASHIM"
            ],
            (object)[
                "short" => "FTIR",
                "code" => 5600,
                "long" => "FAKULTI TEKNOLOGI DAN INFORMATIK RAZAK"
            ],
            (object)[
                "short" => "SPACE",
                "code" => 60,
                "long" => "SEKOLAH PENDIDIKAN PROFESIONAL DAN PENDIDIKAN BERTERUSAN"
            ],
            (object)[
                "short" => "SPACE (F)",
                "code" => 61,
                "long" => "SEKOLAH PENDIDIKAN PROFESIONAL DAN PENDIDIKAN BERTERUSAN(F)"
            ],
            (object)[
                "short" => "BATC",
                "code" => 62,
                "long" => "BUSINESS ADVANCED TECHNOLOGY CENTRE"
            ],
            (object)[
                "short" => "AHIBS",
                "code" => 63,
                "long" => "SEKOLAH PERNIAGAAN ANTARABANGSA AZMAN HASHIM"
            ],
            (object)[
                "short" => "CCSL",
                "code" => 64,
                "long" => "PUSAT KURSUS KOKURIKULUM DAN PEMBELAJARAN SERVIS"
            ],
            (object)[
                "short" => "PPMU",
                "code" => 65,
                "long" => "PUSAT PENGURUSAN MAKMAL UNIVERSITI"
            ],
            (object)[
                "short" => "OSHE",
                "code" => 66,
                "long" => "PEJABAT PERSEKITARAN, KESELAMATAN DAN KESIHATAN PEKERJAAN"
            ],
            (object)[
                "short" => "UTM XCITE",
                "code" => 67,
                "long" => "UTM CENTER FOR STUDENT INNOVATION &amp; TECHNOLOGY ENTREPRENEURSHIP"
            ],
            (object)[
                "short" => "AHIBS &amp; FE",
                "code" => 7101,
                "long" => "SEKOLAH PERNIAGAAN ANTARABANGSA AZMAN HASHIM DAN FAKULTI KEJURUTERAAN"
            ]
        ];
        usort($result, function($a, $b) {return strcmp($a->long, $b->long);});
        return $result;
    }
}