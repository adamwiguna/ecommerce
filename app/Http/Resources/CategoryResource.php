<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\URL;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'category_id' => $this->category_id,
            // 'products' => ProductResource::collection($this->products),
            'sub_categories' => CategoryResource::collection($this->subCategories),
            'meta' => [
                'url' => [
                    'products' => URL::to('/').'/api/category/'.$this->id.'/product',
                ]
            ]
        ];
    }
}
