@extends('dashboard.index')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="/matkul" class="headerButton goBack">
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
            <a href="#" class="btn btn-primary w-100 mt-2 mb-2">
                Pengantar TI
            </a>
            <a href="#" class="btn btn-primary w-100">
                Materi Pertama
            </a>
        </div>
    </div>
