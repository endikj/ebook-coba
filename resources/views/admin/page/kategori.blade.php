@extends('admin.layout.main')
@section('title', 'Kategori')
@section('isi')
<div class="main-content" id="dataadmin">
    <div class="title">
        <h5>halaman kategori</h5>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <button type="button" id="btn-add" class="btn btn-primary fs-3 mb-3 rounded-2 btn-tambah" data-bs-toggle="modal" data-bs-target="#form_modal">Tambah data</button>
                    <table id="kategoriTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
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
                    <form id="form_tambah" action="{{ route('kategori.create') }}" method="POST" role="form">
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="kategori">Kategori:</label>
                                    <input id="kategori" type="text" name="kategori" value="" class="form-control @error('kategori') is-invalid @enderror" placeholder="kategori" >                    
                                    <div class="invalid-feedback">
                                        @error('kategori')
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
@endsection

@section('js')
    <script type="text/javascript">
        // Global Setup
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        function reload_table() {
            $('#kategoriTable').DataTable().ajax.reload();
        }

        function reset_form() {
            $('#form_tambah').attr('action', "{{ route('kategori.create') }}");
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
            $('#kategoriTable').DataTable({
                processing: true,
                serverSide: true,
                paging: true,
                orderClasses: false,
                info: false,
                ajax: "{{ route('kategori.list') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'kategori', name: 'kategori' },
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

        // Fungsi Edit dan Update
        function edit_data(id) {
            $('.form-control').removeClass('is-invalid');
            $('.invalid-feedback').empty();

            $('.modal-title').html('<h1 class="modal-title fs-5" id="ModalLabel"><i class="fa-solid fa-users"></i> Edit Data</h1>');
            $('#btn-simpan').html('Simpan');

            $('#form_tambah')[0].reset();
            $('#form_tambah').attr('action', '/kategori/update?q=' + id);
            $.ajax({
                url: "{{ route('kategori.edit') }}",
                type: "POST",
                data: {
                    q: id
                },
                dataType: "JSON",
                success: function(data) {
                    console.log(data);

                    if (data.status) {
                        var isi = data.isi;
                        $('#kategori').val(isi.kategori);
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
        function delete_data(id, kategori) {

            Swal.fire({
                title: 'Hapus Kategori ' + kategori + '?',
                text: "Apakah anda yakin!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('kategori.delete') }}",
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