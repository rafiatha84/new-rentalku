<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'user_to_id',
        'created_at'
    ];

    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }
    
    public function userTo(){
        return $this->hasOne('App\Models\User','id','user_to_id');
    }

    public function message(){
        return $this->hasMany('App\Models\Message')->orderBy('id', 'DESC');
    }
}
