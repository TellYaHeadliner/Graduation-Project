<?php

namespace App\Http\Requests\Admin\User;

use App\Enums\User\UserGender;
use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use App\Http\Requests\BaseRequest;
use App\Models\User;
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
            'email' => ['required', 'email'],
            'phone' => [
                'nullable',
                'regex:/((09|03|07|08|05)+([0-9]{8})\b)/',
            ],
            'address' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'birthday' => ['nullable', 'date_format:Y-m-d'],
            'gender' => ['required', new Enum(UserGender::class)],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    protected function methodPut()
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
            'password_new' => ['nullable', 'string', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Họ và tên là bắt buộc',
            'phone.regex' => 'Định dạng số điện thoại không hợp lệ',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->isMethod('post')) {
                $email = $this->input('email');
                $existingUser = User::where('email', $email)->first();

                if ($existingUser) {
                    if (is_null($existingUser->email_verified_at)) {
                        $validator->errors()->add('email', 'Email đã được đăng ký nhưng chưa xác minh. Vui lòng kiểm tra email để kích hoạt tài khoản.');
                    } else {
                        $validator->errors()->add('email', 'Email đã được đăng ký.');
                    }
                }
            }
        });
    }
}
