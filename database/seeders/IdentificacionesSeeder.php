<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IdentificacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('Identificaciones')->insert(
            [
                [
                    'Tnombre_identificacion'=> 'Collar',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tnombre_identificacion'=> 'Placa',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tnombre_identificacion'=> 'Tatuaje',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tnombre_identificacion'=> 'Microchip',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tnombre_identificacion'=> 'Ninguno',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
               
            ]
        );
    }
}
