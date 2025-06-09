<?php

namespace App\Http\Requests\Admin\Season;

use App\Http\Requests\BaseRequest;

class SeasonRequest extends BaseRequest
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
            'start_date' => ['required', 'date','before_or_equal:end_date'],
            'end_date' => ['required', 'date','after_or_equal:start_date'],
            'status' => ['nullable']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Season,id'],
            'name' => ['required', 'string'],
            'start_date' => ['required', 'date','before_or_equal:end_date'],
            'end_date' => ['required', 'date','after_or_equal:start_date'],
            'status' => ['nullable']
        ];
    }

    public function messages(){
        return [
        'start_date.before_or_equal' => 'Ngày bắt đầu không thể trước ngày kết thúc',
        'end_date.after_or_equal' => 'Ngày kết thúc không thể sau ngày bắt đầu',
        ];
    }
}
