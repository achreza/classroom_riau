<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mm_kelas;
use App\Models\Pengumpulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Dd;
use App\Models\Tugas;
use RealRashid\SweetAlert\Facades\Alert;


class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $class = '';
        return view('kelas', compact('class'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $request->validate([
            'nama_kelas' => 'required',
            'deskripsi' => 'required',


        ]);


        //create ranndom 5 digit string and check if kode kelas already exist in kelas, if exist random again
        $kode_kelas = '';
        do {
            //generate a random string usually 5 digits
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $kode_kelas = substr(str_shuffle($permitted_chars), 0, 5);
        } while (Kelas::where('kode_kelas', $kode_kelas)->first());

        if ($request->file('modul') != null && $request->file('modul')->getSize() > 10120000) {

            Alert::error('Gagal', 'File tidak boleh lebih dari 10MB');
            return redirect()->back();
        }
        // check input file
        if ($request->hasFile('modul')) {
            $file = $request->file('modul');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('modul', $filename, 'public');
        } else {
            $filename = null;
        }




        $kelas = Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'deskripsi' => $request->deskripsi,
            'id_pembuat' => Auth::user()->id,
            'kode_kelas' => $kode_kelas,
            'kode_matakuliah' => $request->kode_matakuliah,
            'modul' => $filename,
        ]);


        $kelas->save();
        if ($kelas) {
            Alert::success('Sukses', 'Berhasil Menambah Kelas');
            return redirect()->back();
        } else {
            Alert::error('Error', 'Gagal Menambah Kelas');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $list_mahasiswa = Mm_kelas::where('id_kelas', $id)->get();
        $tugas = Tugas::where('id_kelas', $id)->get()->sortByDesc('created_at');
        $kelas = Kelas::find($id);

        // make confirmation alert
        $title = 'Keluar Kelas';
        $text = 'Apakah anda yakin ingin keluar dari kelas ini?';
        confirmDelete($title, $text);
        $status[] = '';
        // change format date of $tugas->deadline_date to d-m-Y
        foreach ($tugas as $t) {
            $t->deadline_date = date('d-m-Y', strtotime($t->deadline_date));
        }

        for ($i = 0; $i < count($tugas); $i++) {
            $cek_pengumpulan = Pengumpulan::where('id_tugas', $tugas[$i]->id)->where('id_mahasiswa', Auth::user()->id)->first();


            if (!empty($cek_pengumpulan)) {
                $status[$i] = 'Sudah Mengumpulkan';
            } else {
                $status[$i] = 'Belum Mengumpulkan';
            }
        }
        // $cek_pengumpulan = Pengumpulan::whereIn('id_tugas', $cek_tugas)->where('id_mahasiswa', Auth::user()->id)->get();
        // dd($cek_pengumpulan);




        $background = array(
            'image/bg1.jpg',
            'image/bg2.jpg',
            'image/bg3.png',
            'image/bg4.jpeg',
            'image/bg5.jpeg',
        );
        //get 1 random background name
        $rand = $background[array_rand($background)];

        return view('kelas.detail', compact('kelas', 'tugas', 'list_mahasiswa', 'rand', 'status'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    }

    public function joinkelas(Request $request)
    {
        // check if kode_kelas is exist
        $kelas = Kelas::where('kode_kelas', $request->kode_kelas)->first();

        if ($kelas) {
            $mm_kelas = Mm_kelas::create([
                'id_kelas' => $kelas->id,
                'id_mahasiswa' => Auth::user()->id,
            ]);
            $mm_kelas->save();
            if ($mm_kelas) {
                Alert::success('Sukses', 'Berhasil Bergabung Mata Kuliah');
                return redirect()->route('dashboard.index');
            } else {
                Alert::error('Error', 'Gagal Bergabung Mata Kuliah');
                return redirect()->route('kelas');
            }
        } else {
            //redirect back
            Alert::error('Error', 'Kode Mata Kuliah tidak ditemukan');
            return redirect()->back()->with('error', 'Kode Mata Kuliah tidak ditemukan');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kelas)
    {
        //
        $validated = $request->validate([
            'nama_kelas' => 'required',
            'deskripsi' => 'required',
        ]);

        $class = Kelas::find($kelas);
        $class->nama_kelas = $request->nama_kelas;
        $class->deskripsi = $request->deskripsi;
        $class->save();
        if ($class) {
            Alert::success('Sukses', 'Berhasil Mengubah Kelas');
            return redirect()->back();
        } else {
            Alert::error('Error', 'Gagal Mengubah Kelas');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function hapus_kelas($id)
    {

        $kelas = Kelas::find($id);
        $kelas->delete();
        if ($kelas) {
            Alert::success('Sukses', 'Berhasil Menghapus Kelas');
            return redirect()->route('dashboard.index');
        } else {
            Alert::error('Error', 'Gagal Menghapus Kelas');
            return redirect()->route('dashboard.index');
        }
    }
    public function delete($id)
    {
        Kelas::destroy($id);
        Alert::success('Sukses', 'Berhasil Menghapus Kelas');
        return redirect()->route('dashboard.index');
    }

    public function keluar($id)
    {
        $kelas = Mm_kelas::where('id_kelas', $id)->where('id_mahasiswa', Auth::user()->id)->first();
        $kelas->delete();
        Alert::success('Sukses', 'Berhasil Keluar Mata Kuliah');
        return redirect()->route('dashboard.index');
    }
    public function downloadModul($nama_file)
    {
        // Dapatkan path lengkap dari file yang akan didownload di dalam direktori storage
        $filePath = storage_path("app/public/modul/{$nama_file}");

        // Cek apakah file ada di direktori storage
        if (!file_exists($filePath)) {

            Alert::error('Error', 'File tidak ditemukan');
            return redirect()->back();
        }

        // Ambil nama file tanpa path
        $originalName = pathinfo($filePath, PATHINFO_FILENAME);

        // Dapatkan ekstensi file
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        // Mendefinisikan headers untuk response
        $headers = [
            'Content-Type' => mime_content_type($filePath),
            'Content-Disposition' => "attachment; filename=\"{$originalName}.{$extension}\"",
        ];

        // Return response dengan file untuk di-download
        return response()->file($filePath, $headers);
    }
}
