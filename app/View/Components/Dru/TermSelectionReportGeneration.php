<?php

namespace App\View\Components\Dru;

use Illuminate\View\Component;

class TermSelectionReportGeneration extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $plan_id;
    public $terms;
    public $elem_id;
    public $report_type;

    public function __construct($planId, $terms, $elemId, $reportType = 'a')
    {
        $this->plan_id = $planId;
        $this->terms = $terms;
        $this->elem_id = $elemId;
        $this->report_type = $reportType;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dru.term-selection-report-generation');
    }
}
