<?php

namespace App\DataTables\Admin\Amenity;

use App\DataTables\BaseDataTable;
use App\Traits\GetConfig;
use App\Enums\FeaturedStatus;
use App\Models\Amenity;

class AmenityDataTable extends BaseDataTable
{

    use GetConfig;
    protected $nameTable = 'amenityTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct()
    {
        parent::__construct();

        $this->repository = Amenity::class;
    }

    public function setView(): void
    {
        $this->view = [
            'name' => 'admin.amenity.datatable.name',
            'parent_id' => 'admin.amenity.datatable.parent_id',
            'action' => 'admin.amenity.datatable.action',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1];
    }

    public function query()
    {
        return $this->repository::with('parent')->orderBy('created_at', 'desc');
    }


    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.amenities', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'name' => $this->view['name'],
            'parent_id' => $this->view['parent_id'],
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
        $this->customRawColumns = ['name', 'parent_id', 'action'];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            'parent_id' => function ($query, $keyword) {
                    $query->whereHas('parent', function ($q) use ($keyword) {
                        $q->where('name', 'like', '%' . $keyword . '%');
                    });
            },
        ];
    }
}
