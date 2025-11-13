<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpositorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('Expositores')->insert(
            [
                [
                    'Tnombre_expositor'=> 'Marko Joshep',
                    'TapellidoP_expositor' => 'Tito',
                    'TapellidoM_expositor' => 'Peña',
                    'Tnumero_expositor' => '72921093',
                    'Nestado_expositor' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tnombre_expositor'=> 'Jose',
                    'TapellidoP_expositor' => 'Rivera',
                    'TapellidoM_expositor' => 'Fernandes',
                    'Tnumero_expositor' => '72921094',
                    'Nestado_expositor' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tnombre_expositor'=> 'Miguel',
                    'TapellidoP_expositor' => 'Aranda',
                    'TapellidoM_expositor' => 'Torres',
                    'Tnumero_expositor' => '72921095',
                    'Nestado_expositor' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]
        );
    }
}
