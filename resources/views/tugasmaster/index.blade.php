@extends('dashboard.admin.index')
@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <h2 class="page-title">
                        Data Tugas
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
                                    <a href="#" class="btn btn-primary" id="tambahtugasmaster">
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
                                    <form action="/tugasmaster" method="GET">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <select name="matkul_id" class="form-select">
                                                        <option value="">Nama Mata Kuliah</option>
                                                        @foreach ($matkul as $d)
                                                            <option {{ Request('matkul_id') == $d->id ? 'selected' : '' }}
                                                                value="{{ $d->id }}">{{ $d->nama_matkul }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <select name="mahasiswa_id" class="form-select">
                                                        <option value="">Nama Mahasiswa</option>
                                                        @foreach ($mahasiswa as $d)
                                                            <option
                                                                {{ Request('mahasiswa_id') == $d->id ? 'selected' : '' }}
                                                                value="{{ $d->id }}">{{ $d->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                                                <th>Nama Mata Kuliah</th>
                                                <th>Nama Pertemuan</th>
                                                <th>Nama Mahasiswa</th>
                                                <th>Nilai</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($tugasmaster as $d)
                                                <tr>
                                                    <td>{{ $loop->iteration + $tugasmaster->firstItem() - 1 }}</td>
                                                    <td>{{ $d->nama_matkul }}</td>
                                                    <td>{{ $d->nama_pertemuan }}</td>
                                                    <td>{{ $d->name }}</td>
                                                    @if ($d->nilai_tugas != null)
                                                        <td>{{ $d->nilai_tugas }}</td>
                                                    @else
                                                        <td>-</td>
                                                    @endif
                                                    <td>
                                                        <div class="btn-group">
                                                            <form action="/tugasmaster/{{ $d->id }}/delete"
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
                                    {{ $tugasmaster->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Store --}}
    <div class="modal modal-blur fade" id="modal-inputtugasmaster" tabindex="-1" role="dialog"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Tugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/tugasmaster/store" method="POST" id="frmsiswa" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <select name="matkul_id" id="matkul_id" class="form-select">
                                    <option value="" hidden>Nama Mata Kuliah</option>
                                    @foreach ($matkul as $d)
                                        <option {{ Request('matkul_id') == $d->id ? 'selected' : '' }}
                                            value="{{ $d->id }}">{{ $d->nama_matkul }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <select name="pertemuan_id" id="pertemuan_id" class="form-select">
                                    <option value="" hidden>Nama Pertemuan</option>
                                    @foreach ($pertemuan as $d)
                                        <option {{ Request('pertemuan_id') == $d->id ? 'selected' : '' }}
                                            value="{{ $d->id }}">{{ $d->nama_pertemuan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <select name="mahasiswa_id" id="mahasiswa_id" class="form-select">
                                    <option value="" hidden>Nama Mahasiswa</option>
                                    @foreach ($mahasiswa as $d)
                                        <option {{ Request('mahasiswa_id') == $d->id ? 'selected' : '' }}
                                            value="{{ $d->id }}">{{ $d->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
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
    <div class="modal modal-blur fade" id="modal-edittugasmaster" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Tugas</h5>
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
            $("#tambahtugasmaster").click(function() {
                $("#modal-inputtugasmaster").modal("show");
            });

            $(".edit").click(function() {
                var id = $(this).attr('id');
                $.ajax({
                    type: 'POST',
                    url: '/tugasmaster/edit',
                    cache: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(respond) {
                        $("#loadeditform").html(respond);
                    }
                });
                $("#modal-edittugasmaster").modal("show");
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
                var matkul_id = $("#matkul_id").val();
                var pertemuan_id = $("#pertemuan_id").val();
                var name = $("#name").val();
                if (matkul_id == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Matkul Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    })
                    $("#matkul_id").focus();
                    return false;
                } else if (pertemuan_id == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Nama Pertemuan Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    })
                    $("#pertemuan_id").focus();
                    return false;
                } else if (name == "") {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Nama Mahasiswa Harus Diisi!',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    })
                    $("#name").focus();
                    return false;
                }
            });
        });
    </script>
@endpush
