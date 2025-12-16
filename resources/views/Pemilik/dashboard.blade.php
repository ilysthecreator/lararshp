@extends('pemilik.layout')
@section('title', 'Dashboard')
@section('content')
<div class="row mb-4">
    <div class="col-md-6 mb-3">
        <div class="card bg-primary text-white h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="fw-bold">{{ $totalPet }}</h3>
                    <span>Hewan Peliharaan</span>
                </div>
                <i class="fas fa-paw fa-3x opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card bg-success text-white h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="fw-bold">{{ $totalJadwal }}</h3>
                    <span>Jadwal Aktif (Menunggu)</span>
                </div>
                <i class="fas fa-calendar-check fa-3x opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h6 class="m-0 fw-bold text-dark">Aktivitas Terakhir (Jadwal & Temu Dokter)</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Hewan</th>
                        <th>Dokter</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayatTerakhir as $r)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($r->waktu_daftar)->format('d M Y, H:i') }}</td>
                        <td>{{ $r->pet->nama }}</td>
                        <td>{{ $r->dokterRoleUser->user->nama ?? '-' }}</td>
                        <td>
                            @if($r->status == '1') <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($r->status == '2') <span class="badge bg-success">Selesai</span>
                            @else <span class="badge bg-secondary">Batal</span> @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted">Belum ada aktivitas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection