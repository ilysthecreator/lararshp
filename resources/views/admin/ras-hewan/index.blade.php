@extends('admin.layout')

@section('title', 'Manajemen Ras Hewan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Ras Hewan</h1>
        <a href="{{ route('admin.ras-hewan.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
            <span class="text">Tambah Ras Hewan</span>
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Ras Hewan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Ras</th>
                            <th>Jenis Hewan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rasHewan as $index => $ras)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td><strong>{{ $ras->nama_ras }}</strong></td>
                            <td>{{ $ras->jenisHewan->nama_jenis_hewan ?? 'N/A' }}</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm btn-edit" data-id="{{ $ras->idras_hewan }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.ras-hewan.destroy', $ras->idras_hewan) }}" method="POST" class="d-inline form-delete">
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
                            <td colspan="4" class="text-center text-muted">Tidak ada data ras hewan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Ras Hewan -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Ras Hewan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_idjenis_hewan">Jenis Hewan <span class="text-danger">*</span></label>
                        <select class="form-control" id="edit_idjenis_hewan" name="idjenis_hewan" required>
                            {{-- Options will be populated by JavaScript --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_nama_ras">Nama Ras <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_nama_ras" name="nama_ras" required>
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
        $('#dataTable').DataTable({
            "language": { "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json" }
        });

        // Pre-fetch jenis hewan data for the modal
        let jenisHewanData = [];
        $.get('{{ route('admin.jenis-hewan.index') }}', function(data) {
            jenisHewanData = data.jenisHewan;
        });

        $('.btn-edit').on('click', function() {
            var id = $(this).data('id');
            var url = `{{ url('admin/ras-hewan') }}/${id}/edit`;
            var updateUrl = `{{ url('admin/ras-hewan') }}/${id}`;

            $('#editForm').attr('action', updateUrl);

            $.get(url, function(data) {
                $('#edit_nama_ras').val(data.nama_ras);

                // Populate and set the selected jenis hewan
                var jenisHewanSelect = $('#edit_idjenis_hewan');
                jenisHewanSelect.empty();
                jenisHewanData.forEach(function(jenis) {
                    jenisHewanSelect.append(new Option(jenis.nama_jenis_hewan, jenis.idjenis_hewan));
                });
                jenisHewanSelect.val(data.idjenis_hewan);

                $('#editModal').modal('show');
            });
        });

        $('.form-delete').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            const rasName = $(this).closest('tr').find('td:nth-child(2)').text().trim();

            Swal.fire({
                title: 'Anda yakin?',
                html: `Anda akan menghapus ras: <strong>${rasName}</strong>. <br> Tindakan ini tidak dapat dibatalkan!`,
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