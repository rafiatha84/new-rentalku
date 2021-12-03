<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class DepositSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("deposits")->insert([
            "user_id" => 5,
            "dompet_id" => 5,
            "jumlah"    => 1000000,
            "status"    => "Dikonfirmasi",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table("dompets")->where('id',5)->update([
            "saldo" => 1000000,
            "updated_at"    => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table("transaksi_dompets")->insert([
            "dompet_id" => 5,
            "jumlah"    => 1000000,
            "status"    => "Dikonfirmasi",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
