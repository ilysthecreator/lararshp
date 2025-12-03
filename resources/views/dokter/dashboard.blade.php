@extends('dokter.layout')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Dokter</h1>
    </div>
    
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="#" class="card-link">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Jadwal Praktik</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Lihat Jadwal</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('dokter.pasien.index') }}" class="card-link">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Daftar Pasien</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Kelola Pasien</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('dokter.rekam-medis.index') }}" class="card-link">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Rekam Medis</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Akses Rekam Medis</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-medical-alt fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Rekam Medis Terbaru</h6>
                    <a href="{{ route('dokter.rekam-medis.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        Lihat Semua <i class="fas fa-arrow-right fa-sm text-white-50"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama Pasien</th>
                                    <th>Pemilik</th>
                                    <th>Diagnosa</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentRekamMedis as $rm)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($rm->tgl_periksa)->format('d M Y') }}</td>
                                        <td>
                                            <span class="font-weight-bold">{{ $rm->pet->nama_pet ?? '-' }}</span>
                                            <br>
                                            <small class="text-muted">{{ $rm->pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '' }}</small>
                                        </td>
                                        <td>{{ $rm->pet->pemilik->user->nama ?? '-' }}</td>
                                        <td>{{ Str::limit($rm->diagnosa, 50) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('dokter.rekam-medis.show', $rm->idrekam_medis) }}" class="btn btn-sm btn-info" title="Lihat Detail">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-3">Belum ada data rekam medis terbaru.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('styles')
<style>
    .card-link {
        text-decoration: none;
        color: inherit;
    }
    .card-link .card:hover {
        transform: translateY(-5px);
        transition: transform 0.2s ease-in-out;
    }
</style>
@endpush