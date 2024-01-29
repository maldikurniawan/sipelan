<?php

namespace App\Http\Controllers;

use App\Models\Pertemuanmaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class PertemuanmasterController extends Controller
{
    public function index(Request $request)
    {
        $query = Pertemuanmaster::query();
        $query->select('pertemuan.*', 'nama_matkul');
        $query->join('matkul', 'pertemuan.matkul_id', '=', 'matkul.id');
        $query->orderBy('nama_pertemuan');
        if (!empty($request->nama_pertemuan)) {
            $query->where('nama_pertemuan', 'like', '%' . $request->nama_pertemuan . '%');
        }
        if (!empty($request->matkul_id)) {
            $query->where('pertemuan.matkul_id', $request->matkul_id);
        }
        $pertemuanmaster = $query->paginate(5);
        $matkul = DB::table('matkul')->get();
        return view('pertemuanmaster.index', compact('pertemuanmaster', 'matkul'));
    }

    public function store(Request $request)
    {
        $matkul_id = $request->matkul_id;
        $nama_pertemuan = $request->nama_pertemuan;
        $tgl_pertemuan = $request->tgl_pertemuan;

        try {
            $data = [
                'matkul_id' => $matkul_id,
                'nama_pertemuan' => $nama_pertemuan,
                'tgl_pertemuan' => $tgl_pertemuan
            ];
            $simpan = DB::table('pertemuan')->insert($data);
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
        $pertemuanmaster = DB::table('pertemuan')->where('id', $id)->first();
        return view('pertemuanmaster.edit', compact('pertemuanmaster', 'matkul'));
    }

    public function update($id, Request $request)
    {
        $id = $request->id;
        $matkul_id = $request->matkul_id;
        $nama_pertemuan = $request->nama_pertemuan;
        $tgl_pertemuan = $request->tgl_pertemuan;

        try {
            $data = [
                'matkul_id' => $matkul_id,
                'nama_pertemuan' => $nama_pertemuan,
                'tgl_pertemuan' => $tgl_pertemuan
            ];
            $update = DB::table('pertemuan')->where('id', $id)->update($data);
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
        $delete = DB::table('pertemuan')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }
}
