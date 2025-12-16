@extends('perawat.layout')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Kelola Rekam Medis</h5>
            <div>
                <a href="{{ route('perawat.dashboard') }}" class="btn btn-sm btn-secondary mr-2">Dashboard</a>
                <a href="{{ route('perawat.rekam-medis.create') }}" class="btn btn-sm btn-primary">+ Tambah Baru</a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Pasien</th>
                            <th>Dokter Pemeriksa</th>
                            <th>Diagnosa</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekamMedis as $rm)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($rm->tgl_periksa)->format('d/m/Y') }}</td>
                            <td>
                                <div>{{ $rm->pet->nama_hewan ?? '-' }}</div>
                                <small class="text-muted">Pemilik: {{ $rm->pet->pemilik->user->name ?? '-' }}</small>
                            </td>
                            <td>{{ $rm->dokter->user->name ?? '-' }}</td>
                            <td>{{ Str::limit($rm->diagnosa, 40) }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('perawat.rekam-medis.show', $rm->idrekam_medis) }}" class="btn btn-sm btn-info text-white">Detail</a>
                                    <a href="{{ route('perawat.rekam-medis.edit', $rm->idrekam_medis) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('perawat.rekam-medis.destroy', $rm->idrekam_medis) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data rekam medis.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $rekamMedis->links() }}
            </div>
        </div>
    </div>
</div>
@endsection