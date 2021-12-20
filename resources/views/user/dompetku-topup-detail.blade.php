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
                    <div class="row mx-auto mt-0 h-100 pb-4 ">
                        <div class="col-4 sidebar-left px-0">
                            <ul class="nav flex-column px-0">
                                <li class="nav-item">
                                    <a href="{{  route('user.dompetku') }}" class="nav-link sidebar-navlink">Riwayat Saldo</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{  route('user.dompetku.topup') }}" class="nav-link sidebar-navlink active">Isi Saldo</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{  route('user.dompetku.topup') }}" class="nav-link sidebar-navlink py-0 nav-submenu">Masukkan Jumlah</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{  route('user.dompetku.topup') }}" class="nav-link sidebar-navlink active py-0 nav-submenu">Detail Top Up</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{  route('user.dompetku.tutorial') }}" class="nav-link sidebar-navlink">Cara Transfer</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-8 py-2 sidebar-right">
                            <h5 class="mt-2"><b>Detail Top Up</b></h5>
                            <hr>
                            <p>Transfer ke nomor rekening</p>
                            <p>
                                
                                <div class="tooltip">
                                <img src="{{ asset($rekening->image_link) }}" alt="" srcset="" class="d-inline">
                                <span id="myInput">{{ $rekening->no_rek }}</span>
                                <button class="salin-button" onclick="myFunction()" onmouseout="outFunc()">
                                    <span class="tooltiptext" id="myTooltip">Copy to clipboard</span>
                                    Salin
                                </button>
                                </div>
                            </p>
                            <p><b>{{$rekening->singkatan}} a/n Alrizdo Adji Junior</b></p>
                            <div class="info-box mb-4 p-2">
                                <p class="m-0 small">RentalKu akan melakukan transfer. Setelah menyelesaikan transaksi, mohon menunggu hingga status transfer berhasil.</p>
                            </div>
                            <p class="m-0">Jumlah yang harus di transfer</p>
                            <h1>Rp<span class="jumlah">{{number_format($transaksi_dompet->jumlah,0,',','.')}}</span></h1>
                            <div class="info-box d-flex info-box-transfer mb-4 p-2">
                                <span style="margin:auto; display:table;" class="mx-1"><i class="fa-solid fa-info px-2 py-1 info-icon align-middle"></i></span>
                                <div class="right-box">
                                <p class="m-0 font-weight-bold">Transfer dengan nominal yang sudah ditambahkan Kode Unik</p>
                                <p class="m-0 small">Mohon transfer dengan nominal yang sudah ditambahkan kode unik, uang yang digunakan untuk kode unik nantinya dapat anda tarik kembali melalui halaman profil</p>    
                                </div>
                            </div>
                            <p class="m-0 mb-3">Rincian Jumlah</p>
                            <div class="m-0">
                                <p class="d-inline-block m-0"><b>Jumlah Transfer</b></p>
                                <span class="float-right">{{number_format($transaksi_dompet->jumlah-$transaksi_dompet->kode_unik,0,',','.')}}</span>
                            </div>
                            <hr class="m-0">
                            <div class="m-0">
                                <p class="d-inline-block m-0"><b>Kode Unik</b></p>
                                <span class="float-right">+{{number_format($transaksi_dompet->kode_unik,0,',','.')}}</span>
                            </div>
                            <hr class="mt-0">
                            <div class="m-0">
                                <p class="d-inline-block m-0"><b>Jumlah yang harus di Transfer</b></p>
                                <span class="float-right">Rp.{{number_format($transaksi_dompet->jumlah,0,',','.')}}</span>
                            </div>
                            <hr class="mt-0 mb-5">
                            <p class="text-center">
                                Anda sudah melakukan transfer?
                            </p>
                            <div class="col-12 text-center">
                                <a href="" class="button-yellow-primary px-3 py-2 konfirmasi-button" >Bayar Sekarang</a>
                            </div>
                            <p class="text-right mt-3 mb-0">
                                <a href="" class="base-href" >Lihat Cara Transfer</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="konfirmasiModal" style="z-index:10000;" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <h2 class="color-base text-center">Konfirmasi Transfer</h2>
                        <p class="text-center">Lakukan konfirmasi transfer hanya jika Anda telah selesai melakukan transfer sesuai intruksi sebelumnya</p>
                    </div>
                </div>
                <div class="row px-5">
                    <div class="col-6">
                    <button type="button" class="btn button-gray btn-block btn-cancel" data-dismiss="modal">Belum</button>
                    </div>
                    <div class="col-6">
                    <button type="button" class="btn btn-block btn-oke button-base radius-5">Sudah</button>
                    </div>
                  </div>
                <form action='' id="formdelete" method="get">
                </form>
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
                    <p class="text-center">jika ingin melihat riwayat saldo anda lebih banyak</p>
                    <p class="text-center">
                        <a href="{{ route('user.dompetku') }}" class="href-base button-yellow-primary p-2 px-4">Lihat sekarang</a>
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
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
        }
        function myFunction() {
            // var copyText = document.getElementById("myInput");
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($("#myInput").text()).select();
            document.execCommand("copy");
            $temp.remove();
            
            var tooltip = document.getElementById("myTooltip");
            tooltip.innerHTML = "Copied: " + $("#myInput").text();
        }

        function outFunc() {
            var tooltip = document.getElementById("myTooltip");
            tooltip.innerHTML = "Copy to clipboard";
        }
        $(document).ready(function(){
            $('.select-jumlah').change(function(){
                $('.jumlah-value').html($('.select-jumlah:checked').val());
            });
            $('.konfirmasi-button').click(function(e){
                e.preventDefault();
                $('#konfirmasiModal').modal("show");
            });
            $('.btn-oke').click(function(){
                $('#konfirmasiModal').modal("toggle");
                $('#suksesModal').modal("show");
            });
            var number = $('.jumlah').text();
            // alert(number.length);
            var length_number = number.length;
            var text_jumlah = '';
            for(let x=0;x<number.length;x++){
                if(length_number <= 3){
                    text_jumlah+=`<span class="yellow-text">${number[x]}</span>`;
                }else{
                    text_jumlah+=`<span>${number[x]}</span>`;
                }
                length_number--;
            }
            $('.jumlah').html(text_jumlah);

        });
    </script>
@endsection