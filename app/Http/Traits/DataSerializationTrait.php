<?php
namespace App\Http\Traits;
use Illuminate\Support\Facades\DB;

trait DataSerializationTrait {
    public function staff_position($type){
        if($type == 'prof'){
            $data = [
                'PROF.',
            ];
        }
        else if($type == 'assoc_prof'){
            $data = [
                'ASSOC. PROF.',

            ];
        }
        else if($type == 'senior_lecturer'){
            $data = [
                'SENIOR LECTURER',
                'PENSYARAH KANAN (DS51)',
                'PENSYARAH KANAN (DS52)',
            ];
        }
        else if($type == 'lecturer'){
            $data = [
                'LECTURER',
                'PENSYARAH (DS45)',
            ];
        }
        else if($type == 'research_fellow'){
            $data = [
                'RESEARCH FELLOW',
            ];
        }

        return $data ?? [];
    }

    public function student_degree($type){
        if($type == 'phd'){
            $data = [
                'PHD',
            ];
        }
        else if($type == 'doctoral'){
            $data = [
                'DOCTORAL',
            ];
        }
        else if($type == 'master'){
            $data = [
                'SARJANA',
            ];
        }

        return $data ?? [];
    }

    public function student_study_mode($type){
        if($type == 'research'){
            $data = [
                'RESEARCH', 'PENYELIDIKAN',
            ];
        }
        else if($type == 'coursework'){
            $data = [
                'COURSEWORK',
                'KERJA KURSUS',
                'K KUR & PENYELIDIKAN',
                'MIXED MODE',
            ];
        }

        return $data ?? [];
    }

    public function student_study_area($code){
        $label = "";
        if(in_array($code, ["Alam Sekitar","ALAM SEKITAR"])){
            $code = "ALAM SEKITAR";
            $label = "ENVIRONMENT";
        }
        else if(in_array($code, ["BAHASA DAN LINGUISTIK"])){
            $code = "BAHASA DAN LINGUISTIK";
            $label = "LANGUAGE";
        }
        else if(in_array($code, ["KEJURUTERAAN"])){
            $code = "KEJURUTERAAN";
            $label = "ENGINEERING";
        }
        else if(in_array($code, ["KEWANGAN/PERNIAGAAN"])){
            $code = "KEWANGAN/PERNIAGAAN";
            $label = "FINANCE/BUSINESS";
        }
        else if(in_array($code, ["PENDIDIKAN"])){
            $code = "PENDIDIKAN";
            $label = "EDUCATION";
        }
        else if(in_array($code, ["Pendidikan (Multimedia Interaktif)"])){
            $code = "Pendidikan (Multimedia Interaktif)";
            $label = "INTERACTIVE MULTIMEDIA";
        }
        else if(in_array($code, ["PENDIDIKAN TEKNIKAL"])){
            $code = "PENDIDIKAN TEKNIKAL";
            $label = "TECHNICAL STUDY";
        }
        else if(in_array($code, ["PENGAJIAN ISLAM"])){
            $code = "PENGAJIAN ISLAM";
            $label = "ISLAMIC STUDY";
        }
        else if(in_array($code, ["SAINS"])){
            $code = "SAINS";
            $label = "SCIENCE";
        }
        else if(in_array($code, ["SAINS DENGAN PENDIDIKAN"])){
            $code = "SAINS DENGAN PENDIDIKAN";
            $label = "SCIENCE EDUCATION";
        }
        else if(in_array($code, ["SAINS KOMPUTER"])){
            $code = "SAINS KOMPUTER";
            $label = "COMPUTER SCIENCE";
        }
        else if(in_array($code, ["SAINS PENTADBIRAN & PENGAJIAN POLISI"])){
            $code = "SAINS PENTADBIRAN & PENGAJIAN POLISI";
            $label = "SCIENCE MANAGEMENT";
        }
        else if(in_array($code, ["SAINS/TEKNOLOGI"])){
            $code = "SAINS/TEKNOLOGI";
            $label = "SCIENCE/TECHNOLOGY";
        }
        else if(in_array($code, ["SASTERA & SAINS SOSIAL"])){
            $code = "SASTERA & SAINS SOSIAL";
            $label = "SOCIAL SCIENCE";
        }
        else if(in_array($code, ["SENIBINA/UKUR/PENILAIAN"])){
            $code = "SENIBINA/UKUR/PENILAIAN";
            $label = "ARCHITECTURE";
        }
        else if(in_array($code, ["TEKNIKAL"])){
            $code = "TEKNIKAL";
            $label = "TECHNICAL";
        }
        else if(in_array($code, ["TEKNOLOGI MAKLUMAT"])){
            $code = "TEKNOLOGI MAKLUMAT";
            $label = "INFORMATION TECHNOLOGY";
        }
        else if(in_array($code, ["TEKNOLOGI MAKLUMAT & KOMUNIKASI"])){
            $code = "TEKNOLOGI MAKLUMAT & KOMUNIKASI";
            $label = "COMMUNICATION";
        }
        else{
            $label = $code;
        }
        return ["code"=>$code,"label"=>$label];
    }

    public function filter_citizenship($type){
        if($type == 'local'){
            $data = [
                'LOCAL',
                'TEMPATAN',
            ];
        }
        else if($type == 'foreign'){
            $data = [
                'FOREIGN',
                'ANTARABANGSA',
            ];
        }

        return $data ?? [];
    }

    public function country_code_label($code){
        $label = "";
        if(in_array($code, ["AUS", "AUSTRALIA"])){
            $code = "AUS";
            $label = "AUSTRALIA";
        }
        else if(in_array($code, ["BGD", "BANGLADESH"])){
            $code = "BGD";
            $label = "BANGLADESH";
        }
        else if(in_array($code, ["EGY", "EGYPT"])){
            $code = "EGY";
            $label = "EGYPT";
        }
        else if(in_array($code, ["GBR", "UNITED KINGDOM"])){
            $code = "GBR";
            $label = "UNITED KINGDOM";
        }
        else if(in_array($code, ["IDN", "INDONESIA"])){
            $code = "IDN";
            $label = "INDONESIA";
        }
        else if(in_array($code, ["IND", "INDIA"])){
            $code = "IND";
            $label = "INDIA";
        }
        else if(in_array($code, ["IRN", "IRAN", "ISLAMIC REPUBLIC OF IRAN"])){
            $code = "IRN";
            $label = "IRAN";
        }
        else if(in_array($code, ["IRQ", "IRAQ"])){
            $code = "IRQ";
            $label = "IRAQ";
        }
        else if(in_array($code, ["JPN", "JAPAN"])){
            $code = "JPN";
            $label = "JAPAN";
        }
        else if(in_array($code, ["JOR", "JORDAN"])){
            $code = "JOR";
            $label = "JORDAN";
        }
        else if(in_array($code, ["MYS", "MALAYSIA"])){
            $code = "MYS";
            $label = "MALAYSIA";
        }
        else if(in_array($code, ["NGA", "NIGERIA"])){
            $code = "NGA";
            $label = "NIGERIA";
        }
        else if(in_array($code, ["PAK", "PAKISTAN"])){
            $code = "PAK";
            $label = "PAKISTAN";
        }
        else if(in_array($code, ["PALESTIN", "PALESTINE","PALISTINE"])){
            $code = "PALESTIN";
            $label = "PALESTINE";
        }
        else if(in_array($code, ["RUS", "RUSIA", "RUSSIA", "RUSSIAN FEDERATION"])){
            $code = "RUS";
            $label = "RUSSIA";
        }
        else if(in_array($code, ["SDN", "SUDAN"])){
            $code = "SDN";
            $label = "SUDAN";
        }
        else if(in_array($code, ["KOREA", "SOUTH OF KOREA"])){
            $code = "KOREA";
            $label = "SOUTH OF KOREA";
        }
        else if(in_array($code, ["UZB", "UZBEKISTAN"])){
            $code = "UZB";
            $label = "UZBEKISTAN";
        }
        else if(in_array($code, ["YEM", "YEMEN"])){
            $code = "YEM";
            $label = "YEMEN";
        }
        else{
            $label = $code;
        }
        return ["code"=>$code,"label"=>$label];
    }

    public function sponsor_category($type){
        if($type == 'international'){
            $data = [
                'INTERNATIONAL',
            ];
        }
        else if($type == 'national'){
            $data = [
                'NATIONAL',
            ];
        }
        else if($type == 'university'){
            $data = [
                'UNIVERSITY',
            ];
        }
        else if($type == 'private'){
            $data = [
                'PRIVATE',
            ];
        }

        return $data ?? [];
    }

    public function nat_int($type){
        if($type == 'national'){
            $data = [
                'NATIONAL',
                'TEMPATAN',
            ];
        }
        else if($type == 'international'){
            $data = [
                'INTERNATIONAL',
                'ANTARABANGSA',
            ];
        }

        return $data ?? [];
    }

    public function award_type($type){
        if($type == 'award'){
            $data = [
                'AWARD',
                'AWARDS','B4C - AWARD'
            ];
        }
        else if($type == 'recognition_stewardship'){
            $data = [
                'RECOGNITION',
                'STEWARDSHIP',
                'FELLOWSHIP',
                'B4B - FELLOWSHIP/ RECOGNITION/STEWARDSHIP',
                'B4D - FELLOWSHIP/ RECOGNITION/STEWARDSHIP',
                'RECOGNITIONS/STEWARDSHIP'
            ];
        }
        else if($type == 'exhibition'){
            $data = [
                'EXHIBITION AWARDS',
                'EXHIBITION AWARD',
                'B4E - EXHIBITION AWARD'
            ];
        }
        else if($type == 'other'){
            $data = [
                'OTHER RESEARCH AWARDS',
                'B4F - OTHER RESEARCH AWARDS'
            ];
        }

        return $data ?? [];
    }

    public function got($type){
        if($type == 'yes'){
            $data = [
                'YA',
            ];
        }
        else if($type == 'no'){
            $data = [
                'TIDAK',
                null,
            ];
        }

        return $data ?? [];
    }
}

