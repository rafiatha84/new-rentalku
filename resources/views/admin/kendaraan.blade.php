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
              <!-- <a class="button mx-2 px-4 py-2 tambahkendaraan"><i class="fa-solid fa-plus"></i> Kendaraan</a> -->
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
                  <th>Biaya sewa / hari</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($posts as $post)
                <tr>
                  <td>{{ $post->name }}</td>
                  <td>{{ $post->user->name }}</td>
                  <td>{{ $post->kota }}</td>
                  <td>{{ number_format($post->harga,0,',','.') }}</td>
                  <td>
                    <button type="button" class="delete-button px-3 py-1" onclick="modal_delete({{ $post->id }})"><i class="fa-solid fa-trash"></i></button>
                    <button type="button" class="edit-button px-3 py-1" onclick="show_edit({{ $post->id }})"><i class="fa-solid fa-edit"></i></button>
                    <i class="fa-solid fa-info-circle" onclick="show_detail({{ $post->id }})"></i>
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
                  <p>Apakah Anda yakin akan menghapus kendaraan tersebut dari basis data aplikasi RentalKu?</p>
                  </div>
                  <form action='{{ route("admin.kendaraan.delete", ":id" ) }}' id="formdelete" method="POST">
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
                    <h3 class="text-center">Detail Kendaraan</h3>
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

        <div class="modal fade" id="tambahkendaraanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                  <div class="row">
                  <div class="col-12">
                  <h3 class="text-center">Tambah Kendaraan</h3>
                  </div>
                  </div>
                  <form action="{{ route('admin.kendaraan.create') }}" id="form-create-penyewa" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="col-12">
                  <p class="m-0">Pemilik</p>
                  <select name="user_id" id="owner" class="input-form w-100 p-2">
                    @foreach($pemiliks as $pemilik)
                    <option value="{{$pemilik->id}}">{{$pemilik->name}}</option>
                    @endforeach
                  </select>
                  <p class="m-0">Nama Kendaraan</p>
                  <input type="text" name="name" placeholder="nama" class="input-form w-100 p-2">
                  <p class="m-0">Kategori Mobil</p>
                  <select name="kategori_id" id="kategori" class="input-form w-100 p-2">
                    @foreach($kategoris as $kategori)
                    <option value="{{$kategori->id}}">{{$kategori->name}}</option>
                    @endforeach
                  </select>
                  <p class="m-0">Kota</p>
                  <input type="text" name="kota" placeholder="Masukkan Kota" class="input-form w-100 p-2">
                  <p class="m-0">Seat</p>
                  <input type="number" name="seat" placeholder="Masukkan Seat" class="input-form w-100 p-2">
                  <p class="m-0">Nopol</p>
                  <input type="text" name="nopol" placeholder="Masukkan Nopol" class="input-form w-100 p-2">
                  <p class="m-0">Harga</p>
                  <input type="number" name="harga" placeholder="Masukkan Harga" class="input-form w-100 p-2">
                  <p class="m-0">Tahun</p>
                  <input type="number" name="tahun" placeholder="Masukkan Tahun" class="input-form w-100 p-2">
                  <p class="m-0">Transmisi</p>
                  <select name="transmisi" class="d-block w-100 input-form p-2" required>
                      <option value="Manual" selected>Manual</option>
                      <option value="Matic">Matic</option>
                  </select>
                  <p class="m-0">Mesin</p>
                  <input type="text" name="mesin" placeholder="Masukkan mesin (2000cc)" class="input-form w-100 p-2">
                  <p class="m-0">Warna</p>
                  <input type="text" name="warna" placeholder="Masukkan Warna" class="input-form w-100 p-2">
                  <p class="m-0">Foto Kendaraan</p>
                  <div class="element w-100 radius-20 ">
                      <i class="fa-solid fa-camera base-color camera-icon" onclick="click_input('#foto-kendaraan');"></i><span class="name" id="foto-kendaraan-name">No file selected</span>
                      <input type="file" name="image_link" id="foto-kendaraan" placeholder="" class="input-form input-foto" onchange="previewFile(this,'#foto-kendaraan-image');">
                  </div>
                  <img src="/" alt="" id="foto-kendaraan-image" class="image-produk img-upload w-100 mt-1 hidden">
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

        <div class="modal fade" id="editkendaraanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                  <div class="row">
                  <div class="col-12">
                  <h3 class="text-center">Edit Kendaraan</h3>
                  </div>
                  </div>
                  <form action="{{ route('admin.kendaraan.update',':id') }}" id="form-update-kendaraan" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="col-12">
                  <p class="m-0">Pemilik</p>
                  <select name="user_id" id="owner" class="input-form w-100 p-2" disabled>
                    @foreach($pemiliks as $pemilik)
                    <option value="{{$pemilik->id}}">{{$pemilik->name}}</option>
                    @endforeach
                  </select>
                  <p class="m-0">Nama Kendaraan</p>
                  <input type="text" name="name" placeholder="nama" class="input-form w-100 p-2">
                  <p class="m-0">Kategori Mobil</p>
                  <select name="kategori_id" id="kategori" class="input-form w-100 p-2">
                    @foreach($kategoris as $kategori)
                    <option value="{{$kategori->id}}">{{$kategori->name}}</option>
                    @endforeach
                  </select>
                  <p class="m-0">Kota</p>
                  <input type="text" name="kota" placeholder="Masukkan Kota" class="input-form w-100 p-2">
                  <p class="m-0">Seat</p>
                  <input type="number" name="seat" placeholder="Masukkan Seat" class="input-form w-100 p-2">
                  <p class="m-0">Nopol</p>
                  <input type="text" name="nopol" placeholder="Masukkan Nopol" class="input-form w-100 p-2">
                  <p class="m-0">Harga</p>
                  <input type="number" name="harga" placeholder="Masukkan Harga" class="input-form w-100 p-2">
                  <p class="m-0">Tahun</p>
                  <input type="number" name="tahun" placeholder="Masukkan Tahun" class="input-form w-100 p-2">
                  <p class="m-0">Transmisi</p>
                  <select name="transmisi" class="d-block w-100 input-form p-2" required>
                      <option value="Manual" selected>Manual</option>
                      <option value="Matic">Matic</option>
                  </select>
                  <p class="m-0">Mesin</p>
                  <input type="text" name="mesin" placeholder="Masukkan mesin (2000cc)" class="input-form w-100 p-2">
                  <p class="m-0">Warna</p>
                  <input type="text" name="warna" placeholder="Masukkan Warna" class="input-form w-100 p-2">
                  <p class="m-0">Foto Kendaraan</p>
                  <div class="element w-100 radius-20 ">
                      <i class="fa-solid fa-camera base-color camera-icon" onclick="click_input('#foto-kendaraan-update');"></i><span class="name" id="foto-kendaraan-name-update">No file selected</span>
                      <input type="file" name="image_link" id="foto-kendaraan-update" placeholder="" class="input-form input-foto" onchange="previewFile(this,'#foto-kendaraan-image-update');">
                  </div>
                  <img src="/" alt="" id="foto-kendaraan-image-update" class="image-produk img-upload w-100 mt-1 hidden">
                  </div>
                  <div class="row px-5">
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
      var url = '{{ route("admin.kendaraan.delete", ":id") }}';
      url = url.replace(':id', user_id);
      $("#formdelete").attr('action',url);
    }
    function show_detail(id)
    {
      let url= "{{route('api.kendaraan.showId','')}}"+"/"+id;
      $.ajax({
          url: url,
          type: "get", //send it through get method
          success: function(response) {
              console.log(response);
              var jumlah_display = new Intl.NumberFormat(['ban', 'id']).format(response['content']['harga']);
              // console.log(response);
              let image_car = "{{ asset('') }}"+response['content']['image_link'];
              let html_detail = `
              <p class="name mb-0">Nama Pengguna: ${response['content']['user']['name']}</p>
              <p class="email mb-0">Nama Unit: ${response['content']['name']}</p>
              <p class="bank mb-0">Jenis Mobil : ${response['content']['kategori']['name']}</p>
              <p class="status mb-0">Biaya Sewa/Hari: Rp${jumlah_display}</p>
              <img class="img-responsive w-100 my-1" src="${image_car}" />
              <div class="row">
                <div class="col-8 offset-4">
                  <p class="bank mb-0 h5"><i class="fa-solid fa-user base-color"></i> ${response['content']['seat']} Penumpang</p>
                </div>
              </div>
              <div class="row">
                <div class="col-8 offset-4">
                  <p class="bank mb-0 h5"><i class="fa-solid fa-user base-color"></i> ${response['content']['kota']}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-8 offset-4">
                <p class="bank mb-0 h5"><i class="fa-solid fa-car base-color"></i> Transmisi ${response['content']['transmisi']}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-8 offset-4">
                <p class="bank mb-0 h5"><i class="fa-solid fa-car base-color"></i> Mesin ${response['content']['mesin']}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-8 offset-4">
                <p class="bank mb-0 h5"><i class="fa-solid fa-car base-color"></i> Warna ${response['content']['warna']}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-8 offset-4">
                <p class="bank mb-0 h5"><i class="fa-solid fa-car base-color"></i> Tahun ${response['content']['tahun']}</p>
                </div>
              </div>
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
    function show_edit(id){
      let url= "{{route('api.kendaraan.showId','')}}"+"/"+id;
      $.ajax({
          url: url,
          type: "get", //send it through get method
          success: function(response) {
              console.log(response);
              let url_form= "{{route('admin.kendaraan.update',':id')}}";
              $('#form-update-kendaraan').attr('action',url_form.replace(':id',id));
              $(`#form-update-kendaraan select[name=user_id] option[value=${response['content']['id']}]`).attr('selected','selected');
              $("#form-update-kendaraan input[name=name]").val(response['content']['name']);
              $(`#form-update-kendaraan select[name=kategori_id] option[value=${response['content']['kategori_id']}]`).attr('selected','selected');
              $(`#form-update-kendaraan select[name=transmisi] option[value=${response['content']['transmisi']}]`).attr('selected','selected');
              $("#form-update-kendaraan input[name=kota]").val(response['content']['kota']);
              $("#form-update-kendaraan input[name=seat]").val(response['content']['seat']);
              $("#form-update-kendaraan input[name=nopol]").val(response['content']['nopol']);
              $("#form-update-kendaraan input[name=harga]").val(response['content']['harga']);
              $("#form-update-kendaraan input[name=tahun]").val(response['content']['tahun']);
              $("#form-update-kendaraan input[name=mesin]").val(response['content']['mesin']);
              $("#form-update-kendaraan input[name=warna]").val(response['content']['warna']);
              if(response['content']['iamge_link'] !== null){
                url_image = "{{ asset('/') }}"+response['content']['image_link'];
                $('#foto-kendaraan-image-update').attr('src',url_image);
              }
              // if(response['content']['foto_sim'] !== null){
              //   url_image = "{{ asset('/') }}"+response['content']['foto_sim'];
              //   $('#foto-sim-image-edit').attr('src',url_image);
              // }

              $('#editkendaraanModal').modal("show");
          },
          error: function(xhr) {
              console.log(xhr);
              //Do Something to handle error
          }
      });
    }
    $(document).ready(function() {
        $('.tambahkendaraan').click(function(e){
          e.preventDefault();
          $('#tambahkendaraanModal').modal("show"); 
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