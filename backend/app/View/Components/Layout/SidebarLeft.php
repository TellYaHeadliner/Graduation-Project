<?php

namespace App\View\Components\Layout;

use App\Enums\User\UserRole;
use Illuminate\View\Component;
use App\Traits\GetConfig;
use GPBMetadata\Google\Api\Auth;

class SidebarLeft extends Component
{
    use GetConfig;
    public $menu;
    public function __construct()
    {   
        if(Auth()->check()&&Auth()->user()->role===UserRole::Admin){
            $this->menu = $this->traitGetConfigAdminSidebar();
        }
        else{
            $this->menu = $this->traitGetConfigHotelSidebar();
        }
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
