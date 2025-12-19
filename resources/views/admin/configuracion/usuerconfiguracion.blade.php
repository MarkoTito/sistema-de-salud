
<x-admin-layout>

    {{-- <p class="text-sm text-gray-500 dark:text-gray-400">Formulario para creaciòn de usuario:</p> --}}

    <!-- Botón que cambia -->
    <div class="flex justify-end">
        <button type="button" 
                onclick="
                    document.getElementById('formulario').classList.remove('hidden');
                    document.getElementById('inputInicial').classList.add('hidden');
                " 
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Agregar usuario
        </button>
    </div>

    <!-- Formulario oculto -->
    <div id="formulario" class="hidden mt-4 p-4 border rounded-lg shadow bg-white">
        <div class="flex justify-end">
            <button type="button" 
                        onclick="
                            document.getElementById('formulario').classList.add('hidden');
                            document.getElementById('inputInicial').classList.remove('hidden');
                        "
                        class="ml-2 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                    Regresar
                </button>
        </div>
        <form class="max-w-md mx-auto" action="{{route('admin.usuarios.store')}}" method="POST" > 
            @csrf
            <div class="grid md:grid-cols-2 md:gap-6">
                {{-- email --}}
                <div class="relative z-0 w-full mb-5 group">
                    <input type="email" name="email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="{{old('email')}}" required />
                    <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Correo electronico</label>
                </div>
                {{-- permisos --}}
                <div class="grid gap-6 mb-4 md:grid-cols-3" id="radios">
                    <select required  style="width: 450%" name="permiso" id="permiso">
                        <option selected  disabled value="nada">Seleccione una opción</option>
                        <option value="admin">Cordinador-Todos los accessos</option>
                        <option value="all-salud">Salud - Todos los accessos</option>
                        <option value="nivel1-campaña">Campañas - Nivel 1</option>
                        <option value="nivel2-campaña">Campañas - Nivel 2</option>
                        <option value="nivel1-charla">Charla - Nivel 1</option>
                        <option value="nivel2-charla">Charla - Nivel 2</option>
                        <option value="admin-mascotas">Mascota - Todos los accesos</option>
                        <option value="campaña-veterinaria">Campañas - Macotas</option>
                        <option value="charla-veterinaria">Charlas - Mascotas</option>
                    </select>
                </div>
                
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                
                <div class="relative z-0 w-full mb-5 group">
                    {{-- contraseña --}}
                    <input type="password" name="password" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Contraseña</label>
                </div>

                <div class="relative z-0 w-full mb-5 group">
                    {{-- confirmar contraseña --}}
                    <input type="password" name="password_confirmation" id="floating_repeat_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="floating_repeat_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirmar contraseña</label>
                </div>
            </div>

            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    {{-- nombre --}}
                    <input type="text" name="name" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="{{old('name')}}" required />
                    <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombres</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    {{-- lastname --}}
                    <input type="text" name="lastname" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-black dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" value="{{old('lastname')}}" required />
                    <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Apellidos</label>
                </div>
            </div>
            
            <div class="flex justify-center mt-4">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Registrar</button>
            </div>
            
        </form>
        <br>
        {{-- aca mensaje de permisos --}}
        
        <div class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert" id="permiso1" style="display: none;">
            
            <span class="sr-only">Info</span>
            <div>
                <i class="fa-solid fa-eye"></i> <span class="font-medium">Permiso 1!</span> Registra, edita, visualiza, da de baja y reverte baja a cualquier tipo de bien, realiza reparaciones y acceso total a la sección Mas.
            </div>
        </div>

        <div class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert" id="permiso2" style="display: none;">
            
            <span class="sr-only">Info</span>
            <div>
                <i class="fa-solid fa-eye"></i> <span class="font-medium">Permiso 2!</span> Registra, edita, visualiza, da de baja y reverte baja a cualquier tipo de bien, realiza reparaciones.
            </div>
        </div>

        <div class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 dark:border-blue-800" role="alert" id="permiso3" style="display: none;">
            
            <span class="sr-only">Info</span>
            <div>
                <i class="fa-solid fa-eye"></i> <span class="font-medium">Permiso 3!</span> Solo registra y visualiza cualquier tipo de bien, ademas registra y realiza reparaciones.
            </div>
        </div>

        
    </div>
    <!-- Input que está desde el inicio -->
    <div id="inputInicial" class="mb-4">
        {{-- tabla --}}
        <br>
        <p class="text-sm text-gray-500 dark:text-gray-400">Usuarios</p>
        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-fg-brand-subtle">
                <thead class="text-sm text-black bg-brand-strong">
                    <tr class="bg-brand border-b border-brand-light">
                        <th scope="col" class="px-6 py-3" align="center" >
                            Nombres
                        </th>
                        <th scope="col" class="px-6 py-3" align="center" >
                            Apellidos
                        </th>
                        <th scope="col" class="px-6 py-3" align="center" >
                            Correo
                        </th>
                        <th scope="col" class="px-6 py-3" align="center" >
                            Fecha de creacion
                        </th>
                        <th scope="col" class="px-6 py-3" align="center" >
                            Estado
                        </th>
                        <th scope="col" class="px-6 py-3" align="center" >
                            Accion
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$users)
                        <tr class="bg-brand border-b border-brand-light">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                No existe ninguna usuario
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                No existe ninguna usuario
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                No existe ninguna usuario
                            </th>
                        </tr>
                        
                    @else
                        @foreach ($users as $user)
                            @if ($user->id==1)
                                
                            @else
                                <tr class="bg-brand border-b border-brand-light">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        {{$user->name}}
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        {{$user->Tapellidos_user}}
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        {{$user->email}}
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        {{$user->created_at}}
                                    </th>
                                    @if ($user->Nestado_user ==0)
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-red-500" align="center" >
                                            Deshabilitado
                                        </th>
                                    @else
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-blue-600" align="center" >
                                            Habilitado
                                        </th>                                            
                                    @endif
                                    @if ($user->Nestado_user ==1)
                                        <th scope="row" class="px-6 py-4 font-medium  whitespace-nowra " align="center"  >
                                            <div class="grid gap-2 mb-4 md:grid-cols-3 mt-1">
                                                <div class="text-red-500" >
                                                    <form action="{{route('admin.usuarios.destroy',$user->id)}}" method="POST" class="delete-form-user">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button>
                                                            <span class="w-6 h-6 inline-flex justify-center items-center">
                                                                <i class="fa-solid fa-circle-xmark"></i>
                                                            </span>
                                                        </button>
    
                                                    </form>
                                                </div>
                                                <div class="text-green-500" >
                                                    <div>
                                                        <a class="btnEditarcontraseña  text-black"
                                                            data-id="{{ $user->id }}"
                                                            data-nombre="{{$user->name}}"
                                                            data-apellidos="{{ $user->Tapellidos_user }}">
                                                            <i class="fa-solid fa-key"></i>
                                                        </a>
                                                        
                                                    </div>
                                                </div>
                                                <div class="text-green-500" >
                                                    <div>
                                                        <a class="btnEditarAsistente  text-green"
                                                            data-id="{{ $user->id }}"
                                                            data-nombre="{{$user->name}}"
                                                            data-apellidos="{{ $user->Tapellidos_user }}"
                                                            data-email="{{ $user->email }}" >
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </th>                                                
                                    @else
                                        <th scope="row" class="px-6 py-4 font-medium  whitespace-nowra  dark:text-red-500" align="center"  >
                                            <div class="text-blue-500" >
                                                <form action="{{route('admin.usuarios.show',$user->id)}}" method="GET" class="up-form-user">
                                                    @csrf
                                                    <button>
                                                        <span class="w-6 h-6 inline-flex justify-center items-center">
                                                            <i class="fa-solid fa-circle-up"></i>
                                                        </span>
                                                    </button>

                                                </form>
                                            </div>
                                            
                                        </th>
                                    @endif    
                                    
                                
                        
                                </tr>
                                
                            @endif
                            
                        @endforeach
                        
                    @endif
                    
                    
                </tbody>
            </table>
        </div>
        {{-- {{$tipos->links()}} --}}
    </div>



    @push('js')
        <script>
        //que seleciona todos esos formularios que tengan ese nombre de delete-form-area 
            forms = document.querySelectorAll('.delete-form-user')
            //que recorra todos los formularios
            forms.forEach(form => {
                //que se ponga al escucha de ese formulario con el evento submit
                form.addEventListener('submit',function(e){ //e es el evento en si
                    //previne el evento 
                    e.preventDefault('');
                        Swal.fire({
                            title: "Deshabilitar esta usuario?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Si, Deshabilitar usuario",
                            cancelButtonText: "No cancelar"
                            }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });    
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                document.querySelectorAll('.btnEditarcontraseña').forEach(button => {
                    button.addEventListener('click', function () {

                        const id = this.getAttribute('data-id');
                        const nombre = this.getAttribute('data-nombre');
                        const apellidos = this.getAttribute('data-apellidos');

                        Swal.fire({
                            title: 'Editar Contraseña',
                            html: `
                                <form id="formEditarAsistente">
                                    @csrf

                                    <input type="hidden" id="tipo" name="tipo" value="2">
                                    <div class=" mb-4">
                                        <h1>Usuario: ${nombre} ${apellidos}</h1>
                                    </div>    
                                    
                                    

                                    <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-900">Contraseña:</label>
                                            <input type="password" id="password" name="password" class="swal2-input"
                                                style="width: 85%;" maxlength="65" required>
                                        </div>    
                                        <div>
                                            <label class="block text-sm font-medium text-gray-900">Confirmar Contraseña:</label>
                                            <input type="password" id="password_confirmation" name="password_confirmation"
                                                class="swal2-input" style="width: 85%;" maxlength="65" required>
                                        </div>
                                    </div>

                                    <div class=" mb-4">
                                        <p>Ingrese una nueva contraseña </p>
                                    </div>                                        

                                </form>
                            `,
                            showCancelButton: true,
                            confirmButtonText: 'Guardar cambios',
                            cancelButtonText: 'Cancelar',
                            focusConfirm: false,

                            preConfirm: () => {

                                const password = Swal.getPopup().querySelector('#password').value;
                                const password_confirmation = Swal.getPopup().querySelector('#password_confirmation').value;
                                const tipo = Swal.getPopup().querySelector('#tipo').value;

                                if (!password || !password_confirmation) {
                                    Swal.showValidationMessage(`Completa todos los campos`);
                                    return false;
                                }

                                return { id, password, password_confirmation, tipo };
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {

                                const datos = result.value;
                                const formData = new FormData();
                                formData.append('_method', 'PUT');
                                formData.append('password', datos.password);
                                formData.append('password_confirmation', datos.password_confirmation);
                                formData.append('tipo', datos.tipo);

                                fetch(`/admin/usuarios/${datos.id}`, {
                                    method: 'POST',
                                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                    body: formData
                                })
                                .then(res => res.json())
                                .then(data => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Actualizado',
                                        text: 'La contraseña fue actualizada correctamente'
                                    }).then(() => location.reload());
                                })
                                .catch(err => {
                                    console.error(err);
                                    Swal.fire('Error', 'No se pudo actualizar', 'error');
                                });
                            }
                        });

                    });
                });
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                document.querySelectorAll('.btnEditarAsistente').forEach(button => {
                    button.addEventListener('click', function () {

                        const id = this.getAttribute('data-id');
                        const nombre = this.getAttribute('data-nombre');
                        const apellidos = this.getAttribute('data-apellidos');
                        const email = this.getAttribute('data-email');

                        Swal.fire({
                            title: 'Editar Asistente',
                            html: `
                                <form id="formEditarAsistente">
                                    @csrf

                                    <input type="hidden" id="tipo" name="tipo" value="1">

                                    <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-900">Nombre:</label>
                                            <input type="text" id="nombre" value="${nombre}" class="swal2-input" style="width:75%;" required>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-900">Apellidos:</label>
                                            <input type="text" id="apellidos" value="${apellidos}" class="swal2-input" style="width:75%;" required>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-900">Email:</label>
                                        <input type="text" id="email" value="${email}" class="swal2-input" style="width:90%;" required>
                                    </div>
                                    <div class="just flex-center mb-4 ">
                                        <label class="block text-sm font-medium text-gray-900">Permisos</label>
                                        <select required  style="width: 100%" name="permiso" id="permiso">
                                            <option selected  disabled value="nada">Seleccione una opción</option>
                                            <option value="admin">Cordinador-Todos los accessos</option>
                                            <option value="all-salud">Salud - Todos los accessos</option>
                                            <option value="nivel1-campaña">Campañas - Nivel 1</option>
                                            <option value="nivel2-campaña">Campañas - Nivel 2</option>
                                            <option value="nivel1-charla">Charla - Nivel 1</option>
                                            <option value="nivel2-charla">Charla - Nivel 2</option>
                                            <option value="admin-mascotas">Mascota - Todos los accesos</option>
                                        </select>
                                    </div>
                                </form>
                            `,
                            showCancelButton: true,
                            confirmButtonText: 'Guardar cambios',
                            cancelButtonText: 'Cancelar',
                            focusConfirm: false,

                            preConfirm: () => {

                                const nombre = Swal.getPopup().querySelector('#nombre').value;
                                const apellidos = Swal.getPopup().querySelector('#apellidos').value;
                                const email = Swal.getPopup().querySelector('#email').value;
                                const tipo = Swal.getPopup().querySelector('#tipo').value;
                                const permiso = Swal.getPopup().querySelector('#permiso').value;

                                if (!nombre || !apellidos || !email || !permiso) {
                                    Swal.showValidationMessage(`Completa todos los campos`);
                                    return false;
                                }

                                return { id, nombre, apellidos, email, tipo ,permiso };
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {

                                const datos = result.value;
                                const formData = new FormData();
                                formData.append('_method', 'PUT');
                                formData.append('nombre', datos.nombre);
                                formData.append('apellidos', datos.apellidos);
                                formData.append('email', datos.email);
                                formData.append('tipo', datos.tipo);
                                formData.append('permiso', datos.permiso);

                                fetch(`/admin/usuarios/${datos.id}`, {
                                    method: 'POST',
                                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                                    body: formData
                                })
                                .then(res => res.json())
                                .then(data => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Actualizado',
                                        text: 'El asistente fue editado correctamente'
                                    }).then(() => location.reload());
                                })
                                .catch(err => {
                                    console.error(err);
                                    Swal.fire('Error', 'No se pudo actualizar', 'error');
                                });
                            }
                        });

                    });
                });
            });
        </script>

        <script>
        //que seleciona todos esos formularios que tengan ese nombre de delete-form-area 
            forms = document.querySelectorAll('.up-form-user')
            //que recorra todos los formularios
            forms.forEach(form => {
                //que se ponga al escucha de ese formulario con el evento submit
                form.addEventListener('submit',function(e){ //e es el evento en si
                    //previne el evento 
                    e.preventDefault('');
                        Swal.fire({
                            title: "Habilitar esta usuario?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Si, Habilitar usuario",
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