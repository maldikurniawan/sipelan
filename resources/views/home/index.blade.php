@extends('dashboard.index')
@section('content')
    <style>
        .logout {
            position: absolute;
            color: white;
            font-size: 30px;
            text-decoration: none;
            right: 8px;
        }

        .logout:hover {
            color: white;
        }
    </style>
    <div class="section" id="user-section">
        <a href="{{ route('logout') }}" class="logout"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            <ion-icon name="exit-outline"></ion-icon>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        <div id="user-detail">
            <div class="avatar">
                @if (!empty(Auth::guard()->user()->foto))
                    @php
                        $path = Storage::url('public/uploads/dosen/' . Auth::guard()->user()->foto);
                    @endphp
                    <img src="{{ url($path) }}" alt="avatar" class="imaged w64 rounded" style="height:60px">
                @else
                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
                @endif
            </div>
            <div id="user-info">
                <h3 id="user-name">{{ Auth::guard()->user()->name }}</h3>
                <span id="user-prodi">{{ Auth::guard()->user()->nip }}</span><br>
            </div>
        </div>
    </div>

    <div class="section" id="menu-section">
        <div class="card">
            <div class="card-body text-center">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/editProfile" class="green" style="font-size: 40px;">
                                <ion-icon name="person-sharp"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Profil</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="#" class="danger" style="font-size: 40px;">
                                <ion-icon name="call"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Kontak</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="#" class="warning" style="font-size: 40px;">
                                <ion-icon name="calendar"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Jadwal</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/matkul" class="orange" style="font-size: 40px;">
                                <ion-icon name="book"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            Matkul
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="section mt-2" id="presence-section">
        <div class="todaypresence">
            <h3>Jadwal Perkuliahan {{ date('d-m-Y', strtotime($hariini)) }}</h3>
            <div class="row">
                <div class="col-4">
                    <div class="card bg-primary">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    <ion-icon name="book"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h3 class="presencetitle">N/A</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card gradasigreen">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    <ion-icon name="time"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h3 class="presencetitle">N/A</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card gradasired">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    <ion-icon name="location"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h3 class="presencetitle">N/A</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="rekappresensi">
            <h3>Rekap Presensi {{ $namabulan[$bulanini] }} {{ $tahunini }}</h3>
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px 12px !important; line-height:0.8rem;">
                            <span class="badge bg-danger"
                                style="position: absolute; top:3px; right:3px; font-size:0.6rem; z-index:999"></span>
                            <ion-icon name="accessibility-outline" style="font-size: 1.6rem;"
                                class="text-primary"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Hadir</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px 12px !important; line-height:0.8rem;">
                            <span class="badge bg-danger"
                                style="position: absolute; top:3px; right:3px; font-size:0.6rem; z-index:999"></span>
                            <ion-icon name="calendar-outline" style="font-size: 1.6rem;" class="text-success"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Izin</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px 12px !important; line-height:0.8rem;">
                            <span class="badge bg-danger"
                                style="position: absolute; top:3px; right:3px; font-size:0.6rem; z-index:999"></span>
                            <ion-icon name="medkit-outline" style="font-size: 1.6rem;" class="text-warning"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Sakit</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px 12px !important; line-height:0.8rem;">
                            <span class="badge bg-danger"
                                style="position: absolute; top:3px; right:3px; font-size:0.6rem; z-index:999"></span>
                            <ion-icon name="alarm-outline" style="font-size: 1.6rem;" class="text-danger"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Telat</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="presencetab mb-5">
            <div id="chartdiv"></div>
        </div>
    </div>
@endsection
