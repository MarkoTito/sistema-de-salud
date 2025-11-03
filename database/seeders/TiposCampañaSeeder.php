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
                    'Tnombre_Tipocampaña' => 'Campaña contra el tetano',
                    'Tdescripcion_Tipocampaña'=> 'Habla sobre el tetano',
                    'Nestado_Tipocampaña' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tnombre_Tipocampaña' => 'Campaña contra dengue',
                    'Tdescripcion_Tipocampaña'=> 'Habla sobre el degue',
                    'Nestado_Tipocampaña' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'Tnombre_Tipocampaña' => 'Campaña canina ',
                    'Tdescripcion_Tipocampaña'=> 'Habla sobre el cuidado de los perros',
                    'Nestado_Tipocampaña' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],

            ]
        );
    }
}
