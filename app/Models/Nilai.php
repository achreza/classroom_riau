<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{

    use HasFactory;
    protected $table = 'nilai';
    protected $guarded = [];

    public function pengumpulan()
    {
        return $this->belongsTo(Pengumpulan::class, 'id_pengumpulan', 'id');
    }
}