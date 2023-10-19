<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Dd;

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
            'tgl_mulai' => $request->deadline_date,
            'tgl_akhir' => $request->deadline_time,
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
    public function show($id)
    {
        $tugas = Tugas::find($id);

        $dateFormatted =  date('d-m-Y', strtotime($tugas->deadline_date));

        return view('tugas.detail', compact('tugas', 'dateFormatted'));
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
}