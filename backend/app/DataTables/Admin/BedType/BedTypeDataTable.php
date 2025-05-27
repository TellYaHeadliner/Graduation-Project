<?php

namespace App\DataTables\Admin\BedType;

use App\DataTables\BaseDataTable;
use App\Traits\GetConfig;
use App\Enums\FeaturedStatus;
use App\Models\BedType;

class BedTypeDataTable extends BaseDataTable
{

    use GetConfig;
    protected $nameTable = 'bedTypeTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct()
    {
        parent::__construct();

        $this->repository = BedType::class;
    }

    public function setView(): void
    {
        $this->view = [
            'name' => 'admin.bed_types.datatable.name',
            'action' => 'admin.bed_types.datatable.action',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0];
    }

    public function query()
    {
        return $this->repository::orderBy('created_at', 'desc');
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.bed_types', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'name' => $this->view['name'],
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
        $this->customRawColumns = ['name', 'action'];
    }

    public function setCustomFilterColumns(): void
    {

    }
}
