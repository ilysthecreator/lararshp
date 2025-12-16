@extends('pemilik.layout')
@section('title', 'Detail Rekam Medis')
@section('content')
<a href="{{ route('pemilik.riwayat.index') }}" class="btn btn-secondary mb-3">&laquo; Kembali</a>
<div class="row">
    <div class="col-md-7">
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-header bg-white fw-bold">Hasil Pemeriksaan</div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><td width="30%">Tanggal</td><td>: {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d F Y') }}</td></tr>
                    <tr><td>Pasien</td><td>: <strong>{{ $rekamMedis->temuDokter->pet->nama }}</strong></td></tr>
                    <tr><td>Dokter</td><td>: {{ $rekamMedis->dokter->user->nama ?? '-' }}</td></tr>
                    <tr><td colspan="2"><hr></td></tr>
                    <tr><td>Anamnesa</td><td>: {{ $rekamMedis->anamnesa }}</td></tr>
                    <tr><td>Diagnosa</td><td>: {{ $rekamMedis->diagnosa }}</td></tr>
                    <tr><td>Temuan Klinis</td><td>: {{ $rekamMedis->temuan_klinis }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-bold">Tindakan / Terapi</div>
            <ul class="list-group list-group-flush">
                @foreach($rekamMedis->detailRekamMedis as $dt)
                <li class="list-group-item">
                    <span class="fw-bold d-block">{{ $dt->kodeTindakan->deskripsi_tindakan_terapi ?? 'Tindakan' }}</span>
                    <small class="text-muted">{{ $dt->detail }}</small>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection