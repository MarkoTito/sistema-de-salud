<x-admin-layout>
    
    <div x-data="{ activeTab: 'dashboard' }" class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
        <ul class="flex flex-wrap -mb-px">
            <li class="me-2">
            <a @click="activeTab = 'profile'" :class="activeTab === 'profile' ? 'text-blue-600 border-blue-600 border-b-2' : 'border-transparent hover:text-gray-600 hover:border-gray-300'" class="inline-block p-4 rounded-t-lg">Campañas</a>
            </li>
            <li class="me-2">
            <a @click="activeTab = 'dashboard'" :class="activeTab === 'dashboard' ? 'text-blue-600 border-blue-600 border-b-2' : 'border-transparent hover:text-gray-600 hover:border-gray-300'" class="inline-block p-4 rounded-t-lg">Charlas</a>
            </li>
            <li class="me-2">
            <a @click="activeTab = 'settings'" :class="activeTab === 'settings' ? 'text-blue-600 border-blue-600 border-b-2' : 'border-transparent hover:text-gray-600 hover:border-gray-300'" class="inline-block p-4 rounded-t-lg">Usuarios</a>
            </li>
        </ul>

        <!-- Contenido de cada tab -->
        <div class="p-4">
            <div x-show="activeTab === 'profile'">
                <div class="flex justify-between items-center mb-4">

                    {{-- <button id="" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Agregar Campaña
                    </button> --}}

                    <button id="btnFormulario" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        <i class="fa-solid fa-globe"></i>
                        Agregar Campaña
                    </button>
                </div>
                
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Nombre de la campaña
                                </th>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Descripción
                                </th>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Accion
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$Tiposcampañas)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ninguna campaña
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ninguna campaña
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ninguna campaña
                                    </th>
                                </tr>
                                
                            @else
                                @foreach ($Tiposcampañas as $campañasTi)
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$campañasTi->Tnombre_Tipocampaña}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$campañasTi->Tdescripcion_Tipocampaña}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            <a href="{{route('admin.Tipocampaña.show',$campañasTi->PK_TiposCampañas)}}">
                                                <i class="fa-solid fa-camera"></i>
                                            </a>
                                            <a href="">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </th>
                            
                                    </tr>
                                    
                                @endforeach
                                
                            @endif
                            
                            
                        </tbody>
                    </table>
                </div>

            </div>












            <div x-show="activeTab === 'dashboard'">Contenido de Dashboard</div>
            <div x-show="activeTab === 'settings'">Contenido de Settings</div>
        </div>
    </div>

    <!-- Agrega Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    
    @push('js')
        
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- Creacion de campaña -->
        <script>
            document.getElementById('btnFormulario').addEventListener('click', function() {
            Swal.fire({
                title: 'Formulario de creación de campaña',
                html: `
                <form id="form-campania" onsubmit="return false;">
                    <label>Nombre</label>
                    <input id="nombre" class="swal2-input" placeholder="Nombre de la campaña">
                    <label>Descripción</label>
                    <textarea id="mensaje" class="swal2-textarea" placeholder="Descripción de la campaña"></textarea>
                </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
                focusConfirm: false,
                preConfirm: () => {
                const nombre = document.getElementById('nombre').value
                const mensaje = document.getElementById('mensaje').value

                if (!nombre || !mensaje) {
                    Swal.showValidationMessage('Completa todos los campos')
                    return false
                }

                // Retornamos los datos al then()
                return { nombre, mensaje }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                // 📨 Enviar al backend con fetch()
                fetch("{{ route('admin.Configuracion.store') }}", {
                    method: "POST",
                    headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(result.value)
                })
                .then(response => {
                    if (!response.ok) {
                    throw new Error("Error en el envío");
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire('Error', 'No se pudo crear la campaña', 'error')
                })
                .catch(error => {
                    Swal.fire('Éxito', 'La campaña fue creada correctamente', 'success')
                    
                });
                }
            })
            });
        </script>
        
    @endpush


</x-admin-layout>