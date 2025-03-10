@extends('template.main')

@section('breadcrumb_parent', 'Pages')
@section('breadcrumb_current', 'Kehadiran')

@section('kehadiran', 'active bg-gradient-purple text-white')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Kehadiran Peserta</h2>
    <div class="table-responsive bg-white p-3 rounded shadow">
        <table class="table table-bordered table-hover align-middle">
                <thead class="table text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kehadiran as $index => $absen)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $absen->user->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($absen->tanggal)->translatedFormat('l, d F Y') }}</td>
                        <td>{{ $absen->waktu_masuk ?? '-' }}</td>
                        <td>{{ $absen->waktu_keluar ?? '-' }}</td>
                        <td>
                            <div class="btn-group">
                                <form action="{{ route('kehadiran.destroy', $absen->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger " onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                    <i class="fas fa-trash-alt"></i> 
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
