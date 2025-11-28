@extends('admin.layout')

@section('title', 'Daftar Pet')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Pet</h1>
        <a href="{{ route('admin.pet.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
            <span class="text">Tambah Pet</span>
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
            <h6 class="m-0 font-weight-bold text-primary">Data Pet</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>ID</th>
                            <th>Nama Pet</th>
                            <th>Pemilik</th>
                            <th>Jenis Hewan</th>
                            <th>Ras</th>
                            <th>Jenis Kelamin</th>
                            <th>Tgl Lahir</th>
                            <th>Warna</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pets as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $item->idpet }}</td>
                            <td><strong>{{ $item->nama_pet }}</strong></td>
                            <td>{{ $item->pemilik->user->nama ?? '-' }}</td>
                            <td>{{ $item->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
                            <td>{{ $item->rasHewan->nama_ras ?? '-' }}</td>
                            <td>{{ $item->jenis_kelamin == 'L' ? 'Jantan' : 'Betina' }}</td>
                            <td>{{ $item->tgl_lahir ? \Carbon\Carbon::parse($item->tgl_lahir)->format('d M Y') : '-' }}</td>
                            <td>{{ $item->warna_bulu ?? '-' }}</td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm btn-edit" data-id="{{ $item->idpet }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.pet.destroy', $item->idpet) }}" method="POST" class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus" data-pet-name="{{ $item->nama_pet }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted">
                                <i class="fas fa-info-circle"></i> Tidak ada data pet
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Pet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    {{-- Pemilik dan Ras tidak bisa diubah untuk menjaga integritas data --}}
                    <input type="hidden" id="edit_idpemilik" name="idpemilik">
                    <input type="hidden" id="edit_idras_hewan" name="idras_hewan">

                    <div class="form-group">
                        <label for="edit_nama_pet">Nama Pet <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_nama_pet" name="nama_pet" required>
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin <span class="text-danger">*</span></label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="edit_jantan" value="L" required>
                                <label class="form-check-label" for="edit_jantan">Jantan</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" id="edit_betina" value="P">
                                <label class="form-check-label" for="edit_betina">Betina</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="edit_tgl_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="edit_tgl_lahir" name="tgl_lahir">
                    </div>

                    <div class="form-group">
                        <label for="edit_warna_bulu">Warna / Tanda</label>
                        <input type="text" class="form-control" id="edit_warna_bulu" name="warna_bulu">
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
        "language": { "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json" },
        "pageLength": 10,
        "ordering": true,
        "searching": true
    });

    $('.btn-edit').on('click', function() {
        var id = $(this).data('id');
        var url = `{{ url('admin/pet') }}/${id}/edit`;
        var updateUrl = `{{ url('admin/pet') }}/${id}`;

        $('#editForm').attr('action', updateUrl);

        $.get(url, function(data) {
            $('#edit_nama_pet').val(data.nama_pet);
            $('#edit_tgl_lahir').val(data.tgl_lahir);
            $('#edit_warna_bulu').val(data.warna_bulu);

            if (data.jenis_kelamin == 'L') {
                $('#edit_jantan').prop('checked', true);
            } else {
                $('#edit_betina').prop('checked', true);
            }

            // Populate hidden fields for validation
            $('#edit_idpemilik').val(data.idpemilik);
            $('#edit_idras_hewan').val(data.idras_hewan);

            $('#editModal').modal('show');
        });
    });

    $('.form-delete').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        var petName = $(this).find('button[type="submit"]').data('pet-name');

        Swal.fire({
            title: 'Anda yakin?',
            text: `Data pet dengan nama "${petName}" akan dihapus dan tidak dapat dikembalikan!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) { form.submit(); }
        });
    });
});
</script>
@endpush