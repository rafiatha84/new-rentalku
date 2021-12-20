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
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <form action="{{ route('user.profile.edit.action') }}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    @csrf
                    <div class="image-outer">
                        <div class="image-box d-inline-block">
                            <img src="{{ asset(Auth::user()->image_link) }}" class="rounded-circle foto-profile" id="foto-profile-image">
                            <input type="file" name="image" id="profile-input" class="d-none" onchange="previewFile(this,'#foto-profile-image');">
                            <label class="btn btn-camera" for="profile-input"><i class="fa-solid fa-camera color-base"></i></label>
                        </div>
                    </div>
                    
                <div class="row col-12 mt-5">
                    <div class="col-6 offset-3">
                        <label for="" class="mb-0">Nama</label>
                        <input type="text" name="name" class="d-block w-100 input-style px-2 py-3" value="{{ Auth::user()->name }}" required>
                    </div>
                    <div class="col-6 offset-3">
                        <label for="" class="mb-0">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="" class="d-block w-100 input-style px-2 " style="vertical-align:center;" value="{{ Auth::user()->tanggal_lahir }}">
                    </div>
                    <div class="col-6 offset-3">
                        <label for="" class="mb-0">No Telepon</label>
                        <input type="text" name="telp" class="d-block w-100 input-style px-2 py-3" value="{{ Auth::user()->telp }}" placeholder="Masukkan no telp" required>
                    </div>
                    <div class="col-6 offset-3">
                        <label for="" class="mb-0">Alamat</label>
                        <input type="text" name="alamat" class="d-block w-100 input-style px-2 py-3" value="{{ Auth::user()->alamat }}" placeholder="Masukkan alamat" required>
                    </div>
                    <div class="col-6 offset-3">
                        <label for="" class="mb-0">Email</label>
                        <input type="text" name="email" class="d-block w-100 input-style px-2 py-3" value="{{ Auth::user()->email }}" placeholder="Masukkan Email" required>
                    </div>
                    <div class="col-6 offset-3">
                        <label for="" class="mb-0">Kata sandi Lama</label>
                        <div class="password-box">
                            <input type="password" name="password" class="d-block w-100 input-style px-2 py-3" placeholder="Masukkan Password Lama" value="">
                            <i class="far fa-eye icon-eye" id="togglePassword" style="" onclick="showPassword(this)"></i>
                        </div>
                    </div>
                    <div class="col-6 offset-3">
                        <label for="" class="mb-0">Kata sandi Baru</label>
                        <div class="password-box">
                            <input type="password" name="new_password" class="d-block w-100 input-style px-2 py-3" placeholder="Masukkan Password Baru">
                            <i class="far fa-eye icon-eye" id="togglePassword" style="" onclick="showPassword(this)"></i>
                        </div>
                    </div>
                    <div class="col-6 offset-3">
                        <label for="" class="mb-0">Ketik Ulang Kata sandi Baru</label>
                        <div class="password-box">
                            <input type="password" name="new_password_again" class="d-block w-100 input-style px-2 py-3" placeholder="Masukkan Password Baru">
                            <i class="far fa-eye icon-eye" id="togglePassword" style="" onclick="showPassword(this)"></i>
                        </div>
                    </div>
                    <div class="col-6 offset-3 mt-4">
                        <button type="submit" class="btn d-block w-100 button-base-secondary px-2 py-2">Simpan</button>
                    </div>
                </div>
                </form>
            </div>
            
        </div>
    </div>
@endsection
