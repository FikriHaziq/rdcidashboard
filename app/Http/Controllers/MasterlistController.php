<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAttachment;
use App\Models\MasterList\MasterListStudent;
use App\Models\MasterList\MasterListAward;
use App\Models\MasterList\MasterListPublication;
use App\Models\MasterList\MasterListClaim;
use App\Models\MasterList\MasterListElnptActivity;
use App\Models\MasterList\MasterListElnptRaro;
use App\Models\MasterList\MasterListElnptGrantApplication;
use App\Models\MasterList\MasterListElnptGra;
use App\Models\MasterList\MasterListElnptProposal;
use App\Models\MasterList\MasterListElnptActiveGrant;
use App\Models\MasterList\MasterListRaroProcess;

use App\Imports\Student\UGStudentImport;
use App\Imports\Student\PGStudentImport;
use App\Imports\Student\MasterStudentImport;
use App\Imports\Student\PhdStudentImport;
use App\Imports\Student\DocStudentImport;
use App\Imports\AwardImport;
use App\Imports\PublicationImport;
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
        ini_set('max_execution_time', 300);
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
        if($module == 'ug_student'){
            $module_name = "Under Graduate Student";
        }
        else if($module == 'pg_student'){
            $module_name = "Post Graduate Student";
        }
        else if($module == 'master_student'){
            $module_name = "Master Student";
        }
        else if($module == 'phd_student'){
            $module_name = "PhD Student";
        }
        else if($module == 'doc_student'){
            $module_name = "Doctoral Student";
        }
        else if($module == 'award'){
            $module_name = "Award";
        }
        else if($module == 'publication'){
            $module_name = "Publication";
        }
        else if($module == 'training_course'){
            $module_name = "Training Courses & PG Fees";
        }
        else if($module == 'conference'){
            $module_name = "Conference & Seminar";
        }
        else if($module == 'product'){
            $module_name = "Product Comm & Know-How Licensing";
        }
        else if($module == 'consultancy'){
            $module_name = "Consultancy & Lab";
        }
        else if($module == 'endowment'){
            $module_name = "Endowment";
        }
        else if($module == 'gift'){
            $module_name = "Gifts";
        }
        else if($module == 'operational_expenditure'){
            $module_name = "Operational Expenditure";
        }
        else if($module == 'international_moa'){
            $module_name = "International MoA";
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
        else if($module == 'national_membership'){
            $module_name = "National Membership";
        }
        else if($module == 'ktp'){
            $module_name = "KTP";
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
            if($module == 'ug_student'){
                Excel::import(new UGStudentImport($masterlist->year), $filepath);
            }
            else if($module == 'pg_student'){
                Excel::import(new PGStudentImport($masterlist->year), $filepath);
            }
            else if($module == 'master_student'){
                Excel::import(new MasterStudentImport($masterlist->year), $filepath);
            }
            else if($module == 'phd_student'){
                Excel::import(new PhdStudentImport($masterlist->year), $filepath);
            }
            else if($module == 'doc_student'){
                Excel::import(new DocStudentImport($masterlist->year), $filepath);
            }
            else if($module == 'award'){
                Excel::import(new AwardImport($masterlist->year), $filepath);
            }
            else if($module == 'publication'){
                Excel::import(new PublicationImport($masterlist->year), $filepath);
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
            else if($module == 'elnpt_raro'){
                Excel::import(new ElnptRaroImport($masterlist->year), $filepath);
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
            if(in_array($module, ['ug_student','pg_student','master_student','phd_student','doc_student'])){
                MasterListStudent::where('ml_start_year', $masterlist->year)->whereType($module)->delete();
            }
            else if($module == 'award'){
                MasterListAward::where('ml_start_year', $masterlist->year)->delete();       
            }
            else if($module == 'publication'){
                MasterListPublication::where('ml_start_year', $masterlist->year)->delete();              
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
                MasterListClaim::where('ml_start_year', $masterlist->year)->delete();       
            }
            else if($module == 'elnpt_activity'){
                MasterListElnptActivity::where('ml_start_year', $masterlist->year)->delete();              
            }
            else if($module == 'elnpt_raro'){
                MasterListElnptRaro::where('ml_start_year', $masterlist->year)->delete();              
            }
            else if($module == 'elnpt_grant_application'){
                MasterListElnptGrantApplication::where('ml_start_year', $masterlist->year)->delete();              
            }
            else if($module == 'elnpt_spb_gra'){
                MasterListElnptGra::where('ml_start_year', $masterlist->year)->delete();              
            }
            else if($module == 'elnpt_proposal'){
                MasterListElnptProposal::where('ml_start_year', $masterlist->year)->delete();              
            }
            else if($module == 'active_grant'){
                MasterListElnptActiveGrant::where('ml_start_year', $masterlist->year)->delete();              
            }
            else if($module == 'raro_process'){
                MasterListRaroProcess::where('ml_start_year', $masterlist->year)->delete();              
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
