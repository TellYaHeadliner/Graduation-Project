<?php

namespace App\Http\Controllers\Search;

use App\Enums\Service\ServiceStatus;
use App\Http\Controllers\BaseSearchSelectController;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceSearchSelectController extends BaseSearchSelectController
{
        public function __construct()
    {
        $this->repository = Service::class;
    }

    protected function data()
    {
        $term = $this->request->input('term', '');

        $query = $this->repository::query();

        if (!empty($term)) {
            $query->where('name', 'LIKE', '%' . $term . '%');
        }

        $query->where('status',ServiceStatus::Active->value);

        $this->instance = $query->get();
    }

    protected function selectResponse(): void
    {
        $this->instance = [
            'results' => $this->instance->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name.'/ '.$item->default_unit,
                ];
            }),
        ];
    }
}
