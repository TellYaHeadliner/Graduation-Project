<?php

namespace App\Http\Requests\Hotel\Room;

use App\Enums\Room\RoomStatus;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

class RoomRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    protected function methodPost()
    {
        return [
            'code' => ['required', 'string', 'min:1' ,'max:10'],
            'status' => ['nullable' , new Enum(RoomStatus::class)],
        ];
    }
    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\Room,id'],
            'code' => ['required', 'string', 'min:1' , 'max:10'],
            'status' => ['nullable' , new Enum(RoomStatus::class)],
        ];
    }

    public function messages()
    {
        return [];
    }
}
