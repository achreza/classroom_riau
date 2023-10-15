<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function store(Request $request, $id_kelas)
    {
        //
        dd($id_kelas);
        $validated = $request->validate([
            'nama_tugas' => 'required',
            'deskripsi' => 'required',
            'file' => 'required',
            'tgl_mulai' => 'required',
            'tgl_akhir' => 'required',
        ]);

        // check input file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/tugas', $filename);
        }

        $tugas = Tugas::create([
            'id_kelas' => $id_kelas,
            'id_dosen' => Auth::user()->id,
            'nama_tugas' => $request->nama_tugas,
            'deskripsi' => $request->deskripsi,
            'file' => $filename,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_akhir' => $request->tgl_akhir,
        ]);
        $tugas->save();
        if ($tugas) {
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->route('tugas');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tugas $tugas)
    {
        //
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
    public function update(Request $request, Tugas $tugas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tugas $tugas)
    {
        //
    }
}
