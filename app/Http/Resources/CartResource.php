<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\URL;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            'user_id' => $this->user_id,
            'name' => $this->user->name,
            'product_id' => $this->product_id,
            'product_name' => $this->product->parent->name,
            'product_size' => $this->product->size,
            'minium_order' => $this->product->parent->minimum_order,
            'quantity' => $this->quantity,
            'price' => $this->product->price,
            'total_price' => $this->product->price * $this->quantity,
            'links' => [
                'quantity_increment' => [
                    'url' => URL::to('/').'/api/cart/'.$this->id.'/quantity-increment',
                    'method' => 'PUT',
                ],
                'quantity_decrement' => [
                    'url' => URL::to('/').'/api/cart/'.$this->id.'/quantity-decrement',
                    'method' => 'PUT',
                ],
                'delete' => [
                    'url' => URL::to('/').'/api/cart/'.$this->id,
                    'method' => 'DELETE',
                ],
            ]
        ];
        // return parent::toArray($request);
    }
}
