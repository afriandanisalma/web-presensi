<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kehadiran;

class KehadiranRekapController extends Controller
{
    public function index()
    {
        $kehadiran = Kehadiran::with('user')->orderBy('tanggal', 'desc')->get();

        return view('kehadiran.index', compact('kehadiran'));
    }

    public function destroy($id)
    {
        $kehadiran = Kehadiran::findOrFail($id);
        
        if (!$kehadiran) {
            return redirect()->route('kehadiran.index')->with('error', 'Data Kehadiran tidak ditemukan');
        }

        $kehadiran->delete();
        return redirect()->route('kehadiran.index')->with('success', 'Data Kehadiran Berhasil Dihapus');
    }
}

