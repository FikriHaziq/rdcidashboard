<?php

namespace App\View\Components\dru\infographic;

use Illuminate\View\Component;

class TncpiProject extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $chart_data;

    public function __construct($chartdata)
    {
        $this->chart_data = $chartdata;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dru.infographic.tncpi-project');
    }
}
