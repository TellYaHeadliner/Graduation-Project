<?php

namespace App\DataTables\Hotel\RoomTypeVariant;

use App\DataTables\BaseDataTable;
use App\Enums\RoomTypeVariant\RoomTypeVariantStatus;
use App\Models\RoomTypeVariant;
use App\Traits\GetConfig;
use Illuminate\Support\Facades\DB;

class RoomTypeVariantDataTable extends BaseDataTable
{

    use GetConfig;
    protected $nameTable = 'roomTypeVariantTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct()
    {
        parent::__construct();

        $this->repository = RoomTypeVariant::class;
    }

    public function setView(): void
    {
        $this->view = [
            'name' => 'hotel.room_types.room_type_variants.datatable.name',
            'base_price' => 'hotel.room_types.room_type_variants.datatable.base_price',
            'discount_price' => 'hotel.room_types.room_type_variants.datatable.discount_price',
            'attributes' => 'hotel.room_types.room_type_variants.datatable.attributes',
            'status' => 'hotel.room_types.room_type_variants.datatable.status',
            'action' => 'hotel.room_types.room_type_variants.datatable.action',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2, 4];

        $this->columnSearchSelect = [
            [
                'column' => 4,
                'data' => RoomTypeVariantStatus::asSelectArray()
            ],
        ];
    }

    public function query()
    {
        return $this->repository::with(['roomType','attributes'])->where('room_type_id', $this->room_type_id)->orderBy('created_at', 'desc');
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.room-type-variants', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'name' => $this->view['name'],
            'base_price' => $this->view['base_price'],
            'discount_price' => $this->view['discount_price'],
            'status' => $this->view['status'],
        ];
    }

    protected function setCustomAddColumns(): void
    {
        $this->customAddColumns = [
            'action' => $this->view['action'],
            'attributes' => $this->view['attributes'],
        ];
    }

    protected function setCustomRawColumns(): void
    {
        $this->customRawColumns = ['action', 'name', 'base_price', 'discount_price', 'status','attributes'];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [];
    }
}
