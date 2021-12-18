@extends('user.layouts.app')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/pemesanan-detail.css') }}" rel="stylesheet">
    
@endsection

@section('content')
    <div id="ulasan-produk">
        <div class="container">
            <div class="row col-12">
                <div class="detail-box col-10 offset-1 mt-5 p-0 pb-4">
                    <h4 class="text-center head-produk py-2">Detail Pemesanan</h4>
                    <div class="content-wrapper px-2">
                        <div class="row">
                            <div class="col-6">
                                <img src="{{ asset($transaksi->kendaraan->image_link) }}" alt="" srcset="" class="w-100">
                            </div>
                            <div class="col-6">
                                <h5 class="nama text-center">{{$transaksi->kendaraan->name}}</h5>
                                <p class="jenis text-center">{{$transaksi->kendaraan->kategori->name}}</p>
                                <div class="rent-car-box mb-2 px-2">
                                    <p class="m-0"><b>CAR RENT- {{$transaksi->kendaraan->user->name}}</b></p>
                                </div>
                                <p class="m-0">Sopir</p>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="label-button py-2 d-block text-center" for="tanpa-sopir">{{$transaksi->sopir()}}</label>
                                    </div>
                                </div>
                                <p class="m-0">Alamat</p>
                                <div class="auto-complete">
                                    <input type="text" name="" value="{{$transaksi->alamat}}" placeholder="Masukkan Alamat" id="" class="px-2 py-1 alamat-input w-100">
                                </div>
                                <p class="m-0">Tanggal Sewa</p>
                                <input type="date" name="" id="" class="date w-100 px-2 py-1" value="{{date('Y-m-d',strtotime($transaksi->waktu_ambil))}}">
                                <p class="m-0">Tanggal pengembalian</p>
                                <input type="date" name="" id="" class="date w-100 px-2 py-1" value="{{date('Y-m-d',strtotime($transaksi->waktu_kembali))}}">
                                @if($transaksi->pengemudiTransaksi != null)
                                <p class="m-0">Sopir</p>
                                <div class="row">
                                    <div class="col-8">
                                        <input type="text" name="" id="" class="base-background text-white w-100 px-2 px-2 py-1" value="{{$transaksi->pengemudiTransaksi->pengemudi->user->name}}">
                                    </div>
                                    <div class="col-4">
                                        <button href="" class="button-yellow-primary d-block w-100 px-2 py-1 href-base" onclick="show_room()">Hubungi</button>
                                    </div>
                                </div>
                                @endif
                                
                                
                                <div class="rent-car-box mt-2 px-2">
                                    <p class="m-0"><b><span class="yellow-color">Rp.{{ number_format($transaksi->kendaraan->harga,0,',','.') }}</span>/ 1 Hari</b></p>
                                    <p class="mb-0">total ({{$transaksi->durasi}} Hari)- Rp.{{ number_format($transaksi->total_harga,0,',','.') }}</p>
                                </div>
                                <hr class="hr-detail">
                                <h5 class="text-center"><b>Data diri pemesan</b></h5>
                                <div class="rent-car-box px-2">
                                    <p class="mb-0 mt-1">{{$transaksi->name}}</p>
                                    <p class="mb-0 mt-1">{{$transaksi->telp}}</p>
                                    <p class="mb-0 mt-1">{{$transaksi->nik}}</p>
                                    <img src="{{ asset($transaksi->foto_ktp) }}" alt="" srcset="" class="img-fluid my-1">
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
                <p class="text-center">Saldo DompetKu Anda Otomatis telah terpotong</p>
                </div>
                </div>
                <div class="col-12">
                <h4 class="text-center"><a href="#" class="href-base">Lihat Pesananku</a></h4>
                <p class="text-center">jika ingin melihat pesanan anda lebih banyak</p>
                
                </div>
                <form action='' id="formdelete" method="get">
                </form>
            </div>
        </div>
        </div>
    </div>
    <div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                <div class="col-12">
                    <h4>Nilai Produk</h4>
                </div>
                </div>
                <div class="col-12">
                <h4 class="text-center"><a href="#" class="href-base">Lihat Pesananku</a></h4>
                <p class="text-center">jika ingin melihat pesanan anda lebih banyak</p>
                
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
        function setvalue(value){
            $('.alamat-input').val(value);
            $('.result-box').addClass("hidden");
        }
        function show_review(id){
            $('#reviewModal').modal("show");
        }
        $(document).ready(function() {
            $(".camera-icon").click(function () {
        $("input[type='file']").trigger('click');
      });

      $('input[type="file"]').on('change', function() {
        var val = $(this).val();
        $(this).siblings('span').text(val);
      });
            
            $('.pesan-button').click(function(e){
                e.preventDefault();
                $('#suksesModal').modal("show"); 
            });
            // $('.alamat-input').focus(function(){
            //     $('.result-box').removeClass("hidden");
            // });
        });
    </script>
@endsection
