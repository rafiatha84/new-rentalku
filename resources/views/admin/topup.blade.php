@extends('admin.layouts.app')

@section('css')
    <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/topup.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h1 class="h4">Isi Saldo</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <!-- <a class="button mx-2 px-4 py-2 tambahtopup"><i class="fa-solid fa-plus"></i> Topup</a> -->
              <a class="py-2 base-color mx-2"  href="{{ route('admin.logout') }}">Keluar <i class="fa-solid fa-sign-out-alt base-color"></i></a>
            </div>
          </div>

          <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->
          <div class="table-responsive">
            <table class="table table-sm" id="table-pengguna">
              <thead>
                <tr>
                  <th>Email</th>
                  <th>Nama pengguna</th>
                  <th>Pilihan Pembayaran</th>
                  <th>Nominal</th>
                  <th>Aksi</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($topups as $topup)
                <tr>
                  <td>{{ $topup->user->email }}</td>
                  <td>{{ $topup->user->name }}</td>
                  <td>{{ $topup->bank }}</td>
                  <td>Rp.{{ number_format($topup->jumlah,0,',','.') }}</td>
                  <td>
                    @if($topup->status != "Dikonfirmasi")
                      <button type="button" class="edit-button px-3 py-1" onclick="modal_konfirmasi({{$topup->id}})">Konfirmasi</button>
                    @endif
                  </td>
                  <td>
                    @if($topup->status == "Dikonfirmasi")
                      <i class="color-base">{{ $topup->status }}</i> <i class="fa-solid fa-info-circle" onclick="show_detail({{$topup->id}})"></i>
                    @else
                      <i class="color-base-second">{{ $topup->status }}</i> <i class="fa-solid fa-info-circle" onclick="show_detail({{$topup->id}})"></i>
                    @endif
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

        <div class="modal fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                  <p>Apakah Anda yakin akan mengkonfirmasi isi saldo ini?</p>
                  </div>
                  <form action='{{ route("admin.topup.konfirmasi", ":id" ) }}' id="formkonfirmasi" method="POST">
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
                    <h3 class="text-center">Status Isi Saldo</h3>
                  </div>
                  </div>
                  <div class="col-12 detail-show">
                  <p class="email">Email: spanaris@gmail.com</p>
                  <p class="name">Nama Pengguna: aris</p>
                  <p class="bank">Pilihan Pembayaran: Bank BCA</p>
                  <p class="jumlah">Total Pembayaran: Rp. 500.232</p>
                  <p class="status">Status: <i class="color-yellow">Sudah Bayar</i></p>
                  
                  </div>
                  <form action='' id="formdelete" method="get">
                  </form>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="tambahtopupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                  <div class="row">
                  <div class="col-12">
                  <h3 class="text-center">Tambah Topup</h3>
                  </div>
                  </div>
                  <form action="{{ route('admin.topup.create') }}" id="form-create-penyewa" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="col-12">
                  <p class="m-0">User</p>
                  <select name="user_id" id="owner" class="input-form w-100 p-2">
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                  </select>
                  <p class="m-0">Bank</p>
                  <select name="rekening_id" id="kategori" class="input-form w-100 p-2">
                    @foreach($rekenings as $rekening)
                    <option value="{{$rekening->id}}">{{$rekening->name}}</option>
                    @endforeach
                  </select>
                  <p class="m-0">Jumlah Topup</p>
                  <input type="number" name="jumlah" placeholder="Masukkan jumlah" class="input-form w-100 p-2 mb-1">
                  <div class="row px-5">
                    <div class="col-6">
                    <button type="button" class="btn btn-secondary btn-block btn-cancel" data-dismiss="modal">Tidak</button>
                    </div>
                    <div class="col-6">
                    <button type="submit" class="btn btn-primary btn-block btn-oke">tambah</button>
                    </div>
                  </div>
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
    function modal_konfirmasi(id){
      $('#konfirmasiModal').modal("show"); 
      user_id = id;
      var url = '{{ route("admin.topup.konfirmasi", ":id") }}';
      url = url.replace(':id', user_id);
      $("#formkonfirmasi").attr('action',url);
    }
    function show_detail(id){
      let url= "{{route('api.transaksiDompet.show','')}}"+"/"+id;
      $.ajax({
          url: url,
          type: "get", //send it through get method
          success: function(response) {
              console.log(response['content']['jumlah']);
              var jumlah_display = new Intl.NumberFormat(['ban', 'id']).format(response['content']['jumlah']);
              let css_status = "color-yellow";
              if(response['content']['status'] === "Dikonfirmasi"){
                css_status= "color-base";
              }
              let html_detail = `
                  <p class="email">Email: ${response['content']['user']['email']}</p>
                  <p class="name">Nama Pengguna: ${response['content']['user']['name']}</p>
                  <p class="bank">Pilihan Pembayaran: Bank ${response['content']['bank']}</p>
                  <p class="jumlah">Total Pembayaran: Rp.${jumlah_display}</p>
                  <p class="status">Status: <i class="${css_status}">${response['content']['status']}</i></p>
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
        $('.tambahtopup').click(function(e){
          e.preventDefault();
          $('#tambahtopupModal').modal("show"); 
        });
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