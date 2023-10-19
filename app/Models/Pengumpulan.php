<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumpulan extends Model
{
    use HasFactory;
    protected $table = 'pengumpulan';
    protected $guarded = [];

    public function nilai()
    {
        return $this->hasOne(User::class, 'id');
    }
}