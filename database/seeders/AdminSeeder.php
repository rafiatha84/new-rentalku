<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Hash;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        DB::table("users")->insert([
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make("admin123"),
            "role" => "admin",
            "created_at" => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table("dompets")->insert([
            "user_id" => 1,
            "saldo" => 0,
            "created_at" => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
