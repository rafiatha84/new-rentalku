@extends('user.layouts.pemilik')

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
                                <img src="{{ asset('image/avanza.jpeg') }}" alt="" srcset="" class="w-100">
                            </div>
                            <div class="col-6">
                                <h5 class="nama text-center">Toyota Avanza</h5>
                                <p class="jenis text-center">Mini MPV</p>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="rent-car-box mb-2 px-2">
                                            <p class="m-0"><b>CAR RENT- Muhammad</b></p>
                                            <p class="mb-0">Tanpa Sopir</p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                    <a href="{{  route('pemilik.lacak',3) }}" class="base-href button-yellow-primary d-block px-2 py-1 href-base">Lacak Mobil</a>
                                    </div>
                                </div>
                                <p class="m-0">Alamat</p>
                                <div class="auto-complete">
                                    <input type="text" name="" value="Jl. Kampung Seng" placeholder="Masukkan Alamat" id="" class="px-2 py-1 alamat-input w-100">
                                    <div class="result-box hidden">
                                        <p class="result-row px-2 py-1 m-0" onclick="setvalue('Jl.Kampung Seng')">Jl. Kampung Seng 77</p>
                                        <p class="result-row px-2 py-1 m-0" onclick="setvalue('Jl.Kampung Seng')">Jl. Kampung Seng 77</p>
                                        <p class="result-row px-2 py-1 m-0" onclick="setvalue('Jl.Kampung Seng')">Jl. Kampung Seng 77</p>
                                        <p class="result-row px-2 py-1 m-0" onclick="setvalue('Jl.Kampung Seng')">Jl. Kampung Seng 77</p>
                                        <p class="result-row px-2 py-1 m-0" onclick="setvalue('Jl.Kampung Seng')">Jl. Kampung Seng 77</p>
                                        <p class="result-row px-2 py-1 m-0" onclick="setvalue('Jl.Kampung Seng')">Jl. Kampung Seng 77</p>
                                        <p class="result-row px-2 py-1 m-0" onclick="setvalue('Jl.Kampung Seng')">Jl. Kampung Seng 77</p>
                                        <p class="result-row px-2 py-1 m-0" onclick="setvalue('Jl.Kampung Seng')">Jl. Kampung Seng 77</p>
                                        <p class="result-row px-2 py-1 m-0" onclick="setvalue('Jl.Kampung Seng')">Jl. Kampung Seng 77</p>
                                        <p class="result-row px-2 py-1 m-0" onclick="setvalue('Jl.Kampung Seng')">Jl. Kampung Seng 77</p>
                                        <p class="result-row px-2 py-1 m-0" onclick="setvalue('Jl.Kampung Seng')">Jl. Kampung Seng 77</p>
                                        <p class="result-row px-2 py-1 m-0" onclick="setvalue('Jl.Kampung Seng')">Jl. Kampung Seng 77</p>
                                        <p class="result-row px-2 py-1 m-0" onclick="setvalue('Jl.Kampung Seng')">Jl. Kampung Seng 77</p>
                                        <p class="result-row px-2 py-1 m-0" onclick="setvalue('Jl.Kampung Seng')">Jl. Kampung Seng 77</p>
                                        <p class="result-row px-2 py-1 m-0" onclick="setvalue('Jl.Kampung Seng')">Jl. Kampung Seng 77</p>
                                        <p class="result-row px-2 py-1 m-0" onclick="setvalue('Jl.Kampung Seng')">Jl. Kampung Seng 77</p>
                                        <p class="result-row px-2 py-1 m-0" onclick="setvalue('Jl.Kampung Seng')">Jl. Kampung Seng 77</p>
                                    </div>
                                </div>
                                <p class="m-0">Tanggal Sewa</p>
                                <input type="date" name="" id="" class="date w-100 px-2 py-1" value="2013-01-08">
                                <p class="m-0">Tanggal pengembalian</p>
                                <input type="date" name="" id="" class="date w-100 px-2 py-1" value="2013-01-08">
                                <p class="m-0">Sopir</p>
                                <div class="row">
                                    <div class="col-8">
                                        <input type="text" name="" id="" class="base-background text-white w-100 px-2 px-2 py-1" value="2013-01-08">
                                    </div>
                                    <div class="col-4">
                                        <a href="" class="button-yellow-primary d-block w-100 px-2 py-1 href-base">Hubungi</a>
                                    </div>
                                </div>
                                
                                <div class="rent-car-box mt-2 px-2">
                                    <p class="m-0"><b><span class="yellow-color">Rp. 280.000</span>/ 1 Hari</b></p>
                                    <p class="mb-0">total- Rp. 280.000</p>
                                </div>
                                <hr class="hr-detail">
                                <h5 class="text-center"><b>Data diri pemesan</b></h5>
                                <div class="rent-car-box px-2">
                                    <p class="mb-0 mt-1">Muhammad Rafi</p>
                                    <p class="mb-0 mt-1">088805189145</p>
                                    <p class="mb-0 mt-1">357811310598937</p>
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
