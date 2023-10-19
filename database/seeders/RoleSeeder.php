<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert(
            [
                ['nama_role' => 'Admin'],
                ['nama_role' => 'Dosen'],
                ['nama_role' => 'Mahasiswa'],
            ]
        );
    }
}