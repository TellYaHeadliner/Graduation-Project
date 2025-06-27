<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VariantResource extends JsonResource
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
            'base_price'     => $this->base_price,
            'discount_price' => $this->discount_price,

            'seasons' => $this->seasons->map(fn($s) => [
                'id'            => $s->id,
                'name'          => $s->name,
                'discount_type' => $s->pivot->discount_type,
                'discount_value' => $s->pivot->discount_value,
            ]),

            'attributes' => $this->attributes->map(fn($a) => [
                'name'  => $a->name,
                'value' => is_numeric($a->pivot->attribute_value)
                    ? (int) $a->pivot->attribute_value
                    : (bool) $a->pivot->attribute_value,
            ]),
        ];
    }
}
