<?php

namespace App\Http\Requests\Hotel\RoomTypeVariant;

use App\Enums\RoomTypeVariant\RoomTypeVariantStatus;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

class RoomTypeVariantRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    protected function methodPost()
    {
        return [
            'base_price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'season_id' => 'nullable|exists:App\Models\Season,id',
            'discount_type' => 'nullable|in:0,1',
            'discount_value_price' => 'nullable|numeric',
            'discount_value_percent' => 'nullable|numeric|min:0|max:100',
            'attribute.guest' => 'required|integer|min:1',
            'attribute.children' => 'nullable|integer|min:0',
            'attribute.meal' => 'nullable|boolean',
            'attribute.smoking' => 'nullable|boolean',
            'attribute.cancel' => 'required|in:free_before and fee_after,no_refund',
            'fee_type' => 'nullable|in:0,1',
            'fee_amount_price' => 'nullable|numeric|min:0',
            'fee_amount_percent' => 'nullable|numeric|min:0|max:100',
            'status' => ['nullable', new Enum(RoomTypeVariantStatus::class)],
            
        ];
    }
    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\RoomTypeVariant,id'],
            'base_price' => 'required|numeric|min:0',
            'discount_price' => 'required|numeric|min:0',
            'season_id' => 'nullable|exists:seasons,id',
            'discount_type' => 'nullable|in:0,1',
            'discount_value_price' => 'nullable|numeric',
            'discount_value_percent' => 'nullable|numeric',
            'attribute.guest' => 'required|integer|min:1',
            'attribute.children' => 'nullable|integer|min:0',
            'attribute.meal' => 'nullable|boolean',
            'attribute.smoking' => 'nullable|boolean',
            'attribute.cancel' => 'nullable|in:free_before and fee_after,no_refund',
            'fee_type' => 'nullable|in:0,1',
            'fee_amount_price' => 'nullable|numeric|min:0',
            'fee_amount_percent' => 'nullable|numeric|min:0|max:100',
            'status' => ['nullable', new Enum(RoomTypeVariantStatus::class)],
        ];
    }

    public function messages()
    {
        return [];
    }

    protected function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $data = $this->all();

            if (isset($data['season_id']) && $data['discount_type'] == 0 && empty($data['discount_value_price'])) {
                $validator->errors()->add('discount_value_price', 'Vui lòng nhập số tiền giảm.');
            }
            if (isset($data['season_id']) && $data['discount_type'] == 1 && empty($data['discount_value_percent'])) {
                $validator->errors()->add('discount_value_percent', 'Vui lòng nhập phần trăm giảm.');
            }
            if ($data['attribute']['cancel'] === 'free_before_and_fee_after') {
                if ($data['fee_type'] == 0 && empty($data['fee_amount_price'])) {
                    $validator->errors()->add('fee_amount_price', 'Vui lòng nhập số tiền phí huỷ.');
                }
                if ($data['fee_type'] == 1 && empty($data['fee_amount_percent'])) {
                    $validator->errors()->add('fee_amount_percent', 'Vui lòng nhập phần trăm phí huỷ.');
                }
            }
        });
    }
}
