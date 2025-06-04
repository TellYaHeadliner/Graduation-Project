<?php

namespace App\Http\Requests\Admin\Hotel;

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
            'id' => ['required', 'exists:App\Models\User,id'],
            'name' => ['required', 'string'],
            'address' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'star_rating' => ['nullable', 'integer', 'between:1,5'],
            'email' => ['required', 'email', 'unique:App\Models\Hotel,email'],
            'phone' => [
                'required',
                'regex:/((09|03|07|08|05)+([0-9]{8})\b)/',
            ],
            'mst' => ['required', 'min:10' , 'max:13'],
            'bank_account_number' => ['required', 'numeric'],
            'bank_account_name' => ['required', 'string'],
            'bank_name' => ['required', 'string'],
            'avatar' => ['nullable'],
            'gallery' => ['nullable'],
            'status' => ['nullable', new Enum(HotelStatus::class)],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Hotel,id'],
            'name' => ['required', 'string'],
            'address' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'star_rating' => ['nullable'],
            'email' => ['required', 'email'],
            'phone' => [
                'required',
                'regex:/((09|03|07|08|05)+([0-9]{8})\b)/',
            ],
            'mst' => ['required'],
            'bank_account_number' => ['required'],
            'bank_account_name' => ['required', 'string'],
            'bank_name' => ['required', 'string'],
            'avatar' => ['nullable'],
            'gallery' => ['nullable'],
            'status' => ['nullable', new Enum(HotelStatus::class)],
        ];
    }

    public function messages()
    {
        return [


        ];
    }
}
