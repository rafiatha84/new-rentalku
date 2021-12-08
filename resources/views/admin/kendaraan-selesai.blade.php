@extends('admin.layouts.app')

@section('css')
    <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <div class="box">
                <a class="sub-menu mx-2 h5 {{ Route::currentRouteNamed('admin.kendaraan') ? 'sub-active' : '' }}" href="{{ route('admin.kendaraan') }}">Gallery Unitku</a>
                <a class="sub-menu mx-2 h5 {{ Route::currentRouteNamed('admin.kendaraan.dipesan') ? 'sub-active' : '' }}" href="{{ route('admin.kendaraan.dipesan') }}">Sedang Dipesan</a>
                <a class="sub-menu mx-2 h5 {{ Route::currentRouteNamed('admin.kendaraan.selesai') ? 'sub-active' : '' }}" href="{{ route('admin.kendaraan.selesai') }}">Selesai</a>
            </div>  
          
            <div class="btn-toolbar mb-2 mb-md-0">
              
              <div class="dropdown show">
                <a class="btn btn-secondary dropdown-toggle button-trans" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Admin Rentalku
                </a>

                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a href="" class="dropdown-item profil-link">Profil Admin</a>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a>
                </div>
                </div>
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
                    <img src="{{ asset('image/profil.png') }}" class="mx-auto d-block rounded-circle" alt="" style="width:200px;">
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
              // console.log(response['content']['kendaraan']['harga']);
              var jumlah_display = new Intl.NumberFormat(['ban', 'id']).format(response['content']['kendaraan']['harga']);
              var jumlah_display_total = new Intl.NumberFormat(['ban', 'id']).format(response['content']['total_harga']);
              // console.log(response);
              let html_detail = `
                  <p class="email">Nama Unit: ${response['content']['kendaraan']['name']}</p>
                  <p class="name">Nama Pengguna: ${response['content']['user']['name']}</p>
                  <p class="bank">Pilihan Kota: ${response['content']['kendaraan']['kota']}</p>
                  <p class="jumlah">Tanggal Sewa: ${response['content']['tanggal_transaksi']}-${response['content']['tanggal_berakhir']}</p>
                  <p class="status">Status: <i class="color-yellow">${response['content']['status']}</i></p>
                  <p class="status">Biaya Sewa/Hari: Rp.${jumlah_display}</p>
                  <p class="status">Total Biaya: Rp.${jumlah_display_total}</p>
              `;
              $('.detail-show').html(html_detail);

              $('#detailModal').modal("show"); 
          },
          error: function(xhr) {
              console.log(xhr);
              //Do Something to handle error
          }
      });

      
    }
    $(document).ready(function() {
      $('.profil-link').click(function(e){
          e.preventDefault();
          $('#profilModal').modal("show"); 
        });
        $('#table-pengguna').DataTable({
          "language" : {
            "decimal":        "",
            "emptyTable":     "No data available in table",
            "info":           "Menampilkan _START_ sampai _END_ dari _TOTAL_ baris",
            "infoEmpty":      "Menampilkan 0 to 0 of 0 entries",
            "infoFiltered":   "(filtered from _MAX_ total entries)",
            "infoPostFix":    "",
            "thousands":      ",",
            "lengthMenu":     "Tampilkan _MENU_ baris",
            "loadingRecords": "Loading...",
            "processing":     "Processing...",
            "search":         "Cari:",
            "zeroRecords":    "No matching records found",
            "paginate": {
                "first":      "First",
                "last":       "Last",
                "next":       "Next",
                "previous":   "Previous"
            },
            "aria": {
                "sortAscending":  ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        }
        });
    } );
  </script>
  
@endsection