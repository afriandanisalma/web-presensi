@extends('template.main')

@section('breadcrumb_parent', 'Pages')
@section('breadcrumb_current', 'Izin Peserta')

@section('izin_admin', 'active bg-gradient-dark text-white')

@section('content')
<div class="container">
    <h2>Daftar Izin Peserta</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Alasan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($izin as $data)
            <tr>
                <td>{{ $data->user ? $data->user->name : '-' }}</td>
                <td>{{ $data->tanggal_mulai }}</td>
                <td>{{ $data->tanggal_selesai }}</td>
                <td>{{ $data->alasan }}</td>
                <td>{{ ucfirst($data->status) }}</td>
                <td>
                    <form action="{{ route('admin.izin.updateStatus', $data->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" onchange="this.form.submit()">
                            <option value="pending" {{ $data->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="disetujui" {{ $data->status == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ $data->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
