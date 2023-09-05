<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'name' => 'Super',
            'lastname' => 'Administrador',
            'email' => 'diego.bolivar@codant.one',
            'nick' => 'SuperAdministrador',
            'company'=> 'Codant S.A.S',
            'password' => Hash::make('superadmin'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now()->toDateString(),
            'updated_at' => now()->toDateString()
        ]);

        $superadmin->assignRole('SuperAdmin');


        $admin = User::create([
            'name' => 'Maria Alejandra',
            'lastname' => 'Cast',
            'email' => 'marialecastf@gmail.com',
            'nick' => 'marialecast',
            'company'=> 'Hejdabil',
            'password' => Hash::make('Maria#hejdabil23*'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now()->toDateString(),
            'updated_at' => now()->toDateString()
        ]);

        $admin->assignRole('Administrador');


        $operador = User::create([
            'name' => 'Diego',
            'lastname' => 'Bolivar',
            'email' => 'dbolivarv90@gmail.com',
            'nick'=> 'DBolivarV90',
            'company'=> 'Codant S.A.S',
            'password' => Hash::make('DB-hejdabilling#23'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now()->toDateString(),
            'updated_at' => now()->toDateString()
        ]);

        $operador->assignRole('Operador');

        
        $client = User::create([
            'name' => 'Elon',
            'lastname' => 'Musk',
            'email' => 'elon@gmail.com',
            'nick' => 'ElonX',
            'company' => 'Space X',
            'password' => Hash::make('123456'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now()->toDateString(),
            'updated_at' => now()->toDateString()
        ]);

        $client->assignRole('Cliente'); 

        
    }
}
