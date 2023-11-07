<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Pengumpulan;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\EmailPemberitahuan;
use App\Models\Mm_kelas;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tugas = '';
        return view('tugas', compact('tugas'));
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
        //file validation
        $request->validate([
            'file' => 'max:5120',
        ]);

        // if file greater than 5mb return error
        if ($request->file('file') != null) {
            if ($request->file('file')->getSize() > 5120000) {
                Alert::error('Gagal', 'File tidak boleh lebih dari 5MB');
                return redirect()->back();
            }
        }



        // check input file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('tugas', $filename, 'public');
        } else {
            $filename = null;
        }

        $tugas = Tugas::create([
            'id_kelas' => $request->id_kelas,
            'id_dosen' => Auth::user()->id,
            'nama_tugas' => $request->nama_tugas,
            'pertemuan' => $request->pertemuan,
            'tanggal_perkuliahan' => $request->tanggal_perkuliahan,
            'deskripsi' => $request->deskripsi,
            'file' => $filename,
            'kode_youtube' => $request->youtube,
            'deadline_date' => $request->deadline_date,
            'deadline_time' => $request->deadline_time,
        ]);


        $tugas->save();
        if ($tugas) {

            $users = Mm_kelas::where('id_kelas', $request->id_kelas)->get();
            $userdata = [];

            foreach ($users as $user) {
                $userdata[] = $user->id_mahasiswa;
            }
            $mahasiswa = User::whereIn('id', $userdata)->get();
            foreach ($mahasiswa as $user) {
                $nama = $user->name;
                $kelas = $user->kelas;
                $data = [
                    'subject' => "[IKTN Learning] Tugas baru Telah Ditambahkan",
                    'isi' => "
                Hai $nama! Tugas baru telah ditambahkan ke kelas $kelas. Jangan lupa untuk memeriksanya dan tetap terorganisir, jangan sampai melewatkan deadline. Mulai sekarang dan tunjukkan yang terbaik.",
                ];
                $email_user = request()->session()->get('email');
                Mail::to($email_user)->send(new EmailPemberitahuan($data));
            }


            Alert::success('Berhasil', 'Tugas berhasil dibuat');
            return redirect()->back();
        } else {
            Alert::error('Gagal', 'Tugas gagal dibuat');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $title = 'Hapus Tugas';
        $text = 'Apakah anda yakin ingin Hapus tugas ini?';
        confirmDelete($title, $text);
        if (Auth::user()->role_id == 3) {
            $tugas = Tugas::find($id);
            $pengumpulan = Pengumpulan::where('id_tugas', $id)->where('id_mahasiswa', Auth::user()->id)->first();
            $dateFormatted =  date('d-m-Y', strtotime($tugas->deadline_date));
            $tgl_perkuliahan = date('d-m-Y', strtotime($tugas->tanggal_perkuliahan));
            if ($pengumpulan != null) {
                $nilai = Nilai::where('id_pengumpulan', $pengumpulan->id)->first();

                return view('tugas.detail', compact('tugas', 'dateFormatted', 'pengumpulan', 'nilai', 'tgl_perkuliahan'));
            } else {

                return view('tugas.detail', compact('tugas', 'dateFormatted', 'pengumpulan', 'tgl_perkuliahan'));
            }
        } elseif (Auth::user()->role_id == 2) {
            $tugas = Tugas::find($id);
            $pengumpulan = Pengumpulan::where('id_tugas', $id)->get();
            $id_pengumpulan = $pengumpulan->pluck('id');
            $nilai = Nilai::whereIn('id_pengumpulan', $id_pengumpulan)->get();
            $dateFormatted =  date('d-m-Y', strtotime($tugas->deadline_date));
            $tgl_perkuliahan = date('d-m-Y', strtotime($tugas->tanggal_perkuliahan));
            return view('tugas.detail', compact('tugas', 'dateFormatted', 'pengumpulan', 'nilai', 'tgl_perkuliahan'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tugas $tugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tugas = Tugas::find($id);
        if ($tugas) {
            $tugas->update(request()->all());
            Alert::success('Berhasil', 'Tugas berhasil diupdate');
        } else {
            Alert::error('Gagal', 'Tugas gagal diupdate');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $id_kelas = Tugas::find($id)->id_kelas;
        Tugas::destroy($id);
        Alert::success('Berhasil', 'Tugas berhasil dihapus');
        return redirect()->route('kelas.show', ['kela' => $id_kelas]);
    }

    public function penilaian(Request $request, $id)
    {
        $nilai = Nilai::find($id);
        if ($nilai) {
            $nilai->update(request()->all());
            Alert::success('Berhasil', 'Nilai berhasil diupdate');
        } else {
            Alert::error('Gagal', 'Nilai gagal diupdate');
        }
        return redirect()->back();
    }
}
