@extends('admin.layout')

@section('title', 'Manajemen User')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen User</h1>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
            <span class="text">Tambah User</span>
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td><strong>{{ $user->nama }}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @forelse($user->roles as $role)
                                    <span class="badge badge-info">{{ $role->nama_role }}</span>
                                @empty
                                    <span class="badge badge-secondary">Tidak ada role</span>
                                @endforelse
                            </td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm btn-edit" 
                                        data-id="{{ $user->iduser }}" 
                                        title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.users.destroy', $user->iduser) }}" method="POST" class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus" data-user-name="{{ $user->nama }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                <i class="fas fa-info-circle"></i> Tidak ada data user
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_nama">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_email">Alamat Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_password">Password Baru</label>
                                <input type="password" class="form-control" id="edit_password" name="password">
                                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="edit_password_confirmation">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="edit_password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Roles <span class="text-danger">*</span></label>
                        <div class="row px-3" id="edit_roles_container">
                            {{-- Roles will be populated by JS --}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Pre-fetch all roles for the edit modal
    var allRoles = [];
    $.get('{{ route("admin.role.index") }}', function(data) {
        allRoles = data.roles;
    });

    $('#dataTable').DataTable({
        "language": { "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json" },
        "pageLength": 10,
        "ordering": true,
        "searching": true
    });

    $('.btn-edit').on('click', function() {
        var id = $(this).data('id');
        var url = `{{ url('admin/users') }}/${id}/edit`;
        var updateUrl = `{{ url('admin/users') }}/${id}`;

        $('#editForm').attr('action', updateUrl);

        $.get(url, function(user) {
            $('#edit_nama').val(user.nama);
            $('#edit_email').val(user.email);
            $('#edit_password').val('');
            $('#edit_password_confirmation').val('');

            var rolesContainer = $('#edit_roles_container');
            rolesContainer.empty();
            var userRoleIds = user.roles.map(role => role.idrole);

            allRoles.forEach(function(role) {
                var isChecked = userRoleIds.includes(role.idrole) ? 'checked' : '';
                rolesContainer.append(`
                    <div class="form-check col-md-3">
                        <input class="form-check-input" type="checkbox" name="roles[]" value="${role.idrole}" id="edit_role_${role.idrole}" ${isChecked}>
                        <label class="form-check-label" for="edit_role_${role.idrole}">${role.nama_role}</label>
                    </div>
                `);
            });

            $('#editModal').modal('show');
        });
    });

    $('.form-delete').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        var userName = $(this).find('button[type="submit"]').data('user-name');

        Swal.fire({
            title: 'Anda yakin?',
            text: `User dengan nama "${userName}" akan dihapus dan tidak dapat dikembalikan!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endpush