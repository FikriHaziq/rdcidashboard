<?php

namespace App\View\Components\Dru;

use Illuminate\View\Component;

class PicForm extends Component
{
    public $year;
    public $plan;
    public $plan_form;
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
