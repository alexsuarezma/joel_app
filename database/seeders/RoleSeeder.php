<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([ 'name' => 'Administrador' ]);
        $user = Role::create([ 'name' => 'Usuario' ]);

        Permission::create([ 'name' => 'usuario.index' ])->assignRole($admin);
        Permission::create([ 'name' => 'usuario.crear' ])->assignRole($admin);
        Permission::create([ 'name' => 'usuario.editar.basico' ])->assignRole($admin);
        Permission::create([ 'name' => 'usuario.editar.avanzado' ])->assignRole($admin);
        Permission::create([ 'name' => 'usuario.eliminar' ])->assignRole($admin);
        Permission::create([ 'name' => 'usuario.desactivar.activar' ])->assignRole($admin);

        Permission::create([ 'name' => 'rol.index' ])->assignRole($admin);
        Permission::create([ 'name' => 'rol.crear' ])->assignRole($admin);
        Permission::create([ 'name' => 'rol.editar.basico' ])->assignRole($admin);
        Permission::create([ 'name' => 'rol.editar.avanzado' ])->assignRole($admin);
        Permission::create([ 'name' => 'rol.eliminar' ])->assignRole($admin);
        Permission::create([ 'name' => 'rol.asignar' ])->assignRole($admin);
        Permission::create([ 'name' => 'rol.revocar' ])->assignRole($admin);
        
        Permission::create([ 'name' => 'cliente.index' ])->assignRole($admin);
        Permission::create([ 'name' => 'cliente.crear' ])->assignRole($admin);
        Permission::create([ 'name' => 'cliente.editar.basico' ])->assignRole($admin);
        Permission::create([ 'name' => 'cliente.editar.avanzado' ])->assignRole($admin);
        Permission::create([ 'name' => 'cliente.eliminar' ])->assignRole($admin);

        Permission::create([ 'name' => 'tipo.gasto.index' ])->assignRole($admin);
        Permission::create([ 'name' => 'tipo.gasto.crear' ])->assignRole($admin);
        Permission::create([ 'name' => 'tipo.gasto.editar.basico' ])->assignRole($admin);
        Permission::create([ 'name' => 'tipo.gasto.editar.avanzado' ])->assignRole($admin);
        Permission::create([ 'name' => 'tipo.gasto.eliminar' ])->assignRole($admin);
    }
}
