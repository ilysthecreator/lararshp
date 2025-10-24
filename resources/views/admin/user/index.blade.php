@extends('admin.layout')

@section('title', 'Daftar User')
@section('page-title', 'Daftar User')

@section('content')
<div class="card">
    <div class="card-header">
        <h4><i class="fas fa-users"></i> Daftar User dengan Role</h4>
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
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->id }}</td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                {{ strtoupper(substr($item->name, 0, 1)) }}
                            </div>
                            <strong>{{ $item->name }}</strong>
                        </div>
                    </td>
                    <td>
                        <a href="mailto:{{ $item->email }}" style="color: var(--primary-color); text-decoration: none;">
                            <i class="fas fa-envelope"></i> {{ $item->email }}
                        </a>
                    </td>
                    <td>
                        @if($item->role == 'admin')
                            <span style="padding: 0.25rem 0.75rem; background: #d4edda; color: #155724; border-radius: 12px; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">
                                <i class="fas fa-crown"></i> {{ $item->role }}
                            </span>
                        @elseif($item->role == 'dokter')
                            <span style="padding: 0.25rem 0.75rem; background: #d1ecf1; color: #0c5460; border-radius: 12px; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">
                                <i class="fas fa-user-md"></i> {{ $item->role }}
                            </span>
                        @elseif($item->role == 'staff')
                            <span style="padding: 0.25rem 0.75rem; background: #fff3cd; color: #856404; border-radius: 12px; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">
                                <i class="fas fa-user-tie"></i> {{ $item->role }}
                            </span>
                        @else
                            <span style="padding: 0.25rem 0.75rem; background: #e2e3e5; color: #383d41; border-radius: 12px; font-size: 0.85rem; font-weight: 600; text-transform: uppercase;">
                                <i class="fas fa-user"></i> {{ $item->role }}
                            </span>
                        @endif
                    </td>
                    <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        @if($item->id != Auth::id())
                        <button class="btn btn-sm" style="background: var(--danger-color); color: white;">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 2rem; color: #999;">
                        <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                        <p>Belum ada data user</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection