
<x-admin-layout 
title="Historial"
:breadcrumbs="[
    [
        'name'=>'Menu',
        'href' => '/',
    ],
    [
        'name'=> 'Hitorial',
    ]
    ]">
        <div class="relative overflow-x-auto">
        
        <table class="w-full text-sm text-left rtl:text-right text-fg-brand-subtle">
            <thead class="text-sm text-black bg-brand-strong">
                <tr class="bg-brand border-b border-brand-light">
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Usuario
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Descripción
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Estado
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Fecha
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (!$modificaciones)
                    <tr class="bg-brand border-b border-brand-light">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black">
                            No hay modificaciones
                        </th>
                    </tr>
                
                @else
                    @foreach ($modificaciones as $modi)
                        <tr class="bg-brand border-b border-brand-light">

                            {{-- Usuario --}}
                            <td class="px-6 py-4" align="center">
                                {{ $modi->name }} {{ $modi->Tapellidos_user }}
                            </td>

                            {{-- Comentario: campaña / charla / mascota --}}
                            <td class="px-6 py-4" align="center">
                                {{ $modi->Tnombre_Tipocampaña 
                                    ?? $modi->Tnombre_charla 
                                    ?? $modi->Tnombre_mascota 
                                    ?? '' }}
                            </td>

                            {{-- Estado --}}
                            <td align="center"
                            class="px-6 py-4 
                                @if($modi->Tdescripcion_modificaciones === 'Inserto') text-blue-600 
                                @elseif($modi->Tdescripcion_modificaciones === 'Edito') text-green-600
                                @elseif($modi->Tdescripcion_modificaciones === 'Elimacion') text-red-600
                                @endif
                            ">
                            {{ $modi->Tdescripcion_modificaciones }}
                        </td>

                            {{-- Fecha --}}
                            <td class="px-6 py-4" align="center">
                                {{ $modi->created_at }}
                            </td>

                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div> 
    {{$modificaciones->links()}}







    
</x-admin-layout>