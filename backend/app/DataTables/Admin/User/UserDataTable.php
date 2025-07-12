<?php

namespace App\DataTables\Admin\User;

use App\DataTables\BaseDataTable;
use App\Enums\User\UserGender;
use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use App\Models\User;
use App\Traits\GetConfig;


class UserDataTable extends BaseDataTable
{

    use GetConfig;
    protected $nameTable = 'userTable';
    protected array $actions = ['reset', 'reload'];

    public function __construct()
    {
        parent::__construct();

        $this->repository = User::class;
    }

    public function setView(): void
    {
        $this->view = [
            'fullname' => 'admin.user.datatable.fullname',
            'email' => 'admin.user.datatable.email',
            'phone' => 'admin.user.datatable.phone',
            'gender' => 'admin.user.datatable.gender',
            'address' => 'admin.user.datatable.address',
            'avatar' => 'admin.user.datatable.avatar',
            'role' => 'admin.user.datatable.role',
            'email_verified_at' => 'admin.user.datatable.email_verified_at',
            'status' => 'admin.user.datatable.status',
            'action' => 'admin.user.datatable.action',
        ];
    }

    public function setColumnSearch(): void
    {

        $this->columnAllSearch = [0, 1, 2, 3, 4, 5, 7, 9];

        $this->columnSearchDate = [3];

        $this->columnSearchSelect = [
            [
                'column' => 7,
                'data' => UserRole::asSelectArray()
            ],
            [
                'column' => 9,
                'data' => UserStatus::asSelectArray()
            ],
            [
                'column' => 4,
                'data' => UserGender::asSelectArray()
            ],
        ];
    }

    public function query()
    {
        return $this->repository::orderBy('created_at', 'desc');
    }

    protected function setCustomColumns(): void
    {
        $this->customColumns = config('datatables_columns.users', []);
    }

    protected function setCustomEditColumns(): void
    {
        $this->customEditColumns = [
            'fullname' => $this->view['fullname'],
            'email' => $this->view['email'],
            'phone' => $this->view['phone'],
            'gender' => $this->view['gender'],
            'address' => $this->view['address'],
            'avatar' => $this->view['avatar'],
            'role' => $this->view['role'],
            'status' => $this->view['status'],
            'email_verified_at' => $this->view['email_verified_at'],
            'birthday' => '{{ date("d-m-Y", strtotime($birthday)) }}',
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
        $this->customRawColumns = ['action', 'email_verified_at', 'fullname', 'email', 'phone', 'gender', 'address', 'avatar', 'role', 'status'];
    }

    public function setCustomFilterColumns(): void {}
}
