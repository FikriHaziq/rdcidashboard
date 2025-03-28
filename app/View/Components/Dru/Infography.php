<?php

namespace App\View\Components\Dru;

use Illuminate\View\Component;

class Infography extends Component
{
    public $year;
    public $plan;
    public $type;
    public $page;
    public $infoData;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($year, $plan, $type = null, $page = null)
    {
        $this->year = $year;
        $this->plan = $plan;
        $this->type = $type;
        $this->page = $page;
        $this->infoData = infographicData($this->plan);
        // dd($this->infoData);
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
