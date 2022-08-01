<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataAttachment;
use App\Models\MasterList\MasterListStudent;
use App\Models\MasterList\MasterListAward;
use App\Models\MasterList\MasterListPublication;

use App\Imports\Student\UGStudentImport;
use App\Imports\Student\PGStudentImport;
use App\Imports\Student\MasterStudentImport;
use App\Imports\Student\PhdStudentImport;
use App\Imports\Student\DocStudentImport;
use App\Imports\AwardImport;
use App\Imports\PublicationImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Traits\MasterListTrait;

class MasterlistController extends Controller
{
    use MasterListTrait;

    public function __construct()
    {
        // set_time_limit(300);
        ini_set('max_execution_time', 300);
    }

    public function index($year = null)
    {
        if($year == null)$year = date('Y');
        $modules = $this->getModuleAvailability($year);
        return view('masterlist.index', compact('year', 'modules'));
    }

    public function list($module, $year)
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
        $files = DataAttachment::whereModule($module)->where('year', $year)->latest()->get();
        return view('components.file-upload', compact('module', 'module_name', 'files', 'year'));
    }

    public function import($id)
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

    public function delete($id)
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
}
