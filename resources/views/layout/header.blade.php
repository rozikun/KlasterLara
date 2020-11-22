<!doctype html>
<html lang="en">
  <head>
    <title>@yield('title', 'Kosong')</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="{{mix('css/sidebar.css')}}">
  <link rel="stylesheet" href="{{mix('css/style.css')}}">
    <!-- Bootstrap CSS -->
    
  </head>
  <body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-dark border-right" id="sidebar-wrapper">
          <div class="sidebar-heading text-white">Klasterisasi Mahasiswa </div>
          <div class="list-group list-group-flush">
            <a href="/" class="list-group-item list-group-item-action @yield('title1')">Dashboard</a>
            <a href="/lihat" class="list-group-item list-group-item-action @yield('title2')">Data</a>
            <a href="/hitung" class="list-group-item list-group-item-action @yield('title3')">Perhitungan</a>
            <a href="/hasil" class="list-group-item list-group-item-action @yield('title4')">Hasil</a>
          </div>
        </div>
        <!-- /#sidebar-wrapper -->
    
        <!-- Page Content -->
        <div id="page-content-wrapper">
    
          <nav class="navbar navbar-expand-lg navbar-light bg-dark border-bottom">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Lainnya
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </li>
              </ul>
            </div>
          </nav>
        <!-- /#page-content-wrapper -->
        <div class="container-fluid">
          @yield('body')
        </div>
      </div>
    </div>        
    </div>
    <!-- /#wrapper -->
    <div class="text-white bg-dark">
      <img class="card-img-top" src="holder.js/100px180/" alt="">
      <div class="card-body">
        <h4 class="card-title" align="right">Project Tugas Akhir</h4>
        <p class="card-text" align="right">Klasterisasi Daerah Mahasiswa Baru Berpotensi Masuk     
          Di Institut Teknologi Dan Bisnis Asia Dengan Menggunakan Metode K-Means.</p>
        <p align="right">© {{date('Y')}} Muchammad Rifny Setyawan</p>
      </div>
    </div>
   
    <!-- Optional JavaScript -->
    
    @yield('footer')

    <script src="{{mix('js/my-app.js')}}"></script>
  </body>
</html>