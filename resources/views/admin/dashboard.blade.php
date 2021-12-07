@extends('admin.layouts.app')

@section('css')
    <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h1 class="h4">Pengguna</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <a class="button mx-2 px-4 py-2 tambahpenyewa"><i class="fa-solid fa-plus"></i> Penyewa</a>
              <a class="button mx-2 px-4 py-2 tambahpemilik"><i class="fa-solid fa-plus"></i> Pemilik mobil</a>
              <a class="button mx-2 px-4 py-2 tambahsopir"><i class="fa-solid fa-plus"></i> Sopir</a>
              <a class="button mx-2 px-4 py-2 tambahadmin"><i class="fa-solid fa-plus"></i> Admin</a>
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
                  <th>Email</th>
                  <th>Nama pengguna</th>
                  <th>Sebagai</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->role }}</td>
                  <td>
                    <button type="button" class="delete-button px-3 py-1" onclick="modal_delete({{ $user->id }})"><i class="fa-solid fa-trash"></i></button>
                    <button type="button" class="edit-button px-3 py-1" onclick="modal_user({{ $user->id }})"><i class="fa-solid fa-edit"></i></button>
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
                  <form action='/' id="formdelete" method="POST">
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
                    <img src="{{ asset('image/profil.png') }}" class="mx-auto d-block rounded-circle" alt="" style="width:200px;">
                  </div>
                  </div>
                  <div class="col-12">
                  <p class="m-0">Nama</p>
                  <input type="text" name=""  value="Admin" class="input-form w-100 p-2">
                  <p class="m-0">Email</p>
                  <input type="text" name=""  value="Admin@gmail.com" class="input-form w-100 p-2">
                  <p class="m-0">Password</p>
                  <input type="text" name=""  value="******" class="input-form w-100 mb-2 p-2">
                  </div>
                  <form action='' id="formprofil" method="get">
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

        <div class="modal fade" id="tambahpenyewaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                  <div class="row">
                  <div class="col-12">
                  <h3 class="text-center">Tambah Penyewa</h3>
                  </div>
                  </div>
                  <form action="{{ route('admin.user.create') }}" id="form-create-penyewa" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="role" value="user">
                  <div class="col-12">
                  <p class="m-0">Nama</p>
                  <input type="text" name="name" placeholder="nama" class="input-form w-100 p-2">
                  <p class="m-0">Email</p>
                  <input type="text" name="email" placeholder="testn@gmail.com" class="input-form w-100 p-2">
                  <p class="m-0">Password</p>
                  <input type="text" name="password" value="******" class="input-form w-100 mb-2 p-2">
                  </div>
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

        <div class="modal fade" id="tambahpemilikModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                  <div class="row">
                  <div class="col-12">
                  <h3 class="text-center">Tambah Pemilik</h3>
                  </div>
                  </div>
                  <div class="col-12">
                  <form action="{{ route('admin.user.create') }}" id="form-create-pemilik" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="role" value="pemilik">
                  <p class="m-0">Nama</p>
                  <input type="text" name="name"  placeholder="nama" class="input-form w-100 p-2">
                  <p class="m-0">Email</p>
                  <input type="text" name="email"  placeholder="testn@gmail.com" class="input-form w-100 p-2">
                  <p class="m-0">Password</p>
                  <input type="text" name="password"  value="******" class="input-form w-100 mb-2 p-2">
                  <p class="m-0">Nomor Induk Kependudukan</p>
                  <input type="text" name="nik"  placeholder="NIK" class="input-form w-100 p-2">
                  <p class="m-0">Foto KTP</p>
                  <div class="element w-100 radius-20 ">
                      <i class="fa-solid fa-camera base-color camera-icon" onclick="click_input('#foto-ktp-pemilik');"></i><span class="name" id="foto-ktp-name">No file selected</span>
                      <input type="file" name="foto_ktp" id="foto-ktp-pemilik" placeholder="" class="input-form input-foto" onchange="previewFile(this,'#foto-ktp-image-pemilik');">
                  </div>
                  <img src="/" alt="" id="foto-ktp-image-pemilik" class="image-produk img-upload w-100 mt-2 hidden">
                  </div>
                  <div class="row px-5 mt-2">
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

        <div class="modal fade" id="tambahsopirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                  <div class="row">
                  <div class="col-12">
                    <h3 class="text-center">Tambah Sopir</h3>
                  </div>
                </div>
                <div class="col-12">
                  <form action="{{ route('admin.user.create') }}" id="form-create-supir" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="role" value="pengemudi">
                  <p class="m-0">Owner</p>
                  <select name="owner_id" id="owner" class="input-form w-100 p-2">
                    @foreach($pemiliks as $pemilik)
                    <option value="{{$pemilik->id}}">{{$pemilik->name}}</option>
                    @endforeach
                  </select>
                  <p class="m-0">Harga sopir / Hari</p>
                  <input type="number" name="harga" placeholder="Harga sopir" class="input-form w-100 p-2">
                  <p class="m-0">Nama</p>
                  <input type="text" name="name"  placeholder="nama" class="input-form w-100 p-2">
                  <p class="m-0">Email</p>
                  <input type="text" name="email" placeholder="testn@gmail.com" class="input-form w-100 p-2">
                  <p class="m-0">Password</p>
                  <input type="password" name="password" value="******" class="input-form w-100 mb-2 p-2">
                  <p class="m-0">Nomor Induk Kependudukan</p>
                  <input type="text" name="nik" placeholder="NIK" class="input-form w-100 p-2">
                  <p class="m-0">Foto Ktp</p>
                  <div class="element w-100 radius-20 ">
                      <i class="fa-solid fa-camera base-color camera-icon" onclick="click_input('#foto-ktp-penyewa');"></i><span class="name" id="foto-ktp-name-penyewa">No file selected</span>
                      <input type="file" name="foto_ktp" id="foto-ktp-penyewa" placeholder="" class="input-form input-foto" onchange="previewFile(this,'#foto-ktp-image-penyewa');">
                  </div>
                  <img src="/" alt="" id="foto-ktp-image-penyewa" class="image-produk img-upload w-100 mt-1 hidden">
                  <p class="m-0">Foto SIM A</p>
                  <div class="element w-100 radius-20 ">
                      <i class="fa-solid fa-camera base-color camera-icon" onclick="click_input('#foto-sim-penyewa');"></i><span class="name" id="foto-sim-name-penyewa">No file selected</span>
                      <input type="file" name="foto_sim" id="foto-sim-penyewa" placeholder="" class="input-form input-foto" onchange="previewFile(this,'#foto-sim-image-penyewa');">
                  </div>
                  <img src="/" alt="" id="foto-sim-image-penyewa" class="image-produk img-upload w-100 mt-1 hidden">
                  </div>
                  
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

        <div class="modal fade" id="tambahadminModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                  <div class="row ">
                  <form action="{{ route('admin.user.create') }}" id="form-create-pemilik" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="role" value="admin">
                    <h3 class="text-center">Tambah Admin</h3>
                  </div>
                  <div class="col-12">
                  <p class="m-0">Nama</p>
                  <input type="text" name="name" placeholder="nama" class="input-form w-100 p-2">
                  <p class="m-0">Email</p>
                  <input type="text" name="email"  placeholder="testn@gmail.com" class="input-form w-100 p-2">
                  <p class="m-0">Password</p>
                  <input type="text" name="password"  value="******" class="input-form w-100 mb-2 p-2">
                  </div>
                  <form action='' id="formcreate-admin" method="get">
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

        <div class="modal fade" id="edituserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <form action='' id="form-update-user" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row ">
                    <h3 class="text-center">Detail/Edit User</h3>
                  </div>
                  <div class="col-12">
                  <p class="m-0">Role</p>
                  <input type="text" name="role"  placeholder="role" class="input-form w-100 mb-2 p-2"  value="">
                  <p class="m-0">Nama</p>
                  <input type="text" name="name"  placeholder="nama" class="input-form w-100 p-2" value="">
                  <p class="m-0">Email</p>
                  <input type="text" name="email" placeholder="testn@gmail.com" class="input-form w-100 p-2" value="aris@gmail.com">
                  <p class="m-0">No telepon</p>
                  <input type="text" name="telp"  placeholder="telp" class="input-form w-100 p-2" value="">
                  <p class="m-0">Alamat</p>
                  <input type="text" name="alamat" placeholder="alamat" class="input-form w-100 p-2" value="">
                  <p class="m-0">Foto KTP</p>
                  <div class="element w-100 radius-20 ">
                      <i class="fa-solid fa-camera base-color camera-icon" onclick="click_input('#foto-ktp-edit');"></i><span class="name" id="foto-ktp-name-edit">No file selected</span>
                      <input type="file" name="foto_ktp" id="foto-ktp-edit" placeholder="" class="input-form input-foto" onchange="previewFile(this,'#foto-ktp-image-edit');">
                  </div>
                  <img src="/" alt="" id="foto-ktp-image-edit" class="image-produk img-upload w-100 mt-1 hidden">
                  <p class="m-0">Foto SIM A</p>
                  <div class="element w-100 radius-20 ">
                      <i class="fa-solid fa-camera base-color camera-icon" onclick="click_input('#foto-sim-edit');"></i><span class="name" id="foto-sim-name-edit">No file selected</span>
                      <input type="file" name="foto_sim" id="foto-sim-edit" placeholder="" class="input-form input-foto" onchange="previewFile(this,'#foto-sim-image-edit');">
                  </div>
                  <img src="/" alt="" id="foto-sim-image-edit" class="image-produk img-upload w-100 mt-1 hidden">
                  <p class="m-0">New Password</p>
                  <input type="text" name="password" class="input-form w-100 mb-2 p-2"  placeholder="******">
                  </div>
                  
                  
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
        

@endsection

@section('js')
  <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/dataTables.min.js') }}"></script>
  <script>
    function modal_delete(id){
      
      user_id = id;
      var url = '{{ route("admin.user.delete", ":id") }}';
      url = url.replace(':id', user_id);
      $("#formdelete").attr('action',url);
      $('#deleteModal').modal("show"); 
    }
    function modal_user(id){
      let url= "{{route('api.user.show','')}}"+"/"+id;
      $.ajax({
          url: url,
          type: "get", //send it through get method
          success: function(response) {
              console.log(response);
              let url_form= "{{route('admin.user.update',':id')}}";
              $('#form-update-user').attr('action',url_form.replace(':id',id));
              $('#form-update-user input[name="role"]').val(response['content']['role']);
              $('#form-update-user input[name="name"]').val(response['content']['name']);
              $('#form-update-user input[name="email"]').val(response['content']['email']);
              $('#form-update-user input[name="telp"]').val(response['content']['telp']);
              $('#form-update-user input[name="alamat"]').val(response['content']['alamat']);
              if(response['content']['foto_ktp'] !== null){
                url_image = "{{ asset('/') }}"+response['content']['foto_ktp'];
                $('#foto-ktp-image-edit').attr('src',url_image);
              }
              if(response['content']['foto_sim'] !== null){
                url_image = "{{ asset('/') }}"+response['content']['foto_sim'];
                $('#foto-sim-image-edit').attr('src',url_image);
              }

              $('#edituserModal').modal("show");
          },
          error: function(xhr) {
              console.log(xhr);
              //Do Something to handle error
          }
      });
      
    }
    $(document).ready(function() {
      // $(".camera-icon").click(function () {
      //   $("input[type='file']").trigger('click');
      // });

      // $('input[type="file"]').on('input', function() {
      //   var val = $(this).val();
      //   $(this).siblings('span').text(val);
      // });
        $('.profil-link').click(function(e){
          e.preventDefault();
          $('#profilModal').modal("show"); 
        });
        $('.tambahpenyewa').click(function(e){
          e.preventDefault();
          $('#tambahpenyewaModal').modal("show"); 
        });
        $('.tambahpemilik').click(function(e){
          e.preventDefault();
          $('#tambahpemilikModal').modal("show"); 
        });
        $('.tambahsopir').click(function(e){
          e.preventDefault();
          $('#tambahsopirModal').modal("show"); 
        });
        $('.tambahadmin').click(function(e){
          e.preventDefault();
          $('#tambahadminModal').modal("show"); 
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