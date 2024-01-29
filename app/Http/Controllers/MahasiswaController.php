<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Mahasiswa::query();
        $query->select('mahasiswa.*', 'angkatan');
        $query->join('angkatan', 'mahasiswa.angkatan_id', '=', 'angkatan.angkatan_id');
        $query->orderBy('name');
        if (!empty($request->name)) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        $mahasiswa = $query->paginate(5);
        $angkatan = DB::table('angkatan')->get();
        return view('mahasiswa.index', compact('mahasiswa', 'angkatan'));
    }

    public function store(Request $request)
    {
        $id = $request->id;
        $npm = $request->npm;
        $name = $request->name;
        $angkatan_id = $request->angkatan_id;
        // $mahasiswa = DB::table('mahasiswa')->where('id', $id)->first();
        if ($request->hasFile('foto')) {
            $foto = $npm . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }

        try {
            $data = [
                'npm' => $npm,
                'name' => $name,
                'angkatan_id' => $angkatan_id,
                'foto' => $foto
            ];
            $simpan = DB::table('mahasiswa')->insert($data);
            if ($simpan) {
                if ($request->hasFile('foto')) {
                    $folderPath = "public/uploads/mahasiswa/";
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
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
        $angkatan = DB::table('angkatan')->get();
        $mahasiswa = DB::table('mahasiswa')->where('id', $id)->first();
        return view('mahasiswa.edit', compact('mahasiswa', 'angkatan'));
    }

    public function update($id, Request $request)
    {
        $id = $request->id;
        $npm = $request->npm;
        $name = $request->name;
        $angkatan_id = $request->angkatan_id;
        $old_foto = $request->old_foto;
        if ($request->hasFile('foto')) {
            $foto = $npm . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $old_foto;
        }

        try {
            $data = [
                'npm' => $npm,
                'name' => $name,
                'angkatan_id' => $angkatan_id,
                'foto' => $foto
            ];
            $update = DB::table('mahasiswa')->where('id', $id)->update($data);
            if ($update) {
                if ($request->hasFile('foto')) {
                    $folderPath = "public/uploads/mahasiswa/";
                    $folderPathOld = "public/uploads/mahasiswa/" . $old_foto;
                    Storage::delete($folderPathOld);
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
            }
        } catch (\Exception $e) {
            // dd($e);
            return Redirect::back()->with(['warning' => 'Data Gagal Diupdate']);
        }
    }

    public function delete($id)
    {
        $delete = DB::table('mahasiswa')->where('id', $id)->delete();
        if ($delete) {
            return Redirect::back()->with(['success' => 'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Dihapus']);
        }
    }
}
