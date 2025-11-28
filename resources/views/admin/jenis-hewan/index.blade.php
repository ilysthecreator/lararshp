@extends('admin.layout')

@section('title', 'Daftar Jenis Hewan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Jenis Hewan</h1>
        <a href="{{ route('admin.jenis-hewan.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
            <span class="text">Tambah Jenis Hewan</span>
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Jenis Hewan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">ID</th>
                            <th width="70%">Nama Jenis Hewan</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jenisHewan as $index => $jenis)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $jenis->idjenis_hewan }}</td>
                            <td><strong>{{ $jenis->nama_jenis_hewan }}</strong></td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm btn-edit" 
                                        data-id="{{ $jenis->idjenis_hewan }}" 
                                        title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.jenis-hewan.destroy', $jenis->idjenis_hewan) }}" 
                                      method="POST" 
                                      class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                <i class="fas fa-info-circle"></i> Tidak ada data jenis hewan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Jenis Hewan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_nama_jenis_hewan">Nama Jenis Hewan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_nama_jenis_hewan" name="nama_jenis_hewan" required>
                        <small class="form-text text-muted">
                            Masukkan nama jenis hewan beserta nama ilmiahnya (opsional)
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Inisialisasi DataTable
    $('#dataTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        },
        "pageLength": 10,
        "ordering": true,
        "searching": true
    });

    // Handle klik tombol edit
    $('.btn-edit').on('click', function() {
        var id = $(this).data('id');
        var url = "{{ url('admin/jenis-hewan') }}/" + id + "/edit";
        var updateUrl = "{{ url('admin/jenis-hewan') }}/" + id;

        // Set action form
        $('#editForm').attr('action', updateUrl);

        // Ambil data via AJAX
        $.get(url, function(data) {
            // Isi form di modal
            $('#edit_nama_jenis_hewan').val(data.nama_jenis_hewan);

            // Tampilkan modal
            $('#editModal').modal('show');
        }).fail(function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal mengambil data!'
            });
        });
    });

    // Konfirmasi hapus data
    $('.form-delete').on('submit', function(e) {
        e.preventDefault();
        const form = this;
        const jenisHewanName = $(this).closest('tr').find('td:nth-child(3)').text().trim();

        Swal.fire({
            title: 'Anda yakin?',
            html: `Anda akan menghapus jenis hewan: <strong>${jenisHewanName}</strong>. <br> Data yang dihapus tidak dapat dikembalikan!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => { // NOSONAR
            if (result.isConfirmed) { // NOSONAR
                form.submit(); // NOSONAR
            } // NOSONAR
        });
    });
});
</script>
@endpush