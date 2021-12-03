<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kategori = [
            ['name'=> "MVP", 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name'=> "Sedan", 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name'=> "SUV", 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name'=> "Bus", 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];
        DB::table("kategoris")->insert($kategori);
        $rekenings = [
            ["tipe" => "bank",'name'=>"Bank Central Asia", "singkatan"=> "BCA", "no_rek" => "82763231","image_link" => "image/bank-bca.png",'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ["tipe" => "bank",'name'=>"Bank Negara Indonesia","singkatan" => "BNI", "no_rek" => "3823731","image_link" => "image/bank-bni.png", 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ["tipe" => "bank",'name'=>"Bank Rakyat Indonesia","singkatan" => "BRI", "no_rek" => "1287163231","image_link" => "image/bank-bri.png", 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ["tipe" => "e-wallet",'name'=>"Gopay","singkatan" => "gopay", "no_rek" => "085101440330","image_link" => "image/gopay.png", 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ["tipe" => "e-wallet",'name'=>"Ovo","singkatan" => "ovo", "no_rek" => "085101440330","image_link" => "image/ovo.png", 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ["tipe" => "e-wallet",'name'=>"Dana","singkatan" => "dana", "no_rek" => "085101440330","image_link" => "image/dana.png", 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ["tipe" => "e-wallet",'name'=>"Shopeepay","singkatan" => "shopeepay", "no_rek" => "085101440330","image_link" => "image/shopeepay.png", 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];
        DB::table("rekenings")->insert($rekenings);
    }
}
