<?php

namespace App\DataTables\Admin\Booking;

use App\DataTables\BaseDataTable;
use App\Enums\Booking\BookingStatus;
use App\Models\Booking;
use App\Traits\GetConfig;

class BookingDataTable extends BaseDataTable
{
    use GetConfig;

    protected $nameTable = 'bookingAdminTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct()
    {
        parent::__construct();
        $this->repository = Booking::class;
    }

    public function setView(): void
    {
        $this->view = [
            'hotel_id' => 'admin.booking.datatable.hotel_id',
            'customer_id' => 'admin.booking.datatable.customer_id',
            'booking_code' => 'admin.booking.datatable.booking_code',
            'total_amount' => 'admin.booking.datatable.total_amount',
            'checkin_date' => 'admin.booking.datatable.checkin_date',
            'checkout_date' => 'admin.booking.datatable.checkout_date',
            'cancellation_fee' => 'admin.booking.datatable.cancellation_fee',
            'status' => 'admin.booking.datatable.status',
            'action' => 'admin.booking.datatable.action',
        ];
    }

    public function setColumnSearch(): void
    {
        $this->columnAllSearch = [0, 1, 2, 3, 4, 5];

        $this->columnSearchDate = [4, 5]; 

        $this->columnSearchSelect = [
            [
                'column' => 7,
                'data' => BookingStatus::asSelectArray(),
            ],
        ];
    }

    public function query()
    {
        return $this->repository::with(['hotel', 'user'])
            ->orderBy('created_at', 'desc');
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.booking_admin', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'hotel_id' => $this->view['hotel_id'],
            'customer_id' => $this->view['customer_id'],
            'booking_code' => $this->view['booking_code'],
            'total_amount' => $this->view['total_amount'],
            'checkin_date' => '{{ date("d-m-Y H:i", strtotime($checkin_date)) }}',
            'checkout_date' => '{{ date("d-m-Y H:i", strtotime($checkout_date)) }}',
            'cancellation_fee' => '{{ number_format($cancellation_fee) . " đ" }}',
            'status' => $this->view['status'],
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
        $this->customRawColumns = [
            'hotel_id',
            'customer_id',
            'booking_code',
            'total_amount',
            'checkin_date',
            'checkout_date',
            'cancellation_fee',
            'status',
            'action'
        ];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            'customer_id' => function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('fullname', 'like', '%' . $keyword . '%');
                });
            },
            'booking_code' => function ($query, $keyword) {
                $query->where('booking_code', 'like', '%' . $keyword . '%');
            },
            'hotel_id' => function ($query, $keyword) {
                $query->whereHas('hotel', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            },
        ];
    }
}
