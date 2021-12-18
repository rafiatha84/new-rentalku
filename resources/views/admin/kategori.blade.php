@extends('admin.layouts.app')

@section('css')
    <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h1 class="h4">Kelola Jenis Mobil</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <a class="button mx-2 px-4 py-2 tambahkategori"><i class="fa-solid fa-plus"></i> Jenis</a>
              <a class="py-2 base-color mx-2"  href="{{ route('admin.logout') }}">Keluar <i class="fa-solid fa-sign-out-alt base-color"></i></a>
            </div>
          </div>

          <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->
          <div class="table-responsive">
            <table class="table table-sm" id="table-pengguna">
              <thead>
                <tr>
                  <th>Nama Kategori</th>
                  <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>
                
                  @foreach ($posts as $post)
                  <tr>
                  <td>{{ $post->name }}</td>
                 
                  <td>
                    <button type="button" class="delete-button px-3 py-1" onclick="modal_delete({{$post->id}})"><i class="fa-solid fa-trash"></i></button>
                    <button type="button" class="edit-button px-3 py-1" onclick="modal_edit({{$post->id}})"><i class="fa-solid fa-edit"></i></button>
                    <!-- <i class="fa-solid fa-info-circle"></i> -->
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
                  <p>Apakah Anda yakin akan menghapus Kategori tersebut dari basis data aplikasi RentalKu?</p>
                  </div>
                  <form action='{{ route("admin.user.delete", "0" ) }}' id="formdelete" method="POST">
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

        <div class="modal fade" id="tambahkategoriModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                  <div class="row">
                    <div class="col-12">
                      <h3 class="text-center">Tambah Kategori</h3>
                    </div>
                  </div>
                  <form action="{{ route('admin.kategori.create') }}" id="form-create-slider" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="col-12">
                    <p class="m-0">Kategori</p>
                    <input type="text" name="name" placeholder="Masukkan Kategori" class="input-form w-100 p-2">
                  </div>
                  <div class="row px-5 my-1">
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

        <div class="modal fade" id="editkategoriModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                  <div class="row">
                  <div class="col-12">
                  <h3 class="text-center">Edit Kendaraan</h3>
                  </div>
                  </div>
                  <form action="{{ route('admin.kendaraan.update',':id') }}" id="form-edit-kategori" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="col-12">
                  
                  <p class="m-0">Kategori</p>
                  <input type="text" name="name" placeholder="nama" class="input-form w-100 p-2">
                  
                  </div>
                  <div class="row px-5 py-2">
                    <div class="col-6">
                    <button type="button" class="btn btn-secondary btn-block btn-cancel" data-dismiss="modal">Tidak</button>
                    </div>
                    <div class="col-6">
                    <button type="submit" class="btn btn-primary btn-block btn-oke">Ubah</button>
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
      var url = '{{ route("admin.kategori.delete", ":id") }}';
      url = url.replace(':id', user_id);
      $("#formdelete").attr('action',url);
    }
    function modal_edit(id){
      // e.preventDefault();
      let url= "{{route('api.kategori.showId','')}}"+"/"+id;
      // alert(url);
      $.ajax({
          url: url,
          type: "get", //send it through get method
          success: function(response) {
              console.log(response);
              let url_form= "{{route('admin.kategori.update',':id')}}";
              $('#form-edit-kategori').attr('action',url_form.replace(':id',id));
              $("#form-edit-kategori input[name=name]").val(response['content']['name']);
              $('#editkategoriModal').modal("show");
          },
          error: function(xhr) {
              console.log(xhr);
              //Do Something to handle error
          }
      });
    }
    $(document).ready(function() {
        $('.tambahkategori').click(function(e){
          e.preventDefault();
          $('#tambahkategoriModal').modal("show"); 
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