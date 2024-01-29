@extends('dashboard.admin.index')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Data Mata Kuliah
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @if (Session::get('success'))
                                        <div class="alert alert-success">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif

                                    @if (Session::get('warning'))
                                        <div class="alert alert-warning">
                                            {{ Session::get('warning') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a href="#" class="btn btn-primary" id="tambahmatkulmaster">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                        Tambah Data
                                    </a>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <form action="/matkulmaster" method="GET">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <input type="text" name="nama_matkul"
                                                        value="{{ Request('nama_matkul') }}" class="form-control"
                                                        placeholder="Nama Matkul">
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-search" width="24"
                                                            height="24" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                            <path d="M21 21l-6 -6" />
                                                        </svg>
                                                        Cari
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Matkul</th>
                                                <th>Hari Kuliah</th>
                                                <th>Jam Kuliah</th>
                                                <th>Lokasi Kuliah</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($matkulmaster as $d)
                                                <tr>
                                                    <td>{{ $loop->iteration + $matkulmaster->firstItem() - 1 }}</td>
                                                    <td>{{ $d->nama_matkul }}</td>
                                                    <td>{{ $d->hari_matkul }}</td>
                                                    <td>{{ date('H:i', strtotime($d->jam_matkul)) }}</td>
                                                    <td>{{ $d->lokasi_matkul }}</td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <form action="/matkulmaster/{{ $d->id }}/delete"
                                                                style="margin-left:5px" method="POST">
                                                                @csrf
                                                                <a href="#" class="edit btn btn-warning btn-sm"
                                                                    id="{{ $d->id }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="icon icon-tabler icon-tabler-edit"
                                                                        width="24" height="24" viewBox="0 0 24 24"
                                                                        stroke-width="2" stroke="currentColor"
                                                                        fill="none" stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path
                                                                            d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                                        <path
                                                                            d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                                        <path d="M16 5l3 3" />
                                                                    </svg>
                                                                </a>
                                                                <a class="btn btn-danger btn-sm delete-confirm">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="icon icon-tabler icon-tabler-trash"
                                                                        width="24" height="24" viewBox="0 0 24 24"
                                                                        stroke-width="2" stroke="currentColor"
                                                                        fill="none" stroke-linecap="round"
                                                                        stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M4 7l16 0" />
                                                                        <path d="M10 11l0 6" />
                                                                        <path d="M14 11l0 6" />
                                                                        <path
                                                                            d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                        <path
                                                                            d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                    </svg>
                                                                </a>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $matkulmaster->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Store --}}
    <div class="modal modal-blur fade" id="modal-inputmatkulmaster" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Mata Kuliah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/matkulmaster/store" method="POST" id="frmsiswa" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-book"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 19a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                                            <path d="M3 6a9 9 0 0 1 9 0a9 9 0 0 1 9 0" />
                                            <path d="M3 6l0 13" />
                                            <path d="M12 6l0 13" />
                                            <path d="M21 6l0 13" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="nama_matkul" name="nama_matkul"
                                        class="form-control" placeholder="Nama Mata Kuliah">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-calendar" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                                            <path d="M16 3v4" />
                                            <path d="M8 3v4" />
                                            <path d="M4 11h16" />
                                            <path d="M11 15h1" />
                                            <path d="M12 15v3" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="hari_matkul" name="hari_matkul"
                                        class="form-control" placeholder="Hari Kuliah">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                            <path d="M12 7v5l3 3" />
                                        </svg>
                                    </span>
                                    <input type="time" value="" id="jam_matkul" name="jam_matkul"
                                        class="form-control" placeholder="Jam Kuliah">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5" />
                                            <path d="M9 4v13" />
                                            <path d="M15 7v5.5" />
                                            <path
                                                d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" />
                                            <path d="M19 18v.01" />
                                        </svg>
                                    </span>
                                    <input type="text" value="" id="lokasi_matkul" name="lokasi_matkul"
                                        class="form-control" placeholder="Lokasi Kuliah">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="form-group">
                                    <button class="btn btn-primary w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 14l11 -11" />
                                            <path
                                                d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                                        </svg>
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal modal-blur fade" id="modal-editmatkulmaster" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data matkulmaster</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loadeditform">
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="{{ asset('tabler/dist/js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="{{ asset('tabler/dist/js/jquery-3.6.0.min.js') }}"></script>
@endsection

@push('myscript')
    <script>
        $(function() {
            $("#tambahmatkulmaster").click(function() {
                $("#modal-inputmatkulmaster").modal("show");
            });

            $(".edit").click(function() {
                var id = $(this).attr('id');
                $.ajax({
                    type: 'POST',
                    url: '/matkulmaster/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(respond) {
                        $("#loadeditform").html(respond);
                    }
                });
                $("#modal-editmatkulmaster").modal("show");
            });

            $(".delete-confirm").click(function(e) {
                var form = $(this).closest('form');
                e.preventDefault();
                Swal.fire({
                    title: "Apakah Anda Yakin?",
                    text: "Data Akan Dihapus Permanen!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Hapuskan!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire({
                            title: "Lenyap!",
                            text: "Data Berhasil Dilenyapkan",
                            icon: "success"
                        });
                    }
                });
            });

            $("#frmsiswa").submit(function() {
                var nama_matkul = $("#nama_matkul").val();
                var hari_matkul = $("#hari_matkul").val();
                var jam_matkul = $("#jam_matkul").val();
                var lokasi_matkul = $("#lokasi_matkul").val();
                if (nama_matkul == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Nama Mata Kuliah Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    })
                    $("#nama_matkul").focus();
                    return false;
                } else if (hari_matkul == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Hari Kuliah Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    })
                    $("#hari_matkul").focus();
                    return false;
                } else if (jam_matkul == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Jam Kuliah Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    })
                    $("#jam_matkul").focus();
                    return false;
                } else if (lokasi_matkul == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Lokasi Kuliah Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    })
                    $("#lokasi_matkul").focus();
                    return false;
                }
            });
        });
    </script>
@endpush
