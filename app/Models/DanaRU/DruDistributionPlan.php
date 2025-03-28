<?php

namespace App\Models\DanaRU;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ApprovalApp;
use App\Models\Status;

class DruDistributionPlan extends Model
{
    //Type
    // 1 => Agihan Utama
    // 2 => Agihan Tambahan
    // 3 => Agihan Semula
    // 4 => Pindahan

    use HasFactory;

    public function log()
    {
        return $this->hasMany(ApprovalApp::class, 'app_id')->whereModuleId(1)->orderBy('index', 'desc');
    }

    public function forms()
    {
        return $this->hasMany(DruDistributionPlanForm::class, 'distribution_plan_id');
    }

    public function getStatus()
    {
        return $this->belongsTo(Status::class, 'status');
    }

    public function baselineCost($amount, $percent)
    {
        return $amount * $percent/100;
    }

    public function getTypeDetailsAttribute()
    {
        if($this->type == 1) return "cadangan_agihan";
        if($this->type == 2) return "cadangan_agihan";
        if($this->type == 3) return "agihan_semula";
        if($this->type == 4) return "pindahan";
    }
}
