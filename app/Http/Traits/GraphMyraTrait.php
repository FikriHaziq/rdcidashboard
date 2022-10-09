<?php
namespace App\Http\Traits;
use App\Models\MasterList\MasterlistAcademicStaff;
use App\Models\MasterList\MasterlistUgStudent;
use App\Models\MasterList\MasterlistPgStudent;
use App\Models\MasterList\MasterlistCriticalMass;
use App\Models\MasterList\MasterlistProfessionalQualification;
use App\Models\MasterList\MasterlistResearchExperience;
use App\Models\MasterList\MasterlistAward;
use App\Models\MasterList\MasterlistPublication;
use App\Models\MasterList\MasterlistResearchGrant;
use App\Models\MasterList\MasterlistMonitoringProject;
use App\Models\MasterList\MasterlistPhdGraduate;
use App\Models\MasterList\MasterlistMasterGraduate;
use App\Models\MasterList\MasterlistPhdEnroll;
use App\Models\MasterList\MasterlistEntryQualification;
use App\Models\MasterList\MasterlistFellowship;
use App\Models\MasterList\MasterlistPostDoc;
use App\Models\MasterList\MasterlistPatentGrant;
use App\Models\MasterList\MasterlistPatentFile;
use App\Models\MasterList\MasterlistCommProduct;
use App\Models\MasterList\MasterlistKnowHowSold;
use App\Models\MasterList\MasterlistOtherIpr;
use App\Models\MasterList\MasterlistActiveCompany;
use App\Models\MasterList\MasterlistNewCompany;
use App\Models\MasterList\MasterlistTrainingCourse;
use App\Models\MasterList\MasterlistPgFee;
use App\Models\MasterList\MasterlistConference;
use App\Models\MasterList\MasterlistProductCommRef;
use App\Models\MasterList\MasterlistTechKnowHow;
use App\Models\MasterList\MasterlistConsultancy;
use App\Models\MasterList\MasterlistLabService;
use App\Models\MasterList\MasterlistNewEndowment;
use App\Models\MasterList\MasterlistGift;
use App\Models\MasterList\MasterlistInternationalMoa;
use App\Models\MasterList\MasterlistStaffInternationalMoa;
use App\Models\MasterList\MasterlistStaffSentAbroad;
use App\Models\MasterList\MasterlistMembershipInternational;
use App\Models\MasterList\MasterlistNationalMoa;
use App\Models\MasterList\MasterlistStaffNationalMoa;
use App\Models\MasterList\MasterlistMembershipNational;
use App\Models\MasterList\MasterlistNewKtp;
use App\Models\MasterList\MasterlistBenefitedKtp;
use App\Models\MasterList\MasterlistJointResearchProject;
use App\Models\MasterList\MasterlistJointResearchRu;
use App\Models\MasterList\MasterlistSupportFacility;
use App\Models\MasterList\MasterlistLibraryFacility;
use App\Models\DataAttachment;
use App\Http\Traits\MyraCalculationTrait;

trait GraphMyraTrait {

    public function sectionB_PI($start_year, $end_year) {
        $year_range = [];
        $line_1 = (object)[ //STAFF INVOLVED AS PRINCIPAL INVESTIGATOR
            'data_1' => [],
            'data_2' => [],
        ]; 
        $line_2 = (object)[  //PRINCIPAL INVESTIGATORS
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
            'data_4' => [],
        ]; 
        $bar_1 = (object)[  //PI-INTERNATIONAL: ACHIEVEMENT VS TARGET
            'data_1' => [],
            'data_2' => [],
        ]; 
        $bar_2 = (object)[  //PI-NATIONAL: ACHIEVEMENT VS TARGET
            'data_1' => [],
            'data_2' => [],
        ]; 
        $bar_3 = (object)[  //PI-UNIVERSITY: ACHIEVEMENT VS TARGET
            'data_1' => [],
            'data_2' => [],
        ]; 
        $bar_4 = (object)[  //PI-PRIVATE: ACHIEVEMENT VS TARGET
            'data_1' => [],
            'data_2' => [],
        ]; 

        for ($i=($end_year-$start_year <= 0?$end_year:$start_year); $i <= $end_year; $i++) { 
            $line1_1 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->count();
            $line1_2 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', '!=', 'Y')->count();
            $line2_1 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->where('sponsor_category', 'INTERNATIONAL')->count();
            $line2_2 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->where('sponsor_category', 'NATIONAL')->count();
            $line2_3 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->where('sponsor_category', 'UNIVERSITY')->count();
            $line2_4 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->where('sponsor_category', 'PRIVATE')->count();
            $bar1_1 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->where('sponsor_category', 'INTERNATIONAL')->where('project_status', 'COMPLETED')->count();
            $bar1_2 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->where('sponsor_category', 'INTERNATIONAL')->where('project_status', '!=', 'COMPLETED')->count();
            $bar2_1 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->where('sponsor_category', 'NATIONAL')->where('project_status', 'COMPLETED')->count();
            $bar2_2 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->where('sponsor_category', 'NATIONAL')->where('project_status', '!=', 'COMPLETED')->count();
            $bar3_1 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->where('sponsor_category', 'UNIVERSITY')->where('project_status', 'COMPLETED')->count();
            $bar3_2 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->where('sponsor_category', 'UNIVERSITY')->where('project_status', '!=', 'COMPLETED')->count();
            $bar4_1 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->where('sponsor_category', 'PRIVATE')->where('project_status', 'COMPLETED')->count();
            $bar4_2 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->where('sponsor_category', 'PRIVATE')->where('project_status', '!=', 'COMPLETED')->count();
            array_push($year_range, (int)$i);
            array_push($line_1->data_1, $line1_1);
            array_push($line_1->data_2, $line1_2);
            array_push($line_2->data_1, $line2_1);
            array_push($line_2->data_2, $line2_2);
            array_push($line_2->data_3, $line2_3);
            array_push($line_2->data_4, $line2_4);
            array_push($bar_1->data_1, $bar1_1);
            array_push($bar_1->data_2, $bar1_2);
            array_push($bar_2->data_1, $bar2_1);
            array_push($bar_2->data_2, $bar2_2);
            array_push($bar_3->data_1, $bar3_1);
            array_push($bar_3->data_2, $bar3_2);
            array_push($bar_4->data_1, $bar4_1);
            array_push($bar_4->data_2, $bar4_2);
        }

        return (object)[
            'year_range' => $year_range,
            'line_1' => $line_1,
            'line_2' => $line_2,
            'bar_1' => $bar_1,
            'bar_2' => $bar_2,
            'bar_3' => $bar_3,
            'bar_4' => $bar_4,
        ];
    }

}
