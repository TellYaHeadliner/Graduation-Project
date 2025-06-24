<?php

namespace App\Http\Requests\API\Hotel;

use App\Enums\Hotel\HotelStatus;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

class HotelRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    protected function methodPost()
    {
        return [
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'star_rating' => ['nullable', 'integer', 'between:1,5'],
            'email' => ['required', 'email', 'unique:App\Models\Hotel,email'],
            'phone' => [
                'required',
                'regex:/((09|03|07|08|05)+([0-9]{8})\b)/',
            ],
            'mst' => ['required', 'min:10', 'max:13', 'unique:App\Models\Hotel,mst'],
            'bank_account_number' => ['required', 'numeric'],
            'bank_account_name' => ['required', 'string'],
            'bank_name' => ['required', 'string'],
            'avatar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'gallery' => ['nullable', 'array'],
            'gallery.*' => ['string', 'regex:/\.(jpg|jpeg|png|webp)$/i'],
        ];
    }

    public function messages()
    {
        return [];
    }
}
