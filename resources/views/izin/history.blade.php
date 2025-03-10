@extends('template.main')

@section('breadcrumb_parent', 'Home')
@section('breadcrumb_current', 'History')

@section('history', 'active bg-gradient-purple text-white')

@section('content')
<div class="container">
    <h2>History Pengajuan Izin</h2>

    <!-- Filter Bulan & Tahun -->
    <div class="d-flex justify-content-between mb-3">
        <div>
            <select class="form-select d-inline-block w-auto">
                <option value="Januari">Januari</option>
                <option value="Februari">Februari</option>
                <option value="Maret">Maret</option>
                {{-- <option value="April">Januari</option>
                <option value="Mei">Februari</option>
                <option value="Juni">Maret</option>
                <option value="July">Januari</option>
                <option value="Agustus">Februari</option>
                <option value="September">Maret</option>
                <option value="Oktober">Januari</option>
                <option value="November">Februari</option>
                <option value="Desember">Maret</option> --}}
            </select>
            <select class="form-select d-inline-block w-auto">
                @for ($year = date('Y'); $year >= 2020; $year--)
                    <option value="{{ $year }}">{{ $year }}</option>
                @endfor
            </select>
        </div>
        <button class="btn bg-gradient-purple text-white">Filter</button>
    </div>

    <!-- Tabel Daftar Pengajuan Izin -->
    @if($izin->isEmpty())
        <div class="alert alert-info text-center">
            
            <i class="bi bi-calendar-x"></i>
            <p>Tidak ada data history untuk periode ini</p>
        </div>
    @else
    <div class="card-body">
        <div class="table-responsive bg-white p-3 rounded shadow">
            <table class="table table-bordered table-hover align-middle mt-4">
                <thead>
                    <tr>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Alasan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($izin as $data)
                        <tr>
                            <td>{{ $data->tanggal_mulai }}</td>
                            <td>{{ $data->tanggal_selesai }}</td>
                            <td>{{ $data->alasan }}</td>
                            <td>
                                <span class="badge bg-{{ $data->status == 'disetujui' ? 'success' : ($data->status == 'ditolak' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($data->status) }}
                                </span>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        </div>
    </div>
@endsection
