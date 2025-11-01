<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColaboradoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('Colaboradores')->insert(
            [
                [
                    'Tnombre_colaborador' => 'Universidad Cayetano Herdia',
                    'Nestado_colaborador' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tnombre_colaborador' => 'UPN',
                    'Nestado_colaborador' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tnombre_colaborador' => 'Hospital 2 de mayo',
                    'Nestado_colaborador' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                
            ]
        );
    }
}
