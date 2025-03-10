<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminIzinController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\KehadiranRekapController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
});

Route::get('/dashboard', function () {
    // return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
});

// Route::middleware(['auth'])->group(function () {
//     Route::get('/Dashboard', [DashboardController::class, 'index'])->name('admin.Dashboard');
//     Route::get('/home', [KehadiranController::class, 'index'])->name('user.home');
// });


Route::get('/absensi', [AbsensiController::class, 'index']);
Route::get('/Dashboard', [DashboardController::class, 'index']);
Route::get('/absensi/create', [AbsensiController::class, 'create']);
Route::post('/absensi/create', [AbsensiController::class, 'store'])->name('absensi.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/izin', [IzinController::class, 'index'])->name('izin.daftar');
    Route::get('/izin/buat', [IzinController::class, 'buat'])->name('izin.buat');
    Route::post('/izin', [IzinController::class, 'simpan'])->name('izin.simpan');
    Route::delete('/izin/{id}', [IzinController::class, 'hapus'])->name('izin.hapus');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/peserta', [PesertaController::class, 'index'])->name('peserta.index'); // Tampilkan daftar peserta
    Route::get('/peserta/create', [PesertaController::class, 'create'])->name('peserta.create'); // Form tambah peserta
    Route::post('/peserta', [PesertaController::class, 'store'])->name('peserta.store'); // Simpan peserta baru
    Route::get('/peserta/{id}/edit', [PesertaController::class, 'edit'])->name('peserta.edit'); // Form edit peserta
    Route::put('/peserta/{id}', [PesertaController::class, 'update'])->name('peserta.update'); // Update data peserta
    Route::delete('/peserta/{id}', [PesertaController::class, 'destroy'])->name('peserta.destroy'); // Hapus peserta
});

Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class)->except(['edit', 'update']);
    Route::delete('/data/{id}', [UserController::class, 'destroy'])->name('data.destroy');
});

Route::middleware(['auth',])->group(function () {
    Route::get('/admin/izin', [AdminIzinController::class, 'index'])->name('admin.izin.index');
    Route::put('/admin/izin/{id}/update', [AdminIzinController::class, 'updateStatus'])->name('admin.izin.updateStatus');
    Route::get('/history', [IzinController::class, 'history'])->name('izin.history');
});

    Route::get('/home', [KehadiranController::class, 'index'])->name('home');
    Route::post('/absensi/masuk', [KehadiranController::class, 'absenMasuk'])->name('absensi.store');
    Route::post('/absensi/keluar', [KehadiranController::class, 'absenKeluar'])->name('absensi.keluar');
    Route::get('/kehadiran', [KehadiranRekapController::class, 'index'])->name('kehadiran.index');
    Route::delete('/kehadiran/{id}', [KehadiranRekapController::class, 'destroy'])->name('kehadiran.destroy');


require __DIR__.'/auth.php';
