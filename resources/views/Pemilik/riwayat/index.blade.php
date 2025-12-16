@extends('pemilik.layout')
@section('title', 'Riwayat Kesehatan')
@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Tanggal Periksa</th>
                        <th>Hewan</th>
                        <th>Dokter</th>
                        <th>Diagnosa</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekamMedis as $rm)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($rm->created_at)->format('d M Y') }}</td>
                        <td class="fw-bold">{{ $rm->temuDokter->pet->nama ?? '-' }}</td>
                        <td>{{ $rm->dokter->user->nama ?? '-' }}</td>
                        <td>{{ Str::limit($rm->diagnosa, 50) }}</td>
                        <td class="text-center">
                            <a href="{{ route('pemilik.riwayat.show', $rm->idrekam_medis) }}" class="btn btn-sm btn-info text-white">
                                <i class="fas fa-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-4">Belum ada riwayat rekam medis.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $rekamMedis->links() }}
    </div>
</div>
@endsection