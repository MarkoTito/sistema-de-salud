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
                        Numero de celular
                    </th>
                    <th scope="col" class="px-6 py-3" align="center" >
                        Edad
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
                                {{$resul->Tcelular_asistente}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" align="center" >
                                {{$resul->Nedad_asistente}}
                            </th>

                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white" align="center" >
                                <div class="grid gap-6 mb-4 md:grid-cols-2">
                                    <div>
                                        @can('update-asitentes')
                                            <div>
                                                <button class="btnEditarAsistente bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                                                    data-id="{{ $resul->PK_Asistentes }}"
                                                    data-nombre="{{ $resul->Tnombre_asistente }}"
                                                    data-apellidoP="{{ $resul->TapellidoP_asistente }}"
                                                    data-apellidoM="{{ $resul->TapellidoM_asistente }}"
                                                    data-edad="{{ $resul->Nedad_asistente }}"
                                                    data-celular="{{ $resul->Tcelular_asistente }}"
                                                    data-dni="{{ $resul->Tdni_asistente }}">
                                                    Editar Asistente
                                                </button>
                                                
                                            </div>
                                            
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
            document.addEventListener('DOMContentLoaded', function () {
            
                document.querySelectorAll('.btnEditarAsistente').forEach(button => {
                    button.addEventListener('click', function () {
            
                        const id        = this.getAttribute('data-id');
                        const nombre    = this.getAttribute('data-nombre');
                        const apellidoP = this.getAttribute('data-apellidoP');
                        const apellidoM = this.getAttribute('data-apellidoM');
                        const dni       = this.getAttribute('data-dni');
                        const edad      = this.getAttribute('data-edad');
                        const celular   = this.getAttribute('data-celular');
            
                        const nombreSeguro    = nombre.replace(/"/g, '&quot;');
                        const apellidoPSeguro = apellidoP.replace(/"/g, '&quot;');
                        const apellidoMSeguro = apellidoM.replace(/"/g, '&quot;');
            
                        Swal.fire({
                            title: 'Editar Asistentes',
                            showCancelButton: true,
                            confirmButtonText: 'Guardar cambios',
                            cancelButtonText: 'Cancelar',
                            focusConfirm: false,
            
                            html: `
                            <form id="formEditarAsistente">
            
                                <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
                                    <div>
                                        <label>Nombre:</label>
                                        <input type="text" id="nombre" class="swal2-input"
                                            value="${nombreSeguro}" required>
                                    </div>
            
                                    
            
                                    <div>
                                        <label>Apellido Paterno:</label>
                                        <input type="text" id="apellidoP" class="swal2-input"
                                            value="${apellidoPSeguro}" required>
                                    </div>
            
                                    <div>
                                        <label>Apellido Materno:</label>
                                        <input type="text" id="apellidoM" class="swal2-input"
                                            value="${apellidoMSeguro}" required>
                                    </div>
                                    
            
                                    <div>
                                        <label>DNI:</label>
                                        <input type="text" id="dni" class="swal2-input"
                                            maxlength="8"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                            value="${dni}" required>
                                    </div>
            
                                    <div>
                                        <label>Celular:</label>
                                        <input type="text" id="celular" class="swal2-input"
                                            maxlength="9"
                                            oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                            value="${celular}" required>
                                    </div>
                                    <div>
                                        <label>Edad:</label>
                                        <input type="number"
                                        id="edad"
                                        class="swal2-input"
                                        min="0" max="999"
                                        oninput="this.value=this.value.slice(0,3)"
                                        required
                                        style="width:50%;">
                                    </div>

                                </div>
                            </form>
                            `,
            
                            preConfirm: () => {
                                const nombre    = Swal.getPopup().querySelector('#nombre').value;
                                const apellidoP = Swal.getPopup().querySelector('#apellidoP').value;
                                const apellidoM = Swal.getPopup().querySelector('#apellidoM').value;
                                const dni       = Swal.getPopup().querySelector('#dni').value;
                                const edad      = Swal.getPopup().querySelector('#edad').value;
                                const celular   = Swal.getPopup().querySelector('#celular').value;
            
                                if (!nombre || !apellidoP || !apellidoM || !dni || !edad || !celular) {
                                    Swal.showValidationMessage('Completa todos los campos');
                                    return false;
                                }
            
                                return { id, nombre, apellidoP, apellidoM, dni, edad, celular };
                            }
            
                        }).then(result => {
                            if (result.isConfirmed) {
            
                                const d = result.value;
                                const formData = new FormData();
            
                                formData.append('_method', 'PUT');
                                formData.append('nombre', d.nombre);
                                formData.append('apellidoP', d.apellidoP);
                                formData.append('apellidoM', d.apellidoM);
                                formData.append('dni', d.dni);
                                formData.append('edad', d.edad);
                                formData.append('celular', d.celular);
            
                                fetch(`/admin/Asitentes/${d.id}`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: formData
                                })
                                .then(res => {
                                    if (!res.ok) throw new Error('Error al actualizar');
                                    return res.json();
                                })
                                .then(() => {
                                    Swal.fire(
                                        'Actualizado',
                                        'El asistente fue editado correctamente',
                                        'success'
                                    ).then(() => location.reload());
                                })
                                .catch(() => {
                                    Swal.fire('Error', 'No se pudo actualizar', 'error');
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