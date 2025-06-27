<?php

namespace App\Http\Resources;

use App\Enums\Booking\BookingStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'hotel_name'     => $this->hotel->name,
            'address' => $this->hotel->address,

            'total_price' => $this->total_amount,
            'check_in' => format_date($this->checkin_date,'d-m-Y'),
            'check_out' => format_date($this->checkout_date,'d-m-Y'),
            'status' => $this->status->description()
        ];
    }
}
