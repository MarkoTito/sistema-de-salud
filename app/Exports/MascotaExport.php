<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class MascotaExport implements FromCollection ,WithHeadings, WithStyles, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $mascotas;

    public function __construct($mascotas)
    {
        $this->mascotas = $mascotas;
    }

    public function collection()
    {
        //
        return $this->mascotas->map(function ($mascotas){
            return [
                $mascotas->created_at,
                $mascotas->Tnombre_mascota,
                $mascotas->Tespecie_mascota,
                $mascotas->Tdescripcion_raza,
                $mascotas->Tsexo_mascota,
                $mascotas->Tnombre_responsable,
                $mascotas->TapellidoP_responsable,
                $mascotas->TapellidoM_responsable,
                $mascotas->Tdireccion_responsable,
                $mascotas->Tdni_responsable,
                $mascotas->Tpelirgo_mascota,
                $mascotas->Tagrecividad_mascota
    
            ];
        });
    }
    public function headings (): array{
        return [
            'Fecha de registro',
            'Nombre de la Macota',
            'Especie',
            'Raza',
            'Sexo',
            'Nombre del Propietario',
            'Apellido Paterno ',
            'Apellido Materno',
            'Dirección',
            'N° DNI',
            'P. Peligroso',
            'Antecedes de agresión'
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
