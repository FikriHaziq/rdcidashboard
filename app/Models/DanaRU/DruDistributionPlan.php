<?php

namespace App\Models\DanaRU;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ApprovalApp;
use App\Models\Status;

class DruDistributionPlan extends Model
{
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

    public function infographicData()
    {
        $do = 0;
        $gp = 0;
        $pp = 0;
        $total = 0;
        
        foreach ($this->forms as $key => $form) {
            if($form->bpki == 50)$do += $form->amount;
            elseif($form->bpki == 51)$gp += $form->amount;
            elseif($form->bpki == 52)$pp += $form->amount;
            $total += $form->amount;
        }
        $do_percent = $this->amount > 0 ? $do/$this->amount*100 : 0;
        $gp_percent = $this->amount > 0 ? $gp/$this->amount*100 : 0;
        $pp_percent = $this->amount > 0 ? $pp/$this->amount*100 : 0;

        return $data = [
            'do'=>$do,
            'gp'=>$gp,
            'pp'=>$pp,
            'do_percent' => $do_percent,
            'gp_percent' => $gp_percent,
            'pp_percent' => $pp_percent,
            'do_color' => $do_percent > 20 ? 6 : 10,
            'gp_color' => $gp_percent > 60 ? 6 : 10,
            'pp_color' => $pp_percent > 20 ? 6 : 10,
            'total' => $total
        ];
    }

    public function baselineCost($percent)
    {
        return $this->amount * $percent/100;
    }
}
