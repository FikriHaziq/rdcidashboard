<?php
namespace App\Http\Traits;

trait MyraCalculationTrait {

    public function calcSectionB($active_acad_staff, $active_st, $active_nonst, $important_data){
        // if($important_data->year >= 2016 && $important_data->year <= 2018)
        $myra1_global_weightage = 22;
        $myra2_global_weightage = 13;

        $myra_year_1[1] = $important_data->uni_staff;
        $myra_year_1[2] = $important_data->national_staff;
        $myra_year_1[3] = $important_data->private_staff;
        $myra_year_1[4] = $important_data->international_staff;
        $myra_year_1[0] = (float)$myra_year_1[1]+(float)$myra_year_1[2]+(float)$myra_year_1[3]+(float)$myra_year_1[4];
        $myra_year_2[0] = $important_data->phd;
        $myra_year_2[1] = $important_data->pro;
        $myra_year_3[1] = $important_data->a50;
        $myra_year_3[2] = $important_data->a40;
        $myra_year_3[3] = $important_data->b40;
        $myra_year_3[0] = (float)$myra_year_3[1]+(float)$myra_year_3[2]+(float)$myra_year_3[3];
        $myra_year_4[0] = $important_data->award_int;
        $myra_year_4[1] = $important_data->recog_int;
        $myra_year_4[2] = $important_data->award_nat;
        $myra_year_4[3] = $important_data->recog_nat;
        $myra_year_4[4] = $important_data->exhibition;
        $myra_year_4[5] = $important_data->other;
        $myra1_1[0] = $active_acad_staff > 0 ? $myra_year_1[0]/$active_acad_staff : 0;
        $myra1_1[1] = 'YES';
        $myra1_1[2] = 'YES';
        $myra1_1[3] = 'YES';
        $myra1_1[4] = 'YES';
        $myra1_2[0] = 'YES';
        $myra1_2[1] = 'YES';
        $myra1_3[0] = '';
        $myra1_3[1] = 'YES';
        $myra1_3[2] = 'YES';
        $myra1_3[3] = 'YES';
        $myra1_4[0] = 'YES';
        $myra1_4[1] = 'YES';
        $myra1_4[2] = 'YES';
        $myra1_4[3] = 'YES';
        $myra1_4[4] = 'YES';
        $myra1_4[5] = 'YES';
        $myra2_1[0] = $active_acad_staff > 0 ? $myra_year_1[0]/$active_acad_staff : 0;
        $myra2_1[1] = 'YES';
        $myra2_1[2] = 'YES';
        $myra2_1[3] = 'YES';
        $myra2_1[4] = 'YES';
        $myra2_2[0] = 'YES';
        $myra2_2[1] = 'YES';
        $myra2_3[0] = '';
        $myra2_3[1] = 'YES';
        $myra2_3[2] = 'YES';
        $myra2_3[3] = 'YES';
        $myra2_4[0] = 'YES';
        $myra2_4[1] = 'YES';
        $myra2_4[2] = 'YES';
        $myra2_4[3] = 'YES';
        $myra2_4[4] = 'NO';
        $myra2_4[5] = 'NO';

        $u16 = $active_acad_staff > 0 ? (float)$myra_year_3[1]/$active_acad_staff*100 : 0;
        $u17 = $active_acad_staff > 0 ? (float)$myra_year_3[2]/$active_acad_staff*100 : 0;
        $u18 = $active_acad_staff > 0 ? (float)$myra_year_3[3]/$active_acad_staff*100 : 0;
        $v16 = min(15, abs(30-$u16));
        $v17 = min(15, abs(30-$u17));
        $v18 = min(15, abs(30-$u18));

        //myra I
        $myra1_weightage_1 = 35;
        $myra1_weightage_2 = 20;
        $myra1_weightage_3 = 20;
        $myra1_weightage_4 = 25;

        $myra1_subweightage_1[0] = 30;
        $myra1_subweightage_1[1] = 24;
        $myra1_subweightage_1[2] = 16;
        $myra1_subweightage_1[3] = 30;
        $myra1_subweightage_2[0] = 80;
        $myra1_subweightage_2[1] = 20;
        $myra1_subweightage_3[0] = 30;
        $myra1_subweightage_3[1] = 40;
        $myra1_subweightage_3[2] = 30;
        $myra1_subweightage_4[0] = 16;
        $myra1_subweightage_4[1] = 16;
        $myra1_subweightage_4[2] = 20;
        $myra1_subweightage_4[3] = 20;
        $myra1_subweightage_4[4] = 8;
        $myra1_subweightage_4[5] = 20;

        $myra1_benchmark_1[1] = 23;
        $myra1_benchmark_1[2] = 18;
        $myra1_benchmark_1[3] = 12;
        $myra1_benchmark_1[4] = 12;
        $myra1_benchmark_1[0] = $myra1_benchmark_1[1]+$myra1_benchmark_1[2]+$myra1_benchmark_1[3]+$myra1_benchmark_1[4];
        $myra1_benchmark_2[0] = 60;
        $myra1_benchmark_2[1] = 20;
        $myra1_benchmark_3[1] = 30;
        $myra1_benchmark_3[2] = 40;
        $myra1_benchmark_3[3] = 30;
        $myra1_benchmark_3[0] = $myra1_benchmark_3[1]+$myra1_benchmark_3[2]+$myra1_benchmark_3[3];

        $myra1_benchmark_target_1[1] = $myra1_benchmark_1[1]/100*$active_acad_staff;
        $myra1_benchmark_target_1[2] = $myra1_benchmark_1[2]/100*$active_acad_staff;
        $myra1_benchmark_target_1[3] = $myra1_benchmark_1[3]/100*$active_acad_staff;
        $myra1_benchmark_target_1[4] = $myra1_benchmark_1[4]/100*$active_acad_staff;
        $myra1_benchmark_target_1[0] = $myra1_benchmark_target_1[1]+$myra1_benchmark_target_1[2]+$myra1_benchmark_target_1[3]+$myra1_benchmark_target_1[4];
        $myra1_benchmark_target_2[0] = $myra1_benchmark_2[0]/100*$active_acad_staff;
        $myra1_benchmark_target_2[1] = $myra1_benchmark_2[1]/100*$active_acad_staff;
        $myra1_benchmark_target_3[1] = $myra1_benchmark_3[1]/100*$active_acad_staff;
        $myra1_benchmark_target_3[2] = $myra1_benchmark_3[2]/100*$active_acad_staff;
        $myra1_benchmark_target_3[3] = $myra1_benchmark_3[3]/100*$active_acad_staff;
        $myra1_benchmark_target_3[0] = $myra1_benchmark_target_3[1]+$myra1_benchmark_target_3[2]+$myra1_benchmark_target_3[3];
        $myra1_benchmark_target_4[0] = 15;
        $myra1_benchmark_target_4[1] = 15;
        $myra1_benchmark_target_4[2] = 20;
        $myra1_benchmark_target_4[3] = 25;
        $myra1_benchmark_target_4[4] = 50;
        $myra1_benchmark_target_4[5] = 150;

        $myra1_benchmark_mark_1[1] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[0]/100);
        $myra1_benchmark_mark_1[2] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[1]/100);
        $myra1_benchmark_mark_1[3] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[2]/100);
        $myra1_benchmark_mark_1[4] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[3]/100);
        $myra1_benchmark_mark_1[0] = $myra1_benchmark_mark_1[1]+$myra1_benchmark_mark_1[2]+$myra1_benchmark_mark_1[3]+$myra1_benchmark_mark_1[4];
        $myra1_benchmark_mark_2[0] = $myra1_global_weightage*($myra1_weightage_2/100)*($myra1_subweightage_2[0]/100);
        $myra1_benchmark_mark_2[1] = $myra1_global_weightage*($myra1_weightage_2/100)*($myra1_subweightage_2[1]/100);
        $myra1_benchmark_mark_3[1] = $myra1_global_weightage*($myra1_weightage_3/100)*($myra1_subweightage_3[0]/100);
        $myra1_benchmark_mark_3[2] = $myra1_global_weightage*($myra1_weightage_3/100)*($myra1_subweightage_3[1]/100);
        $myra1_benchmark_mark_3[3] = $myra1_global_weightage*($myra1_weightage_3/100)*($myra1_subweightage_3[2]/100);
        $myra1_benchmark_mark_3[0] = $myra1_benchmark_mark_3[1]+$myra1_benchmark_mark_3[2]+$myra1_benchmark_mark_3[3];
        $myra1_benchmark_mark_4[0] = $myra1_global_weightage*($myra1_weightage_4/100)*($myra1_subweightage_4[0]/100);
        $myra1_benchmark_mark_4[1] = $myra1_global_weightage*($myra1_weightage_4/100)*($myra1_subweightage_4[1]/100);
        $myra1_benchmark_mark_4[2] = $myra1_global_weightage*($myra1_weightage_4/100)*($myra1_subweightage_4[2]/100);
        $myra1_benchmark_mark_4[3] = $myra1_global_weightage*($myra1_weightage_4/100)*($myra1_subweightage_4[3]/100);
        $myra1_benchmark_mark_4[4] = $myra1_global_weightage*($myra1_weightage_4/100)*($myra1_subweightage_4[4]/100);
        $myra1_benchmark_mark_4[5] = $myra1_global_weightage*($myra1_weightage_4/100)*($myra1_subweightage_4[5]/100);

        $myra1_mark_1[1] = $myra1_benchmark_target_1[1] > 0 ? (((float)$myra_year_1[1]/$myra1_benchmark_target_1[1]*$myra1_benchmark_mark_1[1]) > ($myra1_benchmark_mark_1[1]*2) ? $myra1_benchmark_mark_1[1]*2 : ((float)$myra_year_1[1]/$myra1_benchmark_target_1[1]*$myra1_benchmark_mark_1[1])) : 0;
        $myra1_mark_1[2] = $myra1_benchmark_target_1[2] > 0 ? (((float)$myra_year_1[2]/$myra1_benchmark_target_1[2]*$myra1_benchmark_mark_1[2]) > ($myra1_benchmark_mark_1[2]*2) ? $myra1_benchmark_mark_1[2]*2 : ((float)$myra_year_1[2]/$myra1_benchmark_target_1[2]*$myra1_benchmark_mark_1[2])) : 0;
        $myra1_mark_1[3] = $myra1_benchmark_target_1[3] > 0 ? (((float)$myra_year_1[3]/$myra1_benchmark_target_1[3]*$myra1_benchmark_mark_1[3]) > ($myra1_benchmark_mark_1[3]*2) ? $myra1_benchmark_mark_1[3]*2 : ((float)$myra_year_1[3]/$myra1_benchmark_target_1[3]*$myra1_benchmark_mark_1[3])) : 0;
        $myra1_mark_1[4] = $myra1_benchmark_target_1[4] > 0 ? (((float)$myra_year_1[4]/$myra1_benchmark_target_1[4]*$myra1_benchmark_mark_1[4]) > ($myra1_benchmark_mark_1[4]*2) ? $myra1_benchmark_mark_1[4]*2 : ((float)$myra_year_1[4]/$myra1_benchmark_target_1[4]*$myra1_benchmark_mark_1[4])) : 0;
        $myra1_mark_1[0] = $myra1_mark_1[1]+$myra1_mark_1[2]+$myra1_mark_1[3]+$myra1_mark_1[4];
        $myra1_mark_2[0] = $myra1_benchmark_target_2[0] > 0 ? (((float)$myra_year_2[0]/$myra1_benchmark_target_2[0]*$myra1_benchmark_mark_2[0]) > ($myra1_benchmark_mark_2[0]*2) ? $myra1_benchmark_mark_2[0]*2 : ((float)$myra_year_2[0]/$myra1_benchmark_target_2[0]*$myra1_benchmark_mark_2[0])) : 0;
        $myra1_mark_2[1] = $myra1_benchmark_target_2[1] > 0 ? (((float)$myra_year_2[1]/$myra1_benchmark_target_2[1]*$myra1_benchmark_mark_2[1]) > ($myra1_benchmark_mark_2[1]*2) ? $myra1_benchmark_mark_2[1]*2 : ((float)$myra_year_2[1]/$myra1_benchmark_target_2[1]*$myra1_benchmark_mark_2[1])) : 0;
        $myra1_mark_3[1] = $myra1_benchmark_mark_3[1]-(($myra1_benchmark_mark_3[1]*$v16)/15);
        $myra1_mark_3[2] = $myra1_benchmark_mark_3[2]-(($myra1_benchmark_mark_3[2]*$v17)/15);
        $myra1_mark_3[3] = $myra1_benchmark_mark_3[3]-(($myra1_benchmark_mark_3[3]*$v18)/15);
        $myra1_mark_3[0] = $myra1_mark_3[1]+$myra1_mark_3[2]+$myra1_mark_3[3];
        $myra1_mark_4[0] = $myra1_benchmark_target_4[0] > 0 ? (((float)$myra_year_4[0]/$myra1_benchmark_target_4[0]*$myra1_benchmark_mark_4[0]) > ($myra1_benchmark_mark_4[0]*2) ? $myra1_benchmark_mark_4[0]*2 : ((float)$myra_year_4[0]/$myra1_benchmark_target_4[0]*$myra1_benchmark_mark_4[0])) : 0;
        $myra1_mark_4[1] = $myra1_benchmark_target_4[1] > 0 ? (((float)$myra_year_4[1]/$myra1_benchmark_target_4[1]*$myra1_benchmark_mark_4[1]) > ($myra1_benchmark_mark_4[1]*2) ? $myra1_benchmark_mark_4[1]*2 : ((float)$myra_year_4[1]/$myra1_benchmark_target_4[1]*$myra1_benchmark_mark_4[1])) : 0;
        $myra1_mark_4[2] = $myra1_benchmark_target_4[2] > 0 ? (((float)$myra_year_4[2]/$myra1_benchmark_target_4[2]*$myra1_benchmark_mark_4[2]) > ($myra1_benchmark_mark_4[2]*2) ? $myra1_benchmark_mark_4[2]*2 : ((float)$myra_year_4[2]/$myra1_benchmark_target_4[2]*$myra1_benchmark_mark_4[2])) : 0;
        $myra1_mark_4[3] = $myra1_benchmark_target_4[3] > 0 ? (((float)$myra_year_4[3]/$myra1_benchmark_target_4[3]*$myra1_benchmark_mark_4[3]) > ($myra1_benchmark_mark_4[3]*2) ? $myra1_benchmark_mark_4[3]*2 : ((float)$myra_year_4[3]/$myra1_benchmark_target_4[3]*$myra1_benchmark_mark_4[3])) : 0;
        $myra1_mark_4[4] = $myra1_benchmark_target_4[4] > 0 ? (((float)$myra_year_4[4]/$myra1_benchmark_target_4[4]*$myra1_benchmark_mark_4[4]) > ($myra1_benchmark_mark_4[4]*2) ? $myra1_benchmark_mark_4[4]*2 : ((float)$myra_year_4[4]/$myra1_benchmark_target_4[4]*$myra1_benchmark_mark_4[4])) : 0;
        $myra1_mark_4[5] = $myra1_benchmark_target_4[5] > 0 ? (((float)$myra_year_4[5]/$myra1_benchmark_target_4[5]*$myra1_benchmark_mark_4[5]) > ($myra1_benchmark_mark_4[5]*2) ? $myra1_benchmark_mark_4[5]*2 : ((float)$myra_year_4[5]/$myra1_benchmark_target_4[5]*$myra1_benchmark_mark_4[5])) : 0;

        $myra1_achievement_1[0] = $myra1_benchmark_mark_1[1] > 0 ? $myra1_mark_1[1]/$myra1_benchmark_mark_1[1]*100 : 0*100;
        $myra1_achievement_1[1] = $myra1_benchmark_mark_1[2] > 0 ? $myra1_mark_1[2]/$myra1_benchmark_mark_1[2]*100 : 0*100;
        $myra1_achievement_1[2] = $myra1_benchmark_mark_1[3] > 0 ? $myra1_mark_1[3]/$myra1_benchmark_mark_1[3]*100 : 0*100;
        $myra1_achievement_1[3] = $myra1_benchmark_mark_1[4] > 0 ? $myra1_mark_1[4]/$myra1_benchmark_mark_1[4]*100 : 0*100;
        $myra1_achievement_2[0] = $myra1_benchmark_mark_2[0] > 0 ? $myra1_mark_2[0]/$myra1_benchmark_mark_2[0]*100 : 0*100;
        $myra1_achievement_2[1] = $myra1_benchmark_mark_2[1] > 0 ? $myra1_mark_2[1]/$myra1_benchmark_mark_2[1]*100 : 0*100;
        $myra1_achievement_3[0] = $myra1_benchmark_mark_3[1] > 0 ? $myra1_mark_3[1]/$myra1_benchmark_mark_3[1]*100 : 0*100;
        $myra1_achievement_3[1] = $myra1_benchmark_mark_3[2] > 0 ? $myra1_mark_3[2]/$myra1_benchmark_mark_3[2]*100 : 0*100;
        $myra1_achievement_3[2] = $myra1_benchmark_mark_3[3] > 0 ? $myra1_mark_3[3]/$myra1_benchmark_mark_3[3]*100 : 0*100;
        $myra1_achievement_4[0] = $myra1_benchmark_mark_4[0] > 0 ? $myra1_mark_4[0]/$myra1_benchmark_mark_4[0]*100 : 0*100;
        $myra1_achievement_4[1] = $myra1_benchmark_mark_4[1] > 0 ? $myra1_mark_4[1]/$myra1_benchmark_mark_4[1]*100 : 0*100;
        $myra1_achievement_4[2] = $myra1_benchmark_mark_4[2] > 0 ? $myra1_mark_4[2]/$myra1_benchmark_mark_4[2]*100 : 0*100;
        $myra1_achievement_4[3] = $myra1_benchmark_mark_4[3] > 0 ? $myra1_mark_4[3]/$myra1_benchmark_mark_4[3]*100 : 0*100;
        $myra1_achievement_4[4] = $myra1_benchmark_mark_4[4] > 0 ? $myra1_mark_4[4]/$myra1_benchmark_mark_4[4]*100 : 0*100;
        $myra1_achievement_4[5] = $myra1_benchmark_mark_4[5] > 0 ? $myra1_mark_4[5]/$myra1_benchmark_mark_4[5]*100 : 0*100;

        //myra II

        $myra2_weightage_1 = 30;
        $myra2_weightage_2 = 10;
        $myra2_weightage_3 = 30;
        $myra2_weightage_4 = 30;

        $myra2_subweightage_1[0] = 15;
        $myra2_subweightage_1[1] = 35;
        $myra2_subweightage_1[2] = 20;
        $myra2_subweightage_1[3] = 30;
        $myra2_subweightage_2[0] = 80;
        $myra2_subweightage_2[1] = 20;
        $myra2_subweightage_3[0] = 30;
        $myra2_subweightage_3[1] = 40;
        $myra2_subweightage_3[2] = 30;
        $myra2_subweightage_4[0] = 20;
        $myra2_subweightage_4[1] = 20;
        $myra2_subweightage_4[2] = 30;
        $myra2_subweightage_4[3] = 30;

        $myra2_benchmark_1[1] = 15;
        $myra2_benchmark_1[2] = 25;
        $myra2_benchmark_1[3] = 20;
        $myra2_benchmark_1[4] = 20;
        $myra2_benchmark_1[0] = $myra2_benchmark_1[1]+$myra2_benchmark_1[2]+$myra2_benchmark_1[3]+$myra2_benchmark_1[4];
        $myra2_benchmark_2[0] = 70;
        $myra2_benchmark_2[1] = 25;
        $myra2_benchmark_3[1] = 30;
        $myra2_benchmark_3[2] = 40;
        $myra2_benchmark_3[3] = 30;
        $myra2_benchmark_3[0] = $myra2_benchmark_3[1]+$myra2_benchmark_3[2]+$myra2_benchmark_3[3];

        $myra2_benchmark_target_1[1] = $myra2_benchmark_1[1]/100*$active_acad_staff;
        $myra2_benchmark_target_1[2] = $myra2_benchmark_1[2]/100*$active_acad_staff;
        $myra2_benchmark_target_1[3] = $myra2_benchmark_1[3]/100*$active_acad_staff;
        $myra2_benchmark_target_1[4] = $myra2_benchmark_1[4]/100*$active_acad_staff;
        $myra2_benchmark_target_1[0] = $myra2_benchmark_target_1[1]+$myra2_benchmark_target_1[2]+$myra2_benchmark_target_1[3]+$myra2_benchmark_target_1[4];
        $myra2_benchmark_target_2[0] = $myra2_benchmark_2[0]/100*$active_acad_staff;
        $myra2_benchmark_target_2[1] = $myra2_benchmark_2[1]/100*$active_acad_staff;
        $myra2_benchmark_target_3[1] = $myra2_benchmark_3[1]/100*$active_acad_staff;
        $myra2_benchmark_target_3[2] = $myra2_benchmark_3[2]/100*$active_acad_staff;
        $myra2_benchmark_target_3[3] = $myra2_benchmark_3[3]/100*$active_acad_staff;
        $myra2_benchmark_target_3[0] = $myra2_benchmark_target_3[1]+$myra2_benchmark_target_3[2]+$myra2_benchmark_target_3[3];
        $myra2_benchmark_target_4[0] = 30;
        $myra2_benchmark_target_4[1] = 30;
        $myra2_benchmark_target_4[2] = 30;
        $myra2_benchmark_target_4[3] = 45;

        $myra2_benchmark_mark_1[1] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[0]/100);
        $myra2_benchmark_mark_1[2] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[1]/100);
        $myra2_benchmark_mark_1[3] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[2]/100);
        $myra2_benchmark_mark_1[4] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[3]/100);
        $myra2_benchmark_mark_1[0] = $myra2_benchmark_mark_1[1]+$myra2_benchmark_mark_1[2]+$myra2_benchmark_mark_1[3]+$myra2_benchmark_mark_1[4];
        $myra2_benchmark_mark_2[0] = $myra2_global_weightage*($myra2_weightage_2/100)*($myra2_subweightage_2[0]/100);
        $myra2_benchmark_mark_2[1] = $myra2_global_weightage*($myra2_weightage_2/100)*($myra2_subweightage_2[1]/100);
        $myra2_benchmark_mark_3[1] = $myra2_global_weightage*($myra2_weightage_3/100)*($myra2_subweightage_3[0]/100);
        $myra2_benchmark_mark_3[2] = $myra2_global_weightage*($myra2_weightage_3/100)*($myra2_subweightage_3[1]/100);
        $myra2_benchmark_mark_3[3] = $myra2_global_weightage*($myra2_weightage_3/100)*($myra2_subweightage_3[2]/100);
        $myra2_benchmark_mark_3[0] = $myra2_benchmark_mark_3[1]+$myra2_benchmark_mark_3[2]+$myra2_benchmark_mark_3[3];
        $myra2_benchmark_mark_4[0] = $myra2_global_weightage*($myra2_weightage_4/100)*($myra2_subweightage_4[0]/100);
        $myra2_benchmark_mark_4[1] = $myra2_global_weightage*($myra2_weightage_4/100)*($myra2_subweightage_4[1]/100);
        $myra2_benchmark_mark_4[2] = $myra2_global_weightage*($myra2_weightage_4/100)*($myra2_subweightage_4[2]/100);
        $myra2_benchmark_mark_4[3] = $myra2_global_weightage*($myra2_weightage_4/100)*($myra2_subweightage_4[3]/100);

        $myra2_mark_1[1] = $myra2_benchmark_target_1[1] > 0 ? (((float)$myra_year_1[1]/$myra2_benchmark_target_1[1]*$myra2_benchmark_mark_1[1]) > ($myra2_benchmark_mark_1[1]*2) ? $myra2_benchmark_mark_1[1]*2 : ((float)$myra_year_1[1]/$myra2_benchmark_target_1[1]*$myra2_benchmark_mark_1[1])) : 0;
        $myra2_mark_1[2] = $myra2_benchmark_target_1[2] > 0 ? (((float)$myra_year_1[2]/$myra2_benchmark_target_1[2]*$myra2_benchmark_mark_1[2]) > ($myra2_benchmark_mark_1[2]*2) ? $myra2_benchmark_mark_1[2]*2 : ((float)$myra_year_1[2]/$myra2_benchmark_target_1[2]*$myra2_benchmark_mark_1[2])) : 0;
        $myra2_mark_1[3] = $myra2_benchmark_target_1[3] > 0 ? (((float)$myra_year_1[3]/$myra2_benchmark_target_1[3]*$myra2_benchmark_mark_1[3]) > ($myra2_benchmark_mark_1[3]*2) ? $myra2_benchmark_mark_1[3]*2 : ((float)$myra_year_1[3]/$myra2_benchmark_target_1[3]*$myra2_benchmark_mark_1[3])) : 0;
        $myra2_mark_1[4] = $myra2_benchmark_target_1[4] > 0 ? (((float)$myra_year_1[4]/$myra2_benchmark_target_1[4]*$myra2_benchmark_mark_1[4]) > ($myra2_benchmark_mark_1[4]*2) ? $myra2_benchmark_mark_1[4]*2 : ((float)$myra_year_1[4]/$myra2_benchmark_target_1[4]*$myra2_benchmark_mark_1[4])) : 0;
        $myra2_mark_1[0] = $myra2_mark_1[1]+$myra2_mark_1[2]+$myra2_mark_1[3]+$myra2_mark_1[4];
        $myra2_mark_2[0] = $myra2_benchmark_target_2[0] > 0 ? (((float)$myra_year_2[0]/$myra2_benchmark_target_2[0]*$myra2_benchmark_mark_2[0]) > ($myra2_benchmark_mark_2[0]*2) ? $myra2_benchmark_mark_2[0]*2 : ((float)$myra_year_2[0]/$myra2_benchmark_target_2[0]*$myra2_benchmark_mark_2[0])) : 0;
        $myra2_mark_2[1] = $myra2_benchmark_target_2[1] > 0 ? (((float)$myra_year_2[1]/$myra2_benchmark_target_2[1]*$myra2_benchmark_mark_2[1]) > ($myra2_benchmark_mark_2[1]*2) ? $myra2_benchmark_mark_2[1]*2 : ((float)$myra_year_2[1]/$myra2_benchmark_target_2[1]*$myra2_benchmark_mark_2[1])) : 0;
        $myra2_mark_3[1] = $myra2_benchmark_mark_3[1]-(($myra2_benchmark_mark_3[1]*$v16)/15);
        $myra2_mark_3[2] = $myra2_benchmark_mark_3[2]-(($myra2_benchmark_mark_3[2]*$v17)/15);
        $myra2_mark_3[3] = $myra2_benchmark_mark_3[3]-(($myra2_benchmark_mark_3[3]*$v18)/15);
        $myra2_mark_3[0] = $myra2_mark_3[1]+$myra2_mark_3[2]+$myra2_mark_3[3];
        $myra2_mark_4[0] = $myra2_benchmark_target_4[0] > 0 ? (((float)$myra_year_4[0]/$myra2_benchmark_target_4[0]*$myra2_benchmark_mark_4[0]) > ($myra2_benchmark_mark_4[0]*2) ? $myra2_benchmark_mark_4[0]*2 : ((float)$myra_year_4[0]/$myra2_benchmark_target_4[0]*$myra2_benchmark_mark_4[0])) : 0;
        $myra2_mark_4[1] = $myra2_benchmark_target_4[1] > 0 ? (((float)$myra_year_4[1]/$myra2_benchmark_target_4[1]*$myra2_benchmark_mark_4[1]) > ($myra2_benchmark_mark_4[1]*2) ? $myra2_benchmark_mark_4[1]*2 : ((float)$myra_year_4[1]/$myra2_benchmark_target_4[1]*$myra2_benchmark_mark_4[1])) : 0;
        $myra2_mark_4[2] = $myra2_benchmark_target_4[2] > 0 ? (((float)$myra_year_4[2]/$myra2_benchmark_target_4[2]*$myra2_benchmark_mark_4[2]) > ($myra2_benchmark_mark_4[2]*2) ? $myra2_benchmark_mark_4[2]*2 : ((float)$myra_year_4[2]/$myra2_benchmark_target_4[2]*$myra2_benchmark_mark_4[2])) : 0;
        $myra2_mark_4[3] = $myra2_benchmark_target_4[3] > 0 ? (((float)$myra_year_4[3]/$myra2_benchmark_target_4[3]*$myra2_benchmark_mark_4[3]) > ($myra2_benchmark_mark_4[3]*2) ? $myra2_benchmark_mark_4[3]*2 : ((float)$myra_year_4[3]/$myra2_benchmark_target_4[3]*$myra2_benchmark_mark_4[3])) : 0;

        $myra2_achievement_1[0] = $myra2_benchmark_mark_1[1] > 0 ? $myra2_mark_1[1]/$myra2_benchmark_mark_1[1]*100 : 0*100;
        $myra2_achievement_1[1] = $myra2_benchmark_mark_1[2] > 0 ? $myra2_mark_1[2]/$myra2_benchmark_mark_1[2]*100 : 0*100;
        $myra2_achievement_1[2] = $myra2_benchmark_mark_1[3] > 0 ? $myra2_mark_1[3]/$myra2_benchmark_mark_1[3]*100 : 0*100;
        $myra2_achievement_1[3] = $myra2_benchmark_mark_1[4] > 0 ? $myra2_mark_1[4]/$myra2_benchmark_mark_1[4]*100 : 0*100;
        $myra2_achievement_2[0] = $myra2_benchmark_mark_2[0] > 0 ? $myra2_mark_2[0]/$myra2_benchmark_mark_2[0]*100 : 0*100;
        $myra2_achievement_2[1] = $myra2_benchmark_mark_2[1] > 0 ? $myra2_mark_2[1]/$myra2_benchmark_mark_2[1]*100 : 0*100;
        $myra2_achievement_3[0] = $myra2_benchmark_mark_3[1] > 0 ? $myra2_mark_3[1]/$myra2_benchmark_mark_3[1]*100 : 0*100;
        $myra2_achievement_3[1] = $myra2_benchmark_mark_3[2] > 0 ? $myra2_mark_3[2]/$myra2_benchmark_mark_3[2]*100 : 0*100;
        $myra2_achievement_3[2] = $myra2_benchmark_mark_3[3] > 0 ? $myra2_mark_3[3]/$myra2_benchmark_mark_3[3]*100 : 0*100;
        $myra2_achievement_4[0] = $myra2_benchmark_mark_4[0] > 0 ? $myra2_mark_4[0]/$myra2_benchmark_mark_4[0]*100 : 0*100;
        $myra2_achievement_4[1] = $myra2_benchmark_mark_4[1] > 0 ? $myra2_mark_4[1]/$myra2_benchmark_mark_4[1]*100 : 0*100;
        $myra2_achievement_4[2] = $myra2_benchmark_mark_4[2] > 0 ? $myra2_mark_4[2]/$myra2_benchmark_mark_4[2]*100 : 0*100;
        $myra2_achievement_4[3] = $myra2_benchmark_mark_4[3] > 0 ? $myra2_mark_4[3]/$myra2_benchmark_mark_4[3]*100 : 0*100;

        $total_myra1_weightage = $myra1_weightage_1+$myra1_weightage_2+$myra1_weightage_3+$myra1_weightage_4;
        $total_myra1_benchmark_mark = $myra1_benchmark_mark_1[0]+($myra1_benchmark_mark_2[0]+$myra1_benchmark_mark_2[1])
                            +$myra1_benchmark_mark_3[0]+$myra1_benchmark_mark_4[0]+$myra1_benchmark_mark_4[1]+$myra1_benchmark_mark_4[2]
                            +$myra1_benchmark_mark_4[3]+$myra1_benchmark_mark_4[4]+$myra1_benchmark_mark_4[5];
        $total_myra1_mark = $myra1_mark_1[0]+($myra1_mark_2[0]+$myra1_mark_2[1])
                            +$myra1_mark_3[0]+$myra1_mark_4[0]+$myra1_mark_4[1]+$myra1_mark_4[2]
                            +$myra1_mark_4[3]+$myra1_mark_4[4]+$myra1_mark_4[5];
        $total_myra2_weightage = $myra2_weightage_1+$myra2_weightage_2+$myra2_weightage_3+$myra2_weightage_4;
        $total_myra2_benchmark_mark = $myra2_benchmark_mark_1[0]+($myra2_benchmark_mark_2[0]+$myra2_benchmark_mark_2[1])
                            +$myra2_benchmark_mark_3[0]+$myra2_benchmark_mark_4[0]+$myra2_benchmark_mark_4[1]+$myra2_benchmark_mark_4[2]
                            +$myra2_benchmark_mark_4[3];
        $total_myra2_mark = $myra2_mark_1[0]+($myra2_mark_2[0]+$myra2_mark_2[1])
                            +$myra2_mark_3[0]+$myra2_mark_4[0]+$myra2_mark_4[1]+$myra2_mark_4[2]
                            +$myra2_mark_4[3];
        
        return (object)[
            'active_acad_staff' => $active_acad_staff,
            'active_st' => $active_st,
            'active_nonst' => $active_nonst,
            'myra1_global_weightage' => $myra1_global_weightage,
            'myra2_global_weightage' => $myra2_global_weightage,
            'myra_year_1' => $myra_year_1,
            'myra_year_2' => $myra_year_2,
            'myra_year_3' => $myra_year_3,
            'myra_year_4' => $myra_year_4,
            'u16' => $u16,
            'u17' => $u17,
            'u18' => $u18,
            'v16' => $v16,
            'v17' => $v17,
            'v18' => $v18,
            'myra1_1' => $myra1_1,
            'myra1_2' => $myra1_2,
            'myra1_3' => $myra1_3,
            'myra1_4' => $myra1_4,
            'myra2_1' => $myra2_1,
            'myra2_2' => $myra2_2,
            'myra2_3' => $myra2_3,
            'myra2_4' => $myra2_4,
            'myra1_weightage_1' => $myra1_weightage_1,
            'myra1_weightage_2' => $myra1_weightage_2,
            'myra1_weightage_3' => $myra1_weightage_3,
            'myra1_weightage_4' => $myra1_weightage_4,
            'myra1_subweightage_1' => $myra1_subweightage_1,
            'myra1_subweightage_2' => $myra1_subweightage_2,
            'myra1_subweightage_3' => $myra1_subweightage_3,
            'myra1_subweightage_4' => $myra1_subweightage_4,
            'myra1_benchmark_1' => $myra1_benchmark_1,
            'myra1_benchmark_2' => $myra1_benchmark_2,
            'myra1_benchmark_3' => $myra1_benchmark_3,
            'myra1_benchmark_target_1' => $myra1_benchmark_target_1,
            'myra1_benchmark_target_2' => $myra1_benchmark_target_2,
            'myra1_benchmark_target_3' => $myra1_benchmark_target_3,
            'myra1_benchmark_target_4' => $myra1_benchmark_target_4,
            'myra1_benchmark_mark_1' => $myra1_benchmark_mark_1,
            'myra1_benchmark_mark_2' => $myra1_benchmark_mark_2,
            'myra1_benchmark_mark_3' => $myra1_benchmark_mark_3,
            'myra1_benchmark_mark_4' => $myra1_benchmark_mark_4,
            'myra1_mark_1' => $myra1_mark_1,
            'myra1_mark_2' => $myra1_mark_2,
            'myra1_mark_3' => $myra1_mark_3,
            'myra1_mark_4' => $myra1_mark_4,
            'myra1_achievement_1' => $myra1_achievement_1,
            'myra1_achievement_2' => $myra1_achievement_2,
            'myra1_achievement_3' => $myra1_achievement_3,
            'myra1_achievement_4' => $myra1_achievement_4,
            'myra2_weightage_1' => $myra2_weightage_1,
            'myra2_weightage_2' => $myra2_weightage_2,
            'myra2_weightage_3' => $myra2_weightage_3,
            'myra2_weightage_4' => $myra2_weightage_4,
            'myra2_subweightage_1' => $myra2_subweightage_1,
            'myra2_subweightage_2' => $myra2_subweightage_2,
            'myra2_subweightage_3' => $myra2_subweightage_3,
            'myra2_subweightage_4' => $myra2_subweightage_4,
            'myra2_benchmark_1' => $myra2_benchmark_1,
            'myra2_benchmark_2' => $myra2_benchmark_2,
            'myra2_benchmark_3' => $myra2_benchmark_3,
            'myra2_benchmark_target_1' => $myra2_benchmark_target_1,
            'myra2_benchmark_target_2' => $myra2_benchmark_target_2,
            'myra2_benchmark_target_3' => $myra2_benchmark_target_3,
            'myra2_benchmark_target_4' => $myra2_benchmark_target_4,
            'myra2_benchmark_mark_1' => $myra2_benchmark_mark_1,
            'myra2_benchmark_mark_2' => $myra2_benchmark_mark_2,
            'myra2_benchmark_mark_3' => $myra2_benchmark_mark_3,
            'myra2_benchmark_mark_4' => $myra2_benchmark_mark_4,
            'myra2_mark_1' => $myra2_mark_1,
            'myra2_mark_2' => $myra2_mark_2,
            'myra2_mark_3' => $myra2_mark_3,
            'myra2_mark_4' => $myra2_mark_4,
            'myra2_achievement_1' => $myra2_achievement_1,
            'myra2_achievement_2' => $myra2_achievement_2,
            'myra2_achievement_3' => $myra2_achievement_3,
            'myra2_achievement_4' => $myra2_achievement_4,
            'total_myra1_weightage' => $total_myra1_weightage,
            'total_myra1_benchmark_mark' => $total_myra1_benchmark_mark,
            'total_myra1_mark' => $total_myra1_mark,
            'total_myra2_weightage' => $total_myra2_weightage,
            'total_myra2_benchmark_mark' => $total_myra2_benchmark_mark,
            'total_myra2_mark' => $total_myra2_mark,
        ];
    }

    public function calcSectionC($active_acad_staff, $active_st, $active_nonst, $important_data){
        $myra1_global_weightage = 30;
        $myra2_global_weightage = 35;
        $w19 = 100*0.1;

        $myra1_1[0] = 'YES';
        $myra1_1[1] = 'YES';
        $myra1_1[2] = 'YES';
        $myra1_1[3] = 'YES';
        $myra1_1[4] = 'YES';
        $myra1_1[5] = 'YES';
        $myra1_1[6] = 'NO';
        $myra1_1[7] = 'NO';
        $myra1_1[8] = 'YES';
        $myra1_1[9] = 'YES';
        $myra1_1[10] = 'YES';
        $myra1_1[11] = 'YES';
        $myra1_1[12] = 'YES';
        $myra1_1[13] = 'YES';
        $myra1_1[14] = 'YES';
        $myra1_1[15] = 'YES';
        $myra1_2[0] = 'YES';
        $myra1_2[1] = 'YES';
        $myra1_2[2] = 'YES';
        $myra1_2[3] = 'YES';
        $myra1_2[4] = 'YES';
        $myra1_2[5] = 'YES';
        $myra1_3[0] = 'YES';
        $myra1_3[1] = 'YES';
        $myra1_3[2] = 'YES';

        $myra2_1[0] = 'YES';
        $myra2_1[1] = 'YES';
        $myra2_1[2] = 'YES';
        $myra2_1[3] = 'YES';
        $myra2_1[4] = 'YES';
        $myra2_1[5] = 'YES';
        $myra2_1[6] = 'NO';
        $myra2_1[7] = 'NO';
        $myra2_1[8] = 'YES';
        $myra2_1[9] = 'YES';
        $myra2_1[10] = 'YES';
        $myra2_1[11] = 'YES';
        $myra2_1[12] = 'YES';
        $myra2_1[13] = 'YES';
        $myra2_1[14] = 'YES';
        $myra2_1[15] = 'YES';
        $myra2_2[0] = 'YES';
        $myra2_2[1] = 'YES';
        $myra2_2[2] = 'YES';
        $myra2_2[3] = 'YES';
        $myra2_2[4] = 'YES';
        $myra2_2[5] = 'YES';
        $myra2_3[0] = 'NO';
        $myra2_3[1] = 'NO';
        $myra2_3[2] = 'NO';

        $myra_year_1[0] = $important_data->journal;
        $myra_year_1[1] = $important_data->proceeding;
        $myra_year_1[2] = $important_data->joint_industrial;
        $myra_year_1[3] = $important_data->joint_international;
        $myra_year_1[4] = $important_data->joint_national;
        $myra_year_1[5] = $important_data->citation;
        $myra_year_1[6] = $important_data->q1_q2;
        $myra_year_1[7] = (float)$myra_year_1[0] > 0 ? (float)$myra_year_1[6]/(float)$myra_year_1[0] : 0;
        $myra_year_1[8] = $important_data->mycite;
        $myra_year_1[10] = $important_data->book_indexed;
        $myra_year_1[11] = $important_data->book_not_indexed;
        $myra_year_1[9] = (float)$myra_year_1[10] + (float)$myra_year_1[11];
        $myra_year_1[13] = $important_data->chapter_indexed;
        $myra_year_1[14] = $important_data->chapter_not_indexed;
        $myra_year_1[12] = (float)$myra_year_1[13] + (float)$myra_year_1[14];
        $myra_year_1[15] = $important_data->case_studies;
        $myra_year_1[16] = $important_data->policy_paper;
        $myra_year_1[17] = $important_data->other;
        $myra_year_2[0] = $important_data->home_pledge_new;
        $myra_year_2[1] = $important_data->home_receive_active;
        $myra_year_2[2] = $important_data->private_pledge_new;
        $myra_year_2[3] = $important_data->private_receive_active;
        $myra_year_2[4] = $important_data->international_pledge_new;
        $myra_year_2[5] = $important_data->international_receive_active;
        $myra_year_2[6] = (float)$myra_year_2[1] + (float)$myra_year_2[3] + (float)$myra_year_2[5];
        $myra_year_3[0] = $important_data->project_without_ext;
        $myra_year_3[1] = $important_data->project_with_ext;
        $myra_year_3[2] = ((float)$myra_year_3[0]+(float)$myra_year_3[1]) > 0 ? (float)$myra_year_3[0]/((float)$myra_year_3[0]+(float)$myra_year_3[1]) : 0;

        //myra I
        $myra1_weightage_1 = 55;
        $myra1_weightage_2 = 40;
        $myra1_weightage_3 = 5;

        $myra1_subweightage_1[0] = 70;
        $myra1_subweightage_1[1] = 9;
        $myra1_subweightage_1[2] = 16;
        $myra1_subweightage_1[3] = 3;
        $myra1_subweightage_1[4] = 2;
        $myra1_subweightage_2[0] = 50;
        $myra1_subweightage_2[1] = 20;
        $myra1_subweightage_2[2] = 30;
        $myra1_subweightage_3[0] = 100;

        $myra1_subsubweightage_1[0] = 30;
        $myra1_subsubweightage_1[1] = 5;
        $myra1_subsubweightage_1[2] = 9;
        $myra1_subsubweightage_1[3] = 9;
        $myra1_subsubweightage_1[4] = 7;
        $myra1_subsubweightage_1[5] = 40;
        $myra1_subsubweightage_1[6] = 100;
        $myra1_subsubweightage_1[7] = 35;
        $myra1_subsubweightage_1[8] = 5;
        $myra1_subsubweightage_1[9] = 19;
        $myra1_subsubweightage_1[10] = 8;
        $myra1_subsubweightage_1[11] = 33;
        $myra1_subsubweightage_1[12] = 100;
        $myra1_subsubweightage_1[13] = 100;
        $myra1_subsubweightage_2[0] = 100;
        $myra1_subsubweightage_2[1] = 100;
        $myra1_subsubweightage_2[2] = 100;
        $myra1_subsubweightage_3[0] = 100;

        $myra1_benchmark_1[0] = 2;
        $myra1_benchmark_1[1] = 0.5;
        $myra1_benchmark_1[2] = 0.3;
        $myra1_benchmark_1[3] = 0.3;
        $myra1_benchmark_1[4] = 0.3;
        $myra1_benchmark_1[5] = 10000;
        $myra1_benchmark_1[6] = 0.5;
        $myra1_benchmark_1[7] = 0.1;
        $myra1_benchmark_1[8] = 0.1;
        $myra1_benchmark_1[9] = 0.3;
        $myra1_benchmark_1[10] = 0.3;
        $myra1_benchmark_1[11] = 0.2;
        $myra1_benchmark_1[12] = 0.01;
        $myra1_benchmark_1[13] = 1.0;
        $myra1_benchmark_2[0] = "RM30,000/S&T staff\nRM12,000/NS&T staff";
        $myra1_benchmark_2[1] = "RM10,000/S&T staff\nRM6,000/NS&T staff";
        $myra1_benchmark_2[2] = "RM10,000/S&T staff\nRM12,000/NS&T staff";
        $myra1_benchmark_3[0] = 0.6;

        $myra1_benchmark_target_1[0] = $myra1_benchmark_1[0]*$active_acad_staff;
        $myra1_benchmark_target_1[1] = $myra1_benchmark_1[1]*$active_acad_staff;
        $myra1_benchmark_target_1[2] = $myra1_benchmark_1[2]*$active_acad_staff;
        $myra1_benchmark_target_1[3] = $myra1_benchmark_1[3]*$active_acad_staff;
        $myra1_benchmark_target_1[4] = $myra1_benchmark_1[4]*$active_acad_staff;
        $myra1_benchmark_target_1[5] = $myra1_benchmark_1[5];
        $myra1_benchmark_target_1[6] = $myra1_benchmark_1[6]*$active_acad_staff;
        $myra1_benchmark_target_1[7] = $myra1_benchmark_1[7]*$active_acad_staff;
        $myra1_benchmark_target_1[8] = $myra1_benchmark_1[8]*$active_acad_staff;
        $myra1_benchmark_target_1[9] = $myra1_benchmark_1[9]*$active_acad_staff;
        $myra1_benchmark_target_1[10] = $myra1_benchmark_1[10]*$active_acad_staff;
        $myra1_benchmark_target_1[11] = $myra1_benchmark_1[11]*$active_acad_staff;
        $myra1_benchmark_target_1[12] = $myra1_benchmark_1[12]*$active_acad_staff;
        $myra1_benchmark_target_1[13] = $myra1_benchmark_1[13]*$active_acad_staff;
        $myra1_benchmark_target_2[0] = (30000*$active_st)+(12000*$active_nonst);
        $myra1_benchmark_target_2[1] = (10000*$active_st)+(6000*$active_nonst);
        $myra1_benchmark_target_2[2] = (10000*$active_st)+(12000*$active_nonst);
        $myra1_benchmark_target_3[0] = 0.6;

        $myra1_benchmark_mark_1[0] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[0]/100)*($myra1_subsubweightage_1[0]/100);
        $myra1_benchmark_mark_1[1] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[0]/100)*($myra1_subsubweightage_1[1]/100);
        $myra1_benchmark_mark_1[2] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[0]/100)*($myra1_subsubweightage_1[2]/100);
        $myra1_benchmark_mark_1[3] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[0]/100)*($myra1_subsubweightage_1[3]/100);
        $myra1_benchmark_mark_1[4] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[0]/100)*($myra1_subsubweightage_1[4]/100);
        $myra1_benchmark_mark_1[5] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[0]/100)*($myra1_subsubweightage_1[5]/100);
        $myra1_benchmark_mark_1[6] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[1]/100)*($myra1_subsubweightage_1[6]/100);
        $myra1_benchmark_mark_1[7] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[2]/100)*($myra1_subsubweightage_1[7]/100);
        $myra1_benchmark_mark_1[8] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[2]/100)*($myra1_subsubweightage_1[8]/100);
        $myra1_benchmark_mark_1[9] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[2]/100)*($myra1_subsubweightage_1[9]/100);
        $myra1_benchmark_mark_1[10] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[2]/100)*($myra1_subsubweightage_1[10]/100);
        $myra1_benchmark_mark_1[11] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[2]/100)*($myra1_subsubweightage_1[11]/100);
        $myra1_benchmark_mark_1[12] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[3]/100)*($myra1_subsubweightage_1[12]/100);
        $myra1_benchmark_mark_1[13] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[4]/100)*($myra1_subsubweightage_1[13]/100);
        $myra1_benchmark_mark_2[0] = $myra1_global_weightage*($myra1_weightage_2/100)*($myra1_subweightage_2[0]/100)*($myra1_subsubweightage_2[0]/100);
        $myra1_benchmark_mark_2[1] = $myra1_global_weightage*($myra1_weightage_2/100)*($myra1_subweightage_2[1]/100)*($myra1_subsubweightage_2[1]/100);
        $myra1_benchmark_mark_2[2] = $myra1_global_weightage*($myra1_weightage_2/100)*($myra1_subweightage_2[2]/100)*($myra1_subsubweightage_2[2]/100);
        $myra1_benchmark_mark_3[0] = $myra1_global_weightage*($myra1_weightage_3/100)*($myra1_subweightage_3[0]/100)*($myra1_subsubweightage_3[0]/100);

        $myra1_mark_1[0] = $myra1_benchmark_target_1[0] > 0 ? (((float)$myra_year_1[0]/$myra1_benchmark_target_1[0]*$myra1_benchmark_mark_1[0]) > ($myra1_benchmark_mark_1[0]*2) ? $myra1_benchmark_mark_1[0]*2 : ((float)$myra_year_1[0]/$myra1_benchmark_target_1[0]*$myra1_benchmark_mark_1[0])) : 0;
        $myra1_mark_1[1] = $myra1_benchmark_target_1[1] > 0 ? (((float)$myra_year_1[1]/$myra1_benchmark_target_1[1]*$myra1_benchmark_mark_1[1]) > ($myra1_benchmark_mark_1[1]*2) ? $myra1_benchmark_mark_1[1]*2 : ((float)$myra_year_1[1]/$myra1_benchmark_target_1[1]*$myra1_benchmark_mark_1[1])) : 0;;
        $myra1_mark_1[2] = $myra1_benchmark_target_1[2] > 0 ? (((float)$myra_year_1[2]/$myra1_benchmark_target_1[2]*$myra1_benchmark_mark_1[2]) > ($myra1_benchmark_mark_1[2]*2) ? $myra1_benchmark_mark_1[2]*2 : ((float)$myra_year_1[2]/$myra1_benchmark_target_1[2]*$myra1_benchmark_mark_1[2])) : 0;;
        $myra1_mark_1[3] = $myra1_benchmark_target_1[3] > 0 ? (((float)$myra_year_1[3]/$myra1_benchmark_target_1[3]*$myra1_benchmark_mark_1[3]) > ($myra1_benchmark_mark_1[3]*2) ? $myra1_benchmark_mark_1[3]*2 : ((float)$myra_year_1[3]/$myra1_benchmark_target_1[3]*$myra1_benchmark_mark_1[3])) : 0;;
        $myra1_mark_1[4] = $myra1_benchmark_target_1[4] > 0 ? (((float)$myra_year_1[4]/$myra1_benchmark_target_1[4]*$myra1_benchmark_mark_1[4]) > ($myra1_benchmark_mark_1[4]*2) ? $myra1_benchmark_mark_1[4]*2 : ((float)$myra_year_1[4]/$myra1_benchmark_target_1[4]*$myra1_benchmark_mark_1[4])) : 0;;
        $myra1_mark_1[5] = $myra1_benchmark_target_1[5] > 0 ? (((float)$myra_year_1[5]/$myra1_benchmark_target_1[5]*$myra1_benchmark_mark_1[5]) > ($myra1_benchmark_mark_1[5]*2) ? $myra1_benchmark_mark_1[5]*2 : ((float)$myra_year_1[5]/$myra1_benchmark_target_1[5]*$myra1_benchmark_mark_1[5])) : 0;;
        $myra1_mark_1[6] = $myra1_benchmark_target_1[6] > 0 ? (((float)$myra_year_1[8]/$myra1_benchmark_target_1[6]*$myra1_benchmark_mark_1[6]) > ($myra1_benchmark_mark_1[6]*2) ? $myra1_benchmark_mark_1[6]*2 : ((float)$myra_year_1[8]/$myra1_benchmark_target_1[6]*$myra1_benchmark_mark_1[6])) : 0;;
        $myra1_mark_1[7] = $myra1_benchmark_target_1[7] > 0 ? (((float)$myra_year_1[10]/$myra1_benchmark_target_1[7]*$myra1_benchmark_mark_1[7]) > ($myra1_benchmark_mark_1[7]*2) ? $myra1_benchmark_mark_1[7]*2 : ((float)$myra_year_1[10]/$myra1_benchmark_target_1[7]*$myra1_benchmark_mark_1[7])) : 0;;
        $myra1_mark_1[8] = $myra1_benchmark_target_1[8] > 0 ? (((float)$myra_year_1[11]/$myra1_benchmark_target_1[8]*$myra1_benchmark_mark_1[8]) > ($myra1_benchmark_mark_1[8]*2) ? $myra1_benchmark_mark_1[8]*2 : ((float)$myra_year_1[11]/$myra1_benchmark_target_1[8]*$myra1_benchmark_mark_1[8])) : 0;;
        $myra1_mark_1[9] = $myra1_benchmark_target_1[9] > 0 ? (((float)$myra_year_1[13]/$myra1_benchmark_target_1[9]*$myra1_benchmark_mark_1[9]) > ($myra1_benchmark_mark_1[9]*2) ? $myra1_benchmark_mark_1[9]*2 : ((float)$myra_year_1[13]/$myra1_benchmark_target_1[9]*$myra1_benchmark_mark_1[9])) : 0;;
        $myra1_mark_1[10] = $myra1_benchmark_target_1[10] > 0 ? (((float)$myra_year_1[14]/$myra1_benchmark_target_1[10]*$myra1_benchmark_mark_1[10]) > ($myra1_benchmark_mark_1[10]*2) ? $myra1_benchmark_mark_1[10]*2 : ((float)$myra_year_1[14]/$myra1_benchmark_target_1[10]*$myra1_benchmark_mark_1[10])) : 0;;
        $myra1_mark_1[11] = $myra1_benchmark_target_1[11] > 0 ? (((float)$myra_year_1[15]/$myra1_benchmark_target_1[11]*$myra1_benchmark_mark_1[11]) > ($myra1_benchmark_mark_1[11]*2) ? $myra1_benchmark_mark_1[11]*2 : ((float)$myra_year_1[15]/$myra1_benchmark_target_1[11]*$myra1_benchmark_mark_1[11])) : 0;;
        $myra1_mark_1[12] = $myra1_benchmark_target_1[12] > 0 ? (((float)$myra_year_1[16]/$myra1_benchmark_target_1[12]*$myra1_benchmark_mark_1[12]) > ($myra1_benchmark_mark_1[12]*2) ? $myra1_benchmark_mark_1[12]*2 : ((float)$myra_year_1[16]/$myra1_benchmark_target_1[12]*$myra1_benchmark_mark_1[12])) : 0;;
        $myra1_mark_1[13] = $myra1_benchmark_target_1[13] > 0 ? (((float)$myra_year_1[17]/$myra1_benchmark_target_1[13]*$myra1_benchmark_mark_1[13]) > ($myra1_benchmark_mark_1[13]*2) ? $myra1_benchmark_mark_1[13]*2 : ((float)$myra_year_1[17]/$myra1_benchmark_target_1[13]*$myra1_benchmark_mark_1[13])) : 0;;
        $myra1_mark_2[0] = $myra1_benchmark_target_2[0] > 0 ? (((float)$myra_year_2[0]/$myra1_benchmark_target_2[0]*$myra1_benchmark_mark_2[0]) > ($myra1_benchmark_mark_2[0]*2) ? $myra1_benchmark_mark_2[0]*2 : ((float)$myra_year_2[0]/$myra1_benchmark_target_2[0]*$myra1_benchmark_mark_2[0])) : 0;;
        $myra1_mark_2[1] = $myra1_benchmark_target_2[1] > 0 ? (((float)$myra_year_2[1]/$myra1_benchmark_target_2[1]*$myra1_benchmark_mark_2[1]) > ($myra1_benchmark_mark_2[1]*2) ? $myra1_benchmark_mark_2[1]*2 : ((float)$myra_year_2[1]/$myra1_benchmark_target_2[1]*$myra1_benchmark_mark_2[1])) : 0;;
        $myra1_mark_2[2] = $myra1_benchmark_target_2[2] > 0 ? (((float)$myra_year_2[2]/$myra1_benchmark_target_2[2]*$myra1_benchmark_mark_2[2]) > ($myra1_benchmark_mark_2[2]*2) ? $myra1_benchmark_mark_2[2]*2 : ((float)$myra_year_2[2]/$myra1_benchmark_target_2[2]*$myra1_benchmark_mark_2[2])) : 0;;
        $myra1_mark_3[0] = ($myra1_benchmark_target_3[0]/100) > 0 ? (((float)$myra_year_3[0]/($myra1_benchmark_target_3[0]/100)*$myra1_benchmark_mark_3[0]) > ($myra1_benchmark_mark_3[0]*2) ? $myra1_benchmark_mark_3[0]*2 : ((float)$myra_year_3[0]/($myra1_benchmark_target_3[0]/100)*$myra1_benchmark_mark_3[0])) : 0;;

        $myra1_achievement_1[0] = $myra1_benchmark_mark_1[0] > 0 ? $myra1_mark_1[0]/$myra1_benchmark_mark_1[0] : 0;
        $myra1_achievement_1[1] = $myra1_benchmark_mark_1[1] > 0 ? $myra1_mark_1[1]/$myra1_benchmark_mark_1[1] : 0;
        $myra1_achievement_1[2] = $myra1_benchmark_mark_1[2] > 0 ? $myra1_mark_1[2]/$myra1_benchmark_mark_1[2] : 0;
        $myra1_achievement_1[3] = $myra1_benchmark_mark_1[3] > 0 ? $myra1_mark_1[3]/$myra1_benchmark_mark_1[3] : 0;
        $myra1_achievement_1[4] = $myra1_benchmark_mark_1[4] > 0 ? $myra1_mark_1[4]/$myra1_benchmark_mark_1[4] : 0;
        $myra1_achievement_1[5] = $myra1_benchmark_mark_1[5] > 0 ? $myra1_mark_1[5]/$myra1_benchmark_mark_1[5] : 0;
        $myra1_achievement_1[6] = $myra1_benchmark_mark_1[6] > 0 ? $myra1_mark_1[6]/$myra1_benchmark_mark_1[6] : 0;
        $myra1_achievement_1[7] = $myra1_benchmark_mark_1[7] > 0 ? $myra1_mark_1[7]/$myra1_benchmark_mark_1[7] : 0;
        $myra1_achievement_1[8] = $myra1_benchmark_mark_1[8] > 0 ? $myra1_mark_1[8]/$myra1_benchmark_mark_1[8] : 0;
        $myra1_achievement_1[9] = $myra1_benchmark_mark_1[9] > 0 ? $myra1_mark_1[9]/$myra1_benchmark_mark_1[9] : 0;
        $myra1_achievement_1[10] = $myra1_benchmark_mark_1[10] > 0 ? $myra1_mark_1[10]/$myra1_benchmark_mark_1[10] : 0;
        $myra1_achievement_1[11] = $myra1_benchmark_mark_1[11] > 0 ? $myra1_mark_1[11]/$myra1_benchmark_mark_1[11] : 0;
        $myra1_achievement_1[12] = $myra1_benchmark_mark_1[12] > 0 ? $myra1_mark_1[12]/$myra1_benchmark_mark_1[12] : 0;
        $myra1_achievement_1[13] = $myra1_benchmark_mark_1[13] > 0 ? $myra1_mark_1[13]/$myra1_benchmark_mark_1[13] : 0;
        $myra1_achievement_2[0] = $myra1_benchmark_mark_2[0] > 0 ? $myra1_mark_2[0]/$myra1_benchmark_mark_2[0] : 0;
        $myra1_achievement_2[1] = $myra1_benchmark_mark_2[1] > 0 ? $myra1_mark_2[1]/$myra1_benchmark_mark_2[1] : 0;
        $myra1_achievement_2[2] = $myra1_benchmark_mark_2[2] > 0 ? $myra1_mark_2[2]/$myra1_benchmark_mark_2[2] : 0;
        $myra1_achievement_3[0] = $myra1_benchmark_mark_3[0] > 0 ? $myra1_mark_3[0]/$myra1_benchmark_mark_3[0] : 0;

        //myra II

        $myra2_weightage_1 = 70;
        $myra2_weightage_2 = 30;

        $myra2_subweightage_1[0] = 30;
        $myra2_subweightage_1[1] = 49;
        $myra2_subweightage_1[2] = 6;
        $myra2_subweightage_1[3] = 10;
        $myra2_subweightage_1[4] = 3;
        $myra2_subweightage_1[5] = 2;
        $myra2_subweightage_2[0] = 50;
        $myra2_subweightage_2[1] = 20;
        $myra2_subweightage_2[2] = 30;

        $myra2_subsubweightage_1[0] = 70;
        $myra2_subsubweightage_1[1] = 5;
        $myra2_subsubweightage_1[2] = 10;
        $myra2_subsubweightage_1[3] = 10;
        $myra2_subsubweightage_1[4] = 5;
        $myra2_subsubweightage_1[5] = 50;
        $myra2_subsubweightage_1[6] = 50;
        $myra2_subsubweightage_1[7] = 100;
        $myra2_subsubweightage_1[8] = 43;
        $myra2_subsubweightage_1[9] = 11;
        $myra2_subsubweightage_1[10] = 30;
        $myra2_subsubweightage_1[11] = 8;
        $myra2_subsubweightage_1[12] = 8;
        $myra2_subsubweightage_1[13] = 100;
        $myra2_subsubweightage_1[14] = 100;
        $myra2_subsubweightage_2[0] = 100;
        $myra2_subsubweightage_2[1] = 100;
        $myra2_subsubweightage_2[2] = 100;

        $myra2_benchmark_1[0] = 3;
        $myra2_benchmark_1[1] = 0.5;
        $myra2_benchmark_1[2] = 0.3;
        $myra2_benchmark_1[3] = 0.3;
        $myra2_benchmark_1[4] = 0.3;
        $myra2_benchmark_1[5] = 100000;
        $myra2_benchmark_1[6] = 0.7;
        $myra2_benchmark_1[7] = 0.5;
        $myra2_benchmark_1[8] = 0.1;
        $myra2_benchmark_1[9] = 0.1;
        $myra2_benchmark_1[10] = 0.3;
        $myra2_benchmark_1[11] = 0.3;
        $myra2_benchmark_1[12] = 0.2;
        $myra2_benchmark_1[13] = 0.01;
        $myra2_benchmark_1[14] = 1.0;
        $myra2_benchmark_2[0] = "RM60,000/S&T staff\nRM24,000/NS&T staff";
        $myra2_benchmark_2[1] = "RM20,000/S&T staff\nRM12,000/NS&T staff";
        $myra2_benchmark_2[2] = "RM20,000/S&T staff\nRM24,000/NS&T staff";

        $myra2_benchmark_target_1[0] = $myra2_benchmark_1[0]*$active_acad_staff;
        $myra2_benchmark_target_1[1] = $myra2_benchmark_1[1]*$active_acad_staff;
        $myra2_benchmark_target_1[2] = $myra2_benchmark_1[2]*$active_acad_staff;
        $myra2_benchmark_target_1[3] = $myra2_benchmark_1[3]*$active_acad_staff;
        $myra2_benchmark_target_1[4] = $myra2_benchmark_1[4]*$active_acad_staff;
        $myra2_benchmark_target_1[5] = $myra2_benchmark_1[5];
        $myra2_benchmark_target_1[6] = $myra2_benchmark_1[6]*$active_acad_staff;
        $myra2_benchmark_target_1[7] = $myra2_benchmark_1[7]*$active_acad_staff;
        $myra2_benchmark_target_1[8] = $myra2_benchmark_1[8]*$active_acad_staff;
        $myra2_benchmark_target_1[9] = $myra2_benchmark_1[9]*$active_acad_staff;
        $myra2_benchmark_target_1[10] = $myra2_benchmark_1[10]*$active_acad_staff;
        $myra2_benchmark_target_1[11] = $myra2_benchmark_1[11]*$active_acad_staff;
        $myra2_benchmark_target_1[12] = $myra2_benchmark_1[12]*$active_acad_staff;
        $myra2_benchmark_target_1[13] = $myra2_benchmark_1[13]*$active_acad_staff;
        $myra2_benchmark_target_1[14] = $myra2_benchmark_1[14]*$active_acad_staff;
        $myra2_benchmark_target_2[0] = (60000*$active_st)+(24000*$active_nonst);
        $myra2_benchmark_target_2[1] = (20000*$active_st)+(12000*$active_nonst);
        $myra2_benchmark_target_2[2] = (20000*$active_st)+(24000*$active_nonst);
        // dd($active_st,$myra2_benchmark_target_2);

        $myra2_benchmark_mark_1[0] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[0]/100)*($myra2_subsubweightage_1[0]/100);
        $myra2_benchmark_mark_1[1] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[0]/100)*($myra2_subsubweightage_1[1]/100);
        $myra2_benchmark_mark_1[2] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[0]/100)*($myra2_subsubweightage_1[2]/100);
        $myra2_benchmark_mark_1[3] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[0]/100)*($myra2_subsubweightage_1[3]/100);
        $myra2_benchmark_mark_1[4] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[0]/100)*($myra2_subsubweightage_1[4]/100);
        $myra2_benchmark_mark_1[5] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[1]/100)*($myra2_subsubweightage_1[5]/100);
        $myra2_benchmark_mark_1[6] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[1]/100)*($myra2_subsubweightage_1[6]/100);
        $myra2_benchmark_mark_1[7] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[2]/100)*($myra2_subsubweightage_1[7]/100);
        $myra2_benchmark_mark_1[8] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[3]/100)*($myra2_subsubweightage_1[8]/100);
        $myra2_benchmark_mark_1[9] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[3]/100)*($myra2_subsubweightage_1[9]/100);
        $myra2_benchmark_mark_1[10] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[3]/100)*($myra2_subsubweightage_1[10]/100);
        $myra2_benchmark_mark_1[11] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[3]/100)*($myra2_subsubweightage_1[11]/100);
        $myra2_benchmark_mark_1[12] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[3]/100)*($myra2_subsubweightage_1[12]/100);
        $myra2_benchmark_mark_1[13] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[4]/100)*($myra2_subsubweightage_1[13]/100);
        $myra2_benchmark_mark_1[14] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[5]/100)*($myra2_subsubweightage_1[14]/100);
        $myra2_benchmark_mark_2[0] = $myra2_global_weightage*($myra2_weightage_2/100)*($myra2_subweightage_2[0]/100)*($myra2_subsubweightage_2[0]/100);
        $myra2_benchmark_mark_2[1] = $myra2_global_weightage*($myra2_weightage_2/100)*($myra2_subweightage_2[1]/100)*($myra2_subsubweightage_2[1]/100);
        $myra2_benchmark_mark_2[2] = $myra2_global_weightage*($myra2_weightage_2/100)*($myra2_subweightage_2[2]/100)*($myra2_subsubweightage_2[2]/100);

        $myra2_mark_1[0] = $myra2_benchmark_target_1[0] > 0 ? (((float)$myra_year_1[0]/$myra2_benchmark_target_1[0]*$myra2_benchmark_mark_1[0]) > ($myra2_benchmark_mark_1[0]*2) ? $myra2_benchmark_mark_1[0]*2 : ((float)$myra_year_1[0]/$myra2_benchmark_target_1[0]*$myra2_benchmark_mark_1[0])) : 0;
        $myra2_mark_1[1] = $myra2_benchmark_target_1[1] > 0 ? (((float)$myra_year_1[1]/$myra2_benchmark_target_1[1]*$myra2_benchmark_mark_1[1]) > ($myra2_benchmark_mark_1[1]*2) ? $myra2_benchmark_mark_1[1]*2 : ((float)$myra_year_1[1]/$myra2_benchmark_target_1[1]*$myra2_benchmark_mark_1[1])) : 0;;
        $myra2_mark_1[2] = $myra2_benchmark_target_1[2] > 0 ? (((float)$myra_year_1[2]/$myra2_benchmark_target_1[2]*$myra2_benchmark_mark_1[2]) > ($myra2_benchmark_mark_1[2]*2) ? $myra2_benchmark_mark_1[2]*2 : ((float)$myra_year_1[2]/$myra2_benchmark_target_1[2]*$myra2_benchmark_mark_1[2])) : 0;;
        $myra2_mark_1[3] = $myra2_benchmark_target_1[3] > 0 ? (((float)$myra_year_1[3]/$myra2_benchmark_target_1[3]*$myra2_benchmark_mark_1[3]) > ($myra2_benchmark_mark_1[3]*2) ? $myra2_benchmark_mark_1[3]*2 : ((float)$myra_year_1[3]/$myra2_benchmark_target_1[3]*$myra2_benchmark_mark_1[3])) : 0;;
        $myra2_mark_1[4] = $myra2_benchmark_target_1[4] > 0 ? (((float)$myra_year_1[4]/$myra2_benchmark_target_1[4]*$myra2_benchmark_mark_1[4]) > ($myra2_benchmark_mark_1[4]*2) ? $myra2_benchmark_mark_1[4]*2 : ((float)$myra_year_1[4]/$myra2_benchmark_target_1[4]*$myra2_benchmark_mark_1[4])) : 0;;
        $myra2_mark_1[5] = $myra2_benchmark_target_1[5] > 0 ? (((float)$myra_year_1[5]/$myra2_benchmark_target_1[5]*$myra2_benchmark_mark_1[5]) > ($myra2_benchmark_mark_1[5]*2) ? $myra2_benchmark_mark_1[5]*2 : ((float)$myra_year_1[5]/$myra2_benchmark_target_1[5]*$myra2_benchmark_mark_1[5])) : 0;;
        $myra2_mark_1[6] = $myra2_benchmark_target_1[6] > 0 ? (((float)$myra_year_1[6]/$myra2_benchmark_target_1[6]*$myra2_benchmark_mark_1[6]) > ($myra2_benchmark_mark_1[6]*2) ? $myra2_benchmark_mark_1[6]*2 : ((float)$myra_year_1[6]/$myra2_benchmark_target_1[6]*$myra2_benchmark_mark_1[6])) : 0;;
        $myra2_mark_1[7] = $myra2_benchmark_target_1[7] > 0 ? (((float)$myra_year_1[8]/$myra2_benchmark_target_1[7]*$myra2_benchmark_mark_1[7]) > ($myra2_benchmark_mark_1[7]*2) ? $myra2_benchmark_mark_1[7]*2 : ((float)$myra_year_1[8]/$myra2_benchmark_target_1[7]*$myra2_benchmark_mark_1[7])) : 0;;
        $myra2_mark_1[8] = $myra2_benchmark_target_1[8] > 0 ? (((float)$myra_year_1[10]/$myra2_benchmark_target_1[8]*$myra2_benchmark_mark_1[8]) > ($myra2_benchmark_mark_1[8]*2) ? $myra2_benchmark_mark_1[8]*2 : ((float)$myra_year_1[10]/$myra2_benchmark_target_1[8]*$myra2_benchmark_mark_1[8])) : 0;;
        $myra2_mark_1[9] = $myra2_benchmark_target_1[9] > 0 ? (((float)$myra_year_1[11]/$myra2_benchmark_target_1[9]*$myra2_benchmark_mark_1[9]) > ($myra2_benchmark_mark_1[9]*2) ? $myra2_benchmark_mark_1[9]*2 : ((float)$myra_year_1[11]/$myra2_benchmark_target_1[9]*$myra2_benchmark_mark_1[9])) : 0;;
        $myra2_mark_1[10] = $myra2_benchmark_target_1[10] > 0 ? (((float)$myra_year_1[13]/$myra2_benchmark_target_1[10]*$myra2_benchmark_mark_1[10]) > ($myra2_benchmark_mark_1[10]*2) ? $myra2_benchmark_mark_1[10]*2 : ((float)$myra_year_1[13]/$myra2_benchmark_target_1[10]*$myra2_benchmark_mark_1[10])) : 0;;
        $myra2_mark_1[11] = $myra2_benchmark_target_1[11] > 0 ? (((float)$myra_year_1[14]/$myra2_benchmark_target_1[11]*$myra2_benchmark_mark_1[11]) > ($myra2_benchmark_mark_1[11]*2) ? $myra2_benchmark_mark_1[11]*2 : ((float)$myra_year_1[14]/$myra2_benchmark_target_1[11]*$myra2_benchmark_mark_1[11])) : 0;;
        $myra2_mark_1[12] = $myra2_benchmark_target_1[12] > 0 ? (((float)$myra_year_1[15]/$myra2_benchmark_target_1[12]*$myra2_benchmark_mark_1[12]) > ($myra2_benchmark_mark_1[12]*2) ? $myra2_benchmark_mark_1[12]*2 : ((float)$myra_year_1[15]/$myra2_benchmark_target_1[12]*$myra2_benchmark_mark_1[12])) : 0;;
        $myra2_mark_1[13] = $myra2_benchmark_target_1[13] > 0 ? (((float)$myra_year_1[16]/$myra2_benchmark_target_1[13]*$myra2_benchmark_mark_1[13]) > ($myra2_benchmark_mark_1[13]*2) ? $myra2_benchmark_mark_1[13]*2 : ((float)$myra_year_1[16]/$myra2_benchmark_target_1[13]*$myra2_benchmark_mark_1[13])) : 0;;
        $myra2_mark_1[14] = $myra2_benchmark_target_1[14] > 0 ? (((float)$myra_year_1[17]/$myra2_benchmark_target_1[14]*$myra2_benchmark_mark_1[14]) > ($myra2_benchmark_mark_1[14]*2) ? $myra2_benchmark_mark_1[14]*2 : ((float)$myra_year_1[17]/$myra2_benchmark_target_1[14]*$myra2_benchmark_mark_1[14])) : 0;;
        $myra2_mark_2[0] = $myra2_benchmark_target_2[0] > 0 ? (((float)$myra_year_2[0]/$myra2_benchmark_target_2[0]*$myra2_benchmark_mark_2[0]) > ($myra2_benchmark_mark_2[0]*2) ? $myra2_benchmark_mark_2[0]*2 : ((float)$myra_year_2[0]/$myra2_benchmark_target_2[0]*$myra2_benchmark_mark_2[0])) : 0;;
        $myra2_mark_2[1] = $myra2_benchmark_target_2[1] > 0 ? (((float)$myra_year_2[1]/$myra2_benchmark_target_2[1]*$myra2_benchmark_mark_2[1]) > ($myra2_benchmark_mark_2[1]*2) ? $myra2_benchmark_mark_2[1]*2 : ((float)$myra_year_2[1]/$myra2_benchmark_target_2[1]*$myra2_benchmark_mark_2[1])) : 0;;
        $myra2_mark_2[2] = $myra2_benchmark_target_2[2] > 0 ? (((float)$myra_year_2[2]/$myra2_benchmark_target_2[2]*$myra2_benchmark_mark_2[2]) > ($myra2_benchmark_mark_2[2]*2) ? $myra2_benchmark_mark_2[2]*2 : ((float)$myra_year_2[2]/$myra2_benchmark_target_2[2]*$myra2_benchmark_mark_2[2])) : 0;;

        $myra2_achievement_1[0] = $myra2_benchmark_mark_1[0] > 0 ? $myra2_mark_1[0]/$myra2_benchmark_mark_1[0] : 0;
        $myra2_achievement_1[1] = $myra2_benchmark_mark_1[1] > 0 ? $myra2_mark_1[1]/$myra2_benchmark_mark_1[1] : 0;
        $myra2_achievement_1[2] = $myra2_benchmark_mark_1[2] > 0 ? $myra2_mark_1[2]/$myra2_benchmark_mark_1[2] : 0;
        $myra2_achievement_1[3] = $myra2_benchmark_mark_1[3] > 0 ? $myra2_mark_1[3]/$myra2_benchmark_mark_1[3] : 0;
        $myra2_achievement_1[4] = $myra2_benchmark_mark_1[4] > 0 ? $myra2_mark_1[4]/$myra2_benchmark_mark_1[4] : 0;
        $myra2_achievement_1[5] = $myra2_benchmark_mark_1[5] > 0 ? $myra2_mark_1[5]/$myra2_benchmark_mark_1[5] : 0;
        $myra2_achievement_1[6] = $myra2_benchmark_mark_1[6] > 0 ? $myra2_mark_1[6]/$myra2_benchmark_mark_1[6] : 0;
        $myra2_achievement_1[7] = $myra2_benchmark_mark_1[7] > 0 ? $myra2_mark_1[7]/$myra2_benchmark_mark_1[7] : 0;
        $myra2_achievement_1[8] = $myra2_benchmark_mark_1[8] > 0 ? $myra2_mark_1[8]/$myra2_benchmark_mark_1[8] : 0;
        $myra2_achievement_1[9] = $myra2_benchmark_mark_1[9] > 0 ? $myra2_mark_1[9]/$myra2_benchmark_mark_1[9] : 0;
        $myra2_achievement_1[10] = $myra2_benchmark_mark_1[10] > 0 ? $myra2_mark_1[10]/$myra2_benchmark_mark_1[10] : 0;
        $myra2_achievement_1[11] = $myra2_benchmark_mark_1[11] > 0 ? $myra2_mark_1[11]/$myra2_benchmark_mark_1[11] : 0;
        $myra2_achievement_1[12] = $myra2_benchmark_mark_1[12] > 0 ? $myra2_mark_1[12]/$myra2_benchmark_mark_1[12] : 0;
        $myra2_achievement_1[13] = $myra2_benchmark_mark_1[13] > 0 ? $myra2_mark_1[13]/$myra2_benchmark_mark_1[13] : 0;
        $myra2_achievement_1[14] = $myra2_benchmark_mark_1[14] > 0 ? $myra2_mark_1[14]/$myra2_benchmark_mark_1[14] : 0;
        $myra2_achievement_2[0] = $myra2_benchmark_mark_2[0] > 0 ? $myra2_mark_2[0]/$myra2_benchmark_mark_2[0] : 0;
        $myra2_achievement_2[1] = $myra2_benchmark_mark_2[1] > 0 ? $myra2_mark_2[1]/$myra2_benchmark_mark_2[1] : 0;
        $myra2_achievement_2[2] = $myra2_benchmark_mark_2[2] > 0 ? $myra2_mark_2[2]/$myra2_benchmark_mark_2[2] : 0;

        $total_myra1_benchmark_mark = 0;
        $total_myra1_mark = 0;
        $total_myra2_benchmark_mark = 0;
        $total_myra2_mark = 0;
        foreach ($myra1_benchmark_mark_1 as $key => $benchmark_mark) {
            $total_myra1_benchmark_mark += $benchmark_mark;
        }
        foreach ($myra1_benchmark_mark_2 as $key => $benchmark_mark) {
            $total_myra1_benchmark_mark += $benchmark_mark;
        }
        foreach ($myra1_benchmark_mark_3 as $key => $benchmark_mark) {
            $total_myra1_benchmark_mark += $benchmark_mark;
        }
        foreach ($myra1_mark_1 as $key => $mark) {
            $total_myra1_mark += $mark;
        }
        foreach ($myra1_mark_2 as $key => $mark) {
            $total_myra1_mark += $mark;
        }
        foreach ($myra1_mark_3 as $key => $mark) {
            $total_myra1_mark += $mark;
        }
        foreach ($myra2_benchmark_mark_1 as $key => $benchmark_mark) {
            $total_myra2_benchmark_mark += $benchmark_mark;
        }
        foreach ($myra2_benchmark_mark_2 as $key => $benchmark_mark) {
            $total_myra2_benchmark_mark += $benchmark_mark;
        }
        foreach ($myra2_mark_1 as $key => $mark) {
            $total_myra2_mark += $mark;
        }
        foreach ($myra2_mark_2 as $key => $mark) {
            $total_myra2_mark += $mark;
        }
        
        return (object)[
            'active_acad_staff' => $active_acad_staff,
            'active_st' => $active_st,
            'active_nonst' => $active_nonst,
            'myra1_global_weightage' => $myra1_global_weightage,
            'myra2_global_weightage' => $myra2_global_weightage,
            'myra_year_1' => $myra_year_1,
            'myra_year_2' => $myra_year_2,
            'myra_year_3' => $myra_year_3,
            'w19' => $w19,
            'myra1_1' => $myra1_1,
            'myra1_2' => $myra1_2,
            'myra1_3' => $myra1_3,
            'myra2_1' => $myra2_1,
            'myra2_2' => $myra2_2,
            'myra2_3' => $myra2_3,
            'myra1_weightage_1' => $myra1_weightage_1,
            'myra1_weightage_2' => $myra1_weightage_2,
            'myra1_weightage_3' => $myra1_weightage_3,
            'myra1_subweightage_1' => $myra1_subweightage_1,
            'myra1_subweightage_2' => $myra1_subweightage_2,
            'myra1_subweightage_3' => $myra1_subweightage_3,
            'myra1_subsubweightage_1' => $myra1_subsubweightage_1,
            'myra1_subsubweightage_2' => $myra1_subsubweightage_2,
            'myra1_subsubweightage_3' => $myra1_subsubweightage_3,
            'myra1_benchmark_1' => $myra1_benchmark_1,
            'myra1_benchmark_2' => $myra1_benchmark_2,
            'myra1_benchmark_3' => $myra1_benchmark_3,
            'myra1_benchmark_target_1' => $myra1_benchmark_target_1,
            'myra1_benchmark_target_2' => $myra1_benchmark_target_2,
            'myra1_benchmark_target_3' => $myra1_benchmark_target_3,
            'myra1_benchmark_mark_1' => $myra1_benchmark_mark_1,
            'myra1_benchmark_mark_2' => $myra1_benchmark_mark_2,
            'myra1_benchmark_mark_3' => $myra1_benchmark_mark_3,
            'myra1_mark_1' => $myra1_mark_1,
            'myra1_mark_2' => $myra1_mark_2,
            'myra1_mark_3' => $myra1_mark_3,
            'myra1_achievement_1' => $myra1_achievement_1,
            'myra1_achievement_2' => $myra1_achievement_2,
            'myra1_achievement_3' => $myra1_achievement_3,
            'myra2_weightage_1' => $myra2_weightage_1,
            'myra2_weightage_2' => $myra2_weightage_2,
            'myra2_subweightage_1' => $myra2_subweightage_1,
            'myra2_subweightage_2' => $myra2_subweightage_2,
            'myra2_subsubweightage_1' => $myra2_subsubweightage_1,
            'myra2_subsubweightage_2' => $myra2_subsubweightage_2,
            'myra2_benchmark_1' => $myra2_benchmark_1,
            'myra2_benchmark_2' => $myra2_benchmark_2,
            'myra2_benchmark_target_1' => $myra2_benchmark_target_1,
            'myra2_benchmark_target_2' => $myra2_benchmark_target_2,
            'myra2_benchmark_mark_1' => $myra2_benchmark_mark_1,
            'myra2_benchmark_mark_2' => $myra2_benchmark_mark_2,
            'myra2_mark_1' => $myra2_mark_1,
            'myra2_mark_2' => $myra2_mark_2,
            'myra2_achievement_1' => $myra2_achievement_1,
            'myra2_achievement_2' => $myra2_achievement_2,
            'total_myra1_benchmark_mark' => $total_myra1_benchmark_mark,
            'total_myra1_mark' => $total_myra1_mark,
            'total_myra2_benchmark_mark' => $total_myra2_benchmark_mark,
            'total_myra2_mark' => $total_myra2_mark,
        ];
    }

    public function calcSectionD($active_acad_staff, $active_st, $active_nonst, $important_data){
        $myra1_global_weightage = 15;
        $myra2_global_weightage = 10;

        $myra1_1[0] = 'YES';
        $myra1_1[1] = 'YES';
        $myra1_1[2] = 'YES';
        $myra1_1[3] = 'NO';
        $myra1_1[4] = 'NO';
        $myra1_2[0] = 'YES';
        $myra1_3[0] = 'YES';
        $myra1_3[1] = 'YES';
        $myra1_3[2] = 'YES';
        $myra1_4[0] = 'YES';
        $myra1_4[1] = 'YES';
        $myra1_5[0] = 'YES';
        $myra1_5[1] = 'YES';
        $myra1_6[0] = 'YES';
        $myra1_6[1] = 'YES';
        $myra1_7[0] = 'YES';
        $myra1_7[1] = 'YES';
        $myra1_8[0] = 'YES';
        $myra1_8[1] = 'YES';

        $myra2_1[0] = 'YES';
        $myra2_1[1] = 'YES';
        $myra2_1[2] = 'YES';
        $myra2_1[3] = 'YES';
        $myra2_1[4] = 'YES';
        $myra2_2[0] = 'YES';
        $myra2_3[0] = 'NO';
        $myra2_3[1] = 'NO';
        $myra2_3[2] = 'NO';
        $myra2_4[0] = 'NO';
        $myra2_4[1] = 'NO';
        $myra2_5[0] = 'NO';
        $myra2_5[1] = 'NO';
        $myra2_6[0] = 'NO';
        $myra2_6[1] = 'NO';
        $myra2_7[0] = 'NO';
        $myra2_7[1] = 'NO';
        $myra2_8[0] = 'YES';
        $myra2_8[1] = 'YES';

        $myra_year_1[1] = $important_data->phd_local;
        $myra_year_1[2] = $important_data->phd_foreign;
        $myra_year_1[0] = (float)$myra_year_1[1] + (float)$myra_year_1[2];
        $myra_year_1[3] = $active_acad_staff > 0 ? (float)$myra_year_1[0]/$active_acad_staff  : 0;
        $myra_year_1[4] = $important_data->phd_graduate_7;
        $myra_year_1[5] = (float)$myra_year_1[0] > 0 ? (float)$myra_year_1[4]/(float)$myra_year_1[0]  : 0;;
        $myra_year_2[0] = $important_data->total_master;
        $myra_year_3[0] = $important_data->total_phd_enrolled;
        $myra_year_3[1] = $active_acad_staff > 0 ? (float)$myra_year_3[0]/$active_acad_staff  : 0;
        $myra_year_3[2] = $important_data->total_phd_st_enrolled;
        $myra_year_4[0] = $important_data->pg_enrolled_ratio;
        $myra_year_4[1] = $important_data->pg_enrolled_mixed_mode_ratio;
        $myra_year_5[0] = $important_data->int_pg_enrolled;
        $myra_year_5[1] = $important_data->int_pg_enrolled_percent;
        $myra_year_6[0] = $important_data->entry_enrolled;
        $myra_year_6[1] = $important_data->entry_enrolled_percent;
        $myra_year_7[0] = $important_data->fellowship_enrolled;
        $myra_year_7[1] = $important_data->fellowship_enrolled_percent;
        $myra_year_8[1] = $important_data->local_post_doc;
        $myra_year_8[2] = $important_data->foreign_post_doc;
        $myra_year_8[0] = (float)$myra_year_8[1] + (float)$myra_year_8[2];

        //myra I
        $myra1_weightage_1 = 57;
        $myra1_weightage_2 = 33;
        $myra1_weightage_3 = 10;

        $myra1_subweightage_1[0] = round(5/8.5*100);
        $myra1_subweightage_3[0] = round(1/8.5*100);
        $myra1_subweightage_4[0] = round(1/8.5*100);
        $myra1_subweightage_5[0] = round(1.5/8.5*100);
        $myra1_subweightage_6[0] = 60;
        $myra1_subweightage_7[0] = 40;
        $myra1_subweightage_8[0] = 100;

        $myra1_benchmark_1[0] = 0.056;
        $myra1_benchmark_3[0] = 1.5;
        $myra1_benchmark_4[0] = 3;
        $myra1_benchmark_5[0] = 0.1;
        $myra1_benchmark_6[0] = 0.5;
        $myra1_benchmark_7[0] = 0.1;
        $myra1_benchmark_8[0] = 10;

        $myra1_benchmark_target_1[0] = $myra1_benchmark_1[0]*$active_acad_staff;
        $myra1_benchmark_target_3[0] = $myra1_benchmark_3[0]*$active_acad_staff;
        $myra1_benchmark_target_4[0] = $myra1_benchmark_4[0]*$active_acad_staff;
        $myra1_benchmark_target_5[0] = $myra1_benchmark_5[0]*$important_data->pg_enrolled;
        $myra1_benchmark_target_6[0] = $myra1_benchmark_6[0]*$important_data->pg_enrolled;
        $myra1_benchmark_target_7[0] = $myra1_benchmark_7[0]*$important_data->pg_research;
        $myra1_benchmark_target_8[0] = 10;

        $myra1_benchmark_mark_1[0] = round($myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[0]/100), 1);
        $myra1_benchmark_mark_3[0] = round($myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_3[0]/100), 1);
        $myra1_benchmark_mark_4[0] = round($myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_4[0]/100), 1);
        $myra1_benchmark_mark_5[0] = round($myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_5[0]/100), 1);
        $myra1_benchmark_mark_6[0] = round($myra1_global_weightage*($myra1_weightage_2/100)*($myra1_subweightage_6[0]/100), 1);
        $myra1_benchmark_mark_7[0] = round($myra1_global_weightage*($myra1_weightage_2/100)*($myra1_subweightage_7[0]/100), 1);
        $myra1_benchmark_mark_8[0] = round($myra1_global_weightage*($myra1_weightage_3/100)*($myra1_subweightage_8[0]/100), 1);

        $myra1_mark_1[0] = $myra1_benchmark_1[0] > 0 ? (((float)$myra_year_1[0]/$myra1_benchmark_1[0]*$myra1_benchmark_mark_1[0]) > ($myra1_benchmark_mark_1[0]*2) ? $myra1_benchmark_mark_1[0]*2 : ((float)$myra_year_1[0]/$myra1_benchmark_1[0]*$myra1_benchmark_mark_1[0])) : 0;
        $myra1_mark_3[0] = $myra1_benchmark_3[0] > 0 ? (((float)$myra_year_3[0]/$myra1_benchmark_3[0]*$myra1_benchmark_mark_3[0]) > ($myra1_benchmark_mark_3[0]*2) ? $myra1_benchmark_mark_3[0]*2 : ((float)$myra_year_3[0]/$myra1_benchmark_3[0]*$myra1_benchmark_mark_3[0])) : 0;
        $myra1_mark_4[0] = $myra1_benchmark_4[0] > 0 ? (((float)$myra_year_4[0]/$myra1_benchmark_4[0]*$myra1_benchmark_mark_4[0]) > ($myra1_benchmark_mark_4[0]*2) ? $myra1_benchmark_mark_4[0]*2 : ((float)$myra_year_4[0]/$myra1_benchmark_4[0]*$myra1_benchmark_mark_4[0])) : 0;
        $myra1_mark_5[0] = $myra1_benchmark_5[0] > 0 ? (((float)$myra_year_5[0]/$myra1_benchmark_5[0]*$myra1_benchmark_mark_5[0]) > ($myra1_benchmark_mark_5[0]*2) ? $myra1_benchmark_mark_5[0]*2 : ((float)$myra_year_5[0]/$myra1_benchmark_5[0]*$myra1_benchmark_mark_5[0])) : 0;
        $myra1_mark_6[0] = $myra1_benchmark_6[0] > 0 ? (((float)$myra_year_6[0]/$myra1_benchmark_6[0]*$myra1_benchmark_mark_6[0]) > ($myra1_benchmark_mark_6[0]*2) ? $myra1_benchmark_mark_6[0]*2 : ((float)$myra_year_6[0]/$myra1_benchmark_6[0]*$myra1_benchmark_mark_6[0])) : 0;
        $myra1_mark_7[0] = $myra1_benchmark_7[0] > 0 ? (((float)$myra_year_7[0]/$myra1_benchmark_7[0]*$myra1_benchmark_mark_7[0]) > ($myra1_benchmark_mark_7[0]*2) ? $myra1_benchmark_mark_7[0]*2 : ((float)$myra_year_7[0]/$myra1_benchmark_7[0]*$myra1_benchmark_mark_7[0])) : 0;
        $myra1_mark_8[0] = $myra1_benchmark_8[0] > 0 ? (((float)$myra_year_8[0]/$myra1_benchmark_8[0]*$myra1_benchmark_mark_8[0]) > ($myra1_benchmark_mark_8[0]*2) ? $myra1_benchmark_mark_8[0]*2 : ((float)$myra_year_8[0]/$myra1_benchmark_8[0]*$myra1_benchmark_mark_8[0])) : 0;

        $myra1_achievement_1[0] = $myra1_benchmark_mark_1[0] > 0 ? $myra1_mark_1[0]/$myra1_benchmark_mark_1[0]*100 : 0*100;
        $myra1_achievement_3[0] = $myra1_benchmark_mark_3[0] > 0 ? $myra1_mark_3[0]/$myra1_benchmark_mark_3[0]*100 : 0*100;
        $myra1_achievement_4[0] = $myra1_benchmark_mark_4[0] > 0 ? $myra1_mark_4[0]/$myra1_benchmark_mark_4[0]*100 : 0*100;
        $myra1_achievement_5[0] = $myra1_benchmark_mark_5[0] > 0 ? $myra1_mark_5[0]/$myra1_benchmark_mark_5[0]*100 : 0*100;
        $myra1_achievement_6[0] = $myra1_benchmark_mark_6[0] > 0 ? $myra1_mark_6[0]/$myra1_benchmark_mark_6[0]*100 : 0*100;
        $myra1_achievement_7[0] = $myra1_benchmark_mark_7[0] > 0 ? $myra1_mark_7[0]/$myra1_benchmark_mark_7[0]*100 : 0*100;
        $myra1_achievement_8[0] = $myra1_benchmark_mark_8[0] > 0 ? $myra1_mark_8[0]/$myra1_benchmark_mark_8[0]*100 : 0*100;

        //myra II

        $myra2_weightage_1 = 80;
        $myra2_weightage_2 = 0;
        $myra2_weightage_3 = 20;

        $myra2_subweightage_1[0] = 70;
        $myra2_subweightage_1[1] = 30;
        $myra2_subweightage_8[0] = 100;

        $myra2_benchmark_1[0] = 0.2;
        $myra2_benchmark_1[1] = 25/100;
        $myra2_benchmark_8[0] = 100;

        $myra2_benchmark_target_1[0] = $myra2_benchmark_1[0]*$active_acad_staff;
        $myra2_benchmark_target_1[1] = $myra2_benchmark_1[1]*$myra_year_1[0];
        $myra2_benchmark_target_8[0] = 100;

        $myra2_benchmark_mark_1[0] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[0]/100);
        $myra2_benchmark_mark_1[1] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[1]/100);
        $myra2_benchmark_mark_8[0] = $myra2_global_weightage*($myra2_weightage_3/100)*($myra2_subweightage_8[0]/100);

        $myra2_mark_1[0] = $myra2_benchmark_1[0] > 0 ? (((float)$myra_year_1[0]/$myra2_benchmark_1[0]*$myra2_benchmark_mark_1[0]) > ($myra2_benchmark_mark_1[0]*2) ? $myra2_benchmark_mark_1[0]*2 : ((float)$myra_year_1[0]/$myra2_benchmark_1[0]*$myra2_benchmark_mark_1[0])) : 0;
        $myra2_mark_1[1] = $myra2_benchmark_1[1] > 0 ? (((float)$myra_year_1[1]/$myra2_benchmark_1[1]*$myra2_benchmark_mark_1[1]) > ($myra2_benchmark_mark_1[1]*2) ? $myra2_benchmark_mark_1[1]*2 : ((float)$myra_year_1[1]/$myra2_benchmark_1[1]*$myra2_benchmark_mark_1[1])) : 0;
        $myra2_mark_8[0] = $myra2_benchmark_8[0] > 0 ? (((float)$myra_year_8[0]/$myra2_benchmark_8[0]*$myra2_benchmark_mark_8[0]) > ($myra2_benchmark_mark_8[0]*2) ? $myra2_benchmark_mark_8[0]*2 : ((float)$myra_year_8[0]/$myra2_benchmark_8[0]*$myra2_benchmark_mark_8[0])) : 0;

        $myra2_achievement_1[0] = $myra2_benchmark_mark_1[0] > 0 ? $myra2_mark_1[0]/$myra2_benchmark_mark_1[0]*100 : 0*100;
        $myra2_achievement_1[1] = $myra2_benchmark_mark_1[1] > 0 ? $myra2_mark_1[1]/$myra2_benchmark_mark_1[1]*100 : 0*100;
        $myra2_achievement_8[0] = $myra2_benchmark_mark_8[0] > 0 ? $myra2_mark_8[0]/$myra2_benchmark_mark_8[0]*100 : 0*100;

        $total_myra1_benchmark_mark = $myra1_benchmark_mark_1[0]+$myra1_benchmark_mark_3[0]+$myra1_benchmark_mark_4[0]+$myra1_benchmark_mark_5[0]+$myra1_benchmark_mark_6[0]+$myra1_benchmark_mark_7[0]+$myra1_benchmark_mark_8[0];
        $total_myra1_mark = $myra1_mark_1[0]+$myra1_mark_3[0]+$myra1_mark_4[0]+$myra1_mark_5[0]+$myra1_mark_6[0]+$myra1_mark_7[0]+$myra1_mark_8[0];
        $total_myra2_benchmark_mark = $myra2_benchmark_mark_1[0]+$myra2_benchmark_mark_1[1]+$myra2_benchmark_mark_8[0];
        $total_myra2_mark = $myra2_mark_1[0]+$myra2_mark_1[1]+$myra2_mark_8[0];
        
        
        return (object)[
            'active_acad_staff' => $active_acad_staff,
            'active_st' => $active_st,
            'active_nonst' => $active_nonst,
            'myra1_global_weightage' => $myra1_global_weightage,
            'myra2_global_weightage' => $myra2_global_weightage,
            'myra_year_1' => $myra_year_1,
            'myra_year_2' => $myra_year_2,
            'myra_year_3' => $myra_year_3,
            'myra_year_4' => $myra_year_4,
            'myra_year_5' => $myra_year_5,
            'myra_year_6' => $myra_year_6,
            'myra_year_7' => $myra_year_7,
            'myra_year_8' => $myra_year_8,
            'myra1_1' => $myra1_1,
            'myra1_2' => $myra1_2,
            'myra1_3' => $myra1_3,
            'myra1_4' => $myra1_4,
            'myra1_5' => $myra1_5,
            'myra1_6' => $myra1_6,
            'myra1_7' => $myra1_7,
            'myra1_8' => $myra1_8,
            'myra2_1' => $myra2_1,
            'myra2_2' => $myra2_2,
            'myra2_3' => $myra2_3,
            'myra2_4' => $myra2_4,
            'myra2_5' => $myra2_5,
            'myra2_6' => $myra2_6,
            'myra2_7' => $myra2_7,
            'myra2_8' => $myra2_8,
            'myra1_weightage_1' => $myra1_weightage_1,
            'myra1_weightage_2' => $myra1_weightage_2,
            'myra1_weightage_3' => $myra1_weightage_3,
            'myra1_subweightage_1' => $myra1_subweightage_1,
            'myra1_subweightage_3' => $myra1_subweightage_3,
            'myra1_subweightage_4' => $myra1_subweightage_4,
            'myra1_subweightage_5' => $myra1_subweightage_5,
            'myra1_subweightage_6' => $myra1_subweightage_6,
            'myra1_subweightage_7' => $myra1_subweightage_7,
            'myra1_subweightage_8' => $myra1_subweightage_8,
            'myra1_benchmark_1' => $myra1_benchmark_1,
            'myra1_benchmark_3' => $myra1_benchmark_3,
            'myra1_benchmark_4' => $myra1_benchmark_4,
            'myra1_benchmark_5' => $myra1_benchmark_5,
            'myra1_benchmark_6' => $myra1_benchmark_6,
            'myra1_benchmark_7' => $myra1_benchmark_7,
            'myra1_benchmark_8' => $myra1_benchmark_8,
            'myra1_benchmark_target_1' => $myra1_benchmark_target_1,
            'myra1_benchmark_target_3' => $myra1_benchmark_target_3,
            'myra1_benchmark_target_4' => $myra1_benchmark_target_4,
            'myra1_benchmark_target_5' => $myra1_benchmark_target_5,
            'myra1_benchmark_target_6' => $myra1_benchmark_target_6,
            'myra1_benchmark_target_7' => $myra1_benchmark_target_7,
            'myra1_benchmark_target_8' => $myra1_benchmark_target_8,
            'myra1_benchmark_mark_1' => $myra1_benchmark_mark_1,
            'myra1_benchmark_mark_3' => $myra1_benchmark_mark_3,
            'myra1_benchmark_mark_4' => $myra1_benchmark_mark_4,
            'myra1_benchmark_mark_5' => $myra1_benchmark_mark_5,
            'myra1_benchmark_mark_6' => $myra1_benchmark_mark_6,
            'myra1_benchmark_mark_7' => $myra1_benchmark_mark_7,
            'myra1_benchmark_mark_8' => $myra1_benchmark_mark_8,
            'myra1_mark_1' => $myra1_mark_1,
            'myra1_mark_3' => $myra1_mark_3,
            'myra1_mark_4' => $myra1_mark_4,
            'myra1_mark_5' => $myra1_mark_5,
            'myra1_mark_6' => $myra1_mark_6,
            'myra1_mark_7' => $myra1_mark_7,
            'myra1_mark_8' => $myra1_mark_8,
            'myra1_achievement_1' => $myra1_achievement_1,
            'myra1_achievement_3' => $myra1_achievement_3,
            'myra1_achievement_4' => $myra1_achievement_4,
            'myra1_achievement_5' => $myra1_achievement_5,
            'myra1_achievement_6' => $myra1_achievement_6,
            'myra1_achievement_7' => $myra1_achievement_7,
            'myra1_achievement_8' => $myra1_achievement_8,
            'myra2_weightage_1' => $myra2_weightage_1,
            'myra2_weightage_2' => $myra2_weightage_2,
            'myra2_weightage_3' => $myra2_weightage_3,
            'myra2_subweightage_1' => $myra2_subweightage_1,
            'myra2_subweightage_8' => $myra2_subweightage_8,
            'myra2_benchmark_1' => $myra2_benchmark_1,
            'myra2_benchmark_8' => $myra2_benchmark_8,
            'myra2_benchmark_target_1' => $myra2_benchmark_target_1,
            'myra2_benchmark_target_8' => $myra2_benchmark_target_8,
            'myra2_benchmark_mark_1' => $myra2_benchmark_mark_1,
            'myra2_benchmark_mark_8' => $myra2_benchmark_mark_8,
            'myra2_mark_1' => $myra2_mark_1,
            'myra2_mark_8' => $myra2_mark_8,
            'myra2_achievement_1' => $myra2_achievement_1,
            'myra2_achievement_8' => $myra2_achievement_8,
            'total_myra1_benchmark_mark' => $total_myra1_benchmark_mark,
            'total_myra1_mark' => $total_myra1_mark,
            'total_myra2_benchmark_mark' => $total_myra2_benchmark_mark,
            'total_myra2_mark' => $total_myra2_mark,
        ];
    }

    public function calcSectionE($active_acad_staff, $active_st, $active_nonst, $important_data){
        $myra1_global_weightage = 10;
        $myra2_global_weightage = 15;

        $myra1_1[0] = 'YES';
        $myra1_1[1] = 'YES';
        $myra1_1[2] = 'YES';
        $myra1_1[3] = 'YES';
        $myra1_1[4] = 'YES';
        $myra1_1[5] = 'YES';
        $myra1_2[0] = 'YES';
        $myra1_3[0] = 'YES';
        $myra1_4[0] = 'YES';
        $myra1_5[0] = 'YES';
        $myra1_5[1] = 'YES';

        $myra2_1[0] = 'YES';
        $myra2_1[1] = 'YES';
        $myra2_1[2] = 'YES';
        $myra2_1[3] = 'YES';
        $myra2_1[4] = 'YES';
        $myra2_1[5] = 'YES';
        $myra2_2[0] = 'YES';
        $myra2_3[0] = 'YES';
        $myra2_4[0] = 'YES';
        $myra2_5[0] = 'YES';
        $myra2_5[1] = 'YES';

        $myra_year_1[1] = $important_data->grant_local;
        $myra_year_1[2] = $important_data->grant_foreign;
        $myra_year_1[0] = (float)$myra_year_1[1] + (float)$myra_year_1[2];
        $myra_year_1[4] = $important_data->file_local;
        $myra_year_1[5] = $important_data->file_foreign;
        $myra_year_1[3] = (float)$myra_year_1[4] + (float)$myra_year_1[5];
        $myra_year_1[6] = $myra_year_1[0];
        $myra_year_1[7] = $myra_year_1[3];
        $myra_year_2[0] = $important_data->comm_product;
        $myra_year_3[0] = $important_data->know_how_sold;
        $myra_year_4[0] = $important_data->other_ipr;
        $myra_year_5[0] = $important_data->active_company;
        $myra_year_5[1] = $important_data->new_company;

        //myra I
        $myra1_weightage_1 = 20;
        $myra1_weightage_2 = 10;
        $myra1_weightage_3 = 30;
        $myra1_weightage_4 = 30;
        $myra1_weightage_5 = 10;

        $myra1_subweightage_1[0] = 100;
        $myra1_subweightage_1[1] = 100;
        $myra1_subweightage_2[0] = 100;
        $myra1_subweightage_3[0] = 100;
        $myra1_subweightage_4[0] = 100;

        $myra1_benchmark_1[0] = 0.005;
        $myra1_benchmark_1[1] = 0.02;
        $myra1_benchmark_2[0] = 0.0025;
        $myra1_benchmark_3[0] = 0.005;
        $myra1_benchmark_4[0] = 0.05;

        $myra1_benchmark_target_1[0] = $myra1_benchmark_1[0]*$active_st;
        $myra1_benchmark_target_1[1] = $myra1_benchmark_1[1]*$active_st;
        $myra1_benchmark_target_2[0] = $myra1_benchmark_2[0]*$active_acad_staff;
        $myra1_benchmark_target_3[0] = $myra1_benchmark_3[0]*$active_acad_staff;
        $myra1_benchmark_target_4[0] = $myra1_benchmark_4[0]*$active_acad_staff;

        $myra1_benchmark_mark_1[0] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[0]/100);
        $myra1_benchmark_mark_1[1] = $myra1_global_weightage*($myra1_weightage_2/100)*($myra1_subweightage_1[1]/100);
        $myra1_benchmark_mark_2[0] = $myra1_global_weightage*($myra1_weightage_3/100)*($myra1_subweightage_2[0]/100);
        $myra1_benchmark_mark_3[0] = $myra1_global_weightage*($myra1_weightage_4/100)*($myra1_subweightage_3[0]/100);
        $myra1_benchmark_mark_4[0] = $myra1_global_weightage*($myra1_weightage_5/100)*($myra1_subweightage_4[0]/100);

        $myra1_mark_1[0] = $myra1_benchmark_target_1[0] > 0 ? (((float)$myra_year_1[0]/$myra1_benchmark_target_1[0]*$myra1_benchmark_mark_1[0]) > ($myra1_benchmark_mark_1[0]) ? $myra1_benchmark_mark_1[0] : ((float)$myra_year_1[0]/$myra1_benchmark_target_1[0]*$myra1_benchmark_mark_1[0])) : 0;
        $myra1_mark_1[1] = $myra1_benchmark_target_1[1] > 0 ? (((float)$myra_year_1[1]/$myra1_benchmark_target_1[1]*$myra1_benchmark_mark_1[1]) > ($myra1_benchmark_mark_1[1]) ? $myra1_benchmark_mark_1[1] : ((float)$myra_year_1[1]/$myra1_benchmark_target_1[1]*$myra1_benchmark_mark_1[1])) : 0;
        $myra1_mark_2[0] = $myra1_benchmark_target_2[0] > 0 ? (((float)$myra_year_2[0]/$myra1_benchmark_target_2[0]*$myra1_benchmark_mark_2[0]) > ($myra1_benchmark_mark_2[0]) ? $myra1_benchmark_mark_2[0] : ((float)$myra_year_2[0]/$myra1_benchmark_target_2[0]*$myra1_benchmark_mark_2[0])) : 0;
        $myra1_mark_3[0] = $myra1_benchmark_target_3[0] > 0 ? (((float)$myra_year_3[0]/$myra1_benchmark_target_3[0]*$myra1_benchmark_mark_3[0]) > ($myra1_benchmark_mark_3[0]) ? $myra1_benchmark_mark_3[0] : ((float)$myra_year_3[0]/$myra1_benchmark_target_3[0]*$myra1_benchmark_mark_3[0])) : 0;
        $myra1_mark_4[0] = $myra1_benchmark_target_4[0] > 0 ? (((float)$myra_year_4[0]/$myra1_benchmark_target_4[0]*$myra1_benchmark_mark_4[0]) > ($myra1_benchmark_mark_4[0]) ? $myra1_benchmark_mark_4[0] : ((float)$myra_year_4[0]/$myra1_benchmark_target_4[0]*$myra1_benchmark_mark_4[0])) : 0;

        $myra1_achievement_1[0] = $myra1_benchmark_mark_1[0] > 0 ? $myra1_mark_1[0]/$myra1_benchmark_mark_1[0]*100 : 0*100;
        $myra1_achievement_1[1] = $myra1_benchmark_mark_1[1] > 0 ? $myra1_mark_1[1]/$myra1_benchmark_mark_1[1]*100 : 0*100;
        $myra1_achievement_2[0] = $myra1_benchmark_mark_2[0] > 0 ? $myra1_mark_2[0]/$myra1_benchmark_mark_2[0]*100 : 0*100;
        $myra1_achievement_3[0] = $myra1_benchmark_mark_3[0] > 0 ? $myra1_mark_3[0]/$myra1_benchmark_mark_3[0]*100 : 0*100;
        $myra1_achievement_4[0] = $myra1_benchmark_mark_4[0] > 0 ? $myra1_mark_4[0]/$myra1_benchmark_mark_4[0]*100 : 0*100;

        //myra II

        $myra2_weightage_1 = 20;
        $myra2_weightage_2 = 10;
        $myra2_weightage_3 = 30;
        $myra2_weightage_4 = 30;
        $myra2_weightage_5 = 10;

        $myra2_subweightage_1[0] = 100;
        $myra2_subweightage_1[1] = 100;
        $myra2_subweightage_2[0] = 100;
        $myra2_subweightage_3[0] = 100;
        $myra2_subweightage_4[0] = 100;

        $myra2_benchmark_1[0] = 0.005;
        $myra2_benchmark_1[1] = 0.02;
        $myra2_benchmark_2[0] = 0.0025;
        $myra2_benchmark_3[0] = 0.005;
        $myra2_benchmark_4[0] = 0.05;

        $myra2_benchmark_target_1[0] = $myra2_benchmark_1[0]*$active_st;
        $myra2_benchmark_target_1[1] = $myra2_benchmark_1[1]*$active_st;
        $myra2_benchmark_target_2[0] = $myra2_benchmark_2[0]*$active_acad_staff;
        $myra2_benchmark_target_3[0] = $myra2_benchmark_3[0]*$active_acad_staff;
        $myra2_benchmark_target_4[0] = $myra2_benchmark_4[0]*$active_acad_staff;

        $myra2_benchmark_mark_1[0] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[0]/100);
        $myra2_benchmark_mark_1[1] = $myra2_global_weightage*($myra2_weightage_2/100)*($myra2_subweightage_1[1]/100);
        $myra2_benchmark_mark_2[0] = $myra2_global_weightage*($myra2_weightage_3/100)*($myra2_subweightage_2[0]/100);
        $myra2_benchmark_mark_3[0] = $myra2_global_weightage*($myra2_weightage_4/100)*($myra2_subweightage_3[0]/100);
        $myra2_benchmark_mark_4[0] = $myra2_global_weightage*($myra2_weightage_5/100)*($myra2_subweightage_4[0]/100);

        $myra2_mark_1[0] = $myra2_benchmark_target_1[0] > 0 ? (((float)$myra_year_1[0]/$myra2_benchmark_target_1[0]*$myra2_benchmark_mark_1[0]) > ($myra2_benchmark_mark_1[0]) ? $myra2_benchmark_mark_1[0] : ((float)$myra_year_1[0]/$myra2_benchmark_target_1[0]*$myra2_benchmark_mark_1[0])) : 0;
        $myra2_mark_1[1] = $myra2_benchmark_target_1[1] > 0 ? (((float)$myra_year_1[1]/$myra2_benchmark_target_1[1]*$myra2_benchmark_mark_1[1]) > ($myra2_benchmark_mark_1[1]) ? $myra2_benchmark_mark_1[1] : ((float)$myra_year_1[1]/$myra2_benchmark_target_1[1]*$myra2_benchmark_mark_1[1])) : 0;
        $myra2_mark_2[0] = $myra2_benchmark_target_2[0] > 0 ? (((float)$myra_year_2[0]/$myra2_benchmark_target_2[0]*$myra2_benchmark_mark_2[0]) > ($myra2_benchmark_mark_2[0]) ? $myra2_benchmark_mark_2[0] : ((float)$myra_year_2[0]/$myra2_benchmark_target_2[0]*$myra2_benchmark_mark_2[0])) : 0;
        $myra2_mark_3[0] = $myra2_benchmark_target_3[0] > 0 ? (((float)$myra_year_3[0]/$myra2_benchmark_target_3[0]*$myra2_benchmark_mark_3[0]) > ($myra2_benchmark_mark_3[0]) ? $myra2_benchmark_mark_3[0] : ((float)$myra_year_3[0]/$myra2_benchmark_target_3[0]*$myra2_benchmark_mark_3[0])) : 0;
        $myra2_mark_4[0] = $myra2_benchmark_target_4[0] > 0 ? (((float)$myra_year_4[0]/$myra2_benchmark_target_4[0]*$myra2_benchmark_mark_4[0]) > ($myra2_benchmark_mark_4[0]) ? $myra2_benchmark_mark_4[0] : ((float)$myra_year_4[0]/$myra2_benchmark_target_4[0]*$myra2_benchmark_mark_4[0])) : 0;

        $myra2_achievement_1[0] = $myra2_benchmark_mark_1[0] > 0 ? $myra2_mark_1[0]/$myra2_benchmark_mark_1[0]*100 : 0*100;
        $myra2_achievement_1[1] = $myra2_benchmark_mark_1[1] > 0 ? $myra2_mark_1[1]/$myra2_benchmark_mark_1[1]*100 : 0*100;
        $myra2_achievement_2[0] = $myra2_benchmark_mark_2[0] > 0 ? $myra2_mark_2[0]/$myra2_benchmark_mark_2[0]*100 : 0*100;
        $myra2_achievement_3[0] = $myra2_benchmark_mark_3[0] > 0 ? $myra2_mark_3[0]/$myra2_benchmark_mark_3[0]*100 : 0*100;
        $myra2_achievement_4[0] = $myra2_benchmark_mark_4[0] > 0 ? $myra2_mark_4[0]/$myra2_benchmark_mark_4[0]*100 : 0*100;

        $total_myra1_benchmark_mark = $myra1_benchmark_mark_1[0]+$myra1_benchmark_mark_1[1]+$myra1_benchmark_mark_2[0]+$myra1_benchmark_mark_3[0]+$myra1_benchmark_mark_4[0];
        $total_myra1_mark = $myra1_mark_1[0]+$myra1_mark_1[1]+$myra1_mark_2[0]+$myra1_mark_3[0]+$myra1_mark_4[0];
        $total_myra2_benchmark_mark = $myra2_benchmark_mark_1[0]+$myra2_benchmark_mark_1[1]+$myra2_benchmark_mark_2[0]+$myra2_benchmark_mark_3[0]+$myra2_benchmark_mark_4[0];
        $total_myra2_mark = $myra2_mark_1[0]+$myra2_mark_1[1]+$myra2_mark_2[0]+$myra2_mark_3[0]+$myra2_mark_4[0];
        
        
        return (object)[
            'active_acad_staff' => $active_acad_staff,
            'active_st' => $active_st,
            'active_nonst' => $active_nonst,
            'myra1_global_weightage' => $myra1_global_weightage,
            'myra2_global_weightage' => $myra2_global_weightage,
            'myra_year_1' => $myra_year_1,
            'myra_year_2' => $myra_year_2,
            'myra_year_3' => $myra_year_3,
            'myra_year_4' => $myra_year_4,
            'myra_year_5' => $myra_year_5,
            'myra1_1' => $myra1_1,
            'myra1_2' => $myra1_2,
            'myra1_3' => $myra1_3,
            'myra1_4' => $myra1_4,
            'myra1_5' => $myra1_5,
            'myra2_1' => $myra2_1,
            'myra2_2' => $myra2_2,
            'myra2_3' => $myra2_3,
            'myra2_4' => $myra2_4,
            'myra2_5' => $myra2_5,
            'myra1_weightage_1' => $myra1_weightage_1,
            'myra1_weightage_2' => $myra1_weightage_2,
            'myra1_weightage_3' => $myra1_weightage_3,
            'myra1_weightage_4' => $myra1_weightage_4,
            'myra1_weightage_5' => $myra1_weightage_5,
            'myra1_subweightage_1' => $myra1_subweightage_1,
            'myra1_subweightage_2' => $myra1_subweightage_2,
            'myra1_subweightage_3' => $myra1_subweightage_3,
            'myra1_subweightage_4' => $myra1_subweightage_4,
            'myra1_benchmark_1' => $myra1_benchmark_1,
            'myra1_benchmark_2' => $myra1_benchmark_2,
            'myra1_benchmark_3' => $myra1_benchmark_3,
            'myra1_benchmark_4' => $myra1_benchmark_4,
            'myra1_benchmark_target_1' => $myra1_benchmark_target_1,
            'myra1_benchmark_target_2' => $myra1_benchmark_target_2,
            'myra1_benchmark_target_3' => $myra1_benchmark_target_3,
            'myra1_benchmark_target_4' => $myra1_benchmark_target_4,
            'myra1_benchmark_mark_1' => $myra1_benchmark_mark_1,
            'myra1_benchmark_mark_2' => $myra1_benchmark_mark_2,
            'myra1_benchmark_mark_3' => $myra1_benchmark_mark_3,
            'myra1_benchmark_mark_4' => $myra1_benchmark_mark_4,
            'myra1_mark_1' => $myra1_mark_1,
            'myra1_mark_2' => $myra1_mark_2,
            'myra1_mark_3' => $myra1_mark_3,
            'myra1_mark_4' => $myra1_mark_4,
            'myra1_achievement_1' => $myra1_achievement_1,
            'myra1_achievement_2' => $myra1_achievement_2,
            'myra1_achievement_3' => $myra1_achievement_3,
            'myra1_achievement_4' => $myra1_achievement_4,
            'myra2_weightage_1' => $myra2_weightage_1,
            'myra2_weightage_2' => $myra2_weightage_2,
            'myra2_weightage_3' => $myra2_weightage_3,
            'myra2_weightage_4' => $myra2_weightage_4,
            'myra2_weightage_5' => $myra2_weightage_5,
            'myra2_subweightage_1' => $myra2_subweightage_1,
            'myra2_subweightage_2' => $myra2_subweightage_2,
            'myra2_subweightage_3' => $myra2_subweightage_3,
            'myra2_subweightage_4' => $myra2_subweightage_4,
            'myra2_benchmark_1' => $myra2_benchmark_1,
            'myra2_benchmark_2' => $myra2_benchmark_2,
            'myra2_benchmark_3' => $myra2_benchmark_3,
            'myra2_benchmark_4' => $myra2_benchmark_4,
            'myra2_benchmark_target_1' => $myra2_benchmark_target_1,
            'myra2_benchmark_target_2' => $myra2_benchmark_target_2,
            'myra2_benchmark_target_3' => $myra2_benchmark_target_3,
            'myra2_benchmark_target_4' => $myra2_benchmark_target_4,
            'myra2_benchmark_mark_1' => $myra2_benchmark_mark_1,
            'myra2_benchmark_mark_2' => $myra2_benchmark_mark_2,
            'myra2_benchmark_mark_3' => $myra2_benchmark_mark_3,
            'myra2_benchmark_mark_4' => $myra2_benchmark_mark_4,
            'myra2_mark_1' => $myra2_mark_1,
            'myra2_mark_2' => $myra2_mark_2,
            'myra2_mark_3' => $myra2_mark_3,
            'myra2_mark_4' => $myra2_mark_4,
            'myra2_achievement_1' => $myra2_achievement_1,
            'myra2_achievement_2' => $myra2_achievement_2,
            'myra2_achievement_3' => $myra2_achievement_3,
            'myra2_achievement_4' => $myra2_achievement_4,
            'total_myra1_benchmark_mark' => $total_myra1_benchmark_mark,
            'total_myra1_mark' => $total_myra1_mark,
            'total_myra2_benchmark_mark' => $total_myra2_benchmark_mark,
            'total_myra2_mark' => $total_myra2_mark,
        ];
    }

    public function calcSectionF($active_acad_staff, $active_st, $active_nonst, $important_data){
        $myra1_global_weightage = 7;
        $myra2_global_weightage = 10;

        $myra1_1[0] = 'YES';
        $myra1_1[1] = 'YES';
        $myra1_2[0] = 'YES';
        $myra1_3[0] = 'YES';
        $myra1_3[1] = 'YES';
        $myra1_4[0] = 'YES';
        $myra1_4[1] = 'YES';
        $myra1_4[2] = 'YES';
        $myra1_5[0] = 'YES';
        $myra1_5[1] = 'YES';
        $myra1_6[0] = 'YES';
        $myra1_7[0] = 'YES';
        $myra1_7[1] = 'YES';

        $myra2_1[0] = 'YES';
        $myra2_1[1] = 'YES';
        $myra2_2[0] = 'YES';
        $myra2_3[0] = 'YES';
        $myra2_3[1] = 'YES';
        $myra2_4[0] = 'YES';
        $myra2_4[1] = 'YES';
        $myra2_4[2] = 'YES';
        $myra2_5[0] = 'YES';
        $myra2_5[1] = 'YES';
        $myra2_6[0] = 'YES';
        $myra2_7[0] = 'YES';
        $myra2_7[1] = 'YES';

        $myra_year_1[0] = $important_data->training_course;
        $myra_year_1[1] = $important_data->pg_fee;
        $myra_year_2[0] = $important_data->conference;
        $myra_year_3[0] = $important_data->product_comm;
        $myra_year_3[1] = $important_data->tech_know_how;
        $myra_year_4[0] = $important_data->consultancy;
        $myra_year_4[1] = $important_data->hospital;
        $myra_year_4[2] = $important_data->lab_service;
        $myra_year_5[0] = $important_data->new_endowment;
        $myra_year_5[1] = $important_data->existing_endowment;
        $myra_year_6[0] = $important_data->gift;
        $myra_year_7[0] = $important_data->oe_expenditure;
        $myra_year_7[1] = $important_data->rd_expenditure;

        //myra I
        $myra1_weightage_1 = 30;
        $myra1_weightage_2 = 36;
        $myra1_weightage_3 = 20;
        $myra1_weightage_4 = 7;
        $myra1_weightage_5 = 7;

        $myra1_subweightage_1[0] = 100;
        $myra1_subweightage_4[0] = 40;
        $myra1_subweightage_4[1] = 20;
        $myra1_subweightage_4[2] = 40;
        $myra1_subweightage_5[0] = 100;
        $myra1_subweightage_5[1] = 100;
        $myra1_subweightage_6[0] = 100;
        $myra1_subweightage_7[0] = 100;
        $myra1_subweightage_7[1] = 100;

        $myra1_benchmark_1[0] = 6000000;
        $myra1_benchmark_4[0] = 3000000;
        $myra1_benchmark_4[1] = 2000000;
        $myra1_benchmark_4[2] = 3000000;
        $myra1_benchmark_5[0] = 4000000;
        $myra1_benchmark_6[0] = 2000000;
        $myra1_benchmark_7[0] = 0.02;

        $myra1_benchmark_mark_1[0] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[0]/100);
        $myra1_benchmark_mark_4[0] = $myra1_global_weightage*($myra1_weightage_2/100)*($myra1_subweightage_4[0]/100);
        $myra1_benchmark_mark_4[1] = $myra1_global_weightage*($myra1_weightage_2/100)*($myra1_subweightage_4[1]/100);
        $myra1_benchmark_mark_4[2] = $myra1_global_weightage*($myra1_weightage_2/100)*($myra1_subweightage_4[2]/100);
        $myra1_benchmark_mark_5[0] = $myra1_global_weightage*($myra1_weightage_3/100);
        $myra1_benchmark_mark_6[0] = $myra1_global_weightage*($myra1_weightage_4/100);
        $myra1_benchmark_mark_7[0] = $myra1_global_weightage*($myra1_weightage_5/100);

        $myra1_total_data_1 = (float)$myra_year_1[0]+(float)$myra_year_1[1]+(float)$myra_year_2[0]+(float)$myra_year_3[0]+(float)$myra_year_3[1];
        $myra1_mark_1[0] = $myra1_benchmark_1[0] > 0 ? (((float)$myra1_total_data_1/$myra1_benchmark_1[0]*$myra1_benchmark_mark_1[0]) > ($myra1_benchmark_mark_1[0]) ? $myra1_benchmark_mark_1[0] : ((float)$myra1_total_data_1/$myra1_benchmark_1[0]*$myra1_benchmark_mark_1[0])) : 0;
        $myra1_mark_4[0] = $myra1_benchmark_4[0] > 0 ? (((float)$myra_year_4[0]/$myra1_benchmark_4[0]*$myra1_benchmark_mark_4[0]) > ($myra1_benchmark_mark_4[0]*2) ? $myra1_benchmark_mark_4[0]*2 : ((float)$myra_year_4[0]/$myra1_benchmark_4[0]*$myra1_benchmark_mark_4[0])) : 0;
        $myra1_mark_4[1] = $myra1_benchmark_4[1] > 0 ? (((float)$myra_year_4[1]/$myra1_benchmark_4[1]*$myra1_benchmark_mark_4[1]) > ($myra1_benchmark_mark_4[1]) ? $myra1_benchmark_mark_4[1] : ((float)$myra_year_4[1]/$myra1_benchmark_4[1]*$myra1_benchmark_mark_4[1])) : 0;
        $myra1_mark_4[2] = $myra1_benchmark_4[2] > 0 ? (((float)$myra_year_4[2]/$myra1_benchmark_4[2]*$myra1_benchmark_mark_4[2]) > ($myra1_benchmark_mark_4[2]*2) ? $myra1_benchmark_mark_4[2]*2 : ((float)$myra_year_4[2]/$myra1_benchmark_4[2]*$myra1_benchmark_mark_4[2])) : 0;
        $myra1_mark_5[0] = $myra1_benchmark_5[0] > 0 ? (((float)$myra_year_5[0]/$myra1_benchmark_5[0]*$myra1_benchmark_mark_5[0]) > ($myra1_benchmark_mark_5[0]) ? $myra1_benchmark_mark_5[0] : ((float)$myra_year_5[0]/$myra1_benchmark_5[0]*$myra1_benchmark_mark_5[0])) : 0;
        $myra1_mark_6[0] = $myra1_benchmark_6[0] > 0 ? (((float)$myra_year_6[0]/$myra1_benchmark_6[0]*$myra1_benchmark_mark_6[0]) > ($myra1_benchmark_mark_6[0]) ? $myra1_benchmark_mark_6[0] : ((float)$myra_year_6[0]/$myra1_benchmark_6[0]*$myra1_benchmark_mark_6[0])) : 0;
        $myra1_mark_7[0] = $myra1_benchmark_7[0] > 0 && $myra_year_7[0] > 0 ? ((((float)$myra_year_7[1]/(float)$myra_year_7[0])/$myra1_benchmark_7[0]*$myra1_benchmark_mark_7[0]) > ($myra1_benchmark_mark_7[0]) ? $myra1_benchmark_mark_7[0] : (((float)$myra_year_7[1]/(float)$myra_year_7[0])/$myra1_benchmark_7[0]*$myra1_benchmark_mark_7[0])) : 0;

        $myra1_achievement_1[0] = $myra1_benchmark_mark_1[0] > 0 ? $myra1_mark_1[0]/$myra1_benchmark_mark_1[0]*100 : 0*100;
        $myra1_achievement_4[0] = $myra1_benchmark_mark_4[0] > 0 ? $myra1_mark_4[0]/$myra1_benchmark_mark_4[0]*100 : 0*100;
        $myra1_achievement_4[1] = $myra1_benchmark_mark_4[1] > 0 ? $myra1_mark_4[1]/$myra1_benchmark_mark_4[1]*100 : 0*100;
        $myra1_achievement_4[2] = $myra1_benchmark_mark_4[2] > 0 ? $myra1_mark_4[2]/$myra1_benchmark_mark_4[2]*100 : 0*100;
        $myra1_achievement_5[0] = $myra1_benchmark_mark_5[0] > 0 ? $myra1_mark_5[0]/$myra1_benchmark_mark_5[0]*100 : 0*100;
        $myra1_achievement_6[0] = $myra1_benchmark_mark_6[0] > 0 ? $myra1_mark_6[0]/$myra1_benchmark_mark_6[0]*100 : 0*100;
        $myra1_achievement_7[0] = $myra1_benchmark_mark_7[0] > 0 ? $myra1_mark_7[0]/$myra1_benchmark_mark_7[0]*100 : 0*100;

        //myra II

        $myra2_weightage_1 = 20;
        $myra2_weightage_2 = 5;
        $myra2_weightage_3 = 30;
        $myra2_weightage_4 = 25;
        $myra2_weightage_5 = 10;
        $myra2_weightage_6 = 5;
        $myra2_weightage_7 = 5;

        $myra2_subweightage_1[0] = 100;
        $myra2_subweightage_2[0] = 100;
        $myra2_subweightage_3[0] = 100;
        $myra2_subweightage_4[0] = 40;
        $myra2_subweightage_4[1] = 20;
        $myra2_subweightage_4[2] = 40;
        $myra2_subweightage_5[0] = 100;
        $myra2_subweightage_6[0] = 100;
        $myra2_subweightage_7[0] = 100;

        $myra2_benchmark_1[0] = 35000000;
        $myra2_benchmark_2[0] = 1000000;
        $myra2_benchmark_3[0] = 7000000;
        $myra2_benchmark_4[0] = 6000000;
        $myra2_benchmark_4[1] = 3000000;
        $myra2_benchmark_4[2] = 6000000;
        $myra2_benchmark_5[0] = 10000000;
        $myra2_benchmark_6[0] = 2000000;
        $myra2_benchmark_7[0] = 0.02;

        $myra2_benchmark_mark_1[0] = $myra2_global_weightage*($myra2_weightage_1/100);
        $myra2_benchmark_mark_2[0] = $myra2_global_weightage*($myra2_weightage_2/100);
        $myra2_benchmark_mark_3[0] = $myra2_global_weightage*($myra2_weightage_3/100);
        $myra2_benchmark_mark_4[0] = $myra2_global_weightage*($myra2_weightage_4/100)*($myra2_subweightage_4[0]/100);
        $myra2_benchmark_mark_4[1] = $myra2_global_weightage*($myra2_weightage_4/100)*($myra2_subweightage_4[1]/100);
        $myra2_benchmark_mark_4[2] = $myra2_global_weightage*($myra2_weightage_4/100)*($myra2_subweightage_4[2]/100);
        $myra2_benchmark_mark_5[0] = $myra2_global_weightage*($myra2_weightage_5/100);
        $myra2_benchmark_mark_6[0] = $myra2_global_weightage*($myra2_weightage_6/100);
        $myra2_benchmark_mark_7[0] = $myra2_global_weightage*($myra2_weightage_7/100);

        $myra2_mark_1[0] = $myra2_benchmark_1[0] > 0 ? ((((float)$myra_year_1[0]+(float)$myra_year_1[1])/$myra2_benchmark_1[0]*$myra2_benchmark_mark_1[0]) > ($myra2_benchmark_mark_1[0]*2) ? $myra2_benchmark_mark_1[0]*2 : (((float)$myra_year_1[0]+(float)$myra_year_1[1])/$myra2_benchmark_1[0]*$myra2_benchmark_mark_1[0])) : 0;
        $myra2_mark_2[0] = $myra2_benchmark_2[0] > 0 ? (((float)$myra_year_2[0]/$myra2_benchmark_2[0]*$myra2_benchmark_mark_2[0]) > ($myra2_benchmark_mark_2[0]*2) ? $myra2_benchmark_mark_2[0]*2 : ((float)$myra_year_2[0]/$myra2_benchmark_2[0]*$myra2_benchmark_mark_2[0])) : 0;
        $myra2_mark_3[0] = $myra2_benchmark_3[0] > 0 ? ((((float)$myra_year_3[0]+(float)$myra_year_3[1])/$myra2_benchmark_3[0]*$myra2_benchmark_mark_3[0]) > ($myra2_benchmark_mark_3[0]*2) ? $myra2_benchmark_mark_3[0]*2 : (((float)$myra_year_3[0]+(float)$myra_year_3[1])/$myra2_benchmark_3[0]*$myra2_benchmark_mark_3[0])) : 0;
        $myra2_mark_4[0] = $myra2_benchmark_4[0] > 0 ? (((float)$myra_year_4[0]/$myra2_benchmark_4[0]*$myra2_benchmark_mark_4[0]) > ($myra2_benchmark_mark_4[0]*2) ? $myra2_benchmark_mark_4[0]*2 : ((float)$myra_year_4[0]/$myra2_benchmark_4[0]*$myra2_benchmark_mark_4[0])) : 0;
        $myra2_mark_4[1] = $myra2_benchmark_4[1] > 0 ? (((float)$myra_year_4[1]/$myra2_benchmark_4[1]*$myra2_benchmark_mark_4[1]) > ($myra2_benchmark_mark_4[1]) ? $myra2_benchmark_mark_4[1] : ((float)$myra_year_4[1]/$myra2_benchmark_4[1]*$myra2_benchmark_mark_4[1])) : 0;
        $myra2_mark_4[2] = $myra2_benchmark_4[2] > 0 ? (((float)$myra_year_4[2]/$myra2_benchmark_4[2]*$myra2_benchmark_mark_4[2]) > ($myra2_benchmark_mark_4[2]*2) ? $myra2_benchmark_mark_4[2]*2 : ((float)$myra_year_4[2]/$myra2_benchmark_4[2]*$myra2_benchmark_mark_4[2])) : 0;
        $myra2_mark_5[0] = $myra2_benchmark_5[0] > 0 ? (((float)$myra_year_5[0]/$myra2_benchmark_5[0]*$myra2_benchmark_mark_5[0]) > ($myra2_benchmark_mark_5[0])*2 ? $myra2_benchmark_mark_5[0]*2 : ((float)$myra_year_5[0]/$myra2_benchmark_5[0]*$myra2_benchmark_mark_5[0])) : 0;
        $myra2_mark_6[0] = $myra2_benchmark_6[0] > 0 ? (((float)$myra_year_6[0]/$myra2_benchmark_6[0]*$myra2_benchmark_mark_6[0]) > ($myra2_benchmark_mark_6[0])*2 ? $myra2_benchmark_mark_6[0]*2 : ((float)$myra_year_6[0]/$myra2_benchmark_6[0]*$myra2_benchmark_mark_6[0])) : 0;
        $myra2_mark_7[0] = $myra2_benchmark_7[0] > 0 && $myra_year_7[0] > 0 ? ((((float)$myra_year_7[1]/(float)$myra_year_7[0])/$myra2_benchmark_7[0]*$myra2_benchmark_mark_7[0]) > ($myra2_benchmark_mark_7[0])*2 ? $myra2_benchmark_mark_7[0]*2 : (((float)$myra_year_7[1]/(float)$myra_year_7[0])/$myra2_benchmark_7[0]*$myra2_benchmark_mark_7[0])) : 0;

        $myra2_achievement_1[0] = $myra2_benchmark_mark_1[0] > 0 ? $myra2_mark_1[0]/$myra2_benchmark_mark_1[0]*100 : 0*100;
        $myra2_achievement_2[0] = $myra2_benchmark_mark_2[0] > 0 ? $myra2_mark_2[0]/$myra2_benchmark_mark_2[0]*100 : 0*100;
        $myra2_achievement_3[0] = $myra2_benchmark_mark_3[0] > 0 ? $myra2_mark_3[0]/$myra2_benchmark_mark_3[0]*100 : 0*100;
        $myra2_achievement_4[0] = $myra2_benchmark_mark_4[0] > 0 ? $myra2_mark_4[0]/$myra2_benchmark_mark_4[0]*100 : 0*100;
        $myra2_achievement_4[1] = $myra2_benchmark_mark_4[1] > 0 ? $myra2_mark_4[1]/$myra2_benchmark_mark_4[1]*100 : 0*100;
        $myra2_achievement_4[2] = $myra2_benchmark_mark_4[2] > 0 ? $myra2_mark_4[2]/$myra2_benchmark_mark_4[2]*100 : 0*100;
        $myra2_achievement_5[0] = $myra2_benchmark_mark_5[0] > 0 ? $myra2_mark_5[0]/$myra2_benchmark_mark_5[0]*100 : 0*100;
        $myra2_achievement_6[0] = $myra2_benchmark_mark_6[0] > 0 ? $myra2_mark_6[0]/$myra2_benchmark_mark_6[0]*100 : 0*100;
        $myra2_achievement_7[0] = $myra2_benchmark_mark_7[0] > 0 ? $myra2_mark_7[0]/$myra2_benchmark_mark_7[0]*100 : 0*100;

        $total_myra1_benchmark_mark = $myra1_benchmark_mark_1[0]+$myra1_benchmark_mark_4[0]+$myra1_benchmark_mark_4[1]+$myra1_benchmark_mark_4[2]+$myra1_benchmark_mark_5[0]+$myra1_benchmark_mark_6[0]+$myra1_benchmark_mark_7[0];
        $total_myra1_mark = $myra1_mark_1[0]+$myra1_mark_4[0]+$myra1_mark_4[1]+$myra1_mark_4[2]+$myra1_mark_5[0]+$myra1_mark_6[0]+$myra1_mark_7[0];
        $total_myra2_benchmark_mark = $myra2_benchmark_mark_1[0]+$myra2_benchmark_mark_2[0]+$myra2_benchmark_mark_3[0]+$myra2_benchmark_mark_4[0]+$myra2_benchmark_mark_4[1]+$myra2_benchmark_mark_4[2]+$myra2_benchmark_mark_5[0]+$myra2_benchmark_mark_6[0]+$myra2_benchmark_mark_7[0];
        $total_myra2_mark = $myra2_mark_1[0]+$myra2_mark_2[0]+$myra2_mark_3[0]+$myra2_mark_4[0]+$myra2_mark_4[1]+$myra2_mark_4[2]+$myra2_mark_5[0]+$myra2_mark_6[0]+$myra2_mark_7[0];
        
        
        return (object)[
            'active_acad_staff' => $active_acad_staff,
            'active_st' => $active_st,
            'active_nonst' => $active_nonst,
            'myra1_global_weightage' => $myra1_global_weightage,
            'myra2_global_weightage' => $myra2_global_weightage,
            'myra_year_1' => $myra_year_1,
            'myra_year_2' => $myra_year_2,
            'myra_year_3' => $myra_year_3,
            'myra_year_4' => $myra_year_4,
            'myra_year_5' => $myra_year_5,
            'myra_year_6' => $myra_year_6,
            'myra_year_7' => $myra_year_7,
            'myra1_1' => $myra1_1,
            'myra1_2' => $myra1_2,
            'myra1_3' => $myra1_3,
            'myra1_4' => $myra1_4,
            'myra1_5' => $myra1_5,
            'myra1_6' => $myra1_6,
            'myra1_7' => $myra1_7,
            'myra2_1' => $myra2_1,
            'myra2_2' => $myra2_2,
            'myra2_3' => $myra2_3,
            'myra2_4' => $myra2_4,
            'myra2_5' => $myra2_5,
            'myra2_6' => $myra2_6,
            'myra2_7' => $myra2_7,
            'myra1_weightage_1' => $myra1_weightage_1,
            'myra1_weightage_2' => $myra1_weightage_2,
            'myra1_weightage_3' => $myra1_weightage_3,
            'myra1_weightage_4' => $myra1_weightage_4,
            'myra1_weightage_5' => $myra1_weightage_5,
            'myra1_subweightage_1' => $myra1_subweightage_1,
            'myra1_subweightage_4' => $myra1_subweightage_4,
            'myra1_subweightage_5' => $myra1_subweightage_5,
            'myra1_subweightage_6' => $myra1_subweightage_6,
            'myra1_subweightage_7' => $myra1_subweightage_7,
            'myra1_benchmark_1' => $myra1_benchmark_1,
            'myra1_benchmark_4' => $myra1_benchmark_4,
            'myra1_benchmark_5' => $myra1_benchmark_5,
            'myra1_benchmark_6' => $myra1_benchmark_6,
            'myra1_benchmark_7' => $myra1_benchmark_7,
            'myra1_benchmark_mark_1' => $myra1_benchmark_mark_1,
            'myra1_benchmark_mark_4' => $myra1_benchmark_mark_4,
            'myra1_benchmark_mark_5' => $myra1_benchmark_mark_5,
            'myra1_benchmark_mark_6' => $myra1_benchmark_mark_6,
            'myra1_benchmark_mark_7' => $myra1_benchmark_mark_7,
            'myra1_mark_1' => $myra1_mark_1,
            'myra1_mark_4' => $myra1_mark_4,
            'myra1_mark_5' => $myra1_mark_5,
            'myra1_mark_6' => $myra1_mark_6,
            'myra1_mark_7' => $myra1_mark_7,
            'myra1_achievement_1' => $myra1_achievement_1,
            'myra1_achievement_4' => $myra1_achievement_4,
            'myra1_achievement_5' => $myra1_achievement_5,
            'myra1_achievement_6' => $myra1_achievement_6,
            'myra1_achievement_7' => $myra1_achievement_7,
            'myra2_weightage_1' => $myra2_weightage_1,
            'myra2_weightage_2' => $myra2_weightage_2,
            'myra2_weightage_3' => $myra2_weightage_3,
            'myra2_weightage_4' => $myra2_weightage_4,
            'myra2_weightage_5' => $myra2_weightage_5,
            'myra2_weightage_6' => $myra2_weightage_6,
            'myra2_weightage_7' => $myra2_weightage_7,
            'myra2_subweightage_1' => $myra2_subweightage_1,
            'myra2_subweightage_2' => $myra2_subweightage_2,
            'myra2_subweightage_3' => $myra2_subweightage_3,
            'myra2_subweightage_4' => $myra2_subweightage_4,
            'myra2_subweightage_5' => $myra2_subweightage_5,
            'myra2_subweightage_6' => $myra2_subweightage_6,
            'myra2_subweightage_7' => $myra2_subweightage_7,
            'myra2_benchmark_1' => $myra2_benchmark_1,
            'myra2_benchmark_2' => $myra2_benchmark_2,
            'myra2_benchmark_3' => $myra2_benchmark_3,
            'myra2_benchmark_4' => $myra2_benchmark_4,
            'myra2_benchmark_5' => $myra2_benchmark_5,
            'myra2_benchmark_6' => $myra2_benchmark_6,
            'myra2_benchmark_7' => $myra2_benchmark_7,
            'myra2_benchmark_mark_1' => $myra2_benchmark_mark_1,
            'myra2_benchmark_mark_2' => $myra2_benchmark_mark_2,
            'myra2_benchmark_mark_3' => $myra2_benchmark_mark_3,
            'myra2_benchmark_mark_4' => $myra2_benchmark_mark_4,
            'myra2_benchmark_mark_5' => $myra2_benchmark_mark_5,
            'myra2_benchmark_mark_6' => $myra2_benchmark_mark_6,
            'myra2_benchmark_mark_7' => $myra2_benchmark_mark_7,
            'myra2_mark_1' => $myra2_mark_1,
            'myra2_mark_2' => $myra2_mark_2,
            'myra2_mark_3' => $myra2_mark_3,
            'myra2_mark_4' => $myra2_mark_4,
            'myra2_mark_5' => $myra2_mark_5,
            'myra2_mark_6' => $myra2_mark_6,
            'myra2_mark_7' => $myra2_mark_7,
            'myra2_achievement_1' => $myra2_achievement_1,
            'myra2_achievement_2' => $myra2_achievement_2,
            'myra2_achievement_3' => $myra2_achievement_3,
            'myra2_achievement_4' => $myra2_achievement_4,
            'myra2_achievement_5' => $myra2_achievement_5,
            'myra2_achievement_6' => $myra2_achievement_6,
            'myra2_achievement_7' => $myra2_achievement_7,
            'total_myra1_benchmark_mark' => $total_myra1_benchmark_mark,
            'total_myra1_mark' => $total_myra1_mark,
            'total_myra2_benchmark_mark' => $total_myra2_benchmark_mark,
            'total_myra2_mark' => $total_myra2_mark,
        ];
    }

    public function calcSectionG($active_acad_staff, $active_st, $active_nonst, $important_data){
        $myra1_global_weightage = 13;
        $myra2_global_weightage = 14;

        $myra1_1[0] = 'YES';
        $myra1_1[1] = 'YES';
        $myra1_1[2] = 'YES';
        $myra1_1[3] = 'YES';
        $myra1_1[4] = 'YES';
        $myra1_1[5] = 'YES';
        $myra1_2[0] = 'YES';
        $myra1_3[0] = 'YES';
        $myra1_3[1] = 'YES';
        $myra1_4[0] = 'YES';
        $myra1_4[1] = 'YES';
        $myra1_4[2] = 'YES';
        $myra1_4[3] = 'YES';
        $myra1_4[4] = 'YES';
        $myra1_4[5] = 'YES';
        $myra1_5[0] = 'YES';
        $myra1_5[1] = 'YES';
        $myra1_6[0] = 'YES';
        $myra1_6[1] = 'YES';
        $myra1_7[0] = 'YES';
        $myra1_8[0] = 'NO';

        $myra2_1[0] = 'YES';
        $myra2_1[1] = 'YES';
        $myra2_1[2] = 'YES';
        $myra2_1[3] = 'YES';
        $myra2_1[4] = 'YES';
        $myra2_1[5] = 'YES';
        $myra2_2[0] = 'NO';
        $myra2_3[0] = 'NO';
        $myra2_3[1] = 'YES';
        $myra2_4[0] = 'YES';
        $myra2_4[1] = 'YES';
        $myra2_4[2] = 'YES';
        $myra2_4[3] = 'YES';
        $myra2_4[4] = 'YES';
        $myra2_4[5] = 'YES';
        $myra2_5[0] = 'NO';
        $myra2_5[1] = 'YES';
        $myra2_6[0] = 'YES';
        $myra2_6[1] = 'YES';
        $myra2_7[0] = 'NO';
        $myra2_8[0] = 'YES';

        $myra_year_1[1] = $important_data->int_moa_industry;
        $myra_year_1[2] = $important_data->int_moa_community;
        $myra_year_1[3] = $important_data->int_moa_university;
        $myra_year_1[4] = $important_data->int_moa_agency;
        $myra_year_1[0] = (float)$myra_year_1[1]+(float)$myra_year_1[2]+(float)$myra_year_1[3]+(float)$myra_year_1[4];
        $myra_year_1[5] = $myra_year_1[0] > 0 ? $important_data->total_staff_nat_moa/$myra_year_1[0]*100 : 0;
        $myra_year_2[0] = $important_data->staff_sent_abroad;
        $myra_year_3[0] = $important_data->member_international;
        $myra_year_3[1] = $important_data->other_international;
        $myra_year_4[1] = $important_data->nat_moa_industry;
        $myra_year_4[2] = $important_data->nat_moa_community;
        $myra_year_4[3] = $important_data->nat_moa_university;
        $myra_year_4[4] = $important_data->nat_moa_agency;
        $myra_year_4[0] = (float)$myra_year_4[1]+(float)$myra_year_4[2]+(float)$myra_year_4[3]+(float)$myra_year_4[4];
        $myra_year_4[5] = $myra_year_4[0] > 0 ? $important_data->total_staff_int_moa/$myra_year_4[0]*100 : 0;
        $myra_year_5[0] = $important_data->member_national;
        $myra_year_5[1] = $important_data->other_national;
        $myra_year_6[0] = $important_data->new_ktp;
        $myra_year_6[1] = $important_data->benefited_ktp;
        $myra_year_7[0] = $important_data->joint_research_project;
        $myra_year_8[0] = $important_data->joint_research_project_ru;

        //myra I
        $myra1_weightage_1 = 25;
        $myra1_weightage_2 = 35;
        $myra1_weightage_3 = 30;
        $myra1_weightage_4 = 10;

        $myra1_subweightage_1[0] = 25;
        $myra1_subweightage_1[1] = 15;
        $myra1_subweightage_2[0] = 15;
        $myra1_subweightage_3[0] = 15;
        $myra1_subweightage_3[1] = 30;
        $myra1_subweightage_4[0] = 30;
        $myra1_subweightage_4[1] = 15;
        $myra1_subweightage_5[0] = 15;
        $myra1_subweightage_5[1] = 40;
        $myra1_subweightage_6[0] = 40;
        $myra1_subweightage_6[1] = 60;
        $myra1_subweightage_7[0] = 100;

        $myra1_benchmark_1[0] = 5;
        $myra1_benchmark_1[1] = 2; //%
        $myra1_benchmark_2[0] = 5; //%
        $myra1_benchmark_3[0] = 30; //%
        $myra1_benchmark_3[1] = 0.5; //%
        $myra1_benchmark_4[0] = 20;
        $myra1_benchmark_4[1] = 8; //%
        $myra1_benchmark_5[0] = 30; //%
        $myra1_benchmark_5[1] = 2; //%
        $myra1_benchmark_6[0] = 15;
        $myra1_benchmark_6[1] = 60;
        $myra1_benchmark_7[0] = 5;

        $myra1_benchmark_target_1[0] = $myra1_benchmark_1[0];
        $myra1_benchmark_target_1[1] = $myra1_benchmark_1[1]/100*$active_acad_staff; //%
        $myra1_benchmark_target_2[0] = $myra1_benchmark_2[0]/100*$active_acad_staff; //%
        $myra1_benchmark_target_3[0] = $myra1_benchmark_3[0]/100*$active_acad_staff; //%
        $myra1_benchmark_target_3[1] = $myra1_benchmark_3[1]/100*$active_acad_staff; //%
        $myra1_benchmark_target_4[0] = $myra1_benchmark_4[0];
        $myra1_benchmark_target_4[1] = $myra1_benchmark_4[1]/100*$active_acad_staff; //%
        $myra1_benchmark_target_5[0] = $myra1_benchmark_5[0]/100*$active_acad_staff; //%
        $myra1_benchmark_target_5[1] = $myra1_benchmark_5[1]/100*$active_acad_staff; //%
        $myra1_benchmark_target_6[0] = $myra1_benchmark_6[0];
        $myra1_benchmark_target_6[1] = $myra1_benchmark_6[1];
        $myra1_benchmark_target_7[0] = $myra1_benchmark_7[0];

        $myra1_benchmark_mark_1[0] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[0]/100);
        $myra1_benchmark_mark_1[1] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_1[1]/100);
        $myra1_benchmark_mark_2[0] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_2[0]/100);
        $myra1_benchmark_mark_3[0] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_3[0]/100);
        $myra1_benchmark_mark_3[1] = $myra1_global_weightage*($myra1_weightage_1/100)*($myra1_subweightage_3[1]/100);
        $myra1_benchmark_mark_4[0] = $myra1_global_weightage*($myra1_weightage_2/100)*($myra1_subweightage_4[0]/100);
        $myra1_benchmark_mark_4[1] = $myra1_global_weightage*($myra1_weightage_2/100)*($myra1_subweightage_4[1]/100);
        $myra1_benchmark_mark_5[0] = $myra1_global_weightage*($myra1_weightage_2/100)*($myra1_subweightage_5[0]/100);
        $myra1_benchmark_mark_5[1] = $myra1_global_weightage*($myra1_weightage_2/100)*($myra1_subweightage_5[1]/100);
        $myra1_benchmark_mark_6[0] = $myra1_global_weightage*($myra1_weightage_3/100)*($myra1_subweightage_6[0]/100);
        $myra1_benchmark_mark_6[1] = $myra1_global_weightage*($myra1_weightage_3/100)*($myra1_subweightage_6[1]/100);
        $myra1_benchmark_mark_7[0] = $myra1_global_weightage*($myra1_weightage_4/100)*($myra1_subweightage_7[0]/100);

        $myra1_mark_1[0] = $myra1_benchmark_target_1[0] > 0 ? (((float)$myra_year_1[0]/$myra1_benchmark_target_1[0]*$myra1_benchmark_mark_1[0]) > ($myra1_benchmark_mark_1[0]) ? $myra1_benchmark_mark_1[0] : ((float)$myra_year_1[0]/$myra1_benchmark_target_1[0]*$myra1_benchmark_mark_1[0])) : 0;
        $myra1_mark_1[1] = $myra1_benchmark_target_1[1] > 0 ? ((((float)$myra_year_1[1]/100)/$myra1_benchmark_target_1[1]*$myra1_benchmark_mark_1[1]) > ($myra1_benchmark_mark_1[1]) ? $myra1_benchmark_mark_1[1] : (((float)$myra_year_1[1]/100)/$myra1_benchmark_target_1[1]*$myra1_benchmark_mark_1[1])) : 0;
        $myra1_mark_2[0] = $myra1_benchmark_target_2[0] > 0 ? (((float)$myra_year_2[0]/$myra1_benchmark_target_2[0]*$myra1_benchmark_mark_2[0]) > ($myra1_benchmark_mark_2[0]) ? $myra1_benchmark_mark_2[0] : ((float)$myra_year_2[0]/$myra1_benchmark_target_2[0]*$myra1_benchmark_mark_2[0])) : 0;
        $myra1_mark_3[0] = $myra1_benchmark_target_3[0] > 0 ? (((float)$myra_year_3[0]/$myra1_benchmark_target_3[0]*$myra1_benchmark_mark_3[0]) > ($myra1_benchmark_mark_3[0]) ? $myra1_benchmark_mark_3[0] : ((float)$myra_year_3[0]/$myra1_benchmark_target_3[0]*$myra1_benchmark_mark_3[0])) : 0;
        $myra1_mark_3[1] = $myra1_benchmark_target_3[1] > 0 ? (((float)$myra_year_3[1]/$myra1_benchmark_target_3[1]*$myra1_benchmark_mark_3[1]) > ($myra1_benchmark_mark_3[1]) ? $myra1_benchmark_mark_3[1] : ((float)$myra_year_3[1]/$myra1_benchmark_target_3[1]*$myra1_benchmark_mark_3[1])) : 0;
        $myra1_mark_4[0] = $myra1_benchmark_target_4[0] > 0 ? (((float)$myra_year_4[0]/$myra1_benchmark_target_4[0]*$myra1_benchmark_mark_4[0]) > ($myra1_benchmark_mark_4[0]) ? $myra1_benchmark_mark_4[0] : ((float)$myra_year_4[0]/$myra1_benchmark_target_4[0]*$myra1_benchmark_mark_4[0])) : 0;
        $myra1_mark_4[1] = $myra1_benchmark_target_4[1] > 0 ? ((((float)$myra_year_4[1]/100)/$myra1_benchmark_target_4[1]*$myra1_benchmark_mark_4[1]) > ($myra1_benchmark_mark_4[1]) ? $myra1_benchmark_mark_4[1] : (((float)$myra_year_4[1]/100)/$myra1_benchmark_target_4[1]*$myra1_benchmark_mark_4[1])) : 0;
        $myra1_mark_5[0] = $myra1_benchmark_target_5[0] > 0 ? (((float)$myra_year_5[0]/$myra1_benchmark_target_5[0]*$myra1_benchmark_mark_5[0]) > ($myra1_benchmark_mark_5[0]) ? $myra1_benchmark_mark_5[0] : ((float)$myra_year_5[0]/$myra1_benchmark_target_5[0]*$myra1_benchmark_mark_5[0])) : 0;
        $myra1_mark_5[1] = $myra1_benchmark_target_5[1] > 0 ? (((float)$myra_year_5[1]/$myra1_benchmark_target_5[1]*$myra1_benchmark_mark_5[1]) > ($myra1_benchmark_mark_5[1]) ? $myra1_benchmark_mark_5[1] : ((float)$myra_year_5[1]/$myra1_benchmark_target_5[1]*$myra1_benchmark_mark_5[1])) : 0;
        $myra1_mark_6[0] = $myra1_benchmark_target_6[0] > 0 ? (((float)$myra_year_6[0]/$myra1_benchmark_target_6[0]*$myra1_benchmark_mark_6[0]) > ($myra1_benchmark_mark_6[0]) ? $myra1_benchmark_mark_6[0] : ((float)$myra_year_6[0]/$myra1_benchmark_target_6[0]*$myra1_benchmark_mark_6[0])) : 0;
        $myra1_mark_6[1] = $myra1_benchmark_target_6[1] > 0 ? (((float)$myra_year_6[1]/$myra1_benchmark_target_6[1]*$myra1_benchmark_mark_6[1]) > ($myra1_benchmark_mark_6[1]) ? $myra1_benchmark_mark_6[1] : ((float)$myra_year_6[1]/$myra1_benchmark_target_6[1]*$myra1_benchmark_mark_6[1])) : 0;
        $myra1_mark_7[0] = $myra1_benchmark_target_7[0] > 0 ? (((float)$myra_year_7[0]/$myra1_benchmark_target_7[0]*$myra1_benchmark_mark_7[0]) > ($myra1_benchmark_mark_7[0]) ? $myra1_benchmark_mark_7[0] : ((float)$myra_year_7[0]/$myra1_benchmark_target_7[0]*$myra1_benchmark_mark_7[0])) : 0;

        $myra1_achievement_1[0] = $myra1_benchmark_mark_1[0] > 0 ? $myra1_mark_1[0]/$myra1_benchmark_mark_1[0]*100 : 0*100;
        $myra1_achievement_1[1] = $myra1_benchmark_mark_1[1] > 0 ? $myra1_mark_1[1]/$myra1_benchmark_mark_1[1]*100 : 0*100;
        $myra1_achievement_2[0] = $myra1_benchmark_mark_2[0] > 0 ? $myra1_mark_2[0]/$myra1_benchmark_mark_2[0]*100 : 0*100;
        $myra1_achievement_3[0] = $myra1_benchmark_mark_3[0] > 0 ? $myra1_mark_3[0]/$myra1_benchmark_mark_3[0]*100 : 0*100;
        $myra1_achievement_3[1] = $myra1_benchmark_mark_3[1] > 0 ? $myra1_mark_3[1]/$myra1_benchmark_mark_3[1]*100 : 0*100;
        $myra1_achievement_4[0] = $myra1_benchmark_mark_4[0] > 0 ? $myra1_mark_4[0]/$myra1_benchmark_mark_4[0]*100 : 0*100;
        $myra1_achievement_4[1] = $myra1_benchmark_mark_4[1] > 0 ? $myra1_mark_4[1]/$myra1_benchmark_mark_4[1]*100 : 0*100;
        $myra1_achievement_5[0] = $myra1_benchmark_mark_5[0] > 0 ? $myra1_mark_5[0]/$myra1_benchmark_mark_5[0]*100 : 0*100;
        $myra1_achievement_5[1] = $myra1_benchmark_mark_5[1] > 0 ? $myra1_mark_5[1]/$myra1_benchmark_mark_5[1]*100 : 0*100;
        $myra1_achievement_6[0] = $myra1_benchmark_mark_6[0] > 0 ? $myra1_mark_6[0]/$myra1_benchmark_mark_6[0]*100 : 0*100;
        $myra1_achievement_6[1] = $myra1_benchmark_mark_6[1] > 0 ? $myra1_mark_6[1]/$myra1_benchmark_mark_6[1]*100 : 0*100;
        $myra1_achievement_7[0] = $myra1_benchmark_mark_7[0] > 0 ? $myra1_mark_7[0]/$myra1_benchmark_mark_7[0]*100 : 0*100;

        //myra II

        $myra2_weightage_1 = 40;
        $myra2_weightage_2 = 25;
        $myra2_weightage_3 = 20;
        $myra2_weightage_4 = 15;

        $myra2_subweightage_1[0] = 30;
        $myra2_subweightage_1[1] = 20;
        $myra2_subweightage_3[0] = 50;
        $myra2_subweightage_4[0] = 30;
        $myra2_subweightage_4[1] = 20;
        $myra2_subweightage_5[0] = 50;
        $myra2_subweightage_6[0] = 40;
        $myra2_subweightage_6[1] = 60;
        $myra2_subweightage_8[0] = 100;

        $myra2_benchmark_1[0] = 10;
        $myra2_benchmark_1[1] = 10; //%
        $myra2_benchmark_3[0] = 1; //%
        $myra2_benchmark_4[0] = 40;
        $myra2_benchmark_4[1] = 15; //%
        $myra2_benchmark_5[0] = 3; //%
        $myra2_benchmark_6[0] = 15;
        $myra2_benchmark_6[1] = 60;
        $myra2_benchmark_8[0] = 5;

        $myra2_benchmark_target_1[0] = $myra2_benchmark_1[0];
        $myra2_benchmark_target_1[1] = $myra2_benchmark_1[1]/100*$active_acad_staff; //%
        $myra2_benchmark_target_3[0] = $myra2_benchmark_3[0]/100*$active_acad_staff; //%
        $myra2_benchmark_target_4[0] = $myra2_benchmark_4[0];
        $myra2_benchmark_target_4[1] = $myra2_benchmark_4[1]/100*$active_acad_staff; //%
        $myra2_benchmark_target_5[0] = $myra2_benchmark_5[0]/100*$active_acad_staff; //%
        $myra2_benchmark_target_6[0] = $myra2_benchmark_6[0];
        $myra2_benchmark_target_6[1] = $myra2_benchmark_6[1];
        $myra2_benchmark_target_8[0] = $myra2_benchmark_8[0];

        $myra2_benchmark_mark_1[0] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[0]/100);
        $myra2_benchmark_mark_1[1] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_1[1]/100);
        $myra2_benchmark_mark_3[0] = $myra2_global_weightage*($myra2_weightage_1/100)*($myra2_subweightage_3[0]/100);
        $myra2_benchmark_mark_4[0] = $myra2_global_weightage*($myra2_weightage_2/100)*($myra2_subweightage_4[0]/100);
        $myra2_benchmark_mark_4[1] = $myra2_global_weightage*($myra2_weightage_2/100)*($myra2_subweightage_4[1]/100);
        $myra2_benchmark_mark_5[0] = $myra2_global_weightage*($myra2_weightage_2/100)*($myra2_subweightage_5[0]/100);
        $myra2_benchmark_mark_6[0] = $myra2_global_weightage*($myra2_weightage_3/100)*($myra2_subweightage_6[0]/100);
        $myra2_benchmark_mark_6[1] = $myra2_global_weightage*($myra2_weightage_3/100)*($myra2_subweightage_6[1]/100);
        $myra2_benchmark_mark_8[0] = $myra2_global_weightage*($myra2_weightage_4/100)*($myra2_subweightage_8[0]/100);

        $myra2_mark_1[0] = $myra2_benchmark_target_1[0] > 0 ? (((float)$myra_year_1[0]/$myra2_benchmark_target_1[0]*$myra2_benchmark_mark_1[0]) > ($myra2_benchmark_mark_1[0]) ? $myra2_benchmark_mark_1[0] : ((float)$myra_year_1[0]/$myra2_benchmark_target_1[0]*$myra2_benchmark_mark_1[0])) : 0;
        $myra2_mark_1[1] = $myra2_benchmark_target_1[1] > 0 ? ((((float)$myra_year_1[1]/100)/$myra2_benchmark_target_1[1]*$myra2_benchmark_mark_1[1]) > ($myra2_benchmark_mark_1[1]) ? $myra2_benchmark_mark_1[1] : (((float)$myra_year_1[1]/100)/$myra2_benchmark_target_1[1]*$myra2_benchmark_mark_1[1])) : 0;
        $myra2_mark_3[0] = $myra2_benchmark_target_3[0] > 0 ? (((float)$myra_year_3[1]/$myra2_benchmark_target_3[0]*$myra2_benchmark_mark_3[0]) > ($myra2_benchmark_mark_3[0]) ? $myra2_benchmark_mark_3[0] : ((float)$myra_year_3[1]/$myra2_benchmark_target_3[0]*$myra2_benchmark_mark_3[0])) : 0;
        $myra2_mark_4[0] = $myra2_benchmark_target_4[0] > 0 ? (((float)$myra_year_4[0]/$myra2_benchmark_target_4[0]*$myra2_benchmark_mark_4[0]) > ($myra2_benchmark_mark_4[0]) ? $myra2_benchmark_mark_4[0] : ((float)$myra_year_4[0]/$myra2_benchmark_target_4[0]*$myra2_benchmark_mark_4[0])) : 0;
        $myra2_mark_4[1] = $myra2_benchmark_target_4[1] > 0 ? ((((float)$myra_year_4[1]/100)/$myra2_benchmark_target_4[1]*$myra2_benchmark_mark_4[1]) > ($myra2_benchmark_mark_4[1]) ? $myra2_benchmark_mark_4[1] : (((float)$myra_year_4[1]/100)/$myra2_benchmark_target_4[1]*$myra2_benchmark_mark_4[1])) : 0;
        $myra2_mark_5[0] = $myra2_benchmark_target_5[0] > 0 ? (((float)$myra_year_5[1]/$myra2_benchmark_target_5[0]*$myra2_benchmark_mark_5[0]) > ($myra2_benchmark_mark_5[0]) ? $myra2_benchmark_mark_5[0] : ((float)$myra_year_5[1]/$myra2_benchmark_target_5[0]*$myra2_benchmark_mark_5[0])) : 0;
        $myra2_mark_6[0] = $myra2_benchmark_target_6[0] > 0 ? (((float)$myra_year_6[0]/$myra2_benchmark_target_6[0]*$myra2_benchmark_mark_6[0]) > ($myra2_benchmark_mark_6[0]) ? $myra2_benchmark_mark_6[0] : ((float)$myra_year_6[0]/$myra2_benchmark_target_6[0]*$myra2_benchmark_mark_6[0])) : 0;
        $myra2_mark_6[1] = $myra2_benchmark_target_6[1] > 0 ? (((float)$myra_year_6[1]/$myra2_benchmark_target_6[1]*$myra2_benchmark_mark_6[1]) > ($myra2_benchmark_mark_6[1]) ? $myra2_benchmark_mark_6[1] : ((float)$myra_year_6[1]/$myra2_benchmark_target_6[1]*$myra2_benchmark_mark_6[1])) : 0;
        $myra2_mark_8[0] = $myra2_benchmark_target_8[0] > 0 ? (((float)$myra_year_8[0]/$myra2_benchmark_target_8[0]*$myra2_benchmark_mark_8[0]) > ($myra2_benchmark_mark_8[0]) ? $myra2_benchmark_mark_8[0] : ((float)$myra_year_8[0]/$myra2_benchmark_target_8[0]*$myra2_benchmark_mark_8[0])) : 0;

        $myra2_achievement_1[0] = $myra2_benchmark_mark_1[0] > 0 ? $myra2_mark_1[0]/$myra2_benchmark_mark_1[0]*100 : 0*100;
        $myra2_achievement_1[1] = $myra2_benchmark_mark_1[1] > 0 ? $myra2_mark_1[1]/$myra2_benchmark_mark_1[1]*100 : 0*100;
        $myra2_achievement_3[0] = $myra2_benchmark_mark_3[0] > 0 ? $myra2_mark_3[0]/$myra2_benchmark_mark_3[0]*100 : 0*100;
        $myra2_achievement_4[0] = $myra2_benchmark_mark_4[0] > 0 ? $myra2_mark_4[0]/$myra2_benchmark_mark_4[0]*100 : 0*100;
        $myra2_achievement_4[1] = $myra2_benchmark_mark_4[1] > 0 ? $myra2_mark_4[1]/$myra2_benchmark_mark_4[1]*100 : 0*100;
        $myra2_achievement_5[0] = $myra2_benchmark_mark_5[0] > 0 ? $myra2_mark_5[0]/$myra2_benchmark_mark_5[0]*100 : 0*100;
        $myra2_achievement_6[0] = $myra2_benchmark_mark_6[0] > 0 ? $myra2_mark_6[0]/$myra2_benchmark_mark_6[0]*100 : 0*100;
        $myra2_achievement_6[1] = $myra2_benchmark_mark_6[1] > 0 ? $myra2_mark_6[1]/$myra2_benchmark_mark_6[1]*100 : 0*100;
        $myra2_achievement_8[0] = $myra2_benchmark_mark_8[0] > 0 ? $myra2_mark_8[0]/$myra2_benchmark_mark_8[0]*100 : 0*100;

        $total_myra1_benchmark_mark = $myra1_benchmark_mark_1[0]+$myra1_benchmark_mark_1[1]+$myra1_benchmark_mark_2[0]+$myra1_benchmark_mark_3[0]
                                    +$myra1_benchmark_mark_3[1]+$myra1_benchmark_mark_4[0]+$myra1_benchmark_mark_4[1]+$myra1_benchmark_mark_5[0]
                                    +$myra1_benchmark_mark_5[1]+$myra1_benchmark_mark_6[0]+$myra1_benchmark_mark_6[1]+$myra1_benchmark_mark_7[0];
        $total_myra1_mark = $myra1_mark_1[0]+$myra1_mark_1[1]+$myra1_mark_2[0]+$myra1_mark_3[0]
                            +$myra1_mark_3[1]+$myra1_mark_4[0]+$myra1_mark_4[1]+$myra1_mark_5[0]
                            +$myra1_mark_5[1]+$myra1_mark_6[0]+$myra1_mark_6[1]+$myra1_mark_7[0];
        $total_myra2_benchmark_mark = $myra2_benchmark_mark_1[0]+$myra2_benchmark_mark_1[1]+$myra2_benchmark_mark_3[0]
                            +$myra2_benchmark_mark_4[0]+$myra2_benchmark_mark_4[1]+$myra2_benchmark_mark_5[0]
                            +$myra2_benchmark_mark_6[0]+$myra2_benchmark_mark_6[1]+$myra2_benchmark_mark_8[0];
        $total_myra2_mark = $myra2_mark_1[0]+$myra2_mark_1[1]+$myra2_mark_3[0]+$myra2_mark_4[0]+$myra2_mark_4[1]+$myra2_mark_5[0]
                            +$myra2_mark_6[0]+$myra2_mark_6[1]+$myra2_mark_8[0];
        
        
        return (object)[
            'active_acad_staff' => $active_acad_staff,
            'active_st' => $active_st,
            'active_nonst' => $active_nonst,
            'myra1_global_weightage' => $myra1_global_weightage,
            'myra2_global_weightage' => $myra2_global_weightage,
            'myra_year_1' => $myra_year_1,
            'myra_year_2' => $myra_year_2,
            'myra_year_3' => $myra_year_3,
            'myra_year_4' => $myra_year_4,
            'myra_year_5' => $myra_year_5,
            'myra_year_6' => $myra_year_6,
            'myra_year_7' => $myra_year_7,
            'myra_year_8' => $myra_year_8,
            'myra1_1' => $myra1_1,
            'myra1_2' => $myra1_2,
            'myra1_3' => $myra1_3,
            'myra1_4' => $myra1_4,
            'myra1_5' => $myra1_5,
            'myra1_6' => $myra1_6,
            'myra1_7' => $myra1_7,
            'myra1_8' => $myra1_8,
            'myra2_1' => $myra2_1,
            'myra2_2' => $myra2_2,
            'myra2_3' => $myra2_3,
            'myra2_4' => $myra2_4,
            'myra2_5' => $myra2_5,
            'myra2_6' => $myra2_6,
            'myra2_7' => $myra2_7,
            'myra2_8' => $myra2_8,
            'myra1_weightage_1' => $myra1_weightage_1,
            'myra1_weightage_2' => $myra1_weightage_2,
            'myra1_weightage_3' => $myra1_weightage_3,
            'myra1_weightage_4' => $myra1_weightage_4,
            'myra1_subweightage_1' => $myra1_subweightage_1,
            'myra1_subweightage_2' => $myra1_subweightage_2,
            'myra1_subweightage_3' => $myra1_subweightage_3,
            'myra1_subweightage_4' => $myra1_subweightage_4,
            'myra1_subweightage_5' => $myra1_subweightage_5,
            'myra1_subweightage_6' => $myra1_subweightage_6,
            'myra1_subweightage_7' => $myra1_subweightage_7,
            'myra1_benchmark_1' => $myra1_benchmark_1,
            'myra1_benchmark_2' => $myra1_benchmark_2,
            'myra1_benchmark_3' => $myra1_benchmark_3,
            'myra1_benchmark_4' => $myra1_benchmark_4,
            'myra1_benchmark_5' => $myra1_benchmark_5,
            'myra1_benchmark_6' => $myra1_benchmark_6,
            'myra1_benchmark_7' => $myra1_benchmark_7,
            'myra1_benchmark_target_1' => $myra1_benchmark_target_1,
            'myra1_benchmark_target_2' => $myra1_benchmark_target_2,
            'myra1_benchmark_target_3' => $myra1_benchmark_target_3,
            'myra1_benchmark_target_4' => $myra1_benchmark_target_4,
            'myra1_benchmark_target_5' => $myra1_benchmark_target_5,
            'myra1_benchmark_target_6' => $myra1_benchmark_target_6,
            'myra1_benchmark_target_7' => $myra1_benchmark_target_7,
            'myra1_benchmark_mark_1' => $myra1_benchmark_mark_1,
            'myra1_benchmark_mark_2' => $myra1_benchmark_mark_2,
            'myra1_benchmark_mark_3' => $myra1_benchmark_mark_3,
            'myra1_benchmark_mark_4' => $myra1_benchmark_mark_4,
            'myra1_benchmark_mark_5' => $myra1_benchmark_mark_5,
            'myra1_benchmark_mark_6' => $myra1_benchmark_mark_6,
            'myra1_benchmark_mark_7' => $myra1_benchmark_mark_7,
            'myra1_mark_1' => $myra1_mark_1,
            'myra1_mark_2' => $myra1_mark_2,
            'myra1_mark_3' => $myra1_mark_3,
            'myra1_mark_4' => $myra1_mark_4,
            'myra1_mark_5' => $myra1_mark_5,
            'myra1_mark_6' => $myra1_mark_6,
            'myra1_mark_7' => $myra1_mark_7,
            'myra1_achievement_1' => $myra1_achievement_1,
            'myra1_achievement_2' => $myra1_achievement_2,
            'myra1_achievement_3' => $myra1_achievement_3,
            'myra1_achievement_4' => $myra1_achievement_4,
            'myra1_achievement_5' => $myra1_achievement_5,
            'myra1_achievement_6' => $myra1_achievement_6,
            'myra1_achievement_7' => $myra1_achievement_7,
            'myra2_weightage_1' => $myra2_weightage_1,
            'myra2_weightage_2' => $myra2_weightage_2,
            'myra2_weightage_3' => $myra2_weightage_3,
            'myra2_weightage_4' => $myra2_weightage_4,
            'myra2_subweightage_1' => $myra2_subweightage_1,
            'myra2_subweightage_3' => $myra2_subweightage_3,
            'myra2_subweightage_4' => $myra2_subweightage_4,
            'myra2_subweightage_5' => $myra2_subweightage_5,
            'myra2_subweightage_6' => $myra2_subweightage_6,
            'myra2_subweightage_8' => $myra2_subweightage_8,
            'myra2_benchmark_1' => $myra2_benchmark_1,
            'myra2_benchmark_3' => $myra2_benchmark_3,
            'myra2_benchmark_4' => $myra2_benchmark_4,
            'myra2_benchmark_5' => $myra2_benchmark_5,
            'myra2_benchmark_6' => $myra2_benchmark_6,
            'myra2_benchmark_8' => $myra2_benchmark_8,
            'myra2_benchmark_target_1' => $myra2_benchmark_target_1,
            'myra2_benchmark_target_3' => $myra2_benchmark_target_3,
            'myra2_benchmark_target_4' => $myra2_benchmark_target_4,
            'myra2_benchmark_target_5' => $myra2_benchmark_target_5,
            'myra2_benchmark_target_6' => $myra2_benchmark_target_6,
            'myra2_benchmark_target_8' => $myra2_benchmark_target_8,
            'myra2_benchmark_mark_1' => $myra2_benchmark_mark_1,
            'myra2_benchmark_mark_3' => $myra2_benchmark_mark_3,
            'myra2_benchmark_mark_4' => $myra2_benchmark_mark_4,
            'myra2_benchmark_mark_5' => $myra2_benchmark_mark_5,
            'myra2_benchmark_mark_6' => $myra2_benchmark_mark_6,
            'myra2_benchmark_mark_8' => $myra2_benchmark_mark_8,
            'myra2_mark_1' => $myra2_mark_1,
            'myra2_mark_3' => $myra2_mark_3,
            'myra2_mark_4' => $myra2_mark_4,
            'myra2_mark_5' => $myra2_mark_5,
            'myra2_mark_6' => $myra2_mark_6,
            'myra2_mark_8' => $myra2_mark_8,
            'myra2_achievement_1' => $myra2_achievement_1,
            'myra2_achievement_3' => $myra2_achievement_3,
            'myra2_achievement_4' => $myra2_achievement_4,
            'myra2_achievement_5' => $myra2_achievement_5,
            'myra2_achievement_6' => $myra2_achievement_6,
            'myra2_achievement_8' => $myra2_achievement_8,
            'total_myra1_benchmark_mark' => $total_myra1_benchmark_mark,
            'total_myra1_mark' => $total_myra1_mark,
            'total_myra2_benchmark_mark' => $total_myra2_benchmark_mark,
            'total_myra2_mark' => $total_myra2_mark,
        ];
    }

    public function calcSectionH($active_acad_staff, $active_st, $active_nonst, $important_data){

        $myra1_1[0] = 'YES';
        $myra1_2[0] = 'YES';

        $myra2_1[0] = 'YES';
        $myra2_2[0] = 'NO';

        $myra_year_1[0] = $important_data->support;
        $myra_year_2[0] = $important_data->library;

        //myra I
        $myra1_weightage_1 = 66;
        $myra1_weightage_2 = 34;

        $myra1_benchmark_target_1[0] = 3;
        $myra1_benchmark_target_2[0] = '1.2 Mil';

        $myra1_benchmark_mark_1[0] = ($myra1_weightage_1/100)*3;
        $myra1_benchmark_mark_2[0] = ($myra1_weightage_2/100)*3;

        $myra1_mark_1[0] = $myra1_benchmark_target_1[0] > 0 ? (((float)$myra_year_1[0]/$myra1_benchmark_target_1[0]*$myra1_benchmark_mark_1[0]) > ($myra1_benchmark_mark_1[0]) ? $myra1_benchmark_mark_1[0] : ((float)$myra_year_1[0]/$myra1_benchmark_target_1[0]*$myra1_benchmark_mark_1[0])) : 0;
        $myra1_mark_2[0] = 1200000 > 0 ? (((float)$myra_year_2[0]/1200000*$myra1_benchmark_mark_2[0]) > ($myra1_benchmark_mark_2[0]) ? $myra1_benchmark_mark_2[0] : ((float)$myra_year_2[0]/1200000*$myra1_benchmark_mark_2[0])) : 0;

        $myra1_achievement_1[0] = $myra1_benchmark_mark_1[0] > 0 ? $myra1_mark_1[0]/$myra1_benchmark_mark_1[0]*100 : 0*100;
        $myra1_achievement_2[0] = $myra1_benchmark_mark_2[0] > 0 ? $myra1_mark_2[0]/$myra1_benchmark_mark_2[0]*100 : 0*100;

        //myra II

        $myra2_weightage_1 = 100;
        $myra2_benchmark_target_1[0] = 5;
        $myra2_benchmark_mark_1[0] = 3;
        $myra2_mark_1[0] = $myra2_benchmark_target_1[0] > 0 ? (((float)$myra_year_1[0]/$myra2_benchmark_target_1[0]*$myra2_benchmark_mark_1[0]) > ($myra2_benchmark_mark_1[0]) ? $myra2_benchmark_mark_1[0] : ((float)$myra_year_1[0]/$myra2_benchmark_target_1[0]*$myra2_benchmark_mark_1[0])) : 0;
        $myra2_achievement_1[0] = $myra2_benchmark_mark_1[0] > 0 ? $myra2_mark_1[0]/$myra2_benchmark_mark_1[0]*100 : 0*100;

        $total_myra1_benchmark_mark = $myra1_benchmark_mark_1[0]+$myra1_benchmark_mark_2[0];
        $total_myra1_mark = $myra1_mark_1[0]+$myra1_mark_2[0];
        $total_myra2_benchmark_mark = $myra2_benchmark_mark_1[0];
        $total_myra2_mark = $myra2_mark_1[0];
        
        
        return (object)[
            'active_acad_staff' => $active_acad_staff,
            'active_st' => $active_st,
            'active_nonst' => $active_nonst,
            'myra_year_1' => $myra_year_1,
            'myra_year_2' => $myra_year_2,
            'myra1_1' => $myra1_1,
            'myra1_2' => $myra1_2,
            'myra2_1' => $myra2_1,
            'myra2_2' => $myra2_2,
            'myra1_weightage_1' => $myra1_weightage_1,
            'myra1_weightage_2' => $myra1_weightage_2,
            'myra1_benchmark_target_1' => $myra1_benchmark_target_1,
            'myra1_benchmark_target_2' => $myra1_benchmark_target_2,
            'myra1_benchmark_mark_1' => $myra1_benchmark_mark_1,
            'myra1_benchmark_mark_2' => $myra1_benchmark_mark_2,
            'myra1_mark_1' => $myra1_mark_1,
            'myra1_mark_2' => $myra1_mark_2,
            'myra1_achievement_1' => $myra1_achievement_1,
            'myra1_achievement_2' => $myra1_achievement_2,
            'myra2_weightage_1' => $myra2_weightage_1,
            'myra2_benchmark_target_1' => $myra2_benchmark_target_1,
            'myra2_benchmark_mark_1' => $myra2_benchmark_mark_1,
            'myra2_mark_1' => $myra2_mark_1,
            'myra2_achievement_1' => $myra2_achievement_1,
            'total_myra1_benchmark_mark' => $total_myra1_benchmark_mark,
            'total_myra1_mark' => $total_myra1_mark,
            'total_myra2_benchmark_mark' => $total_myra2_benchmark_mark,
            'total_myra2_mark' => $total_myra2_mark,
        ];
    }
}
