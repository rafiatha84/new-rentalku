<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // proses bayar
        $transaksidompet = [
            ['user_id' => 5,'dompet_id' => 5 , 'name' => "pembayaran" , "jumlah" => -350000 , "status" => "Dikonfirmasi" , 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['user_id' => 5,'dompet_id' => 5 , 'name' => "pembayaran" , "jumlah" => -200000 , "status" => "Dikonfirmasi" , 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];
        DB::table("transaksi_dompets")->insert($transaksidompet);

        //tambah pemasukan
        $transaksidompet = [
            ['user_id' => 2,'dompet_id' => 2 , 'name' => "pemasukan" , "jumlah" => +350000 , "status" => "Dikonfirmasi" , 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['user_id' => 2,'dompet_id' => 2 , 'name' => "pemasukann" , "jumlah" => +200000 , "status" => "Dikonfirmasi" , 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];
        DB::table("transaksi_dompets")->insert($transaksidompet);

        DB::table("dompets")->where('id',5)->update([
            "saldo" => 450000,
            "updated_at"    => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table("dompets")->where('id',2)->update([
            "saldo" => 550000,
            "updated_at"    => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $transaksi_data = [
            ['user_id' => 5, "kendaraan_id" => 1, "transaksi_dompet_id" => 1 ,"waktu_ambil" => Carbon::now()->format('Y-m-d H:i:s'),"waktu_kembali" => Carbon::now()->format('Y-m-d H:i:s'), "durasi" => 1,"name"=>"erik","telp"=>"088805189145","nik"=>"357811310501001","foto_ktp"=>"image/ktp.jpg", "total_harga" => 350000,"denda" => 0, "lat" => 0, "long" => 0,"alamat" => "jl.kampung seng 77, Surabaya", "status" => "Selesai" , 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s') ],
            ['user_id' => 5, "kendaraan_id" => 2, "tranksasi_dompet_id" => 2, "waktu_ambil" => Carbon::now()->format('Y-m-d H:i:s'),"waktu_kembali" => Carbon::now()->format('Y-m-d H:i:s'), "durasi" => 1,"name"=>"erik","telp"=>"088805189145","nik"=>"357811310501001","foto_ktp"=>"image/ktp.jpg", "total_harga" => 200000,"denda" => 0, "lat" => 0, "long" => 0,"alamat" => "jl.kampung seng 77, Surabaya", "status" => "Selesai" , 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s') ],
        ];
        DB::table("transaksis")->insert($transaksi_data);

        $pengemuditransaksi = [
            ['pengemudi_id' => 1, "transaksi_id" => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]
        ];
        DB::table("pengemudi_transaksis")->insert($pengemuditransaksi);


        

        //melakukan pembuatan chat room dgn driver apabila memesan supir bagi yang telah memesan
        $chat_room = [
            ['user_id' => 3, "user_to_id" => 5]
        ];
        DB::table("chat_rooms")->insert($chat_room);
        $message = [
            ['user_id' => 3, "chat_room_id" => 1, "message" => "Terima kasih telah memesan driver", 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];
        DB::table("messages")->insert($message);

        //melakukan pembuatan chat room dgn pemilik bagi yang telah memesan
        $chat_room = [
            ['user_id' => 2, "user_to_id" => 5]
        ];
        DB::table("chat_rooms")->insert($chat_room);
        $message = [
            ['user_id' => 2, "chat_room_id" => 2, "message" => "Terima kasih telah menyewa mobil dengan kami", 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];
        DB::table("messages")->insert($message);

        // melakukan rating & review terhadap kendaraan
        $rating_kendaraan = [
            ['user_id' => 5, "transaksi_id" => 1, "kendaraan_id" => 1, "jumlah_bintang" => 5 , 'review' => "kondisi mobilnya bagus suka banget", 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]
        ];
        DB::table("rating_kendaraans")->insert($rating_kendaraan);

        // melakukan rating & review terhadap pemilik
        $rating_user = [
            ['user_id' => 5, "transaksi_id" => 1, "user_to_id" => 2, "jumlah_bintang" => 5, 'review' => "pemiliknya baik banget", 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]
        ];
        DB::table("rating_users")->insert($rating_user);

        //upload slider
        // melakukan rating & review terhadap pemilik
        $sliders = [
            ['image' => 'image/slider-1.png' , 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['image' => 'image/slider-2.png' , 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['image' => 'image/slider-3.png' , 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['image' => 'image/slider-2.png' , 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ];
        DB::table("sliders")->insert($sliders);
    }
}
