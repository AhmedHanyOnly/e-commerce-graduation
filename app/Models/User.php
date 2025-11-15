<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password','type','active','phone','image','city_id'
    // ];

    protected $guarded = [];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getRoleAttribute()
    {
        return $this->roles->first();
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function scopeClients($q)
    {
        return $q->where('type', 'client');
    }

    public function scopeVendors($q)
    {
        return $q->where('type', 'vendor');
    }
    public function scopeDrivers($q)
    {
        return $q->where('type', 'driver');
    }

    public function scopeAdmins($q)
    {
        return $q->where('type', 'admin');
    }

    public function scopeActive($q)
    {
        return $q->where('active', 1);
    }

    public function scopeInActive($q)
    {
        return $q->where('active', 0);
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class, 'neighborhood_id');
    }

    public function clientOrders()
    {
        return $this->hasMany(Order::class, 'client_id');
    }

    public function driverOrders()
    {
        return $this->hasMany(Order::class, 'driver_id');
    }
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function unreadNotifications()
    {
        return $this->notifications()->whereNull('seen_at');
    }
    public function getProfileCompleteAttribute()
    {
        if ($this->name && $this->address && $this->phone && $this->city_id && $this->neighborhood_id) {
            return true;
        }
        return false;
    }
    public function orderRatings()
    {
        return $this->hasMany(Rate::class)->where('item_type', 'App\\Models\\Order');
    }
    public function productRatings()
    {
        return $this->hasMany(Rate::class)->where('item_type', 'App\\Models\\Product');
    }
    public function favoriteProducts()
    {
        return $this->hasManyThrough(
            Product::class,
            Favorite::class,
            'user_id',
            'id',
            'id',
            'product_id'
        );
    }


    public function hasPurchasedProduct($productId)
    {
        return $this->clientOrders()
            ->whereHas('items', function ($query) use ($productId) {
                $query->where('product_id', $productId);
            })
            ->where('payment_status', 1)
            ->exists();
    }
}
