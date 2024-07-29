@extends('admin.layout.main')
@section('title', 'Data Admin')
@section('isi')
<div class="main-content" id="dataadmin">
    <div class="title">
        <h5>halaman data admin</h5>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    {{-- <a type="button" class="btn-tambah mb-2" id="btn-add" data-bs-toggle="modal" data-bs-target="#form_modal"><i class="fa-solid fa-square-plus"></i>&nbsp;&nbsp;Tambah Data</a> --}}
                    <button type="button" id="btn-add" class="btn btn-primary fs-3 mb-3 rounded-2 btn-tambah" data-bs-toggle="modal" data-bs-target="#form_modal">Tambah data</button>
                    <table id="userTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email </th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>No Hp</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
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
                    <h1 class="modal-title fs-5" id="ModalLabel"><i class="fa-solid fa-users"></i> Tambah Admin</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_tambah" action="{{ route('dataadmin.create') }}" method="POST" role="form">
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="nama">Nama:</label>
                                    <input id="nama" type="text" name="nama" value="" class="form-control @error('nama') is-invalid @enderror" placeholder="Nama" >                    
                                    <div class="invalid-feedback">
                                        @error('nama')
                                        {{ $message }}
                                        @enderror
                                    </div>                              
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input id="email" type="email" name="email" value="" class="form-control @error('email') is-invalid @enderror" placeholder="Email">                                   
                                    <div class="invalid-feedback">
                                        @error('email')
                                        {{ $message }}
                                        @enderror
                                    </div>                          
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="username">Username:</label>
                                    <input id="username" type="text" name="username" value="" class="form-control @error('username') is-invalid @enderror" placeholder="Username">
                                    <div class="invalid-feedback">
                                        @error('username')
                                        {{ $message }}
                                        @enderror
                                    </div>    
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="password">
                                    <div class="invalid-feedback">
                                        @error('password')
                                        {{ $message }}
                                        @enderror
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="role">Role:</label>
                                    <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                                        <option value="" disabled selected>Pilih peran...</option>
                                        <option value="1">Super Admin</option>
                                        <option value="2">Admin</option>
                                    </select>                  
                                    <div class="invalid-feedback">
                                        @error('role')
                                        {{ $message }}
                                        @enderror
                                    </div> 
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label for="no_hp">No Hp:</label>
                                    <input id="no_hp" type="tel" name="no_hp" value="" class="form-control @error('no_hp') is-invalid @enderror" placeholder="no hp" rn="[0-9]{10,15}" title="Harap masukkan nomor HP yang valid" >
                                    <div class="invalid-feedback">
                                        @error('no_hp')
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
            $('#userTable').DataTable().ajax.reload();
        }

        function reset_form() {
            $('#form_tambah').attr('action', "{{ route('dataadmin.create') }}");
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
            $('#userTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dataadmin.list') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'nama', name: 'nama' },
                    { data: 'email', name: 'email' },
                    { data: 'username', name: 'username' },
                    { data: 'role', name: 'role' },
                    { data: 'no_hp', name: 'no_hp' },
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
            $('.modal-title').html('<h1 class="modal-title fs-5" id="ModalLabel"><i class="fa-solid fa-users"></i> Edit Data</h1>');
            $('#btn-simpan').html('Simpan');

            $('#form_tambah')[0].reset();
            $('#form_tambah').attr('action', '/dataadmin/update?q=' + id);
            $.ajax({
                url: "{{ route('dataadmin.edit') }}",
                type: "POST",
                data: {
                    q: id
                },
                dataType: "JSON",
                success: function(data) {
                    console.log(data);

                    if (data.status) {
                        var isi = data.isi;
                        $('#nama').val(isi.nama);
                        $('#email').val(isi.email);
                        $('#username').val(isi.username);
                        $('#password').val(isi.password);
                        $('#role').val(isi.role);
                        $('#no_hp').val(isi.no_hp);

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
        function delete_data(id) {
            Swal.fire({
                title: 'Hapus Akun',
                text: "Apakah anda yakin!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('dataadmin.delete') }}",
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