<?php

namespace App\DataTables\Admin\Transaction;

use App\DataTables\BaseDataTable;
use App\Enums\Transaction\TransactionStatus;
use App\Enums\Transaction\TransactionType;
use App\Models\Transaction;
use App\Traits\GetConfig;


class TransactionDataTable extends BaseDataTable
{

    use GetConfig;
    protected $nameTable = 'transactionAdminTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct()
    {
        parent::__construct();

        $this->repository = Transaction::class;
    }

    public function setView(): void
    {
        $this->view = [
            'booking_id' => 'admin.transaction.datatable.booking_id',
            'hotel_id' => 'admin.transaction.datatable.hotel_id',
            'user_id' => 'admin.transaction.datatable.user_id',
            'transaction_type' => 'admin.transaction.datatable.transaction_type',
            'transaction_code' => 'admin.transaction.datatable.transaction_code',
            'amount' => 'admin.transaction.datatable.amount',
            'payment_status' => 'admin.transaction.datatable.payment_status',
            'paid_at' => 'admin.transaction.datatable.paid_at',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2, 3, 4, 5, 6];

        $this->columnSearchDate = [7];

        $this->columnSearchSelect = [
            [
                'column' => 3,
                'data' => TransactionType::asSelectArray(),
            ],
            [
                'column' => 6,
                'data' => TransactionStatus::asSelectArray(),
            ],
        ];
    }

    public function query()
    {
        return $this->repository::with(['booking', 'hotel', 'user'])->orderBy('paid_at', 'desc');
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.transaction_admin', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'booking_id' => $this->view['booking_id'],
            'hotel_id' => $this->view['hotel_id'],
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
        $this->customRawColumns = ['booking_id', 'user_id', 'hotel_id', 'transaction_type', 'transaction_code', 'amount', 'payment_status', 'paid_at'];
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
            'hotel_id' => function ($query, $keyword) {
                $query->whereHas('hotel', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            },
        ];
    }
}
