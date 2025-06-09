<?php

namespace App\Http\Controllers\Search;

use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use App\Http\Controllers\BaseSearchSelectController;
use App\Models\User;
use Illuminate\Http\Request;

class UserSearchSelectController extends BaseSearchSelectController
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

        $query->where('status', '=', UserStatus::Active->value);

        $this->instance = $query->limit(10)->get();
    }

    protected function selectResponse(): void
    {
        $this->instance = [
            'results' => $this->instance->map(function ($item) {
                return [
                    'id' => $item['id'],
                    'text' => $item['fullname'] . '| ' . UserRole::getDescription($item['role']->value) .
                                '|'. $item['phone'] . '|' . $item['email'],
                ];
            }),
        ];
    }
}
