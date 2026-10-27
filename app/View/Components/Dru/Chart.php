<?php

namespace App\View\Components\dru;

use Illuminate\View\Component;

class Chart extends Component
{
    public $type;
    public $chartId;
    public $colors;
    public $infos;
    public $title;
    public $labels;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type,  $chartId, $colors, $infos, $title = null, $labels = [])
    {
        $this->type = $type;
        $this->chartId = $chartId;
        $this->colors = $colors;
        $this->infos = $infos;
        $this->title = $title;
        $this->labels = $labels;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dru.chart');
    }
}
