<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <!-- <script src="{{ asset('js/user/login.js') }}" defer></script> -->

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

        <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/user/register.css') }}" rel="stylesheet">
    </head>
    <body>
        <img src="{{ asset('image/rectangle205.png') }}" alt="" class="img-fluid img-background">
            <div class="login-form col-10 col-lg-8">
                <div class="row">
                <div class="col-12 col-lg-6">
                    <img src="{{ asset('image/logo_gabung.png') }}" alt="" class="img-logo mt-2 mx-auto d-block img-fluid">
                    <p class="text-center mt-5 mb-0"><b>Lengkapi Data Diri Anda</b></p>
                    <p class="small text-center">Untuk menjadi pemilik mmobil</p>
                </div>
                <div class="col-12 col-lg-6 pt-4">
                <form action="{{ route('pemilik.register.action') }}" method="POST" class="mx-3" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <label class="small">Nama lengkap anda</label>
                    <input class="col-12" type="text" name="name" placeholder="Nama Lengkap" required>
                    <label class="small">Nomor Induk Kependudukan</label>
                    <input class="col-12" type="text" name="nik" placeholder="NIK" required>
                    <label class="small">Upload Foto KTP</label>
                    <div class="element w-100 radius-20 ">
                      <i class="fa-solid fa-camera base-color camera-icon" onclick="click_input('#foto-ktp-penyewa');"></i><span class="name" id="foto-ktp-name-penyewa">No file selected</span>
                      <input type="file" name="foto_ktp" id="foto-ktp-penyewa" placeholder="" class="input-form input-foto" onchange="previewFile(this,'#foto-ktp-image-penyewa');" required>
                    </div>

                    <input class="my-4 col-12 login-btn" type="submit" value="Daftar & jadi Pemilik Mobil">
                </form>
                </div>
                </div>
                
            </div>
        <div class="footer">
            <p>Hak Cipta &copy; 2021. Tim Rentalku.</p>
        </div>
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script>
        function previewFile(input,element){
            var val = $(input).val();
            $(input).siblings('span').text(val);
            var file = $(input).get(0).files[0];
    
            if(file){
                var reader = new FileReader();
    
                reader.onload = function(){
                    $(element).attr("src", reader.result);
                }
    
                reader.readAsDataURL(file);
                $(element).removeClass("hidden");
            }
        }
        function click_input(element){
            $(element).trigger('click');
        }
        </script>
    </body>
</html>