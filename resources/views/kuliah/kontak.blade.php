@extends('dashboard.index')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="/home" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Daftar Kontak Dosen</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
    <style>
        .historicontent {
            display: flex;
        }

        .datapresensi {
            margin-left: 10px;
        }
    </style>
    <div class="row" style="margin-top:70px">
        <div class="col">
            @foreach ($dosen as $d)
                <div class="card mb-1">
                    <div class="card-body">
                        <div class="historicontent">
                            <div class="iconpresensi">
                                <ion-icon name="person-outline" style="font-size: 48px;" class="text-primary"></ion-icon>
                            </div>
                            <div class="datapresensi">
                                <h3 style="line-height: 3px">{{ $d->name }}</h3>
                                <h4 style="margin: 0px; !important">
                                    {{ $d->nip }}</h4>
                                <span>
                                    {{ $d->no_hp }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
