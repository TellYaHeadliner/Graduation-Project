<?php

namespace App\Http\Controllers\Admin\User;

use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use App\Http\Controllers\BaseSearchSelectController;
use App\Models\User;
use Illuminate\Http\Request;

class UserCustomerSearchSelectController extends BaseSearchSelectController
{
    public function __construct()
    {
        $this->repository = User::class;
    }

    protected function data()
    {
        $term = $this->request->input('term', '');

        $query = $this->repository::query();

        if (!empty($term)) {
            $query->where('fullname', 'LIKE', '%' . $term . '%');
        }

        $query->where('role','=',UserRole::Customer->value)
              ->where('status','=',UserStatus::Active->value);

        $this->instance = $query->limit(10)->get(['id', 'fullname']);
    }

    protected function selectResponse(): void
    {
        $this->instance = [
            'results' => $this->instance->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->fullname.' | Khách hàng',
                ];
            }),
        ];
    }
}
