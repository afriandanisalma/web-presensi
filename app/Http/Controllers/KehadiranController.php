<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kehadiran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class KehadiranController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tanggal = Carbon::now()->toDateString();
        $jamSekarang = Carbon::now()->format('H:i:s');
        $waktuMulaiAbsen = "10:00:00"; 
        $waktuSelesaiAbsen = "16:00:00";

        $kehadiran = Kehadiran::where('user_id', $user->id)
                    ->where('tanggal', $tanggal)
                    ->first();

        return view('home', compact('tanggal', 'jamSekarang', 'waktuMulaiAbsen', 'waktuSelesaiAbsen', 'kehadiran'));
    }

    public function absenMasuk()
    {
        $user = Auth::user();
        $tanggal = Carbon::now()->toDateString();
        $waktuMasuk = Carbon::now()->format('H:i:s');

        $kehadiran = Kehadiran::where('user_id', $user->id)
                    ->where('tanggal', $tanggal)
                    ->first();

        if (!$kehadiran) {
            Kehadiran::create([
                'user_id' => $user->id,
                'tanggal' => $tanggal,
                'waktu_masuk' => $waktuMasuk,
                'waktu_keluar' => null, 
            ]);
        } else {
            return redirect()->route('home')->with('error', 'Anda sudah absen masuk hari ini!');
        }

        return redirect()->route('home')->with('success', 'Absen masuk berhasil!');
    }

    public function absenKeluar()
    {
        $user = Auth::user();
        $tanggal = Carbon::now()->toDateString();
        $waktuKeluar = Carbon::now()->format('H:i:s');

        $kehadiran = Kehadiran::where('user_id', $user->id)
                    ->where('tanggal', $tanggal)
                    ->first();

        if ($kehadiran) {
            if (!$kehadiran->waktu_keluar) {
                $kehadiran->update([
                    'waktu_keluar' => $waktuKeluar,
                ]);
            } else {
                return redirect()->route('home')->with('error', 'Anda sudah absen keluar hari ini!');
            }
        } else {
            return redirect()->route('home')->with('error', 'Anda belum absen masuk hari ini!');
        }

        return redirect()->route('home')->with('success', 'Absen keluar berhasil!');
    }
}
