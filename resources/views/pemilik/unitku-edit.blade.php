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
                                    <a href="{{  route('pemilik.unitku') }}" class="nav-link sidebar-navlink active">Galeri Unitku</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{  route('pemilik.unitku.create') }}" class="nav-link sidebar-navlink">Tambah Unit Rental</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-8 py-2 sidebar-right">
                            <h4><b>Edit Data Unit Rental</b></h4>
                            <form action="{{ route('api.kendaraan.update',$kendaraan->id) }}" id="unitku-update" method="POST" enctype="multipart/form-data">
                            <hr class="m-0 hr-base">
                            <div class="row col-12 mb-2">
                                <div class="col-6 py-2">
                                    <p class="m-0">Upload Foto Mobil</p>
                                    <div class="element w-100 radius-20">
                                        <i class="fa-solid fa-camera base-color camera-icon"></i><span class="name">No file selected</span>
                                        <input type="file" name="image_link" id="image_link" placeholder="" class="input-form input-foto" onchange="previewFile(this,'#foto-unitku');">
                                    </div>
                                    <p class="m-0">Nama Unit</p>
                                    <input type="text" name="name" class="d-block input-base py-2 px-2 w-100" placeholder="Masukkan Nama Unit" value="{{ $kendaraan->name }}" required>
                                    <img src="{{ asset($kendaraan->image_link) }}" alt="" class="image-produk w-100 mt-2" id="foto-unitku">
                                </div>
                                <div class="col-6 py-2 vertikal-line-base">
                                    <p class="m-0">Jenis Mobil</p>
                                    <div class="select-base-box">
                                        <select name="kategori_id" id="jenis_mobil" class="d-block w-100 select-base py-1" required>
                                            @foreach($kategoris as $kategori)

                                            <option value="{{$kategori->id}}" {{ ($kategori->id == $kendaraan->kategori->id) ? 'selected' : '' }}>{{$kategori->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <p class="m-0">Harga Sewa (Rp.)/Hari</p>
                                    <input name="harga" type="number" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan Harga Unit" value="{{ $kendaraan->harga }}" required>
                                </div>
                            </div>
                            <hr class="m-0 hr-base">
                            <div class="row col-12 mb-2">
                                <div class="col-6 py-2">
                                    
                                <p class="m-0">Kapasitas Penumpang</p>
                                    <input type="text" name="seat" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan Kapasitas Penumpang" value="{{ $kendaraan->seat }}" required>
                                    <p class="m-0">Transmisi</p>
                                    <select name="transmisi" class="d-block w-100 input-base py-1" required>
                                        <option value="Manual" {{ ("Manual" == $kendaraan->transmisi) ? 'selected' : '' }}>Manual</option>
                                        <option value="Matic" {{ ("Matic" == $kendaraan->transmisi) ? 'selected' : '' }}>Matic</option>
                                    </select>
                                    <p class="m-0">Masukkan Nopol</p>
                                    <input type="text" name="nopol" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan Nomor polisi" value="{{ $kendaraan->nopol }}" required>
                                </div>
                                <div class="col-6 py-2 vertikal-line-base">
                                <p class="m-0">Mesin</p>
                                    <input type="text" name="mesin" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan Mesin" value="{{ $kendaraan->mesin }}" required>
                                    <p class="m-0">Warna</p>
                                    <input type="text" name="warna" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan Warna Unit" value="{{ $kendaraan->warna }}" required>
                                    <p class="m-0">Tahun Mobil</p>
                                    <input type="text" name="tahun" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan tahun mobil" value="{{ $kendaraan->tahun }}" required>
                                    <p class="m-0">Kota</p>
                                    <input type="text" name="kota" class="d-block  input-base py-2 px-2 w-100" placeholder="Masukkan kota mobil" value="{{ $kendaraan->kota }}" required>
                                </div>
                            </div>
                            
                            <div class="row col-12">
                                <div class="col-4 offset-4">
                                    <button type="submit" class="button-yellow py-2 w-100 d-block text-center tambah-button">
                                        <div class="d-flex justify-content-center">
                                            <div class="spinner-border" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>Simpan
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
                    <p class="text-center">Data berhasil Di update</p>
                    <p class="text-center">
                        <a href="{{ route('pemilik.unitku.detail',$kendaraan->id) }}" class="href-base button-yellow-primary p-2 px-4">Kembali ke halaman utama</a>
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
            $('#unitku-update').submit(function(e){
                e.preventDefault();
                // console.log($('#pemesanan-create').serialize());
                /* get the action attribute from the <form action=""> element */
                var $form = $(this), url = $form.attr('action');
                let formData = new FormData($('#unitku-update')[0]);
                if( document.getElementById("image_link").files.length > 0 ){
                    // console.log("no files selected");
                    let file = $('input[type=file]')[0].files[0];
                    formData.append('image_link', file, file.name);
                }
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
                        $('#unitku-update')[0].reset();
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
