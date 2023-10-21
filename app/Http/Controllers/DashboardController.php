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
        if (Auth::user()->role_id == '2') {
            $role = 'dosen';
            $kelas = Kelas::where('id_pembuat', Auth::user()->id)->get();

            return view('main.index', compact('kelas', 'role'));
        } else if (Auth::user()->role_id == '3') {
            $role = 'mahasiswa';
            $mm_kelas = Mm_kelas::where('id_mahasiswa', Auth::user()->id)->get();
            $kelas = [];
            foreach ($mm_kelas as $key => $value) {
                $kelas[] = Kelas::where('id', $value->id_kelas)->first();
            }

            return view('main.index', compact('kelas', 'role'));
        } else {
            return redirect()->route('auth.login');
        }
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
    public function downloadTugas($nama_file)
    {
        // Dapatkan path lengkap dari file yang akan didownload di dalam direktori storage
        $filePath = storage_path("app/public/tugas/{$nama_file}");

        // Cek apakah file ada di direktori storage
        if (!file_exists($filePath)) {
            return redirect('/dashboard')->with('error', 'File not found.');
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
    public function downloadPengumpulan($nama_file)
    {
        // Dapatkan path lengkap dari file yang akan didownload di dalam direktori storage
        $filePath = storage_path("app/public/pengumpulan/{$nama_file}");

        // Cek apakah file ada di direktori storage
        if (!file_exists($filePath)) {
            return redirect('/dashboard')->with('error', 'File not found.');
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