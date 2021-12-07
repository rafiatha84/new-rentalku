@extends('user.layouts.pemilik')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/dompetku-topup.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="detail-produk mb-4">
        <div class="container">
            <div class="row col-12">
                <div class="detail-box col-12 mt-5 p-0 pb-4">
                    <h4 class="text-center head-produk py-2 mb-0">Saldo</h4>
                    <div class="row mx-auto mt-0 h-100 pb-4">
                        <div class="col-4 sidebar-left px-0">
                            <ul class="nav flex-column px-0">
                            <li class="nav-item">
                                    <a href="{{  route('pemilik.dompetku') }}" class="nav-link sidebar-navlink">Riwayat Saldo</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{  route('pemilik.dompetku.penarikan') }}" class="nav-link sidebar-navlink active">Tarik</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-8 py-2 sidebar-right">
                            <h5><b>MTarik Dana</b></h5>
                            <form action="{{ route('api.dompetku.penarikan') }}" id="penarikan-create" method="POST" enctype="multipart/form-data">
                                <hr>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <h6>Tarik dana dari DompetKu ke :</h6>
                                <h6><b>Bank</b></h6>
                                <input type="radio" name="bank" id="bank-radio-1" value="BNI" class="select-bank" required>
                                <label class="d-block bank-box p-2" for="bank-radio-1">
                                        Bank Negara Indonesia
                                        <img src="{{ asset('image/bank-bni.png') }}" alt="" class="float-right">
                                </label>
                                <input type="radio" name="bank" id="bank-radio-2" value="BCA" class="select-bank">
                                <label class="d-block bank-box p-2" for="bank-radio-2">
                                        Bank Central Asia
                                        <img src="{{ asset('image/bank-bca.png') }}" alt="" class="float-right">
                                </label>
                                <input type="radio" name="bank" id="bank-radio-3" value="BRI" class="select-bank">
                                <label class="d-block bank-box p-2" for="bank-radio-3">
                                        Bank Rakyat Indonesia
                                        <img src="{{ asset('image/bank-bri.png') }}" alt="" class="float-right">
                                </label>
                                <div class="row">
                                    <div class="col-6">
                                    <p class="m-0">Masukkan No Rekening</p>
                                    <input type="text" name="no_rek" class="base-input px-2 py-1 w-100" placeholder="Masukkan No Rekening" required>
                                    <p class="m-0">Atas Nama Rekening Bang</p>
                                    <input type="text" name="atas_nama" class="base-input px-2 py-1 w-100" placeholder="Masukkan Nama Rekening">
                                    <p class="m-0">Jumlah Penarikan Dana</p>
                                    <h4 class="yellow-text">Rp. <input type="number" name="jumlah" class="saldo-input yellow-text" placeholder="0"></h4>
                                    <div class="row saldo-box">
                                        <div class="col-2 text-center my-2">
                                            <i class="fa-solid fa-wallet base-color" style="font-size:30px;"></i>
                                        </div>
                                        <div class="col-10">
                                            <p><b>Saldo Anda</b></p>
                                            <p>Rp.{{ number_format($dompet->saldo,0,',','.') }}</p>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                
                                <div class="col-12 text-center">
                                    <button class="button-yellow-primary px-5 py-2 tarik-dana">
                                        <div class="d-flex justify-content-center">
                                            <div class="spinner-border" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>Tarik Dana
                                    </button>
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
                    <p class="text-center">Sedang di proses oleh admin</p>
                    <p class="text-center">
                        <a href="{{ route('pemilik.dompetku') }}" class="href-base button-yellow-primary p-2 px-4">Kembali ke halaman utama</a>
                    </p>
                    
                </div>
                <form action='' id="formdelete" method="get">
                </form>
            </div>
        </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="gagalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <h4 class="color-base text-center">Maaf saldo anda tidak mencukupi</h4>
                        <!-- <p class="text-center">Lakukan konfirmasi transfer hanya jika Anda telah selesai melakukan transfer sesuai intruksi sebelumnya</p> -->
                    </div>
                </div>
                <div class="row px-5">
                    <div class="col-6 offset-3">
                    <button type="button" class="btn button-gray btn-block btn-cancel" data-dismiss="modal">Kembali</button>
                    </div>
                    <!-- <div class="col-6">
                    <button type="button" class="btn btn-block btn-oke button-base radius-5">Sudah</button>
                    </div> -->
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
        $(document).ready(function(){
            $('#penarikan-create').submit(function(e){
                e.preventDefault();
                // console.log($('#pemesanan-create').serialize());
                /* get the action attribute from the <form action=""> element */
                if(parseInt($('.saldo-input').val()) <= parseInt("{{ $dompet->saldo }}") ){
                    console.log("bisa");
                    var $form = $(this), url = $form.attr('action');
                    let formData = new FormData($('#penarikan-create')[0]);
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
                            $('#penarikan-create')[0].reset();
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
                }else{
                    $('#gagalModal').modal("show"); 
                }
                    
                
            });
            $('.select-jumlah').change(function(){
                $('.jumlah-value').html($('.select-jumlah:checked').val());
            });
            // $('.tarik-dana').click(function(e){
            //     e.preventDefault();
            //     $('#suksesModal').modal("show");
            // });
        });
    </script>
@endsection