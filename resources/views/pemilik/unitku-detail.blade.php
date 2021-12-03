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
                                <img src="{{ asset('image/avanza.jpeg') }}" alt="" class="image-produk">
                                <h4 class="text-center"><b>Toyota Avanza</b></h4>
                                <h4 class="gray-text text-center">Mini MPV</h4>
                                <h5 class="yellow-text text-center">Rp. 200.000 / Hari</h5>
                                </div>
                            </div>
                            
                            <hr class="hr-black">
                            <p><b>Review</b><span>42.5/5</span></p>
                            <p>
                                <i class="fa-solid fa-star star-active"></i>
                                <i class="fa-solid fa-star star-active"></i>
                                <i class="fa-solid fa-star star-active"></i>
                                <i class="fa-solid fa-star star-active"></i>
                                <i class="fa-solid fa-star"></i>
                                <a href="{{ route('pemilik.unitku.ulasan',3) }}" class="base-color ulasan-link">Lihat semua ulasan</a>
                            </p>
                            <hr class="hr-black">
                            <div class="row col-12 mb-2">
                                <div class="col-6 ">
                                    <p class="seat text-right base-color"> 6 Penumpang <i class="fa-solid fa-user"></i></p>
                                    <p class="sopir text-right base-color"> Tanpa sopir <i class="fa-solid fa-car"></i></p>
                                </div>
                                <div class="col-6 vertikal-line">
                                    <p class="transmisi"><i class="fa-solid fa-car base-color"></i> Transmisi Manual </p>
                                    <p class="mesin"><i class="fa-solid fa-car base-color"></i> Mesin 1998 cc</p>
                                    <p class="warna"><i class="fa-solid fa-car base-color"></i> Warna Silver</p>
                                    <p class="tahun"><i class="fa-solid fa-car base-color"></i> Tahun 2021</p>
                                </div>
                            </div>
                            <div class="row col-12">
                                <div class="col-4 offset-4">
                                    <a href="" class="button-base-secondary py-2 w-100 d-block text-center">Edit</a>
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
