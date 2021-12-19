@extends('user.layouts.pemilik')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/detail-produk-ulasan.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="ulasan-produk">
        <div class="container">
            <div class="row col-12">
                <div class="detail-box col-10 offset-1 mt-5 p-0 pb-4">
                    <h4 class="text-center head-produk py-2">Penilaian dan ulasan mobil</h4>
                    <div class="content-wrapper px-2">
                        <h5 class="d-inline">4.2</h5> <p class="d-inline">dari 5</p>
                        <p>
                            <i class="fa-solid fa-star star-active star-big"></i>
                            <i class="fa-solid fa-star star-active star-big"></i>
                            <i class="fa-solid fa-star star-active star-big"></i>
                            <i class="fa-solid fa-star star-active star-big"></i>
                            <i class="fa-solid fa-star star-big"></i>
                        </p>
                        <hr class="hr-detail">
                        <h5 class="mb-4">Ulasan Pelanggan</h5>
                        <div class="row">
                            <div class="image-box col-2">
                                <img src="{{ asset(Auth::user()->image_link) }}" alt="" srcset="" class="rounded-circle img-ulasan">
                            </div>
                            <div class="col-10">
                                <p class="mb-0">dewi <span class="waktu small">1d</span></p>
                                <p class="m-0">
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star"></i>
                                </p>
                                <p>ulasann Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure, sint consectetur. Odio, architecto laudantium. Quaerat necessitatibus quisquam sint, saepe aspernatur nihil dicta? Blanditiis, sapiente quia? Enim neque sit voluptas modi.</p>
                            </div>
                        </div>
                        <hr class="hr-detail mt-0">
                        <div class="row">
                            <div class="image-box col-2">
                                <img src="{{ asset(Auth::user()->image_link) }}" alt="" srcset="" class="rounded-circle img-ulasan">
                            </div>
                            <div class="col-10">
                                <p class="mb-0">dewi <span class="waktu small">1d</span></p>
                                <p class="m-0">
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star"></i>
                                </p>
                                <p>ulasann Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure, sint consectetur. Odio, architecto laudantium. Quaerat necessitatibus quisquam sint, saepe aspernatur nihil dicta? Blanditiis, sapiente quia? Enim neque sit voluptas modi.</p>
                            </div>
                        </div>
                        <hr class="hr-detail mt-0">
                        <div class="row">
                            <div class="image-box col-2">
                                <img src="{{ asset(Auth::user()->image_link) }}" alt="" srcset="" class="rounded-circle img-ulasan">
                            </div>
                            <div class="col-10">
                                <p class="mb-0">dewi <span class="waktu small">1d</span></p>
                                <p class="m-0">
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star"></i>
                                </p>
                                <p>ulasann Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure, sint consectetur. Odio, architecto laudantium. Quaerat necessitatibus quisquam sint, saepe aspernatur nihil dicta? Blanditiis, sapiente quia? Enim neque sit voluptas modi.</p>
                            </div>
                        </div>
                        <hr class="hr-detail mt-0">
                        <div class="row">
                            <div class="image-box col-2">
                                <img src="{{ asset(Auth::user()->image_link) }}" alt="" srcset="" class="rounded-circle img-ulasan">
                            </div>
                            <div class="col-10">
                                <p class="mb-0">dewi <span class="waktu small">1d</span></p>
                                <p class="m-0">
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star"></i>
                                </p>
                                <p>ulasann Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure, sint consectetur. Odio, architecto laudantium. Quaerat necessitatibus quisquam sint, saepe aspernatur nihil dicta? Blanditiis, sapiente quia? Enim neque sit voluptas modi.</p>
                            </div>
                        </div>
                        <hr class="hr-detail mt-0">
                        <div class="row">
                            <div class="image-box col-2">
                                <img src="{{ asset(Auth::user()->image_link) }}" alt="" srcset="" class="rounded-circle img-ulasan">
                            </div>
                            <div class="col-10">
                                <p class="mb-0">dewi <span class="waktu small">1d</span></p>
                                <p class="m-0">
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star star-active"></i>
                                    <i class="fa-solid fa-star"></i>
                                </p>
                                <p>ulasann Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure, sint consectetur. Odio, architecto laudantium. Quaerat necessitatibus quisquam sint, saepe aspernatur nihil dicta? Blanditiis, sapiente quia? Enim neque sit voluptas modi.</p>
                            </div>
                        </div>
                        <hr class="hr-detail mt-0">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
