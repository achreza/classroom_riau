<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasMahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mm_kelas_mahasiswa')->insert(
            [
                [
                    'id_mahasiswa' => 1,
                    'id_kelas' => 1
                ]


            ]
        );
    }
}