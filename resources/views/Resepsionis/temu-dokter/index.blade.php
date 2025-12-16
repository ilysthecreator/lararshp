@extends('resepsionis.layout')

@section('title', 'Jadwal Temu Dokter')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 fw-bold text-primary">Daftar Jadwal Temu Dokter</h6>
        <a href="{{ route('resepsionis.temu-dokter.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Buat Janji
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">Urut</th>
                        <th>Waktu</th>
                        <th>Pasien</th>
                        <th>Pemilik</th>
                        <th>Dokter</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($temuDokter as $item)
                    <tr>
                        <td class="text-center fw-bold">#{{ $item->no_urut }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->waktu_daftar)->isoFormat('D MMM Y, HH:mm') }}</td>
                        <td class="fw-bold">{{ $item->pet->nama ?? '-' }}</td>
                        <td>{{ $item->pet->pemilik->user->nama ?? '-' }}</td>
                        <td>{{ $item->dokterRoleUser->user->nama ?? '-' }}</td>
                        <td>
                            @if($item->status == '1') <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($item->status == '2') <span class="badge bg-success">Selesai</span>
                            @else <span class="badge bg-secondary">Batal</span> @endif
                        </td>
                        <td class="text-center">
                            @if($item->status == '1')
                            <form action="{{ route('resepsionis.temu-dokter.update', $item->idreservasi_dokter) }}" method="POST" class="d-inline" title="Tandai Selesai">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="2">
                                <button class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                            </form>
                            @endif
                            
                            <a href="{{ route('resepsionis.temu-dokter.edit', $item->idreservasi_dokter) }}" class="btn btn-warning btn-sm text-white">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('resepsionis.temu-dokter.destroy', $item->idreservasi_dokter) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus jadwal ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted">Belum ada jadwal.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $temuDokter->links() }}
        </div>
    </div>
</div>
@endsection