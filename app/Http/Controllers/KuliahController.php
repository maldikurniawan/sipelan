<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\alert;

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
        $keaktifan = DB::table('keaktifan')
            ->select('keaktifan.*', 'name')
            ->join('mahasiswa', 'keaktifan.mahasiswa_id', '=', 'mahasiswa.id')
            ->orderBy('name')
            ->get();
        return view('kuliah.keaktifan', compact('keaktifan'));
    }

    public function editkeaktifan($id)
    {
        $dataaktif = DB::table('keaktifan')
            ->where('id', $id)
            ->first();
        return view('kuliah.editkeaktifan', compact('dataaktif'));
    }

    public function updatekeaktifan($id, Request $request)
    {
        $nilai_keaktifan = $request->nilai_keaktifan;
        if ($nilai_keaktifan >= 0 && $nilai_keaktifan <= 100) {
            try {
                $data = [
                    'nilai_keaktifan' => $nilai_keaktifan
                ];
                DB::table('keaktifan')->where('id', $id)->update($data);
                return redirect('keaktifan')->with(['success' => 'Data Berhasil Disimpan']);
            } catch (\Throwable $e) {
                return redirect('keaktifan')->with(['success' => 'Data Gagal Disimpan']);
            }
        } else {
            return redirect('keaktifan')->with(['success' => 'Input Angka 0-100!']);
        }
    }

    public function kuis(Request $request)
    {
        $id = $request->id;
        $kuis = DB::table('kuis')
            ->select('kuis.*', 'name')
            ->join('mahasiswa', 'kuis.mahasiswa_id', '=', 'mahasiswa.id')
            ->orderBy('name')
            ->get();
        return view('kuliah.kuis', compact('kuis'));
    }

    public function editkuis($id)
    {
        $datakuis = DB::table('kuis')
            ->where('id', $id)
            ->first();
        return view('kuliah.editkuis', compact('datakuis'));
    }

    public function updatekuis($id, Request $request)
    {
        $nilai_kuis = $request->nilai_kuis;
        if ($nilai_kuis >= 0 && $nilai_kuis <= 100) {
            try {
                $data = [
                    'nilai_kuis' => $nilai_kuis
                ];
                DB::table('kuis')->where('id', $id)->update($data);
                return redirect('kuis')->with(['success' => 'Data Berhasil Disimpan']);
            } catch (\Throwable $e) {
                return redirect('kuis')->with(['success' => 'Data Gagal Disimpan']);
            }
        } else {
            return redirect('kuis')->with(['success' => 'Input Angka 0-100!']);
        }
    }

    public function tugas(Request $request)
    {
        $id = $request->id;
        $tugas = DB::table('tugas')
            ->select('tugas.*', 'name')
            ->join('mahasiswa', 'tugas.mahasiswa_id', '=', 'mahasiswa.id')
            ->orderBy('name')
            ->get();
        return view('kuliah.tugas', compact('tugas'));
    }

    public function edittugas($id)
    {
        $datatugas = DB::table('tugas')
            ->where('id', $id)
            ->first();
        return view('kuliah.edittugas', compact('datatugas'));
    }

    public function updatetugas($id, Request $request)
    {
        $nilai_tugas = $request->nilai_tugas;
        if ($nilai_tugas >= 0 && $nilai_tugas <= 100) {
            try {
                $data = [
                    'nilai_tugas' => $nilai_tugas
                ];
                DB::table('tugas')->where('id', $id)->update($data);
                return redirect('tugas')->with(['success' => 'Data Berhasil Disimpan']);
            } catch (\Throwable $e) {
                return redirect('tugas')->with(['success' => 'Data Gagal Disimpan']);
            }
        } else {
            return redirect('tugas')->with(['success' => 'Input Angka 0-100!']);
        }
    }

    public function absensi(Request $request)
    {
        $id = $request->id;
        $absensi = DB::table('absensi')
            ->select('absensi.*', 'name')
            ->join('mahasiswa', 'absensi.mahasiswa_id', '=', 'mahasiswa.id')
            ->orderBy('name')
            ->get();
        return view('kuliah.absensi', compact('absensi'));
    }

    public function kamera($id)
    {
        $dataabsen = DB::table('absensi')
            ->where('id', $id)
            ->first();
        return view('kuliah.kamera', compact('dataabsen'));
    }

    public function store(Request $request)
    {
        $id = Auth::guard()->user()->id;
        $tgl_absensi = date("Y-m-d");
        $jam = date("H:i:s");
        $image = $request->image;
        $folderPath = "public/uploads/absensi/";
        $formatName =  $id . "-" . $tgl_absensi;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;
        // Storage::put($file, $image_base64);
        // echo "0";
        $data = [
            'status' => 'h',
            'jam_masuk' => $jam,
            'foto_masuk' => $fileName
        ];
        $update = DB::table('absensi')->where('id', $id)->update($data);
        if ($update) {
            echo "success|Terima Kasih, Sampai Jumpa|out";
            Storage::put($file, $image_base64);
        } else {
            echo "error|Maaf Gagal Absen, Silahkan Coba Lagi|out";
        }
    }

    public function rekap(Request $request)
    {
        $mahasiswa = DB::table('mahasiswa')->orderBy('name')->get();
        return view('kuliah.rekap', compact('mahasiswa'));
    }

    public function kontak()
    {
        $dosen = DB::table('users')->orderBy('name')->get();
        return view('kuliah.kontak', compact('dosen'));
    }

    public function jadwal()
    {
        $matkul = DB::table('matkul')->orderBy('nama_matkul')->get();
        return view('kuliah.jadwal', compact('matkul'));
    }

    public function rekapmaster()
    {
        $matkul = DB::table('matkul')->get();
        $pertemuan = DB::table('pertemuan')->get();
        return view('rekapmaster.rekapmaster', compact('matkul', 'pertemuan'));
    }

    public function cetakrekap(Request $request)
    {
        $mahasiswa = DB::table('mahasiswa')->orderBy('name')->get();
        return view('kuliah.rekap', compact('mahasiswa'));
    }
}
