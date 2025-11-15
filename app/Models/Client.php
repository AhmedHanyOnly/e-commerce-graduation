<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable=['name','phone','city_id','program_id','status','notes','user_id','contact'];
    public function program(){
        return $this->belongsTo(Program::class,'program_id')->withDefault();
    }
    public function city(){
        return $this->belongsTo(City::class,'city_id')->withDefault();
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id')->withDefault();
    }
}
