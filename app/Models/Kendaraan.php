<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kategori_id',
        'kota',
        'seat',
        'name',
        'nopol',
        'seat',
        'harga',
        'tahun',
        'transmisi',
        'mesin',
        'warna',
        'supir',
        'image_link',
        'lat',
        'long',
    ];
    protected $user_id = 'int';

    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }
    
    public function kategori(){
        return $this->hasOne('App\Models\Kategori','id','kategori_id');
    }

    public function transaksi(){
        return $this->hasMany('App\Models\Transaksi');
    }

    public function ratingKendaraan(){
        return $this->hasMany('App\Models\RatingKendaraan');
    }
    public function avgRating()
    {
        return $this->ratingKendaraan()
        ->selectRaw('avg(jumlah_bintang) as aggregate, kendaraan_id')
        ->groupBy('kendaraan_id');
    }

}
