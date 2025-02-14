@extends('template.main')

@section('breadcrumb_parent', 'Form')
@section('breadcrumb_current', 'Tambah Absensi')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm p-4">
        <h2 class="text-center mb-4">Tambah Absensi</h2>
        <form action="{{ route('absensi.store') }}" method="POST">
            @csrf
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Siswa</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($siswa as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>
                            <input type="date" name="date[{{ $item->id }}]" class="form-control" required>
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status[{{ $item->id }}]" value="Hadir" required>
                                    <label class="form-check-label">Hadir</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status[{{ $item->id }}]" value="Izin">
                                    <label class="form-check-label">Izin</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status[{{ $item->id }}]" value="Sakit">
                                    <label class="form-check-label">Sakit</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status[{{ $item->id }}]" value="Alfa">
                                    <label class="form-check-label">Alfa</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="/absensi" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
