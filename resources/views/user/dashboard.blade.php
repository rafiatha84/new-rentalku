@extends('user.layouts.app')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
@endsection

@section('nav')
    <li class="nav-item">
        <a class="nav-link nav-left {{ Route::currentRouteNamed('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">Beranda</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-left {{ Route::currentRouteNamed('user.pesananku') || Route::currentRouteNamed('user.pesananku.selesai') ? 'active' : '' }}" href="{{ route('user.pesananku') }}">PesananKu</a>
    </li>
    <li class="nav-item">
        <a class="nav-link nav-left {{ Route::currentRouteNamed('user.dompetkuku') ? 'active' : '' }}" href="{{ route('user.dompetku') }}">DompetKu</a>
    </li>
@endsection


@section('content')
    <div id="head">
        <div class="head-box">

            <img src="{{ asset('image/rectangle205-new.png') }}" class="img-fluid img-rectangle" alt="">
            <div class="search-box-outer mx-auto d-block">
                <div class="search-box">
                <form action="{{ route('user.search') }}" method="GET">
                    <input class="py-2 px-4 cari-rental d-block" type="text" name="q" id="" placeholder="Cari di rentalku">
                    <button class="py-2 px-4 button"><i class="fa-solid fa-search"></i></button>
                
                </div>
                
                <div class="search-toggle-box pt-5 hidden">
                    <p class="text-center mb-0">Pilihan Kota</p>
                    <div class="kategori row px-4">
                        <input class="filter-checkbox pilihanKota-Surabaya" type="checkbox" name="kota[]" value="Surabaya"/>
                        <div class="kategori-outer col-3 p-1">
                            <div class="kategori-box text-center small kota-check" for="pilihanKota-Surabaya">Surabaya</div>
                        </div>
                        <input class="filter-checkbox pilihanKota-Jakarta" type="checkbox" name="kota[]" value="Jakarta"/>
                        <div class="kategori-outer col-3 p-1">
                            <div class="kategori-box text-center small kota-check" for="pilihanKota-Jakarta">Jakarta</div>
                        </div>
                        <input class="filter-checkbox pilihanKota-Bandung" type="checkbox" name="kota[]" value="Bandung"/>
                        <div class="kategori-outer col-3 p-1">
                            <div class="kategori-box text-center small kota-check" for="pilihanKota-Bandung">Bandung</div>
                        </div>
                        <input class="filter-checkbox pilihanKota-Semarang" type="checkbox" name="kota[]" value="Semarang"/>
                        <div class="kategori-outer col-3 p-1">
                            <div class="kategori-box text-center small kota-check" for="pilihanKota-Semarang">Semarang</div>
                        </div>
                    </div>
                    <p class="text-center mb-0">Kategori</p>
                    <div class="kategori row px-4">
                        @foreach($kategoris as $kategori)
                            <input class="filter-checkbox pilihanKategori-{{ $kategori->name }}" type="checkbox" name="kategori[]" value="{{ $kategori->name }}"/>
                            <div class="kategori-outer col-3 p-1">
                                <div class="kategori-box text-center small kategori-check" for="pilihanKategori-{{ $kategori->name }}">{{ $kategori->name }}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row col-12">
                        <input type="submit" class="submit-search mx-auto" value="Cari">
                    </div>
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
    <div id="mobil">
        <div class="container">
            <div class="row col-12">
            @foreach($kendaraans as $kendaraan)
            <div class="col-4 mb-3" onclick='location.href="{{ route('user.detail-produk',$kendaraan->id) }}"'>
                    <div class="box-border">
                        <div class="img-box img-box-mobil">
                            <img src="{{ asset($kendaraan->image_link) }}" alt="" class="h-100 w-100">
                        </div>
                        <div class="row px-3">
                            <div class="text-box text-box-left p-2 col-6">
                                <label for="" class="mb-0">{{ $kendaraan->kategori->name  }}</label>
                                <p class="mb-0"><b>{{ $kendaraan->name }}</b></p>
                                <p><?php echo ($kendaraan->supir == 1) ? 'Dengan Sopir' : 'Tanpa Sopir'; ?></p>
                            </div>
                            <div class="text-box text-box-right p-2 col-6">
                                <p class="text-right price mb-0">Rp.{{ number_format($kendaraan->harga,0,',','.') }}/ Hari</p>
                                <p class="text-right mb-0 color-base"><i class="fa-solid fa-star star"></i> {{ number_format($kendaraan->rating_kendaraan_avg_jumlah_bintang,1) }}</p>
                                <p class="text-right color-base"><i class=" fa-solid fa-user"></i>{{ $kendaraan->seat }}</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            @endforeach
            </div>
        </div>
    </div>

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
                    if($('.search-toggle-box').hasClass("hidden")){
                        $('.search-toggle-box').removeClass('hidden');
                    }else{
                        $('.search-toggle-box').addClass('hidden');
                    }
                    e.preventDefault();
                });
                $('.cari-rental').focus(function(){
                    $('.search-toggle-box').removeClass('hidden');
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
    </script>
@endsection