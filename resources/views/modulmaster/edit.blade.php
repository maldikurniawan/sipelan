<form action="/modulmaster/{{ $modulmaster->id }}/update" method="POST" id="frmmodulmaster" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <select name="matkul_id" id="matkul_id" class="form-select">
                <option value="" hidden>Nama Mata Kuliah</option>
                @foreach ($matkul as $d)
                    <option {{ $modulmaster->matkul_id == $d->id ? 'selected' : '' }} value="{{ $d->id }}">
                        {{ $d->nama_matkul }}
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
                    <option {{ $modulmaster->pertemuan_id == $d->id ? 'selected' : '' }} value="{{ $d->id }}">
                        {{ $d->nama_pertemuan }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-meteor" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M21 3l-5 9h5l-6.891 7.086a6.5 6.5 0 1 1 -8.855 -9.506l7.746 -6.58l-1 5l9 -5z" />
                        <path d="M9.5 14.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0" />
                    </svg>
                </span>
                <input type="text" value="{{ $modulmaster->judul_modul }}" id="judul_modul" name="judul_modul"
                    class="form-control" placeholder="Judul Modul">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-meteor" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M21 3l-5 9h5l-6.891 7.086a6.5 6.5 0 1 1 -8.855 -9.506l7.746 -6.58l-1 5l9 -5z" />
                        <path d="M9.5 14.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0" />
                    </svg>
                </span>
                <input type="text" value="{{ $modulmaster->deskripsi }}" id="deskripsi" name="deskripsi"
                    class="form-control" placeholder="Deskripsi">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <button class="btn btn-primary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24"
                        height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 14l11 -11" />
                        <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                    </svg>
                    Simpan
                </button>
            </div>
        </div>
    </div>
</form>
