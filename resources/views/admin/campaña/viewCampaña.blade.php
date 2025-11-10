<x-admin-layout>
    
    <div class="flex justify-end mb-4 ">
        <a href="{{route('admin.Campañas.create')}}">
            <button  class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                <i class="fa-solid fa-plus"></i> Agregar Campaña
            </button>

        </a>
    </div>

    <br>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between pb-4">
            <div>
                
                <!-- Dropdown menu -->
                <div id="dropdownRadio" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow-sm dark:bg-gray-700 dark:divide-gray-600" data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate3d(522.5px, 3847.5px, 0px);">
                    <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownRadioButton">
                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input id="filter-radio-example-1" type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="filter-radio-example-1" class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Last day</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input checked="" id="filter-radio-example-2" type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="filter-radio-example-2" class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Last 7 days</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input id="filter-radio-example-3" type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="filter-radio-example-3" class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Last 30 days</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input id="filter-radio-example-4" type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="filter-radio-example-4" class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Last month</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center p-2 rounded-sm hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input id="filter-radio-example-5" type="radio" value="" name="filter-radio" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="filter-radio-example-5" class="w-full ms-2 text-sm font-medium text-gray-900 rounded-sm dark:text-gray-300">Last year</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                </div>
                <input type="text" id="table-search" class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search for items">
            </div> --}}
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        {{-- <th scope="col" class="p-4">
                            <div class="flex items-center">
                                <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all-search" class="sr-only">checkbox</label>
                            </div>
                        </th> --}}
                        <th scope="col" class="px-6 py-3" align="center" >
                            Numero 
                        </th>
                        <th scope="col" class="px-6 py-3" align="center" >
                            Nombre de la campaña
                        </th>
                        <th scope="col" class="px-6 py-3" align="center" >
                            Lugar
                        </th>
                        <th scope="col" class="px-6 py-3" align="center" >
                            Fecha de inicio
                        </th>
                        <th scope="col" class="px-6 py-3" align="center" >
                            Hora de inicio
                        </th>
                        <th scope="col" class="px-6 py-3" align="center" >
                            Estado
                        </th>
                        <th scope="col" class="px-6 py-3" align="center" >
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$campañas)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                No existe campaña
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                No existe campaña
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                No existe campaña
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                No existe campaña
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                No existe campaña
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                No existe campaña
                            </th>
                        </tr>    
                    @else
                        @foreach ($campañas as $campaña)
                            <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                                {{-- <td class="w-4 p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                    </div>
                                </td> --}}
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                    {{$campaña->PK_Campaña}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                    {{$campaña->Tnombre_Tipocampaña}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                    {{$campaña->Tlugar_campaña}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                    {{$campaña->DfechaIni_campaña}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                    {{$campaña->ThoraIni_campaña}}
                                </th>
                                @if ($campaña->Nestado_campaña ==1)
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-blue-600" align="center" >
                                        Pendiente
                                    </th>
                                    
                                @endif
                                @if ($campaña->Nestado_campaña ==2)
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-green-600" align="center" >
                                        Abierto
                                    </th>
                                @endif
                                @if ($campaña->Nestado_campaña ==3)
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap  text-red-600" align="center" >
                                        Finalizado
                                    </th>
                                @endif
                                
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                    <a href="{{route('admin.Asitentes.show',$campaña->PK_Campaña)}}"> 
                                        <i class="fa-solid fa-download"></i>   
                                    </a>
                                    <a href="{{route('admin.Campañas.show',$campaña->PK_Campaña)}}">
                                        <i class="fa-solid fa-eye"></i>   
                                    </a>
                                    <a href="{{route('admin.Campañas.edit',$campaña->PK_Campaña)}}">
                                        <i class="fa-solid fa-pen-to-square"></i>   
                                    </a>
                                    <a href="{{route('admin.Configuracion.edit',$campaña->PK_Campaña)}}" class="btn-finalizar" data-nombre="{{ $campaña->Tnombre_Tipocampaña }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                    
                                    
                                    
                                </th>

                                
                            </tr>
                            
                        @endforeach
                        
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $campañas->links() }}
    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.getElementById('btnAgregarCampania').addEventListener('click', function() {
                Swal.fire({
                    title: 'Registrar Campaña',
                    html: `
                    <form id="formCampania" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="grid gap-4 text-left">
                            <div>
                                <label class="block text-sm font-medium text-gray-900">Tipo de Campaña:</label>
                                <select name="Campañas" id="tipoCampaña" class="swal2-input" style="width:100%;">
                                    <option value="" selected disabled>---Selecciona una campaña---</option>
                                    @foreach ($Tiposcampañas as $campaña)
                                        <option value="{{$campaña->PK_TiposCampañas}}">{{$campaña->Tnombre_Tipocampaña}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-900">Lugar:</label>
                                <input type="text" name="Tlugar_campaña" id="Tlugar_campaña"
                                    class="swal2-input"
                                    style="width: 90%;"
                                    placeholder="Ingrese el lugar completo"
                                    maxlength="120" required>
                            </div>
                            <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-900">Fecha de inicio:</label>
                                    <input type="date" name="DfechaIni_campaña" id="DfechaIni_campaña" class="swal2-input" min="{{ date('Y-m-d') }}" required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-900">Hora de inicio:</label>
                                    <input type="time" name="hora_inicio" id="hora_inicio" class="swal2-input" required>
                                </div>
                            
                            </div>
                            

                            <div>
                                <label class="block text-sm font-medium text-gray-900">Colaborador:</label>
                                <select name="colaborador" id="colaborador" class="swal2-input" style="width:100%;" required>
                                    <option value="" selected disabled>---Selecciona un colaborador---</option>
                                    @foreach ($Colaboradores as $colaborador)
                                        <option value="{{$colaborador->PK_Colaborador}}">{{$colaborador->Tnombre_colaborador}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                    `,
                    focusConfirm: false,
                    showCancelButton: true,
                    confirmButtonText: 'Registrar',
                    cancelButtonText: 'Cancelar',
                    width: '600px',
                    preConfirm: () => {
                        const form = document.getElementById('formCampania');
                        const formData = new FormData(form);

                        return fetch("{{ route('admin.Campañas.store') }}", {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (!data.ok) {
                                Swal.showValidationMessage(data.msg || 'No se pudo crear la campaña');
                            }
                            return data;
                        })
                        .catch(error => {
                            Swal.showValidationMessage(`Error: ${error}`);
                        });
                    }
                }).then((result) => {
                    if (result.isConfirmed && result.value.ok) {
                        Swal.fire('Éxito', 'Campaña creada correctamente', 'success')
                            .then(() => location.reload());
                    }
                });
            });
    </script>




        <script>
            document.querySelectorAll('.btn-finalizar').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault(); 

                    const url = this.getAttribute('href');
                    const nombre = this.getAttribute('data-nombre');

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Vas a eliminar la campaña: " + nombre,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = url; // redirige si confirma
                        }
                    });
                });
            });
        </script>
    @endpush


   
    

    
    

</x-admin-layout>