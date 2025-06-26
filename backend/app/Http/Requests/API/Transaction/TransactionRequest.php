<?php

namespace App\Http\Requests\API\Transaction;

use App\Enums\Transaction\TransactionStatus;
use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rules\Enum;

class TransactionRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    protected function methodPost()
    {
        return [
            'hotel_id' => ['required', 'exists:App\Models\Hotel,id'],
            'checkin_date' => ['required', 'date', 'after_or_equal:today'],
            'checkout_date' => ['required', 'date', 'after:checkin_date'],
            'note' => ['nullable', 'string'],
            'voucher_id' => ['nullable', 'exists:App\Models\Voucher,id'],

            // Danh sách room types
            'booking_details' => ['required', 'array', 'min:1'],
            'booking_details.*.room_type_id' => ['required', 'exists:App\Models\RoomType,id'],
            'booking_details.*.room_type_variant_id' => ['required', 'exists:App\Models\RoomTypeVariant,id'],
            'booking_details.*.quantity' => ['required', 'integer', 'min:1'],

            // Danh sách combo (có thể null)
            'booking_combos' => ['nullable', 'array'],
            'booking_combos.*.combo_id' => ['required', 'exists:App\Models\Combo,id'],
            'booking_combos.*.quantity' => ['required', 'integer', 'min:1'],

            // Danh sách service (có thể null)
            'booking_services' => ['nullable', 'array'],
            'booking_services.*.hotel_service_id' => ['required', 'exists:App\Models\HotelService,id'],
            'booking_services.*.quantity' => ['required', 'integer', 'min:1'],
        ];
    }


    public function messages()
    {
        return [];
    }
}
