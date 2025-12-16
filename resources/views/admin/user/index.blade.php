@extends('admin.layout')

@section('title', 'Manajemen User')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen User</h1>
        {{-- UPDATE ROUTE KE PLURAL --}}
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-icon-split shadow-sm">
            <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
            <span class="text">Tambah User</span>
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
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
                            <td class="font-weight-bold">{{ $user->nama }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach($user->roles as $role)
                                    <span class="badge badge-info mr-1">{{ $role->nama_role }}</span>
                                @endforeach
                            </td>
                            <td class="text-center">
                                {{-- UPDATE ROUTE KE PLURAL --}}
                                <button class="btn btn-warning btn-sm btn-edit" 
                                        data-url="{{ route('admin.users.edit', $user->iduser) }}"
                                        data-update-url="{{ route('admin.users.update', $user->iduser) }}"
                                        title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                
                                <form action="{{ route('admin.users.destroy', $user->iduser) }}" method="POST" class="d-inline form-delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus" data-name="{{ $user->nama }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">Tidak ada data.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                    <hr>
                    <p class="text-muted small">Kosongkan jika tidak ingin ubah password.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password" placeholder="Password Baru">
                        </div>
                        <div class="col-md-6">
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Ulangi Password">
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label class="font-weight-bold">Role</label>
                        <div class="row px-3" id="edit_roles_container"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('#dataTable').DataTable();

    // Edit Logic
    $('.btn-edit').on('click', function() {
        var urlEdit = $(this).data('url');
        var urlUpdate = $(this).data('update-url');
        $('#editForm').attr('action', urlUpdate);
        $('#editForm')[0].reset();
        $('#editModal').modal('show');
        $('#edit_roles_container').html('<div class="text-center w-100 py-2"><div class="spinner-border text-primary"></div></div>');

        $.get(urlEdit, function(response) {
            $('#edit_nama').val(response.user.nama);
            $('#edit_email').val(response.user.email);
            
            var rolesHtml = '';
            var userRoleIds = response.user.roles.map(r => r.idrole);

            response.roles.forEach(function(role) {
                var checked = userRoleIds.includes(role.idrole) ? 'checked' : '';
                rolesHtml += `
                    <div class="col-md-4 mb-2">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="roles[]" value="${role.idrole}" id="role_edit_${role.idrole}" ${checked}>
                            <label class="custom-control-label" for="role_edit_${role.idrole}">${role.nama_role}</label>
                        </div>
                    </div>`;
            });
            $('#edit_roles_container').html(rolesHtml);
        });
    });

    // Delete Logic
    $('.form-delete').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        Swal.fire({
            title: 'Yakin hapus?',
            text: "Data akan hilang permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) form.submit();
        });
    });
});
</script>
@endpush