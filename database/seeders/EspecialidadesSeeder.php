<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EspecialidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('Especialidades')->insert(
            [
                [
                    'Tdescripcion_especialidad'=> 'Vacunacion',
                    'Nestado_especialidad' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_especialidad'=> 'Desparacitación',
                    'Nestado_especialidad' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_especialidad'=> 'Limpia',
                    'Nestado_especialidad' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]
        );
    }
}
