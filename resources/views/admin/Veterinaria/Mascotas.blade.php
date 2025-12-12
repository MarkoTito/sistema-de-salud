<x-admin-layout :breadcrumbs="[
    [
        'name'=>'Menu',
        'href' => '/',
    ],
    [
        'name'=> 'Mascotas',
    ]
    ]">
    <div class="flex justify-between items-center mb-4">
        <div>
            <form action="{{route('admin.Mascotas.found')}}" method="POST" >
                @csrf
                <div class="flex items-center gap-4">
                    <div>
                        <select name="founTipo" id="miSelect-Tipodoc" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5 
                                dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option selected disabled  value="">Escoja una opción</option>
                            <option value="Canino">Canino</option>
                            <option value="Felino">Felino</option>
                        </select>
                    </div>


                    <div>
                        <input type="date"  required id="first_name" name="fehcIni" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>

                    <div>
                        <input type="date" required id="first_name" name="fehFin" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
                    
                    <div>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"><i class="fa-solid fa-magnifying-glass"></i></button> 
                    </div>
                </div>
            </form>
        </div>

        <div>
            <a href="{{route('admin.Mascotas.create')}}">
                <button  class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Registrar nueva Mascota
                </button>
            </a>
        </div>
    </div>


    
    

    



    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
        <table class="w-full text-sm text-left rtl:text-right text-fg-brand-subtle">
            <thead class="text-sm text-black bg-brand-strong">
                <tr class="bg-brand border-b border-brand-light">
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Nombre
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Especie
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Raza
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Sexo
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Potencialmente Peligroso
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Antecedente de Agresividad
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Nombre del Propietario
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        <a href="#" class="font-medium text-black hover:underline">Edit</a>
                    </td>
                </tr>
            </thead>
            <tbody>
                @if (!$mascotas)
                    <tr class="bg-brand border-b border-brand-light">
                        <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                            No existe registro de mascotas
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                            No existe registro de mascotas
                        </th>
                        <td class="px-6 py-4" align="center" >
                            No existe registro de mascotas
                        </td>
                        <td class="px-6 py-4" align="center" >
                            No existe registro de mascotas
                        </td>
                        <td class="px-6 py-4" align="center" >
                            No existe registro de mascotas
                        </td>
                        <td class="px-6 py-4" align="center" >
                            No existe registro de mascotas
                        </td>
                        <td class="px-6 py-4" align="center" >
                            No existe registro de mascotas
                        </td>
                        <td class="px-6 py-4" align="center" >
                            No existe registro de mascotas
                        </td>
                    </tr>
                    
                @else
                    @foreach ($mascotas as $mascota)
                        <tr class="bg-brand border-b border-brand-light">
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                {{$mascota->Tnombre_mascota}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                {{$mascota->Tespecie_mascota}}
                            </th>
                            <td class="px-6 py-4" align="center" >
                                {{$mascota->Tdescripcion_raza}}
                            </td>
                            <td class="px-6 py-4" align="center" >
                                {{$mascota->Tsexo_mascota}}
                            </td>
                            <td class="px-6 py-4" align="center" >
                                {{$mascota->Tpelirgo_mascota}}
                            </td>
                            <td class="px-6 py-4" align="center" >
                                {{$mascota->Tagrecividad_mascota}}
                            </td>
                            <td class="px-6 py-4" align="center" >
                                {{$mascota->Tnombre_responsable}}
                            </td>
                            <td class="px-6 py-4" align="center" >
                                {{-- <a href="">
                                        <i class="fa-solid fa-download"></i>   
                                </a> --}}
                                <a href=" {{route('admin.Mascotas.show',$mascota->PK_Mascota)}} "> 
                                    <i class="fa-solid fa-eye"></i>   
                                </a>
                                <a href=" {{route('admin.Mascotas.edit',$mascota->PK_Mascota)}} "> 
                                    <i class="fa-solid fa-pen-to-square"></i>   
                                </a>
                               <button type="button" onclick="eliminarMascota({{ $mascota->PK_Mascota }})" class="text-red-600">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                

                                <form id="form-delete-{{ $mascota->PK_Mascota }}" 
                                    action="{{ route('admin.Mascotas.destroy', $mascota->PK_Mascota) }}"
                                    method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a href=" {{route('admin.perro.qr',$mascota->PK_Mascota)}} "> 
                                    QR  
                                </a>
                            </td>
                        </tr>                        
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>


    
    @push('js')
        <script>
            function eliminarMascota(id) {
                Swal.fire({
                    title: "¿Seguro desea eliminar?",
                    text: "Esta acción no se puede deshacer.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Sí, eliminar",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('form-delete-' + id).submit();
                    }
                });
            }
        </script>

        
    @endpush
    

    
    


</x-admin-layout>