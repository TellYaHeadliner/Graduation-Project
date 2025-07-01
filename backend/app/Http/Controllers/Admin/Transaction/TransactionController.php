<?php

namespace App\Http\Controllers\Admin\Transaction;

use App\DataTables\Admin\Transaction\TransactionDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $data;

    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return [
            'index' => 'admin.transaction.index',
        ];
    }
    public function getRoute(): array
    {
        return [
            'index' => 'admin.transaction.index',
        ];
    }
    public function index(TransactionDataTable $dataTable)
    {
        return $dataTable->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách giao dịch'))
        ]);
    }
}
