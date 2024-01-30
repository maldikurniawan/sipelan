<?php

namespace App\Http\Controllers;

use App\Models\Modulmaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ModulmasterController extends Controller
{
    public function index(Request $request)
    {
        $query = Modulmaster::query();
        $query->select('modul.*', 'nama_matkul', 'nama_pertemuan');
        $query->leftJoin('pertemuan', 'modul.pertemuan_id', '=', 'pertemuan.id');
        $query->join('matkul', 'modul.matkul_id', '=', 'matkul.id');
        $query->orderBy('id');
        if (!empty($request->judul_modul)) {
            $query->where('judul_modul', 'like', '%' . $request->judul_modul . '%');
        }
        if (!empty($request->matkul_id)) {
            $query->where('modul.matkul_id', $request->matkul_id);
        }
        $modulmaster = $query->paginate(5);
        $matkul = DB::table('matkul')->get();
        $pertemuan = DB::table('pertemuan')->get();
        return view('modulmaster.index', compact('modulmaster', 'matkul', 'pertemuan'));
    }

    public function store(Request $request)
    {
        $matkul_id = $request->matkul_id;
        $pertemuan_id = $request->pertemuan_id;
        $judul_modul = $request->judul_modul;
        $deskripsi = $request->deskripsi;

        try {
            $data = [
                'matkul_id' => $matkul_id,
                'pertemuan_id' => $pertemuan_id,
                'judul_modul' => $judul_modul,
                'deskripsi' => $deskripsi
            ];
            $simpan = DB::table('modul')->insert($data);
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
        $modulmaster = DB::table('modul')->where('id', $id)->first();
        return view('modulmaster.edit', compact('modulmaster', 'matkul', 'pertemuan'));
    }

    public function update($id, Request $request)
    {
        $id = $request->id;
        $matkul_id = $request->matkul_id;
        $pertemuan_id = $request->pertemuan_id;
        $judul_modul = $request->judul_modul;
        $deskripsi = $request->deskripsi;

        try {
            $data = [
                'matkul_id' => $matkul_id,
                'pertemuan_id' => $pertemuan_id,
                'judul_modul' => $judul_modul,
                'deskripsi' => $deskripsi
            ];
            $update = DB::table('modul')->where('id', $id)->update($data);
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
        $delete = DB::table('modul')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }
}
