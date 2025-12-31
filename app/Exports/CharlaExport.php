<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CharlaExport implements FromCollection,WithHeadings,WithStyles,ShouldAutoSize
{

    protected $charla;

    public function __construct($charla)
    {
        $this->charla = $charla;
    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->charla->map(function ($asistentes){
            return [
                $asistentes->Tnombre_asistente,
                $asistentes->TapellidoP_asistente,
                $asistentes->TapellidoM_asistente,

                $asistentes->Tdni_asistente,
                $asistentes->Tcelular_asistente,
                $asistentes->Nedad_asistente
                
            ];
        });
    }
    public function headings (): array{
        return [
            'Nombre',
            'Apellido Paterno',
            'Apellido materno',
            'N° DNI',
            'Celular',
            'Edad'
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
