<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Models\ProductDetails;
use App\Http\Resources\ImageResource;
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
            "id" => $this->id,
            "price" => $this->discounted_price ?: $this->sell_price,
            "price_before_discount" => $this->discounted_price ? $this->sell_price : 0 ,
            "product_type" => $this->type?->name,
            "category" => $this->category?->name,
            "category_child" => $this->categoryChild?->name,
            "name" => $this->name,
            "description" => $this->description,
            "quantity" => $this->quantity,
            "no_quantity" => $this->no_quantity ? true : false,
            "delivery_type" => $this->delivery_type,
            "barcode" => $this->barcode,
            "vendor" => $this->user?->name,
            "image" => display_file($this->image),
            "is_my_favourite" =>$this->is_my_favourite,
            "files" => $this->whenLoaded('files', function () {
                return ImageResource::collection($this->files);
            }),
        ];
    }
}
