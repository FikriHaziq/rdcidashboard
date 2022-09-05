<?php
namespace App\Http\Traits;

trait MyraCalculationTrait {

    public function calcSectionB($active_acad_staff, $active_st, $active_nonst, $important_data){
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
        $myra1_mark_3[1] = $myra1_benchmark_3[1]-($myra1_benchmark_3[1]*$v16)/15;
        $myra1_mark_3[2] = $myra1_benchmark_3[2]-($myra1_benchmark_3[2]*$v17)/15;
        $myra1_mark_3[3] = $myra1_benchmark_3[3]-($myra1_benchmark_3[3]*$v18)/15;
        $myra1_mark_3[0] = $myra1_mark_3[1]+$myra1_mark_3[2]+$myra1_mark_3[3];
        $myra1_mark_4[0] = $myra1_benchmark_target_4[0] > 0 ? (((float)$myra_year_4[0]/$myra1_benchmark_target_4[0]*$myra1_benchmark_mark_4[0]) > ($myra1_benchmark_mark_4[0]*2) ? $myra1_benchmark_mark_4[0]*2 : ((float)$myra_year_4[0]/$myra1_benchmark_target_4[0]*$myra1_benchmark_mark_4[0])) : 0;
        $myra1_mark_4[1] = $myra1_benchmark_target_4[1] > 0 ? (((float)$myra_year_4[1]/$myra1_benchmark_target_4[1]*$myra1_benchmark_mark_4[1]) > ($myra1_benchmark_mark_4[1]*2) ? $myra1_benchmark_mark_4[1]*2 : ((float)$myra_year_4[1]/$myra1_benchmark_target_4[1]*$myra1_benchmark_mark_4[1])) : 0;
        $myra1_mark_4[2] = $myra1_benchmark_target_4[2] > 0 ? (((float)$myra_year_4[2]/$myra1_benchmark_target_4[2]*$myra1_benchmark_mark_4[2]) > ($myra1_benchmark_mark_4[2]*2) ? $myra1_benchmark_mark_4[2]*2 : ((float)$myra_year_4[2]/$myra1_benchmark_target_4[2]*$myra1_benchmark_mark_4[2])) : 0;
        $myra1_mark_4[3] = $myra1_benchmark_target_4[3] > 0 ? (((float)$myra_year_4[3]/$myra1_benchmark_target_4[3]*$myra1_benchmark_mark_4[3]) > ($myra1_benchmark_mark_4[3]*2) ? $myra1_benchmark_mark_4[3]*2 : ((float)$myra_year_4[3]/$myra1_benchmark_target_4[3]*$myra1_benchmark_mark_4[3])) : 0;
        $myra1_mark_4[4] = $myra1_benchmark_target_4[4] > 0 ? (((float)$myra_year_4[4]/$myra1_benchmark_target_4[4]*$myra1_benchmark_mark_4[4]) > ($myra1_benchmark_mark_4[4]*2) ? $myra1_benchmark_mark_4[4]*2 : ((float)$myra_year_4[4]/$myra1_benchmark_target_4[4]*$myra1_benchmark_mark_4[4])) : 0;
        $myra1_mark_4[5] = $myra1_benchmark_target_4[5] > 0 ? (((float)$myra_year_4[5]/$myra1_benchmark_target_4[5]*$myra1_benchmark_mark_4[5]) > ($myra1_benchmark_mark_4[5]*2) ? $myra1_benchmark_mark_4[5]*2 : ((float)$myra_year_4[5]/$myra1_benchmark_target_4[5]*$myra1_benchmark_mark_4[5])) : 0;

        $myra1_achievement_1[0] = $myra1_benchmark_mark_1[1] > 0 ? $myra1_mark_1[1]/$myra1_benchmark_mark_1[1] : 0;
        $myra1_achievement_1[1] = $myra1_benchmark_mark_1[2] > 0 ? $myra1_mark_1[2]/$myra1_benchmark_mark_1[2] : 0;
        $myra1_achievement_1[2] = $myra1_benchmark_mark_1[3] > 0 ? $myra1_mark_1[3]/$myra1_benchmark_mark_1[3] : 0;
        $myra1_achievement_1[3] = $myra1_benchmark_mark_1[4] > 0 ? $myra1_mark_1[4]/$myra1_benchmark_mark_1[4] : 0;
        $myra1_achievement_2[0] = $myra1_benchmark_mark_2[0] > 0 ? $myra1_mark_2[0]/$myra1_benchmark_mark_2[0] : 0;
        $myra1_achievement_2[1] = $myra1_benchmark_mark_2[1] > 0 ? $myra1_mark_2[1]/$myra1_benchmark_mark_2[1] : 0;
        $myra1_achievement_3[0] = $myra1_benchmark_mark_3[1] > 0 ? $myra1_mark_3[1]/$myra1_benchmark_mark_3[1] : 0;
        $myra1_achievement_3[1] = $myra1_benchmark_mark_3[2] > 0 ? $myra1_mark_3[2]/$myra1_benchmark_mark_3[2] : 0;
        $myra1_achievement_3[2] = $myra1_benchmark_mark_3[3] > 0 ? $myra1_mark_3[3]/$myra1_benchmark_mark_3[3] : 0;
        $myra1_achievement_4[0] = $myra1_benchmark_mark_4[0] > 0 ? $myra1_mark_4[0]/$myra1_benchmark_mark_4[0] : 0;
        $myra1_achievement_4[1] = $myra1_benchmark_mark_4[1] > 0 ? $myra1_mark_4[1]/$myra1_benchmark_mark_4[1] : 0;
        $myra1_achievement_4[2] = $myra1_benchmark_mark_4[2] > 0 ? $myra1_mark_4[2]/$myra1_benchmark_mark_4[2] : 0;
        $myra1_achievement_4[3] = $myra1_benchmark_mark_4[3] > 0 ? $myra1_mark_4[3]/$myra1_benchmark_mark_4[3] : 0;
        $myra1_achievement_4[4] = $myra1_benchmark_mark_4[4] > 0 ? $myra1_mark_4[4]/$myra1_benchmark_mark_4[4] : 0;
        $myra1_achievement_4[5] = $myra1_benchmark_mark_4[5] > 0 ? $myra1_mark_4[5]/$myra1_benchmark_mark_4[5] : 0;

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
        $myra2_mark_3[1] = $myra2_benchmark_3[1]-($myra2_benchmark_3[1]*$v16)/15;
        $myra2_mark_3[2] = $myra2_benchmark_3[2]-($myra2_benchmark_3[2]*$v17)/15;
        $myra2_mark_3[3] = $myra2_benchmark_3[3]-($myra2_benchmark_3[3]*$v18)/15;
        $myra2_mark_3[0] = $myra2_mark_3[1]+$myra2_mark_3[2]+$myra2_mark_3[3];
        $myra2_mark_4[0] = $myra2_benchmark_target_4[0] > 0 ? (((float)$myra_year_4[0]/$myra2_benchmark_target_4[0]*$myra2_benchmark_mark_4[0]) > ($myra2_benchmark_mark_4[0]*2) ? $myra2_benchmark_mark_4[0]*2 : ((float)$myra_year_4[0]/$myra2_benchmark_target_4[0]*$myra2_benchmark_mark_4[0])) : 0;
        $myra2_mark_4[1] = $myra2_benchmark_target_4[1] > 0 ? (((float)$myra_year_4[1]/$myra2_benchmark_target_4[1]*$myra2_benchmark_mark_4[1]) > ($myra2_benchmark_mark_4[1]*2) ? $myra2_benchmark_mark_4[1]*2 : ((float)$myra_year_4[1]/$myra2_benchmark_target_4[1]*$myra2_benchmark_mark_4[1])) : 0;
        $myra2_mark_4[2] = $myra2_benchmark_target_4[2] > 0 ? (((float)$myra_year_4[2]/$myra2_benchmark_target_4[2]*$myra2_benchmark_mark_4[2]) > ($myra2_benchmark_mark_4[2]*2) ? $myra2_benchmark_mark_4[2]*2 : ((float)$myra_year_4[2]/$myra2_benchmark_target_4[2]*$myra2_benchmark_mark_4[2])) : 0;
        $myra2_mark_4[3] = $myra2_benchmark_target_4[3] > 0 ? (((float)$myra_year_4[3]/$myra2_benchmark_target_4[3]*$myra2_benchmark_mark_4[3]) > ($myra2_benchmark_mark_4[3]*2) ? $myra2_benchmark_mark_4[3]*2 : ((float)$myra_year_4[3]/$myra2_benchmark_target_4[3]*$myra2_benchmark_mark_4[3])) : 0;

        $myra2_achievement_1[0] = $myra2_benchmark_mark_1[1] > 0 ? $myra2_mark_1[1]/$myra2_benchmark_mark_1[1] : 0;
        $myra2_achievement_1[1] = $myra2_benchmark_mark_1[2] > 0 ? $myra2_mark_1[2]/$myra2_benchmark_mark_1[2] : 0;
        $myra2_achievement_1[2] = $myra2_benchmark_mark_1[3] > 0 ? $myra2_mark_1[3]/$myra2_benchmark_mark_1[3] : 0;
        $myra2_achievement_1[3] = $myra2_benchmark_mark_1[4] > 0 ? $myra2_mark_1[4]/$myra2_benchmark_mark_1[4] : 0;
        $myra2_achievement_2[0] = $myra2_benchmark_mark_2[0] > 0 ? $myra2_mark_2[0]/$myra2_benchmark_mark_2[0] : 0;
        $myra2_achievement_2[1] = $myra2_benchmark_mark_2[1] > 0 ? $myra2_mark_2[1]/$myra2_benchmark_mark_2[1] : 0;
        $myra2_achievement_3[0] = $myra2_benchmark_mark_3[1] > 0 ? $myra2_mark_3[1]/$myra2_benchmark_mark_3[1] : 0;
        $myra2_achievement_3[1] = $myra2_benchmark_mark_3[2] > 0 ? $myra2_mark_3[2]/$myra2_benchmark_mark_3[2] : 0;
        $myra2_achievement_3[2] = $myra2_benchmark_mark_3[3] > 0 ? $myra2_mark_3[3]/$myra2_benchmark_mark_3[3] : 0;
        $myra2_achievement_4[0] = $myra2_benchmark_mark_4[0] > 0 ? $myra2_mark_4[0]/$myra2_benchmark_mark_4[0] : 0;
        $myra2_achievement_4[1] = $myra2_benchmark_mark_4[1] > 0 ? $myra2_mark_4[1]/$myra2_benchmark_mark_4[1] : 0;
        $myra2_achievement_4[2] = $myra2_benchmark_mark_4[2] > 0 ? $myra2_mark_4[2]/$myra2_benchmark_mark_4[2] : 0;
        $myra2_achievement_4[3] = $myra2_benchmark_mark_4[3] > 0 ? $myra2_mark_4[3]/$myra2_benchmark_mark_4[3] : 0;

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
}
