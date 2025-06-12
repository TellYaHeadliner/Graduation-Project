<?php

namespace App\DataTables\Admin\Service;

use App\DataTables\BaseDataTable;
use App\Enums\Service\ServiceStatus;
use App\Models\Service;
use App\Traits\GetConfig;


class ServiceDataTable extends BaseDataTable
{

    use GetConfig;
    protected $nameTable = 'serviceTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct()
    {
        parent::__construct();
        $this->repository = Service::class;
    }

    public function setView(): void
    {
        $this->view = [
            'name' => 'admin.service.datatable.name',
            'default_unit' => 'admin.service.datatable.default_unit',
            'status' => 'admin.service.datatable.status',
            'action' => 'admin.service.datatable.action',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2];

        $this->columnSearchSelect = [
            [
                'column' => 2,
                'data' => ServiceStatus::asSelectArray()
            ],
        ];
    }

    public function query()
    {
        return $this->repository::orderBy('created_at', 'desc');
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.services', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'name' => $this->view['name'],
            'default_unit' => $this->view['default_unit'],
            'status' => $this->view['status'],
        ];
    }

    protected function setCustomAddColumns(): void
    {
        $this->customAddColumns = [
            'action' => $this->view['action'],
        ];
    }

    protected function setCustomRawColumns(): void
    {
        $this->customRawColumns = ['action', 'name', 'default_unit', 'status'];
    }

    public function setCustomFilterColumns(): void {}
}
