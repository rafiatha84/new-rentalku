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
                <tr>
                  <td>aris@gmail.com</td>
                  <td>Aris</td>
                  <td>Penyewa</td>
                  <td>
                    <button type="button" class="delete-button px-3 py-1" onclick="modal_delete(2)"><i class="fa-solid fa-trash"></i></button>
                    <button type="button" class="edit-button px-3 py-1" onclick="modal_user(2)"><i class="fa-solid fa-edit"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>aris@gmail.com</td>
                  <td>Aris</td>
                  <td>Penyewa</td>
                  <td>
                    <button type="button" class="delete-button px-3 py-1" onclick="modal_delete(2)"><i class="fa-solid fa-trash"></i></button>
                    <button type="button" class="edit-button px-3 py-1" onclick="modal_user(2)"><i class="fa-solid fa-edit"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>aris@gmail.com</td>
                  <td>Aris</td>
                  <td>Penyewa</td>
                  <td>
                    <button type="button" class="delete-button px-3 py-1" onclick="modal_delete(2)"><i class="fa-solid fa-trash"></i></button>
                    <button type="button" class="edit-button px-3 py-1" onclick="modal_user(2)"><i class="fa-solid fa-edit"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>aris@gmail.com</td>
                  <td>Aris</td>
                  <td>Penyewa</td>
                  <td>
                    <button type="button" class="delete-button px-3 py-1" onclick="modal_delete(2)"><i class="fa-solid fa-trash"></i></button>
                    <button type="button" class="edit-button px-3 py-1" onclick="modal_user(2)"><i class="fa-solid fa-edit"></i></button>
                  </td>
                </tr>
                <tr>
                  <td>aris@gmail.com</td>
                  <td>Aris</td>
                  <td>Penyewa</td>
                  <td>
                    <button type="button" class="delete-button px-3 py-1"  onclick="modal_delete(2)"><i class="fa-solid fa-trash"></i></button>
                    <button type="button" class="edit-button px-3 py-1" onclick="modal_user(2)"><i class="fa-solid fa-edit"></i></button>
                  </td>
                </tr>
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

        <div class="modal fade" id="tambahpenyewaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                  <div class="row">
                  <div class="col-12">
                  <h3 class="text-center">Tambah Penyewa</h3>
                  </div>
                  </div>
                  <div class="col-12">
                  <p class="m-0">Nama</p>
                  <input type="text" name="" id="" placeholder="nama" class="input-form w-100 p-2">
                  <p class="m-0">Email</p>
                  <input type="text" name="" id="" placeholder="testn@gmail.com" class="input-form w-100 p-2">
                  <p class="m-0">Password</p>
                  <input type="text" name="" id="" value="******" class="input-form w-100 mb-2 p-2">
                  </div>
                  <form action='' id="formdelete" method="get">
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
                  <p class="m-0">Nama</p>
                  <input type="text" name="" id="" placeholder="nama" class="input-form w-100 p-2">
                  <p class="m-0">Email</p>
                  <input type="text" name="" id="" placeholder="testn@gmail.com" class="input-form w-100 p-2">
                  <p class="m-0">Password</p>
                  <input type="text" name="" id="" value="******" class="input-form w-100 mb-2 p-2">
                  <p class="m-0">Nomor Induk Kependudukan</p>
                  <input type="text" name="" id="" placeholder="NIK" class="input-form w-100 p-2">
                  <p class="m-0">Foto KTP</p>
                  <div class="element w-100">
                    <i class="fa-solid fa-camera base-color camera-icon"></i><span class="name">No file selected</span>
                    <input type="file" name="" id="" placeholder="" class="input-form input-foto">
                  </div>
                  </div>
                  <form action='' id="formdelete" method="get">
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
                  <p class="m-0">Nama</p>
                  <input type="text" name="" id="" placeholder="nama" class="input-form w-100 p-2">
                  <p class="m-0">Email</p>
                  <input type="text" name="" id="" placeholder="testn@gmail.com" class="input-form w-100 p-2">
                  <p class="m-0">Password</p>
                  <input type="text" name="" id="" value="******" class="input-form w-100 mb-2 p-2">
                  <p class="m-0">Nomor Induk Kependudukan</p>
                  <input type="text" name="" id="" placeholder="NIK" class="input-form w-100 p-2">
                  <p class="m-0">Foto KTP</p>
                  <input type="file" name="" id="" placeholder="" class="input-form w-100 p-2">
                  <p class="m-0">Foto SIM A</p>
                  <input type="file" name="" id="" placeholder="" class="input-form w-100 p-2">
                  </div>
                  <form action='' id="formdelete" method="get">
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
                    <h3 class="text-center">Tambah Admin</h3>
                  </div>
                  <div class="col-12">
                  <p class="m-0">Nama</p>
                  <input type="text" name="" id="" placeholder="nama" class="input-form w-100 p-2">
                  <p class="m-0">Email</p>
                  <input type="text" name="" id="" placeholder="testn@gmail.com" class="input-form w-100 p-2">
                  <p class="m-0">Password</p>
                  <input type="text" name="" id="" value="******" class="input-form w-100 mb-2 p-2">
                  </div>
                  <form action='' id="formdelete" method="get">
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
                  <div class="row ">
                    <h3 class="text-center">Detail/Edit User</h3>
                  </div>
                  <div class="col-12">
                  <p class="m-0">Nama</p>
                  <input type="text" name="" id="" placeholder="nama" class="input-form w-100 p-2" value="Aris">
                  <p class="m-0">Email</p>
                  <input type="text" name="" id="" placeholder="testn@gmail.com" class="input-form w-100 p-2" value="aris@gmail.com">
                  <p class="m-0">Password</p>
                  <input type="text" name="" id="" value="******" class="input-form w-100 mb-2 p-2"  value="******">
                  <p class="m-0">Role</p>
                  <input type="text" name="" id="" value="penyewa" class="input-form w-100 mb-2 p-2"  value="penyewa">
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
    function modal_user(id){
      $('#edituserModal').modal("show");
    }
    $(document).ready(function() {
      $(".camera-icon").click(function () {
        $("input[type='file']").trigger('click');
      });

      $('input[type="file"]').on('change', function() {
        var val = $(this).val();
        $(this).siblings('span').text(val);
      });
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