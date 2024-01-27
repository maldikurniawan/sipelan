@extends('dashboard.index')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="/home" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Daftar Mata Kuliah</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
    <div class="row" style="margin-top:70px">
        <div class="col">
            @foreach ($matkul as $d)
                <div class="card mb-2">
                    <div class="card-body">
                        <a href="/matkul/{{ $d->id }}/pertemuan"
                            class="btn btn-primary w-100">{{ $d->nama_matkul }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
