<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'fullName' => 'Aurelio Muzzi',
            'login' => 'aurelio',
            'email' => 'aurelio.muzzi@atxsolucoes.com',
            'password' => bcrypt('123'),
            'status' => 1,
            'profile' => 1
        ]);

        User::factory(6)->create();
        Task::factory(50)->create();
    }
}
