<?php

namespace App\View\Components\Dru;

use Illuminate\View\Component;
use App\Models\MasterList\MasterlistDruExpenses;

class PicForm extends Component
{
    public $year;
    public $plan;
    public $plan_form;
    public $expenses;
    public $edit;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($year, $plan, $planform, $edit = true)
    {
        $this->year = $year;
        $this->plan = $plan;
        $this->plan_form = $planform;
        $this->edit = $edit;
        $dru_dist_fund = $this->plan_form->project;
        $this->expenses = MasterlistDruExpenses::where('year', $year)
        ->where('ptj', $dru_dist_fund->faculty_code)
        ->where('project', $dru_dist_fund->code)
        ->where('sub_project', $dru_dist_fund->code_2)->orderBy('month')->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dru.pic-form');
    }
}
