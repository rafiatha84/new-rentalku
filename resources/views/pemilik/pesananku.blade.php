@extends('user.layouts.pemilik')

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
                            <a href="{{ route('pemilik.pesananku') }}" class="h4 base-color sub-menu-btn d-block m-0 p-2 left href-base active">Sedang Dipesan</a>
                        </div>
                        <div class="col-6 text-center m-0 pr-2 pl-0">
                            <a href="{{ route('pemilik.pesananku.selesai') }}" class="h4 base-color sub-menu-btn d-block m-0 p-2 right href-base">Selesai</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(1==2)
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
                    <tr>
                        <td class="text-center">
                            <img src="{{ asset('image/avanza.jpeg') }}" alt="" srcset="" class="image-mobil-tabel">
                        </td>
                        <td class="text-center">Toyota Avanza</td>
                        <td class="text-center">Mini MPV</td>
                        <td class="text-center">13 Oktober 2021 - 14 Oktober 2021</td>
                        <td class="text-center">Tanpa Sopir</td>
                        <td class="text-center">Rp 250.000/Hari</td>
                        <td>
                            <div class="row col-12">
                                <div class="col-6 text-center">
                                    <a href="" class="href-base button-yellow-primary p-2 ">lihat data pemesanan</a>
                                </div>
                                <div class="col-6 text-center">
                                    <a href="" class="href-base button-yellow-secondary p-2">hubungi pemilik mobil</a>
                                </div>
                            </div> 
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <img src="{{ asset('image/avanza.jpeg') }}" alt="" srcset="" class="image-mobil-tabel">
                        </td>
                        <td class="text-center">Toyota Avanza</td>
                        <td class="text-center">Mini MPV</td>
                        <td class="text-center">13 Oktober 2021 - 14 Oktober 2021</td>
                        <td class="text-center">Tanpa Sopir</td>
                        <td class="text-center">Rp 250.000/Hari</td>
                        <td>
                            <div class="row col-12">
                                <div class="col-6 text-center">
                                    <a href="" class="href-base button-yellow-primary p-2 d-block">lihat data pemesanan</a>
                                </div>
                                <div class="col-6 text-center">
                                    <a href="" class="href-base button-yellow-secondary p-2 d-block">hubungi pemilik mobil</a>
                                </div>
                            </div> 
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <img src="{{ asset('image/avanza.jpeg') }}" alt="" srcset="" class="image-mobil-tabel">
                        </td>
                        <td class="text-center">Toyota Avanza</td>
                        <td class="text-center">Mini MPV</td>
                        <td class="text-center">13 Oktober 2021 - 14 Oktober 2021</td>
                        <td class="text-center">Tanpa Sopir</td>
                        <td class="text-center">Rp 250.000/Hari</td>
                        <td>
                            <div class="row col-12">
                                <div class="col-6 text-center">
                                    <a href="" class="href-base button-yellow-primary p-2 d-block">lihat data pemesanan</a>
                                </div>
                                <div class="col-6 text-center">
                                    <a href="" class="href-base button-yellow-secondary p-2 d-block">hubungi pemilik mobil</a>
                                </div>
                            </div> 
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <img src="{{ asset('image/avanza.jpeg') }}" alt="" srcset="" class="image-mobil-tabel">
                        </td>
                        <td class="text-center">Toyota Avanza</td>
                        <td class="text-center">Mini MPV</td>
                        <td class="text-center">13 Oktober 2021 - 14 Oktober 2021</td>
                        <td class="text-center">Tanpa Sopir</td>
                        <td class="text-center">Rp 250.000/Hari</td>
                        <td>
                            <div class="row col-12">
                                <div class="col-6 text-center">
                                    <a href="" class="href-base button-yellow-primary p-2 d-block">lihat data pemesanan</a>
                                </div>
                                <div class="col-6 text-center">
                                    <a href="" class="href-base button-yellow-secondary p-2 d-block">hubungi pemilik mobil</a>
                                </div>
                            </div> 
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <img src="{{ asset('image/avanza.jpeg') }}" alt="" srcset="" class="image-mobil-tabel">
                        </td>
                        <td class="text-center">Toyota Avanza</td>
                        <td class="text-center">Mini MPV</td>
                        <td class="text-center">13 Oktober 2021 - 14 Oktober 2021</td>
                        <td class="text-center">Tanpa Sopir</td>
                        <td class="text-center">Rp 250.000/Hari</td>
                        <td>
                            <div class="row col-12">
                                <div class="col-6 text-center">
                                    <a href="" class="href-base button-yellow-primary p-2 d-block">lihat data pemesanan</a>
                                </div>
                                <div class="col-6 text-center">
                                    <a href="" class="href-base button-yellow-secondary p-2 d-block">hubungi pemilik mobil</a>
                                </div>
                            </div> 
                        </td>
                    </tr>
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
