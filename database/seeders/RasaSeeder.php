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
                /* PERROS (15) */
                [
                    'Tdescripcion_raza'=> 'Border Collie',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Boxer',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Cocker Spaniel',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Dálmata',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Akita Inu',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'San Bernardo',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Shar Pei',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Weimaraner',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Corgi Galés',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Pastor Belga Malinois',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Pastor Australiano',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Bóxer Alemán',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Mastín Inglés',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Bull Terrier',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Galgo Español',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

                /* GATOS (15) */
                [
                    'Tdescripcion_raza'=> 'Manx',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Bombay',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Ocicat',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Cornish Rex',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Himalayo',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Noruego del Bosque',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Korat',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Toyger',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Van Turco',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Savannah',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'LaPerm',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Munchkin',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Peterbald',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Selkirk Rex',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tdescripcion_raza'=> 'Chartreux',
                    'Nestado_raza' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

            ]
        );
    }
}
