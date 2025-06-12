<?php

namespace App\DataTables\Admin\Attribute;

use App\DataTables\BaseDataTable;
use App\Traits\GetConfig;
use App\Enums\FeaturedStatus;
use App\Models\Attribute;

class AttributeDataTable extends BaseDataTable
{

    use GetConfig;
    protected $nameTable = 'attributeTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct()
    {
        parent::__construct();

        $this->repository = Attribute::class;
    }

    public function setView(): void
    {
        $this->view = [
            'name' => 'admin.attribute.datatable.name',
            'type' => 'admin.attribute.datatable.type',
            'is_active' => 'admin.attribute.datatable.is_active',
            'action' => 'admin.attribute.datatable.action',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1];
    }

    public function query()
    {
        return $this->repository::orderBy('created_at', 'desc');
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.attributes', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'name' => $this->view['name'],
            'type' => $this->view['type'],
            'is_active' => $this->view['is_active'],
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
        $this->customRawColumns = ['name', 'type', 'is_active', 'action'];
    }

    public function setCustomFilterColumns(): void
    {

    }
}
