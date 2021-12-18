@extends('user.layouts.app')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/dompetku-topup.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/tutorial.css') }}" rel="stylesheet">
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
                                    <a href="{{  route('user.dompetku') }}" class="nav-link sidebar-navlink">Riwayat Saldo</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{  route('user.dompetku.topup') }}" class="nav-link sidebar-navlink">Top Up</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{  route('user.dompetku.tutorial') }}" class="nav-link sidebar-navlink active">Cara Transfer</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-8 py-2 sidebar-right">
                            <h5 class="mt-2"><b>Cara Transfer</b></h5>
                            <p>Mohon perhatikan setiap langkah transfer dibawah ini</p>
                            <hr>
                            <div class="info-box p-2 m-0">
                                <div class="m-0">
                                    <p class="d-inline-block m-0"><b>ATM BCA</b></p>
                                </div>
                            </div>
                            <div class="tutorial-box">
                                <p><span class="badge badge-light mx-1">1</span>Masukkan Kartu ATM dan PIN BCA Anda</p>
                                <p><span class="badge badge-light mx-1">2</span>Masuk e menu “Transfer” dan pilih “ke rekening BCA”</p>
                                <p><span class="badge badge-light mx-1">3</span>Masukkan nomor rekening BCA milik RentalKu</p>
                                <p><span class="badge badge-light mx-1">4</span>Pastikan nama Anda dan jumlah bembayaran sudah benar</p>
                                <p><span class="badge badge-light mx-1">5</span>Pembayaran selesai. Simpan struk sebagai bukti pembayaran</p>
                            </div>
                            
                            <form action='' id="formdelete" method="get">
                            </form>
                        </div>
                    </div>
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
            $('.konfirmasi-button').click(function(e){
                e.preventDefault();
                $('#konfirmasiModal').modal("show");
            });
        });
    </script>
@endsection