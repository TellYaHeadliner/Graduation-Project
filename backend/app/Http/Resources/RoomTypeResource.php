<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomTypeResource extends JsonResource
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
            'id'   => $this->id,
            'name' => $this->name,
            'area' => $this->area,
            'description' => $this->description,
            'gallery' => $this->gallery,
            'available_room_count' => $this->available_room_count,
            'bed'  => [
                'type_name' => optional($this->bedType)->name,
                'quantity'  => $this->bed_quantity,
            ],
            'amenities' => $this->amenities->map(fn($a) => [
                'name' => $a->name,
            ]),
            'variants'  => VariantResource::collection($this->whenLoaded('variants')),
        ];
    }
}
