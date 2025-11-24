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

            'all-salud',
            'all-mascota',

            //Campañas
            'view-campañas',
            'create-campañas',
            'read-campañas',
            'update-campañas',
            'delete-campñas',
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
            'delete-charlas',
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
                'view-campañas',
                'create-campañas',
                'update-campañas',
                'read-campañas',
                'delete-campñas',
                'view-asitentes',
                'create-asitentes',
                'read-asitentes',
                'delete-asitentes',
            ]);

        //solo registra campañas
        Role::create(['name' => 'nivel2-campaña'])
            ->givePermissionTo([
                'view-asitentes',
                'create-asitentes',
                'read-asitentes',
                'delete-asitentes',
            ]);
        //admin de charlas
        Role::create(['name' => 'nivel1-charla'])
            ->givePermissionTo([
                'view-charlas',
                'create-charlas',
                'update-charlas',
                'read-charlas',
                'delete-charlas',
            ]);
        //solo edita
        Role::create(['name' => 'nivel2-charla'])
            ->givePermissionTo([
                'view-charlas',
                'read-charlas',
                'delete-charlas',
            ]);
        //admin mascotas
        Role::create(['name' => 'admin-mascotas'])
            ->givePermissionTo([
                'view-mascotas',
                'create-mascotas',
                'update-mascotas',
                'read-mascotas',
                'delete-mascotas',
            ]);


        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => 'liammateo01'
        ])->assignRole('admin');

        User::factory()->create([
            'name' => 'marko tito',
            'email' => 'mtito@gmail.com',
            'password' => 'muni*2025'
        ])->assignRole('all-salud');

    }
}
