@extends('dashboard.index')
@section('header')
    <style>
        .datepicker-modal {
            max-height: 465px !important;
        }
    </style>
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="/keaktifan" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Form Nilai</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
    <div class="row" style="margin-top:70px">
        <div class="col">
            <form method="POST" action="/keaktifan/{{ $dataaktif->id }}/update">
                @csrf
                <div class="form-group">
                    <input type="number" class="form-control" value="{{ $dataaktif->nilai_keaktifan }}" name="nilai_keaktifan" placeholder="Nilai Keaktifan"
                        autocomplete="off">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary w-100">Kirim</button>
                </div>
            </form>
        </div>
    </div>
@endsection
