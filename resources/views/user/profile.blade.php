@extends('user.layouts.app')

@section('css')
    <link href="{{ asset('css/user/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="head">
        <div class="head-box">
            <img src="{{ asset('image/rectangle205.png') }}" class="img-fluid img-rectangle" alt="">
            
            <!-- <img src="{{ asset('image/mobil-round.png') }}" alt="" class="mobil img-fluid mx-auto d-block"> -->
        </div>
    </div>
    <div id="profile">
        <div class="profile-outer w-100">
        <div class="background-box mx-auto col-6">
                <img src="{{ asset('image/city.png') }}" alt="" class="img-fluid img-city w-100">
            </div>
            <div class="profile-box mx-auto col-6 p-4">
                    
                    <div class="image-outer">
                        <div class="image-box d-inline-block">
                            <img src="{{ asset(Auth::user()->image_link) }}" class="rounded-circle foto-profile" id="foto-profile-image">
                            <input type="file" name="" id="profile-input" class="d-none" onchange="previewFile(this,'#foto-profile-image');">
                            <!-- <button class="btn btn-camera" onclick="click_input('#profile-input')"><i class="fa-solid fa-camera color-base"></i></button> -->
                        </div>
                    </div>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="row col-12">
                    <div class="col-6 offset-3">
                        <label for="" class="mb-0">Nama</label>
                        <input type="text" name="" class="d-block w-100 input-style px-2 py-3" placeholder="Masukkan nama" value="{{ Auth::user()->name }}" disabled>
                    </div>
                    <div class="col-6 offset-3">
                        <label for="" class="mb-0">Tanggal Lahir</label>
                        <input type="text" name="" class="d-block w-100 input-style px-2 py-3" placeholder="Masukkan nama" value="{{ Auth::user()->name }}" disabled>
                    </div>
                    <div class="col-6 offset-3">
                        <label for="" class="mb-0">No Telepon</label>
                        <input type="text" name="" class="d-block w-100 input-style px-2 py-3" placeholder="Masukkan No Telp" value="{{ Auth::user()->telp }}" disabled>
                    </div>
                    <div class="col-6 offset-3">
                        <label for="" class="mb-0">Alamat</label>
                        <input type="text" name="" class="d-block w-100 input-style px-2 py-3" placeholder="Masukkan alamat" value="{{ Auth::user()->alamat }}" disabled>
                    </div>
                    <div class="col-6 offset-3">
                        <label for="" class="mb-0">Email</label>
                        <input type="text" name="" class="d-block w-100 input-style px-2 py-3" placeholder="Masukkan email" value="{{ Auth::user()->email }}" disabled>
                    </div>
                    <div class="col-6 offset-3 mt-4">
                        <a href="{{ route('user.profile.edit') }}" class="btn d-block w-100 button-base-secondary px-2 py-2">Ubah</a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
