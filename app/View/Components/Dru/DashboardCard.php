<?php

namespace App\View\Components\dru;

use Illuminate\View\Component;

class DashboardCard extends Component
{
    public $theme;
    public $title;
    public $totalAllocation;
    public $totalProgrammes;
    public $avgAllocationShare;
    public $avgAllocationProgramme;
    public $totalProgrammesShare;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($theme, $title, $totalAllocation, $totalProgrammes, $avgAllocationShare, $avgAllocationProgramme, $totalProgrammesShare)
    {
        $this->theme = $theme;
        $this->title = $title;
        $this->totalAllocation = $totalAllocation;
        $this->totalProgrammes = $totalProgrammes;
        $this->avgAllocationShare = $avgAllocationShare;
        $this->avgAllocationProgramme = $avgAllocationProgramme;
        $this->totalProgrammesShare = $totalProgrammesShare;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dru.dashboard-card');
    }
}
