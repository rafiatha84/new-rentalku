@extends('user.layouts.pemilik')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/supirku-edit.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="detail-produk mb-4">
        <div class="container">
            <div class="row col-12">
                <div class="detail-box col-12 mt-5 p-0 pb-4">
                    <h4 class="text-center head-produk py-2 mb-0">Supirku</h4>
                    <div class="row mx-auto mt-0 h-100 pb-4">
                        <div class="col-4 sidebar-left px-0">
                            <ul class="nav flex-column px-0">
                                <li class="nav-item">
                                    <a href="{{  route('pemilik.supirku') }}" class="nav-link sidebar-navlink active">Sopirku</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{  route('pemilik.supirku.create') }}" class="nav-link sidebar-navlink">Tambah Sopir</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-8 py-2 sidebar-right">
                            <h4><b>Informasi Data Sopir</b></h4>
                            <hr class="m-0 hr-base">
                            <div class="row col-12 mb-2">
                                <div class="col-6 py-2">
                                    <p class="m-0">Nama Lengkap</p>
                                    <input type="text" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan Nama" value="Aris">

                                    <p class="m-0">Email</p>
                                    <input type="text" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan Email" value="Aris@gmail.com">
                                    <p class="m-0">Password</p>
                                    <input type="password" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan Email" value="Aris@gmail.com">
                                    
                                </div>
                                <div class="col-6 py-2 vertikal-line-base">
                                    <p class="m-0">Upload Foto KTP</p>
                                    
                                    <img src="{{ asset('image/avanza.jpeg') }}" alt="" class="image-produk w-100 mt-2">
                                    <p class="m-0">Upload Foto SIM A</p>
                                    
                                    <img src="{{ asset('image/avanza.jpeg') }}" alt="" class="image-produk w-100 mt-2">
                                </div>
                            </div>
                            
                            <div class="row col-12">
                                <div class="col-4 offset-4">
                                    <a href="{{ route('pemilik.supirku.edit',2) }}" class="button-base-secondary py-2 w-100 d-block text-center">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $(".camera-icon").click(function () {
                $("input[type='file']").trigger('click');
            });

            $('input[type="file"]').on('change', function() {
                var val = $(this).val();
                $(this).siblings('span').text(val);
            });
        });
    </script>
@endsection
