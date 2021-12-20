@extends('user.layouts.app')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/dompetku-topup.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="detail-produk mb-4">
        <div class="container">
            <div class="row col-12">
                <div class="detail-box col-12 mt-5 p-0 pb-4">
                    <h4 class="text-center head-produk py-2 mb-0">Isi Saldo</h4>
                    <form method="POST" action="{{ route('api.dompetku.topup') }}" id="topup-create">
                        <div class="row mx-auto mt-0 h-100 pb-4">
                            <div class="col-4 sidebar-left px-0">
                                <ul class="nav flex-column px-0">
                                    <li class="nav-item">
                                        <a href="{{  route('user.dompetku') }}" class="nav-link sidebar-navlink">Riwayat Saldo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{  route('user.dompetku.topup') }}" class="nav-link sidebar-navlink active">Isi Saldo</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{  route('user.dompetku.topup') }}" class="nav-link sidebar-navlink active py-0 nav-submenu">Masukkan Jumlah</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{  route('user.dompetku.tutorial') }}" class="nav-link sidebar-navlink">Cara Transfer</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-8 py-2 sidebar-right">
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <h5><b>Masukkan Jumlah (Rp)</b><span class="">*minimal Rp. 20.000</span></h5>
                                <h4 class="yellow-text">Rp.<span class="jumlah-value">0</span></h4>
                                <div class="row px-2">
                                    <div class="col-4 px-1">
                                        <input type="radio" name="jumlah" class="select-jumlah" id="jumlah-radio-1" value="20000">
                                        <label for="jumlah-radio-1" class="select-jumlah-box w-100 py-4">
                                            <p class="text-center my-auto"><b class="h4">20</b>.000</p>
                                        </label>
                                    </div>
                                    <div class="col-4 px-1">
                                        <input type="radio" name="jumlah" class="select-jumlah" id="jumlah-radio-2" value="50000">
                                        <label for="jumlah-radio-2" class="select-jumlah-box w-100 py-4">
                                            <p class="text-center my-auto"><b class="h4">50</b>.000</p>
                                        </label>
                                    </div>
                                    <div class="col-4 px-1">
                                        <input type="radio" name="jumlah" class="select-jumlah" id="jumlah-radio-3" value="100000">
                                        <label for="jumlah-radio-3" class="select-jumlah-box w-100 py-4">
                                            <p class="text-center my-auto"><b class="h4">100</b>.000</p>
                                        </label>
                                    </div>
                                    <div class="col-4 px-1">
                                        <input type="radio" name="jumlah" class="select-jumlah" id="jumlah-radio-4" value="200000">
                                        <label for="jumlah-radio-4" class="select-jumlah-box w-100 py-4">
                                            <p class="text-center my-auto"><b class="h4">200</b>.000</p>
                                        </label>
                                    </div>
                                    <div class="col-4 px-1">
                                        <input type="radio" name="jumlah" class="select-jumlah" id="jumlah-radio-5" value="300000">
                                        <label for="jumlah-radio-5" class="select-jumlah-box w-100 py-4">
                                            <p class="text-center my-auto"><b class="h4">300</b>.000</p>
                                        </label>
                                    </div>
                                    <div class="col-4 px-1">
                                        <input type="radio" name="jumlah" class="select-jumlah" id="jumlah-radio-6" value="500000">
                                        <label for="jumlah-radio-6" class="select-jumlah-box w-100 py-4">
                                            <p class="text-center my-auto"><b class="h4">500</b>.000</p>
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <h5><b>Pilih Metode Pembayaran</b></h5>
                                <hr>
                                <h6><b>Bank</b></h6>
                                @foreach($banks as $bank)
                                <input type="radio" name="rekening_id" id="bank-radio-{{$bank->id}}" value="{{$bank->id}}" class="select-bank">
                                <label class="d-block bank-box p-2" for="bank-radio-{{$bank->id}}">
                                        {{$bank->name}}
                                        <img src="{{ asset($bank->image_link) }}" alt="" class="float-right">
                                </label>
                                @endforeach
                                <h6><b>E-Wallet</b></h6>
                                @foreach($wallets as $wallet)
                                <input type="radio" name="rekening_id" id="bank-radio-{{$wallet->id}}" value="{{$wallet->id}}" class="select-bank">
                                <label class="d-block bank-box p-2" for="bank-radio-{{$wallet->id}}">
                                        {{$wallet->name}}
                                        <img src="{{ asset($wallet->image_link) }}" alt="" class="float-right">
                                </label>
                                @endforeach
                                <hr>
                                <div class="col-12 text-center">
                                    <button typr="submit" value="Submit" class="button-yellow-primary px-3 py-2">
                                        <div class="d-flex justify-content-center">
                                            <div class="spinner-border" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                        Bayar Sekarang
                                    </button>
                                </div>
                            </div>
                        </div>
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
                var jumlah_total_display = new Intl.NumberFormat(['ban', 'id']).format($('.select-jumlah:checked').val());
                $('.jumlah-value').html(jumlah_total_display);
            });
            $('#topup-create').submit(function(e){
                e.preventDefault();
                // console.log($('#pemesanan-create').serialize());
                /* get the action attribute from the <form action=""> element */
                var $form = $(this), url = $form.attr('action');
                let formData = new FormData($('#topup-create')[0]);
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
                    success: function(response) {
                        console.log(response);
                        var transaksi_dompet_id = response['content']['id'];
                        var url = "{{ route('user.dompetku.topup.detail','') }}"+"/"+transaksi_dompet_id;
                        window.location=url;
                        $('#pemesanan-create')[0].reset();
                        // $('#suksesModal').modal("show"); 
                        removeLoader();
                        $(':input[type="submit"]').prop('disabled', false);
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