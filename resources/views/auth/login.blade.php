<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Web Ebook App</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/logo-bwi.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-75">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../assets/images/logos/logo-dispusipbwi.png" width="180" alt="">
                </a>
                <p class="text-center">Selamat Datang </p>
                <form action="{{ route('login') }}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input autofocus type="text" class="form-control @error('username') is-invalid @enderror"
                      id="exampleInputEmail1" aria-describedby="emailHelp" name="username"
                      value="{{ old('username') }}">
                    @error('username')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
                  </div>
                  <div class="mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <div class="input-group">
                      <input type="password" class="form-control @error('password') is-invalid @enderror"
                        id="exampleInputPassword1" name="password">
                      <div class="input-group-text">
                        <span class="toggle-password" onclick="togglePasswordVisibility()">
                          <i class="ti ti-eye-off nav-small-cap-icon fs-4" id="toggleIcon" style="cursor: pointer;"></i>
                        </span>
                      </div>
                      @error('password')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                  </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <a class="text-primary fw-bold" href="{{ route('lupapassword') }}">Lupa Password ?</a>
                    <span>Belum Daftar? <a class="text-primary fw-bold" href="{{ route('register') }}">Daftar</a></span>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-3 rounded-2">Masuk</button>
                  <span><a class="text-primary fw-bold" href="{{ route('/') }}">Kembali</a></span>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('exampleInputPassword1');
        const toggleIcon = document.getElementById('toggleIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('ti-eye-off');
            toggleIcon.classList.add('ti-eye');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('ti-eye');
            toggleIcon.classList.add('ti-eye-off');
        }
    }
  </script>
</body>

</html>