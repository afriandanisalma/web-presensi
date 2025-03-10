<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        return view('user.home');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

       
        $absensi = Absensi::where('user_id', $user->id)
                          ->where('tanggal', now()->toDateString())
                          ->first();

        if ($absensi) {
            return back()->with('error', 'Anda sudah absen hari ini.');
        }

    
        Absensi::create([
            'user_id'   => $user->id,
            'tanggal'   => now()->toDateString(),
            'jam_masuk' => now()->toTimeString(),
        ]);

        return back()->with('success', 'Berhasil absen masuk.');
    }

    public function keluar()
    {
        $user = Auth::user();

        $absensi = Absensi::where('user_id', $user->id)
                          ->where('tanggal', now()->toDateString())
                          ->first();

        if (!$absensi) {
            return back()->with('error', 'Anda belum melakukan absen masuk.');
        }

        if ($absensi->jam_keluar) {
            return back()->with('error', 'Anda sudah absen keluar hari ini.');
        }

        $absensi->update([
            'jam_keluar' => now()->toTimeString(),
        ]);

        return back()->with('success', 'Berhasil absen keluar.');
    }
}

