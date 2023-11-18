<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Title extends Component
{
    public $hasYear;
    public $year;
    public $route;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($hasYear = false, $year = null, $route = '')
    {
        $this->hasYear = $hasYear;
        $this->year = $year;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.title');
    }
}
