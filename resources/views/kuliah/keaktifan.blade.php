@extends('dashboard.index')
@section('header')
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="/penilaian" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Keaktifan</div>
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
    <h3 class="mt-2" style="text-align: center">TABEL PENILAIAN</h3>
    <div class="card mb-2">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No. </th>
                        <th>Nama</th>
                        <th>Nilai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($keaktifan as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $d->name }}</td>
                            <td>
                                @if ($d->nilai_keaktifan != null)
                                    {{ $d->nilai_keaktifan }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editkeaktifan">
                                    <ion-icon name="pencil-outline"></ion-icon>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade dialogbox" id="editkeaktifan" data-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Keaktifan</h5>
                </div>
                <form method="POST" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="number" class="form-control" value="" name="nilai_keaktifan"
                                placeholder="Nilai Keaktifan" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="btn-inline">
                            <a href="#" class="btn btn-text-secondary" data-dismiss="modal">Batalkan</a>
                            <a href="" class="btn btn-text-primary" id="kirimdata">Kirim</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
