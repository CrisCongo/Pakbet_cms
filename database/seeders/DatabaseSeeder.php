<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create default user
        User::factory()->create([
            'name' => 'two',
            'email' => 'two@mail.com',
            'password' => Hash::make('123456'),
        ]);

        // Seed the prosper_guides table
        $this->call(ProsperGuidesTableSeeder::class);
    }
}
