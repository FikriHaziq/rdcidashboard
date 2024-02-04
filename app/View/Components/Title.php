<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Title extends Component
{
    public $hasYear;
    public $year;
    public $route;
    public $hasButton;
    public $buttonLabel;
    public $buttonRoute;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($hasYear = false, $year = null, $route = '', $hasButton = false, $buttonRoute = null, $buttonLabel = null)
    {
        $this->hasYear = $hasYear;
        $this->year = $year;
        $this->route = $route;
        $this->hasButton = $hasButton;
        $this->buttonRoute = $buttonRoute;
        $this->buttonLabel = $buttonLabel;
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
