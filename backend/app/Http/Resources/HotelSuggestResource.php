<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HotelSuggestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $variants = $this->roomTypes->flatMap->variants;
        $bestVariant = $variants->sortBy(function ($variant) {
            return $variant->discount_price ?: $variant->base_price;
        })
            ->first();

        if (!$bestVariant) {
            return [
                'id'              => $this->id,
                'name'            => $this->name,
                'address'         => $this->address,
                'average_star'    => round($this->reviews_avg_star ?? 0, 1),
                'total_reviews'   => $this->reviews_count ?? 0,
                'room_type'       => null,
            ];
        }

        $is_chinh_sach_huy = $bestVariant->attributes->where('type', 'free_before and fee_after')->isNotEmpty();
        $guest = $bestVariant->attributes->firstWhere('type', 'guest');
        $children = $bestVariant->attributes->firstWhere('type', 'children');
        $season = $bestVariant->seasons->firstWhere('status',1);


        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'address'       => $this->address,
            'avatar'       => $this->avatar,
            'average_star'  => round($this->reviews_avg_star, 1),
            'total_reviews' => $this->reviews_count,
            'amenities' =>$this->amenities->map(fn($item)=>[
                'name' => $item->name,
            ]),
            'room_type' => [
                'name'          => optional($bestVariant->roomType)->name,
                'base_price'         => $bestVariant->base_price,
                'discount_price'         => $bestVariant->discount_price,
                'bed_type'      => $bestVariant->roomType->bedType->name,
                'bed_quantity'      => $bestVariant->roomType->bed_quantity,
                'guest'      => $guest->pivot->attribute_value ?? null,
                'children'      => $children->pivot->attribute_value ?? null,
                'cancellation'  => $is_chinh_sach_huy ? 'Miễn phí hủy' : null,
            ],

            // 'season' => $season->name
        ];
    }
}
