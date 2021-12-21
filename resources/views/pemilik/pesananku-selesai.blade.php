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
                            <a href="{{ route('pemilik.pesananku') }}" class="h4 base-color sub-menu-btn d-block m-0 p-2 left href-base">Sedang Dipesan</a>
                        </div>
                        <div class="col-6 text-center m-0 pr-2 pl-0">
                            <a href="{{ route('pemilik.pesananku.selesai') }}" class="h4 base-color sub-menu-btn d-block m-0 p-2 right href-base active">Selesai</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="table-outer">
        @if($transaksis->count() > 0)
        <div id="table-pesananku ">
            <div class="container">
                <div class="row col-12 table-box my-4 p-0">
                    <table class="table table-pesanan">
                    <thead>
                        <tr>
                        <th scope="col" class="text-center">Gambar</th>
                        <th scope="col" class="text-center">Nama</th>
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
                            <td class="text-center">{{$transaksi->tanggal_transaksi()}} -{{$transaksi->tanggal_berakhir()}} </td>
                            <td class="text-center">{{$transaksi->sopir()}}</td>
                            <td class="text-center">Rp.{{number_format($transaksi->kendaraan->harga,0,',','.')}}/Hari</td>
                            <td class="aksi-column">
                                <div class="row col-12">
                                    <div class="col-6 text-center">
                                        <a href="{{ route('pemilik.pemesanan.detail',$transaksi->id) }}" class=" button-yellow-primary p-2 d-block border-radius-5px">lihat data<br>pemesanan</a>
                                    </div>
                                    <div class="col-6 text-center px-1">
                                        <button class="href-base button-yellow-secondary p-2 d-block w-100 border-radius-5px" onclick="show_room()">Hubungi<br>penyewa</button>
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
    </div>

    <div class="modal fade bd-example-modal-lg" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <h4>Nilai Produk</h4>
                    </div>
                </div>
                <form action="" id="form-send-rating" method="POST">
                
                </form>
            </div>
        </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="suksesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <p class="text-center"><i class="far fa-check-circle base-color sukses-icon"></i></p>
                        <h5 class="text-center">Terima kasih telah memberikan penilaian</h5>
                    </div>
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
        function show_review(id){
            let url= "{{route('api.transaksi.showId','')}}"+"/"+id;
            $.ajax({
                url: url,
                type: "get", //send it through get method
                beforeSend: function() {
                    showLoader();
                    $(':input[type="submit"]').prop('disabled', true);
                },
                success: function(response) {
                    let new_form= `
                    <input type="hidden" name="user_id" value="${response['content']['user']['id']}">
                    <input type="hidden" name="transaksi_id" value="${id}">
                    `;
                    console.log(response);
                    if(response['content']['pengemudi_transaksi'] === null){
                        console.log("betul");
                    }
                    // kendaraan
                    kendaraan_image = "{{ asset('/') }}"+response['content']['kendaraan']['image_link'];
                    let kendaraan_form = `
                    <!-- review kendaraan -->
                    <div class="row">
                        <div class="image-box col-3">
                            <img src="${kendaraan_image}" alt="" srcset="" class="img-ulasan">
                        </div>
                        <div class="col-9 align-self-center">
                            <h5 class="mb-0">kendaraan <b>${response['content']['kendaraan']['name']}</b></h5>
                            <h5 class="jenis-mobil">${response['content']['kendaraan']['kategori']['name']}</h5>
                        </div>
                    </div>
                    <div class="row col-12">
                        <input type="hidden" name="kendaraan_star" value="0" required>
                        <ul class="m-0 mb-2 star-box mx-auto">
                            <li class="kendaraan star-button 5"><i class="fa-solid fa-star mx-2"></i></li>
                            <li class="kendaraan star-button 4"><i class="fa-solid fa-star mx-2"></i></li>
                            <li class="kendaraan star-button 3"><i class="fa-solid fa-star mx-2"></i></li>
                            <li class="kendaraan star-button 2"><i class="fa-solid fa-star mx-2"></i></li>
                            <li class="kendaraan star-button 1"><i class="fa-solid fa-star mx-2"></i></li>
                        </ul>
                    </div>
                    <textarea name="kendaraan_review" cols="30" rows="5" placeholder="Beritahu pengguna lain mengapa Anda sangat menyukai pemilik ini... " class="review-input w-100 px-5 py-2"></textarea>
                    `;
                    new_form += kendaraan_form;
                    //pemilik
                    pemilik_image = "{{ asset('/') }}"+response['content']['user']['image_link'];
                    let pemilik_form = `
                    <!-- review pemilik -->
                    <div class="row">
                        <div class="image-box col-3">
                            <img src="${pemilik_image}" alt="" srcset="" class="img-ulasan">
                        </div>
                        <div class="col-9 align-self-center">
                            <h5 class="mb-0">Pemilik <b>${response['content']['kendaraan']['name']}</b></h5>
                            <h5 class="jenis-mobil">${response['content']['kendaraan']['kategori']['name']}</h5>
                        </div>
                    </div>
                    <div class="row col-12">
                        <input type="hidden" name="pemilik_star" value="0" required>
                        <ul class="m-0 mb-2 star-box mx-auto">
                            <li class="pemilik star-button 5"><i class="fa-solid fa-star mx-2"></i></li>
                            <li class="pemilik star-button 4"><i class="fa-solid fa-star mx-2"></i></li>
                            <li class="pemilik star-button 3"><i class="fa-solid fa-star mx-2"></i></li>
                            <li class="pemilik star-button 2"><i class="fa-solid fa-star mx-2"></i></li>
                            <li class="pemilik star-button 1"><i class="fa-solid fa-star mx-2"></i></li>
                        </ul>
                    </div>
                    <textarea name="pemilik_review" cols="30" rows="5" placeholder="Beritahu pengguna lain mengapa Anda sangat menyukai pemilik ini... " class="review-input w-100 px-5 py-2"></textarea>
                    `;
                    new_form += pemilik_form;
                    if(response['content']['pengemudi_transaksi'] !== null){
                        //pengemudi
                        pengemudi_image = "{{ asset('/') }}"+response['content']['pengemudi_transaksi']['pengemudi']['user']['image_link'];
                        let pengemudi_form = `
                        <!-- review pemilik -->
                        <div class="row">
                            <div class="image-box col-3">
                                <img src="${pengemudi_image}" alt="" srcset="" class="img-ulasan">
                            </div>
                            <div class="col-9 align-self-center">
                                <h5 class="mb-0">Pengemudi <b>${response['content']['kendaraan']['name']}</b></h5>
                                <h5 class="jenis-mobil">${response['content']['kendaraan']['kategori']['name']}</h5>
                            </div>
                        </div>
                        <div class="row col-12">
                            <input type="hidden" name="pengemudi_star" value="0" required>
                            <ul class="m-0 mb-2 star-box mx-auto">
                                <li class="pengemudi star-button 5"><i class="fa-solid fa-star mx-2"></i></li>
                                <li class="pengemudi star-button 4"><i class="fa-solid fa-star mx-2"></i></li>
                                <li class="pengemudi star-button 3"><i class="fa-solid fa-star mx-2"></i></li>
                                <li class="pengemudi star-button 2"><i class="fa-solid fa-star mx-2"></i></li>
                                <li class="pengemudi star-button 1"><i class="fa-solid fa-star mx-2"></i></li>
                            </ul>
                        </div>
                        <textarea name="pengemudi_review" cols="30" rows="5" placeholder="Beritahu pengguna lain mengapa Anda sangat menyukai pemilik ini... " class="review-input w-100 px-5 py-2"></textarea>
                        `;
                        new_form += pengemudi_form;
                    }
                    let button_form = `
                    <div class="row">
                        <div class="col-12 py-2 text-right">
                            <button type="submit" class="btn button-yellow-primary radius-5 btn-kirim">
                                <div class="d-flex justify-content-center">
                                    <div class="spinner-border" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>Kirim
                            </button>
                        </div>
                    </div>
                    `;
                    new_form+=button_form;
                    $('#reviewModal').modal("show");
                    $('#form-send-rating').html(new_form);
                    
                    $('#form-send-rating').attr('action',"{{ route('api.transaksi.rating') }}");
                    removeLoader();
                    $(':input[type="submit"]').prop('disabled', false);
                    return false;
                },
                error: function(xhr) {
                    console.log(xhr);
                    //Do Something to handle error
                }
            });
            
        }
        $('body').on('click','.star-button',function(e){
            var getClass = this.classList;
            let star = "."+getClass[0]+"."+getClass[1];
            $(star).removeClass('active');
            // var number = getClass.match(/\d/g);
            // number = parseInt(number);
            var role = getClass[0];
            var number = getClass[2];
            // console.log(number);
            for(let i=1;i<=parseInt(number);i++){
                let element = "."+getClass[0]+"."+getClass[1]+"."+i;
                // console.log(element);
                $(element).addClass('active');
            }
            let input_star = "input[name='"+getClass[0]+"_star"+"']";
            $(input_star).val(number);
        });
        $(document).on('submit','#form-send-rating',function(e){
            e.preventDefault();
            let url = "{{ route('api.transaksi.rating') }}";
            let formData = new FormData($('#form-send-rating')[0]);
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
                    $('#form-send-rating')[0].reset();
                    $('#reviewModal').modal("toggle");
                    $('#suksesModal').modal("show"); 
                    $(':input[type="submit"]').prop('disabled', false);
                    removeLoader();
                },
                error: function(xhr) {
                    alert('error');
                    console.log(xhr);
                    //Do Something to handle error
                }
            });

        });
        $('#suksesModal').on('hidden.bs.modal', function () {
            location.reload();
        });
        $(document).ready(function(){
            
            
        });
    </script>

@endsection
