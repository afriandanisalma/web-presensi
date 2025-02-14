<?php

namespace App\Http\Controllers;

use App\Models\IzinPeserta;
use Illuminate\Http\Request;

class AdminIzinController extends Controller {
    public function index() {
        $izin = IzinPeserta::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.izin.index', compact('izin'));
    }

    public function updateStatus(Request $request, $id) {
        $izin = IzinPeserta::findOrFail($id);
        $izin->update(['status' => $request->status]);
    
        return redirect()->route('admin.izin.index')->with('success', 'Status izin diperbarui');
    }
    
}

