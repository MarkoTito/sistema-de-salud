<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AsistenteMascotaExport implements FromCollection ,WithHeadings, WithStyles, ShouldAutoSize
{
    protected $asistentes;

    public function __construct($asistentes)
    {
        $this->asistentes = $asistentes;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        return $this->asistentes->map(function ($asistentes){
            $tipo="";
            if ($asistentes->NTipoMascota_asistente ==1) {
                $tipo = "Canino";
            } else {
                $tipo = "Felino";
            }
            
            return [
                $asistentes->Tnombre_asistente,
                $asistentes->TapellidoP_asistente,
                $asistentes->TapellidoM_asistente,

                $asistentes->Tdni_asistente,
                $asistentes->Tlugar_campaña,
                $asistentes->Tcelular_asistente,
                
                $asistentes->Nedad_asistente,
                $tipo,
                $asistentes->TnombreMasctoa_asistente
                
                
            ];
        });
    }
    public function headings (): array{
        return [
            'Nombre',
            'Apellido Paterno',
            'Apellido Materno',

            'DNI',
            'Dirección',
            'Celular',

            'Edad',
            'Tip. Mascota',
            'Nombre',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
                1 =>[
                    'font' => [
                        'bold' => true,
                    ],
                    'fill' =>[
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor'=>[
                            'argb' => 'FFCCCCCC'
                        ]

                    ],
                    'alignment' => [
                        'horizontal' => 'center',
                    ]
                ]
        ];
    }
}
