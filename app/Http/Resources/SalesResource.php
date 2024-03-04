<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SalesResource extends JsonResource
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
            'sales_id' => $this->id,
            'store_id' => $this->store_id,
            'price_total' => $this->price_total,
            'amount_total' => $this->amount_total,
            'customer' => $this->customer,
            'purchases_products' => $this->purchases
        ];
    }
}
