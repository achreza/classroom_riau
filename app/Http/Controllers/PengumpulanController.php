<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Models\Pengumpulan;
use App\Models\Tugas;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\EmailPemberitahuan;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class PengumpulanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $id)
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
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('pengumpulan', $filename, 'public');
        }
        $tugas = Tugas::find($id);

        if ($tugas->deadline_date < now()->format('Y-m-d') && $tugas->deadline_time < now()->format('H:i:s') || $tugas->deadline_date < now()->format('Y-m-d') && $tugas->deadline_time > now()->format('H:i:s') || $tugas->deadline_date == now()->format('Y-m-d') && $tugas->deadline_time < now()->format('H:i:s')) {
            $pengumpulan = Pengumpulan::create([
                'id_tugas' => $id,
                'id_mahasiswa' => auth()->user()->id,
                'file' => $filename,
                'catatan' => $request->catatan,
                'pengumpulan' => now()->format('Y-m-d H:i:s'),
                'status' => 'Terlambat',
            ]);

            $pengumpulan->save();
            $id_pengumpulan = $pengumpulan->id;
            Nilai::create([
                'id_pengumpulan' => $id_pengumpulan,
                'nilai' => 0,
            ]);
            //email
            $dosen = User::where('id', $tugas->id_dosen)->first();
            $emaildosen = $dosen->email;
            $namamahasiswa = auth()->user()->name;
            $kelas = $tugas->kelas->nama_kelas;
            $data = [
                'subject' => "[IKTN Learning] Tugas baru Telah Ditambahkan",
                'isi' => "
                Halo, Anda menerima tugas baru dari $namamahasiswa yang terdaftar di kelas $kelas dengan Status Terlambat.  Silakan cek tugasnya.",
            ];
            $email_user = request()->session()->get('email');
            Mail::to($emaildosen)->send(new EmailPemberitahuan($data));

            Alert::success('Berhasil', 'Tugas berhasil dikumpulkan');
            return redirect()->back();
        } elseif ($tugas->deadline_date > now()->format('Y-m-d') && $tugas->deadline_time > now()->format('H:i:s') || $tugas->deadline_date == now()->format('Y-m-d') && $tugas->deadline_time > now()->format('H:i:s') || $tugas->deadline_date == now()->format('Y-m-d') && $tugas->deadline_time == now()->format('H:i:s')) {
            $pengumpulan = Pengumpulan::create([
                'id_tugas' => $id,
                'id_mahasiswa' => auth()->user()->id,
                'file' => $filename,
                'catatan' => $request->catatan,
                'pengumpulan' => now()->format('Y-m-d H:i:s'),
                'status' => 'Selesai',
            ]);

            $pengumpulan->save();
            $id_pengumpulan = $pengumpulan->id;
            Nilai::create([
                'id_pengumpulan' => $id_pengumpulan,
                'nilai' => 0,
            ]);
            Alert::success('Berhasil', 'Tugas berhasil dikumpulkan');
            return redirect()->back();
        } else {
            Alert::error('Gagal', 'Tugas gagal dikumpulkan');
            return redirect()->back();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Pengumpulan::destroy($id);
        Alert::success('Berhasil', 'Tugas berhasil dihapus');
        return redirect()->back();
    }
}
