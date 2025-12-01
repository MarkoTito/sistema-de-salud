<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToCollection, WithHeadingRow
{
    protected $campaniaId;

    public function __construct($id)
    {
        $this->campaniaId = $id;
    }

    public function collection(Collection $rows)
    {
        $idCampaña = $this->campaniaId;

        foreach ($rows as $row) {

            // Si hay filas vacías → evitar errores
            if (!$row['nombres']) {
                continue;
            }

            $nombre = $row['nombres'];
            $apep   = $row['apellido_paterno'];
            $apem   = $row['apellido_materno'];
            $dni    = $row['dni'];

            DB::statement(
                'EXEC dbo.InserAsistenteCampaña ?,?,?,?,?,?,?',
                [
                    $idCampaña,
                    1, // usuario creador
                    1, // estado
                    $nombre,
                    $apep,
                    $apem,
                    $dni
                ]
            );
        }
    }
}
