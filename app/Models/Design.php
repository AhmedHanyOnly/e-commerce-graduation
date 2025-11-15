<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Design extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static function booted()
    {
        static::updated(function () {
            Cache::forget('designs');
        });
        static::created(function () {
            Cache::forget('designs');
        });
        static::deleted(function () {
            Cache::forget('designs');
        });
    }

}
