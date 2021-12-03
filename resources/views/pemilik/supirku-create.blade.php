@extends('user.layouts.pemilik')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/supirku-edit.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="detail-produk mb-4">
        <div class="container">
            <div class="row col-12">
                <div class="detail-box col-12 mt-5 p-0 pb-4">
                    <h4 class="text-center head-produk py-2 mb-0">Supirku</h4>
                    <div class="row mx-auto mt-0 h-100 pb-4">
                        <div class="col-4 sidebar-left px-0">
                            <ul class="nav flex-column px-0">
                                <li class="nav-item">
                                    <a href="{{  route('pemilik.supirku') }}" class="nav-link sidebar-navlink ">Sopirku</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{  route('pemilik.supirku.create') }}" class="nav-link sidebar-navlink active">Tambah Sopir</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-8 py-2 sidebar-right">
                            <h4><b>Tambah Data Sopir</b></h4>
                            <hr class="m-0 hr-base">
                            <div class="row col-12 mb-2">
                                <div class="col-6 py-2">
                                    <p class="m-0">Nama Lengkap</p>
                                    <input type="text" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan Nama" value="Aris">

                                    <p class="m-0">Email</p>
                                    <input type="text" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan Email" value="Aris@gmail.com">
                                    <p class="m-0">Password</p>
                                    <input type="password" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan Email" value="Aris@gmail.com">
                                    
                                </div>
                                <div class="col-6 py-2 vertikal-line-base">
                                    <p class="m-0">Upload Foto KTP</p>
                                    <div class="element w-100 radius-20">
                                        <i class="fa-solid fa-camera base-color camera-icon" onclick="click_input('#foto-ktp');"></i><span class="name">No file selected</span>
                                        <input type="file" name="" id="foto-ktp" placeholder="" class="input-form input-foto" onchange="previewFile(this,'#foto-ktp-image');">
                                    </div>
                                    <img src="{{ asset('image/avanza.jpeg') }}" alt="" id="foto-ktp-image" class="image-produk img-upload w-100 mt-2 hidden">
                                    <p class="m-0">Upload Foto SIM A</p>
                                    <div class="element w-100 radius-20 ">
                                        <i class="fa-solid fa-camera base-color camera-icon" onclick="click_input('#foto-sim');"></i><span class="name" id="foto-sim-name">No file selected</span>
                                        <input type="file" name="" id="foto-sim" placeholder="" class="input-form input-foto" onchange="previewFile(this,'#foto-sim-image');">
                                    </div>
                                    <img src="{{ asset('image/avanza.jpeg') }}" alt="" id="foto-sim-image" class="image-produk img-upload w-100 mt-2 hidden">
                                </div>
                            </div>
                            
                            <div class="row col-12">
                                <div class="col-4 offset-4">
                                    <a href="{{ route('pemilik.supirku.edit',2) }}" class="button-yellow py-2 w-100 d-block text-center">Tambah Sopir</a>
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
    <script>
        $(document).ready(function() {
        });
    </script>
@endsection
