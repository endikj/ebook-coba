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

        .card {
            margin-top: 20px;
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
<div class="container py-5">
    <h2 class="text-center">Riwayat Baca</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($riwayatBaca as $rb)
        {{-- @if($rb->publish == 1) --}}
        <div class="col col-sm-3">
            <div class="card">
                <img src="{{ asset('uploads/covers/'.$rb->cover) }}" class="card-img foto" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $rb->judul }}</h5>
                    <p class="card-text">{{ Str::limit($rb->deskripsi,100) }}</p>
                    <div class="d-flex justify-content-around mb-3">
                        <div class="icon-container">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                <path
                                    d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                            </svg>
                            <span id="icon-text-{{ $rb->id }}" class="icon-text" style="margin-left: 5px">{{
                                $rb->jumlah_baca
                                }}</span>
                        </div>
                        <div class="icon-container star-penilaian ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-star-fill" viewBox="0 0 16 16">
                                <path
                                    d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                            </svg>
                            <span class="icon-text">({{ number_format($rb->average_rating, 1) }})</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-around mb-5">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ebookModal"
                        onclick="baca('{{ $rb->id }}', '{{ $rb->judul }}'); jumlahBaca('{{ $rb->id }}');">Baca</button>
                    <a href="{{ route('detailebook', Crypt::encrypt($rb->id)) }}"><button class="btn btn-success">Detail
                            E-Book</button>
                    </a>
                </div>
            </div>
        </div>
        {{-- @endif --}}
        @endforeach
    </div>
</div>
</div>
{{-- modal ebook --}}
<div class="modal fade" id="ebookModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog md-flip">
        <div class="modal-content mc-flip">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body mb-flip">
                <div id="ebookModalContent" class="flipbook"></div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="btn-group d-flex" role="group" aria-label="Zoom controls">
                    <button id="first" class="btn btn-secondary flex-grow-1" title="First Page"><i
                            class="ti ti-arrow-bar-to-left fs-5"></i></button>
                    <button id="previous" class="btn btn-primary flex-grow-1" title="Previous Page"><i
                            class="ti ti-arrow-left fs-5"></i></button>
                    <button id="next" class="btn btn-primary flex-grow-1" title="Next Page"><i
                            class="ti ti-arrow-right fs-5"></i></button>
                    <button id="last" class="btn btn-secondary flex-grow-1" title="Last Page"><i
                            class="ti ti-arrow-bar-to-right fs-5"></i></button>
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

    function jumlahBaca(id) {
        $.ajax({
            url: '/jumlahbaca/' + id,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                var jumlahPembaca = response.jumlah_baca;
                $('#icon-text-' + id).text(jumlahPembaca);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    function baca(id, judul) {
        $('.modal-title').html('<h1 class="modal-title fs-5" id="ModalLabel">' + judul + '</h1>');
        console.log('Ebook ID:', id);
        console.log('Judul Ebook:', judul);

        $(document).on("click", ".btn-close", function() {
            $('#ebookModal').css('display', 'none');
            // $('#ebookModalContent').attr('src', '');
        });

        // $('#ebookModal').on('hidden.bs.modal', function () {
        //     $('#ebookModalContent').attr('src', '');
        // });

        $.ajax({
            url: '/bacaebook/' + id,
            type: 'GET',
            success: function(response) {
                console.log(response);
                // $('#ebookModalContent').attr('src', response.file_url);
                // $('#ebookModal').modal('show');

                const pdfUrl = response.file_url;
                const container = $('#ebookModalContent');
                container.html(''); // Clear previous content
                const flipbook = $('<div class="flipbook"></div>');
                container.append(flipbook);

                // Load PDF and convert to flipbook
                pdfjsLib.getDocument(pdfUrl).promise.then(function(pdf) {
                    const pagePromises = [];

                    // Ensure valid number of pages
                    const numPages = pdf.numPages || 0;
                    if (numPages === 0) {
                        console.error('Error: No pages found in the PDF.');
                        return;
                    }

                    for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                        pagePromises.push(pdf.getPage(pageNum).then(function(page) {
                            const canvas = document.createElement('canvas');
                            const context = canvas.getContext('2d');
                            const viewport = page.getViewport({ scale: 1.1 });
                            canvas.height = viewport.height;
                            canvas.width = viewport.width;

                            return page.render({ canvasContext: context, viewport: viewport }).promise.then(function() {
                                const pageElement = $('<div />').addClass('page').append(canvas);
                                return pageElement;
                            });
                        }));
                    }

                    Promise.all(pagePromises).then(function(pageElements) {
                        pageElements.forEach(function(pageElement) {
                            flipbook.append(pageElement);
                        });

                        flipbook.turn({ 
                            width: pageElements[0].width(), 
                            height: pageElements[0].height(), 
                            autoCenter: true, 
                            duration: 1500, // Durasi animasi membalik halaman dalam milidetik
                        });

                        $('#first').on('click', function() {
                            var numPages = flipbook.turn('pages');
                            // Ambil nomor halaman saat ini
                            var currentPage = flipbook.turn('page');

                            // Periksa apakah halaman saat ini bukan halaman pertama
                            if (currentPage !== 1 && currentPage <= numPages) {
                                // Pindahkan flipbook ke halaman pertama
                                flipbook.turn('page', 1);
                            }
                        });

                        $('#last').on('click', function() {
                            // Ambil total jumlah halaman dari flipbook
                            var numPages = flipbook.turn('pages');

                            // Ambil nomor halaman saat ini
                            var currentPage = flipbook.turn('page');

                            // Periksa apakah halaman saat ini bukan halaman terakhir
                            if (currentPage !== numPages) {
                                // Pindahkan flipbook ke halaman terakhir
                                flipbook.turn('page', numPages);
                            }
                        });

                        $('#previous').on('click', function() {
                            const currentPage = flipbook.turn('page');
                            if (currentPage > 1) {
                                flipbook.turn('previous');
                            }
                        });

                        $('#next').on('click', function() {
                            const currentPage = flipbook.turn('page');
                            if (currentPage < numPages) {
                                flipbook.turn('next');
                            }
                        });
                    });
                });

                $('#ebookModal').modal('show');
            },
            error: function(xhr) {
                alert('Gagal memuat ebook. Silakan coba lagi.');
            }
        });
        saveReadingHistory(id, judul);
    };

    function saveReadingHistory(id, judul) {
        fetch('/riwayatbaca', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id_ebook: id, judul: judul })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log(data.success);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>


@endsection