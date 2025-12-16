@extends('resepsionis.layout')

@section('title', 'Dashboard Resepsionis')

@section('content')
<div class="container-fluid p-0">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Resepsionis</h1>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('resepsionis.temu-dokter.index') }}" class="text-decoration-none card-hover">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Janji Temu</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalJanjiTemu ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('resepsionis.pet.index') }}" class="text-decoration-none card-hover">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Pasien (Hewan)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPet ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-paw fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('resepsionis.pemilik.index') }}" class="text-decoration-none card-hover">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Pemilik</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPemilik ?? 0 }}</div>
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
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Dokter Tersedia</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDokter ?? 0 }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-md fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Jadwal Temu Dokter Terbaru</h6>
                    <a href="{{ route('resepsionis.temu-dokter.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Buat Janji Baru
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center">No Urut</th>
                                    <th>Waktu</th>
                                    <th>Pasien</th>
                                    <th>Dokter</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($janjiTemuTerbaru as $item)
                                <tr>
                                    <td class="text-center font-weight-bold">#{{ $item->no_urut }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->waktu_daftar)->isoFormat('D MMM Y, HH:mm') }}</td>
                                    <td>
                                        <span class="font-weight-bold text-dark">{{ $item->pet->nama ?? '-' }}</span><br>
                                        <small class="text-muted">Pemilik: {{ $item->pet->pemilik->user->nama ?? '-' }}</small>
                                    </td>
                                    <td>{{ $item->dokterRoleUser->user->nama ?? '-' }}</td>
                                    <td>
                                        @if($item->status == '1')
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        @elseif($item->status == '2')
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-secondary">{{ $item->status }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($item->status == '1')
                                            <form action="{{ route('resepsionis.temu-dokter.update', $item->idreservasi_dokter) }}" method="POST" class="d-inline">
                                                @csrf @method('PUT')
                                                <input type="hidden" name="status" value="2">
                                                <button class="btn btn-sm btn-success shadow-sm" onclick="return confirm('Tandai Selesai?')" title="Selesai">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-3 text-muted">Belum ada jadwal terbaru hari ini.</td>
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
    /* Utility Classes to mimic SB Admin 2 / Dokter Dashboard Look */
    .text-xs { font-size: .7rem; }
    .text-gray-300 { color: #dddfeb !important; }
    .text-gray-800 { color: #5a5c69 !important; }
    .font-weight-bold { font-weight: 700 !important; }
    .text-uppercase { text-transform: uppercase !important; }
    .shadow { box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15)!important; }
    
    /* Border Left Colors */
    .border-left-primary { border-left: .25rem solid #4e73df!important; }
    .border-left-success { border-left: .25rem solid #1cc88a!important; }
    .border-left-info { border-left: .25rem solid #36b9cc!important; }
    .border-left-warning { border-left: .25rem solid #f6c23e!important; }
    .border-left-danger { border-left: .25rem solid #e74a3b!important; }

    /* Text Colors matching borders */
    .text-primary { color: #4e73df!important; }
    .text-success { color: #1cc88a!important; }
    .text-info { color: #36b9cc!important; }
    .text-warning { color: #f6c23e!important; }
    
    .no-gutters {
        margin-right: 0;
        margin-left: 0;
    }
    .no-gutters > .col, .no-gutters > [class*="col-"] {
        padding-right: 0;
        padding-left: 0;
    }
    
    .card-hover:hover .card {
        transform: translateY(-3px);
        transition: transform 0.2s;
    }
</style>
@endpush