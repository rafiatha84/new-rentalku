<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "transaksi_id",
        "kendaraan_id",
        "transaksi_dompet_id",
        "waktu_ambil",
        'waktu_kembali',
        "durasi",
        'name',
        'telp',
        'nik',
        'foto_ktp',
        "total_harga",
        "denda",
        "status",
        "lat",
        "long",
        "alamat",
    ];

    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }
    
    public function kendaraan(){
        return $this->hasOne('App\Models\Kendaraan','id','kendaraan_id');
    }

    public function pengemudiTransaksi(){
        return $this->hasOne('App\Models\PengemudiTransaksi','transaksi_id','id');
    }

    public function tanggal_transaksi(){
        return Carbon::createFromTimestamp(strtotime($this->waktu_ambil))->isoFormat('D MMM YYYY');
    }
    public function tanggal_berakhir(){
        return Carbon::createFromTimestamp(strtotime($this->waktu_kembali))->isoFormat('D MMM YYYY');
    }
    public function ratingKendaraan(){
        return $this->hasOne('App\Models\RatingKendaraan','transaksi_id','id');
    }
    public function ratingUser(){
        return $this->hasOne('App\Models\RatingUser','transaksi_id','id');
    }
    public function sopir(){
        if($this->hasOne('App\Models\PengemudiTransaksi','transaksi_id','id')->count() > 0){
            return "Dengan Sopir";
        }
        return "Tanpa Sopir";
    }
    public function belum_rating(){
        if($this->hasOne('App\Models\RatingKendaraan','transaksi_id','id')->count() > 0){
            return false;
        }else{
            return true;
        }
    }
    public function sudah_rating(){
        if($this->hasOne('App\Models\RatingKendaraan','transaksi_id','id')->count() > 0){
            return true;
        }else{
            return false;
        }
    }
}
