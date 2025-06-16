<?php

namespace App\Http\Requests\Hotel\Amenity;

use App\Http\Requests\BaseRequest;

class AmenityRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Hotel,id'],
            'amenities' => ['nullable', 'array'],
            'amenities.*' => ['integer', 'exists:App\Models\Amenity,id']
        ];
    }
}
