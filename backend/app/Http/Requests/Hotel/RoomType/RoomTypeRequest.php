<?php

namespace App\Http\Requests\Hotel\RoomType;

use App\Enums\RoomType\RoomTypeStatus;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

class RoomTypeRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    protected function methodPost()
    {
        return [
            'bed_type_id' => ['nullable', 'exists:App\Models\BedType,id'],
            'name' => ['required', 'string'],
            'room_code' => ['nullable', 'string','exists:App\Models\RoomType,room_code'],
            'room_quantity' => ['nullable', 'numeric', 'min:1'],
            'area' => ['nullable', 'numeric', 'min:1'],
            'bed_quantity' => ['nullable', 'numeric', 'min:1'],
            'description' => ['nullable', 'string'],
            'create_room' => ['nullable'],
            'gallery' => ['nullable'],
            'amenities' => ['nullable', 'array'],
            'amenities.*' => ['integer', 'exists:App\Models\Amenity,id'],
            'status' => ['nullable'],
        ];
    }
    protected function methodPut()
    {
        return [
            'id' => ['required', 'exists:App\Models\RoomType,id'],
            'bed_type_id' => ['nullable', 'exists:App\Models\BedType,id'],
            'name' => ['required', 'string'],
            'room_code' => ['nullable', 'string'],
            'room_quantity' => ['nullable', 'numeric', 'min:1'],
            'area' => ['nullable', 'numeric', 'min:1'],
            'bed_quantity' => ['nullable', 'numeric', 'min:1'],
            'description' => ['nullable', 'string'],
            'gallery' => ['nullable'],
            'amenities' => ['nullable', 'array'],
            'amenities.*' => ['integer', 'exists:App\Models\Amenity,id'],
            'status' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [];
    }
}
