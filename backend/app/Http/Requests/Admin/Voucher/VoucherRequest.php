<?php

namespace App\Http\Requests\Admin\Voucher;

use App\Enums\Voucher\VoucherDiscountType;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

class VoucherRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'code' => ['required', 'string', 'unique:App\Models\Voucher,code'],
            'start_date' => ['required', 'date', 'before_or_equal:end_date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'discount_type' => ['required', new Enum(VoucherDiscountType::class)],
            'discount_value_price' => ['nullable', 'numeric', 'min:0'],
            'discount_value_percent' => ['nullable', 'numeric', 'min:0'],
            'min_order_value' => ['required', 'numeric', 'min:0'],
            'max_discount_value' => ['required', 'numeric', 'min:0'],
            'is_active' => ['nullable'],
            'user_id' => ['nullable', 'array'],
            'user_id.*' => ['integer', 'exists:App\Models\User,id'],
            'hotel_id' => ['nullable', 'array'],
            'hotel_id.*' => ['integer', 'exists:App\Models\Hotel,id']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Voucher,id'],
            'code' => ['required', 'string'],
            'start_date' => ['required', 'date', 'before_or_equal:end_date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'discount_type' => ['required', new Enum(VoucherDiscountType::class)],
            'discount_value_price' => ['required', 'numeric', 'min:0'],
            'discount_value_percent' => ['required', 'numeric', 'min:0'],
            'min_order_value' => ['required', 'numeric', 'min:0'],
            'max_discount_value' => ['required', 'numeric', 'min:0'],
            'is_active' => ['nullable'],
            'user_id' => ['nullable', 'array'],
            'user_id.*' => ['integer', 'exists:App\Models\User,id'],
            'hotel_id' => ['nullable', 'array'],
            'hotel_id.*' => ['integer', 'exists:App\Models\Hotel,id']
        ];
    }
}
