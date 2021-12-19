@extends('user.layouts.app')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/search.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="search-container mt-2">
        <div class="search-box-outer mx-auto d-block ">
                <div class="search-box my-3">
                <form action="{{ route('user.search') }}" method="GET">
                    <input class="py-2 px-4 cari-rental d-block" type="text" name="q" id="" placeholder="Cari di rentalku">
                    <button class="py-2 px-4 button"><i class="fa-solid fa-search"></i></button>
                </div>
                
                <div class="search-toggle-box pt-5 search-hidden">
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
                    <p class="text-center mb-0">Kategori</p>
                    <div class="kategori row px-4">
                        @foreach($kategoris as $kategori)
                            <input class="filter-checkbox pilihanKategori-{{ $kategori->name }}" type="checkbox" name="kategori[]" value="{{ $kategori->name }}"/>
                            <div class="kategori-outer col-3 p-1">
                                <div class="kategori-box text-center small kategori-check" for="pilihanKategori-{{ $kategori->name }}">{{ $kategori->name }}</div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row col-12 mb-2">
                        <input type="submit" class="submit-search mx-auto" value="Cari">
                    </div>
                </div>
                
                </form>
            </div>
    </div>
    <div class="tag-container">
        <div class="container">
        <div class="row bg-white py-2">
            <div class="col-6">
                @if($query != "")
                    <span class="tag-label p-1">{{$query}}</span>
                @endif
                
                @if($kota != "")
                    <span class="tag-label p-1">{{$kota}}</span>
                @endif
                @foreach($kategorisQuery as $kategori)
                    <span class="tag-label p-1">{{$kategori}}</span>
                @endforeach
            </div>
            <div class="col-6 d-flex justify-content-end pagination">
                {{ $kendaraans->links('pagination::bootstrap-4') }}
            </div>
        </div>
        </div>
    </div>
    <div id="mobil" class="mt-3">
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
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-end pagination">
            {{ $kendaraans->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function detail(){
            alert('s');
        }
        $(document).ready(function(){
            $('.button').click(function(e){
                if($('.search-toggle-box').hasClass("search-hidden")){
                    $('.search-toggle-box').removeClass('search-hidden');
                }else{
                    $('.search-toggle-box').addClass('search-hidden');
                }
                e.preventDefault();
            });
            $('.cari-rental').focus(function(){
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
    </script>
@endsection
