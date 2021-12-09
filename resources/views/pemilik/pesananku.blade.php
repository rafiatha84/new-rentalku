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
                                <div class="col-4 text-center px-1">
                                    <a href="{{ route('pemilik.pemesanan.detail',$transaksi->id) }}" class="href-white button-yellow p-2 d-block w-100" >Lihat Data Pemesanan</a>
                                </div>
                                <div class="col-4 text-center px-1">
                                    <button class="href-base button-yellow-secondary p-2 d-block w-100" onclick="show_room()">Hubungi penyewa</button>
                                </div>
                                <div class="col-4 text-center px-1">
                                    <button class="href-base button-yellow-primary p-2 d-block w-100" onclick="modal_selesai({{ $transaksi->id }})">Konfirmasi Selesai</button>
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

    <!-- Modal -->
    <div class="modal fade" id="selesaiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                <div class="col-12">
                <img src="{{ asset('image/delete-alert.png') }}" class="mx-auto d-block" alt="">
                </div>
                </div>
                <div class="col-12 text-center">
                <h2>Perhatian</h2>
                <p>Apakah Anda yakin akan mengubah status pemesanan jadi selesai?</p>
                </div>
                <form action='/' id="formselesai" method="POST">
                @csrf
                <div class="row px-5">
                <div class="col-6">
                <button type="button" class="btn btn-secondary btn-block btn-cancel" data-dismiss="modal">Tidak</button>
                </div>
                <div class="col-6">
                <button type="submit" class="btn btn-primary btn-block btn-oke">Iya</button>
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
    function modal_selesai(id){
      var url = '{{ route("pemilik.pesanan.selesai.action", ":id") }}';
      url = url.replace(':id', id);
      $("#formselesai").attr('action',url);
      $('#selesaiModal').modal("show"); 
    }
</script>
@endsection
