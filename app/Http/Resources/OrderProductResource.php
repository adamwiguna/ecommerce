<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->parent->name,
            'size' => $this->size,
            'price' => $this->price,
            'quantity' => $this->pivot->quantity,
            'sub_total' => $this->price * $this->pivot->quantity,
        ];
        return parent::toArray($request);
    }
}
