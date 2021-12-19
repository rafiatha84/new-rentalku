<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

    <!-- Styles -->
    <!--load all Font Awesome styles -->
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet" />

    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
</head>

<body style="background-image:url({{url('image/v996-009.png')}})">
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" style="width:150px;" href="{{ url('/') }}">
                    <img src="{{ asset('image/logo_gabung.png') }}" alt="" class="img-fluid">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('user.login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.login') }}">{{ __('Masuk') }}</a>
                                </li>
                            @endif

                            @if (Route::has('user.register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.register') }}">{{ __('Daftar') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.dashboard') }}">Dasbor</a>
                                </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-user"></i>Halo, {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('user.profile') }}">Data Diri</a>
                                    <a class="dropdown-item" href="{{ route('pemilik.register') }}">Jadi pemilik mobil</a>
                                    <a class="dropdown-item" href="{{ route('user.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('user.logout') }}" method="GET" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    <div id="head">
        <div class="head-box">
            <img src="{{ asset('image/rectangle205-new.png') }}" class="img-fluid img-rectangle" alt="">
            
            <img src="{{ asset('image/mobil-round.png') }}" alt="" class="mobil img-fluid mx-auto d-block">
        </div>
    </div>
    <div id="section-2">
        <div class="container">
            <div class="row col-lg-12 mb-5">
                <div class="col-lg-4 col-4">
                    <h4><b>Anda punya mobil nganggur?</b></h4>
                    <h4 class="">Segera daftarin aja di RentalKu!</h4>
                    <a href="" class="btn-daftar  d-inline-block px-5 py-2">Daftar Sekarang</a>
                </div>
                <div class="col-lg-4 offset-lg-4 col-4 offset-4 text-center">
                    <h4 class="text-right"><b>Mau liburan keluarga
                    tapi nggak ada mobil?</b></h4>
                    <h4 class="text-right">Buruan rental sekarang juga!</h4>
                    <a href="{{ route('user.dashboard') }}" class="btn-rental float-right d-inline-block px-5 py-2">Masuk Sekarang</a>
                </div>
            </div>
            <div class="row col-lg-8 offset-lg-2 col-12 mb-5 mt-5">
                <h4 class="text-center">Kami menawarkan Jasa Sewa Mobil Surabaya dan beberapa kota besar lainnya di Indonesia, dengan servis yang aman dan terpercaya bagi setiap orang, baik untuk keperluan bisnis, keluarga maupun liburan</h4>
            </div>
        </div>
    </div>

    <div class="row col-lg-12 mt-4 mb-2 your-class">
        @foreach($sliders as $slider)
        <div class="col-12 mb-3">
            <div class="box-border">
                <div class="img-box-new">
                    <img src="{{ asset($slider->image) }}" alt="" class="h-100 w-100 img-slider">
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div id="footer">
        <div class="row col-lg-12 pt-4">
            <p class="mx-auto">Hak Cipta &copy; 2021. Tim Rentalku.</p>
        </div>
    </div>
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function(){
                $('.your-class').slick({
                    infinite: true,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    centerMode: true
                });
        });
    </script>
</body>
</html>
