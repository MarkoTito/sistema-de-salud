<x-admin-layout :breadcrumbs="[
    [
        'name'=>'Menu',
        'href' => '/',
    ],
    [
        'name'=> 'Charlas',
    ]
    ]">
    
    <div class="flex justify-between items-center mb-4">
        @can('create-charlas')
            <div>
                <a href="{{route('admin.Charlas.create')}}">
                    <button  class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        <i class="fa-solid fa-plus"></i> Agregar charla
                    </button>    
                </a>
            </div>
            
        @endcan
        <div>
            <form action="{{route('admin.charla.downloadFound')}}" method="POST" >
                @csrf
                <div class="flex items-center gap-4">
                    <div>
                        <select name="founCharla" id="miSelect-tipoCharla"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5 
                                dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="" selected disabled>---Seleccioné una charla---</option>
                            @foreach ($Tiposcharlas as $tipo)
                                @if ($tipo->Nestado_Tipocharla == 0)
                                    
                                @else
                                    <option value="{{$tipo->PK_TiposCharla}}">{{$tipo->Tnombre_charla}}</option>
                                @endif
                            @endforeach
                        </select>



                    </div>
                    <div>
                        <input type="date" id="first_name" name="fehcIni" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>

                    <div>
                        <input type="date" id="first_name" name="fehFin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                    
                    <div>
                        <button required type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"><i class="fa-solid fa-magnifying-glass"></i></button> 
                    </div>
                </div>
            </form>
        </div>

        



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
            
        </div>
        <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
            <table class="w-full text-sm text-left rtl:text-right text-fg-brand-subtle">
                <thead class="text-sm text-black bg-brand-strong">
                    <tr class="bg-brand border-b border-brand-light">
                        <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                            Numero 
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                            Nombre de charla        
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                            Lugar
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                            Fecha de inicio
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                            Hora de inicio
                        </th>
                  
                        <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                            Acción
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$charlas)
                        <tr class="bg-brand border-b border-brand-light">
                            
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                No existe charla
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                No existe charla
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                No existe charla
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                                No existe charla
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                                No existe charla
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                                No existe charla
                            </th>
                        </tr>    
                    @else
                        @foreach ($charlas as $charla)
                            <tr class="bg-brand border-b border-brand-light">
                                
                                <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                    {{$charla->PK_Charlas}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                    {{$charla->Tnombre_charla}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                    {{$charla->Tlugar_charla}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                    {{$charla->DfechaIni_charla}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                    {{$charla->ThoraIni_charla}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                    @can('view-charlas')
                                    {{-- <a class="text-black"  href="{{route('admin.charla.downloadOne',$charla->PK_Charlas)}}"> 
                                        <i class="fa-solid fa-download"></i>   
                                    </a> --}}
                                    <button type="button" onclick="mostrarAlerta({{ $charla->PK_Charlas }})">
                                        <i class="fa-solid fa-download"></i>
                                    </button>
                                    @endcan
                                    @can('view-charlas')
                                        <a class="text-blue-800" href="{{route('admin.Charlas.show',$charla->PK_Charlas)}}">
                                            <i class="fa-solid fa-eye"></i>   
                                        </a>
                                    @endcan

                                    @can('update-charlas')
                                        <a class="text-green-500" href="{{route('admin.Charlas.edit',$charla->PK_Charlas)}}">
                                            <i class="fa-solid fa-pen-to-square"></i>   
                                        </a>                                        
                                    @endcan

                                    @can('delete-charlas')
                                        <a class="text-red-500" href="{{route('admin.Charlas.destroy',$charla->PK_Charlas)}}" class="btn-finalizar" data-id="{{$charla->PK_Charlas}}" data-nombre="{{$charla->Tnombre_charla}}">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                        <form id="form-delete" method="POST" style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        
                                    @endcan

                                </th>
                            </tr>
                            
                        @endforeach
                        
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-4">
        {{ $charlas->links() }}
    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            function mostrarAlerta(pk) {
                Swal.fire({
                    title: '¿Como descargar la información?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Excell <i class="fa-solid fa-file-excel"></i> ',
                    cancelButtonText: 'PDF <i class="fa-solid fa-file-pdf"></i>',
                    confirmButtonColor: '#16a34a',
                    cancelButtonColor: '#dc2626'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `/admin/Charlas/${pk}/download`;
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        window.location.href = `/admin/Charlas/${pk}/pdf`;
                    }
                });
            }
        </script>

        <script>
            document.querySelectorAll('.btn-finalizar').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const id = this.getAttribute('data-id');
                    const nombre = this.getAttribute('data-nombre');
                    const form = document.getElementById('form-delete');

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Vas a eliminar la charla: " + nombre,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.action = `/admin/Charlas/${id}`;
                            form.submit();
                        }
                    });
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#miSelect-tipoCharla').select2({
                placeholder: "---Seleccioné una charla---",
                allowClear: true
                });
            });
        </script>
        <script>
            const fehcIni = document.querySelector('input[name="fehcIni"]');
            const fehFin = document.querySelector('input[name="fehFin"]');

            fehcIni.addEventListener('change', () => {
                fehFin.min = fehcIni.value;
                if (fehFin.value < fehcIni.value) {
                    fehFin.value = ""; 
                }
            });
        </script>

    @endpush


   
    

    
    

</x-admin-layout>