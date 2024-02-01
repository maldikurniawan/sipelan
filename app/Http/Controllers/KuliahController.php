<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class KuliahController extends Controller
{
    public function editProfile()
    {
        $id = Auth::guard()->user()->id;
        $users = DB::table('users')->where('id', $id)->first();
        return view('kuliah.editProfile', compact('users'));
    }

    public function updateProfile(Request $request)
    {
        $id = Auth::guard()->user()->id;
        $name = $request->name;
        $nip = $request->nip;
        $no_hp = $request->no_hp;
        $email = $request->email;
        $password = Hash::make($request->password);
        $users = DB::table('users')->where('id', $id)->first();
        $request->validate([
            'foto' => 'nullable|image|mimes:png,jpg,jpeg'
        ]);
        if ($request->hasFile('foto')) {
            $foto = $nip . "_" . $name . "." . $request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $users->foto;
        }

        if (empty($request->password)) {
            $data = [
                'name' => $name,
                'nip' => $nip,
                'no_hp' => $no_hp,
                'email' => $email,
                'foto' => $foto
            ];
        } else {
            $data = [
                'name' => $name,
                'nip' => $nip,
                'no_hp' => $no_hp,
                'email' => $email,
                'password' => $password,
                'foto' => $foto
            ];
        }

        $update = DB::table('users')->where('id', $id)->update($data);
        if ($update) {
            if ($request->hasFile('foto')) {
                $folderPath = "public/uploads/dosen/";
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update']);
        } else {
            return Redirect::back()->with(['error' => 'Data Gagal Di Update']);
        }
    }

    public function matkul()
    {
        $matkul = DB::table('matkul')->orderBy('id')->get();
        return view('kuliah.matkul', compact('matkul'));
    }

    public function pertemuan(Request $request)
    {
        $id = $request->id;
        $pertemuan = DB::table('pertemuan')
            ->where('matkul_id', $id)
            ->orderBy('id')
            ->get();

        $waktupertemuan = DB::table('pertemuan')
            ->leftJoin('matkul', 'pertemuan.matkul_id', '=', 'matkul.id')
            ->select('hari_matkul', 'jam_matkul', 'lokasi_matkul')
            ->first();
        return view('kuliah.pertemuan', compact('pertemuan', 'waktupertemuan'));
    }

    public function detail(Request $request)
    {
        $hariini = date("Y-m-d");
        $id = $request->id;
        $detailpertemuan = DB::table('pertemuan')
            ->leftJoin('matkul', 'pertemuan.matkul_id', '=', 'matkul.id')
            ->select('tgl_pertemuan')
            ->first();
        return view('kuliah.detail', compact('detailpertemuan', 'hariini'));
    }

    public function modul(Request $request)
    {
        $id = $request->id;
        $modul = DB::table('modul')
            ->select('judul_modul', 'deskripsi')
            ->first();
        return view('kuliah.modul', compact('modul'));
    }

    public function penilaian()
    {
        return view('kuliah.penilaian');
    }

    public function keaktifan(Request $request)
    {
        $id = $request->id;
        $keaktifan = DB::table('keaktifan')
            ->join('matkul', 'keaktifan.matkul_id', '=', 'matkul.id')
            ->join('pertemuan', 'keaktifan.pertemuan_id', '=', 'pertemuan.id')
            ->join('mahasiswa', 'keaktifan.mahasiswa_id', '=', 'mahasiswa.id')
            ->orderBy('name')
            ->get();
        return view('kuliah.keaktifan', compact('keaktifan'));
    }

    public function kuis(Request $request)
    {
        $id = $request->id;
        $kuis = DB::table('kuis')
            ->join('matkul', 'kuis.matkul_id', '=', 'matkul.id')
            ->join('pertemuan', 'kuis.pertemuan_id', '=', 'pertemuan.id')
            ->join('mahasiswa', 'kuis.mahasiswa_id', '=', 'mahasiswa.id')
            ->orderBy('name')
            ->get();
        return view('kuliah.kuis', compact('kuis'));
    }

    public function tugas(Request $request)
    {
        $id = $request->id;
        $tugas = DB::table('tugas')
            ->join('matkul', 'tugas.matkul_id', '=', 'matkul.id')
            ->join('pertemuan', 'tugas.pertemuan_id', '=', 'pertemuan.id')
            ->join('mahasiswa', 'tugas.mahasiswa_id', '=', 'mahasiswa.id')
            ->orderBy('name')
            ->get();
        return view('kuliah.tugas', compact('tugas'));
    }
}
