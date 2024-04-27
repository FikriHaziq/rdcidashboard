<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Title extends Component
{
    public $hasYear;
    public $year;
    public $yearOptions;
    public $route;
    public $hasButton;
    public $buttonLabel;
    public $buttonRoute;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($hasYear = false, $year = null, $yearOptions = null, $route = '', $hasButton = false, $buttonRoute = null, $buttonLabel = null)
    {
        $this->hasYear = $hasYear;
        $this->year = $year;
        $this->route = $route;
        $this->hasButton = $hasButton;
        $this->buttonRoute = $buttonRoute;
        $this->buttonLabel = $buttonLabel;

        if($yearOptions) $this->yearOptions = $yearOptions;
        else {
            $this->yearOptions = [];
            for ($i = date('Y') - 8; $i <= date('Y'); $i++){
                array_push($this->yearOptions, $i);
            }
        }
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
