@extends('resepsionis.layout')

@section('title', 'Manajemen Janji Temu')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 fw-bold text-primary">
            <i class="fas fa-calendar-check me-2"></i>Data Janji Temu
        </h6>
        <a href="{{ route('resepsionis.temu-dokter.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Buat Janji Baru
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">No Urut</th>
                        <th>Waktu Reservasi</th>
                        <th>Pasien</th>
                        <th>Pemilik</th>
                        <th>Dokter</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($temuDokter as $item)
                    <tr>
                        <td class="text-center fw-bold">#{{ $item->no_urut }}</td>
                        <td>
                            {{ \Carbon\Carbon::parse($item->waktu_daftar)->isoFormat('D MMM Y, HH:mm') }}
                        </td>
                        <td class="fw-bold">{{ $item->pet->nama ?? '-' }}</td>
                        <td>{{ $item->pet->pemilik->user->nama ?? '-' }}</td>
                        <td>{{ $item->dokterRoleUser->user->nama ?? '-' }}</td>
                        <td>
                            @if($item->status == '1')
                                <span class="badge text-bg-warning">Menunggu</span>
                            @elseif($item->status == '2')
                                <span class="badge text-bg-success">Selesai</span>
                            @else
                                <span class="badge text-bg-secondary">Status: {{ $item->status }}</span>
                            @endif
                        </td>
                        <td class="text-end pe-3">
                            @if($item->status == '1')
                                <form action="{{ route('resepsionis.temu-dokter.update', $item->idreservasi_dokter) }}" method="POST" class="d-inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="2">
                                    <button class="btn btn-sm btn-success" onclick="return confirm('Tandai janji temu ini sebagai Selesai?')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('resepsionis.temu-dokter.destroy', $item->idreservasi_dokter) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus janji temu ini?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center py-5 text-muted">Tidak ada data janji temu.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white py-3">
        {{ $temuDokter->links() }}
    </div>
</div>
@endsection