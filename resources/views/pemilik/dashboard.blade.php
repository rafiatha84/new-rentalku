@extends('user.layouts.pemilik')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

@endsection

@section('nav')
    
@endsection

@section('dropdown')
    <a class="dropdown-item" href="{{ route('user.profile') }}">Profil</a>
    <a class="dropdown-item" href="{{ route('user.profile') }}">SopirKu</a>
    <a class="dropdown-item" href="{{ route('user.profile') }}">Penilaian dan Ulasan</a>
    <a class="dropdown-item" href="{{ route('user.dashboard') }}">Kembali ke Penyewa</a>
    <a class="dropdown-item" href="{{ route('user.logout') }}"
        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('user.logout') }}" method="GET" class="d-none">
        @csrf
    </form>
@endsection

@section('content')
    <div id="head">
        <div class="head-box">

            <img src="{{ asset('image/rectangle205-new.png') }}" class="img-fluid img-rectangle" alt="">
            <div class="search-box-outer mx-auto d-block">
                <div class="search-box">
                <form action="{{ route('user.search') }}" method="GET">
                    <div class="py-2 px-4 cari-rental pemilik-lokasi d-block" type="text" name="q" id="" placeholder="Cari di rentalku"><i class="fa-solid fa-map-marker-alt"></i> Pilih lokasi garasi anda</div>
                    <button class="py-2 px-4 button"><i class="fa-solid fa-location-arrow"></i></button>
                </div>
                
                <div class="search-toggle-box pt-5 search-hidden">
                    <form action="{{ route('pemilik.update.kota') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <p class="text-center mb-0">Pilihan Kota</p>
                        <div class="kategori row px-4">
                            <input class="filter-checkbox pilihanKota-Surabaya" type="radio" name="kota" value="Surabaya"/>
                            <div class="kategori-outer col-3 p-1">
                                <div class="kategori-box text-center small kota-check" for="pilihanKota-Surabaya">Surabaya</div>
                            </div>
                            <input class="filter-checkbox pilihanKota-Jakarta" type="radio" name="kota" value="Jakarta"/>
                            <div class="kategori-outer col-3 p-1">
                                <div class="kategori-box text-center small kota-check" for="pilihanKota-Jakarta">Jakarta</div>
                            </div>
                            <input class="filter-checkbox pilihanKota-Bandung" type="radio" name="kota" value="Bandung"/>
                            <div class="kategori-outer col-3 p-1">
                                <div class="kategori-box text-center small kota-check" for="pilihanKota-Bandung">Bandung</div>
                            </div>
                            <input class="filter-checkbox pilihanKota-Semarang" type="radio" name="kota" value="Semarang"/>
                            <div class="kategori-outer col-3 p-1">
                                <div class="kategori-box text-center small kota-check" for="pilihanKota-Semarang">Semarang</div>
                            </div>
                        </div>
                        <div class="row col-12 mb-2">
                            <input type="submit" class="submit-search mx-auto" value="Pilih lokasi">
                        </div>
                    </form>
                </div>
                
                </form>
            </div>
            <div class="text-px">
            
            </div>
            
            <img src="{{ asset('image/mobil-round.png') }}" alt="" class="mobil img-fluid mx-auto d-block">
        </div>
    </div>
    <div id="section-2" >
        <div class="container">
            <div class="row col-12 mb-5" style="opacity:0;">
                <div class="col-4">
                    <h4><b>Anda punya mobil nganggur?</b></h4>
                    <h4 class="">Segera daftarin aja di RentalKu!</h4>
                    <a href="" class="btn-daftar  d-inline-block px-5 py-2">Daftar Sekarang</a>
                </div>
            </div>
            <div class="row col-lg-8 offset-lg-2 col-12 mb-5 mt-5">
                <h4 class="text-center">Kami menawarkan Jasa Sewa Mobil Surabaya dan beberapa kota besar lainnya di Indonesia, dengan servis yang aman dan terpercaya bagi setiap orang, baik untuk keperluan bisnis, keluarga maupun liburan</h4>
            </div>
        </div>
    </div>
    @if(Auth::user()->role == "user" || Auth::user()->role == "admin")
    <div id="mobil">
        <div class="container">
            <div class="row col-12">
            @for($i=1;$i<=3;$i++)
                <div class="col-4 mb-3">
                    <div class="box-border">
                        <div class="img-box img-box-mobil">
                        <img src="{{ asset('image/avanza.jpeg') }}" alt="" class="h-100 w-100">
                        </div>
                        <div class="row px-3">
                            <div class="text-box text-box-left p-2 col-6">
                                <label for="" class="mb-0">Mini mvp</label>
                                <p class="mb-0"><b>Toyota Avanza</b></p>
                                <p>Tanpa sopir</p>
                            </div>
                            <div class="text-box text-box-right p-2 col-6">
                                <p class="text-right price mb-0">Rp. 300.000/ Hari</p>
                                <p class="text-right mb-0 color-base"><i class="fa-solid fa-star star"></i> 5.0</p>
                                <p class="text-right color-base"><i class=" fa-solid fa-user"></i> 6</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            @endfor
            </div>
        </div>
    </div>
    @else
    <div class="row col-12 text mt-5 pt-5 mb-5">
                <h4 class="text-center">Kami menawarkan Jasa Sewa Mobil Surabaya dan beberapa kota besar lainnya di Indonesia, dengan servis yang aman dan terpercaya bagi setiap orang, baik untuk keperluan bisnis, keluarga maupun liburan</h4>
    </div>
    @endif

            <div class="row col-12 mt-4 mb-2 your-class">
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

@endsection

@section('js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function(){
                $('.your-class').slick({
                    infinite: true,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    centerMode: true
                });
                $('.button').click(function(e){
                    if($('.search-toggle-box').hasClass("search-hidden")){
                        $('.search-toggle-box').removeClass('search-hidden');
                    }else{
                        $('.search-toggle-box').addClass('search-hidden');
                    }
                    e.preventDefault();
                });
                $('.cari-rental').click(function(){
                    $('.search-toggle-box').removeClass('search-hidden');
                });
                $('.kategori-check').click(function(e){
                    nama = $(e.currentTarget).text();
                    var classList = $(e.currentTarget).attr("for");
                    element = '.'+classList;
                    if($(element).is(":checked")){
                        $(element).prop('checked', false);
                    }else{
                        $(element).prop('checked', true);
                    }                 
                });
                $('.kota-check').click(function(e){
                    nama = $(e.currentTarget).text();
                    var classList = $(e.currentTarget).attr("for");
                    element = '.'+classList;
                    if($(element).is(":checked")){
                        $(element).prop('checked', false);
                    }else{
                        $(element).prop('checked', true);
                    }                 
                });
        });
        @if (session('status'))
            alert("a");
        @endif
    </script>
@endsection