@extends('admin.layout')

@section('title', 'Daftar Kode Tindakan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Kode Tindakan Terapi</h1>
        </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Kode Tindakan Terapi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable">
                    <thead class="thead-light">
                        <tr>
                            <th width="3%">No</th>
                            <th width="8%">Kode</th>
                            <th width="15%">Kategori</th>
                            <th width="15%">Kategori Klinis</th>
                            <th width="35%">Deskripsi Tindakan</th>
                            <th width="12%">Tanggal</th>
                            </tr>
                    </thead>
                    <tbody>
                        @forelse($kodeTindakan as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td><span class="badge badge-info">{{ $item->kode }}</span></td>
                            <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                            <td>{{ $item->kategoriKlinis->nama_kategori_klinis ?? '-' }}</td>
                            <td>{{ $item->deskripsi_tindakan_terapi }}</td>
                            <td class="text-center">{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</td>
                            </tr>
                        @empty
                        <tr><td colspan="6" class="text-center text-muted">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Hanya sisakan fungsionalitas DataTable
    $('#dataTable').DataTable({
        "language": {"url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"},
        "scrollX": true
    });

    // Semua script untuk '.btn-edit' dan '.btn-delete' dihapus
});
</script>
@endpush
@endsection