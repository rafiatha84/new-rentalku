@extends('user.layouts.pemilik')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/unitku-edit.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="detail-produk mb-4">
        <div class="container">
            <div class="row col-12">
                <div class="detail-box col-12 mt-5 p-0 pb-4">
                    <h4 class="text-center head-produk py-2 mb-0">Unit</h4>
                    <div class="row mx-auto mt-0 h-100 pb-4">
                        <div class="col-4 sidebar-left px-0">
                            <ul class="nav flex-column px-0">
                                <li class="nav-item">
                                    <a href="{{  route('pemilik.unitku') }}" class="nav-link sidebar-navlink">Galeri Unitku</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{  route('pemilik.unitku.create') }}" class="nav-link sidebar-navlink active">Tambah Unit Rental</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-8 py-2 sidebar-right">
                            <h4><b>Tambah Data Unit Rental</b></h4>
                            <hr class="m-0 hr-base">
                            <div class="row col-12 mb-2">
                                <div class="col-6 py-2">
                                    
                                    <p class="m-0">Upload Foto Mobil</p>
                                    <div class="element w-100 radius-20">
                                        <i class="fa-solid fa-camera base-color camera-icon"></i><span class="name">No file selected</span>
                                        <input type="file" name="" id="" placeholder="" class="input-form input-foto">
                                    </div>
                                    <p class="m-0">Nama Unit</p>
                                    <input type="text" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan Nama Unit" value="Toyota Avanza">
                                    <img src="{{ asset('image/avanza.jpeg') }}" alt="" class="image-produk w-100 mt-2 hidden">
                                </div>
                                <div class="col-6 py-2 vertikal-line-base">
                                    <p class="m-0">Jenis Mobil</p>
                                    <div class="select-base-box">
                                        <select name="jenis_mobil" id="jenis_mobil" class="d-block w-100 select-base py-1">
                                            <option value="Compact MPV">Mini Mvp</option>
                                            <option value="Mini MVP">Mini MVP</option>
                                            <option value="SUV">SUV</option>
                                        </select>
                                    </div>
                                    <p class="m-0">Harga Sewa (Rp.)/Hari</p>
                                    <input type="text" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan Nama Unit" value="500000">
                                </div>
                            </div>
                            <hr class="m-0 hr-base">
                            <div class="row col-12 mb-2">
                                <div class="col-6 py-2">
                                    
                                    <p class="m-0">Kapasitas Penumpang</p>
                                    <input type="text" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan Nama Unit" value="6">
                                    <p class="m-0">Sopir</p>
                                    <div class="select-base-box">
                                        <select name="jenis_mobil" id="jenis_mobil" class="d-block w-100 select-base py-1">
                                            <option value="Compact MPV">Mini Mvp</option>
                                            <option value="Mini MVP">Mini MVP</option>
                                            <option value="SUV">SUV</option>
                                        </select>
                                    </div>
                                    <p class="m-0">Transmisi</p>
                                    <input type="text" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan Nama Unit" value="Manual">
                                </div>
                                <div class="col-6 py-2 vertikal-line-base">
                                    <p class="m-0">Mesin</p>
                                    <input type="text" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan Mesin" value="1998 cc">
                                    <p class="m-0">Warna</p>
                                    <input type="text" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan Nama Unit" value="Silver">
                                    <p class="m-0">Tahun Mobil</p>
                                    <input type="text" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan tahun mobil" value="2019">
                                </div>
                            </div>
                            
                            <div class="row col-12">
                                <div class="col-4 offset-4">
                                    <a href="" class="button-yellow py-2 w-100 d-block text-center tambah-button">Tambahkan</a>
                                </div>
                            </div>
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
                    <p class="text-center">Sedang di proses oleh admin</p>
                    <p class="text-center">
                        <a href="{{ route('pemilik.unitku') }}" class="href-base button-yellow-primary p-2 px-4">Kembali ke halaman utama</a>
                    </p>
                    
                </div>
                <form action='' id="formdelete" method="get">
                </form>
            </div>
        </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.tambah-button').click(function(e){
                e.preventDefault();
                $('#suksesModal').modal("show");
            });
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
