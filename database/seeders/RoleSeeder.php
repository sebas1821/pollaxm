<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        //
        $rolAdministrador = Role::create(['name' => 'Administrador']);
        $rolJugador = Role::create(['name' => 'Jugador']);

        Permission::create(['name'=>'modulo-jornadas'])->syncRoles([$rolAdministrador]);
        Permission::create(['name'=>'modulo-pronosticos'])->syncRoles([$rolAdministrador,$rolJugador]);
        Permission::create(['name'=>'modulo-jugadores'])->syncRoles([$rolAdministrador]);
        Permission::create(['name'=>'modulo-resultados'])->syncRoles([$rolAdministrador,$rolJugador]);
        Permission::create(['name'=>'modulo-partidos'])->syncRoles([$rolAdministrador]);
        Permission::create(['name'=>'modulo-equipos'])->syncRoles([$rolAdministrador]);
        Permission::create(['name'=>'modulo-perfil'])->syncRoles([$rolAdministrador]);

       


        Permission::create(['name'=>'boton-agregarResultado'])->syncRoles([$rolAdministrador]);
        Permission::create(['name'=>'boton-bloquearPronostico'])->syncRoles([$rolAdministrador]);



       



        

    }
}
