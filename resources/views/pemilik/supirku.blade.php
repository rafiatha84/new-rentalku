@extends('user.layouts.pemilik')

@section('css')
    <link href="{{ asset('css/user/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user/supirku.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div id="detail-produk mb-4">
        <div class="container">
            <div class="row col-12">
                <div class="detail-box col-12 mt-5 p-0 pb-4">
                    <h4 class="text-center head-produk py-2 mb-0">Sopirku</h4>
                    <div class="row mx-auto mt-0 h-100 pb-4">
                        <div class="col-4 sidebar-left px-0">
                            <ul class="nav flex-column px-0">
                                <li class="nav-item">
                                    <a href="{{  route('pemilik.supirku') }}" class="nav-link sidebar-navlink active">Sopirku</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{  route('pemilik.supirku.create') }}" class="nav-link sidebar-navlink">Tambah Sopir</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-8 py-2 sidebar-right">
                            @if($pengemudis->count() > 0)
                                @foreach($pengemudis as $pengemudi)
                                <!-- supirku -->
                                <div class="row py-2">
                                    <div class="image-box col-2">
                                        <img src="{{ asset($pengemudi->user->image_link) }}" alt="" srcset="" class="img-ulasan img-profil rounded-circle">
                                    </div>
                                    <div class="col-8 align-self-center">
                                        <h5 class="jenis-mobil">{{ $pengemudi->user->name }}</h5>
                                    </div>
                                    <div class="col-2 align-self-center">
                                        <a href="{{ route('pemilik.supirku.detail',$pengemudi->id) }}" class="mx-1"><i class="fa-solid fa-info text-gray"></i></a>
                                        <span class="mx-1 button-icon" onclick="modal_delete({{ $pengemudi->id }})"><i class="fa-solid fa-trash base-color"></i></span>
                                    </div>
                                </div>
                                <hr class="m-0">
                                <!-- End supirku -->
                                @endforeach
                            @else
                            <div class="row py-5">
                                <div class="col-12">
                                    <h4 class="text-center">Belum ada sopir</h4>
                                </div>
                            </div>
                            @endif
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                  <form action='' id="formdelete" method="POST">
                  <div class="row px-5">
                    <div class="col-6">
                        <button type="button" class="btn btn-block button-base-secondary" data-dismiss="modal">Tidak</button>
                    </div>
                    <div class="col-6">
                        <button type="submit" class="btn btn-block button-base">Iya</button>
                    </div>
                  </div>
                  </form>
              </div>
            </div>
          </div>
        </div>
@endsection

@section('js')
<script>
    function modal_delete(id){
        pengemudi_id = id;
        var url = '{{ route("api.pengemudi.destroy", ":id") }}';
        url = url.replace(':id', pengemudi_id);
        $("#formdelete").attr('action',url);
        $('#deleteModal').modal("show"); 
    }
    $(document).ready(function(){
        $('#formdelete').submit(function(e){
            e.preventDefault();
            // console.log($('#pemesanan-create').serialize());
            /* get the action attribute from the <form action=""> element */
            var $form = $(this), url = $form.attr('action');
            $.ajax({
                url: url,
                type: "POST", //send it through get method
                beforeSend: function() {
                    showLoader();
                    $(':input[type="submit"]').prop('disabled', true);
                },
                success: function(response) {
                    // var transaksi_id = response['content']['id'];
                    // $('#pemesanan-create')[0].reset();
                    // $('#suksesModal').modal("show"); 
                    window.location.reload();
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
        
    });
</script>
@endsection
