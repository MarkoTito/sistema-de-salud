<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TipoCharlaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('TiposCharla')->insert(
            [
                [
                    'Tnombre_charla' => 'Metaxenica',
                    'Tdescripcion_Tipocharla'=> 'charla de meta',
                    'Nestado_Tipocharla' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tnombre_charla' => 'Lochera saludable',
                    'Tdescripcion_Tipocharla'=> 'charla a estudiantes sobre que loncheras llevar',
                    'Nestado_Tipocharla' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tnombre_charla' => 'Zonosis',
                    'Tdescripcion_Tipocharla'=> 'charla de zonosis',
                    'Nestado_Tipocharla' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]
        );
    }
}
