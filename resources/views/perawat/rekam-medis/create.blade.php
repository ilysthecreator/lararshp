@extends('perawat.layout')

@section('title', 'Tambah Rekam Medis')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white">
        <h5 class="mb-0">Form Rekam Medis Baru</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('perawat.rekam-medis.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pasien (Hewan)</label>
                    <select name="idpet" class="form-select" required>
                        <option value="">-- Pilih Pasien --</option>
                        @foreach($pasien as $p)
                            <option value="{{ $p->idpet }}">{{ $p->nama }} - {{ $p->pemilik->user->nama }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label class="form-label">Dokter Pemeriksa</label>
                    <select name="iddokter" class="form-select" required>
                        <option value="">-- Pilih Dokter --</option>
                        @foreach($dokters as $d)
                            {{-- Value adalah idrole_user dari tabel role_user --}}
                            <option value="{{ $d->idrole_user }}">{{ $d->user->nama ?? 'Dokter' }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Anamnesa (Keluhan)</label>
                <textarea name="anamnesa" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Diagnosa</label>
                <textarea name="diagnosa" class="form-control" rows="2" required></textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Temuan Klinis / Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="2"></textarea>
            </div>

            <hr>
            <h6 class="mb-3">Tindakan / Terapi</h6>
            
            <div class="row g-2 mb-2">
                <div class="col-md-6">
                    <select name="tindakan[0][id]" class="form-select" required>
                        <option value="">-- Pilih Tindakan --</option>
                        @foreach($tindakan as $t)
                            <option value="{{ $t->idkode_tindakan_terapi }}">{{ $t->deskripsi_tindakan_terapi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" name="tindakan[0][jumlah]" class="form-control" placeholder="Jml" value="1" min="1" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="tindakan[0][keterangan]" class="form-control" placeholder="Keterangan tambahan">
                </div>
            </div>

            <div class="text-end mt-4">
                <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-success">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
@endsection