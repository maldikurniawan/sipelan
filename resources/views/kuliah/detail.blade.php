@extends('dashboard.index')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="{{ url()->previous() }}" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Detail Pertemuan</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
    <div class="row" style="margin-top:70px">
        <div class="col">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="iconpresence col-2">
                            <ion-icon name="time"></ion-icon>
                        </div>
                        <div class="col-10" style="margin-top: 5px">
                            <h3>{{ date('d-m-Y', strtotime($detailpertemuan[0]->tgl_pertemuan)) }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <a href="/matkul/{{ $modulpertemuan[0]->matkul_id }}/pertemuan/{{ $modulpertemuan[0]->pertemuan_id }}/detail/modul/{{ $modulpertemuan[0]->id }}"
                class="btn btn-primary w-100 mb-2">
                <ion-icon name="document-text-outline"></ion-icon>
                Modul Pembelajaran
            </a>
            <a href="/matkul/{{ $penilaian[0]->matkul_id }}/pertemuan/{{ $penilaian[0]->id }}/detail/penilaian"
                class="btn btn-primary w-100">
                <ion-icon name="pencil-outline"></ion-icon>
                Penilaian Mahasiwa
            </a>
        </div>
    </div>
