<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;

class LoginRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'email' => ['required','email'],
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Mật khẩu là bắt buộc',
            'emai.email'=>'Email không đúng định dạng',
            'email.required'=>'Email là bắt buộc'
        ];
    }
}
