<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'type', 'description', 'user_id', 'status', 'file'];
    public const STATUS = [
        'open' => 'مفتوح',
        'finished' => 'منتهي',
        'closed' => 'مغلق',
    ];

    public const CLASSES = [
        'open' => 'primary',
        'finished' => 'success',
        'closed' => 'danger',
    ];

    public const TYPES = [
        'orders' => 'المناسبات',
        'activate_mempership' => 'تفعيل العضوية',
        'other' => 'أخري',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(TicketComment::class, 'ticket_id')->latest();
    }

    public function getHumanDateAttribute()
    {
        return Carbon::parse($this->updated_at)->diffForHumans();
    }

    public function getStatus()
    {
        return [
            'label' => self::STATUS[$this->status],
            'class' => self::CLASSES[$this->status],
            'status' => $this->status
        ];
    }

    public function getType()
    {
        return self::TYPES[$this->type];
    }
}
