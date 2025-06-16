<?php

namespace App\Http\Requests\Admin\CommissionRule;

use App\Http\Requests\BaseRequest;

class CommissionRuleRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'note' => ['nullable', 'string'],
            'min_amount' => ['required', 'numeric', 'min:0', 'lte:max_amount'],
            'max_amount' => ['required', 'numeric', 'min:0', 'gte:min_amount'],
            'commission_percent' => ['required', 'numeric', 'min:0'],
            'is_active' => ['nullable']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\CommissionRule,id'],
            'note' => ['nullable', 'string'],
            'min_amount' => ['required', 'numeric', 'min:0', 'lte:max_amount'],
            'max_amount' => ['required', 'numeric', 'min:0', 'gte:min_amount'],
            'commission_percent' => ['required', 'numeric', 'min:0'],
            'is_active' => ['nullable']
        ];
    }
}
