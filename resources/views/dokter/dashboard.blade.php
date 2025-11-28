@extends('dokter.layout')

@section('title', 'Dashboard Dokter')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard Dokter</h1>
    </div>
    <!-- Content Row -->
    <div class="row">

        <!-- Jadwal Praktik Card -->
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

        <!-- Daftar Pasien Card -->
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

        <!-- Rekam Medis Card -->
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