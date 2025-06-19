<?php

namespace App\DataTables\Hotel\Combo;

use App\DataTables\BaseDataTable;
use App\Enums\Combo\ComboStatus;
use App\Models\Combo;
use App\Models\ComboService;
use App\Traits\GetConfig;
use Illuminate\Support\Facades\DB;

class ComboServiceDataTable extends BaseDataTable
{

    use GetConfig;
    protected $nameTable = 'comboServiceTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct()
    {
        parent::__construct();

        $this->repository = ComboService::class;
    }

    public function setView(): void
    {
        $this->view = [
            'name' => 'hotel.combos.combo_services.datatable.name',
            'default_unit' => 'hotel.combos.combo_services.datatable.default_unit',
            'base_price' => 'hotel.combos.combo_services.datatable.base_price',
            'quantity' => 'hotel.combos.combo_services.datatable.quantity',
            'action' => 'hotel.combos.combo_services.datatable.action',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2, 3];
    }

    public function query()
    {
        // return ComboService::with(['hotelService','combo','service'])->where('combo_id', $this->combo->id)->orderBy('created_at', 'desc');
        return ComboService::with(['combo', 'service'])
            ->join('hotel_services', 'combo_services.hotel_service_id', '=', 'hotel_services.id')
            ->where('combo_services.combo_id', $this->combo->id)
            ->orderBy('combo_services.created_at', 'desc')
            ->select([
                'combo_services.*',
                'hotel_services.base_price',
            ]);
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.combo_services', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'quantity' => $this->view['quantity'],
        ];
    }

    protected function setCustomAddColumns(): void
    {
        $this->customAddColumns = [
            'action' => $this->view['action'],
            'name' => $this->view['name'],
            'base_price' => $this->view['base_price'],
            'default_unit' => $this->view['default_unit'],
        ];
    }

    protected function setCustomRawColumns(): void
    {
        $this->customRawColumns = ['action', 'name', 'base_price', 'default_unit', 'quantity'];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [];
    }
}
