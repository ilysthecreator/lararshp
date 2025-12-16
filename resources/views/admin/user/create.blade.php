@extends('admin.layout')

@section('title', 'Tambah User Baru')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah User Baru</h1>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        {{-- Update Route ke PLURAL --}}
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            {{-- ... (Isi form sama seperti sebelumnya) ... --}}

<div class="card shadow mb-4">
    <div class="card-body">
        {{-- Update Route ke PLURAL --}}
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Alamat Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            <small class="text-muted">Minimal 6 karakter.</small>
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <label class="font-weight-bold">Roles / Hak Akses <span class="text-danger">*</span></label>
                    <div class="row px-3">
                    @foreach($roles as $role)
                        <div class="col-md-3 mb-2">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" 
                                       name="roles[]" 
                                       value="{{ $role->idrole }}" 
                                       id="role_{{ $role->idrole }}"
                                       {{ (is_array(old('roles')) && in_array($role->idrole, old('roles'))) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="role_{{ $role->idrole }}">
                                    {{ $role->nama_role }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                    </div>
                    @error('roles') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save"></i> Simpan User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection