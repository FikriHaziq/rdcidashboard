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
        $fund = $this->amount;
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
        if($this->type == 1) {
            $do = 0;
            $gp = 0;
            $pp = 0;
            $total = 0;
            $plans = DruDistributionPlan::whereIn('type', [1,2])->get();
            $fund = $plans->sum('amount');
            foreach ($plans as $key => $plan) {
                foreach ($plan->forms as $key => $form) {
                    if($form->bpki == 50)$do += $form->amount;
                    elseif($form->bpki == 51)$gp += $form->amount;
                    elseif($form->bpki == 52)$pp += $form->amount;
                    $total += $form->amount;
                }
            }
        }
        // dd($do);
        $do_percent = $fund > 0 ? $do/$fund*100 : 0;
        $gp_percent = $fund > 0 ? $gp/$fund*100 : 0;
        $pp_percent = $fund > 0 ? $pp/$fund*100 : 0;

        return $data = [
            'fund'=>$fund,
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

    public function baselineCost($amount, $percent)
    {
        return $amount * $percent/100;
    }
}
