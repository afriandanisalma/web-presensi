@extends('template.main')

@section('breadcrumb_parent', 'Home')
@section('breadcrumb_current', 'Pengajuan')

@section('izin', 'active bg-gradient-purple text-white')

@section('content')
<div class="container">
    <h2>Pengajuan Izin</h2>

    <!-- Tombol untuk membuka modal -->
    <button type="button" class="btn btn-purple text-white mb-3" data-bs-toggle="modal" data-bs-target="#izinModal">
        Ajukan Izin
    </button>

    <!-- Modal Pengajuan Izin -->
    <div class="modal fade" id="izinModal" tabindex="-1" aria-labelledby="izinModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="izinModalLabel">Formulir Pengajuan Izin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Pengajuan Izin -->
                    <form method="POST" action="{{ route('izin.simpan') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control border rounded" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control border rounded" required>
                        </div>
                        <div class="mb-3">
                            <label for="alasan" class="form-label">Alasan</label>
                            <textarea name="alasan" class="form-control border rounded" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-purple text-white">Ajukan Izin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Tabel Daftar Pengajuan Izin -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Alasan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($izin as $data)
                <tr>
                    <td>{{ optional($data->pengguna)->name ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $data->tanggal_mulai }}</td>
                    <td>{{ $data->tanggal_selesai }}</td>
                    <td>{{ $data->alasan }}</td>
                    <td>{{ ucfirst($data->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
    
</div>
@endsection
