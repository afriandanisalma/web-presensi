@extends('template.main')

@section('breadcrumb_parent', 'Home')
@section('breadcrumb_current', 'Home')

@section('home', 'active bg-gradient-purple text-white')

@section('content')
<div class="container">
    <div class="text-center btn-purple text-white p-4 rounded">
        <h2>Absensi</h2>
        <h3 id="clock">{{ now()->format('H:i') }}</h3>
        <p>{{ now()->translatedFormat('l, d F Y') }}</p>
    </div>

    <div class="card mt-4 p-4">
        <div class="row">
            <div class="col-md-6">
                <label for="start_time" class="form-label">Start Time</label>
                <input type="text" class="form-control" value="10:00" readonly>
            </div>
            <div class="col-md-6">
                <label for="end_time" class="form-label">End Time</label>
                <input type="text" class="form-control" value="16:00" readonly>
            </div>
        </div>

        <div class="text-center mt-3">
            @if(!$kehadiran)
                <form action="{{ route('absensi.store') }}" method="POST">
                    @csrf
                    <button type="submit" class=" btn btn-purple text-white">Clock In (Masuk)</button>
                </form>
            @elseif(!$kehadiran->waktu_keluar)
                <form action="{{ route('absensi.keluar') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-purple text-white">Clock Out (Keluar)</button>
                </form>
            @else
                <button class="btn btn-secondary w-100" disabled>Absen Selesai</button>
            @endif
        </div>
    </div>
        
    <script>
        function updateClock() {
            let now = new Date();
            document.getElementById("clock").innerText = now.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'});
        }
        setInterval(updateClock, 1000);
    </script> 



@endsection
