@extends('dashboard.index')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="{{ url()->previous() }}" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Modul Pembelajaran</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
    <div class="row" style="margin-top:70px">
        <div class="col">
            <div class="card mb-2">
                <div class="card-body">
                    <h3>{{ $modul->judul_modul }}</h3>
                    <p style="text-align: justify">{{ $modul->deskripsi }}</p>
                </div>
            </div>
        </div>
    </div>
