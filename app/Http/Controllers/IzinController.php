<?php

namespace App\Http\Controllers;

use App\Models\Izin;
use App\Models\IzinPeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IzinController extends Controller {
    public function index() {
        $izin = Izin::with('pengguna')->where('pengguna_id', Auth::id())->get();
        return view('izin.daftar', compact('izin'));
    }

    public function simpan(Request $request) {
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alasan' => 'required|string',
        ]);

        $izin = Izin::create([
            'pengguna_id' => Auth::id(),
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
            
        ]);

        // Simpan juga ke tabel izin_peserta
        IzinPeserta::create([
            'user_id' => Auth::id(),
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'alasan' => $request->alasan,
           
        ]);

        return redirect()->route('izin.daftar')->with('success', 'Pengajuan izin berhasil dikirim.');
    }
}

