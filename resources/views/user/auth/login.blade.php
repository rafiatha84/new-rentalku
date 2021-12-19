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
    <link href="{{ asset('css/user/login.css') }}" rel="stylesheet">
    </head>
    <body>
        <img src="{{ asset('image/rectangle205.png') }}" alt="" class="img-fluid img-background">
        <div class="login-form col-10 col-lg-4">
            <img src="{{ asset('image/logo_gabung.png') }}" alt="" class="mt-2 mx-auto d-block">
            <p class="mt-5 mb-2 text-center"><b>Silahkan Masuk</b></p>

            @if (session('status'))
                <label class="small mt-4 mx-3 text-danger">{{ session('status') }} </label>
            @endif
            @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
            <form method="POST" action="{{ route('user.login.action') }}" class=" mx-3">
                @csrf
                <label class="small">Masukkan email anda</label>
                <input class="col-12 input-form" type="email" name="email" placeholder="contoh@gmail.com" value="{{ old('email') }}" required>
                <label class="small">Masukkan Kata sandi anda</label>
                <div class="password-box">
                    <input class="col-12 input-form" type="password" name="password" placeholder="*******">
                    <!-- <button class="py-2 px-4 button"><i class="fa-solid fa-search"></i></button> -->
                </div>

                <input class="my-4 col-12 login-btn input-form" type="submit" value="Masuk">
            </form>
            <p class="text-center small"><b><i>Belum punya akun? <a href="{{ route('user.register') }}">Daftar</a></i></b></p>
            <p class="text-center small"><b><i>Lupa kata sandi? <a href="{{ route('forget.password.get') }}">Atur Kata sandi</a></i></b></p>
        </div>
        <div class="footer">
            <p>Hak Cipta &copy; 2021. Tim Rentalku.</p>
        </div>
    </body>
</html>