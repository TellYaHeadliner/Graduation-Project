<?php

namespace App\Traits;

trait GetConfig
{
    public function traitGetConfigAdminSidebar()
    {
        return config('admin_sidebar') ?? [];
    }

    public function traitGetConfigHotelSidebar()
    {
        return config('hotel_sidebar') ?? [];
    }

    public function traitGetConfigImageDefault()
    {
        return config('custom.images.default') ?? [];
    }

    public function traitGetConfigDatatableColumns($table)
    {
        return config('datatables_columns.' . $table) ?? [];
    }
}
