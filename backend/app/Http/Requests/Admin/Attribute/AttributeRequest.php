<?php

namespace App\Http\Requests\Admin\Attribute;

use App\Http\Requests\BaseRequest;

class AttributeRequest extends BaseRequest
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
            'type' => ['required', 'string'],
            'is_active' => ['nullable']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Attribute,id'],
            'name' => ['required', 'string'],
            'type' => ['required', 'string'],
            'is_active' => ['nullable']
        ];
    }
}
