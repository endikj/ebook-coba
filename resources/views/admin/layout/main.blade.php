<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Ebook Web App | @yield('title')</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/logo-bwi.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link rel="stylesheet" href="../assets/css/flipbook.css" />
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap/js') }}">
  <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap5.min.css') }}">
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="../assets/images/logos/logo-dispusipbwi.png" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav" class="mb-5">
            @include('admin.layout.menu')
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <div class="">
                {{-- <p class="card-title">{{ $user->nama }}</p>
                @if(Auth::user()->role == 1)
                <p class="card-subtitle text-body-secondary">Super Admin</p>
                @elseif(Auth::user()->role == 2)
                <p class="card-subtitle text-body-secondary">Admin</p>
                @endif --}}
                <p class="card-title">{{ auth()->user()->nama }}</p>
                @if(auth()->user()->role == 1)
                <p class="card-subtitle text-body-secondary">Super Admin</p>
                @elseif(auth()->user()->role == 2)
                <p class="card-subtitle text-body-secondary">Admin</p>
                @endif
              </div>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    {{-- <a href="#" class="btn btn-outline-primary mx-3 mt-2 d-block" id="btn-logout">Logout</a> --}}
                    <form class="mx-3" id="logoutForm" action="{{ route('logout') }}" method="POST">
                      @csrf
                      <button type="button" class="btn btn-outline-primary mt-2 mb-2 d-block w-100"
                        id="btn-logout">Logout</button>
                    </form>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        @yield('isi')
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  {{-- <script src="../assets/js/sidebarmenu.js"></script> --}}
  <script src="../assets/js/app.min.js"></script>
  {{-- <script src="../assets/libs/simplebar/dist/simplebar.js"></script> --}}

  <script src="{{ url('plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ url('plugins/datatables-bs4/js/dataTables.bootstrap5.min.js') }}"></script>
  <script src="{{ url('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ url('plugins/datatables-responsive/js/responsive.bootstrap5.min.js') }}"></script>

  <script type="module">
    import * as pdfjsLib from '../plugins/pdf.js/pdf.mjs';
    import { GlobalWorkerOptions } from '../plugins/pdf.js/pdf.mjs'; 

    GlobalWorkerOptions.workerSrc = '../plugins/pdf.js/pdf.worker.mjs';
  </script>

  <script src="{{ url('plugins/turn.js/turn.min.js') }}"></script>
  <script src="{{ url('plugins/turn.js/zoom.min.js') }}"></script>

  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.7.570/pdf.min.js"></script> --}}

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="text/javascript">
    document.getElementById('btn-logout').addEventListener('click', function (e) {
      e.preventDefault();
        Swal.fire({
            title: 'Logout',
            text: 'Anda yakin ingin keluar?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke route logout
                // window.location.href = '{{ url("logout") }}';
                document.getElementById("logoutForm").submit();
            }
        });
    });
  </script>
  @yield('js')
</body>

</html>