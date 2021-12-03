<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}" ></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!--load all Font Awesome styles -->
    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/app.css') }}" rel="stylesheet">

    @yield('css')
</head>
<body style="background-image:url({{url('image/v996-009.png')}})">
    <div id="app" class="app">

        <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <div class="dashabord-box text-center mb-2">
            <img src="{{ asset('image/logo_kunci.png') }}" alt="">
            <p class="d-inline text-white">Dashboard</p>
            </div>
            
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteNamed('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                  <i class="fa-solid fa-user"></i>
                  Pengguna
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteNamed('admin.topup') ? 'active' : '' }}" href="{{ route('admin.topup') }}">
                <i class="fa-solid fa-wallet"></i>
                Top Up
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteNamed('admin.penarikan') ? 'active' : '' }}" href="{{ route('admin.penarikan') }}">
                <i class="fa-solid fa-wallet"></i>
                Penarikan
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteNamed('admin.kendaraan') || Route::currentRouteNamed('admin.kendaraan.dipesan') || Route::currentRouteNamed('admin.kendaraan.selesai') ? 'active' : '' }} " href="{{  route('admin.kendaraan') }}">
                <i class="fa-solid fa-car"></i>
                Kelola Produk
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteNamed('admin.artikel') ? 'active' : '' }}" href="{{ route('admin.artikel') }}">
                <i class="fa-solid fa-book"></i>
                Kelola Artikel
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteNamed('admin.kategori') || Route::currentRouteNamed('admin.kategori.kota')  ? 'active' : '' }}" href="{{ route('admin.kategori') }}">
                <i class="fa-solid fa-layer-group"></i>
                Kelola Kategori
                </a>
              </li>
            </ul>
          </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        @yield('content')
        <div id="footer" class="mt-2">
            <div class="row col-12 pt-4">
                <p class="mx-auto">All Right Reserved &copy; 2021. RentalKu Team.</p>
            </div>
        </div>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <!-- Icons -->
    <!-- <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script> -->

    <!-- Graphs -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
          datasets: [{
            data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script> -->
        
    </div>
    
    @yield('js')  
</body>
</html>
