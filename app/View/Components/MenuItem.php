<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MenuItem extends Component
{
    public $route;
    public $active;
    public $type;
    public $parent;
    public $icon;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route = "", $active = "", $parent = "", $type = "", $icon = "box")
    {
        $this->route = $route;
        $this->active = $active;
        $this->type = $type;
        $this->parent = $parent;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu-item');
    }
}
