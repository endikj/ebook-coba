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
                                <p class="text-center">Ubah Password Anda</p>
                                <form action="{{ route('password.update') }}" method="POST"
                                    class="login100-form p-l-35 p-r-35 p-t-20 p-b-20 validate-form flex-sb flex-w">
                                    @csrf
                                    <div class="p-t-31 p-b-9">
                                        <span class="txt1">
                                            Masukkan Password Baru
                                        </span>
                                        <div class="wrap-input100 validate-input" data-validate="Masukkan Password">
                                            <input type="hidden" value="{{ request()->token }}" name="token">
                                            <input type="hidden" value="{{ request()->email }}" name="email">
                                            <input class="input100" type="password" name="password">
                                            <span class="focus-input100"></span>
                                        </div>
                                        <div class="p-t-13 p-b-9">
                                            <span class="txt1">
                                                Password Dikonfirmasi
                                            </span>
                                        </div>
                                        <div class="wrap-input100 validate-input" data-validate="Masukkan Password">
                                            <input type="password" name="konfirmasi_password" class="input100">
                                            <span class="focus-input100"></span>
                                        </div>
                                        <div class="container-login100-form-btn m-t-17">
                                            <button class="login100-form-btn">
                                                Ubah Password
                                            </button>
                                        </div>
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