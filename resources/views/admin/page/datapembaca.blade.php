@extends('admin.layout.main')
@section('title', 'Data Pembaca')

@section('isi')
<div class="main-content" id="dataadmin">
    <div class="title">
        <h5>halaman data pembaca</h5>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    {{-- <button type="button" id="btn-add" class="btn btn-primary fs-3 mb-3 rounded-2 btn-tambah" data-bs-toggle="modal" data-bs-target="#form_modal">Tambah data</button> --}}
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
@endsection

@section('js')
    <script type="text/javascript">
        // Fungsi index
        $(document).ready(function() {
            $('#userTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('datapembaca.list') }}",
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