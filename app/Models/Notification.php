<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'link', 'user_id','group_name', 'seen_at', 'type', 'client_id', 'library_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }
    // public function markAsSeen()
    // {
    //     if (!$this->seen_at) {
    //         $this->seen_at = Carbon::now();
    //     }
    //     $this->save();
    // }
    public function markAsSeen()
    {
        if (!$this->seen_at) {
            $this->seen_at = Carbon::now();
        }
        $this->save();
    }

    public static function send($user_id, $title, $link = null, $type = null, $data = null)
    {
        return static::query()->create(compact('user_id', 'title', 'link', 'type', 'data'));
    }
}
