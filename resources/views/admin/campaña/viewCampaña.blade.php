<x-admin-layout :breadcrumbs="[
    [
        'name'=>'Menu',
        'href' => '/',
    ],
    [
        'name'=> 'Campañas',
    ]
    ]">
    
    @can('create-campañas')
        <div class="flex justify-end mb-4 ">
            <a href="{{route('admin.Campañas.create')}}">
                <button  class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    <i class="fa-solid fa-plus"></i> Agregar Campaña
                </button>

            </a>
        </div>
        
    @endcan

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
   
        </div>
        <div class="">
            <table class="w-full text-sm text-left rtl:text-right text-fg-brand-subtle">
            <thead class="text-sm text-black bg-brand-strong">
                    <tr class="bg-brand border-b border-brand-light">

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
                            
                            <tr class="bg-brand border-b border-brand-light">
                                No existe campaña
                            </th>
                            <tr class="bg-brand border-b border-brand-light">
                                No existe campaña
                            </th>
                            <tr class="bg-brand border-b border-brand-light">
                                No existe campaña
                            </th>
                            <tr class="bg-brand border-b border-brand-light">
                                No existe campaña
                            </th>
                            <tr class="bg-brand border-b border-brand-light">
                                No existe campaña
                            </th>
                            <tr class="bg-brand border-b border-brand-light">
                                No existe campaña
                            </th>
                        </tr>    
                    @else
                        @foreach ($campañas as $campaña)
                            <tr class="bg-brand border-b border-brand-light">

                                <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                    {{$campaña->PK_Campaña}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                    {{$campaña->Tnombre_Tipocampaña}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                    {{$campaña->Tlugar_campaña}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                    {{$campaña->DfechaIni_campaña}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                    {{$campaña->ThoraIni_campaña}}
                                </th>
                                @if ($campaña->Nestado_campaña ==1)
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-orange" align="center" >
                                        Pendiente
                                    </th>
                                    
                                @endif
                                @if ($campaña->Nestado_campaña ==2)
                                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap text-green-600" align="center" >
                                        Abierto
                                    </th>
                                @endif
                                @if ($campaña->Nestado_campaña ==3)
                                    <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap  text-red-600" align="center" >
                                        Finalizado
                                    </th>
                                @endif
                                
                                <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                    <button type="button" onclick="mostrarAlerta({{ $campaña->PK_Campaña }})">
                                        <i class="fa-solid fa-download"></i>
                                    </button>
                                    
                                    @can('view-campañas')
                                        <a class="text-blue-700" href="{{route('admin.Campañas.show',$campaña->PK_Campaña)}}">
                                            <i class="fa-solid fa-eye"></i>   
                                        </a>
                                    @endcan
                                    @can('update-campañas')
                                        <a class="text-green-700" href="{{route('admin.Campañas.edit',$campaña->PK_Campaña)}}">
                                            <i class="fa-solid fa-pen-to-square"></i>   
                                        </a>
                                    @endcan
                                    @can('view-campañas')
                                        <a class="text-red-700" href="{{route('admin.Configuracion.edit',$campaña->PK_Campaña)}}" class="btn-finalizar" data-nombre="{{ $campaña->Tnombre_Tipocampaña }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    @endcan
                                    {{-- @can('view-campañas')
                                        <a class="text-black-700 btnImportar"
                                            data-id="{{ $campaña->PK_Campaña }}"
                                            data-nombre="{{ $campaña->Tnombre_Tipocampaña }}">
                                            <i class="fa-solid fa-file-export"></i>
                                        </a>
                                        
                                    @endcan --}}
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
            function mostrarAlerta(pk) {
                Swal.fire({
                    title: '¿Como descargar la información?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Excel <i class="fa-solid fa-file-excel"></i> ',
                    cancelButtonText: 'PDF <i class="fa-solid fa-file-pdf"></i>',
                    confirmButtonColor: '#16a34a',
                    cancelButtonColor: '#dc2626'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `/admin/Asitentes/${pk}`;
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        window.location.href = `/admin/Campañas/${pk}/pdf`;
                    }
                });
            }
        </script>
            
            
        <script> 
            document.addEventListener('DOMContentLoaded', function () {

                document.querySelectorAll('.btnImportar').forEach(btn => {
                    btn.addEventListener('click', function () {

                        const id       = this.getAttribute('data-id');
                        const nombre   = this.getAttribute('data-nombre');

                        Swal.fire({
                            title: 'Importar Asistentes - ' + nombre,
                            html: ` 
                                <form id="formImport" action="/admin/Campañas/${id}/dropzone/importacion" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <p class="mb-3">Seleccione un archivo Excel</p>

                                    <input 
                                    type="file" 
                                    id="archivo" 
                                    name="archivo" 
                                    accept=".xlsx,.xls,.pdf"
                                    required
                                    class="swal2-input"
                                    style="width: 80%;">

                                    <button type="submit"
                                        class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 mt-4">
                                        Subir
                                    </button>
                                </form>
                            `,
                            showConfirmButton: false,
                            width: '450px',
                        });
                    });
                });

            });
        </script>
        {{-- YA NO SIRVE --}}
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