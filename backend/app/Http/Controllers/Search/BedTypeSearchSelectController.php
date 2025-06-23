<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\BaseSearchSelectController;
use App\Http\Controllers\Controller;
use App\Models\BedType;
use Illuminate\Http\Request;

class BedTypeSearchSelectController extends BaseSearchSelectController
{
    public function __construct()
    {
        $this->repository = BedType::class;
    }

    protected function data()
    {
        $term = $this->request->input('term', '');

        $query = $this->repository::query();

        if (!empty($term)) {
            $query->where('name', 'LIKE', '%' . $term . '%');
        }

        $this->instance = $query->get();
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
