<?php

namespace App\View\Components\Dru;

use Illuminate\View\Component;

class Tab extends Component
{
    public $verificationTab;
    public $verificationLabel;
    public $tab;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tab = null, $verificationtab = false, $verificationlabel = null)
    {
        $this->tab = $tab;
        $this->verificationTab = $verificationtab;
        $this->verificationLabel = $verificationlabel;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dru.tab');
    }
}
