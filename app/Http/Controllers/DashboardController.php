<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Kehadiran;
use App\Models\IzinPeserta;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $totalPeserta = Peserta::count();
        $totalKehadiran = Kehadiran::count();
        $totalIzinPeserta = IzinPeserta::count();

       
        return view('dashboard.app', compact('totalPeserta','totalKehadiran',  'totalIzinPeserta'));
    }
}
