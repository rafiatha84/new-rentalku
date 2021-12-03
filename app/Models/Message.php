<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'chat_room_id',
        'message',
        'is_seen',
        'created_at',
        'updated_at'
    ];

    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function room(){
        return $this->hasOne('App\Models\Room','id','room_id');
    }
}
