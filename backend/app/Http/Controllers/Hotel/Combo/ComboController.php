<?php

namespace App\Http\Controllers\Hotel\Combo;

use App\DataTables\Hotel\Combo\ComboDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComboController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return [
            'index' => 'hotel.Combos.index',
            'create' => 'hotel.Combos.create',
            'edit' => 'hotel.Combos.edit'
        ];
    }
    public function getRoute(): array
    {
        return [
            'index' => 'hotel.combo.index',
            'create' => 'hotel.combo.create',
            'edit' => 'hotel.combo.edit',
            'delete' => 'hotel.combo.delete'
        ];
    }
    public function index(ComboDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách combo'))
        ]);
    }
}
