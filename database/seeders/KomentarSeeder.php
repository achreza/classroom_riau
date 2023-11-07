<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KomentarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('komentar')->insert(
            [
                'id_tugas' => 1,
                'id_user' => 1,
                'komentar' => 'Ini komentar pertama',
                'created_at' => '2021-06-11 00:00:00',
                'updated_at' => '2021-06-11 00:00:00',
            ]
            );
    }
}
