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
                            <h3>{{ $waktupertemuan[0]->hari_matkul }},
                                {{ date('H:i', strtotime($waktupertemuan[0]->jam_matkul)) }} WIB</h3>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="iconpresence col-2">
                            <ion-icon name="location"></ion-icon>
                        </div>
                        <div class="col-10" style="margin-top: 5px">
                            <h3>{{ $waktupertemuan[0]->lokasi_matkul }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <h3 class="mt-4" style="text-align: center">DAFTAR PERTEMUAN</h3>
            @foreach ($pertemuan as $d)
                @if ($d->nama_pertemuan == 'UTS')
                    <a href="#" class="btn btn-danger w-100 mb-2">{{ $d->nama_pertemuan }}</a>
                @elseif ($d->nama_pertemuan == 'UAS')
                    <a href="#" class="btn btn-danger w-100 mb-5">{{ $d->nama_pertemuan }}</a>
                @else
                    <a href="/matkul/{{ $d->matkul_id }}/pertemuan/{{ $d->id }}/detail"
                        class="btn btn-primary w-100 mb-2">{{ $d->nama_pertemuan }}</a>
                @endif
            @endforeach
        </div>
    </div>
