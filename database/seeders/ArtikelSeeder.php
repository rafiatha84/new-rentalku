<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        DB::table("artikels")->insert([
            "user_id" => 1,
            "judul" => "Jangan Anggap Enteng Perawatan AC Mobil, Ini Alasannya!",
            "content" => "Tahukah kamu selain mesin mobil, komponen mobil lainnya yang harus diperhatikan adalah kualitas udara di air conditioner (AC)? Pasalnya, AC sudah menjadi fitur pelengkap yang harus ada di setiap mobil. Pengendara tidak perlu membuka kaca jendela untuk menikmati kesegaran udara, cukup menyalakan AC dan tidak perlu takut terkontaminasi dengan bakteri dan virus di luar.



            Sekadar pengetahuan, komponen dalam AC terdiri dari kompresor, evaporator, dryer, expansion valve, kondensor, air filter, dan motor fan. Nah, dari kerja sama semua komponen itu akan menghasilkan AC yang dingin. Lantas pentingkah untuk merawat AC mobil?
            
            
            
            Jawabannya, tentu penting dan harus dilakukan servis jika sudah waktunya apalagi jika AC mobil sudah tidak terasa dingin. Umumnya, perawatan AC mobil dilakukan selama satu tahun sekali, ketika kilometer mobil mencapai angka 5 ribu hingga 10 ribu kilometer.
            
            
            
            Terlebih lagi, di Indonesia ada masanya saat musim panas dan itu membuat pengendara semakin sering menggunakan AC mobil. Perawatan yang dimaksud bisa berupa penggantian kabin air filter, servis evaporator, adanya kebocoran gas karbon, isi freon mobil, dan sebagainya.",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table("artikels")->insert([
            "user_id" => 1,
            "judul" => "Ini Cara Merawat Rem Mobil Tetap Prima Meskipun Jarang Dipakai Saat Pandemi",
            "content" => "Saat ini, beberapa wilayah di Jawa dan Bali masih menerapkan Pemberlakuan Pembatasan Kegiatan Masyarakat (PPKM) atas upaya pencegahan penularan Covid-19. Seperti diketahui, penerapan PPKM ini sudah berlaku sejak Juli 2021 dan terus diperpanjang hingga pertengahan September 2021. 

            Meskipun memiliki level yang berbeda-beda di setiap wilayah, sejumlah perkantoran masih menerapkan bekerja dari rumah atau Work From Home (WFH) dengan aturan yang ditetapkan pemerintah daerah.
            
            Saat pandemi ini, banyak masyarakat yang memarkirkan kendaraan, terutama mobil di garasi rumah masing-masing. Padahal, kendaraan seperti mobil harus tetap dipanaskan agar komponennya tetap prima. Salah satu yang mesti diperhatikan adalah rem mobil.
            
            Rem menjadi komponen paling penting yang terdapat pada mobil. Komponen ini sejatinya berfungsi untuk mengatur laju, sekaligus menghentikan kendaraan tepat pada waktunya. Rem yang tidak berfungsi dengan benar, tentu akan memunculkan risiko kecelakaan bagi si pengendara. Untuk itu, komponen ini mesti dirawat secara rutin terutama di masa pandemi.",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table("artikels")->insert([
            "user_id" => 1,
            "judul" => "Jangan Anggap Enteng Perawatan AC Mobil, Ini Alasannya!",
            "content" => "Udara yang lembab bisa berefek buruk bagi kesehatan. Mulai dari flu, gatal-gatal, gangguan pernafasan, dan sebagainya. Kondisi ini sebaiknya segera ditangani supaya penghuni rumah bisa sehat dan menjalani aktivitas dengan baik.



            Pun dengan kendaraan kamu, menjaga tingkat kelembaban ideal dalam kabin mobil haruslah dilakukan demi kenyamanan dan kesehatan. Terlebih di masa pandemi seperti sekarang, para pemilik kendaraan lebih banyak memarkir kendaraannya lantaran lebih banyak beraktivitas di rumah. 
            
            
            
            Praktis, mobil jarang 'disentuh' sehingga sering lupa untuk memperhatikan kondisi ruang kabin. Padahal memasuki kondisi musim hujan seperti sekarang, pemilik mobil harus ekstra dalam melakukan perawatan kendaraannya, baik eskterior maupun interior.
            
            
            
            Di interior, kondisi alas kaki, pakaian atau payung yang basah saat masuk ke dalam mobil juga bisa mempengaruhi kondisi kabin. Tak hanya lembab, karpet dan jok yang basah bisa memicu bau tidak sedap.
            
            
            
            Kondisi tersebut tentu membuat berkendara jadi tidak nyaman dan dikhawatirkan akan mengganggu konsentrasi.
            
            
            
            Efek tak mengenakan dari membiarkan kabin mobil lembab adalah tumbuhnya jamur di sekitaran jok mobil. Biasanya jamur timbul di sekitar permukaan interior berbahan kulit maupun fabric. 
            
            
            
            Jika terlalu parah bahkan bisa tumbuh di lingkar kemudi,jok, hingga plafon mobil. Penyebab munculnya jamur ini karena ketika terjadi pengembunan malam hari maupun penguapan pada siang hari, tidak ada sirkulasi udara yang terjadi sehingga lama-lama muncul jamur berkembang biak. 
            
            
            
            Pencegahannya sebenarnya sederhana, kamu mesti rutin memanaskan mesin mobil paling tidak dua hari sekali. Dengan begitu ada kesempatan pertukaran udara saat pintu mobil dibuka. Bila perlu, ketika memanaskan sambil buka kaca jendela mobil biar memudahkan sirkulasi udara.
            
            
            
            Mayoritas pemilik mobil mengkamulkan air purifier sebagai salah satu cara menjaga udara dalam mobil tetap bersih dan segar. Alat ini membuat sirkulasi udara lebih baik, apalagi jika Sahabat Garasi suka merokok. 
            
            
            
            Secara umum ada dua tipe pemurni udara, yaitu tipe filter dan tipe penghasil ion. Keduanya memiliki fungsi dan manfaat yang berbeda tergantung kebutuhan pengemudi. ",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table("artikels")->insert([
            "user_id" => 1,
            "judul" => "Wajib Tahu! Usia Mobil Tua, Perhatikan Komponen-komponen Ini",
            "content" => "Usia Mobil Tua, Perhatikan Komponen-komponen Ini.

            Di tengah Pandemi Covid-19 ini kebiasaan masyarakat ada yang berubah ya Sahabat Garasi. Mulai dari kesehatan, pekerjaan dan kendaraan. Untuk kendaraan seperti mobil, jarang digunakan para pemilik karena banyak wilayah yang menerapkan Work From Home (WFH) imbas aturan Pemberlakuan Pembatasan Kegiatan Maayarakat (PPKM) oleh pemerintah.
            
            Mobil yang jarang digunakan selama PPKM juga perlu mendapatkan perawatan berkala, sehingga mobil tetap prima. Apalagi mobil yang berusia 5 tahun ke atas. Hal ini dikarenakan ada beberapa komponen yang memang hanya bisa digunakan maksimal selama 5 tahun saja. Untuk itu, perlu pemeriksaan yang detail untuk mobil tua yang sudah mencapai usia tersebut.
            
            Ini komponen-komponen yang perlu perhatian lebih ketika umur mobil sudah mencapai 5 tahun:",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        // add slider image
        DB::table("sliders")->insert([]);
    }
}
