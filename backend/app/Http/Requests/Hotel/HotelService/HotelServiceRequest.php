<?php

namespace App\Http\Requests\Hotel\HotelService;

use App\Enums\HotelService\HotelServiceStatus;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

class HotelServiceRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    protected function methodPost()
    {
        return [
            'service_id' => ['required', 'exists:App\Models\Service,id'],
            'short_description' => ['nullable', 'string'],
            'base_price' => ['required', 'numeric', 'min:0'],
            'promo_price' => ['nullable', 'numeric', 'min:0','lte:base_price'],
            'status' => ['nullable'],
        ];
    }
    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\HotelService,id'],
            'service_id' => ['required', 'exists:App\Models\Service,id'],
            'short_description' => ['nullable', 'string'],
            'base_price' => ['required', 'numeric', 'min:0'],
            'promo_price' => ['nullable', 'numeric', 'min:0','lte:base_price'],
            'status' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [];
    }
}
