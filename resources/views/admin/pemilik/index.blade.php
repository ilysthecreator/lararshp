@extends('admin.layout')

@section('title', 'Daftar Pemilik')
@section('page-title', 'Daftar Pemilik')

@section('content')
<div class="card">
    <div class="card-header">
        <h4><i class="fas fa-user-friends"></i> Daftar Pemilik</h4>
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
                    <th>Nama Pemilik</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Email</th>
                    <th>Jumlah Pet</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pemilik as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->id }}</td>
                    <td><strong>{{ $item->nama_pemilik }}</strong></td>
                    <td>{{ $item->alamat ?? '-' }}</td>
                    <td>
                        @if($item->no_telepon)
                            <a href="tel:{{ $item->no_telepon }}" style="color: var(--primary-color); text-decoration: none;">
                                <i class="fas fa-phone"></i> {{ $item->no_telepon }}
                            </a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if($item->email)
                            <a href="mailto:{{ $item->email }}" style="color: var(--primary-color); text-decoration: none;">
                                <i class="fas fa-envelope"></i> {{ $item->email }}
                            </a>
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <span style="padding: 0.25rem 0.75rem; background: #d4edda; color: #155724; border-radius: 12px; font-size: 0.85rem; font-weight: 600;">
                            {{ $item->pets_count }} Pet
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
                    <td colspan="9" style="text-align: center; padding: 2rem; color: #999;">
                        <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                        <p>Belum ada data pemilik</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection