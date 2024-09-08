<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $modalId;
    public $title;
    public $formId;
    public $footer;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modalId, $title, $formId = null, $footer = true)
    {
        $this->modalId = $modalId;
        $this->title = $title;
        $this->formId = $formId;
        $this->footer = $footer;
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
