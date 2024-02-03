<?php

namespace App\Http\Controllers;

use App\Models\Kuismaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KuismasterController extends Controller
{
    public function index(Request $request)
    {
        $query = Kuismaster::query();
        $query->select('kuis.*', 'nama_matkul', 'nama_pertemuan', 'name');
        $query->join('matkul', 'kuis.matkul_id', '=', 'matkul.id');
        $query->join('pertemuan', 'kuis.pertemuan_id', '=', 'pertemuan.id');
        $query->join('mahasiswa', 'kuis.mahasiswa_id', '=', 'mahasiswa.id');
        $query->orderBy('id');
        if (!empty($request->matkul_id)) {
            $query->where('kuis.matkul_id', $request->matkul_id);
        }
        if (!empty($request->mahasiswa_id)) {
            $query->where('kuis.mahasiswa_id', $request->mahasiswa_id);
        }
        $kuismaster = $query->paginate(5);
        $matkul = DB::table('matkul')->get();
        $pertemuan = DB::table('pertemuan')->get();
        $mahasiswa = DB::table('mahasiswa')->get();
        return view('kuismaster.index', compact('kuismaster', 'matkul', 'pertemuan', 'mahasiswa'));
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
            $simpan = DB::table('kuis')->insert($data);
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
        $kuismaster = DB::table('kuis')->where('id', $id)->first();
        return view('kuismaster.edit', compact('kuismaster', 'matkul', 'pertemuan', 'mahasiswa'));
    }

    public function update($id, Request $request)
    {
        $id = $request->id;
        $matkul_id = $request->matkul_id;
        $pertemuan_id = $request->pertemuan_id;
        $mahasiswa_id = $request->mahasiswa_id;

        try {
            $data = [
                'matkul_id' => $matkul_id,
                'pertemuan_id' => $pertemuan_id,
                'mahasiswa_id' => $mahasiswa_id
            ];
            $update = DB::table('kuis')->where('id', $id)->update($data);
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
        $delete = DB::table('kuis')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }
}
