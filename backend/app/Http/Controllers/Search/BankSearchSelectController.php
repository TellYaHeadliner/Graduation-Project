<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\BaseSearchSelectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BankSearchSelectController extends BaseSearchSelectController
{

    protected function data()
    {
        $term = $this->request->input('term', '');

        $response = Http::get('https://api.vietqr.io/v2/banks');
        $data = $response->json();


        $banks = collect($data['data'] ?? [])
            ->filter(function ($item) use ($term) {
                return !$term || str_contains(strtolower($item['name']), strtolower($term)) || str_contains(strtolower($item['short_name']), strtolower($term));
            })
            ->take(10)
            ->map(function ($item) {
                return [
                    'id' => $item['short_name'],
                    'text' =>"<img src=\"{$item['logo']}\" style=\"width: 60px; height: 60px; object-fit: contain; margin-right: 10px;\">
                              <span>{$item['name']} ({$item['short_name']})</span>",
                ];
            })
            ->values();

        $this->instance = $banks;
    }

    protected function selectResponse(): void
    {
        $this->instance = [
            'results' => $this->instance->map(function ($item) {
                return [
                    'id' => $item['id'],
                    'text' => $item['text'],
                ];
            }),
        ];
    }
}
