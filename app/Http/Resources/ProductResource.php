<?php

namespace App\Http\Resources;

use App\Http\Resources\SizeResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'minium_order' => $this->minimum_order,
            'category' => $this->categories->map(function ($category) { return $category->only(['id', 'name', 'category_id']); }),
            'size' => $this->sizes->count() > 0 ? SizeResource::collection($this->sizes) : [
                'id' => $this->id,
                'size' => $this->size??'One Size',
                'price' => $this->price,
            ],
        ];
    }
}
