@extends('template.main')

@section('content')
<div class="container">
    <h2 class="text-center">Profil Saya</h2>

    <div class="row justify-content-center">
        <div class="col-md-4 text-center">
            <img src="{{ $user->photo ? asset('storage/profiles/'.$user->photo) : asset('images/default.png') }}" 
                 class="rounded-circle" width="150" height="150">
            <h3 class="mt-2">{{ $user->name }}</h3>
        </div>
        
        <div class="col-md-6">
            <!-- Alert Notifikasi -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#edit-profile">Edit Profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#change-password">Ganti Password</a>
                </li>
            </ul>

            <div class="tab-content mt-3">
                <!-- Edit Profile Form -->
                <div id="edit-profile" class="tab-pane fade show active">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label class="form-label">Foto Profil</label>
                            <input type="file" name="photo" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="gender" class="form-control">
                                <option value="">Pilih</option>
                                <option value="Laki-laki" {{ old('gender', $user->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('gender', $user->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea name="address" class="form-control">{{ old('address', $user->address) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No. HP</label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>

                <!-- Change Password Form -->
                <div id="change-password" class="tab-pane fade">
                    <form action="{{ route('profile.update.password') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label">Password Saat Ini</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" name="new_password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Ubah Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
