<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dompet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        "saldo"
    ];

    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function transaksiDompet(){
        return $this->hasMany('App\Models\TransaksiDompet')->where('status','Dikonfirmasi');
    }
}
