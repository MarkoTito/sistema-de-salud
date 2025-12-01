<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $permisos=[
            //permisos de administrador
            'all-salud',
            'all-mascota',

            'view-historial',
            'all-configuracion',

            //Campañas
            'view-campañas',
            'create-campañas',
            'read-campañas',
            'update-campañas',
            'delete-campñas',
            'admin-campañas',

            //asitestes
            'view-asitentes',
            'create-asitentes',
            'update-asitentes',
            'read-asitentes',
            'delete-asitentes',
            //Charlas
            'view-charlas',
            'create-charlas',
            'update-charlas',
            'read-charlas',
            'agregar-evidencia',
            'delete-charlas',
            'admin-charlas',
            //Mascotas
            'view-mascotas',
            'create-mascotas',
            'update-mascotas',
            'read-mascotas',
            'delete-mascotas',
            //configuracion
            'all-configuration-Campañas',
            'all-configuration-Charlas',
            'all-configuration-Expositores'
        ];

        foreach ($permisos as $permi) {
            Permission::create(['name' => $permi]);
        }
        //admin
        Role::create(['name' => 'admin'])
            ->givePermissionTo(Permission::all());
        //ve todo salud
        Role::create(['name' => 'all-salud'])
            ->givePermissionTo([
                'all-salud',
                'view-campañas',
                'create-campañas',
                'update-campañas',
                'read-campañas',
                'delete-campñas',
                'view-asitentes',
                'create-asitentes',
                'update-asitentes',
                'read-asitentes',
                'delete-asitentes',
                'view-charlas',
                'create-charlas',
                'update-charlas',
                'read-charlas',
                'delete-charlas',

            ]);
        //admin campaña
        Role::create(['name' => 'nivel1-campaña'])
            ->givePermissionTo([
                'all-salud',
                'all-configuracion',
                'admin-campañas',

                'view-campañas',
                'create-campañas',
                'update-campañas',
                'read-campañas',
                'delete-campñas',
                'update-asitentes',
                'view-asitentes',
                'create-asitentes',
                'read-asitentes',
                'delete-asitentes',
            ]);

        //solo registra campañas
        Role::create(['name' => 'nivel2-campaña'])
            ->givePermissionTo([
                'all-salud',
                'view-campañas',
                'view-asitentes',
                'create-asitentes',
                'update-asitentes',
                'read-asitentes',
                'delete-asitentes',
            ]);
        //admin de charlas
        Role::create(['name' => 'nivel1-charla'])
            ->givePermissionTo([
                'all-salud',
                'all-configuracion',
                'view-charlas',
                'create-charlas',
                'update-charlas',
                'read-charlas',
                'agregar-evidencia',
                'delete-charlas',
                'admin-charlas',
            ]);
        //solo edita
        Role::create(['name' => 'nivel2-charla'])
            ->givePermissionTo([
                'all-salud',
                'view-charlas',
                'read-charlas',
                'agregar-evidencia',
                'delete-charlas',
            ]);
        //admin mascotas
        Role::create(['name' => 'admin-mascotas'])
            ->givePermissionTo([
                'all-mascota',
                'view-mascotas',
                'create-mascotas',
                'update-mascotas',
                'read-mascotas',
                'delete-mascotas',
            ]);


        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'Tapellidos_user' => 'admin',
            'password' => 'liammateo01'
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'marko ',
            'Tapellidos_user' => 'tito',
            'email' => 'mtito@gmail.com',
            'password' => 'muni*2025'
        ])->assignRole('all-salud');

    }
}
