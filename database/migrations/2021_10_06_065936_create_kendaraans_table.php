<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendaraans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')->references('id')->on('kategoris')->onDelete('cascade');
            $table->text('name');
            $table->text('kota');
            $table->integer('seat');
            $table->text('nopol');
            $table->integer('harga');
            $table->integer('tahun');
            $table->text('transmisi');
            $table->text('mesin');
            $table->text('warna');
            $table->boolean('supir');
            $table->string('image_link')->default('image/profil.png');
            $table->decimal('lat',10,7)->default(0);
            $table->decimal('long',10,7)->default(0);
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
        Schema::dropIfExists('kendaraans');
    }
}
