<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    // Menampilkan daftar peserta
    public function index()
    {
        $pesertas = Peserta::all();
        return view('peserta.index', compact('pesertas'));
    }

    // Menampilkan form tambah peserta
    public function create()
    {
        return view('peserta.create');
    }

    // Menyimpan data peserta baru
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:15',
        ]);

        Peserta::create([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil ditambahkan.');
    }

    // Menampilkan form edit peserta
    public function edit($id)
    {
        $peserta = Peserta::findOrFail($id);
        return view('peserta.edit', compact('peserta'));
    }

    // Memperbarui data peserta
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'no_hp' => 'nullable|string|max:15',
        ]);

        $peserta = Peserta::findOrFail($id);
        $peserta->update([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil diperbarui.');
    }

    // Menghapus peserta
    public function destroy($id)
    {
        $peserta = Peserta::findOrFail($id);
        $peserta->delete();

        return redirect()->route('peserta.index')->with('success', 'Peserta berhasil dihapus.');
    }
}
