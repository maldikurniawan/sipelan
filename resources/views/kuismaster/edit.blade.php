<form action="/kuismaster/{{ $kuismaster->id }}/update" method="POST" id="frmkuismaster"
    enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <select name="matkul_id" id="matkul_id" class="form-select">
                <option value="" hidden>Nama Mata Kuliah</option>
                @foreach ($matkul as $d)
                    <option {{ $kuismaster->matkul_id == $d->id ? 'selected' : '' }} value="{{ $d->id }}">
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
                    <option {{ $kuismaster->pertemuan_id == $d->id ? 'selected' : '' }}
                        value="{{ $d->id }}">
                        {{ $d->nama_pertemuan }}
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
                    <option {{ $kuismaster->mahasiswa_id == $d->id ? 'selected' : '' }}
                        value="{{ $d->id }}">
                        {{ $d->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mt-3">
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
