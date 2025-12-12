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
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-pagination"></div>
                        
                        </div>
                    @endif
                        
                    </div>
                    <div class="flex justify-center mb-4 " >
                        <button id="mostrarDocumentos" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Mostrar Documentos
                        </button>
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
                                <input maxlength="33" name="masName" type="text" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 "  value="{{$mascota->Tdescripcion_raza}}" disabled >

                               
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

    





{{--     
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
                </tr>
            </thead>
            <tbody>
                @if (!$documentos)
                    <tr class="bg-neutral-primary/100 border-b border-default">
                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap"align="center" >
                            No cuenta con documentación 
                        </th>
                        <td class="px-6 py-4" align="center" >
                            No cuenta con documentación 
                        </td>
                    </tr>
                @else
                    @foreach ($documentos as $documento)
                        <tr class="bg-neutral-primary/100 border-b border-default">
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
    </div> --}}


    </div>

    @push('js')
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