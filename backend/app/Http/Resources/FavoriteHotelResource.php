<?php

namespace App\Http\Resources;

use App\Enums\Booking\BookingStatus;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteHotelResource extends JsonResource
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
            'id'            => $this->id,
            'name'          => $this->name,
            'address'       => $this->address,
            'avatar'        => $this->avatar,
            'star_rating'        => $this->star_rating ?? 0,
           // 'review_count'  => $this->reviews_count ?? 0,
            'is_favorite'   => true,
        ];
    }
}
