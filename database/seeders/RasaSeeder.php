<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RasaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('Razas')->insert(
            [
                [
                    'Tdescripcion_raza'=> 'Labrador Retriever',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Golden Retriever',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Pastor Alemán',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Poodle',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Bulldog Francés',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Chihuahua',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Pug',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Shih Tzu',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Rottweiler',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Beagle',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Doberman',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Husky Siberiano',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

               
            ]
        );
    }
}
