<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('class')->insert([
            ['nama_kelas' => '10A', 'kode_kelas' => '10A001'],
            ['nama_kelas' => '10B', 'kode_kelas' => '10B001'],
            ['nama_kelas' => '11A', 'kode_kelas' => '11A001'],
            ['nama_kelas' => '11B', 'kode_kelas' => '11B001'],
            ['nama_kelas' => '12A', 'kode_kelas' => '12A001'],
            ['nama_kelas' => '12B', 'kode_kelas' => '12B001'],
        ]);
    }
}
