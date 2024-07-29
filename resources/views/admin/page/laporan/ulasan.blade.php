@extends('admin.layout.main')
@section('title', 'Laporan')

@section('isi')
<div class="main-content" id="dataadmin">
    <div class="title">
        <h5>Halaman Laporan Ulasan</h5>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="tahunFilter" class="form-label">Tahun:</label>
                            <input type="number" id="tahunFilter" class="form-control" placeholder="Tahun">
                        </div>
                        <div class="col">
                            <label for="bulanFilter" class="form-label">Bulan:</label>
                            <input type="month" id="bulanFilter" class="form-control" placeholder="Bulan">
                        </div>
                        <div class="col">
                            <label for="tanggalFilter" class="form-label">Tanggal:</label>
                            <input type="date" id="tanggalFilter" class="form-control" placeholder="Tanggal">
                        </div>
                    </div>
                    <button id="btn-print" class="btn btn-primary mb-3">Cetak</button>
                    <table id="ulasanTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Ebook</th>
                                <th>Pembaca</th>
                                <th>Komentar</th>
                                <th>Penilaian</th>
                                <th>Waktu</th>
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
            $('#ulasanTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('laporanulasan.list') }}",
                order: [[5, 'desc']],
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    { data: 'judul', name: 'judul' },
                    { data: 'nama', name: 'nama' },
                    { data: 'komentar', name: 'komentar' },
                    { data: 'penilaian', name: 'penilaian' },
                    { data: 'created_at', name: 'created_at' },
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