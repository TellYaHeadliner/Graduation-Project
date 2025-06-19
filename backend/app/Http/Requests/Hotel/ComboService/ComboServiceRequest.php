<?php

namespace App\Http\Requests\Hotel\ComboService;

use App\Http\Requests\BaseRequest;

class ComboServiceRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    protected function methodPost()
    {
        return [
            'hotel_service_id' => ['required', 'exists:App\Models\HotelService,id'],
            'quantity' => ['required', 'numeric', 'min:1'],
        ];
    }
    protected function methodPut()
    {
        return [
            'hotel_service_id' => ['nullable', 'exists:App\Models\HotelService,id'],
            'combo_id' => ['required', 'exists:App\Models\Combo,id'],
            'quantity' => ['required', 'numeric', 'min:1'],
        ];
    }
}
