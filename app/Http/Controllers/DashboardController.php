<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Kelas;
use App\Models\Mm_kelas;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //list kelas where mm_kelas.id_mahasiswa = auth()->user()->id
        $mm_kelas = Mm_kelas::where('id_mahasiswa', Auth::user()->id)->get();
        $kelas = [];
        foreach ($mm_kelas as $key => $value) {
            $kelas[] = Kelas::where('id', $value->id_kelas)->first();
        }


        $name = Auth::user()->name;
        return view('dashboard', compact('kelas', 'name'));
    }

    public function detailKelas($id_kelas)
    {
        $kelas = Kelas::where('id', $id_kelas)->first();
        $tugas = Tugas::where('id_kelas', $id_kelas)->get();
        return view('detail_kelas', compact('kelas', 'tugas'));
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Dashboard $dashboard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dashboard $dashboard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dashboard $dashboard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dashboard $dashboard)
    {
        //
    }
}
