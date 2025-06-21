<?php

namespace App\DataTables\Hotel\RoomType;

use App\DataTables\BaseDataTable;
use App\Enums\RoomType\RoomTypeStatus;
use App\Models\RoomType;
use App\Traits\GetConfig;
use Illuminate\Support\Facades\DB;

class RoomTypeDataTable extends BaseDataTable
{

    use GetConfig;
    protected $nameTable = 'roomTypeTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct()
    {
        parent::__construct();

        $this->repository = RoomType::class;
    }

    public function setView(): void
    {
        $this->view = [
            'name' => 'hotel.room_types.datatable.name',
            'area' => 'hotel.room_types.datatable.area',
            'room_quantity' => 'hotel.room_types.datatable.room_quantity',
            'room_code' => 'hotel.room_types.datatable.room_code',
            'bed_type_id' => 'hotel.room_types.datatable.bed_type_id',
            'bed_quantity' => 'hotel.room_types.datatable.bed_quantity',
            'variants' => 'hotel.room_types.datatable.variants',
            'status' => 'hotel.room_types.datatable.status',
            'action' => 'hotel.room_types.datatable.action',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2, 3, 4, 5, 7];

        $this->columnSearchSelect = [
            [
                'column' => 7,
                'data' => RoomTypeStatus::asSelectArray()
            ],
        ];
    }

    public function query()
    {
        return $this->repository::with('bedType')->where('hotel_id', Auth()->user()->id)->orderBy('created_at', 'desc');
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.room_types', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'name' => $this->view['name'],
            'area' => $this->view['area'],
            'room_quantity' => $this->view['room_quantity'],
            'room_code' => $this->view['room_code'],
            'bed_quantity' => $this->view['bed_quantity'],
            'status' => $this->view['status'],
        ];
    }

    protected function setCustomAddColumns(): void
    {
        $this->customAddColumns = [
            'action' => $this->view['action'],
            'variants' => $this->view['variants'],
            'bed_type_id' => $this->view['bed_type_id'],
        ];
    }

    protected function setCustomRawColumns(): void
    {
        $this->customRawColumns = ['action', 'name', 'area', 'room_quantity', 'room_code', 'bed_type_id', 'bed_quantity', 'status', 'variants'];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            'bed_type_id' => function ($query, $keyword) {
                $query->whereHas('bed_types', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            },
        ];
    }
}
