<?php

namespace App\DataTables\Hotel\Room;

use App\DataTables\BaseDataTable;
use App\Enums\Room\RoomStatus;
use App\Models\Room;
use App\Traits\GetConfig;
use Illuminate\Support\Facades\DB;

class RoomDataTable extends BaseDataTable
{

    use GetConfig;
    protected $nameTable = 'roomTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct()
    {
        parent::__construct();

        $this->repository = Room::class;
    }

    public function setView(): void
    {
        $this->view = [
            'code' => 'hotel.rooms.datatable.code',
            'room_type' => 'hotel.rooms.datatable.room_type',
            'status' => 'hotel.rooms.datatable.status',
            'action' => 'hotel.rooms.datatable.action',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2];

        $this->columnSearchSelect = [
            [
                'column' => 2,
                'data' => RoomStatus::asSelectArray()
            ],
        ];
    }

    public function query()
    {
        return $this->repository::with('roomType')->where('hotel_id', Auth()->user()->id)->orderBy('created_at', 'desc');
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.rooms', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'code' => $this->view['code'],
            'status' => $this->view['status'],
        ];
    }

    protected function setCustomAddColumns(): void
    {
        $this->customAddColumns = [
            'action' => $this->view['action'],
            'room_type' => $this->view['room_type'],
        ];
    }

    protected function setCustomRawColumns(): void
    {
        $this->customRawColumns = ['action', 'code', 'status', 'room_type'];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            'room_type' => function ($query, $keyword) {
                $query->whereHas('roomType', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            },
        ];
    }
}
