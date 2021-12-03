<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('kendaraan_id');
            $table->foreign('kendaraan_id')->references('id')->on('kendaraans')->onDelete('cascade');
            $table->unsignedBigInteger('transaksi_dompet_id');
            $table->foreign('transaksi_dompet_id')->references('id')->on('transaksi_dompets')->onDelete('cascade');
            $table->datetime('waktu_ambil');
            $table->datetime('waktu_kembali');
            $table->integer('durasi');
            $table->string('name');
            $table->string('telp');
            $table->string('nik');
            $table->string('foto_ktp');
            $table->integer('total_harga');
            $table->integer('denda');
            $table->string('status');
            $table->decimal('lat',10,7)->default(0);
            $table->decimal('long',10,7)->default(0);
            $table->string('alamat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}
