@extends('resepsionis.layout')

@section('title', 'Data Pemilik')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 fw-bold text-primary">Daftar Pemilik Hewan</h6>
        <a href="{{ route('resepsionis.pemilik.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Pemilik
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Pemilik</th>
                        <th>Alamat</th>
                        <th>No. WA</th>
                        <th>Email</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemiliks as $p)
                    <tr>
                        <td>{{ $loop->iteration + $pemiliks->firstItem() - 1 }}</td>
                        <td class="fw-bold">{{ $p->user->nama ?? '-' }}</td>
                        <td>{{ $p->alamat }}</td>
                        <td>{{ $p->no_wa }}</td>
                        <td>{{ $p->user->email ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('resepsionis.pemilik.edit', $p->idpemilik) }}" class="btn btn-warning btn-sm text-white">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('resepsionis.pemilik.destroy', $p->idpemilik) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data pemilik ini? Data user dan hewan terkait juga akan terhapus.')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted">Belum ada data pemilik.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $pemiliks->links() }}
        </div>
    </div>
</div>
@endsection