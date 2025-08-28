<?php

namespace App\View\Components\Dru;

use Illuminate\View\Component;

class Infography extends Component
{
    public $year;
    public $plan;
    public $plans;
    public $childPlan;
    public $childPlanState;
    public $type;
    public $page;
    public $infoData;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($year, $plan, $plans = null,  $type = null, $page = null)
    {
        $this->year = $year;
        $this->plan = $plan;
        $this->plans = $plans;
        if($plan instanceof \Illuminate\Database\Eloquent\Model && $plan->type == 3){
            $this->childPlan = $plans ? $plans->where('parent_id', $plan->id)->first() : null;
            if($this->childPlan){
                $this->childPlanState = [
                    "btn" => $this->childPlan->status == 6 ? "btn-secondary-soft text-gray-800" : "btn-warning-soft",
                    "icon" => $this->childPlan->status == 6 ? "check-circle" : "clock",
                    "icon_bg" => $this->childPlan->status == 6 ? "bg-theme-9" : "bg-theme-12",
                ];
            }
        }
        $this->type = $type;
        $this->page = $page;
        $this->infoData = infographicData($this->plan);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dru.infography');
    }
}
