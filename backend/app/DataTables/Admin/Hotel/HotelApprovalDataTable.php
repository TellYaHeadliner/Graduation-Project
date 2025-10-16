<?php

namespace App\DataTables\Admin\Hotel;

use App\DataTables\BaseDataTable;
use App\Enums\Hotel\HotelStatus;
use App\Models\Hotel;
use App\Traits\GetConfig;


class HotelApprovalDataTable extends BaseDataTable
{

    use GetConfig;
    protected $nameTable = 'hotelApprovalTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct()
    {
        parent::__construct();

        $this->repository = Hotel::class;
    }

    public function setView(): void
    {
        $this->view = [
            'name' => 'admin.hotel.datatable.name',
            'owner' => 'admin.hotel.datatable.owner',
            'phone' => 'admin.hotel.datatable.phone',
            'mst' => 'admin.hotel.datatable.mst',
            'avatar' => 'admin.hotel.datatable.avatar',
            'status' => 'admin.hotel.datatable.status',
            'action' => 'admin.hotel.hotel_approval.datatable.action',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2, 3, 5];

        $this->columnSearchSelect = [
            [
                'column' => 5,
                'data' => HotelStatus::asSelectArray()
            ],
        ];
    }

    public function query()
    {
        return $this->repository::with('user')
            ->whereIn('status', [
                HotelStatus::Pending->value,
                HotelStatus::Rejected->value,
            ])
            ->orderBy('created_at', 'desc');
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.hotels', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'name' => $this->view['name'],
            'phone' => $this->view['phone'],
            'mst' => $this->view['mst'],
            'avatar' => $this->view['avatar'],
            'status' => $this->view['status'],
        ];
    }

    protected function setCustomAddColumns(): void
    {
        $this->customAddColumns = [
            'action' => $this->view['action'],
            'owner' => $this->view['owner'],
        ];
    }

    protected function setCustomRawColumns(): void
    {
        $this->customRawColumns = ['action', 'name', 'phone', 'mst', 'avatar', 'status', 'owner'];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            'owner' => function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('fullname', 'like', '%' . $keyword . '%');
                });
            },
        ];
    }
}
