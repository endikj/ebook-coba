@extends('index')

@section('content')

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .card .foto {
            width: 100%;
            padding: 30px;
            height: 300px;
        }

        .btn-primary {
            border-radius: 50px;
            width: 150px;
        }

        .btn-primary:hover {
            background-color: black;
        }

        .btn-success {
            border-radius: 50px;
            width: 130px;
        }

        .btn-success:hover {
            background-color: black;
        }

        .card {
            margin-top: 10px;
        }

        #button1 {
            width: 120px;
        }

        h5 {
            text-align: center;
        }

        .card-body .card-text {
            margin-left: 10px;
            margin-right: 10px;
        }

        /* style flipbook */
        .md-flip {
            max-width: none;
            /* Menghapus batasan lebar maksimum */
            width: auto !important;
            /* Menyesuaikan lebar modal secara otomatis */

            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .mc-flip {
            height: auto !important;
            /* Mengatur tinggi konten modal secara otomatis */
            min-height: calc(100vh - 20px);
            /* Menjamin modal tidak melebihi tinggi layar */

        }

        .mb-flip {
            overflow-y: auto;
            /* Menambahkan overflow-y agar konten modal dapat digulir jika diperlukan */
            padding: 30px;

            flex-grow: 1;
        }

        /* style card */
        .card {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .card-img-top {
            object-fit: cover;
            height: 200px;
            /* Menyesuaikan tinggi gambar */
        }

        .card-body {
            flex: 1 1 auto;
            display: flex;
            flex-direction: column;
        }

        .card-title {
            min-height: 3rem;
            /* Menyesuaikan tinggi minimum judul */
        }

        .card-text {
            flex-grow: 1;
        }

        .profile-picture {
            position: relative;
            display: inline-block;
        }

        .profile-picture img,
        .profile-picture svg {
            border: 5px solid #007bff;
            /* Blue border */
            padding: 5px;
            background-color: white;
            /* Background color for the picture area */
            border-radius: 50%;
            /* Ensures the image has a circular border */
        }

        .upload-form {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            text-align: center;
        }

        .upload-form label {
            cursor: pointer;
        }
    </style>
</head>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">

                    @if(session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4">
                            @if(Auth::user()->foto == null)
                            <img src="{{ asset('assets/images/profile/profile.png') }}"
                                class="img-thumbnail rounded mx-auto d-block">
                            @else
                            <img src="{{ asset(Auth::user()->foto) }}?ts={{ time() }}"
                                class="img-thumbnail rounded mx-auto d-block">
                            @endif
                            <form id="form_foto" action="{{ url('/profile/update-foto') }}" method="post"
                                enctype="multipart/form-data">
                                <div class="d-flex justify-content-center mb-2">
                                    <input type="file" accept="image/*" class="input-kecil" name="foto" id="foto"
                                        style="display: none">
                                    <button type="button" class="btn-upload" id="ubahAvatarBtn">Ubah
                                        Foto Profile</button>
                                </div>
                            </form>
                            {{-- <p>Besar file: maksimum 2.000 kilobytes (2 Megabytes). Ekstensi file yang
                                diperbolehkan: .JPG .JPEG .PNG.</p> --}}
                        </div>

                        <div class="col-md-8">
                            <form method="POST" action="{{ route('profile.update', $user->id) }}"
                                enctype="multipart/form-data">
                                @method('POST')
                                @csrf

                                <div class="row mb-3">
                                    <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama')
                                        }}</label>

                                    <div class="col-md-6">
                                        <input id="nama" type="text"
                                            class="form-control @error('nama') is-invalid @enderror" name="nama"
                                            value="{{ Auth::user()->nama }}" required autocomplete="nama">

                                        @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email
                                        ') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email', $user->email) }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="no_hp" class="col-md-4 col-form-label text-md-right">{{ __('Nomor HP')
                                        }}</label>

                                    <div class="col-md-6">
                                        <input id="no_hp" type="text"
                                            class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
                                            value="{{ Auth::user()->no_hp }}" required autocomplete="no_hp">

                                        @error('no_hp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Update Profile') }}
                                        </button>
                                    </div>
                                </div> --}}
                            </form>

                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <form class="mx-3" id="logoutForm" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary d-block w-100" id="btn-logout"
                                style="text-align: center; margin: 0;">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $.ajaxSetup({
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
});
function previewImage(event) {
        const reader = new FileReader();
        const profileImg = document.getElementById('profile-img');
        const defaultImg = document.getElementById('default-img');

        reader.onload = function() {
            profileImg.src = reader.result;
            profileImg.style.display = 'block';
            if (defaultImg) {
                defaultImg.style.display = 'none';
            }
        }

        reader.readAsDataURL(event.target.files[0]);
    }
    $('#ubahAvatarBtn').click(function() {
            $('#foto').click();
        });
        $(function() {
            $('#foto').change(function(event) {
                event.preventDefault();
                event.stopImmediatePropagation();
                var url = $('#form_foto').attr('action');
                var formData = new FormData($('#form_foto')[0]);

                Swal.fire({
                    title: "Sedang memproses",
                    html: "Mohon tunggu sebentar...",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    willOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: "JSON",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.errors) {
                            Swal.close();
                            let errorMessages = '';
                            $.each(response.errors, function(key, value) {
                                errorMessages += value + '<br>';
                            });
                            Swal.fire({
                                title: 'Upss..!',
                                html: errorMessages,
                                icon: 'error',
                                position: 'center',
                                showConfirmButton: false,
                                timer: 3000,
                                toast: false
                            });
                        } else {
                            location.reload();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.close();
                        Swal.fire({
                            title: 'Error',
                            text: 'Terjadi kesalahan saat memperbarui foto profil.',
                            icon: 'error',
                            position: 'center',
                            showConfirmButton: false,
                            timer: 3000,
                            toast: false
                        });
                    }
                });
            });
        });
</script>
@endsection