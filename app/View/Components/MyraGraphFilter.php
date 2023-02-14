<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MyraGraphFilter extends Component
{
    /** parseValue only works with route; */

    public $start_year;
    public $end_year;
    public $faculty;
    public $school;
    public $endpoint;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($startYear, $endYear, $facultyCode, $schoolCode, $endpoint)
    {
        $this->start_year = $startYear;
        $this->end_year = $endYear;
        $this->faculty = $facultyCode;
        $this->school = $schoolCode;
        $this->endpoint = $endpoint;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.myra-graph-filter');
    }
}
