@extends('admin.layout.main')
@section('title', 'Banner')
@section('isi')
<div class="main-content" id="dataadmin">
    <div class="title">
        <h5>halaman banner</h5>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <button type="button" id="btn-add" class="btn btn-primary fs-3 mb-3 rounded-2 btn-tambah" data-bs-toggle="modal" data-bs-target="#form_modal">Tambah data</button>
                    <table id="bannerTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Foto</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                         <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Foto</th>
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
                <form id="form_tambah" action="{{ route('banner.create') }}" method="POST" role="form">
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="nama">Nama:</label>
                                <input id="nama" type="text" name="nama" value="" class="form-control @error('nama') is-invalid @enderror" placeholder="nama" >                    
                                <div class="invalid-feedback">
                                    @error('nama')
                                    {{ $message }}
                                    @enderror
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-group">
                                <label for="foto">Foto:</label>
                                <input id="foto" type="file" name="foto" value="" class="form-control @error('foto') is-invalid @enderror" placeholder="foto" accept="image/jpeg, image/jpg, image/png, image/gif,">                    
                                <div class="invalid-feedback">
                                    @error('foto')
                                    {{ $message }}
                                    @enderror
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <img id="previewImg" src="" alt="Preview Image" style="display: none;">

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

<div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img class="img-fluid" id="fotoModalContent">
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script type="text/javascript">
        // Global Setup
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        function reload_table() {
            $('#bannerTable').DataTable().ajax.reload();
        }

        function reset_form() {
            $('#form_tambah').attr('action', "{{ route('banner.create') }}");
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
        $('#bannerTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('banner.list') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'nama', name: 'nama' },
                { data: 'foto', name: 'foto' },
                // { data: 'foto', name: 'foto', render: function(data, type, full, meta) {  
                //     var baseUrl = "{{ asset('uploads/banners') }}";
                //     return '<img src="' + baseUrl + '/' + data + '" style="max-width: 100px; max-height: 100px;" />';
                // }},
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
        function view_data(id, nama) {
            $('.modal-title').html('<h1 class="modal-title fs-5" id="ModalLabel">'+ nama +'</h1>');
            console.log(nama)

            $(document).on("click", ".btn-close", function() {
                $('#fotoModal').css('display', 'none');
            });

            $(window).on("click", function(event) {
                if (event.target == document.getElementById('fotoModal')) {
                    $('#fotoModal').css('display', 'none');
                }
            });

            $.ajax({
                url: '/get-foto/' + id,
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

        // Fungsi Edit dan Update
        function edit_data(id) {
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').empty();

            $('.modal-title').html('<h1 class="modal-title fs-5" id="ModalLabel"><i class="fa-solid fa-users"></i> Edit Data</h1>');
            $('#btn-simpan').html('Simpan');

            $('#form_tambah')[0].reset();
            $('#form_tambah').attr('action', '/banner/update?q=' + id);
            $.ajax({
                url: "{{ route('banner.edit') }}",
                type: "POST",
                data: {
                    q: id
                },
                dataType: "JSON",
                success: function(data) {
                    console.log(data);

                    if (data.status) {
                        var isi = data.isi;
                        // var fotoNama = data.isi.foto;
                        $('#nama').val(isi.nama);
                        // $('#foto').val(fotoNama);
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
        function delete_data(id, nama) {

            Swal.fire({
                title: 'Hapus ' + nama + '?',
                text: "Apakah anda yakin!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('banner.delete') }}",
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