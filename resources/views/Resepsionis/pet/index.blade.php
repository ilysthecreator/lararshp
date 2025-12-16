@extends('resepsionis.layout')

@section('title', 'Data Pasien (Hewan)')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 fw-bold text-primary">Daftar Pasien Hewan</h6>
        <a href="{{ route('resepsionis.pet.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Daftar Hewan Baru
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Hewan</th>
                        <th>Jenis & Ras</th>
                        <th>Gender</th>
                        <th>Warna/Tanda</th>
                        <th>Pemilik</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pets as $pet)
                    <tr>
                        <td>{{ $loop->iteration + $pets->firstItem() - 1 }}</td>
                        <td class="fw-bold">{{ $pet->nama }}</td>
                        <td>
                            {{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '' }} - 
                            {{ $pet->rasHewan->nama_ras ?? '' }}
                        </td>
                        <td>
                            @if($pet->jenis_kelamin == 'J') <i class="fas fa-mars text-primary"></i> Jantan
                            @else <i class="fas fa-venus text-danger"></i> Betina @endif
                        </td>
                        <td>{{ $pet->warna_tanda }}</td>
                        <td>{{ $pet->pemilik->user->nama ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('resepsionis.pet.edit', $pet->idpet) }}" class="btn btn-warning btn-sm text-white">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('resepsionis.pet.destroy', $pet->idpet) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data hewan ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted">Belum ada data hewan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $pets->links() }}
        </div>
    </div>
</div>
@endsection