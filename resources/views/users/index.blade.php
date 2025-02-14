@extends('Template.main')

@section('breadcrumb_parent', 'Pages')
@section('breadcrumb_current', 'Users')

@section('users', 'active bg-gradient-dark text-white')

@section('content')
<div class="container">
    <h2 class="mb-4">Data User</h2>
    
    <!-- Tombol untuk membuka modal tambah user -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <i class="fas fa-user-plus"></i> Tambah Akun
    </button>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Tabel Data User -->
    
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $user->role == 'admin' ? 'bg-danger' : 'bg-info' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> Hapus
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

<!-- Modal Tambah User -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addUserModalLabel">Tambah Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Card Form Tambah User -->
                
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" name="name" class="form-control border rounded" >
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control border rounded" >
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" class="form-select border rounded" required>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control border rounded" >
                            </div>

                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </form>
                    </div>
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>
</div>

@endsection
