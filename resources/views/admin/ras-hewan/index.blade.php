@extends('admin.layout')

@section('title', 'Daftar Ras Hewan')
@section('page-title', 'Daftar Ras Hewan')

@section('content')
<div class="card">
    <div class="card-header">
        <h4><i class="fas fa-dog"></i> Daftar Ras Hewan</h4>
        <a href="#" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Data
        </a>
    </div>
    
    <div style="overflow-x: auto;">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Jenis Hewan</th>
                    <th>Nama Ras</th>
                    <th>Deskripsi</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rasHewan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->id }}</td>
                    <td>
                        <span style="padding: 0.25rem 0.75rem; background: #e7f3ff; color: #0066cc; border-radius: 12px; font-size: 0.85rem; font-weight: 600;">
                            {{ $item->jenisHewan->nama_jenis ?? '-' }}
                        </span>
                    </td>
                    <td><strong>{{ $item->nama_ras }}</strong></td>
                    <td>{{ $item->deskripsi ?? '-' }}</td>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <button class="btn btn-sm" style="background: var(--danger-color); color: white;">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 2rem; color: #999;">
                        <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                        <p>Belum ada data ras hewan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection