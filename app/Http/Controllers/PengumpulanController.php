<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use Illuminate\Http\Request;
use App\Models\Pengumpulan;

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
        $file = $request->file('file');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('pengumpulan', $filename, 'public');
        $pengumpulan = Pengumpulan::create([
            'id_tugas' => $id,
            'id_mahasiswa' => auth()->user()->id,
            'file' => $filename,
            'catatan' => $request->catatan,
            'pengumpulan' => now(),
        ]);
        $pengumpulan->save();
        $id_pengumpulan = $pengumpulan->id;
        Nilai::create([
            'id_pengumpulan' => $id_pengumpulan,
            'nilai' => 0,
        ]);
        return redirect()->back();
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
        return redirect()->back();
    }
}