<?php

namespace App\Http\Controllers\Hotel\Transaction;

use App\DataTables\Hotel\Transaction\TransactionDataTable;
use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getView()
    {
        return [
            'index' => 'hotel.transaction.index',
        ];
    }
    public function getRoute(): array
    {
        return [
            'index' => 'hotel.transaction.index',
        ];
    }
    public function index($hotel_id,TransactionDataTable $dataTable)
    {
        $hotel = Hotel::find($hotel_id);
        return $dataTable->with('hotel',$hotel)->render($this->view['index'], [
            'breadcrumbs' => $this->crums->add(__('Danh sách giao dịch'))
        ]);
    }
}
