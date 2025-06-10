<?php

namespace App\Http\Controllers\Admin\Voucher;

use App\DataTables\Admin\Voucher\VoucherDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
        private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView(): array
    {
        return [
            'index' => 'admin.voucher.index',
            'create' => 'admin.voucher.create',
            'edit' => 'admin.voucher.edit'
        ];
    }

    public function getRoute(): array
    {
        return [
            'index' => 'admin.voucher.index',
            'create' => 'admin.voucher.create',
            'edit' => 'admin.voucher.edit',
            'delete' => 'admin.voucher.delete'
        ];
    }

    public function index(VoucherDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách Voucher'))
        ]);
    }
}
