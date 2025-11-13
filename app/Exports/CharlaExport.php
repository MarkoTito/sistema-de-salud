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
                $asistentes->Tnombre_charla,
                $asistentes->Tnombre_expositor,
                $asistentes->TapellidoP_expositor,
                $asistentes->TapellidoM_expositor,
                $asistentes->Tnumero_expositor,
                $asistentes->DfechaIni_charla,
                $asistentes->ThoraIni_charla,
                $asistentes->ThoraFin_charla,
                $asistentes->Ncantidad_charla
                
            ];
        });
    }
    public function headings (): array{
        return [
            'Tema',
            'Nombre del Expositor',
            'Apellido Paterno del Expositor',
            'Apellido materno del Expositor',
            'Contacto',
            'Fecha',
            'Horario de inicio',
            'Horario de finalización',
            'N° de asistentes'
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
