<?php

namespace App\Http\Controllers;

use App\Models\Keaktifanmaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KeaktifanmasterController extends Controller
{
    public function index(Request $request)
    {
        $query = Keaktifanmaster::query();
        $query->select('keaktifan.*', 'nama_matkul', 'nama_pertemuan', 'name');
        $query->join('matkul', 'keaktifan.matkul_id', '=', 'matkul.id');
        $query->join('pertemuan', 'keaktifan.pertemuan_id', '=', 'pertemuan.id');
        $query->join('mahasiswa', 'keaktifan.mahasiswa_id', '=', 'mahasiswa.id');
        $query->orderBy('id');
        if (!empty($request->matkul_id)) {
            $query->where('keaktifan.matkul_id', $request->matkul_id);
        }
        if (!empty($request->mahasiswa_id)) {
            $query->where('keaktifan.mahasiswa_id', $request->mahasiswa_id);
        }
        $keaktifanmaster = $query->paginate(5);
        $matkul = DB::table('matkul')->get();
        $pertemuan = DB::table('pertemuan')->get();
        $mahasiswa = DB::table('mahasiswa')->get();
        return view('keaktifanmaster.index', compact('keaktifanmaster', 'matkul', 'pertemuan', 'mahasiswa'));
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
            $simpan = DB::table('keaktifan')->insert($data);
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
        $keaktifanmaster = DB::table('keaktifan')->where('id', $id)->first();
        return view('keaktifanmaster.edit', compact('keaktifanmaster', 'matkul', 'pertemuan', 'mahasiswa'));
    }

    public function update($id, Request $request)
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
            $update = DB::table('keaktifan')->where('id', $id)->update($data);
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
        $delete = DB::table('keaktifan')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }
}
