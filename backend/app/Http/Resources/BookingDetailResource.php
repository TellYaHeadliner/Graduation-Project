<?php

namespace App\Http\Resources;

use App\Enums\Booking\BookingStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'id'             => $this->id,
            'booking_code'   => $this->booking_code,
            'total_amount'   => $this->total_amount,
            'check_in' => format_date($this->checkin_date, 'd-m-Y'),
            'check_out' => format_date($this->checkout_date, 'd-m-Y'),
            'status' => $this->status->description(),
            'note'           => $this->note,
            'created_at'     => $this->created_at->format('d/m/Y H:i'),
            'cancellation_fee' => $this->cancellation_fee ? $this->cancellation_fee : null,

            'customer'       => [
                'name'     => $this->user->fullname,
                'email'    => $this->user->email,
                'phone'    => $this->user->phone,
            ],
            'hotel' => [
                'name'     => $this->hotel->name,
                'address'  => $this->hotel->address,
                'avatar' => $this->hotel->avatar,
            ],
            'voucher' => $this->voucher ? [
                'code'         => $this->voucher->code,
                'discount'     => $this->voucher->discount_value,
                'discount_type' => $this->voucher->discount_type,
                'max_discount' => $this->voucher->max_discount_value,
            ] : null,

            'booking_details' => $this->bookingDetails->map(function ($detail) {

                $attribute = $detail->variant?->attributes
                    ->firstWhere(
                        fn($att) =>
                        in_array($att->type, ['no_refund', 'free_before and fee_after'])
                    );

                return [
                    'room_code'      => $detail->room?->code,
                    'room_type'      => $detail->roomType?->name,
                    'price' => $detail->price_per_room,
                    'refund_policy'  => $attribute
                        ? [
                            'name'  => $attribute->name,
                            'value' => $attribute->pivot->attribute_value ?: null,
                        ]
                        : null,
                ];
            }),

            'booking_services' => $this->bookingServices->map(function ($item) {
                return [
                    'name' => $item->hotelService->service->name ?? null,
                    'default_unit' => $item->hotelService->service->default_unit,
                    'quantity'     => $item->quantity,
                    'price'        => $item->price,
                    'total_price'  => $item->total_price,
                ];
            }),

            'booking_combos' => $this->bookingCombos->map(function ($item) {
                return [
                    'combo_name'   => $item->combo->name ?? null,
                    'quantity'     => $item->quantity,
                    'price'        => $item->price,
                    'total_price'  => $item->total_price,
                    'services'  => $item->combo->hotelServices->map(function ($item) {
                        return [
                            'name' => $item->service->name,
                            'quantity' => $item->pivot->quantity,
                        ];
                    }),
                ];
            }),
        ];
    }
}
