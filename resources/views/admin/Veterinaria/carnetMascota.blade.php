<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- fontawnsone --}}
        <script src="https://kit.fontawesome.com/00a241fc5c.js" crossorigin="anonymous"></script>


        <!-- Select2 CSS y JS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
         @stack('css')
        <!-- Swiper para el catalago -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-50 ">   
        <div class="flex justify-center mb-4 " >
            <h1>REGISTRO DE MASCOTA</h1>     
        </div>
        <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4 ">
                    <div >
            
                        <div class="flex justify-center" >
                            @if ($imagen->isEmpty())
                                <br>
                                <br>
                                <br>
                                <br>
                                <img src="https://st2.depositphotos.com/2945617/6862/v/450/depositphotos_68621493-stock-illustration-cute-dog-cartoon.jpg" height="550px" width="550px" alt="imagen de la campaña">
                            @else
                                <div class="swiper mySwiper w-full max-w-xl mb-4 ">
                                    <br>
                                    <br>
                                    <br>    
                                    {{-- <img src="{{ asset('storage/'.$imagen->Tpath_imagenes) }}" height="650px" width="650px" alt="imagen de la mascota"> --}}
                                    
                                    <div class="swiper-wrapper">
                                        @foreach ($imagen as $img)
                                            <div class="swiper-slide relative flex justify-center">
                                                
                                                <img src="/storage/{{$img->Tpath_imagenes}}" 
                                    class="rounded-lg shadow-lg w-full h-auto">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                                
                            </div>
                          
        
                    </div>
            
                    <div>
            
                            <div class="px-6 py-1 rounded-lg border-2 border-blue-300 bg-blue-50 mb-4">
                                <p class="text-lg font-semibold text-center mb-4">Mascota</p>
                                <div class="grid gap-6 mb-2 md:grid-cols-3 mt-2 ">
                                    <div>
                                        <label for="first_name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-black">Nombre:</label>    
                                        <input maxlength="33" name="masName" type="text" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "  value="{{$mascota->Tnombre_mascota}}" disabled >
                                    </div>
                    
                                    <div>
        
                                        <label for="first_name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-black">Especie:</label>    
                                        <input maxlength="33" name="masName" type="text" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "  value="{{$mascota->Tespecie_mascota}}" disabled >
                                        
                                    </div>
                    
                                    <div>
                                        <label for="first_name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-black">Raza:</label>    
                                        <input maxlength="33" name="masName" type="text" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "  value="{{$mascota->Tmascota_Raza}}" disabled >
        
                                       
                                    </div>
                    
                                    <div>
                                        <label for="first_name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-black">Sexo:</label>    
                                        <input maxlength="33" name="masName" type="text" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "  value="{{$mascota->Tsexo_mascota}}" disabled >
                                    </div>
                    
                    
                                    <div>
        
                                        <label for="first_name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-black">Peligroso:</label>    
                                        <input maxlength="33" name="masName" type="text" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "  value="{{$mascota->Tpelirgo_mascota}}" disabled >
        
                                    </div>
                    
                                    <div>
                                        
                                        <label for="first_name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-black">Antecedentes de Agresividad:</label>    
                                        <input maxlength="33" name="masName" type="text" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "  value="{{$mascota->Tagrecividad_mascota}}"  disabled>
                                        
                
                                    </div>
                    
                                    <div>
                                        <label for="first_name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-black">Color:</label>    
                                        <input maxlength="55"  name="masColor" type="text" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->Tcolor_mascota}}"  disabled >
                                    </div>
                    
                    
                                    <div>
                                        <label for="first_name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-black">Contiene señas:</label>    
                                        <input maxlength="85" name="masSeñas" type="text" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->Tseñas_mascota}}" disabled  >
                                    </div>
                    
                    
                                    <div>
                                        <label for="first_name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-black">Fecha de nacimiento:</label>    
                                        <input type="date" name="fecha" max="{{date('Y-m-d')}}"  class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "  value="{{$mascota->DfechaNac_mascota}}" disabled >
                                    </div>
                                    
                                    
                    
                                </div>
                                <div class="flex justify-center" >
                                    <div>
        
                                        <label for="first_name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-black">Identificacion:</label>    
                                        <input maxlength="33" name="masName" type="text" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "  value="{{$mascota->Tnombre_identificacion}}"  disabled >
        
                                    </div>
                                </div>
                            </div>
                
                            <div class="px-6 py-2  rounded-lg border-2 border-blue-300 bg-blue-50">
                    
                                <p class="text-lg font-semibold text-center mb-4">Responsable</p>
                
                                <div class="grid gap-6 mb-4 md:grid-cols-3 mt-4">
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-900">Nombres:</label>    
                                        <input type="text" maxlength="55" name="resName" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->Tnombre_responsable}}" disabled>
                                    </div>
                
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-900">Apellido Paterno:</label>    
                                        <input type="text" maxlength="55" name="resApeP" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->TapellidoP_responsable}}" disabled>
                                    </div>
                
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-900">Apellido Materno:</label>    
                                        <input type="text" maxlength="55" name="resApeM" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->TapellidoM_responsable}}" disabled>
                                    </div>
                
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-900">Dirección:</label>    
                                        <input type="text" maxlength="200" name="resDire" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->Tdireccion_responsable}}" disabled>
                                    </div>
                
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-900">Celular:</label>    
                                        <input type="text" maxlength="9" minlength="9" name="resCel" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->Tcelular_responsable}}" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  disabled  />
                                    </div>
                
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-900">DNI:</label>    
                                        <input type="text" maxlength="8"  pattern="\d{8}"  minlength="8" name="resDNI" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->Tdni_responsable}}" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  disabled  />
                                    </div>
                                    
                                    
                                </div>
                                <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-900">Correo:</label>    
                                        <input type="text" maxlength="70" name="resEmail" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->Tcorreo_responsable}}" disabled >
                                    </div>
                
                                    <div>
                                        <label class="block mb-1 text-sm font-medium text-gray-900">Telefono Fijo:</label>    
                                        <input type="text" maxlength="25" name="resTel" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 " value="{{$mascota->Ttelefono_responsable}}" disabled>
                                    </div>
                                </div>
                            </div>
                            
            
            
            
            
                        
                    </div>
                    
            
            
            
            
                </div>
        
            <div>

            </div>
        
            @push('js')
            <script>
                const swiper = new Swiper(".mySwiper", {
                    loop: true,

                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },

                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },

                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                });
            </script>
                <script>
                    document.getElementById('mostrarDocumentos').addEventListener('click', function() {
                        const documentos = {!! json_encode($documentos) !!}; // tus documentos desde Laravel
                        const deleteBase = "{{ route('admin.charla.documentos.delete', ':id') }}";
        
                        let tablaHTML = `
                            <table style="width:100%; border-collapse: collapse;">
                                <tbody>
                                    ${documentos.map(c => `
                                        <tr>
                                            <td style="padding:8px; border-bottom:1px solid #ddd; text-align:center;">
                                                ${c.Tnombre_documentos}
                                            </td>
                                            <td style="padding:8px; border-bottom:1px solid #ddd; text-align:center;">
                                                <a href="/storage/${c.Tpath_documentos}" target="_blank">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </td>
                                            
                                                
                                        </tr>
                                    `).join('')}
                                </tbody>
                            </table>
                        `;
        
                        Swal.fire({
                            title: 'Documentos',
                            html: tablaHTML,
                            width: 400,
                            confirmButtonText: 'Cerrar',
                            confirmButtonColor: '#2563eb'
                        });
                    });
                </script>
        
        
        
            @endpush
            {{-- <td style="padding:8px; border-bottom:1px solid #ddd; text-align:center;">
                                                <a href="${deleteBase.replace(':id', c.PK_Documentos)}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </td> --}}

    </body>
</html>


