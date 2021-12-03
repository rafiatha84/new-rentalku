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
                            <hr>
                            <h6>Tarik dana dari DompetKu ke :</h6>
                            <h6><b>Bank</b></h6>
                            <input type="radio" name="bank" id="bank-radio-1" value="bca" class="select-bank">
                            <label class="d-block bank-box p-2" for="bank-radio-1">
                                    Bank Negara Indonesia
                                    <img src="{{ asset('image/bank-bni.png') }}" alt="" class="float-right">
                            </label>
                            <input type="radio" name="bank" id="bank-radio-2" value="bca" class="select-bank">
                            <label class="d-block bank-box p-2" for="bank-radio-2">
                                    Bank Central Asia
                                    <img src="{{ asset('image/bank-bca.png') }}" alt="" class="float-right">
                            </label>
                            <input type="radio" name="bank" id="bank-radio-3" value="bca" class="select-bank">
                            <label class="d-block bank-box p-2" for="bank-radio-3">
                                    Bank Rakyat Indonesia
                                    <img src="{{ asset('image/bank-bri.png') }}" alt="" class="float-right">
                            </label>
                            <div class="row">
                                <div class="col-6">
                                <p class="m-0">Masukkan No Rekening</p>
                                <input type="text" class="base-input px-2 py-1 w-100">
                                <p class="m-0">Atas Nama Rekening Bang</p>
                                <input type="text" class="base-input px-2 py-1 w-100">
                                <p class="m-0">Jumlah Penarikan Dana</p>
                                <h4 class="yellow-text">Rp. <input type="number" value="0" class="saldo-input"></h4>
                                <div class="row saldo-box">
                                    <div class="col-2 text-center my-2">
                                        <i class="fa-solid fa-wallet base-color" style="font-size:30px;"></i>
                                    </div>
                                    <div class="col-10">
                                        <p><b>Saldo Anda</b></p>
                                        <p>Rp. 500.000</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            
                            <div class="col-12 text-center">
                                <a href="" class="button-yellow-primary px-5 py-2 tarik-dana">Tarik Dana</a>
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
                        <a href="{{ route('pemilik.dompetku') }}" class="href-base button-yellow-primary p-2 px-4">Kembali ke halaman utama</a>
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
        $(document).ready(function(){
            $('.select-jumlah').change(function(){
                $('.jumlah-value').html($('.select-jumlah:checked').val());
            });
            $('.tarik-dana').click(function(e){
                e.preventDefault();
                $('#suksesModal').modal("show");
            });
        });
    </script>
@endsection