@extends('resepsionis.layout')

@section('title', 'Edit Jadwal Temu')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-primary">Edit Jadwal Temu #{{ $temu->no_urut }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('resepsionis.temu-dokter.update', $temu->idreservasi_dokter) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    {{-- Info Readonly (Opsional: Bisa dihapus jika ingin bisa edit pasien) --}}
                    <div class="alert alert-light border mb-3">
                        <small class="text-muted d-block">Pasien saat ini:</small>
                        <strong>{{ $temu->pet->nama }}</strong> 
                        <span class="text-muted">({{ $temu->pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }})</span>
                        <br>
                        <small class="text-muted">Pemilik: {{ $temu->pet->pemilik->user->nama ?? '-' }}</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ganti Pasien (Opsional)</label>
                        <select name="idpet" class="form-select">
                            @foreach($pets as $p)
                                <option value="{{ $p->idpet }}" {{ $temu->idpet == $p->idpet ? 'selected' : '' }}>
                                    {{ $p->nama }} ({{ $p->pemilik->user->nama }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Dokter</label>
                        <select name="idrole_user" class="form-select" required>
                            <option value="">-- Pilih Dokter --</option>
                            @foreach($dokters as $d)
                                <option value="{{ $d->idrole_user }}" {{ $temu->idrole_user == $d->idrole_user ? 'selected' : '' }}>
                                    {{ $d->user->nama }} ({{ $d->dokter->spesialisasi ?? 'Umum' }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Temu</label>
                            <input type="date" name="tgl_temu" class="form-control" value="{{ old('tgl_temu', $tgl_temu) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jam Temu</label>
                            <input type="time" name="jam_temu" class="form-control" value="{{ old('jam_temu', $jam_temu) }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="1" {{ $temu->status == '1' ? 'selected' : '' }}>Menunggu / Aktif</option>
                            <option value="2" {{ $temu->status == '2' ? 'selected' : '' }}>Selesai</option>
                            <option value="0" {{ $temu->status == '0' ? 'selected' : '' }}>Batal</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('resepsionis.temu-dokter.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection