@extends('user.layouts.pemilik')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/unitku-detail.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="detail-produk mb-4">
        <div class="container">
            <div class="row col-12">
                <div class="detail-box col-12 mt-5 p-0 pb-4">
                    <h4 class="text-center head-produk py-2 mb-0">Unit</h4>
                    <div class="row mx-auto mt-0 h-100 pb-4">
                        <div class="col-4 sidebar-left px-0">
                            <ul class="nav flex-column px-0">
                                <li class="nav-item">
                                    <a href="{{  route('pemilik.unitku') }}" class="nav-link sidebar-navlink active">Galeri Unitku</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{  route('pemilik.unitku.create') }}" class="nav-link sidebar-navlink">Tambah Unit Rental</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-8 py-2 sidebar-right">
                            <div class="row col-12">
                                <div class="col-4 offset-4">
                                <img src="{{ asset($kendaraan->image_link) }}" alt="" class="image-produk">
                                <h4 class="text-center"><b>{{ $kendaraan->name }}</b></h4>
                                <h4 class="gray-text text-center">{{ $kendaraan->kategori->name }}</h4>
                                <h5 class="yellow-text text-center">Rp.{{ number_format($kendaraan->harga,0,',','.') }} / Hari</h5>
                                </div>
                            </div>
                            
                            <hr class="hr-black">
                            <p><b>Review </b><span>{{ number_format($kendaraan->rating_kendaraan_avg_jumlah_bintang,1) }}/{{ number_format($kendaraan->ratingKendaraan->count(),0) }}</span></p>
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
                                <a href="{{ route('pemilik.unitku.ulasan',$kendaraan->id) }}" class="base-color ulasan-link">Lihat semua ulasan</a>

                            </p>
                            <hr class="hr-black">
                            <div class="row col-12 mb-2">
                                <div class="col-6 ">
                                    <p class="seat text-right base-color"> {{ $kendaraan->seat }} Penumpang <i class="fa-solid fa-user"></i></p>
                                    <!-- <p class="sopir text-right base-color"> Tanpa sopir <i class="fa-solid fa-car"></i></p> -->
                                </div>
                                <div class="col-6 vertikal-line">
                                    <p class="transmisi"><i class="fa-solid fa-car base-color"></i> Transmisi {{ $kendaraan->transmisi }} </p>
                                    <p class="mesin"><i class="fa-solid fa-car base-color"></i> Mesin {{ $kendaraan->transmisi }}</p>
                                    <p class="warna"><i class="fa-solid fa-car base-color"></i> Warna {{ $kendaraan->warna }}</p>
                                    <p class="tahun"><i class="fa-solid fa-car base-color"></i> Tahun {{ $kendaraan->tahun }}</p>
                                </div>
                            </div>
                            <div class="row col-12">
                                <div class="col-4 offset-4">
                                    <a href="{{ route('pemilik.unitku.edit',$kendaraan->id) }}" class="button-base-secondary py-2 w-100 d-block text-center">Ubah</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
