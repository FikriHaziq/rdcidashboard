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
use App\Models\MyraCalculation;
use App\Http\Traits\DataSerializationTrait;
use App\Http\Traits\MasterListMyraTrait;
use Illuminate\Support\Facades\DB;

trait GraphMyraTrait {
    use DataSerializationTrait, MasterListMyraTrait;

    public function overview_data($start_year, $end_year, $faculty = null) {
        $year_range = []; 
        $line_1 = (object)[ //TOTAL
            'data_1' => [],
            'data_2' => [],
        ];
        $line_2 = (object)[ //SECTION B
            'data_1' => [],
            'data_2' => [],
        ]; 
        $line_3 = (object)[ //SECTION C
            'data_1' => [],
            'data_2' => [],
        ]; 
        $line_4 = (object)[ //SECTION D
            'data_1' => [],
            'data_2' => [],
        ]; 
        $line_5 = (object)[ //SECTION E
            'data_1' => [],
            'data_2' => [],
        ]; 
        $line_6 = (object)[ //SECTION F
            'data_1' => [],
            'data_2' => [],
        ]; 
        $line_7 = (object)[ //SECTION G
            'data_1' => [],
            'data_2' => [],
        ]; 
        $line_8 = (object)[ //SECTION H
            'data_1' => [],
            'data_2' => [],
        ]; 
        for ($i=($end_year-$start_year <= 0?$end_year:$start_year); $i <= $end_year; $i++) { 
            if($faculty){
                $section_b_data = $this->myraSectionB($i, $faculty);
                $section_c_data = $this->myraSectionC($i, $faculty);
                $section_d_data = $this->myraSectionD($i, $faculty);
                $section_e_data = $this->myraSectionE($i, $faculty);
                $section_f_data = $this->myraSectionF($i, $faculty);
                $section_g_data = $this->myraSectionG($i, $faculty);
                $section_h_data = $this->myraSectionH($i, $faculty);
                $section_b = (object)['myra1_mark'=>$section_b_data->calculation->total_myra1_mark,'myra2_mark'=>$section_b_data->calculation->total_myra2_mark];
                $section_c = (object)['myra1_mark'=>$section_c_data->calculation->total_myra1_mark,'myra2_mark'=>$section_c_data->calculation->total_myra2_mark];
                $section_d = (object)['myra1_mark'=>$section_d_data->calculation->total_myra1_mark,'myra2_mark'=>$section_d_data->calculation->total_myra2_mark];
                $section_e = (object)['myra1_mark'=>$section_e_data->calculation->total_myra1_mark,'myra2_mark'=>$section_e_data->calculation->total_myra2_mark];
                $section_f = (object)['myra1_mark'=>$section_f_data->calculation->total_myra1_mark,'myra2_mark'=>$section_f_data->calculation->total_myra2_mark];
                $section_g = (object)['myra1_mark'=>$section_g_data->calculation->total_myra1_mark,'myra2_mark'=>$section_g_data->calculation->total_myra2_mark];
                $section_h = (object)['myra1_mark'=>$section_h_data->calculation->total_myra1_mark,'myra2_mark'=>$section_h_data->calculation->total_myra2_mark];
                // dd($section_b_data);
                $total_myra1 = ($section_b->myra1_mark ?? 0) + ($section_c->myra1_mark ?? 0) + ($section_d->myra1_mark ?? 0) + ($section_e->myra1_mark ?? 0) + ($section_f->myra1_mark ?? 0) + ($section_g->myra1_mark ?? 0) + ($section_h->myra1_mark ?? 0);
                $total_myra2 = ($section_b->myra2_mark ?? 0) + ($section_c->myra2_mark ?? 0) + ($section_d->myra2_mark ?? 0) + ($section_e->myra2_mark ?? 0) + ($section_f->myra2_mark ?? 0) + ($section_g->myra2_mark ?? 0) + ($section_h->myra2_mark ?? 0);
            }
            else
            {
                $section_b = MyraCalculation::select([DB::raw("JSON_EXTRACT(overall, '$.myra1_mark')as myra1_mark"), DB::raw("JSON_EXTRACT(overall, '$.myra2_mark')as myra2_mark")])->where('year', $i)->whereType('section_b')->first();
                $section_c = MyraCalculation::select([DB::raw("JSON_EXTRACT(overall, '$.myra1_mark')as myra1_mark"), DB::raw("JSON_EXTRACT(overall, '$.myra2_mark')as myra2_mark")])->where('year', $i)->whereType('section_c')->first();
                $section_d = MyraCalculation::select([DB::raw("JSON_EXTRACT(overall, '$.myra1_mark')as myra1_mark"), DB::raw("JSON_EXTRACT(overall, '$.myra2_mark')as myra2_mark")])->where('year', $i)->whereType('section_d')->first();
                $section_e = MyraCalculation::select([DB::raw("JSON_EXTRACT(overall, '$.myra1_mark')as myra1_mark"), DB::raw("JSON_EXTRACT(overall, '$.myra2_mark')as myra2_mark")])->where('year', $i)->whereType('section_e')->first();
                $section_f = MyraCalculation::select([DB::raw("JSON_EXTRACT(overall, '$.myra1_mark')as myra1_mark"), DB::raw("JSON_EXTRACT(overall, '$.myra2_mark')as myra2_mark")])->where('year', $i)->whereType('section_f')->first();
                $section_g = MyraCalculation::select([DB::raw("JSON_EXTRACT(overall, '$.myra1_mark')as myra1_mark"), DB::raw("JSON_EXTRACT(overall, '$.myra2_mark')as myra2_mark")])->where('year', $i)->whereType('section_g')->first();
                $section_h = MyraCalculation::select([DB::raw("JSON_EXTRACT(overall, '$.myra1_mark')as myra1_mark"), DB::raw("JSON_EXTRACT(overall, '$.myra2_mark')as myra2_mark")])->where('year', $i)->whereType('section_h')->first();
                $total_myra1 = ($section_b->myra1_mark ?? 0) + ($section_c->myra1_mark ?? 0) + ($section_d->myra1_mark ?? 0) + ($section_e->myra1_mark ?? 0) + ($section_f->myra1_mark ?? 0) + ($section_g->myra1_mark ?? 0) + ($section_h->myra1_mark ?? 0);
                $total_myra2 = ($section_b->myra2_mark ?? 0) + ($section_c->myra2_mark ?? 0) + ($section_d->myra2_mark ?? 0) + ($section_e->myra2_mark ?? 0) + ($section_f->myra2_mark ?? 0) + ($section_g->myra2_mark ?? 0) + ($section_h->myra2_mark ?? 0);
            }
            array_push($year_range, (int)$i);
            array_push($line_1->data_1, (float)number_format(($total_myra1), 2));
            array_push($line_1->data_2, (float)number_format(($total_myra2), 2));
            array_push($line_2->data_1, (float)number_format(($section_b->myra1_mark ?? 0), 2));
            array_push($line_2->data_2, (float)number_format(($section_b->myra2_mark ?? 0), 2));
            array_push($line_3->data_1, (float)number_format(($section_c->myra1_mark ?? 0), 2));
            array_push($line_3->data_2, (float)number_format(($section_c->myra2_mark ?? 0), 2));
            array_push($line_4->data_1, (float)number_format(($section_d->myra1_mark ?? 0), 2));
            array_push($line_4->data_2, (float)number_format(($section_d->myra2_mark ?? 0), 2));
            array_push($line_5->data_1, (float)number_format(($section_e->myra1_mark ?? 0), 2));
            array_push($line_5->data_2, (float)number_format(($section_e->myra2_mark ?? 0), 2));
            array_push($line_6->data_1, (float)number_format(($section_f->myra1_mark ?? 0), 2));
            array_push($line_6->data_2, (float)number_format(($section_f->myra2_mark ?? 0), 2));
            array_push($line_7->data_1, (float)number_format(($section_g->myra1_mark ?? 0), 2));
            array_push($line_7->data_2, (float)number_format(($section_g->myra2_mark ?? 0), 2));
            array_push($line_8->data_1, (float)number_format(($section_h->myra1_mark ?? 0), 2));
            array_push($line_8->data_2, (float)number_format(($section_h->myra2_mark ?? 0), 2));

        }

        return (object)[
            'year_range' => $year_range,
            'line_1' => $line_1,
            'line_2' => $line_2,
            'line_3' => $line_3,
            'line_4' => $line_4,
            'line_5' => $line_5,
            'line_6' => $line_6,
            'line_7' => $line_7,
            'line_8' => $line_8,
        ];
    }

    public function staff_data($start_year, $end_year) {
        $year_range = []; 
        $bar_1 = (object)[ //grade
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
            'data_4' => [],
            'data_5' => [],
        ];
        $bar_2 = (object)[ //cohort
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ];
        $line_1 = (object)[ //active staff
            'data_1' => [],
        ];
        $line_2 = (object)[ //foreign staff
            'data_1' => [],
        ];
        $bar_3 = (object)[ //country
            'data_1' => [],
        ];
        for ($i=($end_year-$start_year <= 0?$end_year:$start_year); $i <= $end_year; $i++) {
            $bar1_1 = MasterlistAcademicStaff::where('ml_end_year', $i)->whereIn('position',$this->staff_position('prof'))->count();
            $bar1_2 = MasterlistAcademicStaff::where('ml_end_year', $i)->whereIn('position',$this->staff_position('assoc_prof'))->count();
            $bar1_3 = MasterlistAcademicStaff::where('ml_end_year', $i)->whereIn('position',$this->staff_position('senior_lecturer'))->count();
            $bar1_4 = MasterlistAcademicStaff::where('ml_end_year', $i)->whereIn('position',$this->staff_position('lecturer'))->count();
            $bar1_5 = MasterlistAcademicStaff::where('ml_end_year', $i)->whereIn('position',$this->staff_position('research_fellow'))->count();
            $bar2_1 = MasterlistAcademicStaff::where('ml_end_year', $i)->where('age', '>', 50)->count();
            $bar2_2 = MasterlistAcademicStaff::where('ml_end_year', $i)->where('age', '>=', 40)->where('age', '<=', 50)->count();
            $bar2_3 = MasterlistAcademicStaff::where('ml_end_year', $i)->where('age', '<', 40)->count();
            $line1 = MasterlistAcademicStaff::where('ml_end_year', $i)->count();
            $line2 = MasterlistAcademicStaff::where('ml_end_year', $i)->where('citizenship', $this->filter_citizenship('foreign'))->count();
            
            array_push($year_range, (int)$i);
            array_push($bar_1->data_1, $bar1_1);
            array_push($bar_1->data_2, $bar1_2);
            array_push($bar_1->data_3, $bar1_3);
            array_push($bar_1->data_4, $bar1_4);
            array_push($bar_1->data_5, $bar1_5);
            array_push($bar_2->data_1, $bar2_1);
            array_push($bar_2->data_2, $bar2_2);
            array_push($bar_2->data_3, $bar2_3);
            array_push($line_1->data_1, $line1);
            array_push($line_2->data_1, $line2);
        }
        $country_queries = [];
        $country_labels = [];
        $countries = [];

        $countryRaws = MasterlistAcademicStaff::select('country')->where('ml_end_year', '>=', $start_year)->where('ml_end_year', '<=', $end_year)->orderBy('country')->where('citizenship',$this->filter_citizenship('foreign'))->distinct()->get();
        foreach ($countryRaws as $key => $countryRaw) {
            $country = $this->country_code_label($countryRaw->country);
            array_push($country_queries, $country);
            array_push($country_labels, $country['label']);
        }
        
        $country_queries = array_unique($country_queries, SORT_REGULAR);
        $country_labels = array_unique($country_labels);
        // dd($country_queries);
        foreach ($country_queries as $key => $value) {
            $country_data = MasterlistAcademicStaff::where('ml_end_year', '>=', $start_year)->where('ml_end_year', '<=', $end_year)->where('citizenship', $this->filter_citizenship('foreign'))->whereIn('country', $value)->count();
            array_push($bar_3->data_1, $country_data);
        }

        foreach ($country_labels as $key => $value) {
            array_push($countries, $value);
        }
        
        return (object)[
            'year_range' => $year_range,
            'country' => $countries,
            'bar_1' => $bar_1,
            'bar_2' => $bar_2,
            'line_1' => $line_1,
            'line_2' => $line_2,
            'bar_3' => $bar_3,
        ];
    }

    public function student_data($start_year, $end_year) {
        $year_range = []; 
        $line_1 = (object)[ //Post graduate study mode
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
            'data_4' => [],
        ];
        $bar_1 = (object)[ //Post graduate by research
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
            'data_4' => [],
        ];
        $bar_2 = (object)[ //POSTGRADUATES AREA OF STUDY
            'data_1' => [],
        ];
        $bar_3 = (object)[ //UNDERGRADUATE VS POSTGRADUATE
            'data_1' => [],
            'data_2' => [],
        ];
        // $test = MasterlistPgStudent::select('study_area')->orderBy('study_area')->distinct()->get()->toArray();
        // dd($test);
        for ($i=($end_year-$start_year <= 0?$end_year:$start_year); $i <= $end_year; $i++) {
            // $line1_1 = ;
            $line1_1 = MasterlistPgStudent::where('ml_end_year', $i)->whereIn('degree_registered_for', $this->student_degree('master'))->whereIn('study_mode', $this->student_study_mode('research'))->count();
            $line1_2 = MasterlistPgStudent::where('ml_end_year', $i)->whereIn('degree_registered_for', $this->student_degree('master'))->whereIn('study_mode', $this->student_study_mode('coursework'))->count();
            $line1_3 = MasterlistPgStudent::where('ml_end_year', $i)->whereIn('degree_registered_for', $this->student_degree('phd'))->count();
            $line1_4 = MasterlistPgStudent::where('ml_end_year', $i)->whereIn('degree_registered_for', $this->student_degree('doctoral'))->whereIn('study_mode', $this->student_study_mode('coursework'))->count();
            $bar1_1 = MasterlistPgStudent::where('ml_end_year', $i)->whereIn('degree_registered_for', $this->student_degree('master'))->whereIn('study_mode', $this->student_study_mode('research'))->whereIn('citizenship', $this->filter_citizenship('foreign'))->count();
            $bar1_2 = MasterlistPgStudent::where('ml_end_year', $i)->whereIn('degree_registered_for', $this->student_degree('master'))->whereIn('study_mode', $this->student_study_mode('research'))->whereIn('citizenship', $this->filter_citizenship('local'))->count();
            $bar1_3 = MasterlistPgStudent::where('ml_end_year', $i)->whereIn('degree_registered_for', $this->student_degree('phd'))->whereIn('study_mode', $this->student_study_mode('research'))->whereIn('citizenship', $this->filter_citizenship('foreign'))->count();
            $bar1_4 = MasterlistPgStudent::where('ml_end_year', $i)->whereIn('degree_registered_for', $this->student_degree('phd'))->whereIn('study_mode', $this->student_study_mode('research'))->whereIn('citizenship', $this->filter_citizenship('local'))->count();
            $bar3_1 = MasterlistUgStudent::where('ml_end_year', $i)->count();
            $bar3_2 = MasterlistPgStudent::where('ml_end_year', $i)->count();
            array_push($year_range, (int)$i);
            array_push($line_1->data_1, $line1_1);
            array_push($line_1->data_2, $line1_2);
            array_push($line_1->data_3, $line1_3);
            array_push($line_1->data_4, $line1_4);
            array_push($bar_1->data_1, $bar1_1);
            array_push($bar_1->data_2, $bar1_2);
            array_push($bar_1->data_3, $bar1_3);
            array_push($bar_1->data_4, $bar1_4);
            array_push($bar_3->data_1, $bar3_1);
            array_push($bar_3->data_2, $bar3_2);
        }
        $study_area_queries = [];
        $study_area_labels = [];
        $studyAreaRaws = MasterlistPgStudent::select('study_area')->where('ml_end_year', '>=', $start_year)->where('ml_end_year', '<=', $end_year)->orderBy('study_area')->distinct()->get();
        foreach ($studyAreaRaws as $key => $studyAreaRaw) {
            $study_area = $this->student_study_area($studyAreaRaw->study_area);
            array_push($study_area_queries, $study_area);
            array_push($study_area_labels, $study_area['label']);
        }
        
        $study_area_queries = array_unique($study_area_queries, SORT_REGULAR);
        $study_area_labels = array_unique($study_area_labels);
        usort($study_area_queries, function($a, $b) {return strcmp($a['label'], $b['label']);});
        sort($study_area_labels);
        foreach ($study_area_queries as $key => $value) {
            // dd($value)
            $study_area_data = MasterlistPgStudent::where('ml_end_year', '>=', $start_year)->where('ml_end_year', '<=', $end_year)->whereIn('study_area', $value)->count();
            array_push($bar_2->data_1, $study_area_data);
        }

        // foreach ($study_area_labels as $key => $value) {
        //     array_push($study_areas, $value);
        // }
        // dd($study_areas);
        // dd($study_area_labels);
        
        return (object)[
            'year_range' => $year_range,
            'study_area' => $study_area_labels,
            'line_1' => $line_1,
            'bar_1' => $bar_1,
            'bar_2' => $bar_2,
            'bar_3' => $bar_3,
        ];
    }

    public function sectionB_data_PI($start_year, $end_year) {
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
            $line2_1 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->whereIn('sponsor_category', $this->sponsor_category('international'))->count();
            $line2_2 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->whereIn('sponsor_category', $this->sponsor_category('national'))->count();
            $line2_3 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->whereIn('sponsor_category', $this->sponsor_category('university'))->count();
            $line2_4 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->whereIn('sponsor_category', $this->sponsor_category('private'))->count();
            $bar1_1 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->whereIn('sponsor_category', $this->sponsor_category('international'))->count();
            $bar1_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.critical_mass.international.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_b')->first();
            $bar2_1 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->whereIn('sponsor_category', $this->sponsor_category('national'))->count();
            $bar2_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.critical_mass.national.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_b')->first();
            $bar3_1 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->whereIn('sponsor_category', $this->sponsor_category('university'))->count();
            $bar3_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.critical_mass.university.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_b')->first();
            $bar4_1 = MasterlistCriticalMass::where('ml_end_year', $i)->where('pi', 'Y')->whereIn('sponsor_category', $this->sponsor_category('private'))->count();
            $bar4_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.critical_mass.private.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_b')->first();
            array_push($year_range, (int)$i);
            array_push($line_1->data_1, $line1_1);
            array_push($line_1->data_2, $line1_2);
            array_push($line_2->data_1, $line2_1);
            array_push($line_2->data_2, $line2_2);
            array_push($line_2->data_3, $line2_3);
            array_push($line_2->data_4, $line2_4);
            array_push($bar_1->data_1, $bar1_1);
            array_push($bar_1->data_2, (int)($bar1_2->myra2_benchmark_target ?? 0));
            array_push($bar_2->data_1, $bar2_1);
            array_push($bar_2->data_2, (int)($bar2_2->myra2_benchmark_target ?? 0));
            array_push($bar_3->data_1, $bar3_1);
            array_push($bar_3->data_2, (int)($bar3_2->myra2_benchmark_target ?? 0));
            array_push($bar_4->data_1, $bar4_1);
            array_push($bar_4->data_2, (int)($bar4_2->myra2_benchmark_target ?? 0));
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

    public function sectionB_data_QC($start_year, $end_year) {
        $year_range = [];
        $line_1 = (object)[ //PhD & PROFESSIONAL QUALIFICATION
            'data_1' => [],
            'data_2' => [],
        ]; 
        $bar_1 = (object)[  //COHORT
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ];

        for ($i=($end_year-$start_year <= 0?$end_year:$start_year); $i <= $end_year; $i++) { 
            $line1_1 = MasterlistProfessionalQualification::where('ml_end_year', $i)->whereIn('acad_qualification', ['PHD'])->count();
            $line1_2 = MasterlistProfessionalQualification::where('ml_end_year', $i)->whereNotNull('professional_qualification_1')->count();
            $bar1_1 = MasterlistProfessionalQualification::where('ml_end_year', $i)->where('age', '<', 40)->count();
            $bar1_2 = MasterlistProfessionalQualification::where('ml_end_year', $i)->where('age', '>=', 40)->where('age', '<=', 50)->count();
            $bar1_3 = MasterlistProfessionalQualification::where('ml_end_year', $i)->where('age', '>', 50)->count();
            
            array_push($year_range, (int)$i);
            array_push($line_1->data_1, $line1_1);
            array_push($line_1->data_2, $line1_2);
            array_push($bar_1->data_1, $bar1_1);
            array_push($bar_1->data_2, $bar1_2);
            array_push($bar_1->data_3, $bar1_3);
        }

        return (object)[
            'year_range' => $year_range,
            'line_1' => $line_1,
            'bar_1' => $bar_1,
        ];
    }

    public function sectionB_data_A($start_year, $end_year) {
        $year_range = [];
        $bar_1 = (object)[  //INTERNATIONAL AWARDS
            'data_1' => [],
            'data_2' => [],
        ]; 
        $bar_2 = (object)[  //INTERNATIONAL RECOGNITION/STEWARDSHIP
            'data_1' => [],
            'data_2' => [],
        ]; 
        $bar_3 = (object)[  //NATIONAL AWARDS
            'data_1' => [],
            'data_2' => [],
        ]; 
        $bar_4 = (object)[  //NATIONAL RECOGNITION/STEWARDSHIP
            'data_1' => [],
            'data_2' => [],
        ]; 
        $bar_5 = (object)[  //EXHIBITION AWARDS
            'data_1' => [],
            'data_2' => [],
        ]; 
        $bar_6 = (object)[  //OTHER RESEARCH AWARDS
            'data_1' => [],
            'data_2' => [],
        ]; 

        for ($i=($end_year-$start_year <= 0?$end_year:$start_year); $i <= $end_year; $i++) { 
            $bar1_1 = MasterlistAward::where('ml_end_year', $i)->whereIn('nat_int', $this->nat_int('international'))->whereIn('award_type', $this->award_type('award'))->count();
            $bar1_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.award.award_international.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_b')->first();
            $bar2_1 = MasterlistAward::where('ml_end_year', $i)->whereIn('nat_int', $this->nat_int('international'))->whereIn('award_type',$this->award_type('recognition_stewardship'))->count();
            $bar2_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.award.recog_international.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_b')->first();
            $bar3_1 = MasterlistAward::where('ml_end_year', $i)->whereIn('nat_int', $this->nat_int('national'))->whereIn('award_type', $this->award_type('award'))->count();
            $bar3_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.award.award_national.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_b')->first();
            $bar4_1 = MasterlistAward::where('ml_end_year', $i)->whereIn('nat_int', $this->nat_int('national'))->whereIn('award_type',$this->award_type('recognition_stewardship'))->count();
            $bar4_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.award.recog_national.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_b')->first();
            $bar5_1 = MasterlistAward::where('ml_end_year', $i)->whereIn('award_type',$this->award_type('exhibition'))->count();
            $bar5_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.award.exhibition.myra1_benchmark_target')as myra1_benchmark_target")])->where('year', $i)->whereType('section_b')->first();
            $bar6_1 = MasterlistAward::where('ml_end_year', $i)->whereIn('award_type',$this->award_type('other'))->count();
            $bar6_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.award.other.myra1_benchmark_target')as myra1_benchmark_target")])->where('year', $i)->whereType('section_b')->first();
            array_push($year_range, (int)$i);
            array_push($bar_1->data_1, $bar1_1);
            array_push($bar_1->data_2, ($bar1_2->myra2_benchmark_target ?? 0));
            array_push($bar_2->data_1, $bar2_1);
            array_push($bar_2->data_2, ($bar2_2->myra2_benchmark_target ?? 0));
            array_push($bar_3->data_1, $bar3_1);
            array_push($bar_3->data_2, ($bar3_2->myra2_benchmark_target ?? 0));
            array_push($bar_4->data_1, $bar4_1);
            array_push($bar_4->data_2, ($bar4_2->myra2_benchmark_target ?? 0));
            array_push($bar_5->data_1, $bar5_1);
            array_push($bar_5->data_2, ($bar5_2->myra1_benchmark_target ?? 0));
            array_push($bar_6->data_1, $bar6_1);
            array_push($bar_6->data_2, ($bar6_2->myra1_benchmark_target ?? 0));
        }

        return (object)[
            'year_range' => $year_range,
            'bar_1' => $bar_1,
            'bar_2' => $bar_2,
            'bar_3' => $bar_3,
            'bar_4' => $bar_4,
            'bar_5' => $bar_5,
            'bar_6' => $bar_6,
        ];
    }

    public function sectionC_data_P($start_year, $end_year) {
        $year_range = [];
        $bar_1 = (object)[  //INDEXED JOURNAL
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ]; 
        $bar_2 = (object)[  //ARTICLE Q1/Q2
            'data_1' => [],
            'data_2' => [],
        ]; 
        $bar_3 = (object)[  //INDEXED PROCEEDING
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ]; 
        $bar_4 = (object)[  //MyCITE
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ]; 
        $bar_5 = (object)[  //RESEARCH BOOK
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ]; 
        $bar_6= (object)[  //CHAPTER RESEARCH BOOK
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ]; 
        $bar_7= (object)[  //CASE STUDY
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ]; 
        $bar_8= (object)[  //POLICY PAPER
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ]; 
        $bar_9= (object)[  //OTHER
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ];

        for ($i=($end_year-$start_year <= 0?$end_year:$start_year); $i <= $end_year; $i++) { 
            $bar1_1 = MasterlistPublication::where('ml_end_year', $i)->wherePublicationType('journal')->count();
            $bar1_2 = (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.publication.journal.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_c')->first()->myra2_benchmark_target ?? 0);
            $bar1_3 = $bar1_2*2;
            $bar2_1 = MasterlistPublication::where('ml_end_year', $i)->wherePublicationType('journal')->whereIn('quartile', ['Q1','Q2'])->count();
            $bar2_2 = $bar1_1;
            $bar3_1 = MasterlistPublication::where('ml_end_year', $i)->wherePublicationType('proceeding')->count();
            $bar3_2 = (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.publication.proceeding.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_c')->first()->myra2_benchmark_target ?? 0);
            $bar3_3 = $bar3_2*2;
            $bar4_1 = MasterlistPublication::where('ml_end_year', $i)->wherePublicationType('mycite')->count();
            $bar4_2 = (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.publication.mycite.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_c')->first()->myra2_benchmark_target ?? 0);
            $bar4_3 = $bar4_2*2;
            $bar5_1 = MasterlistPublication::where('ml_end_year', $i)->wherePublicationType('research_book')->count();
            $bar5_2 = (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.publication.indexed_book.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_c')->first()->myra2_benchmark_target ?? 0) + (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.publication.non_indexed_book.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_c')->first()->myra2_benchmark_target ?? 0);
            $bar5_3 = $bar5_2*2;
            $bar6_1 = MasterlistPublication::where('ml_end_year', $i)->wherePublicationType('chapter_research_book')->count();
            $bar6_2 = (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.publication.indexed_chapter.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_c')->first()->myra2_benchmark_target ?? 0) + (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.publication.non_indexed_chapter.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_c')->first()->myra2_benchmark_target ?? 0);
            $bar6_3 = $bar6_2*2;
            $bar7_1 = MasterlistPublication::where('ml_end_year', $i)->wherePublicationType('case_studies')->count();
            $bar7_2 = (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.publication.case_studies.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_c')->first()->myra2_benchmark_target ?? 0);
            $bar7_3 = $bar7_2*2;
            $bar8_1 = MasterlistPublication::where('ml_end_year', $i)->wherePublicationType('policy_paper')->count();
            $bar8_2 = (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.publication.policy_paper.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_c')->first()->myra2_benchmark_target ?? 0);
            $bar8_3 = $bar8_2*2;
            $bar9_1 = MasterlistPublication::where('ml_end_year', $i)->wherePublicationType('other')->count();
            $bar9_2 = (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.publication.other.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_c')->first()->myra2_benchmark_target ?? 0);
            $bar9_3 = $bar9_2*2;
            array_push($year_range, ['UTM', (int)$i]);
            array_push($bar_1->data_1, $bar1_1);
            array_push($bar_1->data_2, $bar1_2);
            array_push($bar_1->data_3, $bar1_3);
            array_push($bar_2->data_1, $bar2_1);
            array_push($bar_2->data_2, $bar2_2);
            array_push($bar_3->data_1, $bar3_1);
            array_push($bar_3->data_2, $bar3_2);
            array_push($bar_3->data_3, $bar3_3);
            array_push($bar_4->data_1, $bar4_1);
            array_push($bar_4->data_2, $bar4_2);
            array_push($bar_4->data_3, $bar4_3);
            array_push($bar_5->data_1, $bar5_1);
            array_push($bar_5->data_2, $bar5_2);
            array_push($bar_5->data_3, $bar5_3);
            array_push($bar_6->data_1, $bar6_1);
            array_push($bar_6->data_2, $bar6_2);
            array_push($bar_6->data_3, $bar6_3);
            array_push($bar_7->data_1, $bar7_1);
            array_push($bar_7->data_2, $bar7_2);
            array_push($bar_7->data_3, $bar7_3);
            array_push($bar_8->data_1, $bar8_1);
            array_push($bar_8->data_2, $bar8_2);
            array_push($bar_8->data_3, $bar8_3);
            array_push($bar_9->data_1, $bar9_1);
            array_push($bar_9->data_2, $bar9_2);
            array_push($bar_9->data_3, $bar9_3);
        }

        return (object)[
            'year_range' => $year_range,
            'bar_1' => $bar_1,
            'bar_2' => $bar_2,
            'bar_3' => $bar_3,
            'bar_4' => $bar_4,
            'bar_5' => $bar_5,
            'bar_6' => $bar_6,
            'bar_7' => $bar_7,
            'bar_8' => $bar_8,
            'bar_9' => $bar_9,
        ];
    }

    public function sectionD_data_A($start_year, $end_year) {
        $year_range = []; 
        $line_1 = (object)[  //PhD: GRADUATED & GOT
            'data_1' => [],
            'data_2' => [],
        ];
        $bar_1 = (object)[  //RATIO PhD GRADUATED TO ACTIVE STAFF
            'data_1' => [],
            'data_2' => [],
        ];
        $bar_2 = (object)[  //% OF PhD GRADUATED ON TIME
            'data_1' => [],
            'data_2' => [],
        ];
        $bar_3 = (object)[  //RATIO PhD ENROLLED TO ACTIVE STAFF
            'data_1' => [],
            'data_2' => [],
        ];
        $bar_4 = (object)[  //RATIO POSTGRADUATE ENROLLED TO ACTIVE STAFF
            'data_1' => [],
            'data_2' => [],
        ];
        // $test = MasterlistPhdGraduate::select('got')->distinct()->get()->toArray();
        // dd($test);
        for ($i=($end_year-$start_year <= 0?$end_year:$start_year); $i <= $end_year; $i++) { 
            $active_acad_staff = MasterlistAcademicStaff::where('ml_end_year', $i)->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
            $line1_1 = MasterlistPhdGraduate::where('ml_end_year', $i)->count();
            $line1_2 = MasterlistPhdGraduate::where('ml_end_year', $i)->whereIn('got', $this->got('yes'))->count();
            $bar1_1 = $active_acad_staff > 0 ? (float)$line1_1/$active_acad_staff  : 0;
            $bar1_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.phd_graduate.ratio_phd_staff.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_d')->first();
            $phd_graduate_7 = MasterlistPhdGraduate::where('ml_end_year', $i)->where('study_duration', '<=', 42)->count();
            $bar2_1 =$line1_1 > 0 ? (float)number_format($phd_graduate_7/$line1_1*100, 2) : 0;
            $bar2_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.phd_graduate.percent_phd_7_sem.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_d')->first();
            $bar3_1 = $active_acad_staff > 0 ? MasterlistPhdEnroll::where('ml_end_year', $i)->count()/$active_acad_staff  : 0;
            $bar3_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.phd_enrolled.ratio_phd_staff.myra1_benchmark_target')as myra1_benchmark_target")])->where('year', $i)->whereType('section_d')->first();
            $bar4_1 = $active_acad_staff > 0 ? MasterlistPgStudent::where('ml_end_year', $i)->count()/$active_acad_staff  : 0;
            $bar4_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.pg_enrolled.ratio_staff.myra1_benchmark_target')as myra1_benchmark_target")])->where('year', $i)->whereType('section_d')->first();

            array_push($year_range, (int)$i);
            array_push($line_1->data_1, $line1_1);
            array_push($line_1->data_2, $line1_2);
            array_push($bar_1->data_1, (float)number_format($bar1_1, 2));
            array_push($bar_1->data_2, $active_acad_staff > 0 ? number_format((int)($bar1_2->myra2_benchmark_target ?? 0)/$active_acad_staff, 2)  : 0);
            array_push($bar_2->data_1, (float)number_format($bar2_1, 2));
            array_push($bar_2->data_2, $line1_1 > 0 ? number_format((int)($bar2_2->myra2_benchmark_target ?? 0)/$line1_1*100, 2)  : 0);
            array_push($bar_3->data_1, (float)number_format($bar3_1, 2));
            array_push($bar_3->data_2, $active_acad_staff > 0 ? number_format((int)($bar3_2->myra1_benchmark_target ?? 0)/$active_acad_staff, 2)  : 0);
            array_push($bar_4->data_1, (float)number_format($bar4_1, 2));
            array_push($bar_4->data_2, $active_acad_staff > 0 ? number_format((int)($bar4_2->myra1_benchmark_target ?? 0)/$active_acad_staff, 2)  : 0);
        }

        return (object)[
            'year_range' => $year_range,
            'line_1' => $line_1,
            'bar_1' => $bar_1,
            'bar_2' => $bar_2,
            'bar_3' => $bar_3,
            'bar_4' => $bar_4,
        ];
    }

    public function sectionD_data_E($start_year, $end_year) {
        $year_range = []; 
        $bar_1 = (object)[ 
            'data_1' => [],
            'data_2' => [],
        ];
        $bar_2 = (object)[ 
            'data_1' => [],
            'data_2' => [],
        ];
        $bar_3 = (object)[  
            'data_1' => [],
            'data_2' => [],
        ];
        $bar_4 = (object)[  
            'data_1' => [],
            'data_2' => [],
        ];
        // $test = MasterlistPhdGraduate::select('got')->distinct()->get()->toArray();
        // dd($test);
        for ($i=($end_year-$start_year <= 0?$end_year:$start_year); $i <= $end_year; $i++) { 
            $pg_enrolled = MasterlistPgStudent::where('ml_end_year', $i)->count();
            $int_pg_enrolled = MasterlistPgStudent::where('ml_end_year', $i)->whereIn('citizenship', $this->filter_citizenship('foreign'))->count();
            $bar1_1 = $pg_enrolled > 0 ? (float)number_format($int_pg_enrolled/$pg_enrolled*100, 2) : 0;
            $bar1_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.pg_international.percentage_enrolled.myra1_benchmark_target')as myra1_benchmark_target")])->where('year', $i)->whereType('section_d')->first();
            $bar2_1 = $pg_enrolled > 0 ? (float)number_format(MasterlistEntryQualification::where('ml_end_year', $i)->count()/$pg_enrolled*100, 2) : 0;
            $bar2_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.pg_entry.percentage_enrolled.myra1_benchmark_target')as myra1_benchmark_target")])->where('year', $i)->whereType('section_d')->first();
            $pg_research = MasterlistPgStudent::where('ml_end_year', $i)->whereIn('study_mode', ['RESEARCH', 'PENYELIDIKAN', 'MIXED MODE', 'K KUR & PENYELIDIKAN'])->count();
            $bar3_1 = $pg_enrolled > 0 ? (float)number_format($pg_research/$pg_enrolled*100, 2) : 0;
            $bar3_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.pg_research.percentage_enrolled.myra1_benchmark_target')as myra1_benchmark_target")])->where('year', $i)->whereType('section_d')->first();
            $bar4_1 = MasterlistPostDoc::where('ml_end_year', $i)->count();
            $bar4_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.postdoc.percentage_enrolled.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_d')->first();
            array_push($year_range, (int)$i);
            array_push($bar_1->data_1, (float)number_format($bar1_1, 2));
            array_push($bar_1->data_2, $pg_enrolled > 0 ? number_format((int)($bar1_2->myra1_benchmark_target ?? 0)/$pg_enrolled*100, 2)  : 0);
            array_push($bar_2->data_1, (float)number_format($bar2_1, 2));
            array_push($bar_2->data_2, $pg_enrolled > 0 ? number_format((int)($bar2_2->myra1_benchmark_target ?? 0)/$pg_enrolled*100, 2)  : 0);
            array_push($bar_3->data_1, (float)number_format($bar3_1, 2));
            array_push($bar_3->data_2, $pg_enrolled > 0 ? number_format((int)($bar3_2->myra1_benchmark_target ?? 0)/$pg_research*100, 2)  : 0);
            array_push($bar_4->data_1, (int)$bar4_1);
            array_push($bar_4->data_2, (int)($bar4_2->myra2_benchmark_target ?? 0));

        }

        return (object)[
            'year_range' => $year_range,
            'bar_1' => $bar_1,
            'bar_2' => $bar_2,
            'bar_3' => $bar_3,
            'bar_4' => $bar_4,
        ];
    }

    public function sectionE_data($start_year, $end_year) {
        $year_range = []; 
        $bar_1 = (object)[ 
            'data_1' => [],
            'data_2' => [],
        ];
        $bar_2 = (object)[ 
            'data_1' => [],
            'data_2' => [],
        ];
        $bar_3 = (object)[  
            'data_1' => [],
            'data_2' => [],
        ];
        $bar_4 = (object)[  
            'data_1' => [],
            'data_2' => [],
        ];
        $bar_5 = (object)[  
            'data_1' => [],
            'data_2' => [],
        ];

        for ($i=($end_year-$start_year <= 0?$end_year:$start_year); $i <= $end_year; $i++) { 
            $bar1_1 = MasterlistPatentGrant::where('ml_end_year', $i)->count();
            $bar1_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.patent.granted.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_e')->first();
            $bar2_1 = MasterlistPatentFile::where('ml_end_year', $i)->count();
            $bar2_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.patent.filed.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_e')->first();
            $bar3_1 = MasterlistOtherIpr::where('ml_end_year', $i)->count();
            $bar3_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.other_ipr.total.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_e')->first();
            $bar4_1 = MasterlistCommProduct::where('ml_end_year', $i)->count();
            $bar4_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.commercialized_product.total.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_e')->first();
            $bar5_1 = MasterlistKnowHowSold::where('ml_end_year', $i)->count();
            $bar5_2 = MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.tech_know_how.total.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_e')->first();
            array_push($year_range, (int)$i);
            array_push($bar_1->data_1, (int)$bar1_1);
            array_push($bar_1->data_2, (int)($bar1_2->myra2_benchmark_target ?? 0));
            array_push($bar_2->data_1, (int)$bar2_1);
            array_push($bar_2->data_2, (int)($bar2_2->myra2_benchmark_target ?? 0));
            array_push($bar_3->data_1, (int)$bar3_1);
            array_push($bar_3->data_2, (int)($bar3_2->myra2_benchmark_target ?? 0));
            array_push($bar_4->data_1, (int)$bar4_1);
            array_push($bar_4->data_2, (int)($bar4_2->myra2_benchmark_target ?? 0));
            array_push($bar_5->data_1, (int)$bar5_1);
            array_push($bar_5->data_2, (int)($bar5_2->myra2_benchmark_target ?? 0));
        }

        return (object)[
            'year_range' => $year_range,
            'bar_1' => $bar_1,
            'bar_2' => $bar_2,
            'bar_3' => $bar_3,
            'bar_4' => $bar_4,
            'bar_5' => $bar_5,
        ];
    }

    public function sectionF_data_I($start_year, $end_year) {
        $year_range = []; 

        for ($i=($end_year-$start_year <= 0?$end_year:$start_year); $i <= $end_year; $i++) { 
            array_push($year_range, (int)$i);
        }

        return (object)[
            'year_range' => $year_range,
        ];
    }

    public function sectionF_data_P($start_year, $end_year) {
        $year_range = []; 

        for ($i=($end_year-$start_year <= 0?$end_year:$start_year); $i <= $end_year; $i++) { 
            array_push($year_range, (int)$i);
        }

        return (object)[
            'year_range' => $year_range,
        ];
    }

    public function sectionF_data_C($start_year, $end_year) {
        $year_range = []; 

        for ($i=($end_year-$start_year <= 0?$end_year:$start_year); $i <= $end_year; $i++) { 
            array_push($year_range, (int)$i);
        }

        return (object)[
            'year_range' => $year_range,
        ];
    }

    public function sectionG_data($start_year, $end_year) {
        $year_range = []; 

        for ($i=($end_year-$start_year <= 0?$end_year:$start_year); $i <= $end_year; $i++) { 
            array_push($year_range, (int)$i);
        }

        return (object)[
            'year_range' => $year_range,
        ];
    }
}
