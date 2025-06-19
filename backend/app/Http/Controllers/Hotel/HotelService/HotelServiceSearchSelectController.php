<?php

namespace App\Http\Controllers\Hotel\HotelService;

use App\Enums\HotelService\HotelServiceStatus;
use App\Http\Controllers\BaseSearchSelectController;
use App\Models\HotelService;
use Illuminate\Http\Request;

class HotelServiceSearchSelectController extends BaseSearchSelectController
{
    public function __construct()
    {
        $this->repository = HotelService::class;
    }

    protected function data()
    {
        $term = $this->request->input('term', '');

        $query = $this->repository::query();
        $query->with(['service']);
        if (!empty($term)) {
            $query->where('name', 'LIKE', '%' . $term . '%');
        }
        $query->where('status', HotelServiceStatus::Active->value);
        $query->where('hotel_id', Auth()->user()->id);
        

        $this->instance = $query->get();
    }

    protected function selectResponse(): void
    {
        $this->instance = [
            'results' => $this->instance->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->service->name . ' | Giá: ' . format_price($item->base_price) . '/' . $item->service->default_unit,
                ];
            }),
        ];
    }
}
