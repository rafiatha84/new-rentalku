@extends('user.layouts.app')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/pemesanan-create.css') }}" rel="stylesheet">
    
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
                                <img src="{{ asset($kendaraan->image_link) }}" alt="" srcset="" class="w-100">
                            </div>
                            <div class="col-6">
                                <form action="{{ route('api.transaksi.create') }}" method="post" id="pemesanan-create" enctype="multipart/form-data">
                                <h5 class="nama text-center">{{$kendaraan->name}}</h5>
                                <p class="jenis text-center">{{$kendaraan->kategori->name}}</p>
                                <div class="rent-car-box mb-2 px-2">
                                    <p class="m-0"><b>CAR RENT- {{$kendaraan->user->name}}</b></p>
                                    <p class="mb-0"><?php echo ($kendaraan->supir == 1) ? 'Dengan Sopir' : 'Tanpa Sopir'; ?></p>
                                </div>
                                <p class="m-0">Sopir</p>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="radio" id="tanpa-sopir" name="sopir" class="checkbox-pilih-supir" value="0" checked/>
                                        <label class="label-button py-2 d-block text-center" for="tanpa-sopir">Tanpa Sopir</label>
                                    </div>
                                    <div class="col-6">
                                    <input type="radio" id="dengan-sopir" name="sopir" class="checkbox-pilih-supir" value="1"/>
                                        <label class="label-button py-2 d-block text-center" for="dengan-sopir">Dengan Sopir</label>
                                    </div>
                                </div>
                                <p class="m-0">Alamat</p>
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}" required>
                                <input type="hidden" name="kendaraan_id" value="{{$kendaraan->id}}" required>
                                <input type="hidden" name="lat" value="0">
                                <input type="hidden" name="long" value="0">
                                <div class="auto-complete">
                                    <input type="text" name="alamat" value="" placeholder="Masukkan Alamat" id="" class="px-2 py-1 alamat-input w-100 white-text">
                                    <div class="result-box hidden">
                                        <p class="result-row px-2 py-1 m-0 search-loader">Mencari alamat ....</p>
                                    </div>
                                </div>
                                <p class="m-0">Tanggal Sewa</p>
                                <input type="date" name="waktu_ambil" id="" class="start-date date w-100 px-2 py-1" required>
                                <p class="m-0">Tanggal pengembalian</p>
                                <input type="date" name="waktu_kembali" id="" class="end-date date w-100 px-2 py-1" required>
                                <div class="rent-car-box mt-2 px-2">
                                <input type="hidden" name="durasi" value="0" required>
                                <p class="m-0"><b><span class="yellow-color">Rp.{{number_format($kendaraan->harga,0,',','.')}}</span>/ <span class="hari">1</span> Hari</b></p>
                                    <p class="mb-0">total- Rp.<span class="harga_total">0</span></p>
                                </div>
                                <hr class="hr-detail">
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button class="btn button-secondary px-5 btn-selanjutnya" onclick="form_selanjutnya()">Selanjutnya</button>
                                    </div>
                                </div>
                                <div class="form-kedua hidden">
                                <h5 class="text-center"><b>Konfirmasi Data diri pemesan</b></h5>
                                    <p class="mb-0 mt-1">Nama Lengkap</p>
                                    <input type="text" name="name" id="" placeholder="Masukkan nama" class="radius-20 p-2 w-100">
                                    <p class="mb-0 mt-1">No Telepon</p>
                                    <input type="text" name="telp" id="" placeholder="Masukkan telp" class="radius-20 p-2 w-100">
                                    <p class="mb-0 mt-1">Nomor Induk Kependudukan</p>
                                    <input type="text" name="nik" id="" placeholder="Masukkan NIK" class="radius-20 p-2 w-100">
                                    <p class="mb-0 mt-1">Upload Foto KTP</p>
                                    <div class="element w-100 radius-20">
                                        <i class="fa-solid fa-camera base-color camera-icon"></i><span class="name">No file selected</span>
                                        <input type="file" name="foto_ktp" id="" placeholder="" class="input-form input-foto">
                                    </div>
                                    <hr>
                                    @if($kendaraan->user->pengemudi->count() > 0)
                                    <div class="sopir-div">
                                    <h5   h5 class="text-center">Pilih Sopir</h5>
                                    <div class="row">
                                        @foreach($kendaraan->user->pengemudi as $pengemudi)
                                        <div class="col-6">
                                        <input type="radio" id="{{$pengemudi->id}}" name="pengemudi_id" class="checkbox-supir" value="{{$pengemudi->id}}"/>
                                        <label class="supir-box py-2 d-block" for="{{$pengemudi->id}}">
                                        <div class="box-img-supir mx-auto">
                                                <img src="{{ asset($pengemudi->user->image_link) }}" class="img-responsive w-100" alt="">
                                            </div>
                                            <p class="m-0 text-center">{{ $pengemudi->user->name }}</p>
                                            <?php 
                                            $ratingAvg = 0;
                                            $ratingSum=0;
                                            if($pengemudi->user->ratingUser->count()>0){
                                                foreach($pengemudi->user->ratingUser as $rating){
                                                    $ratingSum += $rating->jumlah_bintang;
                                                }
                                                $ratingAvg=$ratingSum/$pengemudi->user->ratingUser->count();
                                            }
                                            ?>
                                            <p class="m-0 text-center"><i class="fa-solid fa-star star-active"></i>{{number_format($ratingAvg,1)}}</p>
                                        </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                    </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-2 text-center my-2">
                                            <i class="fa-solid fa-wallet base-color" style="font-size:30px;"></i>
                                        </div>
                                        <div class="col-10">
                                            <p><b>Saldo Anda</b></p>
                                            <p>Rp.{{number_format($dompet->saldo,0,',','.')}}</p>
                                        </div>
                                    </div>
                                    <p class="text-center">Pembayaran dengan dompetksu</p>
                                    <p class="saldo-tidak-cukup text-center text-danger" style="display:none;color:#dc3545!important;">Saldo anda tidak cukup!!!</p>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <button type="submit" class="btn button-base button-yellow-primary px-5 pesan-button" value="Submit">
                                                <div class="d-flex justify-content-center">
                                                    <div class="spinner-border" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                </div> Pesan Sekarang
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                </form>
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
                    <h4 class="text-center"><a href="{{ route('user.pesananku') }}" class="href-base">Lihat Pesananku</a></h4>
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
        function form_selanjutnya(){
            $('.btn-selanjutnya').addClass("hidden");
            $('.form-kedua').removeClass("hidden");
        }
        function setvalue(value,lat,long){
            $('.alamat-input').val(value);
            $('input[name="lat"]').val(lat);
            $('input[name="long"]').val(long);
            $('.result-box').addClass("hidden");
        }
        function sum_hari(){
            if($('.start-date').val() != '' && $('.start-date').val() != null && $('.end-date').val() != '' && $('.end-date').val() != null){
                var start = new Date($('.start-date').val()),
                    end   = new Date($('.end-date').val()),
                    diff  = new Date(end - start),
                    days  = diff/1000/60/60/24;
                days+=1;
                var harga_total = {{$kendaraan->harga }}*days;
                var harga_total_display = new Intl.NumberFormat(['ban', 'id']).format(harga_total);
                $('.harga_total').text(harga_total_display);
                $('input[name="durasi"]').val(days);
                if(harga_total > {{ $dompet->saldo }}){
                    $(':input[type="submit"]').prop('disabled', true);
                    $('.saldo-tidak-cukup').show();
                }else{
                    $(':input[type="submit"]').prop('disabled', false);
                    $('.saldo-tidak-cukup').hide();

                }
                // alert(days);
            }
        }
        function cek_sopir(){
            let sopir = 0;
            sopir=$('input[name=sopir]:checked').val();
            if(sopir === "0"){
                $('.sopir-div').addClass('hidden');
            }else{
                $('.sopir-div').removeClass('hidden');
            }
        }
        $('input[name=sopir]').on('change',function(){
            cek_sopir();
        });
        $(document).ready(function() {
            $('#pemesanan-create').submit(function(e){
                e.preventDefault();
                // console.log($('#pemesanan-create').serialize());
                /* get the action attribute from the <form action=""> element */
                var $form = $(this), url = $form.attr('action');
                let formData = new FormData($('#pemesanan-create')[0]);
                let file = $('input[type=file]')[0].files[0];
                formData.append('foto_ktp', file, file.name);
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
                        var transaksi_id = response['content']['id'];
                        $('#pemesanan-create')[0].reset();
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
            cek_sopir();
            $(".camera-icon").click(function () {
                $("input[type='file']").trigger('click');
            });

            $('input[type="file"]').on('change', function() {
                var val = $(this).val();
                $(this).siblings('span').text(val);
                
            });
            
            // $('.pesan-button').click(function(e){
            //     e.preventDefault();
            //     $('#suksesModal').modal("show"); 
            // });
            // $('.alamat-input').focus(function(){
                
            // });
            $(".alamat-input").on("input", function() {
                // alert($(this).val()); 
                $('.result-box').removeClass("hidden");
                $(".result-box").html(` <p class="result-row px-2 py-1 m-0 search-loader">Mencari alamat ....</p>`);
                var urlmaps = "{{ route('api.maps.search') }}";
                $.ajax({
                    url: urlmaps,
                    type: "get", //send it through get method
                    data: {
                        address: $(this).val()
                    },
                    success: function(response) {
                        // console.log(response['result']);
                        var newHtml = "";
                        if(response['result']['candidates'].length > 0){
                            response['result']['candidates'].forEach(function show(item, index){
                                newHtml += `<p class="result-row px-2 py-1 m-0 search-loader" onclick="setvalue('${item['formatted_address']}','${item['geometry']['location']['lat']}','${item['geometry']['location']['lng']}')">${item['formatted_address']}</p>`;
                                // console.log(item['geometry']['location']['lat']);
                            });
                            $('.result-box').html(newHtml);
                        }else{
                            // alert('tidak ditemukan');
                            $(".result-box").html(`<p class="result-row px-2 py-1 m-0 search-loader">Alamat tidak ditemukan.</p>`);
                        }
                        
                    },
                    error: function(xhr) {
                        console.log(xhr);
                        //Do Something to handle error
                    }
                });
            });
            $('.start-date').on('input',function() {
                
                var date = $(this).val();
                $('.end-date').attr('min',date);
                sum_hari();
                // console.log(date, 'change')
            });
            $('.end-date').on('input',function() {
                var date = $(this).val();
                $('.start-date').attr('max',date);
                sum_hari();
                // console.log(date, 'change')
            });
        });
    </script>
@endsection
