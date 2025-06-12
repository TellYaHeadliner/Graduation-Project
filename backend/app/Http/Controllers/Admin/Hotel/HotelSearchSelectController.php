<?php

namespace App\Http\Controllers\Admin\Hotel;

use App\Enums\Hotel\HotelStatus;
use App\Http\Controllers\BaseSearchSelectController;
use App\Http\Controllers\Controller;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelSearchSelectController extends BaseSearchSelectController
{
    public function __construct()
    {
        $this->repository = Hotel::class;
    }

    protected function data()
    {
        $term = $this->request->input('term', '');

        $query = $this->repository::query();

        if (!empty($term)) {
            $query->where('name', 'LIKE', '%' . $term . '%');
        }

        $query->where('status','=',HotelStatus::Active->value);

        $this->instance = $query->limit(10)->get(['id', 'name' , 'email']);
    }

    protected function selectResponse(): void
    {
        $this->instance = [
            'results' => $this->instance->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name.' | ' . $item->email,
                ];
            }),
        ];
    }
}
