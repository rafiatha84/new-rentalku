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
                    <h4 class="text-center head-produk py-2 mb-0">Supirku</h4>
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
                            <!-- supirku -->
                            <div class="row py-2">
                                <div class="image-box col-2">
                                    <img src="{{ asset('image/profil.png') }}" alt="" srcset="" class="img-ulasan img-profil rounded-circle">
                                </div>
                                <div class="col-8 align-self-center">
                                    <h5 class="jenis-mobil">Asep</h5>
                                </div>
                                <div class="col-2 align-self-center">
                                    <a href="{{ route('pemilik.supirku.detail',2) }}" class="mx-1"><i class="fa-solid fa-info text-gray"></i></a>
                                    <a href="" class="mx-1"><i class="fa-solid fa-trash base-color "></i></a>
                                </div>
                            </div>
                            <hr class="m-0">
                            <!-- End supirku -->
                            <!-- supirku -->
                            <div class="row py-2">
                                <div class="image-box col-2">
                                    <img src="{{ asset('image/profil.png') }}" alt="" srcset="" class="img-ulasan img-profil rounded-circle">
                                </div>
                                <div class="col-8 align-self-center">
                                    <h5 class="jenis-mobil">Asep</h5>
                                </div>
                                <div class="col-2 align-self-center">
                                    <a href="{{ route('pemilik.supirku.detail',2) }}" class="mx-1"><i class="fa-solid fa-info text-gray"></i></a>
                                    <a href="" class="mx-1"><i class="fa-solid fa-trash base-color "></i></a>
                                </div>
                            </div>
                            <hr class="m-0">
                            <!-- End supirku -->
                            <!-- supirku -->
                            <div class="row py-2">
                                <div class="image-box col-2">
                                    <img src="{{ asset('image/profil.png') }}" alt="" srcset="" class="img-ulasan img-profil rounded-circle">
                                </div>
                                <div class="col-8 align-self-center">
                                    <h5 class="jenis-mobil">Asep</h5>
                                </div>
                                <div class="col-2 align-self-center">
                                    <a href="{{ route('pemilik.supirku.detail',2) }}" class="mx-1"><i class="fa-solid fa-info text-gray"></i></a>
                                    <a href="" class="mx-1"><i class="fa-solid fa-trash base-color "></i></a>
                                </div>
                            </div>
                            <hr class="m-0">
                            <!-- End supirku -->
                            <!-- supirku -->
                            <div class="row py-2">
                                <div class="image-box col-2">
                                    <img src="{{ asset('image/profil.png') }}" alt="" srcset="" class="img-ulasan img-profil rounded-circle">
                                </div>
                                <div class="col-8 align-self-center">
                                    <h5 class="jenis-mobil">Asep</h5>
                                </div>
                                <div class="col-2 align-self-center">
                                    <a href="{{ route('pemilik.supirku.detail',2) }}" class="mx-1"><i class="fa-solid fa-info text-gray"></i></a>
                                    <a href="" class="mx-1"><i class="fa-solid fa-trash base-color "></i></a>
                                </div>
                            </div>
                            <hr class="m-0">
                            <!-- End supirku -->
                            <!-- supirku -->
                            <div class="row py-2">
                                <div class="image-box col-2">
                                    <img src="{{ asset('image/profil.png') }}" alt="" srcset="" class="img-ulasan img-profil rounded-circle">
                                </div>
                                <div class="col-8 align-self-center">
                                    <h5 class="jenis-mobil">Asep</h5>
                                </div>
                                <div class="col-2 align-self-center">
                                    <a href="{{ route('pemilik.supirku.detail',2) }}" class="mx-1"><i class="fa-solid fa-info text-gray"></i></a>
                                    <a href="" class="mx-1"><i class="fa-solid fa-trash base-color "></i></a>
                                </div>
                            </div>
                            <hr class="m-0">
                            <!-- End supirku -->
                            <!-- supirku -->
                            <div class="row py-2">
                                <div class="image-box col-2">
                                    <img src="{{ asset('image/profil.png') }}" alt="" srcset="" class="img-ulasan img-profil rounded-circle">
                                </div>
                                <div class="col-8 align-self-center">
                                    <h5 class="jenis-mobil">Asep</h5>
                                </div>
                                <div class="col-2 align-self-center">
                                    <a href="{{ route('pemilik.supirku.detail',2) }}" class="mx-1"><i class="fa-solid fa-info text-gray"></i></a>
                                    <a href="" class="mx-1"><i class="fa-solid fa-trash base-color "></i></a>
                                </div>
                            </div>
                            <hr class="m-0">
                            <!-- End supirku -->
                            <!-- supirku -->
                            <div class="row py-2">
                                <div class="image-box col-2">
                                    <img src="{{ asset('image/profil.png') }}" alt="" srcset="" class="img-ulasan img-profil rounded-circle">
                                </div>
                                <div class="col-8 align-self-center">
                                    <h5 class="jenis-mobil">Asep</h5>
                                </div>
                                <div class="col-2 align-self-center">
                                    <a href="{{ route('pemilik.supirku.detail',2) }}" class="mx-1"><i class="fa-solid fa-info text-gray"></i></a>
                                    <a href="" class="mx-1"><i class="fa-solid fa-trash base-color "></i></a>
                                </div>
                            </div>
                            <hr class="m-0">
                            <!-- End supirku -->
                            <!-- supirku -->
                            <div class="row py-2">
                                <div class="image-box col-2">
                                    <img src="{{ asset('image/profil.png') }}" alt="" srcset="" class="img-ulasan img-profil rounded-circle">
                                </div>
                                <div class="col-8 align-self-center">
                                    <h5 class="jenis-mobil">Asep</h5>
                                </div>
                                <div class="col-2 align-self-center">
                                    <a href="{{ route('pemilik.supirku.detail',2) }}" class="mx-1"><i class="fa-solid fa-info text-gray"></i></a>
                                    <a href="" class="mx-1"><i class="fa-solid fa-trash base-color "></i></a>
                                </div>
                            </div>
                            <hr class="m-0">
                            <!-- End supirku -->
                            <!-- supirku -->
                            <div class="row py-2">
                                <div class="image-box col-2">
                                    <img src="{{ asset('image/profil.png') }}" alt="" srcset="" class="img-ulasan img-profil rounded-circle">
                                </div>
                                <div class="col-8 align-self-center">
                                    <h5 class="jenis-mobil">Asep</h5>
                                </div>
                                <div class="col-2 align-self-center">
                                    <a href="{{ route('pemilik.supirku.detail',2) }}" class="mx-1"><i class="fa-solid fa-info text-gray"></i></a>
                                    <a href="" class="mx-1"><i class="fa-solid fa-trash base-color "></i></a>
                                </div>
                            </div>
                            <hr class="m-0">
                            <!-- End supirku -->
                            <!-- supirku -->
                            <div class="row py-2">
                                <div class="image-box col-2">
                                    <img src="{{ asset('image/profil.png') }}" alt="" srcset="" class="img-ulasan img-profil rounded-circle">
                                </div>
                                <div class="col-8 align-self-center">
                                    <h5 class="jenis-mobil">Asep</h5>
                                </div>
                                <div class="col-2 align-self-center">
                                    <a href="{{ route('pemilik.supirku.detail',2) }}" class="mx-1"><i class="fa-solid fa-info text-gray"></i></a>
                                    <a href="" class="mx-1"><i class="fa-solid fa-trash base-color "></i></a>
                                </div>
                            </div>
                            <hr class="m-0">
                            <!-- End supirku -->
                            <!-- supirku -->
                            <div class="row py-2">
                                <div class="image-box col-2">
                                    <img src="{{ asset('image/profil.png') }}" alt="" srcset="" class="img-ulasan img-profil rounded-circle">
                                </div>
                                <div class="col-8 align-self-center">
                                    <h5 class="jenis-mobil">Asep</h5>
                                </div>
                                <div class="col-2 align-self-center">
                                    <a href="{{ route('pemilik.supirku.detail',2) }}" class="mx-1"><i class="fa-solid fa-info text-gray"></i></a>
                                    <a href="" class="mx-1"><i class="fa-solid fa-trash base-color "></i></a>
                                </div>
                            </div>
                            <hr class="m-0">
                            <!-- End supirku -->
                            <!-- supirku -->
                            <div class="row py-2">
                                <div class="image-box col-2">
                                    <img src="{{ asset('image/profil.png') }}" alt="" srcset="" class="img-ulasan img-profil rounded-circle">
                                </div>
                                <div class="col-8 align-self-center">
                                    <h5 class="jenis-mobil">Asep</h5>
                                </div>
                                <div class="col-2 align-self-center">
                                    <a href="{{ route('pemilik.supirku.detail',2) }}" class="mx-1"><i class="fa-solid fa-info text-gray"></i></a>
                                    <a href="" class="mx-1"><i class="fa-solid fa-trash base-color "></i></a>
                                </div>
                            </div>
                            <hr class="m-0">
                            <!-- End supirku -->
                            
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
                  <form action='' id="formdelete" method="get">
                  <div class="row px-5">
                    <div class="col-6">
                        <button type="button" class="btn btn-block button-base-secondary" data-dismiss="modal">Tidak</button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-block button-base" data-dismiss="modal">Iya</button>
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
    $(document).ready(function(){
        $('.fa-trash').click(function(e){
            e.preventDefault();
            $('#deleteModal').modal('show');
        });
    });
</script>
@endsection
