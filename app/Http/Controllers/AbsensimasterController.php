<?php

namespace App\Http\Controllers;

use App\Models\Absensimaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class AbsensimasterController extends Controller
{
    public function index(Request $request)
    {
        $query = Absensimaster::query();
        $query->select('absensi.*', 'nama_matkul', 'nama_pertemuan', 'name');
        $query->join('matkul', 'absensi.matkul_id', '=', 'matkul.id');
        $query->join('pertemuan', 'absensi.pertemuan_id', '=', 'pertemuan.id');
        $query->join('mahasiswa', 'absensi.mahasiswa_id', '=', 'mahasiswa.id');
        $query->orderBy('id');
        if (!empty($request->matkul_id)) {
            $query->where('absensi.matkul_id', $request->matkul_id);
        }
        if (!empty($request->mahasiswa_id)) {
            $query->where('absensi.mahasiswa_id', $request->mahasiswa_id);
        }
        $absensimaster = $query->paginate(5);
        $matkul = DB::table('matkul')->get();
        $pertemuan = DB::table('pertemuan')->get();
        $mahasiswa = DB::table('mahasiswa')->get();
        return view('absensimaster.index', compact('absensimaster', 'matkul', 'pertemuan', 'mahasiswa'));
    }

    public function store(Request $request)
    {
        $matkul_id = $request->matkul_id;
        $pertemuan_id = $request->pertemuan_id;
        $mahasiswa_id = $request->mahasiswa_id;

        try {
            $data = [
                'matkul_id' => $matkul_id,
                'pertemuan_id' => $pertemuan_id,
                'mahasiswa_id' => $mahasiswa_id
            ];
            $simpan = DB::table('absensi')->insert($data);
            if ($simpan) {
                return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }
        } catch (\Exception $e) {
            // dd($e);
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $matkul = DB::table('matkul')->get();
        $pertemuan = DB::table('pertemuan')->get();
        $mahasiswa = DB::table('mahasiswa')->get();
        $absensimaster = DB::table('absensi')->where('id', $id)->first();
        return view('absensimaster.edit', compact('absensimaster', 'matkul', 'pertemuan', 'mahasiswa'));
    }

    public function update($id, Request $request)
    {
        $matkul_id = $request->matkul_id;
        $pertemuan_id = $request->pertemuan_id;
        $mahasiswa_id = $request->mahasiswa_id;
        $status = $request->status;
        $jam_masuk = $request->jam_masuk;

        try {
            $data = [
                'matkul_id' => $matkul_id,
                'pertemuan_id' => $pertemuan_id,
                'mahasiswa_id' => $mahasiswa_id,
                'status' => $status,
                'jam_masuk' => $jam_masuk
            ];
            $update = DB::table('absensi')->where('id', $id)->update($data);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
            }
        } catch (\Exception $e) {
            // dd($e);
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }
    }

    public function delete($id)
    {
        $delete = DB::table('absensi')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }
}
