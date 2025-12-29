<!DOCTYPE html>
<html>
<head>
    <style>
        @page { margin: 0; }
        body { margin: 0; }

        .fondo {
            position: fixed;
            top: 0;
            left: 0;
            width: 297mm;
            height: 210mm;
            z-index: -1;
        }

        .nombre {
            position: absolute;
            top: 75mm;
            left: 10mm;
            font-size: 28px;
            font-weight: bold;
        }

        .especie {
            position: absolute;
            top: 95mm;
            left: 10mm;
            font-size: 28px;
            font-weight: bold;
        }
        .raza {
            position: absolute;
            top: 95mm;
            left: 88mm;
            font-size: 28px;
            font-weight: bold;
        }
        .sexo {
            position: absolute;
            top: 115mm;
            left: 10mm;
            font-size: 28px;
            font-weight: bold;
        }
        .adopcion {
            position: absolute;
            top: 137mm;
            left: 10mm;
            font-size: 28px;
            font-weight: bold;
        }
        .nacimiento {
            position: absolute;
            top: 115mm;
            left: 88mm;
            font-size: 28px;
            font-weight: bold;
        }
        .emicion {
            position: absolute;
            top: 135mm;
            left: 88mm;
            font-size: 28px;
            font-weight: bold;
        }
        
        .codigo {
            position: absolute;
            top: 45mm;
            left: 207mm;
            font-size: 40px;
            font-weight: bold;
        }
        .foto {
            position: absolute;
            top: 60mm;      /* ajusta */
            right: 5mm;    /* ajusta */
            width: 111mm;
            height: 140mm;
            object-fit: cover;
            border: 2px solid #000;
        }
        .QR {
            position: absolute;
            top: 147mm;
            left: 5mm;    
            width: 65mm;
            height: 60mm;
            object-fit: cover;
            border: 2px solid #000;
        }
    </style>
</head>
<body>

    <img src="{{ $fondoBase64 }}" class="fondo">


    <div class="nombre">{{ $mascota->Tnombre_mascota }}</div>
    <div class="especie">{{ $mascota->Tespecie_mascota }}</div>
    <div class="raza">{{ $mascota->Tmascota_Raza }}</div>
    <div class="sexo">{{ $mascota->Tsexo_mascota }}</div>
    <div class="nacimiento">{{ $mascota->DfechaNac_mascota }}</div>
    <div class="adopcion">No contiene</div>
    <div class="emicion">{{ $mascota->created_at }}</div>
    <div class="codigo">{{ $mascota->Tcodigo_mascota }}</div>
    @if($fotoBase64)
        <img src="{{ $fotoBase64 }}" class="foto">
    @endif

    <img src="{{ $qrBase64 }}" class="QR">

</body>
</html>
