<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HotelSeasonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       $cheapestVariant = $this->roomTypes
            ->flatMap->variants
            ->sortBy('base_price')
            ->first();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'avatar' => $this->avatar,
            'star_rating' => $this->star_rating,
            'avg_star' => round($this->reviews_avg_star, 1),
            'total_reviews' => $this->reviews_count,
            'base_price' => optional($cheapestVariant)->base_price,
            'discount_price' => optional($cheapestVariant)->discount_price,
        ];
    }
}
