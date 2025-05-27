<?php

namespace App\Http\Controllers\Admin\Amenity;

use App\Http\Controllers\BaseSearchSelectController;
use App\Models\Amenity;
use Illuminate\Http\Request;

class AmenitySearchSelectController extends BaseSearchSelectController
{
    public function __construct()
    {
        $this->repository = Amenity::class;
    }

    protected function data()
    {
        $term = $this->request->input('term', '');

        $query = $this->repository::query();

        if (!empty($term)) {
            $query->where('name', 'LIKE', '%' . $term . '%');
        }

        $query->whereNull('parent_id');

        $this->instance = $query->limit(10)->get(['id', 'name']);
    }

    protected function selectResponse(): void
    {
        $this->instance = [
            'results' => $this->instance->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name,
                ];
            }),
        ];
    }
}
