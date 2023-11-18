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

    public function sub_project()
    {
        return $this->belongsTo(DruSubProject::class, 'sub_project_id');
    }

    public function ptj()
    {
        return $this->belongsTo(Parameter::class, 'ptj_id');
    }

    public function pic()
    {
        return $this->hasOne(DruMember::class, 'distribution_plan_form_id')->wheretype('leader');
    }

    public function members()
    {
        return $this->hasMany(DruMember::class, 'distribution_plan_form_id')->wheretype('member');
    }

    public function getPtjCodeAttribute()
    {
        $length = 7;
        $ptj_code = $this->ptj->original_code;
        $res = $ptj_code;
        for ($i=0; $i < ($length - strlen($ptj_code)); $i++) { 
            $res .= '0';
        }
        return $res;
    }

    public function main_kpi()
    {
        return $this->hasMany(DruKpi::class, 'distribution_plan_form_id')->wheretype('main');
    }

    public function kpi()
    {
        return $this->hasMany(DruKpi::class, 'distribution_plan_form_id')->wheretype('kpi');
    }
}
