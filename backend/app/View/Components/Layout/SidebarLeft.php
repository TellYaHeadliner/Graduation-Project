<?php

namespace App\View\Components\Layout;


use Illuminate\View\Component;
use App\Traits\GetConfig;

class SidebarLeft extends Component
{
    use GetConfig;
    public $menu;
    public function __construct()
    {
        $this->menu = $this->traitGetConfigSidebar();
    }

    public function routeName($routeName, $param)
    {
        return $routeName ? route($routeName, $param) : '#';
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.sidebar-left');
    }
}
