<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'custom_article_number' => $this->custom_article_number,
            'article_number' => $this->article_number,
            'pzn' => $this->pzn,
            'article_description_1' => $this->article_description_1,
            'article_description_2' => $this->article_description_2,
            'article_description_3' => $this->article_description_3,
            'price_unit' => $this->price_unit,
            'minimum_order_quantity' => $this->minimum_order_quantity,
            'quantity_unit' => $this->quantity_unit,
            'tax_code' => $this->tax_code,
            'retail_price' => $this->retail_price,
            'sales_price' => $this->sales_price,
            'tier_code' => $this->tier_code,
            'quantity_value_1' => $this->quantity_value_1,
            'net_price_discount_1' => $this->net_price_discount_1,
            'quantity_value_2' => $this->quantity_value_2,
            'net_price_discount_2' => $this->net_price_discount_2,
            'quantity_value_3' => $this->quantity_value_3,
            'net_price_discount_3' => $this->net_price_discount_3,
            'is_new' => $this->is_new,
            'date_new_entry' => $this->date_new_entry,
            'price_changed' => $this->price_changed,
            'date_last_price_change' => $this->date_last_price_change,
            'non_discountable' => $this->non_discountable,
            'promotion_price' => $this->promotion_price,
            'valid_from' => $this->valid_from,
            'valid_until' => $this->valid_until,
            'gtin' => $this->gtin,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
