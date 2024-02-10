<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
          'name' => 'John Doe',
          'email' => 'john@example.com',
          'password' => Hash::make('secret'), // Hashing the password
        ]);

        $users = User::all();

        // Create dummy tasks
        foreach ($users as $user) {
            Task::create([
                'name' => 'Task for ' . $user->name,
                'description' => 'Dummy task description',
                'status' => 'Pending',
                'assign_to' => $user->id,
            ]);
        }
    }
}
