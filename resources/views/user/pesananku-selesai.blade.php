@extends('user.layouts.app')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/pesananku.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="detail-produk">
        <div class="container">
            <div class="row col-12 p-0">
                <div class=" col-8 offset-2 mt-5 p-0">
                    <div class="row col-12 p-0 detail-box">
                        <div class="col-6 text-center m-0 pl-2 pr-0">
                            <a href="{{ route('user.pesananku') }}" class="h4 base-color sub-menu-btn d-block m-0 p-2 left href-base">Sedang Dipesan</a>
                        </div>
                        <div class="col-6 text-center m-0 pr-2 pl-0">
                            <a href="{{ route('user.pesananku.selesai') }}" class="h4 base-color sub-menu-btn d-block m-0 p-2 right href-base active">Selesai</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($transaksis->count() > 0)
    <div id="table-pesananku ">
        <div class="container">
            <div class="row col-12 table-box my-4 p-0">
                <table class="table table-pesanan">
                <thead>
                    <tr>
                    <th scope="col" class="text-center">Gambar</th>
                    <th scope="col" class="text-center">Merk Mobil</th>
                    <th scope="col" class="text-center">Jenis Mobil</th>
                    <th scope="col" class="text-center">Tanggal</th>
                    <th scope="col" class="text-center">Sopir</th>
                    <th scope="col" class="text-center">Harga</th>
                    <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksis as $transaksi)
                    <tr>
                        <td class="text-center">
                            <img src="{{ asset($transaksi->kendaraan->image_link) }}" alt="" srcset="" class="image-mobil-tabel">
                        </td>
                        <td class="text-center">{{ $transaksi->kendaraan->name }}</td>
                        <td class="text-center">{{ $transaksi->kendaraan->kategori->name }}</td>
                        <td class="text-center">{{$transaksi->tanggal_transaksi()}} -{{$transaksi->tanggal_berakhir()}} </td>
                        <td class="text-center">{{$transaksi->sopir()}}</td>
                        <td class="text-center">Rp.{{number_format($transaksi->kendaraan->harga,0,',','.')}}/Hari</td>
                        <td>
                            <div class="row col-12">
                                <div class="col-6 text-center">
                                    <a href="{{ route('user.pemesanan.detail',$transaksi->id) }}" class=" button-yellow-primary p-2 d-block">lihat data pemesanan</a>
                                </div>
                                <div class="col-6 text-center">
                                    @if($transaksi->belum_rating())
                                    <span href="" class="href-base button-yellow-secondary p-2 d-block h-100" onclick="show_review(1)">Beri Nilai</span>
                                    @else
                                    <a href="{{ route('user.pemesanan.create',$transaksi->kendaraan->id) }}" class="href-base button-yellow-secondary p-2 d-block h-100">Pesan Lagi</a>
                                    @endif
                                </div>
                            </div> 
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div id="table-pesananku ">
        <div class="container">
            <div class="row col-12 kosong-box pt-5">
                <div class="col-12">
                <img src="{{ asset('image/order-kosong.png') }}" class="d-block mx-auto image-order-kosong" alt="" srcset="">
                <p class="text-center"><b>Belum ada pesanan</b></p>
                <p class="text-center"><i>Ayo buruan pesan sekarang</i></p>
                </div>
                
            </div>
        </div>
    </div>

    @endif

    <div class="modal fade bd-example-modal-lg" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <h4>Nilai Produk</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="image-box col-3">
                        <img src="{{ asset('image/avanza.jpeg') }}" alt="" srcset="" class="img-ulasan">
                    </div>
                    <div class="col-9 align-self-center">
                        <h5 class="mb-0"><b>Toyota Innova Reborn</b></h5>
                        <h5 class="jenis-mobil">Compact MPV</h5>
                    </div>
                </div>
                <div class="row col-12">
                    <ul class="m-0 mb-2 star-box mx-auto">
                        <li><i class="fa-solid fa-star mx-2"></i></li>
                        <li class="active"><i class="fa-solid fa-star mx-2"></i></li>
                        <li class="active"><i class="fa-solid fa-star mx-2"></i></li>
                        <li class="active"><i class="fa-solid fa-star mx-2"></i></li>
                        <li class="active"><i class="fa-solid fa-star mx-2"></i></li>
                    </ul>
                </div>
                <textarea name="review" id="" cols="30" rows="5" placeholder="Beritahu pengguna lain mengapa Anda sangat menyukai produk ini... " class="review-input w-100 px-5 py-2"></textarea>
                <!-- review pemilik -->
                <div class="row">
                    <div class="image-box col-3">
                        <img src="{{ asset('image/profil.png') }}" alt="" srcset="" class="img-ulasan">
                    </div>
                    <div class="col-9 align-self-center">
                        <h5 class="mb-0">Pemilik <b>Toyota Innova Reborn</b></h5>
                        <h5 class="jenis-mobil">Compact MPV</h5>
                    </div>
                </div>
                <div class="row col-12">
                    <ul class="m-0 mb-2 star-box mx-auto">
                        <li><i class="fa-solid fa-star mx-2"></i></li>
                        <li class="active"><i class="fa-solid fa-star mx-2"></i></li>
                        <li class="active"><i class="fa-solid fa-star mx-2"></i></li>
                        <li class="active"><i class="fa-solid fa-star mx-2"></i></li>
                        <li class="active"><i class="fa-solid fa-star mx-2"></i></li>
                    </ul>
                </div>
                <textarea name="review" id="" cols="30" rows="5" placeholder="Beritahu pengguna lain mengapa Anda sangat menyukai pemilik ini... " class="review-input w-100 px-5 py-2"></textarea>
                <!-- review supir -->
                <div class="row">
                    <div class="image-box col-3">
                        <img src="{{ asset('image/profil.png') }}" alt="" srcset="" class="img-ulasan">
                    </div>
                    <div class="col-9 align-self-center">
                        <h5 class="mb-0">Supir <b>Toyota Innova Reborn</b></h5>
                        <h5 class="jenis-mobil">Compact MPV</h5>
                    </div>
                </div>
                <div class="row col-12">
                    <ul class="m-0 mb-2 star-box mx-auto">
                        <li><i class="fa-solid fa-star mx-2"></i></li>
                        <li class="active"><i class="fa-solid fa-star mx-2"></i></li>
                        <li class="active"><i class="fa-solid fa-star mx-2"></i></li>
                        <li class="active"><i class="fa-solid fa-star mx-2"></i></li>
                        <li class="active"><i class="fa-solid fa-star mx-2"></i></li>
                    </ul>
                </div>
                
                <textarea name="review" id="" cols="30" rows="5" placeholder="Beritahu pengguna lain mengapa Anda sangat menyukai pemilik ini... " class="review-input w-100 px-5 py-2"></textarea>
                <div class="row">
                    <div class="col-12 py-2 text-right">
                        <input type="submit" value="Kirim" class="btn button-yellow-primary radius-5 btn-kirim">
                    </div>
                </div>
                <form action='' id="formdelete" method="get">
                </form>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="suksesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <p class="text-center"><i class="far fa-check-circle base-color sukses-icon"></i></p>
                        <h5 class="text-center">Terima kasih telah memberikan penilaian</h5>
                    </div>
                </div>
                <form action='' id="formdelete" method="get">
                </form>
            </div>
        </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function show_review(id){
            $('#reviewModal').modal("show");
        }
        $(document).ready(function(){
            $('.btn-kirim').click(function(e){
                e.preventDefault;
                $('#reviewModal').modal("toggle");
                $('#suksesModal').modal("show");

            });
        });
    </script>

@endsection
