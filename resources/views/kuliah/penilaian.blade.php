@extends('dashboard.index')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="{{ url()->previous() }}" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Penilaian Mahasiswa</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
    <div class="row" style="margin-top:70px">
        <div class="col">
            <a href="/absensi" class="btn btn-primary w-100 mt-2 mb-2">
                <ion-icon name="checkmark-done-outline"></ion-icon>
                Absensi
            </a>
            <a href="/keaktifan" class="btn btn-primary w-100 mb-2">
                <ion-icon name="people-outline"></ion-icon>
                Keaktifan
            </a>
            <a href="/kuis" class="btn btn-primary w-100 mb-2">
                <ion-icon name="pencil-outline"></ion-icon>
                Kuis
            </a>
            <a href="/tugas" class="btn btn-primary w-100 mb-2">
                <ion-icon name="list-circle-outline"></ion-icon>
                Tugas
            </a>
            <a href="/rekap" class="btn btn-primary w-100" target="_blank">
                <ion-icon name="document-outline"></ion-icon>
                Rekap
            </a>
        </div>
    </div>
