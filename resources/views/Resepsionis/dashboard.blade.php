@extends('resepsionis.layout')

@section('title', 'Dashboard Resepsionis')

@section('content')
<div class="row g-4">
    <!-- Card Janji Temu -->
    <div class="col-lg-3 col-md-6">
        <div class="card text-white bg-info shadow-sm h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="inner">
                        <h3 class="fw-bold">{{ $totalJanjiTemu ?? 0 }}</h3>
                        <p class="mb-0">Total Janji Temu</p>
                    </div>
                    <div class="icon fs-1 opacity-50">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
                <a href="{{ route('resepsionis.temu-dokter.index') }}" class="text-white stretched-link mt-auto">Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i></a>
            </div>
        </div>
    </div>

    <!-- Card Total Pasien -->
    <div class="col-lg-3 col-md-6">
        <div class="card text-white bg-success shadow-sm h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="inner">
                        <h3 class="fw-bold">{{ $totalPet ?? 0 }}</h3>
                        <p class="mb-0">Total Pasien (Hewan)</p>
                    </div>
                    <div class="icon fs-1 opacity-50">
                        <i class="fas fa-paw"></i>
                    </div>
                </div>
                <a href="{{ route('resepsionis.pet.index') }}" class="text-white stretched-link mt-auto">Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i></a>
            </div>
        </div>
    </div>

    <!-- Card Total Pemilik -->
    <div class="col-lg-3 col-md-6">
        <div class="card text-white bg-warning shadow-sm h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="inner">
                        <h3 class="fw-bold">{{ $totalPemilik ?? 0 }}</h3>
                        <p class="mb-0">Total Pemilik</p>
                    </div>
                    <div class="icon fs-1 opacity-50">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <a href="{{ route('resepsionis.pemilik.index') }}" class="text-white stretched-link mt-auto">Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i></a>
            </div>
        </div>
    </div>

    <!-- Card Dokter Tersedia -->
    <div class="col-lg-3 col-md-6">
        <div class="card text-white bg-danger shadow-sm h-100">
            <div class="card-body d-flex flex-column">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="inner">
                        <h3 class="fw-bold">{{ $totalDokter ?? 0 }}</h3>
                        <p class="mb-0">Dokter Tersedia</p>
                    </div>
                    <div class="icon fs-1 opacity-50">
                        <i class="fas fa-user-md"></i>
                    </div>
                </div>
                <a href="#" class="text-white stretched-link mt-auto">Lihat Detail <i class="fas fa-arrow-circle-right ms-1"></i></a>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Janji Temu Terbaru -->
<div class="card shadow-sm border-0 mt-4">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 fw-bold text-primary">
            <i class="fas fa-list me-2"></i>Jadwal Temu Dokter Terbaru
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
                        <th>Waktu Daftar</th>
                        <th>Pasien</th>
                        <th>Pemilik</th>
                        <th>Dokter</th>
                        <th>Status</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($janjiTemuTerbaru as $item)
                    <tr>
                        <td class="text-center fw-bold">#{{ $item->no_urut }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->waktu_daftar)->isoFormat('D MMM Y, HH:mm') }}</td>
                        <td class="fw-bold">{{ $item->pet->nama ?? '-' }}</td>
                        <td>{{ $item->pet->pemilik->user->nama ?? '-' }}</td>
                        <td>{{ $item->dokterRoleUser->user->nama ?? '-' }}</td>
                        <td>
                            @if($item->status == '1')
                                <span class="badge text-bg-warning">Menunggu</span>
                            @elseif($item->status == '2')
                                <span class="badge text-bg-success">Selesai</span>
                            @else
                                <span class="badge text-bg-secondary">{{ $item->status }}</span>
                            @endif
                        </td>
                        <td class="text-end pe-3">
                            @if($item->status == '1')
                                <form action="{{ route('resepsionis.temu-dokter.update', $item->idreservasi_dokter) }}" method="POST" class="d-inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="2">
                                    <button class="btn btn-success btn-sm" onclick="return confirm('Tandai Selesai?')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">Belum ada jadwal terbaru.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white text-end">
        <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua Jadwal</a>
    </div>
</div>
@endsection