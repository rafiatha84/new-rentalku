@extends('user.layouts.app')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/detail-produk-ulasan.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="ulasan-produk">
        <div class="container">
            <div class="row col-12">
                <div class="detail-box col-8 offset-2 mt-5 p-0 pb-4">
                    <h4 class="text-center head-produk py-2">Penilaian dan ulasan mobil</h4>
                    <div class="content-wrapper px-2">
                        <h5 class="d-inline">{{ number_format($kendaraan->rating_kendaraan_avg_jumlah_bintang,1) }}</h5> <p class="d-inline">dari {{$kendaraan->ratingKendaraan->count() }} Ulasan</p>
                        <p>
                            <?php 
                                $bintangactive = (int)$kendaraan->rating_kendaraan_avg_jumlah_bintang;
                                $bintangoff=5-$bintangactive; 
                            ?>
                            @for ($i = 0; $i < $bintangactive; $i++)
                                <i class="fa-solid fa-star star-active star-big"></i>
                            @endfor
                            @for ($i = 0; $i < $bintangoff; $i++)
                                <i class="fa-solid fa-star star-big"></i>
                            @endfor
                        </p>
                        <hr class="hr-detail">
                        <h5 class="mb-4">Ulasan Pelanggan</h5>
                        @if($kendaraan->ratingKendaraan->count() > 0)
                            @foreach($kendaraan->ratingKendaraan as $rating)
                            <div class="row">
                                <div class="image-box col-2">
                                    <img src="{{ asset($rating->user->image_link) }}" alt="" srcset="" class="rounded-circle img-ulasan">
                                </div>
                                <div class="col-10">
                                    <?php 
                                        $date = strtotime($rating->created_at);
                                    ?>
                                    <p class="mb-0">{{$rating->user->name}} <span class="waktu small">{{$rating->created_at->diffForHumans();}}</span></p>
                                    <p class="m-0">
                                        <?php 
                                            $bintangactive = (int)$rating->jumlah_bintang;
                                            $bintangoff=5-$bintangactive; 
                                        ?>
                                        @for ($i = 0; $i < $bintangactive; $i++)
                                            <i class="fa-solid fa-star star-active star-big"></i>
                                        @endfor
                                        @for ($i = 0; $i < $bintangoff; $i++)
                                            <i class="fa-solid fa-star star-big"></i>
                                        @endfor
                                    </p>
                                    <p>{{$rating->review}}</p>
                                </div>
                            </div>
                            <br>
                            @endforeach
                            <hr class="hr-detail mt-0">
                        @else
                            <p class="text-center">Masih belum ada Ulasan</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
