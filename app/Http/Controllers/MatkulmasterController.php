<?php

namespace App\Http\Controllers;

use App\Models\Matkulmaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class MatkulmasterController extends Controller
{
    public function index(Request $request)
    {
        $query = Matkulmaster::query();
        $query->select('matkul.*');
        $query->orderBy('nama_matkul');
        if (!empty($request->nama_matkul)) {
            $query->where('nama_matkul', 'like', '%' . $request->nama_matkul . '%');
        }
        $matkulmaster = $query->paginate(5);
        return view('matkulmaster.index', compact('matkulmaster'));
    }

    public function store(Request $request)
    {
        $nama_matkul = $request->nama_matkul;
        $hari_matkul = $request->hari_matkul;
        $jam_matkul = $request->jam_matkul;
        $lokasi_matkul = $request->lokasi_matkul;

        try {
            $data = [
                'nama_matkul' => $nama_matkul,
                'hari_matkul' => $hari_matkul,
                'jam_matkul' => $jam_matkul,
                'lokasi_matkul' => $lokasi_matkul
            ];
            $simpan = DB::table('matkul')->insert($data);
            if ($simpan) {
                return Redirect::back()->with(['success' => 'Data Berhasil Disimpan']);
            }
        } catch (\Exception $e) {
            dd($e);
            // return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->id;
        $matkulmaster = DB::table('matkul')->where('id', $id)->first();
        return view('matkulmaster.edit', compact('matkulmaster'));
    }

    public function update($id, Request $request)
    {
        $id = $request->id;
        $nama_matkul = $request->nama_matkul;
        $hari_matkul = $request->hari_matkul;
        $jam_matkul = $request->jam_matkul;
        $lokasi_matkul = $request->lokasi_matkul;

        try {
            $data = [
                'nama_matkul' => $nama_matkul,
                'hari_matkul' => $hari_matkul,
                'jam_matkul' => $jam_matkul,
                'lokasi_matkul' => $lokasi_matkul
            ];
            $update = DB::table('matkul')->where('id', $id)->update($data);
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
        $delete = DB::table('matkul')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }
}
