<?php

namespace App\Models\DanaRU;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ApprovalApp;
use App\Models\Status;
use App\Models\Parameter;

class DruDistributionPlanForm extends Model
{
    use HasFactory;
    
    public function distribution_plan()
    {
        return $this->belongsTo(DruDistributionPlan::class, 'distribution_plan_id');
    }

    public function mrun_details()
    {
        return $this->belongsTo(Parameter::class, 'mrun');
    }

    public function bpki_details()
    {
        return $this->belongsTo(Parameter::class, 'bpki');
    }

    public function project()
    {
        return $this->belongsTo(DruDistFund::class, 'project_id');
    }

    public function project_transfer()
    {
        return $this->belongsTo(DruDistFund::class, 'project_id_transfer');
    }

    public function ptj()
    {
        return $this->belongsTo(Parameter::class, 'ptj_id');
    }

    public function ptj_transfer()
    {
        return $this->belongsTo(Parameter::class, 'ptj_id_transfer');
    }

    public function pic()
    {
        return $this->hasOne(DruMember::class, 'distribution_plan_form_id')->wheretype('leader');
    }

    public function member()
    {
        return $this->hasOne(DruMember::class, 'distribution_plan_form_id')->wheretype('member');
    }

    public function main_kpi()
    {
        return $this->hasMany(DruKpi::class, 'distribution_plan_form_id')->wheretype('main')->orderBy('id');
    }

    public function kpi()
    {
        return $this->hasMany(DruKpi::class, 'distribution_plan_form_id')->wheretype('kpi')->orderBy('id');
    }

    public function pic_kpi()
    {
        return $this->hasMany(DruKpiPic::class, 'distribution_plan_form_id')->whereStatus('active')->orderBy('id');
    }

    public function pic_status()
    {
        return $this->belongsTo(Status::class, 'pic_submission_status');
    }

    public function pic_evidences()
    {
        return $this->hasMany(DruDataAttachment::class, 'parent_id')->whereTable('plan_form')->whereIsActive('Y');  
    }

    public function getPicEvidencesIdArrayAttribute()
    {
        $idArr = [];
        foreach ($this->pic_evidences as $key => $evidence) {
            array_push($idArr, $evidence->id);
            // $mediaItem = $evidence->getFirstMedia('druDataAttachment');
            // $fileid = asset('storage/' . $mediaItem->id . '/' . $mediaItem->file_name);
        }
        
        return $idArr;
    }

    public function pic_logs()
    {
        return $this->hasMany(ApprovalApp::class, 'app_id')->whereModuleId(2)->orderBy('index', 'desc');
    }

    public function getPtjInputDataAttribute()
    {
        return $this->ptj ? $code = $this->ptj->id . '_' . $this->ptj->original_code : null;
    }

    public function getPtjTransferInputDataAttribute()
    {
        return $this->ptj_transfer ? $code = $this->ptj_transfer->id . '_' . $this->ptj_transfer->original_code : null;
    }

    public function getProjectInputDataAttribute()
    {
        $project = $this->project;
        $code_2 = $project->code_2 ?? '00000';
        return in_array($project->status, ['active', 'not-active']) ? $project->id.'_'.$project->code.'_'.$code_2.'_'.$project->faculty_code : $project->title;
    }

    public function getProjectTransferInputDataAttribute()
    {
        $project = $this->project_transfer;
        $code_2 = $project->code_2 ?? '00000';
        return in_array($project->status, ['active', 'not-active']) ? $project->id.'_'.$project->code.'_'.$code_2.'_'.$project->faculty_code : $project->title;
    }

    public function getKpiInputDataAttribute()
    {
        $data = [
            'main_dist'=>[],
            'kpi'=>[],
            'mykpi'=>[],
        ];
        $year = $this->distribution_plan->year;
        // $plans = getDruPlanList($year);
        // dd($plans);
        // ->where('status', 6);
        // $plan_form_raw = null;
        // foreach ($plans as $key => $plan) {
        //     $plan_form = getDistributionFormPlans($year, $plan->id);
        //     if(!$plan_form_raw)$plan_form_raw = $plan_form;
        //     else $plan_form_raw = $plan_form_raw->concat($plan_form);
        // }
        // dd($plan_form_raw[1]);
        // $plan_forms = refactorPlanFormList($plan_form_raw);
        // $plan_forms = $plan_forms->where('plan_form_id', $this->id)->first();
        $plan_forms = getDistributionFormPlans($year, $this->distribution_plan->id, null, $this->id);
        $plan_forms = refactorPlanFormList($plan_forms)[0];
        // dd($plan_forms);

        foreach ($plan_forms->main_kpi_dataset ?? [] as $key => $main_kpi) {
            array_push($data['main_dist'], [
                'id' =>$main_kpi['id'],
                'item_id' =>$main_kpi['item_id'],
                'item_name' =>$main_kpi['item_name'] ?? "[Deleted]",
                'active' =>$main_kpi['active'],
                'bil' =>$main_kpi['bil'],
                'amount' =>$main_kpi['amount'],
                'total' =>$main_kpi['total'],
                'remark' =>$main_kpi['remark'],
            ]);
        }
        foreach ($plan_forms->kpi_dataset ?? [] as $key => $kpi) {
            array_push($data['kpi'], [
                'id' =>$kpi['id'],
                'item_id' =>$kpi['item_id'],
                'item_name' =>$kpi['item_name'] ?? "[Deleted]",
                'active' =>$kpi['active'],
                'bil' =>$kpi['bil'],
                'amount' =>$kpi['amount'],
                'total' =>$kpi['total'],
                'remark' =>$kpi['remark'],
            ]);
        }
        foreach ($this->pic_kpi as $key => $pic_kpi) {
            array_push($data['mykpi'], [
                'id' =>$pic_kpi->id,
                'item_id' =>$pic_kpi->template->id ?? null,
                'item_name' =>$pic_kpi->template->title ?? "[Deleted]",
                'active' =>$pic_kpi->template->active ?? null,
                'bil' =>$pic_kpi->count,
                'amount' =>$pic_kpi->amount,
                'total' =>$pic_kpi->total,
                'remark' =>$pic_kpi->remark,
            ]);
        }
        return $data;
    }
}
