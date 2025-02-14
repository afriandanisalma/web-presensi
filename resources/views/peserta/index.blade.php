@extends('Template.main')

@section('breadcrumb_parent', 'Pages')
@section('breadcrumb_current', 'Peserta')

@section('peserta', 'active bg-gradient-dark text-white')

@section('content')
<h1>Data Peserta</h1>

<!-- Tombol Tambah Peserta -->
<button class="btn btn-primary" id="openModal">Tambah Peserta</button>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Tabel Data Peserta -->
<div class="table-container">
    <table class="table mt-3">
        <thead>
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
                <td>{{ $index + 1 }}</td>
                <td>{{ $peserta->nama }}</td>
                <td>
                    @if ($peserta->jenis_kelamin == 'Laki-laki')
                        <span class="badge badge-laki">Laki-laki</span>
                    @else
                        <span class="badge badge-perempuan">Perempuan</span>
                    @endif
                </td>
                <td>{{ $peserta->alamat }}</td>
                <td>{{ $peserta->no_hp }}</td>
                <td>
                    <!-- Tombol Edit -->
                    <button class="btn btn-warning editPeserta" 
                        data-id="{{ $peserta->id }}" 
                        data-nama="{{ $peserta->nama }}"
                        data-jenis-kelamin="{{ $peserta->jenis_kelamin }}"
                        data-alamat="{{ $peserta->alamat }}"
                        data-no-hp="{{ $peserta->no_hp }}">
                        Edit
                    </button>

                    <!-- Tombol Hapus -->
                    <form action="{{ route('peserta.destroy', $peserta) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Tambah/Edit Peserta (Hidden by Default) -->
<div id="pesertaModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 id="formTitle">Tambah Peserta</h2>
        <form id="pesertaForm" action="{{ route('peserta.store') }}" method="POST">
            @csrf
            <input type="hidden" id="peserta_id" name="peserta_id">

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" id="nama" class="form-control">
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                    <option value="">Pilih</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <label>No. HP</label>
                <input type="text" name="no_hp" id="no_hp" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>

<!-- Tambahkan Script jQuery untuk Modal -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        var modal = $('#pesertaModal');

        // Sembunyikan modal saat halaman dimuat
        modal.hide();

        // Tampilkan modal saat tombol "Tambah Peserta" diklik
        $('#openModal').click(function () {
            resetForm();
            modal.fadeIn();
        });

        // Sembunyikan modal saat tombol "X" diklik
        $('.close').click(function () {
            modal.fadeOut();
            resetForm();
        });

        // Sembunyikan modal saat klik di luar modal
        $(window).click(function (event) {
            if ($(event.target).is(modal)) {
                modal.fadeOut();
                resetForm();
            }
        });

        // Edit Data Peserta
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
            
            modal.fadeIn();
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

<!-- CSS untuk Modal -->
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 10;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: white;
        padding: 20px;
        border-radius: 10px;
        width: 35%; /* Lebih kecil */
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        text-align: left;
        position: relative;
        animation: fadeIn 0.3s ease-in-out;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 25px;
        cursor: pointer;
        color: red;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    button {
        margin-top: 10px;
        padding: 8px 15px;
        border-radius: 5px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
/* ======== Styling untuk Tabel ======== */
.table-container {
    width: 100%;
    overflow-x: auto; /* Agar tabel tetap terlihat di layar kecil */
}

.table {
    width: 100%;
    border-collapse: collapse;
   
    background-color: white;
    border-radius: 10px;
    overflow: hidden;
}

/* Header Tabel */
.table thead {
    background-color: #fafbfc;
    color: rgb(78, 73, 73);
    font-weight: bold;
}

/* Header Tabel - Posisi Tengah & Padding */
.table th {
    padding: 12px;
    text-align: center;
    border-bottom: 2px solid #ddd;
}

/* Sel Data Tabel */
.table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

/* Baris Ganjil - Warna Alternatif */
.table tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
}

/* Efek Hover pada Baris */
.table tbody tr:hover {
    background-color: #f1f1f1;
}

/* ======== Badge untuk Jenis Kelamin ======== */
.badge-laki {
    background-color: #0d6efd;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 13px;
}

.badge-perempuan {
    background-color: #dc3545;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 13px;
}

/* ======== Styling untuk Tombol Aksi ======== */
.btn {
    padding: 8px 12px;
    font-size: 14px;
    border-radius: 5px;
}

.btn-warning {
    background-color: #ffc107;
    color: black;
}

.btn-warning:hover {
    background-color: #e0a800;
}

.btn-danger {
    background-color: #dc3545;
    color: white;
}

.btn-danger:hover {
    background-color: #c82333;
}

/* Tambahkan sedikit jarak antar tombol */
.btn + .btn {
    margin-left: 5px;
}

/* ======== Responsif untuk Layar Kecil ======== */
@media (max-width: 768px) {
    .table th, .table td {
        padding: 10px;
        font-size: 13px;
    }

    .btn {
        font-size: 12px;
        padding: 6px 10px;
    }
}



</style>

@endsection
