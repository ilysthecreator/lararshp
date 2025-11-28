@extends('dokter.layout')

@section('title', 'Detail Rekam Medis')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Rekam Medis</h1>
        <a href="{{ route('dokter.rekam-medis.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row">
        <!-- Kolom Kiri: Informasi Pasien & Pemeriksaan -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pemeriksaan</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 35%;">Tanggal Periksa</th>
                            <td>: {{ \Carbon\Carbon::parse($rekamMedis->tgl_periksa)->isoFormat('dddd, D MMMM Y') }}</td>
                        </tr>
                        <tr>
                            <th>Dokter Pemeriksa</th>
                            <td>: {{ $rekamMedis->dokter->user->nama ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="pt-4">
                                <strong>Anamnesa:</strong>
                                <p class="text-justify">{{ $rekamMedis->anamnesa ?? '-' }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <strong>Diagnosa:</strong>
                                <p class="font-weight-bold">{{ $rekamMedis->diagnosa ?? '-' }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <strong>Keterangan Tambahan:</strong>
                                <p class="text-justify">{{ $rekamMedis->keterangan ?? '-' }}</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pasien</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 35%;">ID Pasien</th>
                            <td>: {{ $rekamMedis->pet->idpet }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pasien</th>
                            <td>: {{ $rekamMedis->pet->nama_pet }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Hewan</th>
                            <td>: {{ $rekamMedis->pet->rasHewan->jenisHewan->nama_jenis_hewan ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Ras</th>
                            <td>: {{ $rekamMedis->pet->rasHewan->nama_ras ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>: {{ $rekamMedis->pet->jenis_kelamin }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pemilik</th>
                            <td>: {{ $rekamMedis->pet->pemilik->user->nama ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Detail Tindakan/Terapi -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Tindakan & Terapi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Tindakan/Terapi</th>
                                    <th>Jumlah</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rekamMedis->detailRekamMedis as $detail)
                                    <tr>
                                        <td>{{ $detail->kodeTindakan->deskripsi_tindakan_terapi ?? 'N/A' }}</td>
                                        <td>{{ $detail->jumlah }}</td>
                                        <td>{{ $detail->keterangan ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Tidak ada tindakan/terapi yang diberikan.</td>
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