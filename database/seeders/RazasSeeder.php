<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RazasSeeder extends Seeder
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
                'Tdescripcion_raza' => 'Chihuahua',
                'Nestado_raza' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                ],
                [
                'Tdescripcion_raza' => 'Pomerania',
                'Nestado_raza' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                ],
                [
                'Tdescripcion_raza' => 'Beagle',
                'Nestado_raza' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                ],
                [
                'Tdescripcion_raza' => 'Border Collie',
                'Nestado_raza' => 1,
                'created_at' => now(),
                'updated_at' => now(),
                ]
            ]
        );
    }
}
