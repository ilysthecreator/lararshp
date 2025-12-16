@extends('perawat.layout')

@section('content')
<div class="container">
    <div class="mb-3">
        <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-secondary">&laquo; Kembali</a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">Detail Pemeriksaan</div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr><th style="width: 30%">Tanggal</th><td>: {{ \Carbon\Carbon::parse($rekamMedis->tgl_periksa)->format('d F Y') }}</td></tr>
                        <tr><th>Pasien</th><td>: {{ $rekamMedis->pet->nama_hewan }}</td></tr>
                        <tr><th>Pemilik</th><td>: {{ $rekamMedis->pet->pemilik->user->name }}</td></tr>
                        <tr><th>Dokter</th><td>: {{ $rekamMedis->dokter->user->name }}</td></tr>
                        <tr><td colspan="2"><hr></td></tr>
                        <tr><th>Anamnesa</th><td>: {{ $rekamMedis->anamnesa }}</td></tr>
                        <tr><th>Diagnosa</th><td>: {{ $rekamMedis->diagnosa }}</td></tr>
                        <tr><th>Keterangan</th><td>: {{ $rekamMedis->keterangan ?? '-' }}</td></tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">Tindakan Diberikan</div>
                <ul class="list-group list-group-flush">
                    @foreach($rekamMedis->detailRekamMedis as $dt)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $dt->kodeTindakan->deskripsi_tindakan_terapi }}</strong>
                            <br><small class="text-muted">{{ $dt->keterangan }}</small>
                        </div>
                        <span class="badge badge-primary badge-pill">{{ $dt->jumlah }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection