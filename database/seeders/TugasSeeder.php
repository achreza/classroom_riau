<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tugas')->insert(
            [
                'id_kelas' => 1,
                'id_dosen' => 2,
                'nama_tugas' => 'Tugas Membuat Halaman Landing Page',
                'pertemuan' => 1,
                'tanggal_perkuliahan' => '2021-10-07',
                'file' => "1697609400.pdf",
                'kode_youtube' => "9hZ5gE_LEtE",
                'deskripsi' => "<div><strong>&nbsp;Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo, obcaecati facere sequi exercitationem a deserunt? Architecto sapiente voluptatibus, soluta illum itaque enim adipisci, accusamus, et inventore exercitationem assumenda magnam natus qui ipsum animi?<br><br>&nbsp;</strong></div><div><em>Cum repellat temporibus</em> rem itaque inventore laborum ratione possimus quod repudiandae sit in ea iste molestiae ipsam id, sunt eveniet quaerat hic laudantium mollitia beatae commodi numquam, ex obcaecati! Recusandae asperiores impedit quasi quo sed optio saepe illum eos porro, officia aut, obcaecati ad assumenda aperiam quibusdam! Id nulla enim quod optio nihil explicabo, temporibus repellendus. Laborum rem a recusandae, iusto maiores officia quibusdam voluptatum nihil. Labore rem quod</div><ol><li>laboriosam. Est quas consequatur facilis quos delectus! Rem rerum adipisci qui. A doloribus iure illum ex doloremque, sit voluptatibus nobis eos ut voluptatum laboriosam facilis, enim ullam debitis eum mollitia!</li><li>Consequatur, porro aliquid facilis fuga libero at asperiores? Sint, dicta! Rerum sequi beatae doloribus sunt error, dignissimos accusantium inventore facere sit nam laboriosam corrupti ab minima commodi a omnis! Accusamus nam omnis laudantium maxime itaque fuga incidunt. Repellat officiis atque voluptate sint id</li><li>illo quam doloribus ut. Voluptas nulla, quia labore incidunt, suscipit harum saepe repudiandae, eveniet velit illum et id vitae? Doloribus cum nesciunt modi aliquid eaque!</li></ol>",
                'deadline_date' => "2023-11-04",
                'deadline_time' => "23:00:00",
            ],


        );
    }
}