@extends('admin.layout')

@section('title', 'Daftar Kode Tindakan Terapi')
@section('page-title', 'Daftar Kode Tindakan Terapi')

@section('content')
<div class="card">
    <div class="card-header">
        <h4><i class="fas fa-procedures"></i> Daftar Kode Tindakan Terapi</h4>
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
                    <th>Kode</th>
                    <th>Nama Tindakan</th>
                    <th>Deskripsi</th>
                    <th>Tarif</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kodeTindakan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->id }}</td>
                    <td>
                        <span style="padding: 0.25rem 0.75rem; background: #fff3cd; color: #856404; border-radius: 12px; font-size: 0.85rem; font-weight: 600; font-family: monospace;">
                            {{ $item->kode }}
                        </span>
                    </td>
                    <td><strong>{{ $item->nama_tindakan }}</strong></td>
                    <td>{{ $item->deskripsi ?? '-' }}</td>
                    <td>
                        <span style="color: var(--success-color); font-weight: 600;">
                            Rp {{ number_format($item->tarif ?? 0, 0, ',', '.') }}
                        </span>
                    </td>
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
                    <td colspan="8" style="text-align: center; padding: 2rem; color: #999;">
                        <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                        <p>Belum ada data kode tindakan terapi</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection