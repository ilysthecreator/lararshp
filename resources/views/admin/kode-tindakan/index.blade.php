@extends('admin.layout')

@section('title', 'Daftar Kode Tindakan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Kode Tindakan Terapi</h1>
        <a href="{{ route('admin.kode-tindakan.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
            <span class="text">Tambah Kode Tindakan</span>
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
            <h6 class="m-0 font-weight-bold text-primary">Data Kode Tindakan Terapi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th width="3%">No</th>
                            <th width="8%">Kode</th>
                            <th width="20%">Kategori</th>
                            <th width="20%">Kategori Klinis</th>
                            <th>Deskripsi Tindakan</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kodeTindakan as $index => $item) {{-- Corrected variable name --}}
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td><span class="badge badge-info">{{ $item->kode }}</span></td>
                            <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                            <td>{{ $item->kategoriKlinis->nama_kategori_klinis ?? '-' }}</td>
                            <td>{{ $item->deskripsi_tindakan_terapi }}</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm btn-edit" data-id="{{ $item->idkode_tindakan_terapi }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.kode-tindakan.destroy', $item->idkode_tindakan_terapi) }}" method="POST" class="d-inline form-delete">
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
                            <td colspan="7" class="text-center text-muted">
                                <i class="fas fa-info-circle"></i> Tidak ada data kode tindakan
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
                <h5 class="modal-title" id="editModalLabel">Edit Kode Tindakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_kode">Kode Tindakan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_kode" name="kode" required>
                    </div>
                    {{-- Kategori dan Kategori Klinis tidak bisa diubah untuk menjaga integritas --}}
                    <input type="hidden" id="edit_idkategori" name="idkategori">
                    <input type="hidden" id="edit_idkategori_klinis" name="idkategori_klinis">

                    <div class="form-group">
                        <label for="edit_deskripsi_tindakan_terapi">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="edit_deskripsi_tindakan_terapi" name="deskripsi_tindakan_terapi" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        "language": {"url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"},
        "pageLength": 10,
        "ordering": true,
        "searching": true
    });

    $('.btn-edit').on('click', function() {
        var id = $(this).data('id');
        var url = `{{ url('admin/kode-tindakan') }}/${id}/edit`;
        var updateUrl = `{{ url('admin/kode-tindakan') }}/${id}`;

        $('#editForm').attr('action', updateUrl);

        $.get(url, function(data) {
            $('#edit_kode').val(data.kode);
            $('#edit_deskripsi_tindakan_terapi').val(data.deskripsi_tindakan_terapi);
            // Populate hidden fields for validation
            $('#edit_idkategori').val(data.idkategori);
            $('#edit_idkategori_klinis').val(data.idkategori_klinis);

            $('#editModal').modal('show');
        }).fail(function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Gagal mengambil data!'
            });
        });
    });

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
@endsection