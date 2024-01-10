<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kelas')->insert(
            [
                'nama_kelas' => 'Kelas Pemrograman Web A',
                'deskripsi' => 'Kelas angkatan 2020 semester 4',
                'id_pembuat' => 2,
                'kode_matakuliah' => 'PMW-01A',
                'kode_kelas' => 'KJ776',
                'modul' => 'Modul 1',
            ],


        );
    }
}
