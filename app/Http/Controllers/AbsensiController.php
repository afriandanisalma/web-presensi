<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
{
    $absensi = Absensi::with('siswa')->get();
    return view('absensi.index', compact('absensi'));
}
     
public function create()
{
    $absensi = Absensi::with('siswa')->get();
    $siswa =Siswa::all();
    return view('absensi.create', compact('siswa','absensi'));
}


public function store(Request $request)
{
    $request->validate([
        'siswa_id' => 'required',
        'date' => 'required',
        'status' => 'required',
    ]);

    $validated =[
        'siswa_id'=>$request->siswa_id,
        'date' =>$request->date,
        'status'=>$request->status,
    ];

    // dd($validated);

    Absensi::create($request->all());
    return redirect()->route('/absensi')->with('success', 'Data absensi berhasil ditambahkan.');
}
}
