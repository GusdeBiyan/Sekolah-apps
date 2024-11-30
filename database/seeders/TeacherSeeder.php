<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Menggunakan locale Indonesia
        $statuses = ['aktif', 'non-aktif'];
        $classes = [1, 2, 3, 4, 5]; // Daftar ID kelas yang tersedia

        foreach (range(1, 10) as $index) {
            Teacher::create([
                'nama' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'mata_pelajaran' => $faker->randomElement(['Matematika', 'Bahasa Inggris', 'Fisika', 'Kimia', 'Sejarah']),
                'class_id' => $faker->randomElement($classes),
                'nomor_telepon' => $faker->numerify('08##########'),
                'status' => $faker->randomElement($statuses),
                'nip' => $faker->unique()->numerify('##################'), // 18 digit angka unik
                'tanggal_lahir' => $faker->dateTimeBetween('-60 years', '-25 years')->format('Y-m-d'),
                'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                'alamat' => $faker->address,
            ]);
        }
    }
}
