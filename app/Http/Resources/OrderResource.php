<?php

namespace App\Http\Resources;

use App\Http\Resources\OrderProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'total' => $this->total,
            'status' => [
                'created_at' => $this->created_at,
                'paid_at' => $this->is_paid,
                'proses_at' => $this->in_process,
                'done_at' => $this->done,
                'canceled_at' => $this->canceled,
            ],
            'products' => OrderProductResource::collection($this->products)
        ];
        return parent::toArray($request);
    }
}
