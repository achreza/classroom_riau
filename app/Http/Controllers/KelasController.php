<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mm_kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Dd;
use App\Models\Tugas;


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
        //
        $validated = $request->validate([
            'nama_kelas' => 'required',
            'deskripsi' => 'required',
        ]);

        $kelas = Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'deskripsi' => $request->deskripsi,
            'id_pembuat' => Auth::user()->id,
            'kode_kelas' => 'PPPP',
        ]);
        $kelas->save();
        if ($kelas) {
            return redirect()->route('dashboard.index');
        } else {
            return redirect()->route('kelas');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $list_mahasiswa = Mm_kelas::where('id_kelas', $id)->get();
        $tugas = Tugas::where('id_kelas', $id)->get();
        $kelas = Kelas::find($id);

        // change format date of $tugas->deadline_date to d-m-Y
        foreach ($tugas as $t) {
            $t->deadline_date = date('d-m-Y', strtotime($t->deadline_date));
        }

        return view('kelas.detail', compact('kelas', 'tugas', 'list_mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
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
            return redirect()->route('dashboard.index');
        } else {
            return view('kelas');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kelas)
    {
        //
        $kelas = Kelas::find($kelas);
        $kelas->delete();
        if ($kelas) {
            return redirect()->route('dashboard.index');
        } else {
            return view('kelas');
        }
    }
}