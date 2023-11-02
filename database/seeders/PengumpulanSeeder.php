<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengumpulanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengumpulan')->insert(
            [
                'id_tugas' => 1,
                'id_mahasiswa' => 1,
                'catatan' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto sint aperiam cumque modi odit numquam recusandae quaerat repellendus ea nemo quisquam esse enim qui delectus impedit at porro, rerum tenetur?',
                'file' => '1698941024.pdf',
                'pengumpulan' => '2021-10-07 13:41:00',
                'status' => 'Terlambat'
            ],


        );
    }
}