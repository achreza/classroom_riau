<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Models\Pengumpulan;
use App\Models\Tugas;
use RealRashid\SweetAlert\Facades\Alert;

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
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('pengumpulan', $filename, 'public');
        }


        $tugas = Tugas::find($id);

        // Mengambil zona waktu yang sesuai dengan lokasi Anda
        $zona_waktu = 'Asia/Jakarta'; // Ganti dengan zona waktu yang sesuai dengan lokasi Anda

        $sekarang = now($zona_waktu);

        if ($tugas->deadline_date < $sekarang->format('Y-m-d') && $tugas->deadline_time < $sekarang->format('H:i:s') || $tugas->deadline_date < $sekarang->format('Y-m-d') && $tugas->deadline_time > $sekarang->format('H:i:s') || $tugas->deadline_date == $sekarang->format('Y-m-d') && $tugas->deadline_time < $sekarang->format('H:i:s')) {
            $pengumpulan = Pengumpulan::create([
                'id_tugas' => $id,
                'id_mahasiswa' => auth()->user()->id,
                'file' => $filename,
                'catatan' => $request->catatan,
                'pengumpulan' => $sekarang,
                'status' => 'Terlambat',
            ]);
            $pengumpulan->save();
            $id_pengumpulan = $pengumpulan->id;
            Nilai::create([
                'id_pengumpulan' => $id_pengumpulan,
                'nilai' => 0,
            ]);
            Alert::success('Berhasil', 'Tugas berhasil dikumpulkan');
            return redirect()->back();
        } elseif ($tugas->deadline_date > $sekarang->format('Y-m-d') && $tugas->deadline_time > $sekarang->format('H:i:s') || $tugas->deadline_date == $sekarang->format('Y-m-d') && $tugas->deadline_time > $sekarang->format('H:i:s') || $tugas->deadline_date == $sekarang->format('Y-m-d') && $tugas->deadline_time == $sekarang->format('H:i:s')) {
            $pengumpulan = Pengumpulan::create([
                'id_tugas' => $id,
                'id_mahasiswa' => auth()->user()->id,
                'file' => $filename,
                'catatan' => $request->catatan,
                'pengumpulan' => $sekarang,
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