<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AsistenteExport implements FromCollection ,WithHeadings, WithStyles, ShouldAutoSize
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
            return [
                $asistentes->Tnombre_asistente,
                $asistentes->TapellidoP_asistente,
                $asistentes->TapellidoM_asistente,
                $asistentes->Tdni_asistente,
                $asistentes->Tdescripcion_especialidad
                
            ];
        });
    }
    public function headings (): array{
        return [
            'Nombre',
            'Apellido Paterno',
            'Apellido Materno',
            'DNI',
            'Atencion de especialidad'
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
