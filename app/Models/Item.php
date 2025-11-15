<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['product_name'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

   public function item()
{
    return $this->morphTo(__FUNCTION__, 'model_type', 'model_id');
}

    public function scopeOrder(Builder $query): Builder
    {
        return $query->where('model_type', 'App\Models\Order');
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function getProductNameAttribute()
    {
        return $this->product?->name;
    }
}
