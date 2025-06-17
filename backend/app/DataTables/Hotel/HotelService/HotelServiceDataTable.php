<?php

namespace App\DataTables\Hotel\HotelService;

use App\DataTables\BaseDataTable;
use App\Enums\HotelService\HotelServiceStatus;
use App\Models\HotelService;
use App\Traits\GetConfig;
use Illuminate\Support\Facades\DB;

class HotelServiceDataTable extends BaseDataTable
{

    use GetConfig;
    protected $nameTable = 'hotelServiceTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct()
    {
        parent::__construct();

        $this->repository = HotelService::class;
    }

    public function setView(): void
    {
        $this->view = [
            'name' => 'hotel.hotel_services.datatable.name',
            'default_unit' => 'hotel.hotel_services.datatable.default_unit',
            'short_description' => 'hotel.hotel_services.datatable.short_description',
            'base_price' => 'hotel.hotel_services.datatable.base_price',
            'promo_price' => 'hotel.hotel_services.datatable.promo_price',
            'status' => 'hotel.hotel_services.datatable.status',
            'action' => 'hotel.hotel_services.datatable.action',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2, 3, 4, 5];

        $this->columnSearchSelect = [
            [
                'column' => 5,
                'data' => HotelServiceStatus::asSelectArray()
            ],
        ];
    }

    public function query()
    {
        return HotelService::with(['hotel', 'service'])->where('hotel_id', Auth()->user()->id)->orderBy('created_at', 'desc');
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.hotel_services', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'short_description' => $this->view['short_description'],
            'base_price' => $this->view['base_price'],
            'promo_price' => $this->view['promo_price'],
            'status' => $this->view['status'],

        ];
    }

    protected function setCustomAddColumns(): void
    {
        $this->customAddColumns = [
            'action' => $this->view['action'],
            'name' => $this->view['name'],
            'default_unit' => $this->view['default_unit'],
        ];
    }

    protected function setCustomRawColumns(): void
    {
        $this->customRawColumns = ['action', 'short_description', 'base_price', 'promo_price', 'status', 'name', 'default_unit'];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            'name' => function ($query, $keyword) {
                $query->whereHas('service', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            },
            'default_unit' => function ($query, $keyword) {
                $query->whereHas('service', function ($q) use ($keyword) {
                    $q->where('default_unit', 'like', '%' . $keyword . '%');
                });
            },
        ];
    }
}
