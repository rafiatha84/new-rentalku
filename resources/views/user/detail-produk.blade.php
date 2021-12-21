@extends('user.layouts.app')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/detail-produk.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="detail-produk ">
        <div class="container">
            <div class="row col-12">
                <div class="detail-box col-8 offset-2 mt-5 p-0 pb-4">
                    <h4 class="text-center head-produk py-2">Detail Produk</h4>
                    <div class="image-box p-2">
                        <img src="{{ asset($kendaraan->image_link) }}" alt="" srcset="" class="image-produk">
                    </div>
                    <p class="name-produk text-center">{{ $kendaraan->name }}</p>
                    <p class="jenis-produk text-center">{{ $kendaraan->kategori->name }}</p>
                    <p class="harga-produk text-center">Rp.{{ number_format($kendaraan->harga,0,',','.') }}/Hari</p>
                    <hr class="hr-detail mx-2">
                    <div class="row col-12">
                        <div class="col-6">
                            <p class="review">Review {{ number_format($kendaraan->rating_kendaraan_avg_jumlah_bintang,1) }}/{{ number_format($kendaraan->ratingKendaraan->count(),0) }} Ulasan</p>
                            <p>
                                <?php 
                                    $bintangactive = (int)$kendaraan->rating_kendaraan_avg_jumlah_bintang;
                                    $bintangoff=5-$bintangactive; 
                                ?>
                                @for ($i = 0; $i < $bintangactive; $i++)
                                    <i class="fa-solid fa-star star-active"></i>
                                @endfor
                                @for ($i = 0; $i < $bintangoff; $i++)
                                    <i class="fa-solid fa-star"></i>
                                @endfor
                                <a href="{{ route('user.detail-produk.ulasan',$kendaraan->id) }}" class="base-color ulasan-link">Lihat semua ulasan</a>
                            </p>
                        </div>
                        <div class="col-6 pt-3">
                            <a href="{{ route('user.detail-produk.ulasan.pemilik',$kendaraan->user_id) }}" class="btn button-base d-block">Lihat penilaian pemilik mobil</a>
                        </div>
                    </div>
                    <hr class="hr-detail mx-2">
                    <div class="row col-12 mb-2">
                        <div class="col-6 ">
                            <p class="sopir text-right base-color">{{ $kendaraan->user->lokasi->name }} <i class="fa-solid fa-map-marker-alt"></i></p>
                            <p class="seat text-right base-color">{{ $kendaraan->seat }} Penumpang <i class="fa-solid fa-user"></i></p>
                        </div>
                    <div class="col-6 vertikal-line">
                            <p class="transmisi base-color"><i class="fa-solid fa-car base-color"></i> Transmisi {{$kendaraan->transmisi}} </p>
                            <p class="mesin base-color"><i class="fa-solid fa-car base-color"></i> Mesin {{$kendaraan->mesin}}</p>
                            <p class="warna base-color"><i class="fa-solid fa-car base-color"></i> Warna {{$kendaraan->warna}}</p>
                            <p class="tahun base-color"><i class="fa-solid fa-car base-color"></i> Tahun {{$kendaraan->tahun}}</p>
                        </div>
                    </div>
                    <div class="text-center">

                        <a href="{{ route('user.pemesanan.create',$kendaraan->id) }}" class="btn button-yellow">Lanjut Ke pemesanan</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
