<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['is_my_favourite'];

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function categoryChild()
    {
        return $this->belongsTo(Category::class, 'category_child_id');
    }

    public function files()
    {
        return $this->morphMany(Attachment::class, 'file');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeActive($q)
    {
        return $q->where('active', 1);
    }

    public function orders()
    {
        return $this->hasMany(Item::class)->where('model_type', 'App\Models\Order');
    }
    public function favorites()
    {
        return $this->hasMany( Favorite::class, 'product_id');
    }

    public function getIsMyFavouriteAttribute(): bool
    {
        if (auth()->check()) {
            return auth()->user()->favoriteProducts->contains($this);
        }
        return false;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function colors(): HasMany
    {
        return $this->hasMany(ProductColor::class, 'product_id');
    }

    public function rates(): MorphMany
    {
        return $this->morphMany(Rate::class, 'item');
    }

    public function getSellPriceAttribute($val)
    {
        return $val ?: $this->variants->first()?->sell_price;
    }

    public function getDiscountPercentageAttribute($val)
    {
        return $val ?: $this->variants->first()?->discount_percentage;
    }

    public function getDiscountedPriceAttribute()
    {
        $variant = $this->variants->first();
        $item = $this->sell_price ? $this : $variant;
        $price = $item->sell_price;
        if ($item->discount_percentage){
            return $price - ($this->discount_percentage / 100) * $price;
        }

        return false;
    }

    public function is_rated_by_this_user($id)
    {
        return $this->rates()->where('user_id', $id)->exists();
    }
}
