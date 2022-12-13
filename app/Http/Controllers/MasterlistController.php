<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAttachment;
use App\Models\MasterList\MasterlistAcademicStaff;
use App\Models\MasterList\MasterlistUgStudent;
use App\Models\MasterList\MasterlistPgStudent;
use App\Models\MasterList\MasterlistCriticalMass;
use App\Models\MasterList\MasterlistProfessionalQualification;
use App\Models\MasterList\MasterlistResearchExperience;
use App\Models\MasterList\MasterlistAward;
use App\Models\MasterList\MasterlistPublication;
use App\Models\MasterList\MasterlistResearchGrant;
use App\Models\MasterList\MasterlistExpenditureProject;
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
use App\Models\MasterList\MasterlistIncomeDividend;
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

use App\Models\MasterList\MasterlistClaim;
use App\Models\MasterList\MasterlistElnptActivity;
use App\Models\MasterList\MasterlistElnptGrantApplication;
use App\Models\MasterList\MasterlistElnptGra;
use App\Models\MasterList\MasterlistElnptProposal;
use App\Models\MasterList\MasterlistElnptActiveGrant;
use App\Models\MasterList\MasterlistRaroProcess;

use App\Imports\AcadStaffImport;
use App\Imports\UGStudentImport;
use App\Imports\PGStudentImport;
use App\Imports\CriticalMassImport;
use App\Imports\ProfessionalQualificationImport;
use App\Imports\ResearchExperienceImport;
use App\Imports\AwardImport;
use App\Imports\PublicationImport;
use App\Imports\ResearchGrantImport;
use App\Imports\ExpenditureProjectImport;
use App\Imports\MonitoringProjectImport;
use App\Imports\PhdGraduatedImport;
use App\Imports\MasterGraduatedImport;
use App\Imports\PhdEnrolledImport;
use App\Imports\EntryQualificationImport;
use App\Imports\FellowshipImport;
use App\Imports\PostDocImport;
use App\Imports\PatentGrantedImport;
use App\Imports\PatentFiledImport;
use App\Imports\CommProductImport;
use App\Imports\KnowHowSoldImport;
use App\Imports\OtherIprImport;
use App\Imports\ActiveCompanyImport;
use App\Imports\NewCompanyImport;
use App\Imports\TrainingCourseImport;
use App\Imports\PgFeeImport;
use App\Imports\ConferenceImport;
use App\Imports\ProductCommServiceImport;
use App\Imports\TechKnowHowImport;
use App\Imports\ConsultancyImport;
use App\Imports\LabServiceImport;
use App\Imports\NewEndowmentImport;
use App\Imports\IncomeDividendImport;
use App\Imports\GiftImport;
use App\Imports\InternationalMoaImport;
use App\Imports\StaffInternationalMoaImport;
use App\Imports\StaffSentAbroadImport;
use App\Imports\InternationalMembershipImport;
use App\Imports\NationalMoaImport;
use App\Imports\StaffNationalMoaImport;
use App\Imports\NationalMembershipImport;
use App\Imports\NewKtpImport;
use App\Imports\BenefitedKtpImport;
use App\Imports\JointResearchProjectImport;
use App\Imports\JointResearchProjectRuImport;
use App\Imports\SupportFacilityImport;
use App\Imports\LibraryFacilityImport;

use App\Imports\ClaimImport;
use App\Imports\ElnptActivityImport;
use App\Imports\ElnptRaroImport;
use App\Imports\ElnptGrantApplicationImport;
use App\Imports\ElnptGraImport;
use App\Imports\ElnptProposalImport;
use App\Imports\ElnptActiveGrantImport;
use App\Imports\RaroProcessImport;

use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\MasterListMyraTrait;
use App\Http\Traits\MasterListPmTrait;

class MasterlistController extends Controller
{
    use MasterListMyraTrait, MasterListPmTrait;

    public function __construct()
    {
        // set_time_limit(300);
        ini_set('max_execution_time', 500);
        ini_set('memory_limit', '-1');
    }

    public function myra_index($year = null)
    {
        if($year == null)$year = date('Y');
        $modules = $this->getMyraModuleAvailability($year);
        return view('masterlist.myra', compact('year', 'modules'));
    }

    public function pm_index($year = null)
    {
        if($year == null)$year = date('Y');
        $modules = $this->getPmModuleAvailability($year);
        return view('masterlist.project-management', compact('year', 'modules'));
    }

    public function myra_list($module, $year)
    {
        if($module == 'acad_staff'){
            $module_name = "Academic Staff";
        }
        else if($module == 'ug_student'){
            $module_name = "Under Graduate Student";
        }
        else if($module == 'pg_student'){
            $module_name = "Post Graduate Student";
        }
        else if($module == 'critical_mass'){
            $module_name = "Critical Mass";
        }
        else if($module == 'pro_qualification'){
            $module_name = "PhD/Professional Qualifications";
        }
        else if($module == 'research_experience'){
            $module_name = "Research Experience (3 COHORTS)";
        }
        else if($module == 'award'){
            $module_name = "Awards Recognition";
        }
        else if($module == 'publication'){
            $module_name = "Publication";
        }
        else if($module == 'research_grant'){
            $module_name = "Research Grant";
        }
        else if($module == 'expenditure_project'){
            $module_name = "Expenditure Project";
        }
        else if($module == 'monitoring_project'){
            $module_name = "Monitoring Project";
        }
        else if($module == 'phd_graduated'){
            $module_name = "PhD Graduated";
        }
        else if($module == 'master_graduated'){
            $module_name = "Master Graduated";
        }
        else if($module == 'phd_enrolled'){
            $module_name = "PhD Enrolled";
        }
        else if($module == 'entry_qualification'){
            $module_name = "Entry Qualification";
        }
        else if($module == 'fellowship'){
            $module_name = "Fellowship";
        }
        else if($module == 'post_doc'){
            $module_name = "Post Doc";
        }
        else if($module == 'patent_granted'){
            $module_name = "Patent Granted";
        }
        else if($module == 'patent_filed'){
            $module_name = "Patent Filed";
        }
        else if($module == 'comm_product'){
            $module_name = "Comm Product";
        }
        else if($module == 'know_how_sold'){
            $module_name = "Know-How Sold Outright";
        }
        else if($module == 'other_ipr'){
            $module_name = "Other IPR";
        }
        else if($module == 'active_company'){
            $module_name = "Active Companies";
        }
        else if($module == 'new_company'){
            $module_name = "New Companies";
        }
        else if($module == 'training_course'){
            $module_name = "Training Courses";
        }
        else if($module == 'pg_fee'){
            $module_name = "PG Fees";
        }
        else if($module == 'conference'){
            $module_name = "Conference";
        }
        else if($module == 'product_comm_service'){
            $module_name = "Product Comm";
        }
        else if($module == 'tech_know_how'){
            $module_name = "Tech Know-How";
        }
        else if($module == 'consultancy'){
            $module_name = "Consultancy";
        }
        else if($module == 'lab_service'){
            $module_name = "Lab Services";
        }
        else if($module == 'new_endowment'){
            $module_name = "New Endowment";
        }
        else if($module == 'income_dividend'){
            $module_name = "Income Dividend";
        }
        else if($module == 'gift'){
            $module_name = "Gifts";
        }
        else if($module == 'international_moa'){
            $module_name = "International MoA";
        }
        else if($module == 'staff_international_moa'){
            $module_name = "Staff Involved International MoA";
        }
        else if($module == 'staff_sent_abroad'){
            $module_name = "Staff Sent Abroad";
        }
        else if($module == 'international_membership'){
            $module_name = "International Membership";
        }
        else if($module == 'national_moa'){
            $module_name = "National MoA";
        }
        else if($module == 'staff_national_moa'){
            $module_name = "Staff Involved National MoA";
        }
        else if($module == 'national_membership'){
            $module_name = "National Membership";
        }
        else if($module == 'new_ktp'){
            $module_name = "New KTP";
        }
        else if($module == 'benefited_ktp'){
            $module_name = "Benefited KTP";
        }
        else if($module == 'joint_research_project'){
            $module_name = "Joint Research Projects";
        }
        else if($module == 'joint_research_project_ru'){
            $module_name = "Joint Research Projects Between RUs";
        }
        else if($module == 'support_facilities'){
            $module_name = "Support Facilities";
        }
        else if($module == 'library_facilities'){
            $module_name = "Library Facilities";
        }
        else{
            session()->flash('info', "This module will be available soon");
            return back();
        }
        $section = 'myra';
        $files = DataAttachment::whereModule($module)->where('year', $year)->latest()->get();
        return view('components.file-upload', compact('section', 'module', 'module_name', 'files', 'year'));
    }

    public function pm_list($module, $year)
    {
        if($module == 'claim'){
            $module_name = "Claim SPB";
        }
        else if($module == 'elnpt_activity'){
            $module_name = "Activity";
        }
        else if($module == 'elnpt_raro'){
            $module_name = "ARORARO";
        }
        else if($module == 'elnpt_grant_application'){
            $module_name = "Grant Application";
        }
        else if($module == 'elnpt_spb_gra'){
            $module_name = "SPB GRA";
        }
        else if($module == 'elnpt_proposal'){
            $module_name = "Proposal";
        }
        else if($module == 'active_grant'){
            $module_name = "Active Grant";
        }
        else if($module == 'raro_process'){
            $module_name = "RARO Process";
        }
        else{
            session()->flash('info', "This module will be available soon");
            return back();
        }
        $section = 'project-management';
        $files = DataAttachment::whereModule($module)->where('year', $year)->latest()->get();
        return view('components.file-upload', compact('section', 'module', 'module_name', 'files', 'year'));
    }

    public function myra_import($id)
    {
        $masterlist = DataAttachment::find($id);
        if($masterlist){
            $mediaItems = $masterlist->getFirstMedia('dataAttachment');
            $filepath = $mediaItems->getPath();
            $module = $masterlist->module;
            if($module == 'acad_staff'){
                Excel::import(new AcadStaffImport($masterlist->year), $filepath);
            }
            else if($module == 'ug_student'){
                Excel::import(new UgStudentImport($masterlist->year), $filepath);
            }
            else if($module == 'pg_student'){
                Excel::import(new PgStudentImport($masterlist->year), $filepath);
            }
            else if($module == 'critical_mass'){
                Excel::import(new CriticalMassImport($masterlist->year), $filepath);
            }
            else if($module == 'pro_qualification'){
                Excel::import(new ProfessionalQualificationImport($masterlist->year), $filepath);
            }
            else if($module == 'research_experience'){
                Excel::import(new ResearchExperienceImport($masterlist->year), $filepath);
            }
            else if($module == 'award'){
                Excel::import(new AwardImport($masterlist->year), $filepath);
            }
            else if($module == 'publication'){
                Excel::import(new PublicationImport($masterlist->year), $filepath);
            }
            else if($module == 'research_grant'){
                Excel::import(new ResearchGrantImport($masterlist->year), $filepath);
            }
            else if($module == 'expenditure_project'){
                Excel::import(new ExpenditureProjectImport($masterlist->year), $filepath);
            }
            else if($module == 'monitoring_project'){
                Excel::import(new MonitoringProjectImport($masterlist->year), $filepath);
            }
            else if($module == 'phd_graduated'){
                Excel::import(new PhdGraduatedImport($masterlist->year), $filepath);
            }
            else if($module == 'master_graduated'){
                Excel::import(new MasterGraduatedImport($masterlist->year), $filepath);
            }
            else if($module == 'phd_enrolled'){
                Excel::import(new PhdEnrolledImport($masterlist->year), $filepath);
            }
            else if($module == 'entry_qualification'){
                Excel::import(new EntryQualificationImport($masterlist->year), $filepath);
            }
            else if($module == 'fellowship'){
                Excel::import(new FellowshipImport($masterlist->year), $filepath);
            }
            else if($module == 'post_doc'){
                Excel::import(new PostDocImport($masterlist->year), $filepath);
            }
            else if($module == 'patent_granted'){
                Excel::import(new PatentGrantedImport($masterlist->year), $filepath);
            }
            else if($module == 'patent_filed'){
                Excel::import(new PatentFiledImport($masterlist->year), $filepath);
            }
            else if($module == 'comm_product'){
                Excel::import(new CommProductImport($masterlist->year), $filepath);
            }
            else if($module == 'know_how_sold'){
                Excel::import(new KnowHowSoldImport($masterlist->year), $filepath);
            }
            else if($module == 'other_ipr'){
                Excel::import(new OtherIprImport($masterlist->year), $filepath);
            }
            else if($module == 'active_company'){
                Excel::import(new ActiveCompanyImport($masterlist->year), $filepath);
            }
            else if($module == 'new_company'){
                Excel::import(new NewCompanyImport($masterlist->year), $filepath);
            }
            else if($module == 'training_course'){
                Excel::import(new TrainingCourseImport($masterlist->year), $filepath);
            }
            else if($module == 'pg_fee'){
                Excel::import(new PgFeeImport($masterlist->year), $filepath);
            }
            else if($module == 'conference'){
                Excel::import(new ConferenceImport($masterlist->year), $filepath);
            }
            else if($module == 'product_comm_service'){
                Excel::import(new ProductCommServiceImport($masterlist->year), $filepath);
            }
            else if($module == 'tech_know_how'){
                Excel::import(new techKnowHowImport($masterlist->year), $filepath);
            }
            else if($module == 'consultancy'){
                Excel::import(new ConsultancyImport($masterlist->year), $filepath);
            }
            else if($module == 'lab_service'){
                Excel::import(new LabServiceImport($masterlist->year), $filepath);
            }
            else if($module == 'new_endowment'){
                Excel::import(new NewEndowmentImport($masterlist->year), $filepath);
            }
            else if($module == 'income_dividend'){
                Excel::import(new IncomeDividendImport($masterlist->year), $filepath);
            }
            else if($module == 'gift'){
                Excel::import(new GiftImport($masterlist->year), $filepath);
            }
            else if($module == 'international_moa'){
                Excel::import(new InternationalMoaImport($masterlist->year), $filepath);
            }
            else if($module == 'staff_international_moa'){
                Excel::import(new StaffInternationalMoaImport($masterlist->year), $filepath);
            }
            else if($module == 'staff_sent_abroad'){
                Excel::import(new StaffSentAbroadImport($masterlist->year), $filepath);
            }
            else if($module == 'international_membership'){
                Excel::import(new InternationalMembershipImport($masterlist->year), $filepath);
            }
            else if($module == 'national_moa'){
                Excel::import(new NationalMoaImport($masterlist->year), $filepath);
            }
            else if($module == 'staff_national_moa'){
                Excel::import(new StaffNationalMoaImport($masterlist->year), $filepath);
            }
            else if($module == 'national_membership'){
                Excel::import(new NationalMembershipImport($masterlist->year), $filepath);
            }
            else if($module == 'new_ktp'){
                Excel::import(new NewKtpImport($masterlist->year), $filepath);
            }
            else if($module == 'benefited_ktp'){
                Excel::import(new BenefitedKtpImport($masterlist->year), $filepath);
            }
            else if($module == 'joint_research_project'){
                Excel::import(new JointResearchProjectImport($masterlist->year), $filepath);
            }
            else if($module == 'joint_research_project_ru'){
                Excel::import(new JointResearchProjectRuImport($masterlist->year), $filepath);
            }
            else if($module == 'support_facilities'){
                Excel::import(new SupportFacilityImport($masterlist->year), $filepath);
            }
            else if($module == 'library_facilities'){
                Excel::import(new LibraryFacilityImport($masterlist->year), $filepath);
            }
            else{
                session()->flash('info', "This module will be available soon");
                return back();
            }
            $prev_data = DataAttachment::whereModule($module)->where('year', $masterlist->year)->whereStatus('selected')->first();
            if($prev_data){
                $prev_data->status = 'not-selected';
                $prev_data->save();
            }
            $masterlist->status = 'selected';
            $masterlist->save();
            session()->flash('success', "Masterlist is successfully imported");
            return back();
        }
        else{
            session()->flash('error', "Something went wrong");
            return back();
        }
    }

    public function pm_import($id)
    {
        $masterlist = DataAttachment::find($id);
        if($masterlist){
            $mediaItems = $masterlist->getFirstMedia('dataAttachment');
            $filepath = $mediaItems->getPath();
            $module = $masterlist->module;
            if($module == 'claim'){
                Excel::import(new ClaimImport($masterlist->year), $filepath);
            }
            else if($module == 'elnpt_activity'){
                Excel::import(new ElnptActivityImport($masterlist->year), $filepath);
            }
            else if($module == 'elnpt_grant_application'){
                Excel::import(new ElnptGrantApplicationImport($masterlist->year), $filepath);
            }
            else if($module == 'elnpt_spb_gra'){
                Excel::import(new ElnptGraImport($masterlist->year), $filepath);
            }
            else if($module == 'elnpt_proposal'){
                Excel::import(new ElnptProposalImport($masterlist->year), $filepath);
            }
            else if($module == 'active_grant'){
                Excel::import(new ElnptActiveGrantImport($masterlist->year), $filepath);
            }
            else if($module == 'raro_process'){
                Excel::import(new RaroProcessImport($masterlist->year), $filepath);
            }
            else{
                session()->flash('info', "This module will be available soon");
                return back();
            }
            $prev_data = DataAttachment::whereModule($module)->where('year', $masterlist->year)->whereStatus('selected')->first();
            if($prev_data){
                $prev_data->status = 'not-selected';
                $prev_data->save();
            }
            $masterlist->status = 'selected';
            $masterlist->save();
            session()->flash('success', "Masterlist is successfully imported");
            return back();
        }
        else{
            session()->flash('error', "Something went wrong");
            return back();
        }
    }

    public function myra_delete($id)
    {
        $masterlist = DataAttachment::find($id);
        if($masterlist){
            $module = $masterlist->module;
            if($module == 'acad_student'){
                MasterlistAcademicStaff::where('ml_end_year', $masterlist->year)->delete();
            }
            else if($module == 'ug_student'){
                MasterlistUgStudent::where('ml_end_year', $masterlist->year)->delete();       
            }
            else if($module == 'pg_student'){
                MasterlistPgStudent::where('ml_end_year', $masterlist->year)->delete();       
            }
            else if($module == 'critical_mass'){
                MasterlistCriticalMass::where('ml_end_year', $masterlist->year)->delete();       
            }
            else if($module == 'pro_qualification'){
                MasterlistProfessionalQualification::where('ml_end_year', $masterlist->year)->delete();       
            }
            else if($module == 'research_experience'){
                MasterlistResearchExperience::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'award'){
                MasterlistAward::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'publication'){
                MasterlistPublication::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'research_grant'){
                MasterlistResearchGrant::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'expenditure_project'){
                MasterlistExpenditureProject::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'monitoring_project'){
                MasterlistMonitoringProject::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'phd_graduated'){
                MasterlistPhdGraduate::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'master_graduated'){
                MasterlistMasterGraduate::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'phd_enrolled'){
                MasterlistPhdEnroll::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'entry_qualification'){
                MasterlistEntryQualification::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'fellowship'){
                MasterlistFellowship::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'post_doc'){
                MasterlistPostDoc::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'patent_granted'){
                MasterlistPatentGrant::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'patent_filed'){
                MasterlistPatentFile::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'comm_product'){
                MasterlistCommProduct::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'know_how_sold'){
                MasterlistKnowHowSold::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'other_ipr'){
                MasterlistOtherIpr::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'active_company'){
                MasterlistActiveCompany::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'new_company'){
                MasterlistNewCompany::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'training_course'){
                MasterlistTrainingCourse::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'pg_fee'){
                MasterlistPgFee::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'conference'){
                MasterlistConference::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'product_comm_service'){
                MasterlistProductCommRef::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'tech_know_how'){
                MasterlistTechKnowHow::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'consultancy'){
                MasterlistConsultancy::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'lab_service'){
                MasterlistLabService::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'new_endowment'){
                MasterlistNewEndowment::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'gift'){
                MasterlistGift::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'international_moa'){
                MasterlistInternationalMoa::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'staff_international_moa'){
                MasterlistStaffInternationalMoa::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'staff_sent_abroad'){
                MasterlistStaffSentAbroad::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'international_membership'){
                MasterlistMembershipInternational::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'national_moa'){
                MasterlistNationalMoa::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'staff_national_moa'){
                MasterlistStaffNationalMoa::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'national_membership'){
                MasterlistMembershipNational::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'new_ktp'){
                MasterlistNewKtp::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'benefited_ktp'){
                MasterlistBenefitedKtp::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'joint_research_project'){
                MasterlistJointResearchProject::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'joint_research_project_ru'){
                MasterlistJointResearchRu::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'support_facilities'){
                MasterlistSupportFacility::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else if($module == 'library_facilities'){
                MasterlistLibraryFacility::where('ml_end_year', $masterlist->year)->delete(); 
            }
            else{
                session()->flash('error', "Something went wrong");
                return back();
            }
            $masterlist->delete();
            session()->flash('success', "Masterlist is successfully deleted");
            return back();
        }
        else{
            session()->flash('error', "Something went wrong");
            return back();
        }
    }

    public function pm_delete($id)
    {
        $masterlist = DataAttachment::find($id);
        if($masterlist){
            $module = $masterlist->module;
            if($module == 'claim'){
                MasterlistClaim::where('ml_end_year', $masterlist->year)->delete();       
            }
            else if($module == 'elnpt_activity'){
                MasterlistElnptActivity::where('ml_end_year', $masterlist->year)->delete();              
            }
            else if($module == 'elnpt_grant_application'){
                MasterlistElnptGrantApplication::where('ml_end_year', $masterlist->year)->delete();              
            }
            else if($module == 'elnpt_spb_gra'){
                MasterlistElnptGra::where('ml_end_year', $masterlist->year)->delete();              
            }
            else if($module == 'elnpt_proposal'){
                MasterlistElnptProposal::where('ml_end_year', $masterlist->year)->delete();              
            }
            else if($module == 'active_grant'){
                MasterlistElnptActiveGrant::where('ml_end_year', $masterlist->year)->delete();              
            }
            else if($module == 'raro_process'){
                MasterlistRaroProcess::where('ml_end_year', $masterlist->year)->delete();              
            }
            else{
                session()->flash('error', "Something went wrong");
                return back();
            }
            $masterlist->delete();
            session()->flash('success', "Masterlist is successfully deleted");
            return back();
        }
        else{
            session()->flash('error', "Something went wrong");
            return back();
        }
    }
}
