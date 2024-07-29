@extends('index')
@section('content')

<head>
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card {
            /* height: 620px; */
        }

        .card .foto {
            width: 100%;
            padding: 30px;
            height: 300px;
        }

        .btn-primary {
            border-radius: 50px;
            width: 80px;
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
    </style>
</head>
<div class="container py-5" style="margin-top: 100px; margin-left: 60px;">
    <form action="{{ url('/cariebook/post') }}" method="POST">
        @method('post')
        @csrf
        <div class="row">
            <div class="col">
                <input type="text" id="searchInput" class="form-control" name="search" placeholder="Cari..."
                    aria-label="Cari...">
            </div>
            <div class="col">
                <select id="kategori" name="id_kategori" class="form-control @error('kategori') is-invalid @enderror">
                    <option value="">Pilih Kategori</option>
                    @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    @error('kategori')
                    {{ $message }}
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-success">Cari</button>
    </form>
</div>
</div>

<div class="container py-5">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($ebook as $e)
        @if($e->publish == 1)
        <div class="col col-sm-3">
            <div class="card">
                <img src="{{ asset('uploads/covers/'.$e->cover) }}" class="card-img foto" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $e->judul }}</h5>
                    <p class="card-text">{{ Str::limit($e->deskripsi,100) }}</p>
                    <div class="d-flex justify-content-around mb-3">
                        <div class="icon-container">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                <path
                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                            </svg>
                            <span id="icon-text-{{ $e->id }}" class="icon-text" style="margin-left: 5px">{{
                                $e->jumlah_baca
                                }}</span>
                        </div>
                        <div class="icon-container star-penilaian ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <span class="icon-text">({{ number_format($e->average_rating, 1) }})</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-around mb-5">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ebookModal"
                        onclick="baca('{{ $e->id }}', '{{ $e->judul }}'); jumlahBaca('{{ $e->id }}');">Baca</button>
                    <a href="{{ route('detailebook', Crypt::encrypt($e->id)) }}"><button class="btn btn-success">Detail
                            E-Book</button>
                    </a>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById('searchInput');
        const kategoriSelect = document.getElementById('kategori');
        const searchButton = document.querySelector('button');

        searchInput.addEventListener('input', performSearch);
        kategoriSelect.addEventListener('change', performSearch);
        searchButton.addEventListener('click', performSearch);
    });

    function performSearch() {
        const searchInputValue = document.getElementById('searchInput').value;
        const kategoriSelectValue = document.getElementById('kategori').value;

        // Kirim permintaan AJAX ke server dengan nilai pencarian
        function performSearch() {
    const searchInputValue = document.getElementById('searchInput').value;
    const kategoriSelectValue = document.getElementById('kategori').value;

    // Kirim permintaan pencarian ke server
    fetch(`/search?query=${searchInputValue}&kategori=${kategoriSelectValue}`)
        .then(response => response.json())
        .then(data => {
        })
        .catch(error => console.error('Error performing search:', error));
}
    }
</script>
@endsection