<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $module;
    public $moduleLink;
    public $submodule;
    public $submoduleLink;
    public $trimodule;
    public $trimoduleLink;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($module = null, $moduleLink = null, $submodule = null, $submoduleLink = null, $trimodule = null, $trimoduleLink = null)
    {
        $this->module = $module;
        $this->moduleLink = $moduleLink;
        $this->submodule = $submodule;
        $this->submoduleLink = $submoduleLink;
        $this->trimodule = $trimodule;
        $this->trimoduleLink = $trimoduleLink;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}
