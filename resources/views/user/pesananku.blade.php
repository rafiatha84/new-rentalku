@extends('user.layouts.app')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/pesananku.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="detail-produk">
        <div class="container">
            <div class="row col-12 p-0">
                <div class=" col-8 offset-2 mt-5 p-0">
                    <div class="row col-12 p-0 detail-box">
                    <div class="col-6 text-center m-0 pl-2 pr-0">
                            <a href="{{ route('user.pesananku') }}" class="h4 base-color sub-menu-btn d-block m-0 p-2 left href-base active">Sedang Dipesan</a>
                        </div>
                        <div class="col-6 text-center m-0 pr-2 pl-0">
                            <a href="{{ route('user.pesananku.selesai') }}" class="h4 base-color sub-menu-btn d-block m-0 p-2 right href-base">Selesai</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($transaksis->count() > 0)
    <div id="table-pesananku ">
        <div class="container">
            <div class="row col-12 table-box my-4 p-0">
                <table class="table table-pesanan">
                <thead>
                    <tr>
                    <th scope="col" class="text-center">Gambar</th>
                    <th scope="col" class="text-center">Merk Mobil</th>
                    <th scope="col" class="text-center">Jenis Mobil</th>
                    <th scope="col" class="text-center">Tanggal</th>
                    <th scope="col" class="text-center">Sopir</th>
                    <th scope="col" class="text-center">Harga</th>
                    <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaksis as $transaksi)
                    <tr>
                        <td class="text-center">
                            <img src="{{ asset($transaksi->kendaraan->image_link) }}" alt="" srcset="" class="image-mobil-tabel">
                        </td>
                        <td class="text-center">{{ $transaksi->kendaraan->name }}</td>
                        <td class="text-center">{{ $transaksi->kendaraan->kategori->name }}</td>
                        <td class="text-center">{{$transaksi->tanggal_transaksi()}} -{{$transaksi->tanggal_berakhir()}} </td>
                        <td class="text-center">{{$transaksi->sopir()}}</td>
                        <td class="text-center">Rp.{{number_format($transaksi->kendaraan->harga,0,',','.')}}/Hari</td>
                        <td>
                            <div class="row col-12">
                                <div class="col-6 text-center">
                                    <a href="{{ route('user.pemesanan.detail',$transaksi->id) }}" class="href-base button-yellow-primary p-2 d-block">lihat data pemesanan</a>
                                </div>
                                <div class="col-6 text-center">
                                    <button class="href-base button-yellow-secondary p-2 d-block" onclick="show_room()">hubungi pemilik mobil</button>
                                </div>
                            </div> 
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div id="table-pesananku ">
        <div class="container">
            <div class="row col-12 kosong-box pt-5">
                <div class="col-12">
                <img src="{{ asset('image/order-kosong.png') }}" class="d-block mx-auto image-order-kosong" alt="" srcset="">
                <p class="text-center"><b>Belum ada pesanan</b></p>
                <p class="text-center"><i>Ayo buruan pesan sekarang</i></p>
                </div>
                
            </div>
        </div>
    </div>

    @endif
@endsection

@section('js')

@endsection
