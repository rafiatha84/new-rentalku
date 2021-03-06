@extends('user.layouts.pemilik')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/unitku.css') }}" rel="stylesheet">
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
                            @if($kendaraans->count()>0)
                                @foreach($kendaraans as $kendaraan)
                                <!-- unitku -->
                                <div class="row  unitku-row py-2" onclick='location.href="{{ route('pemilik.unitku.detail',$kendaraan->id) }}"'>
                                    <div class="image-box col-3">
                                        <img src="{{ asset($kendaraan->image_link) }}" alt="" srcset="" class="img-ulasan">
                                    </div>
                                    <div class="col-9 align-self-center">
                                        <h5 class="mb-0"><b>{{$kendaraan->name}}</b></h5>
                                        <h5 class="jenis-mobil">{{$kendaraan->kategori->name}}</h5>
                                    </div>
                                </div>
                                <hr class="m-0">
                                <!-- End unitku -->
                                @endforeach
                            @else
                            <div class="row py-5">
                                <div class="col-12">
                                    <h4 class="text-center">Belum ada unit</h4>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
