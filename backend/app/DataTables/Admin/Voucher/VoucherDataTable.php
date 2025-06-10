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
            'hotel_id' => 'admin.voucher.datatable.hotel_id',
            'discount_type' => 'admin.voucher.datatable.discount_type',
            'discount_value' => 'admin.voucher.datatable.discount_value',
            'min_order_value' => 'admin.voucher.datatable.min_order_value',
            'max_discount_value' => 'admin.voucher.datatable.max_discount_value',
            'is_active' => 'admin.voucher.datatable.is_active',
            'action' => 'admin.voucher.datatable.action',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2, 3, 4, 5, 6, 7, 8];

        $this->columnSearchDate = [6, 7];

        $this->columnSearchSelect = [
            [
                'column' => 2,
                'data' => VoucherDiscountType::asSelectArray(),
            ],
            [
                'column' => 8,
                'data' => VoucherStatus::asSelectArray(),
            ],
        ];
    }

    public function query()
    {
        return $this->repository::with('hotel')->orderBy('created_at', 'desc');
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.vouchers', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'code' => $this->view['code'],
            'hotel_id' => $this->view['hotel_id'],
            'discount_type' => $this->view['discount_type'],
            'discount_value' => $this->view['discount_value'],
            'min_order_value' => $this->view['min_order_value'],
            'max_discount_value' => $this->view['max_discount_value'],
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
        $this->customRawColumns = ['action', 'code', 'hotel_id', 'discount_type', 'discount_value', 'min_order_value', 'max_discount_value', 'is_active'];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            'hotel_id' => function ($query, $keyword) {
                $query->whereHas('hotel', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            },
        ];
    }
}
