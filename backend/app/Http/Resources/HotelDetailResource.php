<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HotelDetailResource extends JsonResource
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
            'id'       => $this->id,
            'name'     => $this->name,
            'address'  => $this->address,
            'description' => $this->description,
            'star_rating' => $this->star_rating,
            'phone' => $this->phone,
            'email' => $this->email,
            'mst' => $this->mst,
            'avatar' => $this->avatar,
            'gallery' => $this->gallery,
            'average_star'  => round($this->reviews_avg_star, 1),
            'total_reviews' => $this->reviews_count,


            'rules' => [
                'check_in_time' => date('H:i', strtotime($this->hotelRule?->check_in_time)),
                'check_out_time' => date('H:i', strtotime($this->hotelRule?->check_out_time)),
                'pet_policy'      => $this->hotelRule->pet_policy->value == 1,
                'child_policy'   => $this->hotelRule->child_policy->value == 1,
                'child_age_limit'  => $this->hotelRule?->child_age_limit,
                'extra_bed_fee'    => $this->hotelRule?->extra_bed_fee,
            ],

            'amenities' => $this->amenities->map(fn($a) => [
                'name' => $a->name,
            ]),

            'services'  => $this->services->map(fn($s) => [
                'id' => $s->pivot->id,
                'name' => $s->name,
                'default_unit' => $s->default_unit,
                'short_description' => $s->short_description,
                'base_price' => $s->pivot->base_price,
                'promo_price' => $s->pivot->promo_price,
            ]),

            'combos'    => $this->combos->map(fn($c) => [
                'id'    => $c->id,
                'name'  => $c->name,
                'short_description'  => $c->short_description,
                'combo_price' => $c->combo_price,
                'original_price' => $c->original_price,
                'services' => $c->comboServices->map(fn($cs) => [
                    'name' => $cs->service->name,
                    'default_unit' => $cs->service->default_unit,
                    'quantity' => $cs->quantity,
                ]),
            ]),

            'vouchers'  => $this->vouchers->map(fn($v) => [
                'id' => $v->id,
                'code' => $v->code,
                'discount' => [
                    'type' => $v->discount_type,
                    'value' => $v->discount_value,
                    'max' => $v->max_discount_value,
                ],
                'min_order_value' => $v->min_order_value,
                'start_date' => $v->start_date,
                'end_date' => $v->end_date,
            ]),
            'reviews' => $this->reviews->map(function ($item) {
                return [
                    'user_name' => $item->user->fullname,
                    'star' => $item->star,
                    'content' => $item->content,
                    'created_at' => format_date($item->created_at, 'm-d-Y H:i'),
                    'room_type' => $item->booking->bookingDetails->first()->roomType->name
                ];
            })
        ];
    }
}
