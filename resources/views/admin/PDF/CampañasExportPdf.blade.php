<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PDF</title>
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
 
    <div class="title">Campañas registradas del {{$datos->fehcIni}} al {{$datos->fehFin}} </div>


    <div class="section">
        <h3>Asistentes:</h3>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Fec. Incio</th>
                    <th>Hor. Ini</th>
                    <th>Hor. Fin</th>
                    
                    <th>Cantidad</th>
                    <th>Expositor</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($charlas as $char)
                    <tr>
                        <td>{{ $char->Tnombre_charla}}</td>
                        <td>{{ $char->DfechaIni_charla}}</td>
                        <td>{{ $char->ThoraIni_charla}}</td>
                        <td>{{ $char->ThoraFin_charla}}</td>
                        
                        <td>{{ $char->Ncantidad_charla}}</td>
                        <td>{{ $char->Tnombre_expositor}} {{$char->TapellidoP_expositor}} {{$char->TapellidoM_expositor}}</td>

                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    

</body>

</html>