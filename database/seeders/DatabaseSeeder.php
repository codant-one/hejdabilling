<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = User::create([
            'name' => 'Maria Alejandra Cast',
            'email' => 'marialecastf@gmail.com',
            'password' => Hash::make('Hejdabilling*23#!'),
            'created_at' => now()->toDateString(),
            'updated_at' => now()->toDateString()
        ]);
    }
}
