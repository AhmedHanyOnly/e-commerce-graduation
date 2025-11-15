<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariant extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class);
    }

    public function colors(): HasMany
    {
        return $this->hasMany(ProductColor::class,'variant_id');
    }

    public function getDiscountedPriceAttribute()
    {
        if ($this->discount_percentage){
            return $this->sell_price - ($this->discount_percentage / 100) * $this->sell_price;
        }

        return false;
    }


}
