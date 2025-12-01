<x-admin-layout :breadcrumbs="[
    [
        'name'=>'Menu',
        'href' => '/',
    ],
    [
        'name'=>'Campañas',
        'href' => route('admin.Campañas.index')
    ],
    [
        'name'=> 'Campaña',
    ]
    ]">



    <div class="flex justify-center mt-4">
        <h1 class="font-extrabold text-gray-900" style="font-size: 2rem;">
            {{ $campaña->Tnombre_Tipocampaña }}
        </h1>
    </div>



    <br>
    <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4 ">
        <div>
           @if (!$imagen || empty($imagen->Tpath_imagenes))
            <img src="https://www.stellamaris.com.pe/uploads/shares/BLOG/CAMPA__A_DE_SALUD_-_RESP__SOCIAL.jpg" height="450px" width="640px" alt="imagen de la campaña">
        @else
            <div class="mb-4">
                <img src="{{ asset('storage/'.$imagen->Tpath_imagenes) }}" height="450px" width="640px" alt="imagen de la campaña">
            </div>
        @endif
        </div>
        <div class="grid gap-6 mb-4 md:grid-cols-2">
            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Lugar:</label>    
                <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$campaña->Tlugar_campaña}}" disabled>                
            </div>
            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Fecha de Inicio:</label>    
                <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$campaña->DfechaIni_campaña}}" disabled>                
            </div>
            
            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Hora:</label>    
                <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$campaña->ThoraIni_campaña}}" disabled>                
            </div>
            
            {{-- <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Entidad colaborativa:</label>    
                <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$campaña->Tnombre_colaborador}}" disabled>                
            </div> --}}
            {{-- @if ($estado == "reabrir campaña?")
            <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Fecha de Inicio:</label>    
                    <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$campaña->DfechaFin_campaña}}" disabled>                
                </div>
                
            @else
                
            @endif --}}
            
        </div>

    </div>

    @if ($estado == "Finalizar")

        <div class="flex justify-between items-center mb-4">
            <div>
                <form action="{{route('admin.Asitentes.look')}}" method="POST" >
                    @csrf
                    <input type="text" hidden name="idcampana" value="{{$campaña->PK_Campaña}}" required />
                    <div class="grid gap-6 mb-4 md:grid-cols-2">
                        <div>
                            <input type="text" id="first_name" name="dni" maxlength="8" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ingresar DNI" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                        </div>
                        <div>
                            <button required type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"><i class="fa-solid fa-magnifying-glass"></i></button> 
                        </div>
                    </div>

                </form>
            </div>
            <div >
                <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" id="agregar-asistente" >
                    <i class="fa-solid fa-user"></i>
                    Agregar Asistente
    
                </button>
            </div>

        </div>

        
    @else
        
    @endif
    
    <br>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3" align="center" >
                        #
                    </th>
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
                        Numero DNI
                    </th>
                    <th scope="col" class="px-6 py-3" align="center" >
                        Especialidad
                    </th>
                    <th scope="col" class="px-6 py-3" align="center" >
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (!$resultado)
                    <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                            No hay asistentes registrados
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                            No hay asistentes registrados
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                            No hay asistentes registrados
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                            No hay asistentes registrados
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                            No hay asistentes registrados
                        </th>
                        
                    </tr>
                    
                @else
                    @php
                        $numero=1;
                    @endphp
                    @foreach ($resultado as $resul)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            {{-- <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                {{$asistente->PK_Asistentes}}
                            </th> --}}
                            
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" align="center" >
                                {{$numero}}
                            </th>
                            @php
                                $numero=1+$numero;
                            @endphp
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" align="center" >
                                {{$resul->Tnombre_asistente}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" align="center" >
                                {{$resul->TapellidoP_asistente}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" align="center" >
                                {{$resul->TapellidoM_asistente}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" align="center" >
                                {{$resul->Tdni_asistente}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" align="center" >
                                {{$resul->Tdescripcion_especialidad}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" align="center" >
                                <div class="grid gap-6 mb-4 md:grid-cols-2">
                                    <div>
                                        @can('update-asitentes')
                                            <button class="btnEditarAsistente bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                                                data-id="{{ $resul->PK_Asistentes }}"
                                                data-nombre="{{ $resul->Tnombre_asistente }}"
                                                data-apellidoP="{{ $resul->TapellidoP_asistente }}"
                                                data-apellidoM="{{ $resul->TapellidoM_asistente }}"
                                                data-dni="{{ $resul->Tdni_asistente }}"
                                                data-especialidad="{{ $resul->PK_Especialidades }}">
                                                Editar Asistente
                                            </button>
                                            
                                        @endcan
                                        
                                    </div>
    
                                    <div>
                                        @can('delete-asitentes')
                                            <form action="{{route('admin.Asitentes.edit2',$resul->PK_Asistentes)}}" class="edit-form" method="POST">
                                                @csrf
                                                <input  hidden type="text" name="idCampaña" value="{{$campaña->PK_Campaña}}" id="">
                                                <button type="submit" 
                                                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                                Eliminar 
                                            </button>

                                            </form>
                                            
                                        @endcan
                                        
                                    </div>
                                    
                                </div>
                                
                            </th>
                            
                        </tr>
                    @endforeach
                @endif
        </table>
    </div>
    

   


    
   

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        
        <script>
            //para agregar usuario
                document.getElementById('agregar-asistente').addEventListener('click', function() {
                    Swal.fire({
                        title: 'Agregar Asistente',
                        html: `
                        <form id="formAsistente" >
                            @csrf
                            <div class="grid gap-4 text-left">
                                
                                <input type="text" name="idCampaña" id=""  hidden value="{{$campaña->PK_Campaña}}" class="swal2-input" required>

                                <div>
                                    <label class="block text-sm font-medium text-gray-900">Nombre:</label>
                                    <input type="text" name="nombre" id=""
                                        class="swal2-input" style="width: 90%;"
                                        placeholder="Ingrese el nombre completo"
                                        maxlength="70" required>
                                </div>
                                <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Apellido Paterno:</label>
                                        <input type="text" name="apeP" id="" class="swal2-input" maxlength="50" required>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Apellido Materno:</label>
                                        <input type="text" name="apeM" id="" class="swal2-input" maxlength="50" required>
                                    </div>
                                </div>    
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-900">DNI:</label>
                                <input type="text" name="DNI" id="" class="swal2-input" maxlength="8" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-900">Especialidad:</label>
                                <select name="especialidad" id="especialidad" class="swal2-input" style="width:100%;" required>
                                    <option value="" selected disabled>---Selecciona una especialidad---</option>
                                    @foreach ($especialidades as $especie)
                                        <option value="{{$especie->PK_Especialidades}}">{{$especie->Tdescripcion_especialidad}}</option>
                                    @endforeach
                                </select>
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

                            return fetch("{{ route('admin.Asitentes.store') }}", {
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

        <script>
            //para editar usuario
        document.addEventListener('DOMContentLoaded', function () {
            // Selecciona todos los botones con la clase .btnEditarAsistente
            document.querySelectorAll('.btnEditarAsistente').forEach(button => {
                button.addEventListener('click', function () {
                    // Obtener los datos del asistente desde los atributos data-*
                    const id = this.getAttribute('data-id');
                    const nombre = this.getAttribute('data-nombre');
                    const apellidop = this.getAttribute('data-apellidoP');
                    const apellidom = this.getAttribute('data-apellidoM');
                    const dni = this.getAttribute('data-dni');
                    const especialidad = this.getAttribute('data-especialidad');

                    // Mostrar el SweetAlert2 con el formulario prellenado
                    Swal.fire({
                        title: 'Editar Asistente',
                        html: `
                            <form id="formEditarAsistente">
                                @csrf
                                
                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-900">Nombre:</label>
                                    <input type="text" id="nombre" name="nombre" class="swal2-input"
                                        style="width: 90%;" value="${nombre}" required>
                                </div>

                                <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Apellido Paterno:</label>
                                        <input type="text" id="apellidoP" name="apellidoP" class="swal2-input" value="${apellidop}" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Apellido Materno:</label>
                                        <input type="text" id="apellidoM" name="apellidoM" class="swal2-input" value="${apellidom}" required>
                                    </div>    
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-900">DNI:</label>
                                    <input type="text" id="dni" name="dni" class="swal2-input" value="${dni}" required>
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-900">Especialidad:</label>
                                    <select id="especialidad" name="especialidad" class="swal2-input" style="width:100%;" required>
                                        <option value="" disabled>---Selecciona una especialidad---</option>
                                        @foreach ($especialidades as $especie)
                                            <option value="{{$especie->PK_Especialidades}}" 
                                                ${especialidad == '{{$especie->PK_Especialidades}}' ? 'selected' : ''}>
                                                {{$especie->Tdescripcion_especialidad}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        `,
                        showCancelButton: true,
                        confirmButtonText: 'Guardar cambios',
                        cancelButtonText: 'Cancelar',
                        focusConfirm: false,
                        preConfirm: () => {
                            // Leer los valores del formulario dentro del SweetAlert
                            const nombre = Swal.getPopup().querySelector('#nombre').value;
                            const apellidoP = Swal.getPopup().querySelector('#apellidoP').value;
                            const apellidoM = Swal.getPopup().querySelector('#apellidoM').value;
                            const dni = Swal.getPopup().querySelector('#dni').value;
                            const especialidad = Swal.getPopup().querySelector('#especialidad').value;

                            if (!nombre || !apellidoP || !apellidoM || !dni || !especialidad) {
                                Swal.showValidationMessage(`Por favor completa todos los campos`);
                                return false;
                            }

                            return { id, nombre, apellidoP, apellidoM, dni, especialidad };
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const datos = result.value;
                            const formData = new FormData();
                            formData.append('_method', 'PUT'); // importante para que Laravel lo trate como PUT
                            formData.append('nombre', datos.nombre);
                            formData.append('apellidoP', datos.apellidoP);
                            formData.append('apellidoM', datos.apellidoM);
                            formData.append('dni', datos.dni);
                            formData.append('especialidad', datos.especialidad);

                            fetch(`/admin/Asitentes/${datos.id}`, {
                                method: 'POST', // Laravel reconocerá PUT por el _method
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: formData
                            })
                            .then(res => {
                                if (!res.ok) throw new Error('Error en la actualización');
                                return res.json();
                            })
                            .then(data => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Actualizado',
                                    text: 'El asistente fue editado correctamente'
                                }).then(() => location.reload());
                            })
                            .catch(err => {
                                Swal.fire('Error', 'No se pudo actualizar el asistente', 'error');
                                console.error(err);
                            });
                        }
                    });
                });
            });
        });
        </script>

        <script>
        //que seleciona todos esos formularios que tengan ese nombre de delete-form 
            forms = document.querySelectorAll('.edit-form')
            //que recorra todos los formularios
            forms.forEach(form => {
                //que se ponga al escucha de ese formulario con el evento submit
                form.addEventListener('submit',function(e){ //e es el evento en si
                    //previne el evento 
                    e.preventDefault('');
                        Swal.fire({
                            title: "Eliminar a este usuario de la campaña?",
                            text: "no podrás revertir esto",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Si, eliminar",
                            cancelButtonText: "No cancelar"
                            }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });    
                });
            });
        </script>

    @endpush


</x-admin-layout>