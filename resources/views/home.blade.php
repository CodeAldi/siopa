@extends('layouts.main')
@push('page-css')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
@endpush
@section('content')
@if (Auth()->user()->hasRole('admin'))

<div class="container mt-2">
    <div class="row">
        <div class="card bg-info text-white col me-2">
            <h5 class="card-header text-white">Pengurus</h5>
            <div class="card-body">
                jumlah :{{ $pengurus }}
            </div>
        </div>
        <div class="card bg-success text-white col me-2">
            <h5 class="card-header text-white">Anggota</h5>
            <div class="card-body">
                jumlah : {{ $anggota }}
            </div>
        </div>
        <div class="card bg-warning text-white col me-2">
            <h5 class="card-header text-white">Masyarakat</h5>
            <div class="card-body">
                jumlah : {{ $masyarakat }}
            </div>
        </div>
    </div>
</div>
@else
<div class="container mt-2">
    <div class="card">
        <h5 class="card-header">Keuangan</h5>
        <div class="card-body">
            Total Uang Kas : Rp.{{ number_format($total) }}
        </div>
    </div>
</div>
<div class="container mt-2">
    <div class="card rounded-pill">
        <h5 class="card-header text-center text-uppercase">Jadwal Kegiatan</h5>
    </div>
</div>
<div class="container mt-2">
    <div class="card">
        <div class="card-body">
            <div id='calendar'></div>   
        </div>
    </div>
</div>
@endif
@endsection
@if (!Auth()->user()->hasRole('admin'))
@push('page-js')
    <script>
        var dataEvent = @json($event);
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'id',
                timeZone: 'Asia/Jakarta',
                initialView: 'dayGridMonth',
                events: dataEvent,
                headerToolbar: {
                start: 'today prev next', // will normally be on the left. if RTL, will be on the right
                center: 'title',
                end: 'dayGridMonth listWeek' // will normally be on the right. if RTL, will be on the left
                },
                nowIndicator: true,
                eventTextColor : 'white',
                eventDisplay : 'block',
            });
            calendar.render();
          });

    </script>
@endpush
@endif