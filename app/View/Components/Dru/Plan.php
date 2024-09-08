<?php

namespace App\View\Components\Dru;

use Illuminate\View\Component;

class Plan extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $plans;
    public $year;
    public $type;

    public function __construct($year, $plans, $type)
    {
        $this->plans = $plans;
        $this->year = $year;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dru.plan');
    }
}
