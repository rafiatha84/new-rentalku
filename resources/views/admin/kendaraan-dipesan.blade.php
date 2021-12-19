@extends('admin.layouts.app')

@section('css')
    <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <div class="box">
                <a class="sub-menu mx-2 h5 {{ Route::currentRouteNamed('admin.kendaraan') ? 'sub-active' : '' }}" href="{{ route('admin.kendaraan') }}">Galeri Unitku</a>
                <a class="sub-menu mx-2 h5 {{ Route::currentRouteNamed('admin.kendaraan.dipesan') ? 'sub-active' : '' }}" href="{{ route('admin.kendaraan.dipesan') }}">Sedang Dipesan</a>
                <a class="sub-menu mx-2 h5 {{ Route::currentRouteNamed('admin.kendaraan.selesai') ? 'sub-active' : '' }}" href="{{ route('admin.kendaraan.selesai') }}">Selesai</a>
            </div>  
          
            <div class="btn-toolbar mb-2 mb-md-0">
              
            <a class="py-2 base-color mx-2"  href="{{ route('admin.logout') }}">Keluar <i class="fa-solid fa-sign-out-alt base-color"></i></a>
            </div>
          </div>

          <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->
          <div class="table-responsive">
            <table class="table table-sm" id="table-pengguna">
              <thead>
                <tr>
                  <th>Nama unit</th>
                  <th>Nama pengguna</th>
                  <th>Pilihan kota</th>
                  <th>Tanggal sewa</th>
                  <th>Biaya sewa / hari</th>
                  <th>Informasi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($transaksis as $transaksi)
                <tr>
                  <td>{{ $transaksi->kendaraan->name }}</td>
                  <td>{{ $transaksi->user->name }}</td>
                  <td>{{ $transaksi->kendaraan->kota }}</td>
                  <td>{{$transaksi->tanggal_transaksi()}} -{{$transaksi->tanggal_berakhir()}}</td>
                  <td>{{number_format($transaksi->kendaraan->harga,0,',','.')}}</td>
                  <td>
                      <i class="fa-solid fa-info-circle" onclick="show_detail({{ $transaksi->id }})"></i>
                  </td>
                </tr>
                @endforeach
                
              </tbody>
            </table>
          </div>
        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  <p>Apakah Anda yakin akan menghapus pengguna tersebut dari basis data aplikasi RentalKu?</p>
                  </div>
                  <form action='{{ route("admin.user.delete", "0" ) }}' id="formdelete" method="get">
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


        <div class="modal fade" id="profilModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                  <div class="row">
                  <div class="col-12">
                    <img src="{{ asset(Auth::user()->image_link) }}" class="mx-auto d-block rounded-circle" alt="" style="width:200px;">
                  </div>
                  </div>
                  <div class="col-12">
                  <p class="m-0">Nama</p>
                  <input type="text" name="" id="" value="Admin" class="input-form w-100 p-2">
                  <p class="m-0">Email</p>
                  <input type="text" name="" id="" value="Admin@gmail.com" class="input-form w-100 p-2">
                  <p class="m-0">Password</p>
                  <input type="text" name="" id="" value="******" class="input-form w-100 mb-2 p-2">
                  </div>
                  <form action='' id="formdelete" method="get">
                  <div class="row px-5">
                    <div class="col-6">
                    <button type="button" class="btn btn-secondary btn-block btn-cancel" data-dismiss="modal">Tidak</button>
                    </div>
                    <div class="col-6">
                    <button type="submit" class="btn btn-primary btn-block btn-oke">update</button>
                    </div>
                  </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                  <div class="row">
                  <div class="col-12">
                    <h3 class="text-center">Detail Pesanan</h3>
                  </div>
                  </div>
                  <div class="col-12 detail-show">
                  <p class="">Email: aris@gmail.com</p>
                  <p class="">Nama Pengguna: aris</p>
                  <p class="">Total Pembayaran: Rp. 500.232</p>
                  <p class="">Status: <i class="color-yellow">Pengajuan</i></p>
                  <p class="m-0">Nama Bank</p>
                  <input type="text" name="" id="" value="BCA" class="input-form w-100 p-2" disabled>
                  <p class="m-0">Atas Nama Rekening Bank</p>
                  <input type="text" name="" id="" value="Erik" class="input-form w-100 p-2" disabled>
                  <p class="m-0">No. Rekening</p>
                  <input type="text" name="" id="" value="32768279" class="input-form w-100 p-2" disabled>
                  </div>
                  <form action='' id="formdelete" method="get">
                  </form>
              </div>
            </div>
          </div>
        </div>
        

@endsection

@section('js')
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/dataTables.min.js') }}"></script>
  <script>
    function modal_delete(id){
      $('#deleteModal').modal("show"); 
      user_id = id;
      var url = '{{ route("admin.user.delete", ":id") }}';
      url = url.replace(':id', user_id);
      $("#formdelete").attr('action',url);
    }
    function show_detail(id){
      let url= "{{route('api.transaksi.showId','')}}"+"/"+id;
      $.ajax({
          url: url,
          type: "get", //send it through get method
          success: function(response) {
              // console.log(response['content']);
              var jumlah_display = new Intl.NumberFormat(['ban', 'id']).format(response['content']['kendaraan']['harga']);
              var jumlah_display_total = new Intl.NumberFormat(['ban', 'id']).format(response['content']['total_harga']);
              // console.log(response);
              let image_car = "{{ asset('') }}"+response['content']['kendaraan']['image_link'];
              let html_detail = `
              <p class="name mb-0">Nama Pengguna: ${response['content']['user']['name']}</p>
              <p class="email mb-0">Nama Unit: ${response['content']['kendaraan']['name']}</p>
              <p class="email mb-0">Janis Mobil: ${response['content']['kendaraan']['kategori']['name']}</p>
              <p class="email mb-0">Waktu Sewa: ${response['content']['durasi']} Hari</p>
              <br>
              <p class="name mb-0">Nama Pemesan: ${response['content']['name']}</p>
              <p class="name mb-0">Nama Pemesan: ${response['content']['telp']}</p>
              <p class="bank mb-0">Pilihan Kota: ${response['content']['kendaraan']['kota']}</p>
              <img class="img-responsive w-100 my-1" src="${image_car}" />
              <p class="m-0">alamat</p>
              <input type="text" name="alamat" value="${response['content']['alamat']}" placeholder="Masukkan Seat" class="input-form input-info w-100 p-2" disabled>
              <p class="m-0">Tanggal</p>
              <input type="text" name="tanggal" value="${response['content']['tanggal_transaksi']}-${response['content']['tanggal_berakhir']}" placeholder="Masukkan Seat" class="input-form input-info w-100 p-2" disabled>
              `;
              if(response['content']['sopir'] === "Dengan Sopir"){
                html_detail +=`
                <p class="m-0">Sopir</p>
                <input type="text" name="sopir" value="${response['content']['pengemudi_transaksi']['pengemudi']['user']['name']}" placeholder="Masukkan Seat" class="input-form input-info w-100 p-2" disabled>
                <p class="m-0">Total</p>
                <input type="number" name="total" value="${response['content']['total_harga']}" placeholder="Masukkan Seat" class="input-form input-info w-100 p-2" disabled>
                `;
              }else{
                html_detail +=`
                <p class="m-0">Total</p>
                <input type="number" name="total" value="${response['content']['total_harga']}" placeholder="Masukkan Seat" class="input-form input-info w-100 p-2" disabled>
                `;
              }
              $('.detail-show').html(html_detail);

              $('#detailModal').modal("show"); 
          },
          error: function(xhr) {
              console.log(xhr);
              //Do Something to handle error
          }
      });
    }xa
    $(document).ready(function() {
      $('.profil-link').click(function(e){
          e.preventDefault();
          $('#profilModal').modal("show"); 
        });
        $('#table-pengguna').DataTable({
          "language" : {
            "decimal":        "",
            "emptyTable":     "Tak ada data yang tersedia pada tabel ini",
            "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ baris",
            "infoEmpty":      "Menampilkan 0 to 0 of 0 entries",
            "infoFiltered":   "(filtered from _MAX_ total entries)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Tampilkan _MENU_ baris",
            "loadingRecords": "Memuat...",
            "processing":     "Proses...",
            "search":         "Cari:",
            "zeroRecords":    "Tidak ada pencarian yang cocok ditemukan",
            "paginate": {
                "first":      "Pertama",
                "last":       "Terakhir",
                "next":       "Selanjutnya",
                "previous":   "Sebelumnya"
            },
            "aria": {
                "sortAscending":  ": aktifkan untuk mengurutkan kolom menaik",
                "sortDescending": ": aktifkan untuk mengurutkan kolom ke bawah"
            }
        }
        });
    } );
  </script>
  
@endsection