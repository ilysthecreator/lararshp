@extends('perawat.layout')

@section('content')
<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pasien (Hewan)</h5>
            <a href="{{ route('perawat.dashboard') }}" class="btn btn-sm btn-secondary">Kembali ke Dashboard</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Hewan</th>
                            <th>Jenis</th>
                            <th>Ras</th>
                            <th>Pemilik</th>
                            <th>Gender</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pasien as $p)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $p->nama_hewan }}</strong></td>
                            <td>{{ $p->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
                            <td>{{ $p->rasHewan->nama_ras_hewan ?? '-' }}</td>
                            <td>{{ $p->pemilik->user->name ?? '-' }}</td>
                            <td>{{ $p->jenis_kelamin_hewan }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data pasien.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $pasien->links() }}
            </div>
        </div>
    </div>
</div>
@endsection