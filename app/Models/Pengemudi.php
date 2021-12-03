<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengemudi extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "owner_id",
        "harga"
    ];

    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function owner(){
        return $this->hasOne('App\Models\User','id','owner_id');
    }
    public function pengemudiTransaksi(){
        return $this->hasMany('App\Models\PengemudiTransaksi');
    }
}
