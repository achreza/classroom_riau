<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Revaldi Rahmatmulya',
                    'email' => 'revaldiaye@gmail.com',
                    'kode' => '200605110019',
                    'jurusan' => 'Teknik Informatika',
                    'remember_token' => 'ZuTdgk4binlRDdVrixL0pAaC5Met9PZRhivBkdeEILMFJUOi7HQxrYB0QpnE',
                    'role_id' => 3
                ],
                [
                    'name' => 'Emilia',
                    'email' => 'hiyorikiriga@gmail.com',
                    'kode' => '19786005061204',
                    'jurusan' => 'Teknik Informatika',
                    'remember_token' => 'CZbkU1AtwPfzcdp1hOMWWg4ZF1cmSQJd6kUWUokC6sHbVayUlcSC1rXk0Om6',
                    'role_id' => 2
                ],
            ]





        );
    }
}