@extends('layouts.app')

@section('title', 'Dashboard Resepsionis')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-info shadow-sm" role="alert">
                <h4 class="alert-heading">
                    <i class="fas fa-tachometer-alt mr-2"></i>Selamat Datang, {{ session('user_name', 'Resepsionis') }}!
                </h4>
                <p>Anda login sebagai <strong>{{ session('user_role_name', 'Resepsionis') }}</strong>. Di sini Anda dapat mengelola pendaftaran pasien, janji temu dokter, dan data pemilik hewan.</p>
            </div>
        </div>
    </div>

    <!-- Statistik Cepat -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalJanjiTemu }}</h3>
                    <p>Total Janji Temu</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <a href="{{ route('resepsionis.temu-dokter.index') }}" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalPemilik }}</h3>
                    <p>Total Pemilik Hewan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.pemilik.index') }}" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalPet }}</h3>
                    <p>Total Hewan Peliharaan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-paw"></i>
                </div>
                <a href="{{ route('admin.pet.index') }}" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalDokter }}</h3>
                    <p>Total Dokter</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-md"></i>
                </div>
                <a href="#" class="small-box-footer">Info lebih lanjut <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <!-- Daftar Janji Temu Terbaru -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title"><i class="fas fa-calendar-alt mr-2"></i>10 Janji Temu Dokter Terbaru</h3>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th>Tanggal & Waktu</th>
                                    <th>Nama Hewan</th>
                                    <th>Pemilik</th>
                                    <th>Dokter</th>
                                    <th>Keluhan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($janjiTemuTerbaru as $temu)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($temu->tgl_temu)->isoFormat('D MMMM YYYY') }}, {{ $temu->jam_temu }}</td>
                                        <td>{{ $temu->pet->nama_pet ?? 'N/A' }}</td>
                                        <td>{{ $temu->pet->pemilik->user->nama ?? 'N/A' }}</td>
                                        <td>{{ $temu->dokter->user->nama ?? 'N/A' }}</td>
                                        <td>{{ Str::limit($temu->keluhan, 50) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data janji temu.</td>
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