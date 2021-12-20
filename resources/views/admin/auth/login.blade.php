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

        <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/user/login.css') }}" rel="stylesheet">
    </head>
    <body>
        <img src="{{ asset('image/rectangle205.png') }}" alt="" class="img-fluid img-background">
        <div class="login-form col-4">
            <img src="{{ asset('image/logo_gabung.png') }}" alt="" class="mt-2 mx-auto d-block">
            <p class="mt-5 mb-2 text-center"><b>Silahkan Masuk Sebagai Admin</b></p>

            @if (session('status'))
                <label class="small mt-4 mx-3 text-danger">{{ session('status') }} </label>
            @endif
            <form method="POST" action="{{ route('admin.login.action') }}" class=" mx-3">
                @csrf
                <label class="small">Masukkan email anda</label>
                <input class="col-12 input-form" type="email" name="email" placeholder="contoh@gmail.com" value="{{ old('email') }}" required>
                <label class="small">Masukkan kata sandi anda</label>
                <div class="password-box">
                    <input class="col-12 input-form" type="password" name="password" placeholder="*******">
                    <i class="far fa-eye icon-eye" id="togglePassword" style="" onclick="showPassword(this)"></i>
                </div>

                <input class="my-4 col-12 login-btn input-form" type="submit" value="Masuk">
            </form>
        </div>
        <div class="footer">
            <p>Hak Cipta &copy; 2021. Tim Rentalku.</p>
        </div>
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/password-eye.js') }}"></script>
    </body>
</html>