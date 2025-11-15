<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Order extends Model
{
    use HasFactory;


    protected $guarded = ['id'];

    public static function generateNextOrderNumber()
    {
        $lastOrder = Order::latest('id')->first();
        if (!$lastOrder) {
            $number = 0;
        } else {
            $number = substr($lastOrder->number, 3);
        }
        return 'ORD' . sprintf('%06d', intval($number) + 1);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->number = static::generateNextOrderNumber();
        });
    }

    public function is_rated_by_user($id): bool
    {
        return $this->rates()->where('user_id', $id)->exists();
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    public function scopeAccepted(Builder $query): Builder
    {
        return $query->where('status', 'accepted');
    }


    public function scopeWaitingForDriver(Builder $query): Builder
    {
        return $query->where('status', 'waiting_for_drivers');
    }

    public function scopeAssignedToDriver(Builder $query): Builder
    {
        return $query->where('status', 'assigned_to_driver');
    }

    public function scopeRefused(Builder $query): Builder
    {
        return $query->where('status', 'refused');
    }

    public function scopeInProgress(Builder $query): Builder
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeDone(Builder $query): Builder
    {
        return $query->where('status', 'done');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function bank(): BelongsTo
    {
        return $this->belongsTo(BankAccount::class, 'bank_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function order_rate()
    {
        return $this->morphOne(Rate::class, 'item');
    }

    public function items(): MorphMany
    {
        return $this->morphMany(Item::class, 'model');
    }

    public function neighborhood(): BelongsTo
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function scopeForDriver(Builder $query): Builder
    {
        return $query->where('driver_id', auth()->id())
            ->orWhere(function ($q) {

                $q->where('driver_type', 'platform_driver');

                if (auth()->user()->can_serve == 'all') {
                    $q->where('city_id', auth()->user()->city_id);
                } else {
                    $q->where('neighborhood_id', auth()->user()->neighborhood_id);
                }
                $q->where('status', 'waiting_for_drivers');
            });
    }

    public function scopeMine(Builder $query): Builder
    {
        return $query->where('client_id', auth()->id());
    }

    public function scopeAcceptedByAdmin(Builder $query): Builder
    {
        return $query->where('status', 'accepted_by_admin');
    }

    public function paymentTransactions(): HasMany
    {
        return $this->hasMany(PaymentTransaction::class, 'order_id');
    }

    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class, 'order_id');
    }
}
