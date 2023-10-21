<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mm_kelas extends Model
{
    protected $table = 'mm_kelas_mahasiswa'; // Nama tabel yang sesuai

    protected $fillable = [
        'id_mahasiswa', 'id_kelas',
    ];

    // Definisikan relasi ke tabel 'users' (Mahasiswa)
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'id_mahasiswa');
    }

    // Definisikan relasi ke tabel 'kelas'
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
