<?php

namespace App\DataTables\Hotel\Transaction;

use App\DataTables\BaseDataTable;
use App\Enums\Transaction\TransactionStatus;
use App\Enums\Transaction\TransactionType;
use App\Models\Transaction;
use App\Traits\GetConfig;


class TransactionDataTable extends BaseDataTable
{

    use GetConfig;
    protected $nameTable = 'transactionHotelTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct()
    {
        parent::__construct();

        $this->repository = Transaction::class;
    }

    public function setView(): void
    {
        $this->view = [
            'booking_id' => 'hotel.transaction.datatable.booking_id',
            'user_id' => 'hotel.transaction.datatable.user_id',
            'transaction_type' => 'hotel.transaction.datatable.transaction_type',
            'transaction_code' => 'hotel.transaction.datatable.transaction_code',
            'amount' => 'hotel.transaction.datatable.amount',
            'payment_status' => 'hotel.transaction.datatable.payment_status',
            'paid_at' => 'hotel.transaction.datatable.paid_at',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2, 3, 4, 5];

        $this->columnSearchDate = [6];

        $this->columnSearchSelect = [
            [
                'column' => 2,
                'data' => TransactionType::asSelectArray(),
            ],
            [
                'column' => 5,
                'data' => TransactionStatus::asSelectArray(),
            ],
        ];
    }

    public function query()
    {
        return $this->repository::with(['booking', 'hotel', 'user'])->where('hotel_id',$this->hotel->id)->orderBy('paid_at', 'desc');
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.transaction_hotel', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'booking_id' => $this->view['booking_id'],
            'user_id' => $this->view['user_id'],
            'transaction_type' => $this->view['transaction_type'],
            'transaction_code' => $this->view['transaction_code'],
            'amount' => $this->view['amount'],
            'payment_status' => $this->view['payment_status'],
            'paid_at' => '{{ date("d-m-Y H:i:s", strtotime($paid_at)) }}',
        ];
    }

    protected function setCustomAddColumns(): void
    {
        $this->customAddColumns = [];
    }

    protected function setCustomRawColumns(): void
    {
        $this->customRawColumns = ['booking_id', 'user_id', 'transaction_type', 'transaction_code', 'amount', 'payment_status', 'paid_at'];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            'user_id' => function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('fullname', 'like', '%' . $keyword . '%');
                });
            },
            'booking_id' => function ($query, $keyword) {
                $query->whereHas('booking', function ($q) use ($keyword) {
                    $q->where('booking_code', 'like', '%' . $keyword . '%');
                });
            },
        ];
    }
}
