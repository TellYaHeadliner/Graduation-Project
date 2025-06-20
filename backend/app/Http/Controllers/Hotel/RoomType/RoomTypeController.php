<?php

namespace App\Http\Controllers\Hotel\RoomType;

use App\DataTables\Hotel\RoomType\RoomTypeDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return [
            'index' => 'hotel.room_types.index',
            'create' => 'hotel.room_types.create',
            'edit' => 'hotel.room_types.edit'
        ];
    }
    public function getRoute(): array
    {
        return [
            'index' => 'hotel.room_type.index',
            'create' => 'hotel.room_type.create',
            'edit' => 'hotel.room_type.edit',
            'delete' => 'hotel.room_type.delete'
        ];
    }
    public function index(RoomTypeDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách Loại phòng'))
        ]);
    }
    public function create($hotel_id)
    {
        return view($this->view['create'], [
            'breadcrumbs' => $this->crums->add(
                __('Danh sách Loại phòng'),
                route($this->route['index'], $hotel_id)
            )->add('Thêm Loại phòng'),
        ]);
    }
}
