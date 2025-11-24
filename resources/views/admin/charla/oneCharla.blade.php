<x-admin-layout :breadcrumbs="[
    [
        'name'=>'Menu',
        'href' => '/',
    ],
    [
        'name'=>'Charlas',
        'href' => route('admin.Charlas.index')
    ],
    [
        'name'=> 'Charla',
    ]
    ]">
    
    <div class="flex justify-center mt-4">
        <h1 class="font-extrabold text-gray-900" style="font-size: 2rem;">
            {{ $charla->Tnombre_charla }}
        </h1>
    </div>
    
    <div class="flex justify-between items-center mb-4">
        @can('update-charlas')
            <div>
                <a href="{{route('admin.charla.documento',$charla->PK_Charlas)}}">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" id="agregar-asistente" >
                        <i class="fa-solid fa-file"></i>
                        Agregar Asistente
                    </button>    
                </a>
            </div>            
        @endcan
        
        @can('update-charlas')
            <div>
                <a href="{{route('admin.charla.imagen',$charla->PK_Charlas)}}">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"  >
                        <i class="fa-solid fa-camera"></i>
                        Agregar Evidencia
                    </button>    
                </a>
                
            </div>
        @endcan
            
    </div>
    
    <br>
    @if ($imagenes->isEmpty())
        <div class="flex justify-center mb-4 " >
            <img src="https://www.stellamaris.com.pe/uploads/shares/BLOG/CAMPA__A_DE_SALUD_-_RESP__SOCIAL.jpg" height="450px" width="640px" alt="imagen de la campaña">
        </div>
        
    @else
        <div class="swiper mySwiper w-full max-w-xl">
            <div class="swiper-wrapper">
                @foreach ($imagenes as $img)
                    <div class="swiper-slide relative flex justify-center">
                        <a href="{{route('admin.charla.imagen.delete',$img->PK_Imagenes)}}"
                        class="absolute top-2 right-2 bg-red-600 text-white p-2 rounded-full shadow hover:bg-red-700 transition">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                        <img src="/storage/{{ $img->Tpath_imagenes }}" 
                            class="rounded-lg shadow-lg w-full h-auto">
                    </div>
                @endforeach
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
        
    @endif

    <br>
    <div class="grid gap-6 mb-4 md:grid-cols-3 mb-4 ">
        
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Fecha:</label>    
            <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->DfechaIni_charla}}" disabled>                
        </div>
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Hora de inicio:</label>    
            <input type="time" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->ThoraIni_charla}}" disabled>                
        </div>
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Hora de fin:</label>    
            <input type="time" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->ThoraFin_charla}}" disabled>                
        </div>
        @if (!$charla->Ncantidad_charla)
            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad:</label>    
                <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="0" disabled>                
            </div>
        @else
            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad:</label>    
                <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->Ncantidad_charla}}" disabled>                
            </div>
            
        @endif
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Lugar:</label>    
            <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->Tlugar_charla}}" disabled>                
        </div>
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Lugar especifico:</label>    
            <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->TdescripcionLugar_charla}}" disabled>                
        </div>
        
    </div>

    @if ($documentos->isEmpty())
        <div class="flex justify-between items-center mb-4">
            <button type="button"
                class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600"
                id="mostrarExpositores">
                <i class="fa-solid fa-user"></i>
                Ver Expositores
            </button>
        </div>
        
    @else
        <div class="flex justify-between items-center mb-4">

            <div>
                <button type="button"
                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600"
                    id="mostrarExpositores">
                    <i class="fa-solid fa-user"></i>
                    Ver Expositores
                </button>

            </div>
            <div>
                <button id="mostrarDocumentos" 
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Mostrar Documentos
                </button>

            </div>
        </div>
    
    @endif
    

    @push('js')
        <script>
            document.getElementById('mostrarExpositores').addEventListener('click', function() {
                const expositores = {!! json_encode($expositores) !!}; 

                let tablaHTML = `
                    <table style="width:100%; border-collapse: collapse;">
                        
                        <tbody>
                            ${expositores.map(c => `
                                <tr>
                                    <td style="padding:8px; border-bottom:1px solid #ddd; text-align:center;">
                                        ${c.Tnombre_expositor ?? '(sin nombre)'}
                                    </td>
                                    <td style="padding:8px; border-bottom:1px solid #ddd; text-align:center;">
                                        ${c.TapellidoP_expositor ?? '(sin apellido)'}
                                    </td>
                                    <td style="padding:8px; border-bottom:1px solid #ddd; text-align:center;">
                                        ${c.TapellidoM_expositor ?? '(sin apellido)'}
                                    </td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                `;

                Swal.fire({
                    title: ' expositores',
                    html: tablaHTML,
                    width: 400,
                    confirmButtonText: 'Cerrar',
                    confirmButtonColor: '#2563eb'
                });
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
                                    <td style="padding:8px; border-bottom:1px solid #ddd; text-align:center;">
                                        <a href="${deleteBase.replace(':id', c.PK_Documentos)}">
                                            <i class="fa-solid fa-trash"></i>
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
        <script>
            const swiper = new Swiper(".mySwiper", {
                loop: true,
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
        
        
    @endpush

</x-admin-layout>