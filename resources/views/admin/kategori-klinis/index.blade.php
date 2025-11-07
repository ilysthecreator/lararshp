@extends('admin.layout')

@section('title', 'Daftar Kategori Klinis')

@push('styles')
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Kategori Klinis</h1>
        </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kategori Klinis</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">ID</th>
                            <th width="45%">Nama Kategori Klinis</th>
                            <th width="35%">Tanggal Dibuat</th>
                            </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoriKlinis as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td class="text-center">{{ $item->idkategori_klinis }}</td>
                            <td><strong>{{ $item->nama_kategori_klinis }}</strong></td>
                            <td class="text-center">{{ $item->created_at ? $item->created_at->format('d M Y H:i') : '-' }}</td>
                            </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">Tidak ada data kategori klinis</td>
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
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    // Hanya sisakan fungsionalitas DataTable
    $('#dataTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        }
    });

    // Semua script untuk '.btn-edit' dan '.btn-delete' dihapus
});
</script>
@endpush