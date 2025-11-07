@extends('admin.layout')

@section('title', 'Daftar Kategori')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Kategori</h1>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
            <span class="text">Tambah Kategori</span>
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
            <h6 class="m-0 font-weight-bold text-primary">Data Kategori</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">ID</th>
                            <th width="55%">Nama Kategori</th>
                            <th width="15%">Tanggal Dibuat</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategori as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $item->idkategori }}</td>
                            <td><strong>{{ $item->nama_kategori }}</strong></td>
                            <td>{{ $item->created_at ? $item->created_at->format('d M Y H:i') : '-' }}</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm btn-edit" 
                                        data-id="{{ $item->idkategori }}" 
                                        title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.kategori.destroy', $item->idkategori) }}" 
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
                            <td colspan="5" class="text-center text-muted">Tidak ada data kategori</td>
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
                <h5 class="modal-title" id="editModalLabel">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_nama_kategori">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_nama_kategori" name="nama_kategori" required>
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
        var url = "{{ url('admin/kategori') }}/" + id + "/edit";
        var updateUrl = "{{ url('admin/kategori') }}/" + id;

        // Set action form
        $('#editForm').attr('action', updateUrl);

        // Ambil data via AJAX
        $.get(url, function(data) {
            // Isi form di modal
            $('#edit_nama_kategori').val(data.nama_kategori);

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
        var form = this;
        Swal.fire({
            title: 'Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endpush