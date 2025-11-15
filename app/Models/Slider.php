<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Slider extends Model
{
    use HasFactory;
    protected $guarded =[];
    protected static function booted()
    {
        static::updated(function () {
            Cache::forget('sliders');
        });
        static::created(function () {
            Cache::forget('sliders');
        });
        static::deleted(function () {
            Cache::forget('sliders');
        });
    }
    public function getTitleAttribute()
    {
        $locale = app()->getLocale();
        return $this->{'title_' . $locale} ?: $this->attributes['title'] ?? '';
    }

    public function getSubtitleAttribute()
    {
        $locale = app()->getLocale();
        return $this->{'subtitle_' . $locale} ?: $this->attributes['subtitle'] ?? '';
    }



}
