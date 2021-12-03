<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Dompet;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
        ]);
        User::factory(10)->has(Dompet::factory(),'dompet')->create();
        DB::table("users")->where('id',2)->update([
            "role" => "pemilik"
        ]);
        DB::table("users")->where('id',3)->update([
            "role" => "pemilik"
        ]);
        DB::table("users")->where('id',4)->update([
            "role" => "pengemudi"
        ]);
        $this->call([
            TransaksiDompetSeeder::class,
            KategoriSeeder::class,
            KendaraanSeeder::class,
            PengemudiSeeder::class,
            TransaksiSeeder::class,
            ArtikelSeeder::class,
        ]);
        
    }
}