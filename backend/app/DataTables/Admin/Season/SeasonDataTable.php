<?php

namespace App\DataTables\Admin\Season;

use App\DataTables\BaseDataTable;
use App\Traits\GetConfig;
use App\Enums\FeaturedStatus;
use App\Enums\Season\SeasonStatus;
use App\Models\Season;

class SeasonDataTable extends BaseDataTable
{

    use GetConfig;
    protected $nameTable = 'seasonTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct()
    {
        parent::__construct();

        $this->repository = Season::class;
    }

    public function setView(): void
    {
        $this->view = [
            'name' => 'admin.season.datatable.name',
            'status' => 'admin.season.datatable.status',
            'action' => 'admin.season.datatable.action',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2, 3];

        $this->columnSearchDate = [1, 2];

        $this->columnSearchSelect = [
            [
                'column' => 3,
                'data' => SeasonStatus::asSelectArray()
            ]
        ];
    }

    public function query()
    {
        return $this->repository::orderBy('created_at', 'desc');
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.seasons', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'name' => $this->view['name'],
            'start_date' => '{{ date("d-m-Y", strtotime($start_date)) }}',
            'end_date' => '{{ date("d-m-Y", strtotime($end_date)) }}',
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
        $this->customRawColumns = ['name', 'start_date', 'end_date', 'status', 'action'];
    }

    public function setCustomFilterColumns(): void {}
}
