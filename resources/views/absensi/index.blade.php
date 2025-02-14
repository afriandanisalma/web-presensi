@extends('template.main')

@section('breadcrumb_parent', 'Pages')
@section('breadcrumb_current', 'kehadiran')

@section('absensi', 'active bg-gradient-dark text-white')
@section('content')
<div class="container">
    <h1>Kehadiran</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama </th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensi as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->siswa->name }}</td>
                <td>{{ $item->date }}</td>
                <td>{{ ucfirst($item->status) }}</td>
                <td>
                    {{-- <a href="{{ route('absensi.edit', $item) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('absensi.destroy', $item) }}" method="POST" style="display:inline;"> --}}
                        {{-- @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form> --}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
