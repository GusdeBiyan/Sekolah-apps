<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;
use Database\Seeders\ClassSeeder;
use Database\Seeders\TeacherSeeder;
use Database\Seeders\StudentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('12345678') // Tentukan password secara manual
        ]);

        $this->call([
            ClassSeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,
        ]);
    }
}
