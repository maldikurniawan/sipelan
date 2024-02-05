@extends('dashboard.index')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="/penilaian" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Absensi</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
    <div class="row" style="margin-top:70px">
        <div class="col">
            @php
                $messagesuccess = Session::get('success');
                $messageerror = Session::get('error');
            @endphp
            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ $messagesuccess }}
                </div>
            @endif
            @if (Session::get('error'))
                <div class="alert alert-danger">
                    {{ $messageerror }}
                </div>
            @endif
        </div>
    </div>
    <h3 class="mt-2" style="text-align: center">TABEL ABSENSI</h3>
    <div class="card mb-2">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Nama</th>
                        <th>Waktu</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($absensi as $d)
                        @php
                            $path = Storage::url('uploads/absensi/' . $d->foto_masuk);
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->name }}</td>
                            <td>{{ date('H:i', strtotime($d->jam_masuk)) }}</td>
                            <td>
                                @if (empty($d->foto_masuk))
                                    <img src="{{ asset('assets/img/nophoto.jpg') }}" width="30px" alt="">
                                @else
                                    <img src="{{ url($path) }}" width="30px" alt="">
                                @endif
                            </td>
                            <td>
                                <a href="/absensi/{{ $d->id }}/kamera" class="btn btn-primary btn-sm">
                                    <ion-icon name="camera-outline"></ion-icon>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
