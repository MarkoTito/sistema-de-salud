<x-admin-layout>
    
    <div x-data="{ activeTab: 'Campañas' }" class="text-sm font-medium text-center text-gray-500 border-b border-gray-200">
        <ul class="flex flex-wrap -mb-px">
            <li class="me-2">
            <a @click="activeTab = 'Campañas'" :class="activeTab === 'Campañas' ? 'text-blue-600 border-blue-600 border-b-2' : 'border-transparent hover:text-gray-600 hover:border-gray-300'" class="inline-block p-4 rounded-t-lg">Campañads</a>
            </li>
            <li class="me-2">
            <a @click="activeTab = 'Charlas'" :class="activeTab === 'Charlas' ? 'text-blue-600 border-blue-600 border-b-2' : 'border-transparent hover:text-gray-600 hover:border-gray-300'" class="inline-block p-4 rounded-t-lg">Charlas</a>
            </li>
            <li class="me-2">
                <a @click="activeTab = 'Expositores'" :class="activeTab === 'Expositores' ? 'text-blue-600 border-blue-600 border-b-2' : 'border-transparent hover:text-gray-600 hover:border-gray-300'" class="inline-block p-4 rounded-t-lg">Expositores</a>
            </li>
            <li class="me-2">
                <a @click="activeTab = 'Colaboradores'" :class="activeTab === 'Colaboradores' ? 'text-blue-600 border-blue-600 border-b-2' : 'border-transparent hover:text-gray-600 hover:border-gray-300'" class="inline-block p-4 rounded-t-lg">Colaboradores</a>
            </li>
        </ul>
        
        <!-- Contenido de cada tab -->
        <div class="p-4">
            <div x-show="activeTab === 'Campañas'">
                <div class="flex justify-end mb-4 ">
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
                                @foreach ($Tiposcampañas as $charla)
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$charla->Tnombre_Tipocampaña}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$charla->Tdescripcion_Tipocampaña}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            <a href="{{route('admin.Tipocampaña.show',$charla->PK_TiposCampañas)}}">
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

            <div x-show="activeTab === 'Charlas'">
                <div class="flex justify-end mb-4 ">
                    <button id="btnFormulario-charla" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        <i class="fa-solid fa-chalkboard-user"></i>
                        Agregar Charla
                    </button>
                </div>
                
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Nombre de la charla
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
                            @if (!$TiposCharlas)
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
                                @foreach ($TiposCharlas as $charla)
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$charla->Tnombre_charla}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$charla->Tdescripcion_Tipocharla}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            <a href="{{route('admin.Tipocampaña.show',$charla->PK_TiposCharla)}}">
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

            <div x-show="activeTab === 'Expositores'">
                <div class="flex justify-end mb-4 ">
                    <button id="agregar-asistente" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">                        
                        Agregar Expositor
                    </button>
                </div>
                
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Nombre
                                </th>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Apellido Paterno
                                </th>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Apellido Materno
                                </th>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Numero de contacto
                                </th>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Acción
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$Tiposcampañas)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ningun expositor
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ningun expositor
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ningun expositor
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ningun expositor
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ningun expositor
                                    </th>
                                </tr>
                                
                            @else
                                @foreach ($expositores as $expo)
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$expo->Tnombre_expositor}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$expo->TapellidoP_expositor}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$expo->TapellidoM_expositor}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$expo->Tnumero_expositor}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            <a href="{{route('admin.Tipocampaña.show',$expo->PK_Expositores)}}">
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

            <div x-show="activeTab === 'Colaboradores'">
                <div class="flex justify-end mb-4 ">
                    <button id="agregar-asistente" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">                        
                        Agregar Colaboradores
                    </button>
                </div>
                
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Nombre
                                </th>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Apellido Paterno
                                </th>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Apellido Materno
                                </th>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Numero de contacto
                                </th>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Acción
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!$Tiposcampañas)
                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ningun expositor
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ningun expositor
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ningun expositor
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ningun expositor
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ningun expositor
                                    </th>
                                </tr>
                                
                            @else
                                @foreach ($expositores as $expo)
                                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$expo->Tnombre_expositor}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$expo->TapellidoP_expositor}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$expo->TapellidoM_expositor}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$expo->Tnumero_expositor}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            <a href="{{route('admin.Tipocampaña.show',$expo->PK_Expositores)}}">
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
                    <input id="tipo"  class="swal2-input" value="1" hidden>
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
                const tipo = document.getElementById('tipo').value


                if (!nombre || !mensaje) {
                    Swal.showValidationMessage('Completa todos los campos')
                    return false
                }

                // Retornamos los datos al then()
                return { nombre, mensaje ,tipo}
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
        <script>
            document.getElementById('btnFormulario-charla').addEventListener('click', function() {
            Swal.fire({
                title: 'Formulario de creación de tipos de charla',
                html: `
                <form id="form-campania" onsubmit="return false;">
                    <input id="tipo"  class="swal2-input" value="2" hidden>
                    <label>Nombre</label>
                    <input id="nombre" maxlength="100" class="swal2-input" placeholder="Nombre de la charla">
                    <label>Descripción</label>
                    <textarea id="mensaje" maxlength="200" class="swal2-textarea" placeholder="Descripción de charla"></textarea>
                </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
                focusConfirm: false,
                preConfirm: () => {
                const nombre = document.getElementById('nombre').value
                const mensaje = document.getElementById('mensaje').value
                const tipo = document.getElementById('tipo').value

                if (!nombre || !mensaje) {
                    Swal.showValidationMessage('Completa todos los campos')
                    return false
                }

                // Retornamos los datos al then()
                return { nombre, mensaje ,tipo }
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
                    Swal.fire('Error', 'No se pudo crear el tipo de charla', 'error')
                })
                .catch(error => {
                    Swal.fire('Éxito', 'La campaña fue tipo de charla', 'success')
                    
                });
                }
            })
            });
        </script>

        {{-- <script>
            document.getElementById('btnFormulario-expositor').addEventListener('click', function() {
            Swal.fire({
                title: 'Formulario de creación de Expositor nuevo',
                html: `
                <form id="form-campania" onsubmit="return false;">
                    <input id="tipo"  class="swal2-input" value="3" hidden>
                    <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
                        <div>
                            <label>Nombre</label>
                            <input id="nombre" maxlength="100" class="swal2-input" placeholder="Nombre de la charla">
                        </div>
                        <div>
                            <label>Apellido Paterno</label>
                            <input id="nombre" maxlength="100" class="swal2-input" placeholder="Nombre de la charla">
                        </div>
                        <div>
                            <label>Apellido Materno</label>
                            <input id="nombre" maxlength="100" class="swal2-input" placeholder="Nombre de la charla">
                        </div>
                    </div>                        
                    <div>
                        <label>Numero</label>
                        <input id="nombre" maxlength="100" class="swal2-input" placeholder="Nombre de la charla">
                    </div>
                </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
                focusConfirm: false,
                preConfirm: () => {
                const nombre = document.getElementById('nombre').value
                const mensaje = document.getElementById('mensaje').value
                const tipo = document.getElementById('tipo').value

                if (!nombre || !mensaje) {
                    Swal.showValidationMessage('Completa todos los campos')
                    return false
                }

                // Retornamos los datos al then()
                return { nombre, mensaje ,tipo }
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
                    Swal.fire('Error', 'No se pudo crear el tipo de charla', 'error')
                })
                .catch(error => {
                    Swal.fire('Éxito', 'La campaña fue tipo de charla', 'success')
                    
                });
                }
            })
            });
        </script> --}}
        <script>
            //para agregar usuario
                document.getElementById('agregar-asistente').addEventListener('click', function() {
                    Swal.fire({
                        title: 'Agregar Expositor',
                        html: `
                        <form id="formAsistente" >
                            @csrf
                            <div class="grid gap-4 text-left">
                                <input id="tipo"  class="swal2-input" value="3" hidden>
                                <div>
                                    <label class="block text-sm font-medium text-gray-900">Nombre:</label>
                                    <input type="text" name="nombre" id=""
                                        class="swal2-input" style="width: 90%;"
                                        placeholder="Ingrese el nombre completo"
                                        maxlength="50" required>
                                </div>
                                <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Apellido Paterno:</label>
                                        <input type="text" name="apeP" id="" class="swal2-input" maxlength="30" required>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Apellido Materno:</label>
                                        <input type="text" name="apeM" id="" class="swal2-input" maxlength="30" required>
                                    </div>
                                </div>    
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-900">Numero:</label>
                                <input type="text" name="Numero" id="" class="swal2-input" maxlength="9" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                            </div>
                            
                        </form>
                        `,
                        focusConfirm: false,
                        showCancelButton: true,
                        confirmButtonText: 'Registrar',
                        cancelButtonText: 'Cancelar',
                        width: '600px',
                        preConfirm: () => {
                            const form = document.getElementById('formAsistente');
                            const formData = new FormData(form);

                            return fetch("{{ route('admin.Configuracion.store') }}", {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (!data.ok) {
                                    Swal.showValidationMessage(data.msg || 'No se pudo registrar el asitente');
                                }
                                return data;
                            })
                            .catch(error => {
                                Swal.showValidationMessage(`Error: ${error}`);
                            });
                        }
                    }).then((result) => {
                        if (result.isConfirmed && result.value.ok) {
                            Swal.fire('Éxito', 'Asistente registrado correctamente', 'success')
                                .then(() => location.reload());
                        }
                    });
                });
        </script>
        
    @endpush


</x-admin-layout>