@extends('resepsionis.layout')

@section('title', 'Daftar Pasien Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-primary">Form Pendaftaran Hewan</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('resepsionis.pet.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Pemilik Hewan</label>
                        <select name="idpemilik" class="form-select select2" required>
                            <option value="">-- Pilih Pemilik --</option>
                            @foreach($pemiliks as $p)
                                <option value="{{ $p->idpemilik }}">{{ $p->user->nama }} - {{ $p->no_wa }}</option>
                            @endforeach
                        </select>
                        <div class="form-text">Pastikan pemilik sudah terdaftar sebelumnya.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Hewan</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Jenis & Ras</label>
                            <select name="idras_hewan" class="form-select" required>
                                <option value="">-- Pilih Ras --</option>
                                @foreach($ras as $r)
                                    <option value="{{ $r->idras_hewan }}">
                                        {{ $r->jenisHewan->nama_jenis_hewan ?? 'Lainnya' }} - {{ $r->nama_ras }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                <option value="J">Jantan</option>
                                <option value="B">Betina</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Warna / Tanda Khusus</label>
                            <input type="text" name="warna_tanda" class="form-control" value="{{ old('warna_tanda') }}" placeholder="Contoh: Putih Belang Hitam" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir (Estimasi)</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}">
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('resepsionis.pet.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Daftarkan Hewan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection