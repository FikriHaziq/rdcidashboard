<?php

namespace App\View\Components\Dru;

use Illuminate\View\Component;

class Infography extends Component
{
    public $year;
    public $plan;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($year, $plan)
    {
        $this->year = $year;
        $this->plan = $plan;
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
