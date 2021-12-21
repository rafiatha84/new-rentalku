<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <!-- <script src="{{ asset('js/user/login.js') }}" defer></script> -->

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
        <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet" />

        <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/user/register.css') }}" rel="stylesheet">
    </head>
    <body>
        <img src="{{ asset('image/rectangle205.png') }}" alt="" class="img-fluid img-background">
            <div class="login-form col-10 col-lg-8">
                <div class="row">
                <div class="col-12 col-lg-6">
                    <img src="{{ asset('image/logo_gabung.png') }}" alt="" class="img-logo mt-2 mx-auto d-block img-fluid">
                    <p class="text-center mt-5 mb-0"><b>Daftar Pengguna Baru</b></p>
                    <p class="small text-center">Silakan isi formulir disamping ini untuk pendaftaran akun RentalKu Anda!</p>
                </div>
                <div class="col-12 col-lg-6 pt-4">
                @if (session('status'))
                <label class="small mt-4 mx-3 text-danger">{{ session('status') }} </label>
            @endif
                <form action="{{ route('user.register.action') }}" method="POST" class="mx-3">
                    @csrf
                    <label class="small">Nama lengkap anda</label>
                    <input class="col-12 input-form" type="text" name="name" id="" placeholder="Masukkan Nama">
                    <label class="small">Email anda</label>
                    <input class="col-12 input-form" type="email" name="email" id="" placeholder="contoh@gmail.com">
                    <label class="small">Kata sandi anda</label>
                    <div class="password-box">
                        <input class="col-12 input-form" type="password" name="password" id="" placeholder="******">
                        <i class="far fa-eye icon-eye" id="togglePassword" style="" onclick="showPassword(this)"></i>
                    </div>
                    <label class="small">Ketik ulang kata sandi anda</label>
                    <div class="password-box">
                        <input class="col-12 input-form" type="password" name="" id="" placeholder="******">
                        <i class="far fa-eye icon-eye" id="togglePassword" style="" onclick="showPassword(this)"></i>
                    </div>

                    <input class="my-4 col-12 login-btn input-form" type="submit" value="Daftar">
                </form>
                <p class="text-center small"><b><i>Sudah punya akun? <a href="{{ route('user.login') }}">Login</a></i></b></p>
                </div>
                </div>
                
            </div>
        <div class="footer">
            <p>Hak Cipta &copy; 2021. Tim Rentalku.</p>
        </div>
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/password-eye.js') }}"></script>
    </body>
</html>