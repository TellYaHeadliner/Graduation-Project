<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class ComponentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('alert', \App\View\Components\Layout\Alert::class);
        Blade::component('alert-user', \App\View\Components\Layout\AlertUser::class);
        Blade::component('admin-sidebar-left', \App\View\Components\Layout\SidebarLeft::class);
        Blade::component('admin-item-link-sidebar-left', \App\View\Components\Link\AdminItemLinkSidebarLeft::class);
        Blade::component('form', \App\View\Components\Form::class);
        Blade::component('input', \App\View\Components\Input\Input::class);
        Blade::component('input-checkbox', \App\View\Components\Input\InputCheckbox::class);
        Blade::component('input-base-checkbox', \App\View\Components\Input\InputBaseCheckbox::class);
        Blade::component('input-switch', \App\View\Components\Input\InputSwitch::class);
        Blade::component('input-password', \App\View\Components\Input\InputPassword::class);
        Blade::component('input-email', \App\View\Components\Input\InputEmail::class);
        Blade::component('input-phone', \App\View\Components\Input\InputPhone::class);
        Blade::component('input-color', \App\View\Components\Input\InputColor::class);
        Blade::component('input-number', \App\View\Components\Input\InputNumber::class);
        Blade::component('input-price', \App\View\Components\Input\InputPrice::class);
        Blade::component('input-icon', \App\View\Components\Input\InputIcon::class);
        Blade::component('input-ckeditor', \App\View\Components\Input\InputCkeditor::class);
        // Blade::component('input-datetime', \App\View\Components\Input\InputDatetime::class);
        Blade::component('input-gallery-ckfinder', \App\View\Components\Input\InputGalleryCkfinder::class);
        Blade::component('input-image-ckfinder', \App\View\Components\Input\InputImageCkfinder::class);
        Blade::component('input-file-ckfinder', \App\View\Components\Input\InputFileCkfinder::class);
        Blade::component('input-pick-address', \App\View\Components\Input\InputPickAddress::class);
        Blade::component('input-pick-address-user', \App\View\Components\Input\InputPickAddressUser::class);
        Blade::component('input-pick-end-address', \App\View\Components\Input\InputPickEndAddress::class);



        // Blade::component('input-video', \App\View\Components\Input\InputVideo::class);
        Blade::component('textarea', \App\View\Components\Input\Textarea::class);
        Blade::component('select', \App\View\Components\Select\Select::class);
        Blade::component('select-option', \App\View\Components\Select\Option::class);
    }
}
