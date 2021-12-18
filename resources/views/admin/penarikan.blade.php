@extends('admin.layouts.app')

@section('css')
    <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/penarikan.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h1 class="h4">Penarikan</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <a class="button mx-2 px-4 py-2 tambahpenarikan"><i class="fa-solid fa-plus"></i> Penarikan</a>
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
                  <th>Bank</th>
                  <th>Nominal</th>
                  <th>Aksi</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($penarikans as $penarikan)
                <tr>
                  <td>{{ $penarikan->user->email }}</td>
                  <td>{{ $penarikan->user->name }}</td>
                  <td>{{ $penarikan->bank }}</td>
                  <td>{{ number_format($penarikan->jumlah,0,',','.') }}</td>
                  <td>
                    @if($penarikan->keterangan != "Dikonfirmasi")
                      <button type="button" class="edit-button px-3 py-1" onclick="modal_konfirmasi({{$penarikan->id}})">Transfer</button>
                    @endif
                  </td>
                  <td>
                    @if($penarikan->keterangan == "Dikonfirmasi")
                      <i class="color-base">{{ $penarikan->keterangan }}</i> <i class="fa-solid fa-info-circle" onclick="show_detail({{ $penarikan->id }})"></i>
                    @else
                      <i class="color-base-second">{{ $penarikan->keterangan }}</i> <i class="fa-solid fa-info-circle" onclick="show_detail({{ $penarikan->id }})"></i>
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
                    <h3 class="text-center">Status Penarikan</h3>
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
                  <p>Apakah Anda yakin sudah menstransfer?</p>
                  </div>
                  <form action='/' id="formkonfirmasi" method="POST">
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

        <div class="modal fade" id="tambahpenarikanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                  <div class="row">
                  <div class="col-12">
                  <h3 class="text-center">Tambah Topup</h3>
                  </div>
                  </div>
                  <form action="{{ route('admin.penarikan.create') }}" id="form-create-penarikan" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="col-12">
                  <p class="m-0">User</p>
                  <select name="user_id" id="owner" class="input-form w-100 p-2">
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                  </select>
                  <p class="m-0">Saldo</p>
                  <input type="text" name="saldo" placeholder="Saldo Akun" class="input-form w-100 p-2 mb-1" disabled>
                  <p class="m-0">Jumlah Topup</p>
                  <input type="number" name="jumlah" placeholder="Masukkan jumlah" class="input-form w-100 p-2 mb-1" required>
                  <p class="m-0">Bank</p>
                  <input type="text" name="bank" placeholder="Masukkan Nama Bank" class="input-form w-100 p-2 mb-1" required>
                  <p class="m-0">No rek</p>
                  <input type="text" name="no_rek" placeholder="Masukkan No Rekening Bank" class="input-form w-100 p-2 mb-1" required>
                  <p class="m-0">Atas Nama</p>
                  <input type="text" name="atas_nama" placeholder="Masukkan Atas Nama Rekening Bank" class="input-form w-100 p-2 mb-1" required>
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
    function show_detail(id){
      let url= "{{route('api.transaksiDompet.showId','')}}"+"/"+id;
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
                  <p class="m-0">Nama Bank</p>
                  <input type="text" name="" value="${response['content']['bank']}" class="input-form w-100 p-2" disabled>
                  <p class="m-0">Atas Nama Rekening Bank</p>
                  <input type="text" name="" value="${response['content']['atas_nama']}" class="input-form w-100 p-2" disabled>
                  <p class="m-0">No. Rekening</p>
                  <input type="text" name="" value="${response['content']['no_rek']}" class="input-form w-100 p-2" disabled>
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
    function modal_konfirmasi(id){
      $('#konfirmasiModal').modal("show"); 
      user_id = id;
      var url = '{{ route("admin.penarikan.konfirmasi", ":id") }}';
      url = url.replace(':id', user_id);
      $("#formkonfirmasi").attr('action',url);
    }
    function change_saldo(){
      let id= $('select[name=user_id]').val();
      let url= "{{route('transaksi.dompet','')}}"+"/"+id;
      $.ajax({
          url: url,
          type: "get", //send it through get method
          success: function(response) {
              console.log(response['jumlah']);
              var jumlah_display = new Intl.NumberFormat(['ban', 'id']).format(response['jumlah']);
              $('#form-create-penarikan input[name=saldo]').val(jumlah_display);
              $('#form-create-penarikan input[name=jumlah]'). attr({
                "max" : response['jumlah'], // substitute your own.
                "min" : 1 // values (or variables) here.
              });
          },
          error: function(xhr) {
              console.log(xhr);
              //Do Something to handle error
          }
      });
    }
    $(document).ready(function() {
        $('select[name=user_id]').on('change', function() {
          let id= $(this).find(":selected").val();
          let url= "{{route('transaksi.dompet','')}}"+"/"+id;
          $.ajax({
              url: url,
              type: "get", //send it through get method
              success: function(response) {
                  console.log(response['jumlah']);
                  var jumlah_display = new Intl.NumberFormat(['ban', 'id']).format(response['jumlah']);
                  $('#form-create-penarikan input[name=saldo]').val(jumlah_display);
                  $('#form-create-penarikan input[name=jumlah]'). attr({
                    "max" : response['jumlah'], // substitute your own.
                    "min" : 1 // values (or variables) here.
                  });
              },
              error: function(xhr) {
                  console.log(xhr);
                  //Do Something to handle error
              }
          });
        });
        change_saldo();
        $('.tambahpenarikan').click(function(e){
          e.preventDefault();
          $('#tambahpenarikanModal').modal("show"); 
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