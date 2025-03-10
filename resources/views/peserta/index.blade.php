@extends('Template.main')

@section('breadcrumb_parent', 'Pages')
@section('breadcrumb_current', 'Peserta')

@section('peserta', 'active bg-gradient-purple text-white')

@section('content')
<div class="container">
    <h2 class="mb-4">Data Peserta</h2>
    
    <!-- Tombol untuk membuka modal tambah peserta -->
    <button class="btn btn-purple text-white mb-3" id="openModal">
        <i class="fas fa-user-plus"></i> Tambah Peserta
    </button>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Card Tabel Data Peserta -->
    <div class="card-body">
        <div class="table-responsive bg-white p-3 rounded shadow">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>No. HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pesertas as $index => $peserta)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $peserta->nama }}</td>
                            <td>{{ $peserta->jenis_kelamin }}</td>
                            <td>{{ $peserta->alamat }}</td>
                            <td>{{ $peserta->no_hp }}</td>
                            <td class="text-center">
                                <button class="btn bg-orange text-white editPeserta" 
                                    data-id="{{ $peserta->id }}" 
                                    data-nama="{{ $peserta->nama }}"
                                    data-jenis-kelamin="{{ $peserta->jenis_kelamin }}"
                                    data-alamat="{{ $peserta->alamat }}"
                                    data-no-hp="{{ $peserta->no_hp }}">
                                    <i class="fas fa-edit "></i> 
                                </button>

                                <form action="{{ route('peserta.destroy', $peserta) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn bg-red text-white " onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fas fa-trash-alt "></i> 
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah/Edit Peserta -->
<div class="modal fade" id="pesertaModal" tabindex="-1" aria-labelledby="pesertaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formTitle">Tambah Peserta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="pesertaForm" action="{{ route('peserta.store') }}" method="POST">
                    @csrf
                    <input type="hidden" id="peserta_id" name="peserta_id">

                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" id="nama" class="form-control border rounded" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                            <option value="">Pilih</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control border rounded" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No. HP</label>
                        <input type="text" name="no_hp" id="no_hp" class="form-control border rounded" required>
                    </div>

                    <button type="submit" class="btn btn-purple text-white">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script jQuery untuk Modal dan Edit -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var modal = $('#pesertaModal');

        $('#openModal').click(function () {
            resetForm();
            modal.modal('show');
        });

        $('.editPeserta').click(function () {
            var id = $(this).data('id');
            var nama = $(this).data('nama');
            var jenis_kelamin = $(this).data('jenis-kelamin');
            var alamat = $(this).data('alamat');
            var no_hp = $(this).data('no-hp');

            $('#formTitle').text('Edit Peserta');
            $('#peserta_id').val(id);
            $('#nama').val(nama);
            $('#jenis_kelamin').val(jenis_kelamin);
            $('#alamat').val(alamat);
            $('#no_hp').val(no_hp);
            
            $('#pesertaForm').attr('action', '/peserta/' + id);
            $('#pesertaForm').append('<input type="hidden" name="_method" value="PUT">');
            modal.modal('show');
        });

        function resetForm() {
            $('#formTitle').text('Tambah Peserta');
            $('#peserta_id').val('');
            $('#nama').val('');
            $('#jenis_kelamin').val('');
            $('#alamat').val('');
            $('#no_hp').val('');
            $('#pesertaForm').attr('action', '{{ route('peserta.store') }}');
            $('#pesertaForm input[name="_method"]').remove();
        }
    });
</script>
@endsection
