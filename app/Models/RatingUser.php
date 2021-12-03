<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingUser extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "user_to_id",
        "transaksi_id",
        "jumlah_bintang",
        "review"
    ];

    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function userTo(){
        return $this->hasOne('App\Models\User','id','user_to_id');
    }
    public function transaksi(){
        return $this->hasOne('App\Models\Transaksi','transaksi_id','transaksi_id');
    }

}
