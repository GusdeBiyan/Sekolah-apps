<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++) {
            DB::table('students')->insert([
                'nama' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'nisn' => $faker->unique()->numerify('##########'),
                'class_id' => rand(1, 5), // Asumsi ada 5 kelas
                'tanggal_lahir' => $faker->date('Y-m-d', '2010-12-31'),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'alamat' => $faker->address,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
