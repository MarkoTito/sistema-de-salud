<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposCampañaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('TiposCampañas')->insert(
            [
                [
                    'Tnombre_Tipocampaña' => 'CAMPAÑA CONTRA EL TÉTANO',
                    'Tdescripcion_Tipocampaña'=> 'Habla sobre el tetano',
                    'Nestado_Tipocampaña' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tnombre_Tipocampaña' => 'CAMPAÑA CONTRA DENGUE',
                    'Tdescripcion_Tipocampaña'=> 'Habla sobre el degue',
                    'Nestado_Tipocampaña' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tnombre_Tipocampaña' => 'CAMPAÑA DE AMOR ',
                    'Tdescripcion_Tipocampaña'=> 'Habla sobre el cuidado de las parejas',
                    'Nestado_Tipocampaña' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

            ]
        );
    }
}
