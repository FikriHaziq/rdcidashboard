<?php

namespace App\Http\Controllers\DanaRU;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DanaRU\DruProject;
use App\Models\DanaRU\DruDistFund;
use App\Models\DanaRU\DruSubProject;
use App\Models\DanaRU\DruDistributionPlan;
use App\Models\DanaRU\DruDistributionPlanForm;
use App\Models\DanaRU\DruMember;
use App\Models\DanaRU\DruKpi;
use App\Models\DanaRU\DruKpiTemplate;
use App\Models\DanaRU\DruDataAttachment;
use App\Models\MasterList\MasterlistDruYear;
use App\Models\MasterList\MasterlistDruAllocation;
use App\Models\TemporaryFile;
use App\Models\ApprovalApp;
use App\Models\DocTemplate;
use App\Models\Parameter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Purifier;
use Validator;

class CadanganAgihanController extends Controller
{
    public function index(Request $request ,$year=null, $tab=null)
    {
        if(!$year){
            $plan = DruDistributionPlan::select('year')->orderBy('year', 'desc')->first();
            $year = $plan->year ?? date('Y');
        }
        if($request->status == 2 && $request->role != 'approver')session()->flash('success', "Borang Cadangan Agihan telah berjaya dihantar");
        if($request->status == 4 && $request->role == 'approver')session()->flash('success', "Borang Cadangan Agihan telah berjaya disemak");
        if($request->status == 5 && $request->role == 'approver')session()->flash('success', "Borang Cadangan Agihan telah berjaya disemak");
        if($request->action == 'save')session()->flash('success', "Data telah berjaya dikemaskini");
        if($request->plan_id){
            $planList = DruDistributionPlan::where('year', $year)->get();
            $plan = $planList->where('type', 1)->first();
            $plan = DruDistributionPlan::find($request->plan_id);
        }
        else {
            $plans = getDruPlanList($year);
            $plan_form_raw = null;
            $agihan_semula_lists = [];
            $pindahan_lists = [];
            foreach ($plans as $key => $plan) {
                $plan_form = getDistributionFormPlans($year, $plan->id, $plan->type);
                if(in_array($plan->type, [1,2])){
                    if(!$plan_form_raw)$plan_form_raw = $plan_form;
                    else $plan_form_raw = $plan_form_raw->concat($plan_form);
                }
                else if($plan->type == 3){
                    $agihan_semula_lists[] = (object)[
                        "plan_id" => $plan->id,
                        "plan_date" => $plan->created_at,
                        "plan_forms" => $plan_form
                    ];
                }
                else if($plan->type == 4){
                    $pindahan_lists[] = (object)[
                        "plan_id" => $plan->id,
                        "plan_date" => $plan->created_at,
                        "plan_forms" => $plan_form
                    ];
                }
            }
            // dd($agihan_semula_lists[0]);
            $plan_forms = $plan_form_raw;
            return view('dana-ru.cadangan-agihan.keseluruhan', compact('year', 'request', 'plans', 'plan_forms', 'agihan_semula_lists', 'pindahan_lists'));
        }
        $plan_forms = null;
        if($plan) $plan_forms = getDistributionFormPlans($year, $plan->id, $plan->type);
        // dd($plan_forms);
        // dd($plan->fundCollection);
        return view('dana-ru.cadangan-agihan.index', compact('year', 'request', 'planList', 'plan', 'plan_forms', 'tab'));
    }

    public function form(Request $request, $year=null, $id = null)
    {
        if(!$year)$year = date('Y');
        $plan_form = DruDistributionPlanForm::find($id);
        if($request->plan_id)$plan = DruDistributionPlan::find($request->plan_id);
        else $plan = $plan_form->distribution_plan ?? null;
        $view_mode = $request->view;
        // dd(getAvailableFacultyFromPlan($year));
        // dd($plan_form->projectTransferInputData);
        if($plan->type == 4) return view('dana-ru.cadangan-agihan.pindahan-form', compact('year', 'plan_form', 'plan', 'view_mode'));
        else if($plan->type == 5) return view('dana-ru.cadangan-agihan.pengumpulan-dana-form', compact('year', 'plan_form', 'plan', 'view_mode'));
        return view('dana-ru.cadangan-agihan.form', compact('year', 'plan_form', 'plan', 'view_mode'));
    }

    public function storeAdditionalPlan(Request $request, $id=null)
    {   
        if($request->type == "store"){
            $main_plan = DruDistributionPlan::where('year', $request->year)->whereType(1)->first();
            $plan = new DruDistributionPlan();
            $plan->year = $request->year;
            $plan->amount = (float)0;
            $plan->c_id = user()->id;
            $plan->status = 1;
            $plan->type = 2;
            $plan->save();
            foreach ($main_plan->forms as $key => $form) {
                $plan_form = new DruDistributionPlanForm;
                $plan_form->distribution_plan_id = $plan->id;
                $plan_form->c_id = user()->id;
                $plan_form->mrun = $form->mrun;
                $plan_form->bpki = $form->bpki;
                $plan_form->ptj_id = $form->ptj_id;
                $plan_form->project_id = $form->project_id;
                $plan_form->amount = 0;
                $plan_form->save();
                $form_pic = $form->pic;
                $form_member = $form->member;
                $form_main_kpis = $form->main_kpi;
                $form_kpis = $form->kpi;
                if($form_pic){
                    $leader = new DruMember;
                    $leader->type = $form_pic->type;
                    $leader->distribution_plan_form_id = $plan_form->id;
                    $leader->name = $form_pic->name;
                    $leader->email = $form_pic->email;
                    $leader->nric = $form_pic->nric;
                    $leader->save();
                }
                if($form_member){
                    $member = new DruMember;
                    $member->type = $form_member->type;
                    $member->distribution_plan_form_id = $plan_form->id;
                    $member->name = $form_member->name;
                    $member->email = $form_member->email;
                    $member->nric = $form_member->nric;
                    $member->save();
                }
                foreach ($form_main_kpis as $key => $form_main_kpi) {
                    $main_kpi = new DruKpi;
                    $main_kpi->type = $form_main_kpi->type;
                    $main_kpi->distribution_plan_form_id = $plan_form->id;
                    $main_kpi->kpi_template_id = $form_main_kpi->kpi_template_id;
                    $main_kpi->count = 0;
                    $main_kpi->amount = 0;
                    $main_kpi->total = 0;
                    $main_kpi->status = $form_main_kpi->status;
                    $main_kpi->save();
                }
                foreach ($form_kpis as $key => $form_kpi) {
                    $kpi = new DruKpi;
                    $kpi->type = $form_kpi->type;
                    $kpi->distribution_plan_form_id = $plan_form->id;
                    $kpi->kpi_template_id = $form_kpi->kpi_template_id;
                    $kpi->count = 0;
                    $kpi->amount = 0;
                    $kpi->total = 0;
                    $kpi->status = $form_kpi->status;
                    $kpi->save();
                }
            }
        }
        else if($request->type == "set_amount"){
            $plan = DruDistributionPlan::find($request->plan_id);
            $plan->amount = (float)str_replace( ",", "", $request->fund);
            $plan->c_id = user()->id;
            $plan->save();
        }

        session()->flash('success', "Cadangan Agihan Tambahan telah berjaya disimpan.");
        return redirect()->route('dana-ru.cadangan-agihan.index', ['year'=> $request->year, 'type' => 'cadangan_agihan', 'plan_id' => $plan->id]);
    }

    public function storeFundCollection(Request $request)
    {
        $plan = new DruDistributionPlan();
        $plan->year = $request->year;
        $plan->amount = (float)0;
        $plan->c_id = user()->id;
        $plan->status = 1;
        $plan->type = 5;
        $plan->parent_id = $request->parent_id;
        $plan->save();

        session()->flash('success', "Permohonan Pengumpulan Dana telah berjaya disimpan.");
        return redirect()->route('dana-ru.cadangan-agihan.index', ['year'=> $request->year, 'type' => 'pengumpulan_dana', 'plan_id' => $plan->id]);
    }

    public function storeFundCollectionForm(Request $request, $year=null)
    {
        $request->merge([
            'total_transfer' => str_replace(',', '', $request->total_transfer),
        ]);

        $request->validate([
            'ptj' => 'required',
            'project' => 'required',
            'total_transfer' => [
                'required',
                'numeric',
                'min:0.01',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value > $request->fund_balance) {
                        $fail('Jumlah pindahan tidak boleh melebihi baki dana.');
                    }
                },
            ],
        ],
        [
            'ptj.required' => 'Sila pilih PTJ.',
            'project.required' => 'Sila pilih projek.',
            'total_transfer.required' => 'Sila masukkan jumlah pindahan.',
            'total_transfer.numeric' => 'Sila masukkan jumlah pindahan.',
            'total_transfer.min' => 'Sila masukkan jumlah pindahan.',
        ]);

        $plan_form = DruDistributionPlanForm::find($request->plan_form_id);
        if($request->plan_id) $plan = DruDistributionPlan::find($request->plan_id);
        else $plan = $plan_form->distribution_plan;
        $ptj = explode('_',$request->ptj);
        $ptj_id = $ptj[0];
        $ptj_original_code = $ptj[1];
        $project = explode('_',$request->project);
        $project_id = $project[0];
        $project_t = explode('_',$request->project_t);
        $project_t_id = $project_t[0];


        if(!$plan_form)$plan_form = new DruDistributionPlanForm;
        $plan_form->distribution_plan_id = $plan->id;
        $plan_form->c_id = user()->id;
        $plan_form->mrun = 0;  
        $plan_form->bpki = $request->bpki_id;
        $plan_form->ptj_id = $ptj_id;
        $plan_form->project_id = $project_id;
        $plan_form->amount = (float)str_replace( ",", "", $request->total_transfer);
        $plan_form->notes = $request->note;
        $plan_form->save();

        $plan->sumAmount();

        $agihan_semula_plan = DruDistributionPlan::find($plan->parent_id);
        if($agihan_semula_plan) {
            $agihan_semula_plan->amount = $plan->amount;
            $agihan_semula_plan->save();
        }

        $approvalApp = ApprovalApp::whereAppId($plan->id)->whereModuleId(1)->orderBy('index', 'desc')->first();
        if($approvalApp)storeLogData($plan, $approvalApp->id, 'UPDATE', 'Kemaskini Pengumpulan Dana', ['plan_form_id' => $plan_form->id]);
        session()->flash('success', "Borang telah berjaya disimpan");
        return redirect()->route('dana-ru.cadangan-agihan.index', ["year"=>$year,"type"=>getPlanType($plan->type),"plan_id"=>$plan->id]);
    }

    public function storeRedistPlan(Request $request, $id=null)
    {
        if($request->type == "store"){
            $plan = new DruDistributionPlan();
            $plan->year = $request->year;
            $plan->amount = (float)0;
            $plan->c_id = user()->id;
            $plan->status = 1;
            $plan->type = 3;
            $plan->save();
        }

        session()->flash('success', "Cadangan Agihan Semula telah berjaya disimpan.");
        return redirect()->route('dana-ru.cadangan-agihan.index', ['year'=> $request->year, 'type' => 'agihan_semula', 'plan_id' => $plan->id]);
    }

    public function storeTransfer(Request $request, $id=null)
    {
        if($request->type == "store"){
            $plan = new DruDistributionPlan();
            $plan->year = $request->year;
            $plan->amount = (float)0;
            $plan->c_id = user()->id;
            $plan->status = 1;
            $plan->type = 4;
            $plan->save();
        }

        session()->flash('success', "Pindahan telah berjaya disimpan.");
        return redirect()->route('dana-ru.cadangan-agihan.index', ['year'=> $request->year, 'type' => 'pindahan', 'plan_id' => $plan->id]);
    }

    public function storePlan(Request $request, $year=null)
    {
        $request->validate([
            'fund' => 'required',
        ],
        [
            'fund.required' => 'Sila masukkan dana yang diterima.',
        ]);
        $plan = DruDistributionPlan::where('year', $year)->first();
        if(!$plan){
            $plan = new DruDistributionPlan();
            $plan->year = $year;
            $plan->amount = (float)str_replace( ",", "", $request->fund);
            $plan->c_id = user()->id;
            $plan->status = 1;
            $plan->save();
        }
        else{
            $plan->amount = (float)str_replace( ",", "", $request->fund);
            $plan->c_id = user()->id;
            $plan->save();
        }
        return redirect()->back();
    }

    public function store(Request $request, $year=null)
    {
        // dd($request->all());
        $request->validate([
            'mrun' => 'required',
            'bpki' => 'required',
            'kp_name' => 'required',
            'kp_email' => 'required|email',
            'kp_ic' => 'required',
            'pb_name' => 'required',
            'pb_email' => 'required|email',
            'pb_ic' => 'required',
            'ptj' => 'required',
            'project' => 'required',
            'total_dist' => 'required',
            'total_kpi' => [
                'nullable',
                function ($attribute, $value, $fail) use ($request) {
                    if ($value !== null && $value != $request->total_dist) {
                        $fail('Jumlah KPI hendaklah sama dengan jumlah peruntukan agihan.');
                    }
                },
            ],
        ],
        [
            'mrun.required' => 'Sila pilih program utama.',
            'bpki.required' => 'Sila pilih skop perbelanjaan.',
            'kp_name.required' => 'Sila masukkan nama.',
            'kp_email.required' => 'Sila masukkan emel.',
            'kp_email.email' => 'Sila masukkan format emel.',
            'kp_ic.required' => 'Sila masukkan ic.',
            'pb_name.required' => 'Sila masukkan nama.',
            'pb_email.required' => 'Sila masukkan emel.',
            'pb_email.email' => 'Sila masukkan format emel.',
            'pb_ic.required' => 'Sila masukkan ic.',
            'ptj.required' => 'Sila pilih PTJ.',
            'project.required' => 'Sila pilih projek.',
            'total_dist.required' => 'Sila tambah asas agihan di atas.',
        ]);
        $plan_form = DruDistributionPlanForm::find($request->plan_form_id);
        if($request->plan_id) $plan = DruDistributionPlan::find($request->plan_id);
        else $plan = $plan_form->distribution_plan;
        $ptj = explode('_',$request->ptj);
        $ptj_id = $ptj[0];
        $ptj_original_code = $ptj[1];
        $project = explode('_',$request->project);
        if(count($project) == 5){
            $project_id = $project[0];
        }
        else{
            $dru_dist_fund = new DruDistFund;
            $dru_dist_fund->year = $year;
            $dru_dist_fund->title = $project[0];
            $dru_dist_fund->faculty_code = $ptj_original_code;
            $dru_dist_fund->code = 'TMP';
            $dru_dist_fund->program_id = $request->mrun;
            $dru_dist_fund->is_draft = 1;
            $dru_dist_fund->status = 'temp';
            $dru_dist_fund->save();

            $project_id = $dru_dist_fund->id;
        }
        if(!$plan_form)$plan_form = new DruDistributionPlanForm;
        $plan_form->distribution_plan_id = $plan->id;
        $plan_form->c_id = user()->id;
        $plan_form->mrun = $request->mrun;  
        $plan_form->bpki = $request->bpki;
        $plan_form->ptj_id = $ptj_id;
        $plan_form->project_id = $project_id;
        $plan_form->amount = (float)str_replace( ",", "", $request->total_dist);
        $plan_form->notes = $request->note;
        $plan_form->save();

        $pic = DruMember::whereDistributionPlanFormId($request->plan_form_id)->whereType('leader')->first();
        if(!$pic)$pic = new DruMember;
        $pic->type = 'leader';
        $pic->distribution_plan_form_id = $plan_form->id;
        $pic->name = $request->kp_name;
        $pic->email = $request->kp_email;
        $pic->nric = $request->kp_ic;
        $pic->save();

        $member = DruMember::whereDistributionPlanFormId($request->plan_form_id)->whereType('member')->first();
        if(!$member)$member = new DruMember;
        $member->type = 'member';
        $member->distribution_plan_form_id = $plan_form->id;
        $member->name = $request->pb_name;
        $member->email = $request->pb_email;
        $member->nric = $request->pb_ic;
        $member->save();

        $main_kpi = $plan_form->main_kpi;
        $kpi = $plan_form->kpi;
        $kpi_arr = [];

        foreach (($request->main_dist ?? []) as $key => $main_dist_data) {
            if($main_dist_data['id'])$main_dist = DruKpi::find($main_dist_data['id']);
            else $main_dist = new DruKpi;
            $main_dist->type = 'main';
            $main_dist->distribution_plan_form_id = $plan_form->id;
            $main_dist->kpi_template_id = $main_dist_data['item_id'];
            $main_dist->count = $main_dist_data['bil'] ?? 0;
            $main_dist->amount = (float)str_replace( ",", "", $main_dist_data['amount']);
            $main_dist->total = (float)str_replace( ",", "", $main_dist_data['total']);
            $main_dist->status = 'active';
            $main_dist->remark = $main_dist_data['remark'];
            $main_dist->save();
            array_push($kpi_arr, $main_dist_data['id']);
        }

        foreach (($request->kpi ?? []) as $key => $kpi_data) {
            if($kpi_data['id'])$kpi = DruKpi::find($kpi_data['id']);
            else $kpi = new DruKpi;
            $kpi->type = 'kpi';
            $kpi->distribution_plan_form_id = $plan_form->id;
            $kpi->kpi_template_id = $kpi_data['item_id'];
            $kpi->count = $kpi_data['bil'] ?? 0;
            $kpi->amount = (float)str_replace( ",", "", $kpi_data['amount']);
            $kpi->total = (float)str_replace( ",", "", $kpi_data['total']);
            $kpi->status = 'active';
            $kpi->remark = $kpi_data['remark'];
            $kpi->save();
            array_push($kpi_arr, $kpi_data['id']);
        }
        DruKpi::whereDistributionPlanFormId($plan_form->id)->whereNotIn('id', $kpi_arr)->delete();

        $approvalApp = ApprovalApp::whereAppId($plan->id)->whereModuleId(1)->orderBy('index', 'desc')->first();
        if($approvalApp)storeLogData($plan, $approvalApp->id, 'UPDATE', 'Kemaskini Cadangan Agihan', ['plan_form_id' => $plan_form->id]);
        session()->flash('success', "Borang telah berjaya disimpan");
        return redirect()->route('dana-ru.cadangan-agihan.index', ["year"=>$year,"type"=>getPlanType($plan->type),"plan_id"=>$plan->id]);
    }

    public function storeTransferForm(Request $request, $year=null)
    {
        $request->validate([
            'ptj_f' => 'required',
            // 'ptj_t' => 'required',
            'project_f' => 'required',
            'project_t' => 'required',
            'total_transfer' => 'required'
        ],
        [
            'ptj_f.required' => 'Sila pilih PTJ.',
            // 'ptj_t.required' => 'Sila pilih PTJ.',
            'project_f.required' => 'Sila pilih projek.',
            'project_t.required' => 'Sila pilih projek.',
            'total_transfer.required' => 'Sila masukkan jumlah pindahan.',
        ]);

        $plan_form = DruDistributionPlanForm::find($request->plan_form_id);
        if($request->plan_id) $plan = DruDistributionPlan::find($request->plan_id);
        else $plan = $plan_form->distribution_plan;
        $ptj_f = explode('_',$request->ptj_f);
        $ptj_f_id = $ptj_f[0];
        $ptj_f_original_code = $ptj_f[1];
        $project_f = explode('_',$request->project_f);
        $project_f_id = $project_f[0];
        $project_t = explode('_',$request->project_t);
        $project_t_id = $project_t[0];
            
        if(!$plan_form)$plan_form = new DruDistributionPlanForm;
        $plan_form->distribution_plan_id = $plan->id;
        $plan_form->c_id = user()->id;
        $plan_form->mrun = 0;  
        $plan_form->bpki = $request->bpki_id;
        $plan_form->ptj_id = $ptj_f_id;
        $plan_form->project_id = $project_f_id;
        $plan_form->ptj_id_transfer = $ptj_f_id;
        $plan_form->project_id_transfer = $project_t_id;
        $plan_form->amount = (float)str_replace( ",", "", $request->total_transfer);
        $plan_form->notes = $request->note;
        $plan_form->save();

        $approvalApp = ApprovalApp::whereAppId($plan->id)->whereModuleId(1)->orderBy('index', 'desc')->first();
        if($approvalApp)storeLogData($plan, $approvalApp->id, 'UPDATE', 'Kemaskini Cadangan Agihan', ['plan_form_id' => $plan_form->id]);
        session()->flash('success', "Borang telah berjaya disimpan");
        return redirect()->route('dana-ru.cadangan-agihan.index', ["year"=>$year,"type"=>getPlanType($plan->type),"plan_id"=>$plan->id]);
    }

    public function deletePlan($id)
    {
        $plan_form = DruDistributionPlanForm::find($id);
        $plan = $plan_form->distribution_plan;
        if($plan_form){
            DruMember::whereDistributionPlanFormId($id)->delete();
            DruKpi::whereDistributionPlanFormId($id)->delete();
            $plan_form->delete();
            if($plan){
                if($plan->type == 5){
                    $plan->sumAmount();
                }
            }
            session()->flash('success', "Data is successfully deleted");
            return back();
        }
        else{
            session()->flash('error', "Something went wrong");
            return back();
        }
    }

    public function verification(Request $request, $id, $type)
    {
        $order = ApprovalApp::whereAppId($id)->whereModuleId(1)->orderBy('index', 'desc')->first()->index ?? 0;
        $status = 0;
        if($type == 'submit') {
            if($order > 0)$status = 3;
            else $status = 2;
        }
        else $status = $request->status;
        $order++;
        // dd($order);
        $plan = DruDistributionPlan::find($id);
        if($plan){
            $kertas_kerja = DocTemplate::whereParentId($plan->id)->exists();
            if(in_array($plan->type, [1,2,3]) && !$kertas_kerja) {
                session()->flash('info', "Sila jana kertas kerja terlebih dahulu.");
                return back();
            }
            $approvalApp = new ApprovalApp;
            $approvalApp->index = $order;
            $approvalApp->module_id = 1;
            $approvalApp->app_id = $id;
            $approvalApp->c_id = user()->id;
            $approvalApp->status = $status;
            $approvalApp->comment = $request->comment ?? null;
            $approvalApp->save();
            $plan->status = $status;
            $plan->save();

            storeLogData($plan, $approvalApp->id, 'SUBMIT');
        }
        else{
            session()->flash('error', "Something went wrong");
            return back();
        }
        session()->flash('success', "Borang telah berjaya dihantar.");
        return back();
    }

    public function verificationPost(Request $request)
    {
        // if($request->status==6){
        //     $plan = DruDistributionPlan::find($request->plan_id);
        //     dd($plan->forms);
        // }
        $validator = Validator::make($request->all(), [
            'file_upload' => 'required',
            'status' => 'required',
        ],
        [
            'file_upload.required' => 'Sila muat naik cabutan minit.',
            'status.required' => 'Sila pilih status.',
        ]);
        $plan = DruDistributionPlan::find($request->plan_id);
        if ($validator->fails()) {
            $arguments = ['year'=>$request->year, 'tab'=>'verification'];
            if($plan) $arguments = ['year'=>$request->year, 'tab'=>'verification', 'type' => $plan->typeDetails, 'plan_id' => $plan->id];
            return redirect()->route('dana-ru.cadangan-agihan.index', $arguments)
                ->withErrors($validator)
                ->withInput();
        }
        $order = ApprovalApp::whereAppId($request->plan_id)->whereModuleId(1)->orderBy('index', 'desc')->first()->index ?? 0;
        $order++;
        $status = $request->status;
        if($plan){
            $approvalApp = new ApprovalApp;
            $approvalApp->index = $order;
            $approvalApp->module_id = 1;
            $approvalApp->app_id = $request->plan_id;
            $approvalApp->c_id = user()->id;
            $approvalApp->status = $status;
            $approvalApp->comment = $request->comment ?? null;
            $approvalApp->save();
            $plan->status = $status;
            $plan->save();
            $data = new DruDataAttachment;
            $data->table = 'approval_app';
            $data->parent_id = $approvalApp->id;
            $file = collect(json_decode($request->file_upload));
            if($request->file_upload){
                $data->filename = $file['filename'];
                $file = collect(json_decode($request->file_upload));
                $temporaryFile = TemporaryFile::where('folder', $file['folder'])->first();

                if($temporaryFile){
                    $data->addMedia(storage_path('app/data/tmp/'.$file['folder'].'/'.$temporaryFile->filename))->toMediaCollection('druDataAttachment');
                    $temporaryFile->delete();
                    $data->save();
                    Storage::deleteDirectory('data/tmp/'.$file['folder']);
                }
            }
            if($request->status==6 && $plan->type != 5){
                if($plan->type == 3){
                    $pengumpulan_dana = DruDistributionPlan::whereParentId($plan->id)->first();
                    if($pengumpulan_dana) $this->storeAllocation($pengumpulan_dana);
                    $this->storeAllocation($plan);
                }
            }
        }
        else{
            session()->flash('error', "Something went wrong");
            // return back();
        }
        session()->flash('success', "Borang telah berjaya disahkan.");
        return redirect()->route('dana-ru.cadangan-agihan.index', ['year'=>$request->year, 'type' => getPlanType($plan->type), 'plan_id' => $request->plan_id]);
    }

    public function downloadFile($id)
    {
        $file = DruDataAttachment::find($id);
        if($file){
            $mediaItem = $file->getFirstMedia('druDataAttachment');
            $filepath = $mediaItem->getPath();
            $filename = $file->filename;
            return response()->download($filepath, $filename);
        }
        else{
            session()->flash('error', "File not found");
            return back();
        }
    }

    public function kertasKerja($plan_id, $template_id = null)
    {
        $plan = DruDistributionPlan::find($plan_id);
        $year = $plan->year;
        $cadangan_agihan_lists = null;
        $cadangan_agihan_semula_lists = null;
        $cadangan_agihan = DocTemplate::whereParentId($plan_id)->where('type', 'cadangan_agihan')->whereNotNull('value')->first();
        $agihan_semula = DocTemplate::whereParentId($plan_id)->where('type', 'agihan_semula')->whereNotNull('value')->first();
        $cadangan_agihan_semula_lists = DruDistributionPlan::where('year', $year)->whereType(3)->where('status', '!=', 1)->where('id', '!=', $plan_id)->get();
        $cadangan_agihan_lists = DruDistributionPlan::where('year', $year)->whereIn('type', [1,2])->where('status', '!=', 1)->where('id', '!=', $plan_id)->get();
        // dd($cadangan_agihan_semula_lists);
        if($template_id) $plan = DruDistributionPlan::find($template_id);
        $doc_templates = DocTemplate::whereParentId($plan->id)->orderBy('order')->get();
        $content_details = DocTemplate::whereParentId($plan->id)->where('type', 'terperinci')->get();
        $content_summaries = DocTemplate::whereParentId($plan->id)->where('type', 'ringkasan')->get();
        $no_rujukan = $doc_templates->where('type', 'no_rujukan')->first();
        $tajuk_kertas_kerja = $doc_templates->where('type', 'tajuk_kertas_kerja')->first();

        $parameters = Parameter::whereGroupId(5)->whereActive('Y')->get();
        $template_lists = DruDistributionPlan::whereIn('type', [1,2,3])->where('id', '!=', $plan_id)->where('status', '!=', 1)->orderBy('year', 'desc')->orderBy('type')->latest('created_at')->get();
        return view('dana-ru.cadangan-agihan.kertas-kerja', compact('cadangan_agihan_lists', 'cadangan_agihan_semula_lists','cadangan_agihan', 'agihan_semula', 'doc_templates', 'content_details', 'content_summaries', 'plan_id', 'plan', 'year', 'parameters', 'no_rujukan', 'tajuk_kertas_kerja', 'template_id', 'template_lists'));
    }

    public function kertasKerjaStore(Request $request, $plan_id)
    {
        $plan = DruDistributionPlan::find($plan_id);
        $this->templateStore($plan_id, 'no_rujukan', $request->no_rujukan);
        $this->templateStore($plan_id, 'tajuk_kertas_kerja', $request->tajuk_kertas_kerja);
        $this->templateStore($plan_id, 'cadangan_agihan', $request->cadangan_agihan);
        $this->templateStore($plan_id, 'agihan_semula', $request->agihan_semula);

        if(count($request->terperinci_title) > 0){
            $terperinciCount = DocTemplate::whereParentId($plan_id)->whereType('terperinci')->count();
            DocTemplate::whereParentId($plan_id)->whereType('terperinci')->orderBy('order', 'desc')
            ->take(abs(count($request->terperinci_title) - $terperinciCount))->get()
            ->each(function ($doc) {
                $doc->delete();
            });
        }
        foreach ($request->terperinci_title as $key => $title) {
            $this->templateStore($plan_id, 'terperinci', $request->terperinci_desc[$key], $key+1, $title, (int)$request->terperinci_check[$key], $request->terperinci_numbering_check ? 1:0, $request->terperinci_numbering[$key]);
        }

        if(count($request->ringkasan_title) > 0){
            $ringkasanCount = DocTemplate::whereParentId($plan_id)->whereType('ringkasan')->count();
            DocTemplate::whereParentId($plan_id)->whereType('ringkasan')->orderBy('order', 'desc')
            ->take(abs(count($request->ringkasan_title) - $ringkasanCount))->get()
            ->each(function ($doc) {
                $doc->delete();
            });
        }
        foreach ($request->ringkasan_title as $key => $title) {
            $this->templateStore($plan_id, 'ringkasan', $request->ringkasan_desc[$key], $key+1, $title, (int)$request->ringkasan_check[$key], $request->ringkasan_numbering_check ? 1:0, $request->ringkasan_numbering[$key]);
        }

        if(count($request->prepared_by_name) > 0){
            $nameCount = DocTemplate::whereParentId($plan_id)->whereType('prepared_by_name')->count();
            $roleCount = DocTemplate::whereParentId($plan_id)->whereType('prepared_by_role')->count();
            DocTemplate::whereParentId($plan_id)->whereType('prepared_by_name')->orderBy('order', 'desc')
            ->take(abs(count($request->prepared_by_name) - $nameCount))->get()
            ->each(function ($doc) {
                $doc->delete();
            });
            DocTemplate::whereParentId($plan_id)->whereType('prepared_by_role')->orderBy('order', 'desc')
            ->take(abs(count($request->prepared_by_role) - $roleCount))->get()
            ->each(function ($doc) {
                $doc->delete();
            });
        }
        foreach ($request->prepared_by_name as $key => $value) {
            $this->templateStore($plan_id, 'prepared_by_name', $value, $key+1);
            $this->templateStore($plan_id, 'prepared_by_role', $request->prepared_by_role[$key], $key+1);
        }
        if(count($request->verified_by_name) > 0){
            $nameCount = DocTemplate::whereParentId($plan_id)->whereType('verified_by_name')->count();
            $roleCount = DocTemplate::whereParentId($plan_id)->whereType('verified_by_role')->count();
            DocTemplate::whereParentId($plan_id)->whereType('verified_by_name')->orderBy('order', 'desc')
            ->take(abs(count($request->verified_by_name) - $nameCount))->get()
            ->each(function ($doc) {
                $doc->delete();
            });
            DocTemplate::whereParentId($plan_id)->whereType('verified_by_role')->orderBy('order', 'desc')
            ->take(abs(count($request->verified_by_role) - $roleCount))->get()
            ->each(function ($doc) {
                $doc->delete();
            });
        }
        foreach ($request->verified_by_name as $key => $value) {
            $this->templateStore($plan_id, 'verified_by_name', $value, $key+1);
            $this->templateStore($plan_id, 'verified_by_role', $request->verified_by_role[$key], $key+1);
        }
        if(count($request->confirmed_by_name) > 0){
            $nameCount = DocTemplate::whereParentId($plan_id)->whereType('confirmed_by_name')->count();
            $roleCount = DocTemplate::whereParentId($plan_id)->whereType('confirmed_by_role')->count();
            DocTemplate::whereParentId($plan_id)->whereType('confirmed_by_name')->orderBy('order', 'desc')
            ->take(abs(count($request->confirmed_by_name) - $nameCount))->get()
            ->each(function ($doc) {
                $doc->delete();
            });
            DocTemplate::whereParentId($plan_id)->whereType('confirmed_by_role')->orderBy('order', 'desc')
            ->take(abs(count($request->confirmed_by_role) - $roleCount))->get()
            ->each(function ($doc) {
                $doc->delete();
            });
        }
        foreach ($request->confirmed_by_name as $key => $value) {
            $this->templateStore($plan_id, 'confirmed_by_name', $value, $key+1);
            $this->templateStore($plan_id, 'confirmed_by_role', $request->confirmed_by_role[$key], $key+1);
        }
        session()->flash('success', "Kertas Kerja telah berjaya disimpan.");
        return redirect()->route('dana-ru.cadangan-agihan.kertas-kerja', ['plan_id' => $plan_id]);
    }

    public function templateStore($plan_id, $type, $value, $order = null, $title = null, $display = 1, $numbering_check = 0, $numbering = null)
    {
        DocTemplate::updateOrCreate(
            ['parent_id' => $plan_id, 'type' => $type, 'order' => $order],
            [
                'value' => $value,
                'order' => $order,
                'title' => $title,
                'display' => $display,
                'numbering_check' => $numbering_check,
                'numbering' => $numbering,
            ]
        );
    }

    public function storeAllocation($plan)
    {
        if($plan){
            MasterlistDruYear::updateOrCreate(
                ['year' => $plan->year],
                [
                    'allocation_main_fund_status' => 1,
                    'allocation_dist_fund_status' => 1,
                ]
            );
            if($plan->type == 4){
                $plan_forms = getDistributionFormPlans($plan->year, $plan->id, $plan->type);
                foreach ($plan_forms as $key => $plan_form) {
                    MasterlistDruAllocation::create([
                        "type" => $plan->type,
                        "tabung_induk" => getMainFundByFormula($plan_form->ddff_code, $plan_form->ddff_code_2),
                        "project" => $plan_form->ddff_code,
                        "sub_project" => $plan_form->ddff_code_2,
                        "program_id" => 0,
                        "bpki_id" => 0,
                        "ptj" => $plan_form->ptjf,
                        "ptj_code" => $plan_form->ptjf_code,
                        "jenis_agihan" => $plan_form->ddff_title,
                        "expenditure_type" => "MAIN",
                        "year" => $plan->year,
                        "amount" => -($plan_form->plan_form_amount),
                    ]);
                    MasterlistDruAllocation::create([
                        "type" => $plan->type,
                        "tabung_induk" => getMainFundByFormula($plan_form->ddft_code, $plan_form->ddft_code_2),
                        "project" => $plan_form->ddft_code,
                        "sub_project" => $plan_form->ddft_code_2,
                        "program_id" => 0,
                        "bpki_id" => 0,
                        "ptj" => $plan_form->ptjt,
                        "ptj_code" => $plan_form->ptjt_code,
                        "jenis_agihan" => $plan_form->ddft_title,
                        "expenditure_type" => "MAIN",
                        "year" => $plan->year,
                        "amount" => $plan_form->plan_form_amount,
                    ]);
                }
            }
            else if($plan->type == 5){
                $agihanSemulaPlan = DruDistributionPlan::find($plan->parent_id);
                $agihanSemulaPlan->amount = $plan->amount;
                $agihanSemulaPlan->save();
                $plan_forms = getDistributionFormPlans($plan->year, $plan->id, $plan->type);
                foreach ($plan_forms as $key => $plan_form) {
                    MasterlistDruAllocation::create([
                        "type" => $plan->type,
                        "tabung_induk" => getMainFundByFormula($plan_form->ddf_code, $plan_form->ddf_code_2),
                        "project" => $plan_form->ddf_code,
                        "sub_project" => $plan_form->ddf_code_2,
                        "program_id" => 0,
                        "bpki_id" => 0,
                        "ptj" => $plan_form->ptj,
                        "ptj_code" => $plan_form->ptj_code,
                        "jenis_agihan" => $plan_form->ddf_title,
                        "expenditure_type" => "MAIN",
                        "year" => $plan->year,
                        "amount" => -($plan_form->plan_form_amount),
                    ]);
                }
            }
            else {
                $plan_forms = getDistributionFormPlans($plan->year, $plan->id);
                foreach ($plan_forms as $key => $plan_form) {
                    MasterlistDruAllocation::create([
                        "type" => $plan->type,
                        "tabung_induk" => getMainFundByFormula($plan_form->ddf_code, $plan_form->ddf_code_2),
                        "project" => $plan_form->ddf_code,
                        "sub_project" => $plan_form->ddf_code_2,
                        "program_id" => $plan_form->mrun_id,
                        "bpki_id" => $plan_form->bpki_id,
                        "ptj" => $plan_form->ptj,
                        "ptj_code" => $plan_form->ptj_code,
                        "jenis_agihan" => $plan_form->ddf_title,
                        "expenditure_type" => "MAIN",
                        "year" => $plan->year,
                        "amount" => $plan_form->plan_form_amount,
                    ]);
                }
            }
        }
    }
}
