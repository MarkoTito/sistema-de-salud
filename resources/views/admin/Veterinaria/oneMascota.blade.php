<x-admin-layout :breadcrumbs="[
    [
        'name'=>'Menu',
        'href' => '/',
    ],
    [
        'name'=> 'Mascotas',
        'href' => route('admin.Mascotas.index')
    ],
    [
        'name'=> 'Mascota',
    ]
    ]">
    
    
    <br>
    <br>

    <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4 mb-4 ">

        <div>
            @if (!$imagen || empty($imagen->Tpath_imagenes))
                <img src="https://st2.depositphotos.com/2945617/6862/v/450/depositphotos_68621493-stock-illustration-cute-dog-cartoon.jpg" height="350px" width="350px" alt="imagen de la campaña">
            @else
                <div class="mb-4">
                    <img src="{{ asset('storage/'.$imagen->Tpath_imagenes) }}" height="200px" width="400px" alt="imagen de la mascota">
                </div>
            @endif
        </div>

        <div>
            <div class="grid gap-6 mb-4 md:grid-cols-3 mt-4 ">
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Nombre:</label>    
                    <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$mascota->Tnombre_mascota}}" disabled>
                </div>

                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Especie:</label>    
                    <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$mascota->Tespecie_mascota}}" disabled>
                </div>

                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Raza:</label>    
                    <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$mascota->Tdescripcion_raza}}" disabled>
                </div>

                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Sexo:</label>    
                    <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$mascota->Tsexo_mascota}}" disabled>
                </div>


                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Peligroso:</label>    
                    <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$mascota->Tpelirgo_mascota}}" disabled>
                </div>


                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Agresivo:</label>    
                    <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$mascota->Tagrecividad_mascota}}" disabled>
                </div>

                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Color:</label>    
                    <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$mascota->Tcolor_mascota}} " disabled>
                </div>


                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Contiene señas:</label>    
                    <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$mascota->Tseñas_mascota}}" disabled>
                </div>


                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Fecha de nacimiento:</label>    
                    <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$mascota->DfechaNac_mascota}}" disabled>
                </div>
                
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Responsable:</label>    
                    <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$mascota->Tnombre_responsable}} {{$mascota->TapellidoP_responsable}} {{$mascota->TapellidoM_responsable}}" disabled>
                </div>


                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Direccion:</label>    
                    <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$mascota->Tdireccion_responsable}}" disabled>
                </div>


                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Celular:</label>    
                    <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$mascota->Tcelular_responsable}}" disabled>
                </div>



                
                

            </div>
        </div>


    </div>

    <div>
        
    <h3>Documentos:</h3>
    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
        <table class="w-full text-sm text-left rtl:text-right text-body">
            <thead class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium" align="center" >
                        Documento
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium"  >
                        Descargar
                    </th>
                    <th scope="col" class="px-6 py-3 font-medium" align="center" >
                        Eliminar
                    </th>
                    
                </tr>
            </thead>
            <tbody>
                @if (!$documentos)
                    <tr class="bg-neutral-primary border-b border-default">
                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap"align="center" >
                            No cuenta con documentación 
                        </th>
                        <td class="px-6 py-4" align="center" >
                            No cuenta con documentación 
                        </td>
                        <td class="px-6 py-4" align="center" >
                            No cuenta con documentación 
                        </td>
                    </tr>
                @else
                    @foreach ($documentos as $documento)
                        <tr class="bg-neutral-primary border-b border-default">
                            <th class="px-6 py-4 font-medium  whitespace-nowrap text-black"  align="center" >
                                {{$documento->Tnombre_documentos}}
                            </th>
                            <th class="px-6 py-4">
                                <a href="{{ asset('storage/' . $documento->Tpath_documentos) }}" target="_blank" align="center" >
                                    Ver
                                </a>
                            </th>
                            <th class="px-6 py-4 font-medium  whitespace-nowrap text-black" align="center" >
                                delete
                            </th>
                        </tr>
                    @endforeach
                    
                @endif


                    
                
                
            </tbody>
        </table>
    </div>


    </div>

</x-admin-layout>