@extends('layouts.main')
@section('content')
@if (Auth()->user()->hasRole('admin'))

<div class="container mt-2">
    <div class="row">
        <div class="card bg-info text-white col me-2">
            <h5 class="card-header text-white">Pengurus</h5>
            <div class="card-body">
                Lorem ipsum dolor sit amet.
            </div>
        </div>
        <div class="card bg-success text-white col me-2">
            <h5 class="card-header text-white">Anggota</h5>
            <div class="card-body">
                Lorem ipsum dolor sit amet.
            </div>
        </div>
        <div class="card bg-warning text-white col me-2">
            <h5 class="card-header text-white">Masyarakat</h5>
            <div class="card-body">
                Lorem ipsum dolor sit amet.
            </div>
        </div>
    </div>
</div>
@endif
@endsection