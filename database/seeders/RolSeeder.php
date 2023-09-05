<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['SuperAdmin','Administrador', 'Operador', 'Cliente'];

        foreach($roles as $role){
            Role::create(['name' => $role]);
        }

    }
}
