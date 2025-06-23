<?php

namespace App\Http\Controllers\Search;

use App\Enums\Season\SeasonStatus;
use App\Http\Controllers\BaseSearchSelectController;
use App\Http\Controllers\Controller;
use App\Models\Season;
use Illuminate\Http\Request;

class SeasonSearchSelectController extends BaseSearchSelectController
{
    public function __construct()
    {
        $this->repository = Season::class;
    }

    protected function data()
    {
        $term = $this->request->input('term', '');

        $query = $this->repository::query();

        if (!empty($term)) {
            $query->where('name', 'LIKE', '%' . $term . '%');
        }
        $query->where('status', '=', SeasonStatus::Active->value);
        $query->where('start_date', '<=', now());
        $query->where('end_date', '>=', now());

        $this->instance = $query->get();
    }

    protected function selectResponse(): void
    {
        $this->instance = [
            'results' => $this->instance->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name . "( " . format_date($item->start_date,'d-m-Y') . ' - ' . format_date($item->end_date,'d-m-Y')." )",
                ];
            }),
        ];
    }
}
