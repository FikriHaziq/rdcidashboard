<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MenuItem extends Component
{
    /** parseValue only works with route; */

    public $route;
    public $rawUrl;
    public $customTabVal;
    public $active;
    public $type;
    public $parent;
    public $icon;
    public $target;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($route = "", $rawUrl = false, $customTabVal = "", $active = "", $parent = "", $type = "", $icon = "", $target = "0")
    {
        $this->route = $route;
        $this->rawUrl = $rawUrl;
        $this->customTabVal = $customTabVal;
        $this->active = $active;
        $this->type = $type;
        $this->parent = $parent;
        $this->icon = $icon;
        $this->target = $target;
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
