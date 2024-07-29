<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Web Ebook App</title>
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
                                <p class="text-center">Silakan lakukan pendaftaran </p>
                                <form action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1"
                                            class="form-label @error('nama') is-invalid @enderror">Nama:</label>
                                        <input type="text" class="form-control" id=" nama" name="nama"
                                            value="{{ old('nama') }}" required autofocus>
                                        @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1"
                                            class="form-label @error('email') is-invalid @enderror">Email:</label>
                                        <input type="email" class="form-control" id=" email" name="email"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1"
                                            class="form-label @error('no_hp') is-invalid @enderror">No HP:</label>
                                        <input type="no_hp" class="form-control" id="no_hp" name="no_hp"
                                            value="{{ old('no_hp') }}" required>
                                        @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1"
                                            class="form-label @error('username') is-invalid @enderror">Username:</label>
                                        <input type="username" class="form-control" id=" username" name="username"
                                            value="{{ old('username') }}" required>
                                        @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <div class="mb-4">
                                            <label for="exampleInputPassword1" class="form-label"
                                                id="exampleInputPassword1" name="password">Password:</label>
                                            <div class="input-group">
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    id="password" name="password" required>
                                                <div class="input-group-text">
                                                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                                                        <i class="ti ti-eye-off nav-small-cap-icon fs-4" id="toggleIcon"
                                                            style="cursor: pointer;"></i>
                                                    </span>
                                                </div>
                                                @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-3 rounded-2"
                                            id="sign_up">Daftar</button>
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
        const passwordInput = document.getElementById('password');
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif
        });
    </script>
</body>

</html>