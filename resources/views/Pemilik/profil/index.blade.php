@extends('pemilik.layout')
@section('title', 'Profil & Hewan Peliharaan')
@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 text-center">
            <div class="card-body p-4">
                <div class="bg-light rounded-circle mx-auto d-flex align-items-center justify-content-center mb-3" style="width: 100px; height: 100px; font-size: 2rem;">
                    {{ strtoupper(substr($user->nama, 0, 1)) }}
                </div>
                <h5 class="fw-bold">{{ $user->nama }}</h5>
                <p class="text-muted mb-1">{{ $user->email }}</p>
                <hr>
                <div class="text-start">
                    <p class="mb-1"><i class="fas fa-phone me-2 text-secondary"></i> {{ $pemilik->no_wa ?? '-' }}</p>
                    <p class="mb-1"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> {{ $pemilik->alamat ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-primary"><i class="fas fa-paw me-2"></i>Hewan Peliharaan Saya</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @forelse($pets as $pet)
                    <div class="col-md-6">
                        <div class="border rounded p-3 d-flex align-items-center gap-3">
                            <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fas fa-dog fs-4"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">{{ $pet->nama }}</h6>
                                <small class="text-muted d-block">{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '' }} - {{ $pet->rasHewan->nama_ras ?? '' }}</small>
                                <small class="text-muted">
                                    {{ $pet->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }} | {{ \Carbon\Carbon::parse($pet->tanggal_lahir)->age }} Tahun
                                </small>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-4 text-muted">
                        Belum ada hewan yang terdaftar. Hubungi resepsionis untuk mendaftarkan hewan Anda.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection