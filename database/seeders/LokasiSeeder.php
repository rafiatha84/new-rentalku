<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Hash;
use Carbon\Carbon;

class LokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        DB::table("lokasis")->insert([
            "name" => "Surabaya",
        ]);
        DB::table("lokasis")->insert([
            "name" => "Jakarta",
        ]);
        DB::table("lokasis")->insert([
            "name" => "Bandung",
        ]);
        DB::table("lokasis")->insert([
            "name" => "Semarang",
        ]);
    }
}
