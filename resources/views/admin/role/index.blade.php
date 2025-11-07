@extends('admin.layout')

@section('title', 'Daftar Role')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Role</h1>
        {{-- <a href="#" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
            <span class="text">Tambah Role</span>
        </a> --}}
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
            <h6 class="m-0 font-weight-bold text-primary">Data Role</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">ID</th>
                            <th>Nama Role</th>
                            <th>Deskripsi</th>
                            <th>Dibuat Pada</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $item->idrole }}</td>
                            <td><strong class="text-uppercase">{{ $item->nama_role }}</strong></td>
                            <td>{{ $item->deskripsi ?? '-' }}</td>
                            <td>{{ $item->created_at ? $item->created_at->format('d M Y H:i') : '-' }}</td>
                            <td class="text-center">-</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                <i class="fas fa-info-circle"></i> Tidak ada data role
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

@push('scripts')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        },
        "pageLength": 10,
        "ordering": true,
        "searching": true
    });
});
</script>
@endpush