<?php

namespace App\Http\Requests\Admin\BedType;

use App\Http\Requests\BaseRequest;

class BedTypeRequest extends BaseRequest
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
        ];
    }

    protected function methodPut()
    {
        return [
            'id' =>['required','exists:App\Models\BedType,id'],
            'name' => ['required','string'],
        ];
    }

}
