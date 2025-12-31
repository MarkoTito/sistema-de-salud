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
 
    <div class="title">Asistentes registrados en la charla de {{$charla->Tnombre_charla}} del {{$charla->DfechaIni_charla}} </div>


    @if ($charla->PK_TiposCharla == 1)
        <div class="section">
            <h3>Asistentes:</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Ape. Paterno</th>
                        <th>Ape. Materno</th>
                        
                        <th>N° DNI</th>
                        <th>Celular</th>
                        <th>Edad</th>

                        <th>Tip. Mascota</th>
                        <th>Nombre de Mascota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asistente as $asis)
                        <tr>
                            <td>{{ $asis->Tnombre_asistente}}</td>
                            <td>{{ $asis->TapellidoP_asistente}}</td>
                            <td>{{ $asis->TapellidoM_asistente}}</td>
                            
                            <td>{{ $asis->Tdni_asistente}}</td>
                            <td>{{ $asis->Tcelular_asistente}}</td>
                            <td>{{$asis->Nedad_asistente}}</td>

                            @if ($asis->NTipoMascota_asistente == 1)
                                <td>Perro</td>
                            @else
                                <td>Gato</td>
                            @endif
                            <td>{{ $asis->TnombreMasctoa_asistente}} </td> 
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    @else
        <div class="section">
            <h3>Asistentes:</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Ape. Paterno</th>
                        <th>Ape. Materno</th>
                        
                        <th>N° DNI</th>
                        <th>Celular</th>
                        <th>Edad</th>

                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asistente as $asis)
                        <tr>
                            <td>{{ $asis->Tnombre_asistente}}</td>
                            <td>{{ $asis->TapellidoP_asistente}}</td>
                            <td>{{ $asis->TapellidoM_asistente}}</td>
                            
                            <td>{{ $asis->Tdni_asistente}}</td>
                            <td>{{ $asis->Tcelular_asistente}}</td>
                            <td>{{$asis->Nedad_asistente}}</td>                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    {{-- <div class="section">
        <h3>Asistentes:</h3>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Ape. Paterno</th>
                    <th>Ape. Materno</th>
                    
                    <th>N° DNI</th>
                    <th>Celular</th>
                    <th>Edad</th>

                    
                </tr>
            </thead>
            <tbody>
                @foreach ($asistente as $asis)
                    <tr>
                        <td>{{ $asis->Tnombre_asistente}}</td>
                        <td>{{ $asis->TapellidoP_asistente}}</td>
                        <td>{{ $asis->TapellidoM_asistente}}</td>
                        
                        <td>{{ $asis->Tdni_asistente}}</td>
                        <td>{{ $asis->Tcelular_asistente}}</td>
                        <td>{{$asis->Nedad_asistente}}</td>                            
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}


</body>

</html>