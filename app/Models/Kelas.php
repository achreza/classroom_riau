<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $fillable = [
        'nama_kelas',
        'deskripsi',
        'id_pembuat',
        'kode_kelas',
        'kode_matakuliah'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pembuat', 'id');
    }
}
