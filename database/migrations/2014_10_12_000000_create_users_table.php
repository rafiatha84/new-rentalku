<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->default('user');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image_link')->default('image/profil.png');
            $table->string('nik')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_sim')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kota')->nullable();
            $table->string('telp')->nullable();
            $table->decimal('lat',10,7)->nullable();
            $table->decimal('long',10,7)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
