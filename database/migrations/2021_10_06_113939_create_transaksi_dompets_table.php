<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiDompetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_dompets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('dompet_id');
            $table->foreign('dompet_id')->references('id')->on('dompets');
            $table->string('name'); //topup , penarikan, pemasukan
            $table->integer('jumlah');
            $table->integer('kode_unik')->default(0);
            $table->string("bank")->nullable();
            $table->string("no_rek")->nullable();
            $table->string('status')->default("Proses");
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
        Schema::dropIfExists('transaksi_dompets');
    }
}
