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
                                    <a href="{{  route('pemilik.supirku') }}" class="nav-link sidebar-navlink ">Sopirku</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{  route('pemilik.supirku.create') }}" class="nav-link sidebar-navlink active">Tambah Sopir</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-8 py-2 sidebar-right">
                            <h4><b>Tambah Data Sopir</b></h4>
                            <form action="{{ route('api.pengemudi.create') }}" id="sopir-create" method="POST" enctype="multipart/form-data">
                            <hr class="m-0 hr-base">
                            <div class="row col-12 mb-2">
                                <div class="col-6 py-2">
                                    <input type="hidden" name="owner_id" value="{{ Auth::user()->id }}">
                                    <p class="m-0">Nama Lengkap</p>
                                    <input type="text" name="name" class="d-block  input-base py-3 px-3 w-100" placeholder="Masukkan Nama" required>

                                    <p class="m-0">Email</p>
                                    <input type="text" name="email" class="d-block  input-base py-3 px-3 w-100" placeholder="Masukkan Email" required>
                                    <p class="m-0">Kata sandi</p>
                                    <div class="password-box">
                                        <input type="password" name="password" class="d-block  input-base py-3 px-2 w-100" placeholder="Masukkan Kata sandi" required>
                                        <i class="far fa-eye icon-eye" id="togglePassword" style="" onclick="showPassword(this)"></i>
                                    </div>
                                    
                                </div>
                                <div class="col-6 py-2 vertikal-line-base">
                                    <p class="m-0">Upload Foto KTP</p>
                                    <div class="element w-100 radius-20">
                                        <i class="fa-solid fa-camera base-color camera-icon" onclick="click_input('#foto-ktp');"></i><span class="name">Tidak ada file yang dipilih</span>
                                        <input type="file" name="foto_ktp" id="foto-ktp" placeholder="" class="input-form input-foto" onchange="previewFile(this,'#foto-ktp-image');">
                                    </div>
                                    <img src="{{ asset('image/avanza.jpeg') }}" alt="" id="foto-ktp-image" class="image-produk img-upload w-100 mt-2 hidden">
                                    <p class="m-0">Upload Foto SIM A</p>
                                    <div class="element w-100 radius-20 ">
                                        <i class="fa-solid fa-camera base-color camera-icon" onclick="click_input('#foto-sim');"></i><span class="name" id="foto-sim-name">Tidak ada file yang dipilih</span>
                                        <input type="file" name="foto_sim" id="foto-sim" placeholder="" class="input-form input-foto" onchange="previewFile(this,'#foto-sim-image');">
                                    </div>
                                    <img src="{{ asset('image/avanza.jpeg') }}" alt="" id="foto-sim-image" class="image-produk img-upload w-100 mt-2 hidden">
                                </div>
                            </div>
                            
                            <div class="row col-12">
                                <div class="col-4 offset-4">
                                    <button class="button-yellow py-2 w-100 d-block text-center">
                                        <div class="d-flex justify-content-center">
                                            <div class="spinner-border" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>Tambah Sopir
                                    </button>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="suksesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                <div class="col-12">
                    <img src="{{ asset('image/sukses-bayar.png') }}" alt="" srcset="" class="d-block mx-auto">
                    </div>
                    </div>
                    <div class="col-12">
                    <p class="text-center">Sukses tambah sopir</p>
                    <p class="text-center">
                        <a href="{{ route('pemilik.supirku') }}" class="href-base button-yellow-primary p-2 px-4">Kembali ke halaman utama</a>
                    </p>
                    
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#sopir-create').submit(function(e){
                e.preventDefault();
                // console.log($('#pemesanan-create').serialize());
                /* get the action attribute from the <form action=""> element */
                var $form = $(this), url = $form.attr('action');
                let formData = new FormData($('#sopir-create')[0]);
                let file = $('input[type=file]')[0].files[0];
                formData.append('foto_ktp', file, file.name);
                file = $('input[type=file]')[1].files[0];
                formData.append('foto_sim', file, file.name);
                $.ajax({
                    url: url,
                    type: "POST", //send it through get method
                    data: formData,
                    cache       : false,
                    contentType : false,
                    processData : false,
                    beforeSend: function() {
                        showLoader();
                        $(':input[type="submit"]').prop('disabled', true);
                    },
                    success: function(response, textStatus, xhr) {
                        console.log(xhr.status);
                        console.log(response);
                        // var transaksi_id = response['content']['id'];
                        $('#sopir-create')[0].reset();
                        $('#suksesModal').modal("show"); 
                        $(':input[type="submit"]').prop('disabled', false);
                        removeLoader();
                    },
                    error: function(xhr) {
                        alert('error');
                        console.log(xhr);
                        //Do Something to handle error
                    }
                });
                
            });
        });
    </script>
@endsection
