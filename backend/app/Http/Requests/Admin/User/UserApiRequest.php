<?php

namespace App\Http\Requests\Admin\User;

use App\Enums\User\UserGender;
use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

class UserApiRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'fullname' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:App\Models\User,email'],
            'phone' => [
                'nullable',
                'regex:/((09|03|07|08|05)+([0-9]{8})\b)/',
            ],
            'address' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'birthday' => ['nullable', 'date_format:Y-m-d'],
            'gender' => ['required', new Enum(UserGender::class)],
            'password' => ['required', 'string'],
            // 'status' => ['nullable'],
            // 'role' => ['required', new Enum(UserRole::class)],
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\User,id'],
            'fullname' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:App\Models\User,email,' . $this->id],
            'phone' => [
                'nullable',
                'regex:/((09|03|07|08|05)+([0-9]{8})\b)/',
            ],
            'address' => ['nullable', 'string'],
            'avatar' => ['nullable', 'string'],
            'birthday' => ['nullable', 'date_format:Y-m-d'],
            'gender' => ['required', new Enum(UserGender::class)],
            'password' => ['nullable', 'string', 'confirmed'],
            // 'status' => ['nullable'],
            // 'role' => ['required', new Enum(UserRole::class)],
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Họ và tên là bắt buộc',
            'email.unique' => 'Email đã tồn tại',
            'phone.regex' => 'Định dạng số điện thoại không hợp lệ',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
        ];
    }
}
