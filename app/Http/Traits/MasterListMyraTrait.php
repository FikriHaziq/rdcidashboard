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
use App\Http\Traits\MyraCalculationTrait;
use App\Http\Traits\DataSerializationTrait;

trait MasterListMyraTrait {

    use MyraCalculationTrait, DataSerializationTrait;

    public function getMyraModuleAvailability($year) {
        $acad_staff = DataAttachment::whereModule('acad_staff')->where('year', $year)->whereStatus('selected')->exists();
        $ug_student = DataAttachment::whereModule('ug_student')->where('year', $year)->whereStatus('selected')->exists();
        $pg_student = DataAttachment::whereModule('pg_student')->where('year', $year)->whereStatus('selected')->exists();
        
        $critical_mass = DataAttachment::whereModule('critical_mass')->where('year', $year)->whereStatus('selected')->exists();
        $pro_qualification = DataAttachment::whereModule('pro_qualification')->where('year', $year)->whereStatus('selected')->exists();
        $research_experience = DataAttachment::whereModule('research_experience')->where('year', $year)->whereStatus('selected')->exists();
        $award = DataAttachment::whereModule('award')->where('year', $year)->whereStatus('selected')->exists();
        
        $publication = DataAttachment::whereModule('publication')->where('year', $year)->whereStatus('selected')->exists();
        $research_grant = DataAttachment::whereModule('research_grant')->where('year', $year)->whereStatus('selected')->exists();
        $expenditure_project = DataAttachment::whereModule('expenditure_project')->where('year', $year)->whereStatus('selected')->exists();
        $monitoring_project = DataAttachment::whereModule('monitoring_project')->where('year', $year)->whereStatus('selected')->exists();

        $phd_graduated = DataAttachment::whereModule('phd_graduated')->where('year', $year)->whereStatus('selected')->exists();
        $master_graduated = DataAttachment::whereModule('master_graduated')->where('year', $year)->whereStatus('selected')->exists();
        $phd_enrolled = DataAttachment::whereModule('phd_enrolled')->where('year', $year)->whereStatus('selected')->exists();
        $entry_qualification = DataAttachment::whereModule('entry_qualification')->where('year', $year)->whereStatus('selected')->exists();
        $fellowship = DataAttachment::whereModule('fellowship')->where('year', $year)->whereStatus('selected')->exists();
        $post_doc = DataAttachment::whereModule('post_doc')->where('year', $year)->whereStatus('selected')->exists();

        $patent_granted = DataAttachment::whereModule('patent_granted')->where('year', $year)->whereStatus('selected')->exists();
        $patent_filed = DataAttachment::whereModule('patent_filed')->where('year', $year)->whereStatus('selected')->exists();
        $comm_product = DataAttachment::whereModule('comm_product')->where('year', $year)->whereStatus('selected')->exists();
        $know_how_sold = DataAttachment::whereModule('know_how_sold')->where('year', $year)->whereStatus('selected')->exists();
        $other_ipr = DataAttachment::whereModule('other_ipr')->where('year', $year)->whereStatus('selected')->exists();
        $active_company = DataAttachment::whereModule('active_company')->where('year', $year)->whereStatus('selected')->exists();
        $new_company = DataAttachment::whereModule('new_company')->where('year', $year)->whereStatus('selected')->exists();
        
        $training_course = DataAttachment::whereModule('training_course')->where('year', $year)->whereStatus('selected')->exists();
        $pg_fee = DataAttachment::whereModule('pg_fee')->where('year', $year)->whereStatus('selected')->exists();
        $conference = DataAttachment::whereModule('conference')->where('year', $year)->whereStatus('selected')->exists();
        $product_comm_service = DataAttachment::whereModule('product_comm_service')->where('year', $year)->whereStatus('selected')->exists();
        $tech_know_how = DataAttachment::whereModule('tech_know_how')->where('year', $year)->whereStatus('selected')->exists();
        $consultancy = DataAttachment::whereModule('consultancy')->where('year', $year)->whereStatus('selected')->exists();
        $lab_service = DataAttachment::whereModule('lab_service')->where('year', $year)->whereStatus('selected')->exists();
        $new_endowment = DataAttachment::whereModule('new_endowment')->where('year', $year)->whereStatus('selected')->exists();
        $gift = DataAttachment::whereModule('gift')->where('year', $year)->whereStatus('selected')->exists();
        
        $international_moa = DataAttachment::whereModule('international_moa')->where('year', $year)->whereStatus('selected')->exists();
        $staff_international_moa = DataAttachment::whereModule('staff_international_moa')->where('year', $year)->whereStatus('selected')->exists();
        $staff_sent_abroad = DataAttachment::whereModule('staff_sent_abroad')->where('year', $year)->whereStatus('selected')->exists();
        $international_membership = DataAttachment::whereModule('international_membership')->where('year', $year)->whereStatus('selected')->exists();
        $national_moa = DataAttachment::whereModule('national_moa')->where('year', $year)->whereStatus('selected')->exists();
        $staff_national_moa = DataAttachment::whereModule('staff_national_moa')->where('year', $year)->whereStatus('selected')->exists();
        $national_membership = DataAttachment::whereModule('national_membership')->where('year', $year)->whereStatus('selected')->exists();
        $new_ktp = DataAttachment::whereModule('new_ktp')->where('year', $year)->whereStatus('selected')->exists();
        $benefited_ktp = DataAttachment::whereModule('benefited_ktp')->where('year', $year)->whereStatus('selected')->exists();
        $joint_research_project = DataAttachment::whereModule('joint_research_project')->where('year', $year)->whereStatus('selected')->exists();
        $joint_research_project_ru = DataAttachment::whereModule('joint_research_project_ru')->where('year', $year)->whereStatus('selected')->exists();
        
        $support_facilities = DataAttachment::whereModule('support_facilities')->where('year', $year)->whereStatus('selected')->exists();
        $library_facilities = DataAttachment::whereModule('library_facilities')->where('year', $year)->whereStatus('selected')->exists();


        return [
            (object)[
                'group'=>'SECTION A: GENERAL INFORMATION',
                'group_code'=>'section_a',
                'modules'=>[
                    (object)[
                        'name'=>'Academic Staff',
                        'code'=>'acad_staff',
                        'available'=>$acad_staff
                    ],
                    (object)[
                        'name'=>'Under Graduate Student',
                        'code'=>'ug_student',
                        'available'=>$ug_student
                    ],
                    (object)[
                        'name'=>'Post Graduate Student',
                        'code'=>'pg_student',
                        'available'=>$pg_student
                    ],
                ], 
            ],
            (object)[
                'group'=>'SECTION B: QUANTITY AND QUALITY OF RESEARCHERS',
                'group_code'=>'section_b',
                'modules'=>[
                    (object)[
                        'name'=>'Critical Mass',
                        'code'=>'critical_mass',
                        'available'=>$critical_mass
                    ],
                    (object)[
                        'name'=>'PhD/Professional Qualifications',
                        'code'=>'pro_qualification',
                        'available'=>$pro_qualification
                    ],
                    (object)[
                        'name'=>'Research Experience (3 COHORTS)',
                        'code'=>'research_experience',
                        'available'=>$research_experience
                    ],
                    (object)[
                        'name'=>'Awards Recognition',
                        'code'=>'award',
                        'available'=>$award
                    ],
                ]
            ],
            (object)[
                'group'=>'SECTION C: QUANTITY AND QUALITY OF RESEARCH',
                'group_code'=>'section_c',
                'modules'=>[
                    (object)[
                        'name'=>'Publication',
                        'code'=>'publication',
                        'available'=>$publication
                    ],
                    (object)[
                        'name'=>'Research Grant',
                        'code'=>'research_grant',
                        'available'=>$research_grant
                    ],
                    (object)[
                        'name'=>'Expenditure Project',
                        'code'=>'expenditure_project',
                        'available'=>$expenditure_project
                    ],
                    (object)[
                        'name'=>'Monitoring Project',
                        'code'=>'monitoring_project',
                        'available'=>$monitoring_project
                    ],
                ]
            ],
            (object)[
                'group'=>'SECTION D: QUANTITY AND QUALITY OF POSTGRADUATES',
                'group_code'=>'section_d',
                'modules'=>[
                    (object)[
                        'name'=>'PhD Graduated',
                        'code'=>'phd_graduated',
                        'available'=>$phd_graduated
                    ],
                    (object)[
                        'name'=>'Master Graduated',
                        'code'=>'master_graduated',
                        'available'=>$master_graduated
                    ],
                    (object)[
                        'name'=>'PhD Enrolled',
                        'code'=>'phd_enrolled',
                        'available'=>$phd_enrolled
                    ],
                    (object)[
                        'name'=>'Entry Qualification',
                        'code'=>'entry_qualification',
                        'available'=>$entry_qualification
                    ],
                    (object)[
                        'name'=>'Fellowship',
                        'code'=>'fellowship',
                        'available'=>$fellowship
                    ],
                    (object)[
                        'name'=>'Post Doc',
                        'code'=>'post_doc',
                        'available'=>$post_doc
                    ],
                ]
            ],
            (object)[
                'group'=>'SECTION E: INNOVATION',
                'group_code'=>'section_e',
                'modules'=>[
                    (object)[
                        'name'=>'Patent Granted',
                        'code'=>'patent_granted',
                        'available'=>$patent_granted
                    ],
                    (object)[
                        'name'=>'Patent Filed',
                        'code'=>'patent_filed',
                        'available'=>$patent_filed
                    ],
                    (object)[
                        'name'=>'Comm Product',
                        'code'=>'comm_product',
                        'available'=>$comm_product
                    ],
                    (object)[
                        'name'=>'Know-How Sold Outright',
                        'code'=>'know_how_sold',
                        'available'=>$know_how_sold
                    ],
                    (object)[
                        'name'=>'Other IPR',
                        'code'=>'other_ipr',
                        'available'=>$other_ipr
                    ],
                    (object)[
                        'name'=>'Active Companies',
                        'code'=>'active_company',
                        'available'=>$active_company
                    ],
                    (object)[
                        'name'=>'New Companies',
                        'code'=>'new_company',
                        'available'=>$new_company
                    ],
                ]
            ],
            (object)[
                'group'=>'SECTION F: PROFESSIONAL SERVICES AND GIFTS',
                'group_code'=>'section_f',
                'modules'=>[
                    (object)[
                        'name'=>'Training Courses',
                        'code'=>'training_course',
                        'available'=>$training_course
                    ],
                    (object)[
                        'name'=>'PG Fees',
                        'code'=>'pg_fee',
                        'available'=>$pg_fee
                    ],
                    (object)[
                        'name'=>'Conference',
                        'code'=>'conference',
                        'available'=>$conference
                    ],
                    (object)[
                        'name'=>'Product Comm',
                        'code'=>'product_comm_service',
                        'available'=>$product_comm_service
                    ],
                    (object)[
                        'name'=>'Tech Know-How',
                        'code'=>'tech_know_how',
                        'available'=>$tech_know_how
                    ],
                    (object)[
                        'name'=>'Consultancy',
                        'code'=>'consultancy',
                        'available'=>$consultancy
                    ],
                    (object)[
                        'name'=>'Lab Services',
                        'code'=>'lab_service',
                        'available'=>$lab_service
                    ],
                    (object)[
                        'name'=>'New Endowment',
                        'code'=>'new_endowment',
                        'available'=>$new_endowment
                    ],
                    (object)[
                        'name'=>'Gifts',
                        'code'=>'gift',
                        'available'=>$gift
                    ],
                ]
            ],
            (object)[
                'group'=>'SECTION G: NETWORKING AND LINKAGES',
                'group_code'=>'section_g',
                'modules'=>[
                    (object)[
                        'name'=>'International MoA',
                        'code'=>'international_moa',
                        'available'=>$international_moa
                    ],
                    (object)[
                        'name'=>'Staff Involved International MoA',
                        'code'=>'staff_international_moa',
                        'available'=>$staff_international_moa
                    ],
                    (object)[
                        'name'=>'Staff Sent Abroad',
                        'code'=>'staff_sent_abroad',
                        'available'=>$staff_sent_abroad
                    ],
                    (object)[
                        'name'=>'International Membership',
                        'code'=>'international_membership',
                        'available'=>$international_membership
                    ],
                    (object)[
                        'name'=>'National MoA',
                        'code'=>'national_moa',
                        'available'=>$national_moa
                    ],
                    (object)[
                        'name'=>'Staff Involved National MoA',
                        'code'=>'staff_national_moa',
                        'available'=>$staff_national_moa
                    ],
                    (object)[
                        'name'=>'National Membership',
                        'code'=>'national_membership',
                        'available'=>$national_membership
                    ],
                    (object)[
                        'name'=>'New KTP',
                        'code'=>'new_ktp',
                        'available'=>$new_ktp
                    ],
                    (object)[
                        'name'=>'Benefited KTP',
                        'code'=>'benefited_ktp',
                        'available'=>$benefited_ktp
                    ],
                    (object)[
                        'name'=>'Joint Research Projects',
                        'code'=>'joint_research_project',
                        'available'=>$joint_research_project
                    ],
                    (object)[
                        'name'=>'Joint Research Projects Between RUs',
                        'code'=>'joint_research_project_ru',
                        'available'=>$joint_research_project_ru
                    ],
                ]
            ],
            (object)[
                'group'=>'SECTION H: SUPPORT FACILITIES',
                'group_code'=>'section_h',
                'modules'=>[
                    (object)[
                        'name'=>'Support Facilities',
                        'code'=>'support_facilities',
                        'available'=>$support_facilities
                    ],
                    (object)[
                        'name'=>'Library Facilities',
                        'code'=>'library_facilities',
                        'available'=>$library_facilities
                    ],
                ]
            ],
        ];
    }

    public function myraSectionA($year) {
        $faculties = [];
        $schools = MasterlistUgStudent::where('ml_end_year', $year)->select('school_code')->whereNotNull('school_code')->distinct()->orderBy('school_code')->get();

        $staff = MasterlistAcademicStaff::where('ml_end_year', $year)->count();
        $prof_fulltime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'PROF.')->whereIn('status3', ['FULL TIME', 'SEPENUH MASA'])->count();
        $prof_parttime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'PROF.')->whereIn('status3', ['PART TIME', 'SEPARUH MASA'])->count();
        $prof = $prof_fulltime+$prof_parttime;
        $assoc_prof_fulltime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'ASSOC. PROF.')->whereIn('status3', ['FULL TIME', 'SEPENUH MASA'])->count();
        $assoc_prof_parttime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'ASSOC. PROF.')->whereIn('status3', ['PART TIME', 'SEPARUH MASA'])->count();
        $assoc_prof = $assoc_prof_fulltime+$assoc_prof_parttime;
        $sen_fulltime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'SENIOR LECTURER')->whereIn('status3', ['FULL TIME', 'SEPENUH MASA'])->count();
        $sen_parttime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'SENIOR LECTURER')->whereIn('status3', ['PART TIME', 'SEPARUH MASA'])->count();
        $sen = $sen_fulltime+$sen_parttime;
        $lect_fulltime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'LECTURER')->whereIn('status3', ['FULL TIME', 'SEPENUH MASA'])->count();
        $lect_parttime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'LECTURER')->whereIn('status3', ['PART TIME', 'SEPARUH MASA'])->count();
        $lect = $lect_fulltime+$lect_parttime;
        $res_fulltime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'RESEARCH FELLOW')->whereIn('status3', ['FULL TIME', 'SEPENUH MASA'])->count();
        $res_parttime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'RESEARCH FELLOW')->whereIn('status3', ['PART TIME', 'SEPARUH MASA'])->count();
        $res = $res_fulltime+$res_parttime;

        $active_staff = MasterlistAcademicStaff::where('ml_end_year', $year)->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_prof_fulltime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'PROF.')->whereIn('status3', ['FULL TIME', 'SEPENUH MASA'])->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_prof_parttime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'PROF.')->whereIn('status3', ['PART TIME', 'SEPARUH MASA'])->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_prof = $active_prof_fulltime+$active_prof_parttime;
        $active_assoc_prof_fulltime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'ASSOC. PROF.')->whereIn('status3', ['FULL TIME', 'SEPENUH MASA'])->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_assoc_prof_parttime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'ASSOC. PROF.')->whereIn('status3', ['PART TIME', 'SEPARUH MASA'])->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_assoc_prof = $active_assoc_prof_fulltime+$active_assoc_prof_parttime;
        $active_sen_fulltime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'SENIOR LECTURER')->whereIn('status3', ['FULL TIME', 'SEPENUH MASA'])->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_sen_parttime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'SENIOR LECTURER')->whereIn('status3', ['PART TIME', 'SEPARUH MASA'])->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_sen = $active_sen_fulltime+$active_sen_parttime;
        $active_lect_fulltime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'LECTURER')->whereIn('status3', ['FULL TIME', 'SEPENUH MASA'])->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_lect_parttime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'LECTURER')->whereIn('status3', ['PART TIME', 'SEPARUH MASA'])->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_lect = $active_lect_fulltime+$active_lect_parttime;
        $active_res_fulltime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'RESEARCH FELLOW')->whereIn('status3', ['FULL TIME', 'SEPENUH MASA'])->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_res_parttime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('position', 'RESEARCH FELLOW')->whereIn('status3', ['PART TIME', 'SEPARUH MASA'])->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_res = $active_res_fulltime+$active_res_parttime;

        $active_st_fulltime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('st', 'S&T')->whereIn('status3', ['FULL TIME', 'SEPENUH MASA'])->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_st_parttime = MasterlistAcademicStaff::where('ml_end_year', $year)->where('st', 'S&T')->whereIn('status3', ['PART TIME', 'SEPARUH MASA'])->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_st = $active_st_fulltime+$active_st_parttime;
        $active_nonst = MasterlistAcademicStaff::where('ml_end_year', $year)->where('st', 'NON S&T')->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $percentage_active_st = $staff > 0 ? (float)number_format($active_st/$staff * 100, 2) : 0;
        $active_foreign_fulltime = MasterlistAcademicStaff::where('ml_end_year', $year)->whereIn('citizenship', $this->filter_citizenship('foreign'))->whereIn('status3', ['FULL TIME', 'SEPENUH MASA'])->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_foreign_parttime = MasterlistAcademicStaff::where('ml_end_year', $year)->whereIn('citizenship', $this->filter_citizenship('foreign'))->whereIn('status3', ['PART TIME', 'SEPARUH MASA'])->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_foreign = $active_foreign_fulltime+$active_foreign_parttime;

        //Student
        $ug_bachelor_local = MasterlistUgStudent::where('ml_end_year', $year)->whereIn('citizenship', ['LOCAL', 'TEMPATAN'])->count();
        $ug_bachelor_foreign = MasterlistUgStudent::where('ml_end_year', $year)->whereIn('citizenship', $this->filter_citizenship('foreign'))->count();
        $ug_bachelor = $ug_bachelor_local+$ug_bachelor_foreign;
        $student_fulltime = $ug_bachelor + MasterlistPgStudent::where('ml_end_year', $year)->whereIn('study_type', ['FULL TIME', 'SEPENUH MASA'])->count();

        $pg = MasterlistPgStudent::where('ml_end_year', $year)->count();
        $phd = MasterlistPgStudent::where('ml_end_year', $year)->where('degree_registered_for', 'PHD')->count();
        $pg_research = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('study_mode', $this->student_study_mode('research'))->count();
        $pg_foreign = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('citizenship', $this->filter_citizenship('foreign'))->count();
        $master_local = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('citizenship', ['LOCAL', 'TEMPATAN'])->count();
        $master_foreign = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('citizenship', $this->filter_citizenship('foreign'))->count();

        $master_research_local_fulltime = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('degree_registered_for', ['MASTER', 'SARJANA'])->whereIn('study_mode', $this->student_study_mode('research'))->whereIn('citizenship', ['LOCAL', 'TEMPATAN'])->whereIn('study_type', ['FULL TIME', 'SEPENUH MASA'])->count();
        $master_research_local_parttime = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('degree_registered_for', ['MASTER', 'SARJANA'])->whereIn('study_mode', $this->student_study_mode('research'))->whereIn('citizenship', ['LOCAL', 'TEMPATAN'])->whereIn('study_type', ['PART TIME', 'SEPARUH MASA'])->count();
        $master_research_local = $master_research_local_fulltime+$master_research_local_parttime;
        $master_research_foreign_fulltime = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('degree_registered_for', ['MASTER', 'SARJANA'])->whereIn('study_mode', $this->student_study_mode('research'))->whereIn('citizenship', $this->filter_citizenship('foreign'))->whereIn('study_type', ['FULL TIME', 'SEPENUH MASA'])->count();
        $master_research_foreign_parttime = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('degree_registered_for', ['MASTER', 'SARJANA'])->whereIn('study_mode', $this->student_study_mode('research'))->whereIn('citizenship', $this->filter_citizenship('foreign'))->whereIn('study_type', ['PART TIME', 'SEPARUH MASA'])->count();
        $master_research_foreign = $master_research_foreign_fulltime+$master_research_foreign_parttime;
        $master_coursework_local_fulltime = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('degree_registered_for', ['MASTER', 'SARJANA'])->whereIn('study_mode', ['COURSEWORK', 'KERJA KURSUS', 'MIXED MODE', 'K KUR & PENYELIDIKAN'])->whereIn('citizenship', ['LOCAL', 'TEMPATAN'])->whereIn('study_type', ['FULL TIME', 'SEPENUH MASA'])->count();
        $master_coursework_local_parttime = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('degree_registered_for', ['MASTER', 'SARJANA'])->whereIn('study_mode', ['COURSEWORK', 'KERJA KURSUS', 'MIXED MODE', 'K KUR & PENYELIDIKAN'])->whereIn('citizenship', ['LOCAL', 'TEMPATAN'])->whereIn('study_type', ['PART TIME', 'SEPARUH MASA'])->count();
        $master_coursework_local = $master_coursework_local_fulltime+$master_coursework_local_parttime;
        $master_coursework_foreign_fulltime = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('degree_registered_for', ['MASTER', 'SARJANA'])->whereIn('study_mode', ['COURSEWORK', 'KERJA KURSUS', 'MIXED MODE', 'K KUR & PENYELIDIKAN'])->whereIn('citizenship', $this->filter_citizenship('foreign'))->whereIn('study_type', ['FULL TIME', 'SEPENUH MASA'])->count();
        $master_coursework_foreign_parttime = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('degree_registered_for', ['MASTER', 'SARJANA'])->whereIn('study_mode', ['COURSEWORK', 'KERJA KURSUS', 'MIXED MODE', 'K KUR & PENYELIDIKAN'])->whereIn('citizenship', $this->filter_citizenship('foreign'))->whereIn('study_type', ['PART TIME', 'SEPARUH MASA'])->count();
        $master_coursework_foreign = $master_coursework_foreign_fulltime+$master_coursework_foreign_parttime;
        $phd_local_fulltime = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('degree_registered_for', ['PHD'])->whereIn('citizenship', ['LOCAL', 'TEMPATAN'])->whereIn('study_type', ['FULL TIME', 'SEPENUH MASA'])->count();
        $phd_local_parttime = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('degree_registered_for', ['PHD'])->whereIn('citizenship', ['LOCAL', 'TEMPATAN'])->whereIn('study_type', ['PART TIME', 'SEPARUH MASA'])->count();
        $phd_local = $phd_local_fulltime+$phd_local_parttime;
        $phd_foreign_fulltime = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('degree_registered_for', ['PHD'])->whereIn('citizenship', $this->filter_citizenship('foreign'))->whereIn('study_type', ['FULL TIME', 'SEPENUH MASA'])->count();
        $phd_foreign_parttime = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('degree_registered_for', ['PHD'])->whereIn('citizenship', $this->filter_citizenship('foreign'))->whereIn('study_type', ['PART TIME', 'SEPARUH MASA'])->count();
        $phd_foreign = $phd_foreign_fulltime+$phd_foreign_parttime;
        $doc_coursework_local_fulltime = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('degree_registered_for', ['DOCTORAL'])->whereIn('study_mode', ['COURSEWORK', 'KERJA KURSUS', 'MIXED MODE', 'K KUR & PENYELIDIKAN'])->whereIn('citizenship', ['LOCAL', 'TEMPATAN'])->whereIn('study_type', ['FULL TIME', 'SEPENUH MASA'])->count();
        $doc_coursework_local_parttime = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('degree_registered_for', ['DOCTORAL'])->whereIn('study_mode', ['COURSEWORK', 'KERJA KURSUS', 'MIXED MODE', 'K KUR & PENYELIDIKAN'])->whereIn('citizenship', ['LOCAL', 'TEMPATAN'])->whereIn('study_type', ['PART TIME', 'SEPARUH MASA'])->count();
        $doc_coursework_local = $doc_coursework_local_fulltime+$doc_coursework_local_parttime;
        $doc_coursework_foreign_fulltime = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('degree_registered_for', ['DOCTORAL'])->whereIn('study_mode', ['COURSEWORK', 'KERJA KURSUS', 'MIXED MODE', 'K KUR & PENYELIDIKAN'])->whereIn('citizenship', $this->filter_citizenship('foreign'))->whereIn('study_type', ['FULL TIME', 'SEPENUH MASA'])->count();
        $doc_coursework_foreign_parttime = MasterlistPgStudent::where('ml_end_year', $year)->whereIn('degree_registered_for', ['DOCTORAL'])->whereIn('study_mode', ['COURSEWORK', 'KERJA KURSUS', 'MIXED MODE', 'K KUR & PENYELIDIKAN'])->whereIn('citizenship', $this->filter_citizenship('foreign'))->whereIn('study_type', ['PART TIME', 'SEPARUH MASA'])->count();
        $doc_coursework_foreign = $doc_coursework_foreign_fulltime+$doc_coursework_foreign_parttime;

        return (object)[
            'faculties' => $faculties,
            'schools' => $schools,

            'staff' => $staff,
            'prof_fulltime' => $prof_fulltime,
            'prof_parttime' => $prof_parttime,
            'prof' => $prof,
            'assoc_prof_fulltime' => $assoc_prof_fulltime,
            'assoc_prof_parttime' => $assoc_prof_parttime,
            'assoc_prof' => $assoc_prof,
            'sen_fulltime' => $sen_fulltime,
            'sen_parttime' => $sen_parttime,
            'sen' => $sen,
            'lect_fulltime' => $lect_fulltime,
            'lect_parttime' => $lect_parttime,
            'lect' => $lect,
            'res_fulltime' => $res_fulltime,
            'res_parttime' => $res_parttime,
            'res' => $res,

            'active_staff' => $active_staff,
            'active_prof_fulltime' => $active_prof_fulltime,
            'active_prof_parttime' => $active_prof_parttime,
            'active_prof' => $active_prof,
            'active_assoc_prof_fulltime' => $active_assoc_prof_fulltime,
            'active_assoc_prof_parttime' => $active_assoc_prof_parttime,
            'active_assoc_prof' => $active_assoc_prof,
            'active_sen_fulltime' => $active_sen_fulltime,
            'active_sen_parttime' => $active_sen_parttime,
            'active_sen' => $active_sen,
            'active_lect_fulltime' => $active_lect_fulltime,
            'active_lect_parttime' => $active_lect_parttime,
            'active_lect' => $active_lect,
            'active_res_fulltime' => $active_res_fulltime,
            'active_res_parttime' => $active_res_parttime,
            'active_res' => $active_res,

            'active_st_fulltime' => $active_st_fulltime,
            'active_st_parttime' => $active_st_parttime,
            'active_st' => $active_st,
            'active_nonst' => $active_nonst,
            'percentage_active_st' => $percentage_active_st,
            'active_foreign_fulltime' => $active_foreign_fulltime,
            'active_foreign_parttime' => $active_foreign_parttime,
            'active_foreign' => $active_foreign,

            'student_fulltime' => $student_fulltime,
            'ug_bachelor_local' => $ug_bachelor_local,
            'ug_bachelor_foreign' => $ug_bachelor_foreign,
            'ug_bachelor' => $ug_bachelor,
            'pg' => $pg,
            'phd' => $phd,
            'pg_research' => $pg_research,
            'pg_foreign' => $pg_foreign,
            'master_local' => $master_local,
            'master_foreign' => $master_foreign,
            'master_research_local_fulltime' => $master_research_local_fulltime,
            'master_research_local_parttime' => $master_research_local_parttime,
            'master_research_local' => $master_research_local,
            'master_research_foreign_fulltime' => $master_research_foreign_fulltime,
            'master_research_foreign_parttime' => $master_research_foreign_parttime,
            'master_research_foreign' => $master_research_foreign,
            'master_coursework_local_fulltime' => $master_coursework_local_fulltime,
            'master_coursework_local_parttime' => $master_coursework_local_parttime,
            'master_coursework_local' => $master_coursework_local,
            'master_coursework_foreign_fulltime' => $master_coursework_foreign_fulltime,
            'master_coursework_foreign_parttime' => $master_coursework_foreign_parttime,
            'master_coursework_foreign' => $master_coursework_foreign,
            'phd_local_fulltime' => $phd_local_fulltime,
            'phd_local_parttime' => $phd_local_parttime,
            'phd_local' => $phd_local,
            'phd_foreign_fulltime' => $phd_foreign_fulltime,
            'phd_foreign_parttime' => $phd_foreign_parttime,
            'phd_foreign' => $phd_foreign,
            'doc_coursework_local_fulltime' => $doc_coursework_local_fulltime,
            'doc_coursework_local_parttime' => $doc_coursework_local_parttime,
            'doc_coursework_local' => $doc_coursework_local,
            'doc_coursework_foreign_fulltime' => $doc_coursework_foreign_fulltime,
            'doc_coursework_foreign_parttime' => $doc_coursework_foreign_parttime,
            'doc_coursework_foreign' => $doc_coursework_foreign,
        ];
    }

    public function myraSectionB($year, $faculty = null) {
        $faculties = [];
        $schools = [];
        $active_staff = MasterlistCriticalMass::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $uni_staff_fulltime = MasterlistCriticalMass::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('sponsor_category', $this->sponsor_category('university'))->whereIn('status', ['FULL TIME', 'SEPENUH MASA'])->count();
        $uni_staff_parttime = MasterlistCriticalMass::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('sponsor_category', $this->sponsor_category('university'))->whereIn('status', ['PART TIME', 'SEPARUH MASA'])->count();
        $uni_staff = $uni_staff_fulltime + $uni_staff_parttime;
        $national_staff_fulltime = MasterlistCriticalMass::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('sponsor_category', $this->sponsor_category('national'))->whereIn('status', ['FULL TIME', 'SEPENUH MASA'])->count();
        $national_staff_parttime = MasterlistCriticalMass::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('sponsor_category', $this->sponsor_category('national'))->whereIn('status', ['PART TIME', 'SEPARUH MASA'])->count();
        $national_staff = $national_staff_fulltime + $national_staff_parttime;
        $private_staff_fulltime = MasterlistCriticalMass::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('sponsor_category', $this->sponsor_category('private'))->whereIn('status', ['FULL TIME', 'SEPENUH MASA'])->count();
        $private_staff_parttime = MasterlistCriticalMass::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('sponsor_category', $this->sponsor_category('private'))->whereIn('status', ['PART TIME', 'SEPARUH MASA'])->count();
        $private_staff = $private_staff_fulltime + $private_staff_parttime;
        $international_staff_fulltime = MasterlistCriticalMass::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('sponsor_category', $this->sponsor_category('international'))->whereIn('status', ['FULL TIME', 'SEPENUH MASA'])->count();
        $international_staff_parttime = MasterlistCriticalMass::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('sponsor_category', $this->sponsor_category('international'))->whereIn('status', ['PART TIME', 'SEPARUH MASA'])->count();
        $international_staff = $international_staff_fulltime + $international_staff_parttime;

        $phd_pro = MasterlistProfessionalQualification::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $phd_fulltime = MasterlistProfessionalQualification::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('acad_qualification', ['PHD'])->whereIn('status1', ['ACTIVE', 'AKTIF'])->whereIn('status3', ['FULL TIME', 'SEPENUH MASA'])->count();
        $phd_parttime = MasterlistProfessionalQualification::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('acad_qualification', ['PHD'])->whereIn('status1', ['ACTIVE', 'AKTIF'])->whereIn('status3', ['PART TIME', 'SEPARUH MASA'])->count();
        $phd = $phd_fulltime + $phd_parttime;
        $pro_fulltime = MasterlistProfessionalQualification::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereNotNull('professional_qualification_1')->whereIn('status1', ['ACTIVE', 'AKTIF'])->whereIn('status3', ['FULL TIME', 'SEPENUH MASA'])->count();
        $pro_parttime = MasterlistProfessionalQualification::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereNotNull('professional_qualification_1')->whereIn('status1', ['ACTIVE', 'AKTIF'])->whereIn('status3', ['PART TIME', 'SEPARUH MASA'])->count();
        $pro = $pro_fulltime + $pro_parttime;

        $cohort_staff = MasterlistResearchExperience::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('status1', ['ACTIVE', 'AKTIF'])->whereIn('status3', ['FULL TIME', 'SEPENUH MASA'])->count();
        $a50 = MasterlistResearchExperience::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('status1', ['ACTIVE', 'AKTIF'])->whereIn('status3', ['FULL TIME', 'SEPENUH MASA'])->where('age', '>', 50)->count();
        $a40 = MasterlistResearchExperience::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('status1', ['ACTIVE', 'AKTIF'])->whereIn('status3', ['FULL TIME', 'SEPENUH MASA'])->where('age', '>=', 40)->where('age', '<=', 50)->count();
        $b40 = MasterlistResearchExperience::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('status1', ['ACTIVE', 'AKTIF'])->whereIn('status3', ['FULL TIME', 'SEPENUH MASA'])->where('age', '<', 40)->count();

        $award_int = MasterlistAward::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('nat_int', $this->nat_int('international'))->whereIn('award_type', $this->award_type('award', 'international'))->count();
        $recog_int = MasterlistAward::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('nat_int', $this->nat_int('international'))->whereIn('award_type',$this->award_type('recognition_stewardship', 'international'))->count();
        $award_nat = MasterlistAward::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('nat_int', $this->nat_int('national'))->whereIn('award_type', $this->award_type('award', 'national'))->count();
        $recog_nat = MasterlistAward::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('nat_int', $this->nat_int('national'))->whereIn('award_type',$this->award_type('recognition_stewardship', 'national'))->count();
        $exhibition = MasterlistAward::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('award_type',$this->award_type('exhibition', 'all'))->count();
        $other = MasterlistAward::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('award_type',$this->award_type('other', 'all'))->count();

        //Calculation
        $active_acad_staff = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_st = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->where('st', 'S&T')->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_nonst = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->where('st', 'NON S&T')->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();

        $important_data = (object)[
            'year' => $year,
            'uni_staff' => $uni_staff,
            'national_staff' => $national_staff,
            'private_staff' => $private_staff,
            'international_staff' => $international_staff,
            'phd' => $phd,
            'pro' => $pro,
            'a50' => $a50,
            'a40' => $a40,
            'b40' => $b40,
            'award_int' => $award_int,
            'recog_int' => $recog_int,
            'award_nat' => $award_nat,
            'recog_nat' => $recog_nat,
            'exhibition' => $exhibition,
            'other' => $other,
        ];

        $calculation = $this->calcSectionB($active_acad_staff, $active_st, $active_nonst, $important_data);

        return (object)[
            'faculties' => $faculties,
            'schools' => $schools,

            'active_staff' => $active_staff,
            'uni_staff_fulltime' => $uni_staff_fulltime,
            'uni_staff_parttime' => $uni_staff_parttime,
            'uni_staff' => $uni_staff,
            'national_staff_fulltime' => $national_staff_fulltime,
            'national_staff_parttime' => $national_staff_parttime,
            'national_staff' => $national_staff,
            'private_staff_fulltime' => $private_staff_fulltime,
            'private_staff_parttime' => $private_staff_parttime,
            'private_staff' => $private_staff,
            'international_staff_fulltime' => $international_staff_fulltime,
            'international_staff_parttime' => $international_staff_parttime,
            'international_staff' => $international_staff,

            'phd_pro' => $phd_pro,
            'phd_fulltime' => $phd_fulltime,
            'phd_parttime' => $phd_parttime,
            'phd' => $phd,
            'pro_fulltime' => $pro_fulltime,
            'pro_parttime' => $pro_parttime,
            'pro' => $pro,

            'cohort_staff' => $cohort_staff,
            'a50' => $a50,
            'a40' => $a40,
            'b40' => $b40,

            'award_int' => $award_int,
            'recog_int' => $recog_int,
            'award_nat' => $award_nat,
            'recog_nat' => $recog_nat,
            'exhibition' => $exhibition,
            'other' => $other,

            'calculation' => $calculation
        ];
    }

    public function myraSectionC($year, $faculty = null) {
        $faculties = [];
        $schools = [];
        $journal = MasterlistPublication::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->wherePublicationType('journal')->count();
        $proceeding = MasterlistPublication::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->wherePublicationType('proceeding')->count();
        $joint_industrial = MasterlistPublication::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->wherePublicationType('journal')->whereIndustrial('Y')->count();
        $joint_international = MasterlistPublication::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->wherePublicationType('journal')->whereInternational('Y')->count();
        $joint_national = MasterlistPublication::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->wherePublicationType('journal')->whereNational('Y')->count();
        $citation = MasterlistPublication::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->wherePublicationType('others_journal')->count();
        $q1_q2 = MasterlistPublication::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->wherePublicationType('journal')->whereIn('quartile', ['Q1','Q2'])->count();
        $q1_q2_percent = $journal > 0 ? number_format($q1_q2/$journal*100, 2) : 0;
        $mycite = MasterlistPublication::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->wherePublicationType('mycite')->count();
        $book_indexed = MasterlistPublication::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->wherePublicationType('research_book')->whereIn('book_status',['INDEXED',' INDEXED'])->count();
        $book_not_indexed = MasterlistPublication::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->wherePublicationType('research_book')->whereNotIn('book_status',['INDEXED',' INDEXED'])->count();
        $book_national = MasterlistPublication::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->wherePublicationType('research_book')->whereNational('Y')->count();
        $chapter_indexed = MasterlistPublication::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->wherePublicationType('chapter_research_book')->whereIn('book_status',['INDEXED',' INDEXED'])->count();
        $chapter_not_indexed = MasterlistPublication::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->wherePublicationType('chapter_research_book')->whereNotIn('book_status',['INDEXED',' INDEXED'])->count();
        $case_studies = MasterlistPublication::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->wherePublicationType('case_studies')->count();
        $policy_paper = MasterlistPublication::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->wherePublicationType('policy_paper')->count();
        $other = MasterlistPublication::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->wherePublicationType('other')->count();

        $home_pledge_new = (float)number_format(MasterlistResearchGrant::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('sponsor_category', ['UNIVERSITY', 'NATIONAL'])->whereYear('start_date', $year)->sum('amount_pledged'), 2, '.', '');
        $home_receive_active = (float)number_format(MasterlistResearchGrant::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('sponsor_category', ['UNIVERSITY', 'NATIONAL'])->sum('amount_received'), 2, '.', '');
        $private_pledge_new = (float)number_format(MasterlistResearchGrant::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('sponsor_category', $this->sponsor_category('private'))->whereYear('start_date', $year)->sum('amount_pledged'), 2, '.', '');
        $private_receive_active = (float)number_format(MasterlistResearchGrant::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('sponsor_category', $this->sponsor_category('private'))->sum('amount_received'), 2, '.', '');
        $international_pledge_new = (float)number_format(MasterlistResearchGrant::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('sponsor_category', $this->sponsor_category('international'))->whereYear('start_date', $year)->sum('amount_pledged'), 2, '.', '');
        $international_receive_active = (float)number_format(MasterlistResearchGrant::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('sponsor_category', $this->sponsor_category('international'))->sum('amount_received'), 2, '.', '');
        $research_grant_received = (float)number_format($home_receive_active+$private_receive_active+$international_receive_active, 2, '.', '');

        $project_without_ext = MasterlistMonitoringProject::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->where('project_extension', 'NO')->where('project_status', 'COMPLETED')->count();
        $project_with_ext = MasterlistMonitoringProject::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->where('project_extension', 'YES')->where('project_status', 'COMPLETED')->count();
        $total_project = MasterlistMonitoringProject::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $project_complete_on_time = $total_project > 0 ? (float)number_format($project_without_ext/$total_project*100, 2) : 0;

        //Calculation
        $active_acad_staff = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_st = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->where('st', 'S&T')->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_nonst = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->where('st', 'NON S&T')->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();

         $important_data = (object)[
            'year' => $year,
            
            'journal' => $journal,
            'proceeding' => $proceeding,
            'joint_industrial' => $joint_industrial,
            'joint_international' => $joint_international,
            'joint_national' => $joint_national,
            'citation' => $citation,
            'q1_q2' => $q1_q2,
            'mycite' => $mycite,
            'book_indexed' => $book_indexed,
            'book_not_indexed' => $book_not_indexed,
            'chapter_indexed' => $chapter_indexed,
            'chapter_not_indexed' => $chapter_not_indexed,
            'case_studies' => $case_studies,
            'policy_paper' => $policy_paper,
            'other' => $other,
            'home_pledge_new' => $home_pledge_new,
            'home_receive_active' => $home_receive_active,
            'private_pledge_new' => $private_pledge_new,
            'private_receive_active' => $private_receive_active,
            'international_pledge_new' => $international_pledge_new,
            'international_receive_active' => $international_receive_active,
            'project_without_ext' => $project_without_ext,
            'project_with_ext' => $project_with_ext,
        ];

        $calculation = $this->calcSectionC($active_acad_staff, $active_st, $active_nonst, $important_data);

        return (object)[
            'faculties' => $faculties,
            'schools' => $schools,
            'journal' => $journal,
            'proceeding' => $proceeding,
            'joint_industrial' => $joint_industrial,
            'joint_international' => $joint_international,
            'joint_national' => $joint_national,
            'citation' => $citation,
            'q1_q2' => $q1_q2,
            'q1_q2_percent' => $q1_q2_percent,
            'mycite' => $mycite,
            'book_indexed' => $book_indexed,
            'book_not_indexed' => $book_not_indexed,
            'book_national' => $book_national,
            'chapter_indexed' => $chapter_indexed,
            'chapter_not_indexed' => $chapter_not_indexed,
            'case_studies' => $case_studies,
            'policy_paper' => $policy_paper,
            'other' => $other,

            'home_pledge_new' => $home_pledge_new,
            'home_receive_active' => $home_receive_active,
            'private_pledge_new' => $private_pledge_new,
            'private_receive_active' => $private_receive_active,
            'international_pledge_new' => $international_pledge_new,
            'international_receive_active' => $international_receive_active,
            'research_grant_received' => $research_grant_received,

            'project_without_ext' => $project_without_ext,
            'project_with_ext' => $project_with_ext,
            'project_complete_on_time' => $project_complete_on_time,

            'calculation' => $calculation
        ];
    }

    public function myraSectionD($year, $faculty = null) {
        $faculties = [];
        $schools = [];
        $total_phd = MasterlistPhdGraduate::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $phd_local = MasterlistPhdGraduate::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('citizenship', ['TEMPATAN', 'LOCAL'])->count();
        $phd_foreign = MasterlistPhdGraduate::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('citizenship', ['ANTARABANGSA', 'FOREIGN'])->count();
        $academic_staff = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $phd_ratio = $academic_staff > 0? (float)number_format($total_phd/$academic_staff, 2) : 0;
        $phd_graduate_7 = MasterlistPhdGraduate::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('got', $this->got('yes'))->count();
        $phd_graduate_7_percent =$total_phd > 0 ? (float)number_format($phd_graduate_7/$total_phd*100, 2) : 0;

        $total_master = MasterlistMasterGraduate::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();

        $total_phd_enrolled = MasterlistPhdEnroll::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $phd_enrolled_ratio = $academic_staff > 0? (float)number_format($total_phd_enrolled/$academic_staff, 2) : 0;
        $total_phd_st_enrolled = MasterlistPhdEnroll::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('st', ['S&T', 'ST'])->count();

        $pg_enrolled = MasterlistPgStudent::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $pg_enrolled_ratio = $academic_staff > 0 ? (float)number_format($pg_enrolled/$academic_staff, 2) : 0;
        $pg_enrolled_mixed_mode = MasterlistPgStudent::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('study_mode', $this->student_study_mode('research'))->count();
        $ug_enrolled = MasterlistUgStudent::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $pg_enrolled_mixed_mode_ratio = $ug_enrolled > 0 ? (float)number_format($pg_enrolled_mixed_mode/$ug_enrolled, 2) : 0;

        $int_pg_enrolled = MasterlistPgStudent::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('citizenship', $this->filter_citizenship('foreign'))->count();
        $int_pg_enrolled_percent = $pg_enrolled > 0 ? (float)number_format($int_pg_enrolled/$pg_enrolled*100, 2) : 0;

        $entry_enrolled = MasterlistEntryQualification::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $entry_enrolled_percent = $pg_enrolled > 0 ? (float)number_format($entry_enrolled/$pg_enrolled*100, 2) : 0;
        
        $fellowship_enrolled = MasterlistFellowship::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $fellowship_enrolled_percent = $pg_enrolled > 0 ? (float)number_format($fellowship_enrolled/$pg_enrolled*100, 2) : 0;
        // dd($fellowship_enrolled);
        $local_post_doc = MasterlistPostDoc::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('citizenship', ['LOCAL', 'TEMPATAN'])->count();
        $foreign_post_doc = MasterlistPostDoc::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('citizenship', $this->filter_citizenship('foreign'))->count();

        //Calculation
        $active_acad_staff = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_st = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->where('st', 'S&T')->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_nonst = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->where('st', 'NON S&T')->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();

         $important_data = (object)[
            'year' => $year,
            
            'phd_local' => $phd_local,
            'phd_foreign' => $phd_foreign,
            'phd_graduate_7' => $phd_graduate_7,
            'total_master' => $total_master,
            'total_phd_enrolled' => $total_phd_enrolled,
            'total_phd_st_enrolled' => $total_phd_st_enrolled,
            'pg_enrolled' => MasterlistPgStudent::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count(),
            'pg_research' => MasterlistPgStudent::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('study_mode', $this->student_study_mode('research'))->count(),
            'pg_enrolled_ratio' => $pg_enrolled_ratio,
            'pg_enrolled_mixed_mode_ratio' => $pg_enrolled_mixed_mode_ratio,
            'int_pg_enrolled' => $int_pg_enrolled,
            'int_pg_enrolled_percent' => $int_pg_enrolled_percent,
            'entry_enrolled' => $entry_enrolled,
            'entry_enrolled_percent' => $entry_enrolled_percent,
            'fellowship_enrolled' => $fellowship_enrolled,
            'fellowship_enrolled_percent' => $fellowship_enrolled_percent,
            'local_post_doc' => $local_post_doc,
            'foreign_post_doc' => $foreign_post_doc,
        ];

        $calculation = $this->calcSectionD($active_acad_staff, $active_st, $active_nonst, $important_data);
        return (object)[
            'faculties' => $faculties,
            'schools' => $schools,
            'total_phd' => $total_phd,
            'phd_local' => $phd_local,
            'phd_foreign' => $phd_foreign,
            'phd_ratio' => $phd_ratio,
            'phd_graduate_7' => $phd_graduate_7,
            'phd_graduate_7_percent' => $phd_graduate_7_percent,

            'total_master' => $total_master,

            'total_phd_enrolled' => $total_phd_enrolled,
            'phd_enrolled_ratio' => $phd_enrolled_ratio,
            'total_phd_st_enrolled' => $total_phd_st_enrolled,

            'pg_enrolled' => $pg_enrolled,
            'pg_enrolled_mixed_mode' => $pg_enrolled_mixed_mode,
            'pg_enrolled_ratio' => $pg_enrolled_ratio,
            'pg_enrolled_mixed_mode_ratio' => $pg_enrolled_mixed_mode_ratio,

            'int_pg_enrolled' => $int_pg_enrolled,
            'int_pg_enrolled_percent' => $int_pg_enrolled_percent,

            'entry_enrolled' => $entry_enrolled,
            'entry_enrolled_percent' => $entry_enrolled_percent,

            'fellowship_enrolled' => $fellowship_enrolled,
            'fellowship_enrolled_percent' => $fellowship_enrolled_percent,

            'local_post_doc' => $local_post_doc,
            'foreign_post_doc' => $foreign_post_doc,

            'calculation' => $calculation
        ];
    }

    public function myraSectionE($year, $faculty = null) {
        $faculties = [];
        $schools = [];
        $grant_local = MasterlistPatentGrant::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $grant_foreign = 0;
        $grant = $grant_local+$grant_foreign;
        $file_local = MasterlistPatentFile::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('country', ['MALAYSIA', 'Malaysia'])->count();
        $file_foreign = MasterlistPatentFile::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereNotIn('country', ['MALAYSIA', 'Malaysia'])->count();
        $file = $file_local+$file_foreign;
        $comm_product = MasterlistCommProduct::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $know_how_sold = MasterlistKnowHowSold::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $other_ipr = MasterlistOtherIpr::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $active_company = MasterlistActiveCompany::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $new_company = MasterlistNewCompany::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();

        //Calculation
        $active_acad_staff = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_st = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->where('st', 'S&T')->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_nonst = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->where('st', 'NON S&T')->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();

         $important_data = (object)[
            'year' => $year,
            
            'grant_local' => $grant_local,
            'grant_foreign' => $grant_foreign,
            'file_local' => $file_local,
            'file_foreign' => $file_foreign,
            'comm_product' => $comm_product,
            'know_how_sold' => $know_how_sold,
            'other_ipr' => $other_ipr,
            'active_company' => $active_company,
            'new_company' => $new_company,
        ];

        $calculation = $this->calcSectionE($active_acad_staff, $active_st, $active_nonst, $important_data);

        return (object)[
            'faculties' => $faculties,
            'schools' => $schools,
            'grant' => $grant,
            'grant_local' => $grant_local,
            'grant_foreign' => $grant_foreign,
            'file_local' => $file_local,
            'file_foreign' => $file_foreign,
            'file' => $file,

            'comm_product' => $comm_product,
            'know_how_sold' => $know_how_sold,
            'other_ipr' => $other_ipr,
            'active_company' => $active_company,
            'new_company' => $new_company,

            'calculation' => $calculation
        ];
    }

    public function myraSectionF($year, $faculty = null) {
        $faculties = [];
        $schools = [];
        $training_course = (float)number_format(MasterlistTrainingCourse::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->sum('gross_income'), 2, '.', '');
        $pg_fee = (float)number_format(MasterlistPgFee::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->sum('gross_income'), 2, '.', '');
        $conference = (float)number_format(MasterlistConference::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->sum('gross_income'), 2, '.', '');
        $product_comm = (float)number_format(MasterlistProductCommRef::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->sum('gross_income'), 2, '.', '');
        $tech_know_how = (float)number_format(MasterlistTechKnowHow::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->sum('gross_income'), 2, '.', '');
        $consultancy = (float)number_format(MasterlistConsultancy::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->sum('gross_income'), 2, '.', '');
        $hospital = 0;
        $lab_service = (float)number_format(MasterlistLabService::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->sum('gross_income'), 2, '.', '');
        $new_endowment = (float)number_format(MasterlistNewEndowment::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->sum('amount_endowed_percent_research'), 2, '.', '');
        $existing_endowment = (float)number_format(MasterlistNewEndowment::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->sum('amount_endowed_percent_research'), 2, '.', '');
        $gift = (float)number_format(MasterlistGift::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->sum('value'), 2, '.', '');
        $oe_expenditure = (float)number_format(MasterlistMonitoringProject::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->sum('amount_spent'), 2, '.', '');
        $rd_expenditure = (float)number_format(MasterlistMonitoringProject::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->where('amount_received', '>', 0)->sum('amount_spent'), 2, '.', '');

        //Calculation
        $active_acad_staff = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_st = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->where('st', 'S&T')->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_nonst = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->where('st', 'NON S&T')->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();

         $important_data = (object)[
            'year' => $year,
            
            'training_course' => $training_course,
            'pg_fee' => $pg_fee,
            'conference' => $conference,
            'product_comm' => $product_comm,
            'tech_know_how' => $tech_know_how,
            'consultancy' => $consultancy,
            'hospital' => $hospital,
            'lab_service' => $lab_service,
            'new_endowment' => $new_endowment,
            'existing_endowment' => $existing_endowment,
            'gift' => $gift,
            'oe_expenditure' => $oe_expenditure,
            'rd_expenditure' => $rd_expenditure,
        ];

        $calculation = $this->calcSectionF($active_acad_staff, $active_st, $active_nonst, $important_data);

        return (object)[
            'faculties' => $faculties,
            'schools' => $schools,
            'training_course' => $training_course,
            'pg_fee' => $pg_fee,
            'conference' => $conference,
            'product_comm' => $product_comm,
            'tech_know_how' => $tech_know_how,
            'consultancy' => $consultancy,
            'hospital' => $hospital,
            'lab_service' => $lab_service,
            'new_endowment' => $new_endowment,
            'existing_endowment' => $existing_endowment,
            'gift' => $gift,
            'oe_expenditure' => $oe_expenditure,
            'rd_expenditure' => $rd_expenditure,
            'calculation' => $calculation
        ];
    }

    public function myraSectionG($year, $faculty = null) {
        $faculties = [];
        $schools = [];
        $total_int_moa = MasterlistInternationalMoa::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $int_moa_industry = MasterlistInternationalMoa::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('category', ['INDUSTRY'])->count();
        $int_moa_community = MasterlistInternationalMoa::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('category', ['COMMUNITY'])->count();
        $int_moa_university = MasterlistInternationalMoa::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('category', ['UNIVERSITY'])->count();
        $int_moa_agency = MasterlistInternationalMoa::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('category', ['AGENCY'])->count();
        $total_staff_int_moa = MasterlistStaffInternationalMoa::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $staff_sent_abroad = MasterlistStaffSentAbroad::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $member_international = MasterlistMembershipInternational::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $other_international = MasterlistMembershipInternational::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereNotIn('staff_type', ['MEMBER','AHLI'])->count();
        $total_nat_moa = MasterlistNationalMoa::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $nat_moa_industry = MasterlistNationalMoa::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('category', ['INDUSTRY'])->count();
        $nat_moa_community = MasterlistNationalMoa::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('category', ['COMMUNITY'])->count();
        $nat_moa_university = MasterlistNationalMoa::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('category', ['UNIVERSITY'])->count();
        $nat_moa_agency = MasterlistNationalMoa::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('category', ['AGENCY'])->count();
        $total_staff_nat_moa = MasterlistStaffNationalMoa::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $member_national = MasterlistMembershipNational::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $other_national = MasterlistMembershipNational::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereNotIn('staff_type', ['MEMBER','AHLI'])->count();
        $new_ktp = MasterlistNewKtp::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $benefited_ktp = MasterlistBenefitedKtp::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $joint_research_project = MasterlistJointResearchProject::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $joint_research_project_ru = MasterlistJointResearchRu::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();

        //Calculation
        $active_acad_staff = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_st = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->where('st', 'S&T')->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_nonst = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->where('st', 'NON S&T')->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();

         $important_data = (object)[
            'year' => $year,
            
            'int_moa_industry' => $int_moa_industry,
            'int_moa_community' => $int_moa_community,
            'int_moa_university' => $int_moa_university,
            'int_moa_agency' => $int_moa_agency,
            'total_staff_int_moa' => $total_staff_int_moa,
            'staff_sent_abroad' => $staff_sent_abroad,
            'member_international' => $member_international,
            'other_international' => $other_international,
            'nat_moa_industry' => $nat_moa_industry,
            'nat_moa_community' => $nat_moa_community,
            'nat_moa_university' => $nat_moa_university,
            'nat_moa_agency' => $nat_moa_agency,
            'total_staff_nat_moa' => $total_staff_nat_moa,
            'member_national' => $member_national,
            'other_national' => $other_national,
            'new_ktp' => $new_ktp,
            'benefited_ktp' => $benefited_ktp,
            'joint_research_project' => $joint_research_project,
            'joint_research_project_ru' => $joint_research_project_ru,
        ];

        $calculation = $this->calcSectionG($active_acad_staff, $active_st, $active_nonst, $important_data);

        return (object)[
            'faculties' => $faculties,
            'schools' => $schools,
            'total_int_moa' => $total_int_moa,
            'int_moa_industry' => $int_moa_industry,
            'int_moa_community' => $int_moa_community,
            'int_moa_university' => $int_moa_university,
            'int_moa_agency' => $int_moa_agency,
            'total_staff_int_moa' => $total_staff_int_moa,
            'staff_sent_abroad' => $staff_sent_abroad,
            'member_international' => $member_international,
            'other_international' => $other_international,
            'total_nat_moa' => $total_nat_moa,
            'nat_moa_industry' => $nat_moa_industry,
            'nat_moa_community' => $nat_moa_community,
            'nat_moa_university' => $nat_moa_university,
            'nat_moa_agency' => $nat_moa_agency,
            'total_staff_nat_moa' => $total_staff_nat_moa,
            'member_national' => $member_national,
            'other_national' => $other_national,
            'new_ktp' => $new_ktp,
            'benefited_ktp' => $benefited_ktp,
            'joint_research_project' => $joint_research_project,
            'joint_research_project_ru' => $joint_research_project_ru,

            'calculation' => $calculation
        ];
    }

    public function myraSectionH($year, $faculty = null) {
        $faculties = [];
        $schools = [];
        $support = MasterlistSupportFacility::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->count();
        $book = MasterlistLibraryFacility::where('ml_end_year', $year)->where('type', 'like', '%Book Printed%')->sum('no_of_title');
        $book_online = MasterlistLibraryFacility::where('ml_end_year', $year)->where('type', 'like', '%E-Book%')->sum('no_of_title');
        $journal_subscribed = MasterlistLibraryFacility::where('ml_end_year', $year)->whereIn('type', ['E-Journal','Journal Printed'])->sum('no_of_title');

        //Calculation
        $active_acad_staff = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_st = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->where('st', 'S&T')->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();
        $active_nonst = MasterlistAcademicStaff::where('ml_end_year', $year)->where(function ($q) use ($faculty, $year) {if($faculty){if($faculty == 'FKT' && $year != 2022){{$q->where('school_short', 'SKT');}} else {$q->where('faculty_short', $faculty);}}})->where('st', 'NON S&T')->whereIn('status1', ['ACTIVE', 'AKTIF'])->count();

         $important_data = (object)[
            'year' => $year,
            
            'support' => $support,
            'library' => $book + $book_online + $journal_subscribed,
        ];

        $calculation = $this->calcSectionH($active_acad_staff, $active_st, $active_nonst, $important_data);

        return (object)[
            'faculties' => $faculties,
            'schools' => $schools,
            'support' => $support,
            'book' => $book,
            'book_online' => $book_online,
            'journal_subscribed' => $journal_subscribed,
            'calculation' => $calculation
        ];
    }

    public function myraSummary($year) {
        $data_entry_flag = 0;
        $section_b = MyraCalculation::select('overall')->where('year', $year)->whereType('section_b')->first();
        $section_c = MyraCalculation::select('overall')->where('year', $year)->whereType('section_c')->first();
        $section_d = MyraCalculation::select('overall')->where('year', $year)->whereType('section_d')->first();
        $section_e = MyraCalculation::select('overall')->where('year', $year)->whereType('section_e')->first();
        $section_f = MyraCalculation::select('overall')->where('year', $year)->whereType('section_f')->first();
        $section_g = MyraCalculation::select('overall')->where('year', $year)->whereType('section_g')->first();
        $section_h = MyraCalculation::select('overall')->where('year', $year)->whereType('section_h')->first();
        if($section_b)$data_entry_flag++;
        if($section_c)$data_entry_flag++;
        if($section_d)$data_entry_flag++;
        if($section_e)$data_entry_flag++;
        if($section_f)$data_entry_flag++;
        if($section_g)$data_entry_flag++;
        if($section_h)$data_entry_flag++;

        $section_b = json_decode($section_b->overall ?? '');
        $section_c = json_decode($section_c->overall ?? '');
        $section_d = json_decode($section_d->overall ?? '');
        $section_e = json_decode($section_e->overall ?? '');
        $section_f = json_decode($section_f->overall ?? '');
        $section_g = json_decode($section_g->overall ?? '');
        $section_h = json_decode($section_h->overall ?? '');
        $data = (object)[
            'data_entry_label' => $data_entry_flag == 7 ? 'COMPLETE' : 'NOT COMPLETE',
            'data_entry_color' => $data_entry_flag == 7 ? 'green' : 'red',
            'section_b' => (object)[
                'myra1_mark' => (float)number_format($section_b->myra1_mark ?? 0, 2),
                'myra1_benchmark_mark' => (float)number_format($section_b->myra1_benchmark_mark ?? 0, 2),
                'myra1_achievement' => (float)number_format($section_b->myra1_achievement ?? 0, 2),
                'myra2_mark' => (float)number_format($section_b->myra2_mark ?? 0, 2),
                'myra2_benchmark_mark' => (float)number_format($section_b->myra2_benchmark_mark ?? 0, 2),
                'myra2_achievement' => (float)number_format($section_b->myra2_achievement ?? 0, 2),
            ],
            'section_c' => (object)[
                'myra1_mark' => (float)number_format($section_c->myra1_mark ?? 0, 2),
                'myra1_benchmark_mark' => (float)number_format($section_c->myra1_benchmark_mark ?? 0, 2),
                'myra1_achievement' => (float)number_format($section_c->myra1_achievement ?? 0, 2),
                'myra2_mark' => (float)number_format($section_c->myra2_mark ?? 0, 2),
                'myra2_benchmark_mark' => (float)number_format($section_c->myra2_benchmark_mark ?? 0, 2),
                'myra2_achievement' => (float)number_format($section_c->myra2_achievement ?? 0, 2),
            ],
            'section_d' => (object)[
                'myra1_mark' => (float)number_format($section_d->myra1_mark ?? 0, 2),
                'myra1_benchmark_mark' => (float)number_format($section_d->myra1_benchmark_mark ?? 0, 2),
                'myra1_achievement' => (float)number_format($section_d->myra1_achievement ?? 0, 2),
                'myra2_mark' => (float)number_format($section_d->myra2_mark ?? 0, 2),
                'myra2_benchmark_mark' => (float)number_format($section_d->myra2_benchmark_mark ?? 0, 2),
                'myra2_achievement' => (float)number_format($section_d->myra2_achievement ?? 0, 2),
            ],
            'section_e' => (object)[
                'myra1_mark' => (float)number_format($section_e->myra1_mark ?? 0, 2),
                'myra1_benchmark_mark' => (float)number_format($section_e->myra1_benchmark_mark ?? 0, 2),
                'myra1_achievement' => (float)number_format($section_e->myra1_achievement ?? 0, 2),
                'myra2_mark' => (float)number_format($section_e->myra2_mark ?? 0, 2),
                'myra2_benchmark_mark' => (float)number_format($section_e->myra2_benchmark_mark ?? 0, 2),
                'myra2_achievement' => (float)number_format($section_e->myra2_achievement ?? 0, 2),
            ],
            'section_f' => (object)[
                'myra1_mark' => (float)number_format($section_f->myra1_mark ?? 0, 2),
                'myra1_benchmark_mark' => (float)number_format($section_f->myra1_benchmark_mark ?? 0, 2),
                'myra1_achievement' => (float)number_format($section_f->myra1_achievement ?? 0, 2),
                'myra2_mark' => (float)number_format($section_f->myra2_mark ?? 0, 2),
                'myra2_benchmark_mark' => (float)number_format($section_f->myra2_benchmark_mark ?? 0, 2),
                'myra2_achievement' => (float)number_format($section_f->myra2_achievement ?? 0, 2),
            ],
            'section_g' => (object)[
                'myra1_mark' => (float)number_format($section_g->myra1_mark ?? 0, 2),
                'myra1_benchmark_mark' => (float)number_format($section_g->myra1_benchmark_mark ?? 0, 2),
                'myra1_achievement' => (float)number_format($section_g->myra1_achievement ?? 0, 2),
                'myra2_mark' => (float)number_format($section_g->myra2_mark ?? 0, 2),
                'myra2_benchmark_mark' => (float)number_format($section_g->myra2_benchmark_mark ?? 0, 2),
                'myra2_achievement' => (float)number_format($section_g->myra2_achievement ?? 0, 2),
            ],
            'section_h' => (object)[
                'myra1_mark' => (float)number_format($section_h->myra1_mark ?? 0, 2),
                'myra1_benchmark_mark' => (float)number_format($section_h->myra1_benchmark_mark ?? 0, 2),
                'myra1_achievement' => (float)number_format($section_h->myra1_achievement ?? 0, 2),
                'myra2_mark' => (float)number_format($section_h->myra2_mark ?? 0, 2),
                'myra2_benchmark_mark' => (float)number_format($section_h->myra2_benchmark_mark ?? 0, 2),
                'myra2_achievement' => (float)number_format($section_h->myra2_achievement ?? 0, 2),
            ],
        ];
        $myra1_total_mark = $data->section_b->myra1_mark+$data->section_c->myra1_mark+$data->section_d->myra1_mark+$data->section_e->myra1_mark+$data->section_f->myra1_mark+$data->section_g->myra1_mark+$data->section_h->myra1_mark;
        $myra1_total_benchmark_mark = $data->section_b->myra1_benchmark_mark+$data->section_c->myra1_benchmark_mark+$data->section_d->myra1_benchmark_mark+$data->section_e->myra1_benchmark_mark+$data->section_f->myra1_benchmark_mark+$data->section_g->myra1_benchmark_mark+$data->section_h->myra1_benchmark_mark;
        $myra1_total_achievement = $myra1_total_benchmark_mark > 0? (float)number_format($myra1_total_mark/$myra1_total_benchmark_mark*100, 2) : 0.00;
        $myra2_total_mark = $data->section_b->myra2_mark+$data->section_c->myra2_mark+$data->section_d->myra2_mark+$data->section_e->myra2_mark+$data->section_f->myra2_mark+$data->section_g->myra2_mark+$data->section_h->myra2_mark;
        $myra2_total_benchmark_mark = $data->section_b->myra2_benchmark_mark+$data->section_c->myra2_benchmark_mark+$data->section_d->myra2_benchmark_mark+$data->section_e->myra2_benchmark_mark+$data->section_f->myra2_benchmark_mark+$data->section_g->myra2_benchmark_mark+$data->section_h->myra2_benchmark_mark;
        $myra2_total_achievement = $myra2_total_benchmark_mark > 0? (float)number_format($myra2_total_mark/$myra2_total_benchmark_mark*100, 2) : 0.00;
        $data->total = (object)[
            'myra1_total_mark' => $myra1_total_mark,
            'myra1_total_benchmark_mark' => $myra1_total_benchmark_mark,
            'myra1_total_achievement' => $myra1_total_achievement,
            'myra1_label' => $data_entry_flag == 7 ? ($myra1_total_achievement > 100? "CONGRATULATIONS" : "GOOD") : "N/A",
            'myra1_color' => $data_entry_flag == 7 ? ($myra1_total_achievement > 100? "myra-soft-green" : "myra-bright-yellow") : "myra-gray",
            'myra2_total_mark' => $myra2_total_mark,
            'myra2_total_benchmark_mark' => $myra2_total_benchmark_mark,
            'myra2_total_achievement' => $myra2_total_achievement,
            'myra2_label' => $data_entry_flag == 7 ? ($myra2_total_achievement >= 75? "PASS" : "FAILED") : "N/A",
            'myra2_color' =>  $data_entry_flag == 7 ? ($myra2_total_achievement >= 75? "myra-soft-green" : "myra-pink") : "myra-gray",
        ];
        return $data;
    }
}