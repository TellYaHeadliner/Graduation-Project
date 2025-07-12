<?php

namespace App\Http\Requests\API\Hotel;

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
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'star_rating' => ['nullable', 'integer', 'between:1,5'],
            'phone' => [
                'required',
                'regex:/((09|03|07|08|05)+([0-9]{8})\b)/',
            ],
            'mst' => ['required', 'min:10', 'max:13', 'unique:App\Models\Hotel,mst'],
            'bank_account_number' => ['required', 'numeric'],
            'bank_account_name' => ['required', 'string'],
            'bank_name' => ['required', 'string'],
            'avatar' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên khách sạn không được bỏ trống.',
            'address.required' => 'Địa chỉ không được bỏ trống.',
            'star_rating.between' => 'Hạng sao phải nằm trong khoảng từ 1 đến 5.',
            'phone.required' => 'Số điện thoại không được bỏ trống.',
            'phone.regex' => 'Số điện thoại không hợp lệ.',
            'mst.required' => 'Mã số thuế không được bỏ trống.',
            'mst.min' => 'Mã số thuế phải có ít nhất 10 ký tự.',
            'mst.max' => 'Mã số thuế tối đa 13 ký tự.',
            'mst.unique' => 'Mã số thuế đã tồn tại.',
            'bank_account_number.required' => 'Số tài khoản không được bỏ trống.',
            'bank_account_number.numeric' => 'Số tài khoản phải là số.',
            'bank_account_name.required' => 'Tên chủ tài khoản không được bỏ trống.',
            'bank_name.required' => 'Tên ngân hàng không được bỏ trống.',
            'avatar.required' => 'Ảnh đại diện không được bỏ trống.',
            'avatar.image' => 'Ảnh đại diện phải là hình ảnh.',
            'avatar.mimes' => 'Ảnh đại diện phải có định dạng jpg, jpeg, png hoặc webp.',
            'avatar.max' => 'Ảnh đại diện tối đa 2MB.',
        ];
    }
}
