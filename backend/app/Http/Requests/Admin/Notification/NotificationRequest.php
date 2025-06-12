<?php

namespace App\Http\Requests\Admin\Notification;

use App\Http\Requests\BaseRequest;

class NotificationRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function methodPost()
    {
        return [
            'title' => ['required', 'string'],
            'content' => ['nullable', 'string'],
            'user_id' => ['nullable','array'],
            'user_id.*' => ['integer', 'exists:App\Models\User,id']
        ];
    }

    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Notification,id'],
            'title' => ['required', 'string'],
            'content' => ['nullable', 'string'],
        ];
    }
}
