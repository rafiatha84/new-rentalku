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
                <input class="col-12" type="email" name="email" placeholder="example@gmail.com" value="{{ old('email') }}" required>
                <label class="small">Masukkan password anda</label>
                <input class="col-12" type="password" name="password" placeholder="*******">

                <input class="my-4 col-12 login-btn" type="submit" value="Masuk">
            </form>
        </div>
        <div class="footer">
            <p>All Right Reserved &copy; 2021. RentalKu Team.</p>
        </div>
    </body>
</html>