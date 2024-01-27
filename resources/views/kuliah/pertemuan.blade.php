@extends('dashboard.index')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="/matkul" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Halaman Pertemuan</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
    <div class="row" style="margin-top:70px">
        <div class="col">
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="iconpresence col-2">
                            <ion-icon name="time"></ion-icon>
                        </div>
                        <div class="col-10" style="margin-top: 5px">
                            <h3>Waktu</h3>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="iconpresence col-2">
                            <ion-icon name="location"></ion-icon>
                        </div>
                        <div class="col-10" style="margin-top: 5px">
                            <h3>Lokasi</h3>
                        </div>
                    </div>
                </div>
            </div>
            <h3 style="text-align: center">DAFTAR PERTEMUAN</h3>
            @foreach ($pertemuan as $d)
                <div class="card mb-2">
                    <div class="card-body">
                        <a href="/pertemuan/{{ $d->id }}/detail"
                            class="btn btn-primary w-100">{{ $d->nama_pertemuan }}</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
