<?php

namespace App\Models\DanaRU;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        return $this->belongsTo(DruProject::class, 'project_id');
    }

    public function ptj()
    {
        return $this->belongsTo(Parameter::class, 'ptj_id');
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

    public function getPtjInputDataAttribute()
    {
        return $this->ptj ? $code = $this->ptj->id . '_' . $this->ptj->original_code : null;
    }

    public function getProjectInputDataAttribute()
    {
        $project = $this->project;
        $code_2 = $project->code_2 ?? '00000';
        return $project->status == 'active' ? $project->id.'_'.$project->code.'_'.$code_2.'_'.$project->is_fixed_subproject : $project->title;
    }

    public function getKpiInputDataAttribute()
    {
        $data = [
            'main_dist'=>[],
            'kpi'=>[],
        ];
        foreach ($this->main_kpi as $key => $main_kpi) {
            array_push($data['main_dist'], [
                'id' =>$main_kpi->id,
                'item' =>$main_kpi->kpi_template_id,
                'bil' =>$main_kpi->count,
                'amount' =>$main_kpi->amount,
                'total' =>$main_kpi->total,
            ]);
        }
        foreach ($this->kpi as $key => $kpi) {
            array_push($data['kpi'][], [
                'id' =>$kpi->id,
                'item' =>$kpi->kpi_template_id,
                'bil' =>$kpi->count,
                'amount' =>$kpi->amount,
                'total' =>$kpi->total,
            ]);
        }
        return $data;
    }
}
