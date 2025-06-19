<?php

namespace App\Http\Requests\Hotel\Combo;

use App\Http\Requests\BaseRequest;

class ComboRequest extends BaseRequest
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
            'short_description' => ['nullable', 'string'],
            'combo_price' => ['required', 'numeric', 'min:0'],
            'status' => ['nullable'],
        ];
    }
    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Combo,id'],
            'name' => ['required', 'string'],
            'short_description' => ['nullable', 'string'],
            'combo_price' => ['required', 'numeric', 'min:0'],
            'status' => ['nullable'],
        ];
    }
    
}
