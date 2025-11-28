@extends('admin.layout')

@section('title', 'Tambah Ras Hewan')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Ras Hewan Baru</h1>
        <a href="{{ route('admin.ras-hewan.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Ras Hewan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.ras-hewan.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="idjenis_hewan">Jenis Hewan <span class="text-danger">*</span></label>
                    <select class="form-control @error('idjenis_hewan') is-invalid @enderror" id="idjenis_hewan" name="idjenis_hewan" required>
                        <option value="">-- Pilih Jenis Hewan --</option>
                        @foreach($jenisHewan as $jenis)
                            <option value="{{ $jenis->idjenis_hewan }}" {{ old('idjenis_hewan') == $jenis->idjenis_hewan ? 'selected' : '' }}>
                                {{ $jenis->nama_jenis_hewan }}
                            </option>
                        @endforeach
                    </select>
                    @error('idjenis_hewan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label for="nama_ras">Nama Ras <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_ras') is-invalid @enderror" id="nama_ras" name="nama_ras" value="{{ old('nama_ras') }}" required>
                    @error('nama_ras') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Ras Hewan
                </button>
            </form>
        </div>
    </div>
</div>
@endsection