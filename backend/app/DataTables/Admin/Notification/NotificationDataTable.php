<?php

namespace App\DataTables\Admin\Notification;

use App\DataTables\BaseDataTable;
use App\Enums\Notification\NotificationStatus;
use App\Models\Notification;
use App\Models\NotificationUser;
use App\Traits\GetConfig;
use Illuminate\Support\Facades\DB;

class NotificationDataTable extends BaseDataTable
{

    use GetConfig;
    protected $nameTable = 'notificationTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct()
    {
        parent::__construct();

        $this->repository = Notification::class;
    }

    public function setView(): void
    {
        $this->view = [
            'title' => 'admin.notification.datatable.title',
            'user_name' => 'admin.notification.datatable.user_name',
            'is_read' => 'admin.notification.datatable.is_read',
            'action' => 'admin.notification.datatable.action',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2];

        $this->columnSearchDate = [2];

    }
 
    public function query()
    {
        return NotificationUser::with(['user','notification'])->orderBy('created_at','desc');
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.notifications', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'title' => $this->view['title'],
            'sent_at' => '{{ date("d-m-Y", strtotime($notification[\'sent_at\'])) }}',
            'read_at' => '{{ $read_at ? date("d-m-Y", strtotime($read_at)) : \'Chưa đọc\' }}',
            'user_name' => $this->view['user_name'],
            'is_read' => $this->view['is_read'],
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
        $this->customRawColumns = ['action', 'title', 'sent_at', 'read_at', 'user_name', 'is_read'];
    }

    public function setCustomFilterColumns(): void
    {
        $this->customFilterColumns = [
            'user_name' => function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('fullname', 'like', '%' . $keyword . '%');
                });
            },
            'sent_at' => function ($query, $keyword) {
                $query->whereHas('notification', function ($q) use ($keyword) {
                    $q->where('sent_at',$keyword);
                });
            },
        ];
    }
}
