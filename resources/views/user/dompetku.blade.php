@extends('user.layouts.app')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/dompetku.css') }}" rel="stylesheet">
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
                                    <a href="{{  route('user.dompetku') }}" class="nav-link sidebar-navlink active">Riwayat Saldo</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{  route('user.dompetku.topup') }}" class="nav-link sidebar-navlink">Top Up</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{  route('user.dompetku.tutorial') }}" class="nav-link sidebar-navlink">Cara Transfer</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-8 py-2 sidebar-right">
                            <h4><b>Jumlah Saldo</b></h4>
                            <p class="saldo">Rp.{{ number_format($dompet->saldo,0,',','.') }}</p>
                            <hr>
                            <h5><b>Transaksi Terakhir</b></h5>
                            @foreach($dompet->transaksiDompet as $transaksiDompet)
                            <!-- transaksi -->
                            <hr>
                                <p>
                                    <h6 class="d-inline-block"><b>{{$transaksiDompet->name}}</b></h6>
                                    <span class="float-right">Rp.{{number_format($transaksiDompet->jumlah,0,',','.')}}</span>
                                </p>
                                @if(!is_null($transaksiDompet->transaksi))
                                    <p class="keterangan">{{$transaksiDompet->transaksi->kendaraan->name}}</p>
                                @else
                                    <p class="keterangan">Topup</p>
                                @endif
                                <p class="tanggal">07-10-2021</p>
                            <hr>
                            <!-- transaksi -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
