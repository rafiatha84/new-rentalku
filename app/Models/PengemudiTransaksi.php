<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengemudiTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        "pengemudi_id",
        "transaksi_id"
    ];

    public function pengemudi(){
        return $this->hasOne('App\Models\Pengemudi','id','pengemudi_id');
    }

    public function transaksi(){
        return $this->hasOne('App\Models\Transaksi','id','transaksi_id');
    }
}
