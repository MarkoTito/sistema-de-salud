<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PDF-{{$fecha}}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; margin: 20px; }
        .title { text-align: center; font-size: 18px; font-weight: bold; margin-bottom: 20px; }
        h5{
            text-align: center;
        }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { 
            border: 1px solid #ccc; 
            padding: 8px; 
            text-align: center; /* Centrar contenido de celdas */
            vertical-align: middle; /* Opcional: centrar verticalmente */
        }
        th { background-color: #f0f0f0; }
        .section { margin-top: 20px; }
    </style>

</head>
<body>
 
    <div class="title">{{$tipo}}s registrados del {{$Ini}} al {{$fin}}</div>
    
    <div class="section">
        <h3>Mascotas:</h3>
        <table>
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Especie</th>
                    
                    <th>Raza</th>
                    <th>Sexo</th>
                    <th>Potencialmente Peligroso</th>

                    <th>Antecedente de Agresividad</th>
                    <th>Nombre del Propietario</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($macotas as $macota)
                    <tr>
                        <td>{{ $macota->Tcodigo_mascota}}</td>
                        <td>{{ $macota->Tnombre_mascota}}</td>
                        <td>{{ $macota->Tespecie_mascota}}</td>
                        
                        <td>{{ $macota->Tmascota_Raza}}</td>
                        <td>{{ $macota->Tsexo_mascota}}</td>
                        <td>{{$macota->Tpelirgo_mascota}}</td>

                        
                        <td>{{$macota->Tagrecividad_mascota}}</td>
                        <td>{{ $macota->Tnombre_responsable}} {{ $macota->TapellidoP_responsable}} {{ $macota->TapellidoM_responsable}}</td> 
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>