<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Book DISPUSIP</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/logo-bwi.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{--
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/css/bootstrap.min.css" rel="stylesheet"> --}}
    <title>Document</title>

    <link rel="stylesheet" href="../assets/css/flipbook.css" />
    <link rel="stylesheet" href="{{ url('plugins/datatables-bs4/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ url('plugins/datatables-responsive/css/responsive.bootstrap5.min.css') }}">
    {{--
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/simplebar@5.3.9/dist/simplebar.min.css" rel="stylesheet">
</head>

<body style="overflow-x: hidden;">
    <script>
        function updateDate() {
    var currentDate = new Date();       
    var day = currentDate.getDate();
    var month = currentDate.getMonth() + 1; 
    var year = currentDate.getFullYear();
    var dayOfWeek = currentDate.getDay();
    var dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    var dayName = dayNames[dayOfWeek];
    var formattedDate = dayName + ', ' + day + ' ' + getMonthName(month) + ' ' + year;
    document.getElementById('currentDate').textContent = formattedDate;
}

function getMonthName(monthIndex) {
    var monthNames = [
      'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
      'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    return monthNames[monthIndex - 1];
}
$(document).ready(function(){
    updateDate();
});
    </script>
    <style>
        #currentDate {
            background-color: black;
            color: white;
            padding: 15px 0px 20px 35px;
        }

        .content {
            margin-top: 12%;
        }

        .text-uppercase {
            color: white;
            text-align: left;
        }
    </style>
    <div class="fixed-top">
        <div id="currentDate">
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="../assets/images/logos/logo-dispusipbwi.png" width="180">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('/') }}"
                                style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-house-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293z" />
                                    <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293z" />
                                </svg>
                                <p style="text-align: center; margin: 0;">Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('riwayatbaca') }}"
                                style="display: flex; flex-direction: column; align-items: center; justify-content: center;"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-clock-history" viewBox="0 0 16 16">
                                    <path
                                        d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z" />
                                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z" />
                                    <path
                                        d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5" />
                                </svg>
                                <p style="text-align: center; margin: 0;">Riwayat Baca</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#koleksi"
                                style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-tags-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                                    <path
                                        d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043z" />
                                </svg>
                                <p style="text-align: center; margin: 0;">Koleksi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('cariebook') }}"
                                style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                </svg>
                                <p style="text-align: center; margin: 0;">Cari Buku</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="#"
                                style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-book-half" viewBox="0 0 16 16">
                                    <path
                                        d="M8.5 2.687c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                                </svg>
                                <p style="text-align: center; margin: 0;">Katalog E-Book
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#"
                                style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-person-fill-add" viewBox="0 0 16 16">
                                    <path
                                        d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                    <path
                                        d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4" />
                                </svg>
                                <p style="text-align: center; margin: 0;">Pendaftaran Anggota</p>
                            </a>
                        </li>
                        @guest
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('login') }}"
                                style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z" />
                                    <path fill-rule="evenodd"
                                        d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                                </svg>
                                <p style="text-align: center; margin: 0;">Masuk/Daftar</p>
                            </a>
                        </li>
                        @endguest

                        @auth
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('profile') }}"
                                style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                    class="bi bi-person-circle" viewBox="0 0 16 16">
                                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                    <path fill-rule="evenodd"
                                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                </svg>
                                <p style="text-align: center; margin: 0;">Profile</p>
                            </a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <footer class="bg-dark text-white text-center text-lg-start" style=" margin-top: auto;">
        <!-- Grid container -->
        <div class="container p-4">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <img src="/assets/images/logos/LOGO-DISPUSIP-BANYUWANGI-WP-1.png" alt="" width="150px">

                    <p>
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iste atque ea quis
                        molestias. Fugiat pariatur maxime quis culpa corporis vitae repudiandae aliquam
                        voluptatem veniam, est atque cumque eum delectus sint!
                    </p>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Statistik</h5>

                    <ul class="list-unstyled mb-0">
                        <li>
                            <span id="visitor-count"></span>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="text-uppercase mb-0">Links</h5>

                    <ul class="list-unstyled">
                        <li>
                            <a href="#!" class="text-white">Link 1</a>
                        </li>
                        <li>
                            <a href="#!" class="text-white">Link 2</a>
                        </li>
                        <li>
                            <a href="#!" class="text-white">Link 3</a>
                        </li>
                        <li>
                            <a href="#!" class="text-white">Link 4</a>
                        </li>
                    </ul>
                </div>
                <!--Grid column-->
            </div>
            <!--Grid row-->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            © 2020 Copyright: Dinas Perpustakaan dan Kearsipan Kab. Banyuwangi
            {{-- <a class="text-white" href="https://mdbootstrap.com/">MDBootstrap.com</a> --}}
        </div>
        <!-- Copyright -->
    </footer>

    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>

    <script type="module">
        import * as pdfjsLib from '{{ asset('plugins/pdf.js/pdf.mjs') }}';
        import { GlobalWorkerOptions } from '{{ asset('plugins/pdf.js/pdf.mjs') }}'; 
    
    GlobalWorkerOptions.workerSrc = '{{ asset('plugins/pdf.js/pdf.worker.mjs') }}';
    
    document.addEventListener("DOMContentLoaded", function() {
        fetch('{{ asset('counter.php') }}')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                if (data.error) {
                    throw new Error('Server error: ' + data.error);
                }
                document.getElementById('visitor-count').innerHTML = `
                    <p>Jumlah Pengunjung Hari Ini: ${data.today}</p>
                    <p>Jumlah Pengunjung Kemarin: ${data.yesterday}</p>
                    <p>Jumlah Pengunjung Bulan Ini: ${data.month}</p>
                    <p>Jumlah Pengunjung Tahun Ini: ${data.year}</p>
                    <p>Total Jumlah Pengunjung: ${data.total}</p>
                `;
            })
            .catch(error => {
                console.error('Error fetching visitor count:', error);
                document.getElementById('visitor-count').innerHTML = '<p>Statistik dapat dilihat pada halaman Home</p>';
            });
    });
    </script>

    <script src="{{ url('plugins/turn.js/turn.min.js') }}"></script>
    <script src="{{ url('plugins/turn.js/zoom.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('js')
</body>

</html>