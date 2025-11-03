<x-admin-layout>
    <div class="flex justify-center mt-4" >
        <h1 class="text-8xl font-extrabold">
            {{$campaña->Tnombre_Tipocampaña}}
        </h1>
    </div>

    @if ($estado == "Finalizar")
        <div class="flex justify-end">
            <form action="{{route('admin.Campañas.update',$campaña->PK_Campaña)}}" method="POST" class="finalizar-form" >
                @method('PUT')
                @csrf
                <input type="text" name="situacion" value="1" hidden>
                <button type="submit"  class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    {{$estado}}
                </button>
            </form>
        </div>
    @endif
    @if ($estado == "Empesar antes de tiempo")
        <div class="flex justify-end">
            <form action="{{route('admin.Campañas.update',$campaña->PK_Campaña)}}" method="POST" class="adelantar-form" >
                @method('PUT')
                @csrf
                <input type="text" name="situacion" value="2" hidden >
                <button type="submit"  class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    {{$estado}}
                </button>
            </form>
        </div>
        
    @endif
    @if ($estado == "reabrir campaña?")
        <div class="flex justify-end">
            <form action="{{route('admin.Campañas.update',$campaña->PK_Campaña)}}" method="POST" class="reabrir-form" >
                @method('PUT')
                @csrf
                <input type="text" name="situacion" value="3" hidden >
                <button type="submit"  class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    {{$estado}}
                </button>
            </form>
        </div>
        
    @endif


    <br>
    <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4 ">
        <div>
            aca va la imagen
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

            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad de Participantes:</label>    
                <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$cantidad}}" disabled>                
            </div>
            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Entidad colaborativa:</label>    
                <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$campaña->Tnombre_colaborador}}" disabled>                
            </div>
            @if ($estado == "reabrir campaña?")
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Fecha de Inicio:</label>    
                    <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$campaña->DfechaFin_campaña}}" disabled>                
                </div>
                
            @else
                
            @endif
        </div>

    </div>
    
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
                @if (!$asistentes)
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
                    @foreach ($asistentes as $asistente)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                {{$asistente->PK_Asistentes}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                {{$asistente->Tnombre_asistente}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                {{$asistente->TapellidoP_asistente}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                {{$asistente->TapellidoM_asistente}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                {{$asistente->Tdni_asistente}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                {{$asistente->Tdescripcion_especialidad}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                <div class="grid gap-6 mb-4 md:grid-cols-2">
                                    <div>
                                        {{-- <button 
                                            onclick="mostrarAsistente({{ json_encode($asistente) }})" 
                                            class="text-white bg-blue-700 hover:bg-blue-800 px-3 py-1 rounded-lg">
                                            Ver Detalles
                                        </button> --}}
                                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                                            Toggle modal
                                        </button>
                                        
                                    </div>
    
                                    <div>
                                        <form action="{{route('admin.Asitentes.update',$asistente->PK_Asistentes)}}" class="edit-form" method="POST">
                                            @method('PUT')
                                            @csrf
                                            <button type="submit" 
                                                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                               Eliminar 
                                           </button>

                                        </form>
                                    </div>
                                    
                                </div>
                                
                            </th>
                            
                        </tr>
                    @endforeach
                @endif
        </table>
    </div>


    

    <!-- Modal EDICION USUARIO -->
    {{-- <div id="modalAsistente" tabindex="-1" aria-hidden="true"
        class="hidden fixed inset-0 flex items-center justify-center bg-gray-900/50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-5">
            <h3 class="text-lg font-bold mb-4">Detalles del Asistente</h3>
            <p><strong>Nombre:</strong> <span id="nombreAsistente"></span></p>
            <p><strong>DNI:</strong> <span id="dniAsistente"></span></p>
            <p><strong>Especialidad:</strong> <span id="especialidadAsistente"></span></p>
            <div class="mt-5 text-right">
                <button onclick="cerrarModal()" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Cerrar</button>
            </div>
        </div>
    </div> --}}
    <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this product?</h3>
                    <button data-modal-hide="popup-modal" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Yes, I'm sure
                    </button>
                    <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
                </div>
            </div>
        </div>
    </div>


    
    <!-- AGREGAR -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <div x-data="{ open: false }" class="flex justify-between items-center mt-4 px-8">
        <!-- Botón Izquierdo -->
        <button class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Cancelar
        </button>

        <!-- Botón Derecho: abre el modal -->
        @if ($estado == "Finalizar")
            <button 
                @click="open = true"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                <i class="fa-solid fa-user"></i>
                Agregar Asistente
            </button>
            
        @else
            
        @endif

        <!-- Modal -->
        <div x-show="open"class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-96 p-6">
                
                <div class="flex justify-center mt-4" >

                    <h2 class="text-lg font-semibold mb-4">Agregar usuario</h2>
                </div>
                <form action="{{route('admin.Asitentes.store')}}" method="POST">
                    @csrf
                    <div class="flex justify-end gap-3">
                        <button 
                            @click="open = false"
                            class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500">
                            Cancelar
                        </button>
                        <button type="submit" 
                            @click="open = false"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">

                            Confirmar
                        </button>
                    </div>
                    <input type="text" name="campañaId" hidden value=" {{$campaña->PK_Campaña}}">
                    <div >
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">DNI:</label>    
                        <div class="flex justify-center mt-4" >
                            <input required type="text" name="AsitenteDni" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  >                
                        </div>
                    </div>
    
                    <div class="grid gap-6 mb-4 md:grid-cols-3">
                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Nombre:</label>    
                            <input required type="text" name="AsistenteName"  aria-label=" input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  >                
                        </div>
                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Apellido Paterno:</label>    
                            <input required type="text" name="AsistenteApelliP" aria-label=" input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  >                
                        </div>
                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Apellido Materno:</label>    
                            <input required type="text" name="AsistenApellM"  aria-label=" input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  >                
                        </div>
                    </div>
                    <div>
                        <label for="especialidades" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Elige una especialidad</label>
                        <div class="flex justify-center mt-4" >
                            <select required name="especialidad" id="miSelect-especialidad"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value=""selected disabled >---Seleccioné una especialidad---</option>
                                @foreach ($especialidades as $especialidad)
                                    <option value="{{$especialidad->PK_Especialidades}}" >{{$especialidad->Tdescripcion_especialidad}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </form>

                
            </div>
        </div>
    </div>


    @push('js')
        <script>
            function mostrarAsistente(asistente) {
                // Rellena los campos del modal
                document.getElementById('nombreAsistente').innerText = asistente.Tnombre_asistente;
                document.getElementById('dniAsistente').innerText = asistente.Tdni_asistente;
                document.getElementById('especialidadAsistente').innerText = asistente.Tdescripcion_especialidad;
                
                // Muestra el modal
                document.getElementById('modalAsistente').classList.remove('hidden');
            }

            function cerrarModal() {
                document.getElementById('modalAsistente').classList.add('hidden');
            }
        </script>


        <script>
            $(document).ready(function() {
                $('#miSelect-especialidad').select2({
                placeholder: "---Seleccioné una especialidad---",
                allowClear: true
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
        <script>
        //que seleciona todos esos formularios que tengan ese nombre de delete-form 
            forms = document.querySelectorAll('.reabrir-form')
            //que recorra todos los formularios
            forms.forEach(form => {
                //que se ponga al escucha de ese formulario con el evento submit
                form.addEventListener('submit',function(e){ //e es el evento en si
                    //previne el evento 
                    e.preventDefault('');
                        Swal.fire({
                            title: "Desea reabrir la campaña ahora?",
                            //text: "no podrás revertir esto",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Si, reabrir",
                            cancelButtonText: "No, cancelar"
                            }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });    
                });
            });
        </script>
        <script>
        //que seleciona todos esos formularios que tengan ese nombre de delete-form 
            forms = document.querySelectorAll('.finalizar-form')
            //que recorra todos los formularios
            forms.forEach(form => {
                //que se ponga al escucha de ese formulario con el evento submit
                form.addEventListener('submit',function(e){ //e es el evento en si
                    //previne el evento 
                    e.preventDefault('');
                        Swal.fire({
                            title: "Desea finalizar la campaña ahora?",
                            //text: "no podrás revertir esto",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Si, finalizar",
                            cancelButtonText: "No, cancelar"
                            }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit();
                            }
                        });    
                });
            });
        </script>
        <script>
        //que seleciona todos esos formularios que tengan ese nombre de delete-form 
            forms = document.querySelectorAll('.finalizar-form')
            //que recorra todos los formularios
            forms.forEach(form => {
                //que se ponga al escucha de ese formulario con el evento submit
                form.addEventListener('submit',function(e){ //e es el evento en si
                    //previne el evento 
                    e.preventDefault('');
                        Swal.fire({
                            title: "Desea finalizar la campaña ahora?",
                            //text: "no podrás revertir esto",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Si, finalizar",
                            cancelButtonText: "No, cancelar"
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