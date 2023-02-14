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

    public function overview_data($request_data) {
        $year_range = []; 
        $line_1 = (object)[ //TOTAL
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
            'data_4' => [],
        ];
        $line_2 = (object)[ //SECTION B
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
            'data_4' => [],
        ]; 
        $line_3 = (object)[ //SECTION C
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
            'data_4' => [],
        ]; 
        $line_4 = (object)[ //SECTION D
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
            'data_4' => [],
        ]; 
        $line_5 = (object)[ //SECTION E
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
            'data_4' => [],
        ]; 
        $line_6 = (object)[ //SECTION F
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
            'data_4' => [],
        ]; 
        $line_7 = (object)[ //SECTION G
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
            'data_4' => [],
        ]; 
        $line_8 = (object)[ //SECTION H
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
            'data_4' => [],
        ]; 
        for ($i=($request_data->end_year-$request_data->start_year <= 0?$request_data->end_year:$request_data->start_year); $i <= $request_data->end_year; $i++) { 
            
            $section_b_data = $this->myraSectionB($i, $request_data->faculty, $request_data->school);
            $section_c_data = $this->myraSectionC($i, $request_data->faculty, $request_data->school);
            $section_d_data = $this->myraSectionD($i, $request_data->faculty, $request_data->school);
            $section_e_data = $this->myraSectionE($i, $request_data->faculty, $request_data->school);
            $section_f_data = $this->myraSectionF($i, $request_data->faculty, $request_data->school);
            $section_g_data = $this->myraSectionG($i, $request_data->faculty, $request_data->school);
            $section_h_data = $this->myraSectionH($i, $request_data->faculty, $request_data->school);
            $section_b = (object)['myra1_mark'=>$section_b_data->calculation->total_myra1_mark,'myra2_mark'=>$section_b_data->calculation->total_myra2_mark, 'myra1_benchmark_mark'=>$section_b_data->calculation->total_myra1_benchmark_mark,'myra2_benchmark_mark'=>$section_b_data->calculation->total_myra2_benchmark_mark];
            $section_c = (object)['myra1_mark'=>$section_c_data->calculation->total_myra1_mark,'myra2_mark'=>$section_c_data->calculation->total_myra2_mark, 'myra1_benchmark_mark'=>$section_c_data->calculation->total_myra1_benchmark_mark,'myra2_benchmark_mark'=>$section_c_data->calculation->total_myra2_benchmark_mark];
            $section_d = (object)['myra1_mark'=>$section_d_data->calculation->total_myra1_mark,'myra2_mark'=>$section_d_data->calculation->total_myra2_mark, 'myra1_benchmark_mark'=>$section_d_data->calculation->total_myra1_benchmark_mark,'myra2_benchmark_mark'=>$section_d_data->calculation->total_myra2_benchmark_mark];
            $section_e = (object)['myra1_mark'=>$section_e_data->calculation->total_myra1_mark,'myra2_mark'=>$section_e_data->calculation->total_myra2_mark, 'myra1_benchmark_mark'=>$section_e_data->calculation->total_myra1_benchmark_mark,'myra2_benchmark_mark'=>$section_e_data->calculation->total_myra2_benchmark_mark];
            $section_f = (object)['myra1_mark'=>$section_f_data->calculation->total_myra1_mark,'myra2_mark'=>$section_f_data->calculation->total_myra2_mark, 'myra1_benchmark_mark'=>$section_f_data->calculation->total_myra1_benchmark_mark,'myra2_benchmark_mark'=>$section_f_data->calculation->total_myra2_benchmark_mark];
            $section_g = (object)['myra1_mark'=>$section_g_data->calculation->total_myra1_mark,'myra2_mark'=>$section_g_data->calculation->total_myra2_mark, 'myra1_benchmark_mark'=>$section_g_data->calculation->total_myra1_benchmark_mark,'myra2_benchmark_mark'=>$section_g_data->calculation->total_myra2_benchmark_mark];
            $section_h = (object)['myra1_mark'=>$section_h_data->calculation->total_myra1_mark,'myra2_mark'=>$section_h_data->calculation->total_myra2_mark, 'myra1_benchmark_mark'=>$section_h_data->calculation->total_myra1_benchmark_mark,'myra2_benchmark_mark'=>$section_h_data->calculation->total_myra2_benchmark_mark];
            // dd($section_b_data);
            $total_myra1 = ($section_b->myra1_mark ?? 0) + ($section_c->myra1_mark ?? 0) + ($section_d->myra1_mark ?? 0) + ($section_e->myra1_mark ?? 0) + ($section_f->myra1_mark ?? 0) + ($section_g->myra1_mark ?? 0) + ($section_h->myra1_mark ?? 0);
            $total_myra2 = ($section_b->myra2_mark ?? 0) + ($section_c->myra2_mark ?? 0) + ($section_d->myra2_mark ?? 0) + ($section_e->myra2_mark ?? 0) + ($section_f->myra2_mark ?? 0) + ($section_g->myra2_mark ?? 0) + ($section_h->myra2_mark ?? 0);
            $total_myra1_benchmark_mark = ($section_b->myra1_benchmark_mark ?? 0) + ($section_c->myra1_benchmark_mark ?? 0) + ($section_d->myra1_benchmark_mark ?? 0) + ($section_e->myra1_benchmark_mark ?? 0) + ($section_f->myra1_benchmark_mark ?? 0) + ($section_g->myra1_benchmark_mark ?? 0) + ($section_h->myra1_benchmark_mark ?? 0);
            $total_myra2_benchmark_mark = ($section_b->myra2_benchmark_mark ?? 0) + ($section_c->myra2_benchmark_mark ?? 0) + ($section_d->myra2_benchmark_mark ?? 0) + ($section_e->myra2_benchmark_mark ?? 0) + ($section_f->myra2_benchmark_mark ?? 0) + ($section_g->myra2_benchmark_mark ?? 0) + ($section_h->myra2_benchmark_mark ?? 0);
            
            $percent_myra1_b = ($section_b->myra1_benchmark_mark ?? 0) > 0 ? ($section_b->myra1_mark ?? 0)/($section_b->myra1_benchmark_mark ?? 0)*100:0;
            $percent_myra2_b = ($section_b->myra2_benchmark_mark ?? 0) > 0 ? ($section_b->myra2_mark ?? 0)/($section_b->myra2_benchmark_mark ?? 0)*100:0;
            $percent_myra1_c = ($section_c->myra1_benchmark_mark ?? 0) > 0 ? ($section_c->myra1_mark ?? 0)/($section_c->myra1_benchmark_mark ?? 0)*100:0;
            $percent_myra2_c = ($section_c->myra2_benchmark_mark ?? 0) > 0 ? ($section_c->myra2_mark ?? 0)/($section_c->myra2_benchmark_mark ?? 0)*100:0;
            $percent_myra1_d = ($section_d->myra1_benchmark_mark ?? 0) > 0 ? ($section_d->myra1_mark ?? 0)/($section_d->myra1_benchmark_mark ?? 0)*100:0;
            $percent_myra2_d = ($section_d->myra2_benchmark_mark ?? 0) > 0 ? ($section_d->myra2_mark ?? 0)/($section_d->myra2_benchmark_mark ?? 0)*100:0;
            $percent_myra1_e = ($section_e->myra1_benchmark_mark ?? 0) > 0 ? ($section_e->myra1_mark ?? 0)/($section_e->myra1_benchmark_mark ?? 0)*100:0;
            $percent_myra2_e = ($section_e->myra2_benchmark_mark ?? 0) > 0 ? ($section_e->myra2_mark ?? 0)/($section_e->myra2_benchmark_mark ?? 0)*100:0;
            $percent_myra1_f = ($section_f->myra1_benchmark_mark ?? 0) > 0 ? ($section_f->myra1_mark ?? 0)/($section_f->myra1_benchmark_mark ?? 0)*100:0;
            $percent_myra2_f = ($section_f->myra2_benchmark_mark ?? 0) > 0 ? ($section_f->myra2_mark ?? 0)/($section_f->myra2_benchmark_mark ?? 0)*100:0;
            $percent_myra1_g = ($section_g->myra1_benchmark_mark ?? 0) > 0 ? ($section_g->myra1_mark ?? 0)/($section_g->myra1_benchmark_mark ?? 0)*100:0;
            $percent_myra2_g = ($section_g->myra2_benchmark_mark ?? 0) > 0 ? ($section_g->myra2_mark ?? 0)/($section_g->myra2_benchmark_mark ?? 0)*100:0;
            $percent_myra1_h = ($section_h->myra1_benchmark_mark ?? 0) > 0 ? ($section_h->myra1_mark ?? 0)/($section_h->myra1_benchmark_mark ?? 0)*100:0;
            $percent_myra2_h = ($section_h->myra2_benchmark_mark ?? 0) > 0 ? ($section_h->myra2_mark ?? 0)/($section_h->myra2_benchmark_mark ?? 0)*100:0;

            $benchmark_mark_myra1_b = $section_b->myra1_benchmark_mark ?? 0;
            $benchmark_mark_myra2_b = $section_b->myra2_benchmark_mark ?? 0;
            $benchmark_mark_myra1_c = $section_c->myra1_benchmark_mark ?? 0;
            $benchmark_mark_myra2_c = $section_c->myra2_benchmark_mark ?? 0;
            $benchmark_mark_myra1_d = $section_d->myra1_benchmark_mark ?? 0;
            $benchmark_mark_myra2_d = $section_d->myra2_benchmark_mark ?? 0;
            $benchmark_mark_myra1_e = $section_e->myra1_benchmark_mark ?? 0;
            $benchmark_mark_myra2_e = $section_e->myra2_benchmark_mark ?? 0;
            $benchmark_mark_myra1_f = $section_f->myra1_benchmark_mark ?? 0;
            $benchmark_mark_myra2_f = $section_f->myra2_benchmark_mark ?? 0;
            $benchmark_mark_myra1_g = $section_g->myra1_benchmark_mark ?? 0;
            $benchmark_mark_myra2_g = $section_g->myra2_benchmark_mark ?? 0;
            $benchmark_mark_myra1_h = $section_h->myra1_benchmark_mark ?? 0;
            $benchmark_mark_myra2_h = $section_h->myra2_benchmark_mark ?? 0;

            array_push($year_range, (int)$i);
            array_push($line_1->data_1, (float)number_format(($total_myra1), 2));
            array_push($line_1->data_2, (float)number_format(($total_myra2), 2));
            array_push($line_1->data_3, (float)number_format(($total_myra1_benchmark_mark), 2));
            array_push($line_1->data_4, (float)number_format(($total_myra2_benchmark_mark), 2));
            array_push($line_2->data_1, (float)number_format(($percent_myra1_b ?? 0), 2));
            array_push($line_2->data_2, (float)number_format(($percent_myra2_b ?? 0), 2));
            array_push($line_2->data_3, (float)number_format(($benchmark_mark_myra1_b ?? 0), 2));
            array_push($line_2->data_4, (float)number_format(($benchmark_mark_myra2_b ?? 0), 2));
            array_push($line_3->data_1, (float)number_format(($percent_myra1_c ?? 0), 2));
            array_push($line_3->data_2, (float)number_format(($percent_myra2_c ?? 0), 2));
            array_push($line_3->data_3, (float)number_format(($benchmark_mark_myra1_c ?? 0), 2));
            array_push($line_3->data_4, (float)number_format(($benchmark_mark_myra2_c ?? 0), 2));
            array_push($line_4->data_1, (float)number_format(($percent_myra1_d ?? 0), 2));
            array_push($line_4->data_2, (float)number_format(($percent_myra2_d ?? 0), 2));
            array_push($line_4->data_3, (float)number_format(($benchmark_mark_myra1_d ?? 0), 2));
            array_push($line_4->data_4, (float)number_format(($benchmark_mark_myra2_d ?? 0), 2));
            array_push($line_5->data_1, (float)number_format(($percent_myra1_e ?? 0), 2));
            array_push($line_5->data_2, (float)number_format(($percent_myra2_e ?? 0), 2));
            array_push($line_5->data_3, (float)number_format(($benchmark_mark_myra1_e ?? 0), 2));
            array_push($line_5->data_4, (float)number_format(($benchmark_mark_myra2_e ?? 0), 2));
            array_push($line_6->data_1, (float)number_format(($percent_myra1_f ?? 0), 2));
            array_push($line_6->data_2, (float)number_format(($percent_myra2_f ?? 0), 2));
            array_push($line_6->data_3, (float)number_format(($benchmark_mark_myra1_f ?? 0), 2));
            array_push($line_6->data_4, (float)number_format(($benchmark_mark_myra2_f ?? 0), 2));
            array_push($line_7->data_1, (float)number_format(($percent_myra1_g ?? 0), 2));
            array_push($line_7->data_2, (float)number_format(($percent_myra2_g ?? 0), 2));
            array_push($line_7->data_3, (float)number_format(($benchmark_mark_myra1_g ?? 0), 2));
            array_push($line_7->data_4, (float)number_format(($benchmark_mark_myra2_g ?? 0), 2));
            array_push($line_8->data_1, (float)number_format(($percent_myra1_h ?? 0), 2));
            array_push($line_8->data_2, (float)number_format(($percent_myra2_h ?? 0), 2));
            array_push($line_8->data_3, (float)number_format(($benchmark_mark_myra1_h ?? 0), 2));
            array_push($line_8->data_4, (float)number_format(($benchmark_mark_myra2_h ?? 0), 2));

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

    public function staff_data($request_data) {
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
            'data_2' => [],
        ];
        $line_2 = (object)[ //foreign staff
            'data_1' => [],
        ];
        $bar_3 = (object)[ //country
            'data_1' => [],
        ];
        for ($i=($request_data->end_year-$request_data->start_year <= 0?$request_data->end_year:$request_data->start_year); $i <= $request_data->end_year; $i++) {
            $bar1_1 = MasterlistAcademicStaff::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('status1', $this->status_active('active'))->whereIn('position',$this->staff_position('prof'))->count();
            $bar1_2 = MasterlistAcademicStaff::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('status1', $this->status_active('active'))->whereIn('position',$this->staff_position('assoc_prof'))->count();
            $bar1_3 = MasterlistAcademicStaff::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('status1', $this->status_active('active'))->whereIn('position',$this->staff_position('senior_lecturer'))->count();
            $bar1_4 = MasterlistAcademicStaff::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('status1', $this->status_active('active'))->whereIn('position',$this->staff_position('lecturer'))->count();
            $bar1_5 = MasterlistAcademicStaff::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('status1', $this->status_active('active'))->whereIn('position',$this->staff_position('research_fellow'))->count();
            $bar2_1 = MasterlistAcademicStaff::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('status1', $this->status_active('active'))->where('age', '>', 50)->count();
            $bar2_2 = MasterlistAcademicStaff::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('status1', $this->status_active('active'))->where('age', '>=', 40)->where('age', '<=', 50)->count();
            $bar2_3 = MasterlistAcademicStaff::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('status1', $this->status_active('active'))->where('age', '<', 40)->count();
            $line1_1 = MasterlistAcademicStaff::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->count();
            $line1_2 = MasterlistAcademicStaff::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('status1', $this->status_active('active'))->count();
            $line2 = MasterlistAcademicStaff::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('status1', $this->status_active('active'))->whereIn('citizenship', $this->filter_citizenship('foreign'))->count();
            
            array_push($year_range, (int)$i);
            array_push($bar_1->data_1, $bar1_1);
            array_push($bar_1->data_2, $bar1_2);
            array_push($bar_1->data_3, $bar1_3);
            array_push($bar_1->data_4, $bar1_4);
            array_push($bar_1->data_5, $bar1_5);
            array_push($bar_2->data_1, $bar2_1);
            array_push($bar_2->data_2, $bar2_2);
            array_push($bar_2->data_3, $bar2_3);
            array_push($line_1->data_1, $line1_1);
            array_push($line_1->data_2, $line1_2);
            array_push($line_2->data_1, $line2);
        }
        $country_queries = [];
        $country_labels = [];
        $countries = [];

        $countryRaws = MasterlistAcademicStaff::select('country')->where('ml_end_year', '>=', $request_data->start_year)->where(function ($q) use ($request_data) {if($request_data->faculty)$q->where('faculty_code', $request_data->faculty);})->where('ml_end_year', '<=', $request_data->end_year)->orderBy('country')->whereIn('status1', $this->status_active('active'))->whereIn('citizenship',$this->filter_citizenship('foreign'))->distinct()->get();
        foreach ($countryRaws as $key => $countryRaw) {
            $country = $this->country_code_label($countryRaw->country);
            array_push($country_queries, $country);
            array_push($country_labels, $country['label']);
        }
        
        $country_queries = array_unique($country_queries, SORT_REGULAR);
        $country_labels = array_unique($country_labels);
        // dd($country_queries);
        $total_country_cumulative = 0;
        foreach ($country_queries as $key => $value) {
            $country_data = MasterlistAcademicStaff::where('ml_end_year', '>=', $request_data->start_year)->select('staff_id')->where(function ($q) use ($request_data) {if($request_data->faculty)$q->where('faculty_code', $request_data->faculty);})->where('ml_end_year', '<=', $request_data->end_year)
            ->whereIn('status1', $this->status_active('active'))->whereIn('citizenship', $this->filter_citizenship('foreign'))->whereIn('country', $value)->distinct()->count();
            array_push($bar_3->data_1, $country_data);
            $total_country_cumulative += $country_data;
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
            'total_country_cumulative' => $total_country_cumulative
        ];
    }

    public function student_data($request_data) {
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
        for ($i=($request_data->end_year-$request_data->start_year <= 0?$request_data->end_year:$request_data->start_year); $i <= $request_data->end_year; $i++) {
            // $line1_1 = ;
            $line1_1 = MasterlistPgStudent::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('degree_registered_for', $this->student_degree('master'))->whereIn('study_mode', $this->student_study_mode('research'))->count();
            $line1_2 = MasterlistPgStudent::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('degree_registered_for', $this->student_degree('master'))->whereIn('study_mode', $this->student_study_mode('coursework'))->count();
            $line1_3 = MasterlistPgStudent::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('degree_registered_for', $this->student_degree('phd'))->count();
            $line1_4 = MasterlistPgStudent::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('degree_registered_for', $this->student_degree('doctoral'))->whereIn('study_mode', $this->student_study_mode('coursework'))->count();
            $bar1_1 = MasterlistPgStudent::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('degree_registered_for', $this->student_degree('master'))->whereIn('study_mode', $this->student_study_mode('research'))->whereIn('citizenship', $this->filter_citizenship('foreign'))->count();
            $bar1_2 = MasterlistPgStudent::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('degree_registered_for', $this->student_degree('master'))->whereIn('study_mode', $this->student_study_mode('research'))->whereIn('citizenship', $this->filter_citizenship('local'))->count();
            $bar1_3 = MasterlistPgStudent::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('degree_registered_for', $this->student_degree('phd'))->whereIn('citizenship', $this->filter_citizenship('foreign'))->count();
            $bar1_4 = MasterlistPgStudent::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('degree_registered_for', $this->student_degree('phd'))->whereIn('citizenship', $this->filter_citizenship('local'))->count();
            $bar3_1 = MasterlistUgStudent::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->count();
            $bar3_2 = MasterlistPgStudent::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->count();
            
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
        $studyAreaRaws = MasterlistPgStudent::select('study_area')->orderBy('study_area')->distinct()->get();
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
            $study_area_data = MasterlistPgStudent::select('matric_no')->where(function ($q) use ($request_data) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}})->where('ml_end_year','>=', $request_data->start_year)->where('ml_end_year','<=', $request_data->end_year)->whereIn('study_area', $value)->distinct()->count();
            
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

    public function sectionB_data_PI($request_data) {
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

        for ($i=($request_data->end_year-$request_data->start_year <= 0?$request_data->end_year:$request_data->start_year); $i <= $request_data->end_year; $i++) { 
            
            $section_b_data = $this->myraSectionB($i, $request_data->faculty, $request_data->school);
            // dd((int)$section_b_data->calculation->myra2_benchmark_target_1[1]);
            $line1_1 = $section_b_data->active_staff;
            $line1_2 = $section_b_data->calculation->active_acad_staff - $line1_1;
            $line2_1 = $section_b_data->international_staff;
            $line2_2 = $section_b_data->national_staff;
            $line2_3 = $section_b_data->uni_staff;
            $line2_4 = $section_b_data->private_staff;
            $bar1_1 = $section_b_data->international_staff;
            $bar1_2 = (int)($section_b_data->calculation->myra2_benchmark_target_1[4] ?? 0);
            $bar2_1 = $section_b_data->national_staff;
            $bar2_2 = (int)($section_b_data->calculation->myra2_benchmark_target_1[2] ?? 0);
            $bar3_1 = $section_b_data->uni_staff;
            $bar3_2 = (int)($section_b_data->calculation->myra2_benchmark_target_1[1] ?? 0);
            $bar4_1 = $section_b_data->private_staff;
            $bar4_2 = (int)($section_b_data->calculation->myra2_benchmark_target_1[3] ?? 0);
            
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

    public function sectionB_data_QC($request_data) {
        $year_range = [];
        $bar_1 = (object)[  //COHORT
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
            'data_4' => [],
            'data_5' => [],
            'data_6' => [],
        ];
        $bar_2 = (object)[ //PhD
            'data_1' => [],
            'data_2' => [],
        ]; 
        $bar_3 = (object)[ //PRO
            'data_1' => [],
            'data_2' => [],
        ]; 

        for ($i=($request_data->end_year-$request_data->start_year <= 0?$request_data->end_year:$request_data->start_year); $i <= $request_data->end_year; $i++) { 
            $section_b_data = $this->myraSectionB($i, $request_data->faculty, $request_data->school);
            
            $bar1_1 = $section_b_data->b40;
            $bar1_2 = $section_b_data->a40;
            $bar1_3 = $section_b_data->a50;
            $total_cohort = $bar1_1 + $bar1_2 + $bar1_3;
            $bar1_4 = $total_cohort > 0 ? (float)number_format($bar1_1/$total_cohort*100, 2, '.', '') : 0;
            $bar1_5 = $total_cohort > 0 ? (float)number_format($bar1_2/$total_cohort*100, 2, '.', '') : 0;
            $bar1_6 = $total_cohort > 0 ? (float)number_format($bar1_3/$total_cohort*100, 2, '.', '') : 0;
            $bar2_1 = $section_b_data->phd;
            $bar2_2 = (int)($section_b_data->calculation->myra2_benchmark_target_2[0] ?? 0);
            $bar3_1 = $section_b_data->pro;
            $bar3_2 = (int)($section_b_data->calculation->myra2_benchmark_target_2[1] ?? 0);
            array_push($year_range, (int)$i);
            array_push($bar_1->data_1, $bar1_1);
            array_push($bar_1->data_2, $bar1_2);
            array_push($bar_1->data_3, $bar1_3);
            array_push($bar_1->data_4, $bar1_4);
            array_push($bar_1->data_5, $bar1_5);
            array_push($bar_1->data_6, $bar1_6);
            array_push($bar_2->data_1, $bar2_1);
            array_push($bar_2->data_2, $bar2_2);
            array_push($bar_3->data_1, $bar3_1);
            array_push($bar_3->data_2, $bar3_2);
        }

        return (object)[
            'year_range' => $year_range,
            'bar_1' => $bar_1,
            'bar_2' => $bar_2,
            'bar_3' => $bar_3,
        ];
    }

    public function sectionB_data_A($request_data) {
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

        for ($i=($request_data->end_year-$request_data->start_year <= 0?$request_data->end_year:$request_data->start_year); $i <= $request_data->end_year; $i++) { 
            $section_b_data = $this->myraSectionB($i, $request_data->faculty, $request_data->school);

            $bar1_1 = $section_b_data->award_int;
            $bar1_2 = (int)($section_b_data->calculation->myra2_benchmark_target_4[0] ?? 0);
            $bar2_1 = $section_b_data->recog_int;
            $bar2_2 = (int)($section_b_data->calculation->myra2_benchmark_target_4[1] ?? 0);
            $bar3_1 = $section_b_data->award_nat;
            $bar3_2 = (int)($section_b_data->calculation->myra2_benchmark_target_4[2] ?? 0);
            $bar4_1 = $section_b_data->recog_nat;
            $bar4_2 = (int)($section_b_data->calculation->myra2_benchmark_target_4[3] ?? 0);
            $bar5_1 = $section_b_data->exhibition;
            $bar5_2 = (int)($section_b_data->calculation->myra1_benchmark_target_4[4] ?? 0);
            $bar6_1 = $section_b_data->other;
            $bar6_2 = (int)($section_b_data->calculation->myra1_benchmark_target_4[5] ?? 0);
        
            array_push($year_range, (int)$i);
            array_push($bar_1->data_1, $bar1_1);
            array_push($bar_1->data_2, $bar1_2);
            array_push($bar_2->data_1, $bar2_1);
            array_push($bar_2->data_2, $bar2_2);
            array_push($bar_3->data_1, $bar3_1);
            array_push($bar_3->data_2, $bar3_2);
            array_push($bar_4->data_1, $bar4_1);
            array_push($bar_4->data_2, $bar4_2);
            array_push($bar_5->data_1, $bar5_1);
            array_push($bar_5->data_2, $bar5_2);
            array_push($bar_6->data_1, $bar6_1);
            array_push($bar_6->data_2, $bar6_2);
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

    public function sectionC_data_P($request_data) {
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
        $bar_4 = (object)[  //MyCite
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
        $bar_10= (object)[  //citation
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ];
        for ($i=($request_data->end_year-$request_data->start_year <= 0?$request_data->end_year:$request_data->start_year); $i <= $request_data->end_year; $i++) { 
            $section_c_data = $this->myraSectionC($i, $request_data->faculty, $request_data->school);
            $data = $section_c_data->calculation;
            $bar1_1 = $section_c_data->journal;
            $bar1_2 = (int)($data->myra2_benchmark_target_1[0] ?? 0);
            $bar1_3 = $bar1_2*2;
            $bar2_1 = $section_c_data->q1_q2;
            $bar2_2 = $bar1_1;
            $bar3_1 = $section_c_data->proceeding;
            $bar3_2 = (int)($data->myra2_benchmark_target_1[1] ?? 0);
            $bar3_3 = $bar3_2*2;
            $bar4_1 = $section_c_data->mycite;
            $bar4_2 = $i <= 2018 ? 0 : (int)($data->myra2_benchmark_target_1[7] ?? 0);
            $bar4_3 = $bar4_2*2;
            $bar5_1 = $section_c_data->book;
            $bar5_2 = $i <= 2018 ? $data->myra2_benchmark_target_1[8] : (int)(($data->myra2_benchmark_target_1[8] ?? 0)+($data->myra2_benchmark_target_1[9] ?? 0));
            $bar5_3 = $bar5_2*2;
            $bar6_1 = $section_c_data->chapter;
            $bar6_2 = $i <= 2018 ? $data->myra2_benchmark_target_1[9] : (int)(($data->myra2_benchmark_target_1[10] ?? 0)+($data->myra2_benchmark_target_1[11] ?? 0));
            $bar6_3 = $bar6_2*2;
            $bar7_1 = $section_c_data->case_studies;
            $bar7_2 = (int)($data->myra2_benchmark_target_1[12] ?? 0);
            $bar7_3 = $bar7_2*2;
            $bar8_1 = $section_c_data->policy_paper;
            $bar8_2 = $i <= 2018 ? $data->myra2_benchmark_target_1[10] : (int)($data->myra2_benchmark_target_1[13] ?? 0);
            $bar8_3 = $bar8_2*2;
            $bar9_1 = $section_c_data->other;
            $bar9_2 = $i <= 2018 ? $data->myra2_benchmark_target_1[11] : (int)($data->myra2_benchmark_target_1[14] ?? 0);
            $bar9_3 = $bar9_2*2;
            $bar10_1 = $section_c_data->citation;
            $bar10_2 = (int)($data->myra2_benchmark_target_1[5] ?? 0);
            $bar10_3 = $bar10_2*2;
            if($request_data->faculty){
                $label = getFacultyByCode($request_data->faculty)->parameter_name ?? '';
            }
            else {
                $label = 'UTM';
            }
            // if(in_array(user()->role, ['super_admin', 'admin']))array_push($year_range, [$label, (int)$i]);
            if(in_array(user()->role, ['super_admin', 'admin']))array_push($year_range, (int)$i);
            else array_push($year_range, (int)$i);
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
            array_push($bar_10->data_1, $bar10_1);
            array_push($bar_10->data_2, $bar10_2);
            array_push($bar_10->data_3, $bar10_3);
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
            'bar_10' => $bar_10,
        ];
    }

    public function sectionC_data_F($request_data) {
        $year_range = [];
        $bar_1 = (object)[  //NEW FUNDING APPROVED
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
            'data_4' => [],
        ]; 
        $bar_2 = (object)[  //AMOUNT RECEIVED FOR PUBLIC FUND
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
            'data_4' => [],
        ]; 
        $bar_3 = (object)[  //AMOUNT RECEIVED FOR PRIVATE FUND
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ]; 
        $bar_4 = (object)[  //AMOUNT RECEIVED FOR INTERNATIONAL FUND
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ];
        $bar_5= (object)[  
            'data_1' => [],
        ];
        $bar_6= (object)[  
            'data_1' => [],
        ];
        $bar_7= (object)[  
            'data_1' => [],
        ];
        $bar_8= (object)[  
            'data_1' => [],
        ];
        // $test = MasterlistResearchGrant::select('project_status')->distinct()->get()->toArray();
        // dd($test);
        for ($i=($request_data->end_year-$request_data->start_year <= 0?$request_data->end_year:$request_data->start_year); $i <= $request_data->end_year; $i++) { 
            if($request_data->faculty){
                $label = getFacultyByCode($request_data->faculty)->parameter_name ?? '';
                $section_c_data = $this->myraSectionC($i, $request_data->faculty, $request_data->school);
                $data = $section_c_data->calculation;
                // dd(MasterlistPublication::select('book_status')->distinct()->get()->toArray());
                $bar1_1 = null;
                $bar1_2 = null;
                $bar1_3 = null;
                $bar1_4 = null;
                $bar2_1 = MasterlistResearchGrant::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('sponsor_category', ['UNIVERSITY'])->sum('amount_received');
                $bar2_2 = MasterlistResearchGrant::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('sponsor_category', ['NATIONAL'])->sum('amount_received') + $bar2_1;
                $bar2_3 = (int)($data->myra2_benchmark_target_2[0] ?? 0);
                $bar2_4 = $bar2_3*2;
                $bar3_1 = MasterlistResearchGrant::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('sponsor_category', ['PRIVATE'])->sum('amount_received');
                $bar3_2 = (int)($data->myra2_benchmark_target_2[1] ?? 0);
                $bar3_3 = $bar3_2*2;
                $bar4_1 = MasterlistResearchGrant::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('sponsor_category', ['INTERNATIONAL'])->sum('amount_received');
                $bar4_2 = (int)($data->myra2_benchmark_target_2[2] ?? 0);
                $bar4_3 = $bar4_2*2;
                $bar5_1 = MasterlistResearchGrant::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('sponsor_category', ['UNIVERSITY'])->whereYear('start_date', $i)->sum('amount_pledged');
                $bar6_1 = MasterlistResearchGrant::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('sponsor_category', ['NATIONAL'])->whereYear('start_date', $i)->sum('amount_pledged');
                $bar7_1 = MasterlistResearchGrant::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('sponsor_category', ['PRIVATE'])->whereYear('start_date', $i)->sum('amount_pledged');
                $bar8_1 = MasterlistResearchGrant::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('sponsor_category', ['INTERNATIONAL'])->whereYear('start_date', $i)->sum('amount_pledged');
            }
            else{
                $label = 'UTM';
                $bar1_1 = MasterlistResearchGrant::where('ml_end_year', $i)->whereIn('sponsor_category', ['UNIVERSITY'])->whereYear('start_date', $i)->sum('amount_pledged');
                $bar1_2 = MasterlistResearchGrant::where('ml_end_year', $i)->whereIn('sponsor_category', ['NATIONAL'])->whereYear('start_date', $i)->sum('amount_pledged');
                $bar1_3 = MasterlistResearchGrant::where('ml_end_year', $i)->whereIn('sponsor_category', ['PRIVATE'])->whereYear('start_date', $i)->sum('amount_pledged');
                $bar1_4 = MasterlistResearchGrant::where('ml_end_year', $i)->whereIn('sponsor_category', ['INTERNATIONAL'])->whereYear('start_date', $i)->sum('amount_pledged');
                $bar2_1 = MasterlistResearchGrant::where('ml_end_year', $i)->whereIn('sponsor_category', ['UNIVERSITY'])->sum('amount_received');
                $bar2_2 = MasterlistResearchGrant::where('ml_end_year', $i)->whereIn('sponsor_category', ['NATIONAL'])->sum('amount_received') + $bar2_1;
                $bar2_3 = (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.research_grant.public_received.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_c')->first()->myra2_benchmark_target ?? 0);
                $bar2_4 = $bar2_3*2;
                $bar3_1 = MasterlistResearchGrant::where('ml_end_year', $i)->whereIn('sponsor_category', ['PRIVATE'])->sum('amount_received');
                $bar3_2 = (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.research_grant.private_received.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_c')->first()->myra2_benchmark_target ?? 0);
                $bar3_3 = $bar3_2*2;
                $bar4_1 = MasterlistResearchGrant::where('ml_end_year', $i)->whereIn('sponsor_category', ['INTERNATIONAL'])->sum('amount_received');
                $bar4_2 = (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.research_grant.international_received.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_c')->first()->myra2_benchmark_target ?? 0);
                $bar4_3 = $bar4_2*2;
                $bar5_1 = null;
                $bar6_1 = null;
                $bar7_1 = null;
                $bar8_1 = null;
            }
            // if(in_array(user()->role, ['super_admin', 'admin']))array_push($year_range, [$label, (int)$i]);
            if(in_array(user()->role, ['super_admin', 'admin']))array_push($year_range, (int)$i);
            else array_push($year_range, (int)$i);
            array_push($bar_1->data_1, $bar1_1);
            array_push($bar_1->data_2, $bar1_2);
            array_push($bar_1->data_3, $bar1_3);
            array_push($bar_1->data_4, $bar1_4);
            array_push($bar_2->data_1, $bar2_1);
            array_push($bar_2->data_2, $bar2_2);
            array_push($bar_2->data_3, $bar2_3);
            array_push($bar_2->data_4, $bar2_4);
            array_push($bar_3->data_1, $bar3_1);
            array_push($bar_3->data_2, $bar3_2);
            array_push($bar_3->data_3, $bar3_3);
            array_push($bar_4->data_1, $bar4_1);
            array_push($bar_4->data_2, $bar4_2);
            array_push($bar_4->data_3, $bar4_3);
            array_push($bar_5->data_1, $bar5_1);
            array_push($bar_6->data_1, $bar6_1);
            array_push($bar_7->data_1, $bar7_1);
            array_push($bar_8->data_1, $bar8_1);
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
        ];
    }

    public function sectionD_data_A($request_data) {
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
        for ($i=($request_data->end_year-$request_data->start_year <= 0?$request_data->end_year:$request_data->start_year); $i <= $request_data->end_year; $i++) { 
            $section_d_data = $this->myraSectionD($i, $request_data->faculty, $request_data->school);
            $active_acad_staff = $section_d_data->calculation->active_acad_staff;
            $line1_1 = $section_d_data->total_phd;
            $line1_2 = MasterlistPhdGraduate::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->whereIn('got', $this->got('yes'))->count();
            $bar1_1 = $line1_1;
            $bar1_2 = (int)($section_d_data->calculation->myra2_benchmark_target_1[0] ?? 0);
            $phd_graduate_7 = $line1_2;
            $bar2_1 =$line1_1;
            $bar2_2 = (int)($section_d_data->calculation->myra2_benchmark_target_1[1] ?? 0);
            $bar3_1 = $active_acad_staff > 0 ? $section_d_data->total_phd_enrolled/$active_acad_staff  : 0;
            $bar3_2 = (float)($section_d_data->calculation->myra1_benchmark_target_3[0] ?? 0);
            $bar4_1 = $active_acad_staff > 0 ? $section_d_data->pg_enrolled/$active_acad_staff  : 0;
            $bar4_2 = (float)($section_d_data->calculation->myra1_benchmark_target_4[0] ?? 0);
        
            array_push($year_range, (int)$i);
            array_push($line_1->data_1, $line1_1);
            array_push($line_1->data_2, $line1_2);
            array_push($bar_1->data_1, (float)number_format($bar1_1, 2));
            array_push($bar_1->data_2, $bar1_2);
            array_push($bar_2->data_1, (float)number_format($bar2_1, 2));
            array_push($bar_2->data_2, $bar2_2);
            array_push($bar_3->data_1, (float)number_format($bar3_1, 2));
            array_push($bar_3->data_2, $active_acad_staff > 0 ? (float)number_format($bar3_2/$active_acad_staff, 2)  : 0);
            array_push($bar_4->data_1, (float)number_format($bar4_1, 2));
            array_push($bar_4->data_2, $active_acad_staff > 0 ? (float)number_format($bar4_2/$active_acad_staff, 2)  : 0);
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

    public function sectionD_data_E($request_data) {
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
        for ($i=($request_data->end_year-$request_data->start_year <= 0?$request_data->end_year:$request_data->start_year); $i <= $request_data->end_year; $i++) { 
            if($request_data->faculty){
                $section_d_data = $this->myraSectionD($i, $request_data->faculty, $request_data->school);
                $pg_enrolled = $section_d_data->pg_enrolled;
                $int_pg_enrolled = $section_d_data->int_pg_enrolled;
                $bar1_1 = $pg_enrolled > 0 ? (float)number_format($int_pg_enrolled/$pg_enrolled*100, 2) : 0;
                $bar1_2 = (int)($section_d_data->calculation->myra1_benchmark_target_5[0] ?? 0);
                $bar2_1 = $pg_enrolled > 0 ? (float)number_format($section_d_data->entry_enrolled/$pg_enrolled*100, 2) : 0;
                $bar2_2 = (int)($section_d_data->calculation->myra1_benchmark_target_6[0] ?? 0);
                $pg_research = $section_d_data->fellowship_enrolled;
                $pg_master_research = MasterlistPgStudent::where('ml_end_year', $i)->where('degree_registered_for', $this->student_degree('master'))->whereIn('study_mode', $this->student_study_mode('research'))->count();
                $pg_phd_research = MasterlistPgStudent::where('ml_end_year', $i)->where('degree_registered_for', $this->student_degree('phd'))->count();
                $pg_research_enrolled = $pg_master_research + $pg_phd_research;
                $bar3_1 = $pg_enrolled > 0 ? (float)number_format($pg_research/$pg_research_enrolled*100, 2) : 0;
                $bar3_2 = (int)($section_d_data->calculation->myra1_benchmark_target_7[0] ?? 0);
                $bar4_1 = MasterlistPostDoc::where('ml_end_year', $i)->where(function ($q) use ($request_data, $i) {if($request_data->faculty){$q->where('faculty_code', $request_data->faculty);}if($request_data->school)$q->where('school_code', $request_data->school);})->count();
                $bar4_2 = (int)($section_d_data->calculation->myra2_benchmark_target_8[0] ?? 0);
            }
            else{
                $pg_enrolled = MasterlistPgStudent::where('ml_end_year', $i)->count();
                $int_pg_enrolled = MasterlistPgStudent::where('ml_end_year', $i)->whereIn('citizenship', $this->filter_citizenship('foreign'))->count();
                $bar1_1 = $pg_enrolled > 0 ? (float)number_format($int_pg_enrolled/$pg_enrolled*100, 2) : 0;
                $bar1_2 = (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.pg_international.percentage_enrolled.myra1_benchmark_target')as myra1_benchmark_target")])->where('year', $i)->whereType('section_d')->first()->myra1_benchmark_target ?? 0);
                $bar2_1 = $pg_enrolled > 0 ? (float)number_format(MasterlistEntryQualification::where('ml_end_year', $i)->count()/$pg_enrolled*100, 2) : 0;
                $bar2_2 = (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.pg_entry.percentage_enrolled.myra1_benchmark_target')as myra1_benchmark_target")])->where('year', $i)->whereType('section_d')->first()->myra1_benchmark_target ?? 0);
                $pg_research = MasterlistFellowship::where('ml_end_year', $i)->count();

                $pg_master_research = MasterlistPgStudent::where('ml_end_year', $i)->where('degree_registered_for', $this->student_degree('master'))->whereIn('study_mode', $this->student_study_mode('research'))->count();
                $pg_phd_research = MasterlistPgStudent::where('ml_end_year', $i)->where('degree_registered_for', $this->student_degree('phd'))->count();
                $pg_research_enrolled = $pg_master_research + $pg_phd_research;
                $bar3_1 = $pg_enrolled > 0 ? (float)number_format($pg_research/$pg_research_enrolled*100, 2) : 0;
                // dd($bar3_1);
                $bar3_2 = (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.pg_research.percentage_enrolled.myra1_benchmark_target')as myra1_benchmark_target")])->where('year', $i)->whereType('section_d')->first()->myra1_benchmark_target ?? 0);
                // dd($bar3_2/6763*100);
                $bar4_1 = MasterlistPostDoc::where('ml_end_year', $i)->count();
                $bar4_2 = (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.postdoc.percentage_enrolled.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_d')->first()->myra2_benchmark_target ?? 0);
            }
            array_push($year_range, (int)$i);
            array_push($bar_1->data_1, (float)number_format($bar1_1, 2));
            array_push($bar_1->data_2, $pg_enrolled > 0 ? number_format($bar1_2/$pg_enrolled*100, 2)  : 0);
            array_push($bar_2->data_1, (float)number_format($bar2_1, 2));
            array_push($bar_2->data_2, $pg_enrolled > 0 ? number_format($bar2_2/$pg_enrolled*100, 2)  : 0);
            array_push($bar_3->data_1, (float)number_format($bar3_1, 2));
            array_push($bar_3->data_2, $pg_research_enrolled > 0 ? number_format($bar3_2/$pg_research_enrolled*100, 2)  : 0);
            array_push($bar_4->data_1, (int)$bar4_1);
            array_push($bar_4->data_2, $bar4_2);

        }

        return (object)[
            'year_range' => $year_range,
            'bar_1' => $bar_1,
            'bar_2' => $bar_2,
            'bar_3' => $bar_3,
            'bar_4' => $bar_4,
        ];
    }

    public function sectionE_data($request_data) {
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

        for ($i=($request_data->end_year-$request_data->start_year <= 0?$request_data->end_year:$request_data->start_year); $i <= $request_data->end_year; $i++) {
            $section_e_data = $this->myraSectionE($i, $request_data->faculty, $request_data->school);
            $bar1_1 = $section_e_data->grant;
            $bar1_2 = (int)($section_e_data->calculation->myra2_benchmark_target_1[0] ?? 0);
            $bar2_1 = $section_e_data->file;
            $bar2_2 = (int)($section_e_data->calculation->myra2_benchmark_target_1[1] ?? 0);
            $bar3_1 = $section_e_data->other_ipr;
            $bar3_2 = (int)($section_e_data->calculation->myra2_benchmark_target_4[0] ?? 0);
            $bar4_1 = $section_e_data->comm_product;
            $bar4_2 = (int)($section_e_data->calculation->myra2_benchmark_target_2[0] ?? 0);
            $bar5_1 = $section_e_data->know_how_sold;
            $bar5_2 = $i <= 2018 ? (int)($section_e_data->calculation->myra2_benchmark_target_3[0] ?? 0 ) + (int)($section_e_data->calculation->myra2_benchmark_target_3[1] ?? 0 ) : (int)($section_e_data->calculation->myra2_benchmark_target_3[0] ?? 0);
            
            array_push($year_range, (int)$i);
            array_push($bar_1->data_1, $bar1_1);
            array_push($bar_1->data_2, $bar1_2);
            array_push($bar_2->data_1, $bar2_1);
            array_push($bar_2->data_2, $bar2_2);
            array_push($bar_3->data_1, $bar3_1);
            array_push($bar_3->data_2, $bar3_2);
            array_push($bar_4->data_1, $bar4_1);
            array_push($bar_4->data_2, $bar4_2);
            array_push($bar_5->data_1, $bar5_1);
            array_push($bar_5->data_2, $bar5_2);
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

    public function sectionF_data($request_data) {
        $year_range = []; 
        $bar_1 = (object)[  //TRAINING COURSES
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ]; 
        $bar_2 = (object)[  //PG FEES
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ]; 
        $bar_3 = (object)[  //CONFERENCE, SEMINAR
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ]; 
        $bar_4 = (object)[  //PRODUCT COMM & LICENSING
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ]; 
        $bar_5 = (object)[  //CONSULTANCY
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ]; 
        $bar_6= (object)[  //LAB SERVICES
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ]; 
        $bar_7= (object)[  //ENDOWMENT
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ]; 
        $bar_8= (object)[  //GIFTS/DONATIONS
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ]; 
        $bar_9= (object)[  //INCOME DIVIDEND
            'data_1' => [],
        ];
        $bar_10= (object)[  //EXPENDITURE
            'data_1' => [],
            'data_2' => [],
            'data_3' => [],
        ]; 

        for ($i=($request_data->end_year-$request_data->start_year <= 0?$request_data->end_year:$request_data->start_year); $i <= $request_data->end_year; $i++) { 
            if($request_data->faculty){
                $label = getFacultyByCode($request_data->faculty)->parameter_name ?? '';  
            }
            else {
                $label = 'UTM';
            }
            $section_f_data = $this->myraSectionF($i, $request_data->faculty, $request_data->school);
            $bar1_1 = (float)number_format($section_f_data->training_course, 2, '.', '');
            $bar1_2 = 5000000;
            $bar1_3 = $bar1_2*2;
            $bar2_1 = (float)number_format($section_f_data->pg_fee, 2, '.', '');
            $bar2_2 = (int)($section_f_data->calculation->myra2_benchmark_1[0] ?? 0) - $bar1_2;
            $bar2_3 = $bar2_2*2;
            $bar3_1 = (float)number_format($section_f_data->conference, 2, '.', '');
            $bar3_2 = (int)($section_f_data->calculation->myra2_benchmark_2[0] ?? 0);
            $bar3_3 = $bar3_2*2;
            $bar4_1 = (float)number_format($section_f_data->product_comm + $section_f_data->tech_know_how, 2, '.', '');
            $bar4_2 = (int)($section_f_data->calculation->myra2_benchmark_3[0] ?? 0);
            $bar4_3 = $bar4_2*2;
            $bar5_1 = (float)number_format($section_f_data->consultancy, 2, '.', '');
            $bar5_2 = $i <= 2018 ? 6000000 : (int)($section_f_data->calculation->myra2_benchmark_4[0] ?? 0);
            $bar5_3 = $bar5_2*2;
            $bar6_1 = (float)number_format($section_f_data->lab_service, 2, '.', '');
            $bar6_2 = $i <= 2018 ? 6000000 : (int)($section_f_data->calculation->myra2_benchmark_4[2] ?? 0);
            $bar6_3 = $bar6_2*2;
            $bar7_1 = (float)number_format($section_f_data->new_endowment, 2, '.', '');
            $bar7_2 = (int)($section_f_data->calculation->myra2_benchmark_5[0] ?? 0);
            $bar7_3 = $bar7_2*2;
            $bar8_1 = (float)number_format($section_f_data->gift, 2, '.', '');
            $bar8_2 = (int)($section_f_data->calculation->myra2_benchmark_6[0] ?? 0);
            $bar8_3 = $bar8_2*2;
            $bar9_1 = (float)number_format($section_f_data->existing_endowment, 2, '.', '');
            $bar10_1 = (float)number_format($section_f_data->oe_expenditure, 2, '.', '') > 0 ?  (float)number_format($section_f_data->rd_expenditure, 2, '.', '')/ (float)number_format($section_f_data->oe_expenditure, 2, '.', '') * 100 : 0;
            $bar10_2 = (float)($section_f_data->calculation->myra2_benchmark_7[0] ?? 0)*100;
            $bar10_3 = $bar10_2*2;
            
            // if(in_array(user()->role, ['super_admin', 'admin']))array_push($year_range, [$label, (int)$i]);
            if(in_array(user()->role, ['super_admin', 'admin']))array_push($year_range, (int)$i);
            else array_push($year_range, (int)$i);
            array_push($bar_1->data_1, $bar1_1);
            array_push($bar_1->data_2, $bar1_2);
            array_push($bar_1->data_3, $bar1_3);
            array_push($bar_2->data_1, $bar2_1);
            array_push($bar_2->data_2, $bar2_2);
            array_push($bar_2->data_3, $bar2_3);
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
            array_push($bar_10->data_1, (float)number_format($bar10_1, 2, '.', ''));
            array_push($bar_10->data_2, $bar10_2);
            array_push($bar_10->data_3, $bar10_3);
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
            'bar_10' => $bar_10,
        ];
    }

    public function sectionG_data_S($request_data) {
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
        $bar_6= (object)[  
            'data_1' => [],
            'data_2' => [],
        ]; 
        $bar_7= (object)[ 
            'data_1' => [],
            'data_2' => [],
        ]; 
        $bar_8= (object)[ 
            'data_1' => [],
            'data_2' => [],
        ]; 
        $bar_9= (object)[ 
            'data_1' => [],
            'data_2' => [],
        ]; 
        for ($i=($request_data->end_year-$request_data->start_year <= 0?$request_data->end_year:$request_data->start_year); $i <= $request_data->end_year; $i++) { 
            if($request_data->faculty){
                $label = getFacultyByCode($request_data->faculty)->parameter_name ?? '';
            }
            else{
                $label = 'UTM';
            }
            $section_g_data = $this->myraSectionG($i, $request_data->faculty, $request_data->school);
            $bar1_1 = $section_g_data->total_staff_int_moa;
            $bar1_2 = (int)($section_g_data->calculation->myra2_benchmark_target_1[1] ?? 0);
            $bar2_1 = $section_g_data->staff_sent_abroad;
            $bar2_2 = (int)($section_g_data->calculation->myra1_benchmark_target_2[0] ?? 0);
            $bar3_1 = $section_g_data->member_international;
            $bar3_2 = (int)($section_g_data->calculation->myra1_benchmark_target_3[0] ?? 0);
            $bar4_1 = $section_g_data->other_international;
            $bar4_2 = (int)($section_g_data->calculation->myra2_benchmark_target_3[0] ?? 0);
            $bar5_1 = $section_g_data->total_staff_nat_moa;
            $bar5_2 = (int)($section_g_data->calculation->myra2_benchmark_target_4[1] ?? 0);
            $bar6_1 = $section_g_data->member_national;
            $bar6_2 = (int)($section_g_data->calculation->myra1_benchmark_target_5[0] ?? 0);
            $bar7_1 = $section_g_data->other_national;
            $bar7_2 = (int)($section_g_data->calculation->myra2_benchmark_target_5[0] ?? 0);
            $bar8_1 = $section_g_data->total_int_moa;
            $bar8_2 = (int)($section_g_data->calculation->myra2_benchmark_target_1[0] ?? 0);
            $bar9_1 = $section_g_data->total_nat_moa;
            $bar9_2 = (int)($section_g_data->calculation->myra2_benchmark_target_4[0] ?? 0);
            // if(in_array(user()->role, ['super_admin', 'admin']))array_push($year_range, [$label, (int)$i]);
            if(in_array(user()->role, ['super_admin', 'admin']))array_push($year_range, (int)$i);
            else array_push($year_range, (int)$i);
            array_push($bar_1->data_1, $bar1_1);
            array_push($bar_1->data_2, $bar1_2);
            array_push($bar_2->data_1, $bar2_1);
            array_push($bar_2->data_2, $bar2_2);
            array_push($bar_3->data_1, $bar3_1);
            array_push($bar_3->data_2, $bar3_2);
            array_push($bar_4->data_1, $bar4_1);
            array_push($bar_4->data_2, $bar4_2);
            array_push($bar_5->data_1, $bar5_1);
            array_push($bar_5->data_2, $bar5_2);
            array_push($bar_6->data_1, $bar6_1);
            array_push($bar_6->data_2, $bar6_2);
            array_push($bar_7->data_1, $bar7_1);
            array_push($bar_7->data_2, $bar7_2);
            array_push($bar_8->data_1, $bar8_1);
            array_push($bar_8->data_2, $bar8_2);
            array_push($bar_9->data_1, $bar9_1);
            array_push($bar_9->data_2, $bar9_2);
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

    public function sectionG_data_P($request_data) {
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
        for ($i=($request_data->end_year-$request_data->start_year <= 0?$request_data->end_year:$request_data->start_year); $i <= $request_data->end_year; $i++) {
            if($request_data->faculty){
                $label = getFacultyByCode($request_data->faculty)->parameter_name ?? '';
                $section_g_data = $this->myraSectionG($i, $request_data->faculty, $request_data->school);
                $bar1_1 = $section_g_data->new_ktp;
                $bar1_2 = (int)($section_g_data->calculation->myra2_benchmark_target_6[0] ?? 0);
                $bar2_1 = $section_g_data->benefited_ktp;
                $bar2_2 = (int)($section_g_data->calculation->myra2_benchmark_target_6[1] ?? 0);
                $bar3_1 = $section_g_data->joint_research_project;
                $bar3_2 = (int)($section_g_data->calculation->myra1_benchmark_target_7[0] ?? 0);
                $bar4_1 = $section_g_data->joint_research_project_ru;
                $bar4_2 = (int)($section_g_data->calculation->myra2_benchmark_target_8[0] ?? 0);
            }
            else { 
                $label = 'UTM';
                $bar1_1 = MasterlistNewKtp::where('ml_end_year', $i)->count();
                $bar1_2 = (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.social_innovation.community_research.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_g')->first()->myra2_benchmark_target ?? 0);
                $bar2_1 = MasterlistBenefitedKtp::where('ml_end_year', $i)->count();
                $bar2_2 = (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.social_innovation.community_benefit.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_g')->first()->myra2_benchmark_target ?? 0);
                $bar3_1 = MasterlistJointResearchProject::where('ml_end_year', $i)->count();
                $bar3_2 = (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.research_project.myra1_benchmark_target')as myra1_benchmark_target")])->where('year', $i)->whereType('section_g')->first()->myra1_benchmark_target ?? 0);
                $bar4_1 = MasterlistJointResearchRu::where('ml_end_year', $i)->count();
                $bar4_2 = (int)(MyraCalculation::select([DB::raw("JSON_EXTRACT(benchmark_target, '$.research_project_ru.myra2_benchmark_target')as myra2_benchmark_target")])->where('year', $i)->whereType('section_g')->first()->myra2_benchmark_target ?? 0);
            }
            // if(in_array(user()->role, ['super_admin', 'admin']))array_push($year_range, [$label, (int)$i]);
            if(in_array(user()->role, ['super_admin', 'admin']))array_push($year_range, (int)$i);
            else array_push($year_range, (int)$i);
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
            'bar_1' => $bar_1,
            'bar_2' => $bar_2,
            'bar_3' => $bar_3,
            'bar_4' => $bar_4,
        ];
    }

    public function sectionH_data($request_data) {
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
        ];
        $bar_4 = (object)[ 
            'data_1' => [],
        ];
        $bar_5 = (object)[ 
            'data_1' => [],
        ];
        $bar_6 = (object)[ 
            'data_1' => [],
        ];

        for ($i=($request_data->end_year-$request_data->start_year <= 0?$request_data->end_year:$request_data->start_year); $i <= $request_data->end_year; $i++) { 
            $section_h_data = $this->myraSectionH($i, $request_data->faculty, $request_data->school);
            $bar1_1 = $section_h_data->support;
            $bar1_2 = (int)($section_h_data->calculation->myra2_benchmark_target_1[0] ?? 0);
            $bar2_1 = $section_h_data->book + $section_h_data->book_online + $section_h_data->journal_subscribed;
            $bar2_2 = 1200000;
            $bar3_1 = (int)$section_h_data->book ?? 0;
            $bar4_1 = (int)$section_h_data->book_online ?? 0;
            $bar5_1 = (int)$section_h_data->journal ?? 0;
            $bar6_1 = (int)$section_h_data->e_journal ?? 0;
            array_push($year_range, (int)$i);
            array_push($bar_1->data_1, $bar1_1);
            array_push($bar_1->data_2, $bar1_2);
            array_push($bar_2->data_1, $bar2_1);
            array_push($bar_2->data_2, $bar2_2);
            array_push($bar_3->data_1, $bar3_1);
            array_push($bar_4->data_1, $bar4_1);
            array_push($bar_5->data_1, $bar5_1);
            array_push($bar_6->data_1, $bar6_1);
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
}
