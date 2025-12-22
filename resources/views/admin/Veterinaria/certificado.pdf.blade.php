<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            background-image: url("file:///{{ public_path('certificados/base.jpg') }}");
            background-size: cover;
            background-repeat: no-repeat;
        }

        .nombre {
            position: absolute;
            top: 300px;
            left: 200px;
            font-size: 28px;
            font-weight: bold;
        }
        .curso {
            position: absolute;
            top: 360px;
            left: 200px;
            font-size: 20px;
        }
        .especie {
            position: absolute;
            top: 400px;
            left: 200px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="nombre">{{ $mascota->Tnombre_mascota }}</div>
    <div class="especie">{{ $mascota->Tespecie_mascota }}</div>
</body>
</html>
