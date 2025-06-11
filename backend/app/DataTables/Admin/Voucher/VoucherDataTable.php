<?php

namespace App\DataTables\Admin\Voucher;

use App\DataTables\BaseDataTable;
use App\Enums\Voucher\VoucherDiscountType;
use App\Enums\Voucher\VoucherStatus;
use App\Models\Voucher;
use App\Traits\GetConfig;


class VoucherDataTable extends BaseDataTable
{

    use GetConfig;
    protected $nameTable = 'voucherTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct()
    {
        parent::__construct();

        $this->repository = Voucher::class;
    }

    public function setView(): void
    {
        $this->view = [
            'code' => 'admin.voucher.datatable.code',
            'hotel_scope' => 'admin.voucher.datatable.hotel_scope',
            'customer_scope' => 'admin.voucher.datatable.customer_scope',
            'discount_type' => 'admin.voucher.datatable.discount_type',
            'discount_value' => 'admin.voucher.datatable.discount_value',
            'is_active' => 'admin.voucher.datatable.is_active',
            'action' => 'admin.voucher.datatable.action',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 3, 4, 5, 6, 7];

        $this->columnSearchDate = [5, 6];

        $this->columnSearchSelect = [
            [
                'column' => 3,
                'data' => VoucherDiscountType::asSelectArray(),
            ],
            [
                'column' => 7,
                'data' => VoucherStatus::asSelectArray(),
            ],
        ];
    }

    public function query()
    {
        return $this->repository::orderBy('created_at', 'desc');
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.vouchers', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'code' => $this->view['code'],
            'hotel_scope' => $this->view['hotel_scope'],
            'customer_scope' => $this->view['customer_scope'],
            'discount_type' => $this->view['discount_type'],
            'discount_value' => $this->view['discount_value'],
            'is_active' => $this->view['is_active'],
            'start_date' => '{{ date("d-m-Y", strtotime($start_date)) }}',
            'end_date' => '{{ date("d-m-Y", strtotime($end_date)) }}',
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
        $this->customRawColumns = ['action', 'code', 'hotel_scope', 'discount_type', 'discount_value', 'is_active' ,'customer_scope'];
    }

    public function setCustomFilterColumns(): void{}
}
