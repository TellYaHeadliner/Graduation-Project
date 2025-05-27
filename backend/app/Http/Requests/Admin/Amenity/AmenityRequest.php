<?php

namespace App\Http\Requests\Admin\Amenity;

use App\Http\Requests\BaseRequest;

class AmenityRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'name' => ['required','string'],
            'parent_id' => ['exists:App\Models\Amenity,id'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' =>['required','exists:App\Models\Amenity,id'],
            'name' => ['required','string'],
            'parent_id' => ['exists:App\Models\Amenity,id'],
        ];
    }

}
