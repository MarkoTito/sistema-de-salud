<x-admin-layout :breadcrumbs="[
    [
        'name'=>'Menu',
        'href' => '/',
    ],
    [
        'name'=> 'Mascotas',
    ]
    ]">
    {{-- <div class="flex justify-center mt-4">
        <h1 class="font-extrabold text-gray-900" style="font-size: 2rem;">
            Mascotas 
        </h1>
    </div> --}}
    <div class="flex justify-end mb-4 ">
        <a href="{{route('admin.Mascotas.create')}}">
            <button  class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Registrar nueva Mascota
            </button>
        </a>
    </div>

    

    



    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
        <table class="w-full text-sm text-left rtl:text-right text-fg-brand-subtle">
            <thead class="text-sm text-black bg-brand-strong">
                <tr class="bg-brand border-b border-brand-light">
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Nombre
                    </th>
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
                                No existe registro de mascotas
                            </td>
                        </tr>                        
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>


    

    

    
    


</x-admin-layout>