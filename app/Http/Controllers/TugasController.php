<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Pengumpulan;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Dd;
use RealRashid\SweetAlert\Facades\Alert;

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
        //



        // check input file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('tugas', $filename, 'public');
        }

        $tugas = Tugas::create([
            'id_kelas' => $request->id_kelas,
            'id_dosen' => Auth::user()->id,
            'nama_tugas' => $request->nama_tugas,
            'deskripsi' => $request->deskripsi,
            'file' => $filename,
            'deadline_date' => $request->deadline_date,
            'deadline_time' => $request->deadline_time,
        ]);
        $tugas->save();
        if ($tugas) {
            Alert::success('Berhasil', 'Tugas berhasil dibuat');
            return redirect()->route('dashboard.index');
        } else {
            Alert::error('Gagal', 'Tugas gagal dibuat');
            return redirect()->route('tugas');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if (Auth::user()->role_id == 3) {
            $tugas = Tugas::find($id);
            $pengumpulan = Pengumpulan::where('id_tugas', $id)->where('id_mahasiswa', Auth::user()->id)->first();
            $dateFormatted =  date('d-m-Y', strtotime($tugas->deadline_date));
            return view('tugas.detail', compact('tugas', 'dateFormatted', 'pengumpulan'));
        } elseif (Auth::user()->role_id == 2) {
            $tugas = Tugas::find($id);
            $pengumpulan = Pengumpulan::where('id_tugas', $id)->get();
            $id_pengumpulan = $pengumpulan->pluck('id');
            $nilai = Nilai::whereIn('id_pengumpulan', $id_pengumpulan)->get();
            $dateFormatted =  date('d-m-Y', strtotime($tugas->deadline_date));
            return view('tugas.detail', compact('tugas', 'dateFormatted', 'pengumpulan', 'nilai'));
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
        $tugas->update($request->all());
        return redirect()->route('tugas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tugas $tugas)
    {
        //
    }

    public function penilaian(Request $request, $id)
    {
        $nilai = Nilai::find($id);
        $nilai->update([
            'nilai' => $request->nilai,
        ]);
        return redirect()->back();
    }
}