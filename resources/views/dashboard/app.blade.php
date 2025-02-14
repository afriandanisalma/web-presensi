@extends('template.main')

@section('breadcrumb_parent', 'Pages')
@section('breadcrumb_current', 'Dashboard')

@section('Dashboard', 'active bg-gradient-dark text-white')
@section('content')

<div class="row">
    <div class="ms-3">
      <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
      <p class="mb-4">Ringkasan Data Kehadiran</p>
    </div>
    
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
      <div class="card shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <p class="text-sm text-muted mb-0">Jumlah Peserta</p>
            <h3 class="mb-0">{{ $totalPeserta }}</h3>
          </div>
          <div class="d-flex align-items-center justify-content-center bg-primary text-white p-3 rounded-circle" style="width: 50px; height: 50px;">
            <i class="material-symbols-rounded" style="font-size: 2rem;">groups</i>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
      <div class="card shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <p class="text-sm text-muted mb-0">Jumlah Kehadiran</p>
            <h3 class="mb-0">0</h3>
          </div>
          <div class="d-flex align-items-center justify-content-center bg-success text-white p-3 rounded-circle" style="width: 50px; height: 50px;">
            <i class="material-symbols-rounded" style="font-size: 2rem;">check_circle</i>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-xl-4 col-sm-6">
      <div class="card shadow-sm">
        <div class="card-body d-flex justify-content-between align-items-center">
          <div>
            <p class="text-sm text-muted mb-0">Jumlah Izin</p>
            <h3 class="mb-0">{{ $totalIzinPeserta }}</h3>
          </div>
          <div class="d-flex align-items-center justify-content-center bg-warning text-white p-3 rounded-circle" style="width: 50px; height: 50px;">
            <i class="material-symbols-rounded" style="font-size: 2rem;">event_busy</i>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
