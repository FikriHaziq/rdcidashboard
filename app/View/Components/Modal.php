<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $modalId;
    public $title;
    public $formId;
    public $footerFlag;
    public $customFooter;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modalId, $title, $formId = null, $footerFlag = true, $customFooter = false)
    {
        $this->modalId = $modalId;
        $this->title = $title;
        $this->formId = $formId;
        $this->footerFlag = $footerFlag;
        $this->customFooter = $customFooter;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
