<?php

namespace App\DataTables\Hotel\Combo;

use App\DataTables\BaseDataTable;
use App\Enums\Combo\ComboStatus;
use App\Models\Combo;
use App\Traits\GetConfig;
use Illuminate\Support\Facades\DB;

class ComboDataTable extends BaseDataTable
{

    use GetConfig;
    protected $nameTable = 'comboTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct()
    {
        parent::__construct();

        $this->repository = Combo::class;
    }

    public function setView(): void
    {
        $this->view = [
            'name' => 'hotel.combos.datatable.name',
            'short_description' => 'hotel.combos.datatable.short_description',
            'combo_price' => 'hotel.combos.datatable.combo_price',
            'original_price' => 'hotel.combos.datatable.original_price',
            'combo_services' => 'hotel.combos.datatable.combo_services',
            'status' => 'hotel.combos.datatable.status',
            'action' => 'hotel.combos.datatable.action',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2, 3, 5];

        $this->columnSearchSelect = [
            [
                'column' => 5,
                'data' => ComboStatus::asSelectArray()
            ],
        ];
    }

    public function query()
    {
        return Combo::where('hotel_id', Auth()->user()->id)->orderBy('created_at', 'desc');
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.combos', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'short_description' => $this->view['short_description'],
            'combo_price' => $this->view['combo_price'],
            'original_price' => $this->view['original_price'],
            'name' => $this->view['name'],
            'status' => $this->view['status'],

        ];
    }

    protected function setCustomAddColumns(): void
    {
        $this->customAddColumns = [
            'action' => $this->view['action'],
            'combo_services' => $this->view['combo_services'],
        ];
    }

    protected function setCustomRawColumns(): void
    {
        $this->customRawColumns = ['action', 'short_description', 'combo_price', 'original_price', 'status', 'name', 'combo_services'];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
        ];
    }
}
