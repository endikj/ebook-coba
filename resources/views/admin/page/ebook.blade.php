@extends('admin.layout.main')
@section('title', 'Ebook')

@section('isi')
<style>
    .form-select-sm {
        min-width: 130px; 
    }

    #fotoModalContent {
        width: 100%; 
        height: auto; 
        max-width: 500px; 
        max-height: 500px; 
    }
</style>

<div class="main-content" id="dataadmin">
    <div class="title">
        <h5>halaman Ebook</h5>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <button type="button" id="btn-add" class="btn btn-primary fs-3 mb-3 rounded-2 btn-tambah" data-bs-toggle="modal" data-bs-target="#form_modal">Tambah data</button>
                    <table id="ebookTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Pengarang</th>
                                <th>Tanggal</th>
                                <th>Rekomendasi</th>
                                <th>Publish</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Pengarang</th>
                                <th>Tangal</th>
                                <th>Rekomendasi</th>
                                <th>Publish</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Modal -->
 <div class="modal fade hidden" id="form_modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalLabel"><i class="fa-solid fa-users"></i> Tambah Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_tambah" action="{{  route('ebook.create') }}" method="POST" role="form">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="judul">Judul:</label>
                                <input id="judul" type="text" name="judul" value="" class="form-control @error('judul') is-invalid @enderror" placeholder="judul" >                    
                                <div class="invalid-feedback">
                                    @error('judul')
                                    {{ $message }}
                                    @enderror
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="kategori">Kategori:</label>
                                <select id="kategori" name="kategori" class="form-control @error('kategori') is-invalid @enderror">
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
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="pengarang">Pengarang:</label>
                                <input id="pengarang" type="text" name="pengarang" value="" class="form-control @error('pengarang') is-invalid @enderror" placeholder="pengarang" >                    
                                <div class="invalid-feedback">
                                    @error('pengarang')
                                    {{ $message }}
                                    @enderror
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="tentang_pengarang">Tentang Pengarang:</label>
                                <textarea id="tentang_pengarang" type="text" name="tentang_pengarang" value="" class="form-control @error('tentang_pengarang') is-invalid @enderror" placeholder="tentang pengarang" ></textarea>                     
                                <div class="invalid-feedback">
                                    @error('tentang_pengarang')
                                    {{ $message }}
                                    @enderror
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi:</label>
                                <textarea id="deskripsi" type="text" name="deskripsi" value="" class="form-control @error('deskripsi') is-invalid @enderror" placeholder="deskripsi" ></textarea>                     
                                <div class="invalid-feedback">
                                    @error('deskripsi')
                                    {{ $message }}
                                    @enderror
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="halaman">Halaman:</label>
                                <input id="halaman" type="number" name="halaman" value="" class="form-control @error('halaman') is-invalid @enderror" placeholder="halaman" >                    
                                <div class="invalid-feedback">
                                    @error('halaman')
                                    {{ $message }}
                                    @enderror
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="sumber">Sumber:</label>
                                <input id="sumber" type="text" name="sumber" value="" class="form-control @error('sumber') is-invalid @enderror" placeholder="sumber" >                    
                                <div class="invalid-feedback">
                                    @error('sumber')
                                    {{ $message }}
                                    @enderror
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="penerbit">Penerbit:</label>
                                <input id="penerbit" type="text" name="penerbit" value="" class="form-control @error('penerbit') is-invalid @enderror" placeholder="penerbit" >                    
                                <div class="invalid-feedback">
                                    @error('penerbit')
                                    {{ $message }}
                                    @enderror
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="bahasa">Bahasa:</label>
                                <input id="bahasa" type="text" name="bahasa" value="" class="form-control @error('bahasa') is-invalid @enderror" placeholder="bahasa" >                    
                                <div class="invalid-feedback">
                                    @error('bahasa')
                                    {{ $message }}
                                    @enderror
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="isbn">ISBN:</label>
                                <input id="isbn" type="text" name="isbn" value="" class="form-control @error('isbn') is-invalid @enderror" placeholder="isbn" >                    
                                <div class="invalid-feedback">
                                    @error('isbn')
                                    {{ $message }}
                                    @enderror
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="tanggal">Tanggal:</label>
                                <input id="tanggal" type="date" min="2000" name="tanggal" value="" class="form-control @error('tanggal') is-invalid @enderror" placeholder="tanggal" >                    
                                <div class="invalid-feedback">
                                    @error('tanggal')
                                    {{ $message }}
                                    @enderror
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="rekomendasi">Rekomendasi:</label>
                                <select id="rekomendasi" name="rekomendasi" class="form-control @error('rekomendasi') is-invalid @enderror">
                                    <option value="">Pilih rekomendasi</option>
                                    <option value="1">Rekomendasi</option>
                                    <option value="0">Tidak Rekomendasi</option>
                                </select>                  
                                <div class="invalid-feedback">
                                    @error('rekomendasi')
                                    {{ $message }}
                                    @enderror
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="publish">Publish:</label>
                                <select id="publish" name="publish" class="form-control @error('publish') is-invalid @enderror">
                                    <option value="">Pilih publish</option>
                                    <option value="1">Publish</option>
                                    <option value="0">Tidak Publish</option>
                                </select>                  
                                <div class="invalid-feedback">
                                    @error('publish')
                                    {{ $message }}
                                    @enderror
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="cover">Cover:</label>
                                <input id="cover" type="file" name="cover" value="" class="form-control @error('cover') is-invalid @enderror" placeholder="cover" accept="image/jpeg, image/jpg, image/png, image/gif,">                    
                                <div class="invalid-feedback">
                                    @error('cover')
                                    {{ $message }}
                                    @enderror
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="file">File:</label>
                                <input id="file" type="file" name="file" value="" class="form-control @error('file') is-invalid @enderror" placeholder="file" accept="application/pdf" >                    
                                <div class="invalid-feedback">
                                    @error('file')
                                    {{ $message }}
                                    @enderror
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="modal-footer">
                        <div class="btn-group">
                            <button type="button" id="btn-close" class="btn-hapus btn btn-warning rounded-2" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" id="btn-simpan" class="btn-tambah btn btn-primary rounded-2 ms-1">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- modal foto --}}
<div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img class="img-fluid" id="fotoModalContent" >
            </div>
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
            {{-- <div class="modal-body">
                <iframe id="ebookModalContent" src="" width="100%" height="500px" ></iframe>
            </div> --}}
            <div class="modal-body mb-flip">
                <div id="ebookModalContent" class="flipbook"></div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="btn-group d-flex" role="group" aria-label="Zoom controls">
                {{-- <button id="zoomIn" class="btn btn-primary">Zoom In</button>
                <button id="zoomOut" class="btn btn-primary">Zoom Out</button> --}}

                    <button id="first" class="btn btn-secondary flex-grow-1" title="First Page"><i class="ti ti-arrow-bar-to-left fs-5"></i></button>
                    <button id="previous" class="btn btn-primary flex-grow-1" title="Previous Page"><i class="ti ti-arrow-left fs-5"></i></button>
                    <button id="next" class="btn btn-primary flex-grow-1" title="Next Page"><i class="ti ti-arrow-right fs-5"></i></button>
                    <button id="last" class="btn btn-secondary flex-grow-1" title="Last Page"><i class="ti ti-arrow-bar-to-right fs-5"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div id="ebookModalContent" class="flipbook"></div> --}}

@endsection

@section('js')
    <script type="text/javascript">
        // Global Setup
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        function reload_table() {
            $('#ebookTable').DataTable().ajax.reload();
        }

        function reset_form() {
            $('#form_tambah').attr('action', "{{ route('ebook.create') }}");
            $('#form_tambah')[0].reset();
        }
        
        $('.form-control').on('input', function() {
            $(this).removeClass('is-invalid');
            $(this).siblings('.invalid-feedback').empty();
        });

        $('#btn-add').click(function() {
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').empty();

            $('.modal-title').html('<h1 class="modal-title fs-5" id="ModalLabel"><i class="fa-solid fa-users"></i> Tambah Data</h1>');
            $('#btn-simpan').html('Tambah');
            reset_form();
        });

        // Fungsi index
        $(document).ready(function() {
            $('#ebookTable').DataTable({
                processing: true,
                serverSide: true,
                paging: true,
                orderClasses: false,
                info: false,
                ajax: "{{ route('ebook.list') }}",
                order: [[4, 'asc']],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'judul', name: 'judul' },
                    { data: 'kategori', name: 'kategori' },
                    { data: 'pengarang', name: 'pengarang' },
                    { data: 'tanggal', name: 'tanggal' },
                    { data: 'rekomendasi', name: 'rekomendasi', 
                        // render: function(data, type, row, meta) {
                        //     var rekomendasi = data ? 'Tidak Rekomendasi' : 'Rekomendasi';
                        //     var btnRekomendasi = data ? 'btn-danger' : 'btn-success';
                        //     return `<button class="btn ${btnRekomendasi} btn-sm" onclick="rekomendasi(${row.id})">${rekomendasi}</button>`;
                        // }
                        render: function(data, type, row, meta) {
                        var options = `
                            <select class="form-select form-select-sm" onchange="rekomendasi(${row.id}, this.value)">
                                <option value="1" ${data == 1 ? 'selected' : ''}>Rekomendasi</option>
                                <option value="0" ${data == 0 ? 'selected' : ''}>Tidak</option>
                            </select>`;
                        return options;
                    }
                    },
                    { data: 'publish', name: 'publish', 
                        render: function(data, type, row, meta) {
                            var options = `
                                <select class="form-select form-select-sm" onchange="publish(${row.id}, this.value)">
                                    <option value="1" ${data == 1 ? 'selected' : ''}>Publish</option>
                                    <option value="0" ${data == 0 ? 'selected' : ''}>Tidak</option>
                                </select>`;
                            return options;
                        }
                        
                    },
                    { data: 'action', name: 'action', orderable: true, searchable: true }
                ]
            });
        });

        // Fungsi Tambah data
        $(function() {
            $('#form_tambah').submit(function(event) {
                event.preventDefault();
                event.stopImmediatePropagation();
                var url = $(this).attr('action');
                var formData = new FormData($(this)[0]);

                $.ajax({
                    url: url,
                    type: "POST",
                    dataType: "JSON",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        $('.error-message').empty();
                        if (data.errors) {
                            Swal.fire("Error", "Datanya ada yang kurang", "error");

                            $.each(data.errors, function(key, value) {
                                $('#' + key).addClass('is-invalid').siblings('.invalid-feedback').text(value);
                            });

                            $('.form-control').on('input', function() {
                                $(this).removeClass('is-invalid');
                                $(this).siblings('.invalid-feedback').empty();
                            });

                        } else {
                            reset_form();
                            Swal.fire(
                                'Sukses',
                                'Data berhasil disimpan',
                                'success'
                            );
                            $('#form_modal').modal('hide');
                            reload_table();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                    },
                    complete: function() {
                    }
                });
            });
        });

        //fungsi lihat foto
        function view_cover(id, judul) {
            $('.modal-title').html('<h1 class="modal-title fs-5" id="ModalLabel">'+ judul +'</h1>');
            console.log(judul)

            $(document).on("click", ".btn-close", function() {
                $('#fotoModal').css('display', 'none');
            });

            $(window).on("click", function(event) {
                if (event.target == document.getElementById('fotoModal')) {
                    $('#fotoModal').css('display', 'none');
                }
            });

            $.ajax({
                url: '/get-cover/' + id,
                type: 'GET',
                success: function(response) {
                    $('#fotoModalContent').attr('src', response.foto_url).css('max-width', '100%').css('max-height', '100%');
                    $('#fotoModal').modal('show');
                },
                error: function(xhr) {
                    alert('Gagal memuat foto. Silakan coba lagi.');
                }
            });
        };

        //fungsi lihat ebook
        // let flipbook;

        function view_ebook(id, judul) {
            $('.modal-title').html('<h1 class="modal-title fs-5" id="ModalLabel">'+ judul +'</h1>');
            console.log(judul)

            $(document).on("click", ".btn-close", function() {
                $('#ebookModal').css('display', 'none');
                // $('.flipbook').turn('destroy');
                // if (flipbook && typeof flipbook.turn === 'function') {
                //     flipbook.turn('destroy');
                //     flipbook = null;
                // }
                // $('#ebookModalContent').empty(); 
                
                // if ($('.flipbook').length > 0) {
                //     console.log('Flipbook masih ada di DOM');
                // } else {
                //     console.log('Flipbook sudah dihancurkan');
                // }

            });

            $.ajax({
                url: '/get-file/' + id,
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

                            // Initialize zoom
                            // flipbook.zoom({
                            //     flipbook: flipbook,
                            //     max: 2,
                            //     when: {
                            //         zooming: function(event, newScale, oldScale) {
                            //             console.log('Zooming from ' + oldScale + ' to ' + newScale);
                            //         }
                            //     }
                            // });

                            // $('#zoomIn').off('click').on('click', function() {
                            //     flipbook.zoom('zoomIn');
                            // });

                            // $('#zoomOut').off('click').on('click', function() {
                            //     flipbook.zoom('zoomOut');
                            // });

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
        };

        //fungsi publish 
        window.publish = function(id, status) {
            $.ajax({
                url: "{{ url('ebook/publish') }}/" + id,
                type: 'POST',
                data: { publish: status },
                success: function(response) {
                    reload_table();
                    // alert(response.success);
                    Swal.fire(
                        'Sukses',
                        'Status berhasil diperbarui',
                        'success'
                    );
                }
            });
        };

        //fungsi rekomendasi
        window.rekomendasi = function(id, status) {
            $.ajax({
                url: "{{ url('ebook/rekomendasi') }}/" + id,
                type: 'POST',
                data: { rekomendasi: status },
                success: function(response) {
                    reload_table();
                    // alert(response.success);
                    let statusText = status == 1 ? 'Rekomendasi' : 'Tidak Rekomendasi';
                    Swal.fire(
                        'Sukses',
                        'Status berhasil diperbarui menjadi ' + statusText,
                        'success'
                    );
                }
            });
        };

        // Fungsi Edit dan Update
        function edit_data(id) {
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').empty();

            $('.modal-title').html('<h1 class="modal-title fs-5" id="ModalLabel"><i class="fa-solid fa-users"></i> Edit Data</h1>');
            $('#btn-simpan').html('Simpan');

            $('#form_tambah')[0].reset();
            $('#form_tambah').attr('action', '/ebook/update?q=' + id);
            $.ajax({
                url: "{{ route('ebook.edit') }}",
                type: "POST",
                data: {
                    q: id
                },
                dataType: "JSON",
                success: function(data) {
                    console.log(data);

                    if (data.status) {
                        var isi = data.isi;
                        $('#judul').val(isi.judul);
                        $('#kategori').val(isi.kategori.id);
                        $('#pengarang').val(isi.pengarang);
                        $('#tentang_pengarang').val(isi.tentang_pengarang);
                        $('#deskripsi').val(isi.deskripsi);
                        $('#halaman').val(isi.halaman);
                        $('#sumber').val(isi.sumber);
                        $('#penerbit').val(isi.penerbit);
                        $('#bahasa').val(isi.bahasa);
                        $('#isbn').val(isi.isbn);
                        $('#tanggal').val(isi.tanggal);
                        $('#publish').val(isi.publish);
                        $('#rekomendasi').val(isi.rekomendasi);
                        // $('#cover').val(isi.cover);
                        // $('#file').val(isi.file);
                    } else {
                        Swal.fire("SALAH BOS", "Datanya ada yang salah", "error");
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    Swal.fire('Upss..!', 'Terjadi kesalahan jaringan error message: ' + errorThrown,
                        'error');
                }
            });
        };

        // Fungsi Hapus
        function delete_data(id, judul) {

            Swal.fire({
                title: 'Hapus ' + judul + '?',
                text: "Apakah anda yakin!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('ebook.delete') }}",
                        type: "POST",
                        data: {
                            q: id
                        },
                        dataType: "JSON",
                    });
                    Swal.fire(
                        'Hapus!',
                        'Akun berhasil Dihapus',
                        'success'
                    )
                    reload_table();
                }
            })
        };
        

    </script>
@endsection