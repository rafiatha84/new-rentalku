<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;

    protected $fillable = [
        "tipe",
        "name",
        "singkatan",
        "no_rek",
        "atas_nama",
        "image_link"
    ];
}
