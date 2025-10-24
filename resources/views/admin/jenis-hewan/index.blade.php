@extends('admin.layout')

@section('title', 'Jenis Hewan')

@section('actions')
<div class="text-end">
    <a href="{{ route('admin.jenis-hewan.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-2"></i>Tambah Jenis Hewan
    </a>
</div>
@endsection

@section('content')
<div class="container-fluid px-0">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 60px">#</th>
                            <th scope="col">Nama Jenis</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col" style="width: 200px">Tanggal Dibuat</th>
                            <th scope="col" style="width: 120px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jenisHewan as $jenis)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $jenis->nama_jenis }}</td>
                            <td>{{ $jenis->deskripsi ?? '-' }}</td>
                            <td>{{ $jenis->created_at ? $jenis->created_at->format('d M Y H:i') : '-' }}</td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.jenis-hewan.edit', ['id' => $jenis->id]) }}" 
                                       class="btn btn-warning" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-danger" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#deleteModal{{ $jenis->id }}"
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $jenis->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus jenis hewan <strong>{{ $jenis->nama_jenis }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('admin.jenis-hewan.destroy', $jenis->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-paw fa-3x text-secondary mb-3"></i>
                                    <h6 class="fw-bold text-secondary">Belum ada data jenis hewan</h6>
                                    <p class="text-muted">Silahkan tambahkan jenis hewan baru</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .table > :not(caption) > * > * {
        padding: 1rem 1rem;
    }
    
    .btn-group .btn {
        padding: 0.375rem 0.75rem;
    }
    
    .modal-header, .modal-footer {
        padding: 1rem;
    }
    
    .modal-body {
        padding: 1.5rem;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(0, 102, 204, 0.05);
    }
</style>
@endsection