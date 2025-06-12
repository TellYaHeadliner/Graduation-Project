<?php

namespace App\Http\Requests\Admin\Service;

use App\Http\Requests\BaseRequest;

class ServiceRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'name' => ['required','string', 'unique:App\Models\Service,name'],
            'default_unit' => ['required','string'],
            'status' => ['nullable'],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' =>['required','exists:App\Models\Service,id'],
            'name' => ['required','string'],
            'default_unit' => ['required','string'],
            'status' => ['nullable'],
        ];
    }
    
    public function messages(){
        return [
            'name.unique' => 'Dịch vụ đã tồn tại'
        ];
    }
}
