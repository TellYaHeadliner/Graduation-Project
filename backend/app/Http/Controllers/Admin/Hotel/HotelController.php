<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\DataTables\Admin\Hotel\HotelDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HotelController extends Controller
{
   private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView(): array
    {
        return [
            'index' => 'admin.hotel.index',
            'create' => 'admin.hotel.create',
            'edit' => 'admin.hotel.edit'
        ];
    }

    public function getRoute(): array
    {
        return [
            'index' => 'admin.hotel.index',
            'create' => 'admin.hotel.create',
            'edit' => 'admin.hotel.edit',
            'delete' => 'admin.hotel.delete'
        ];
    }

    public function index(HotelDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách khách sạn'))
        ]);
    }
}
