<x-admin-layout>

    
   <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="sede-tab" data-tabs-target="#sede" type="button" role="tab" aria-controls="sede" aria-selected="true">
            Tipos de Campañas
            </button>
        </li>

        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="area-tab" data-tabs-target="#area" type="button" role="tab" aria-controls="area" aria-selected="false">
            Tipos de Charlas
            </button>
        </li>
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="hardware-tab" data-tabs-target="#hardware" type="button" role="tab" aria-controls="hardware" aria-selected="false">
            Expositores
            </button>
        </li>
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="sistema-tab" data-tabs-target="#sistema" type="button" role="tab" aria-controls="sistema" aria-selected="false">
            Especialidades
            </button>
        </li>
        {{-- <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="usuario-tab" data-tabs-target="#usuario" type="button" role="tab" aria-controls="usuario" aria-selected="false">
            Usuarios
            </button>
        </li> --}}
        
    </ul>

    <div id="myTabContent">
        {{-- sede --}}
        <div  id="sede" role="tabpanel" aria-labelledby="sede-tab">
            <div class="flex justify-end mb-4 ">
                    <button id="btnFormulario" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        <i class="fa-solid fa-globe"></i>
                        Agregar Campaña
                    </button>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Tipos de ampañas</p>
            <table class="w-full text-sm text-left rtl:text-right text-fg-brand-subtle">
                <thead class="text-sm text-black bg-brand-strong">
                    <tr class="bg-brand border-b border-brand-light">
                        <th scope="col" class="px-6 py-3" align="center" >
                            Nombre de la campaña
                        </th>
                        <th scope="col" class="px-6 py-3" align="center" >
                            Descripción
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
                    @if (!$Tiposcampañas)
                        <tr class="bg-brand border-b border-brand-light">
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                                 No existe ninguna campaña
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                                No existe ninguna campaña
                            </th>
                            <td class="px-6 py-4" align="center" >
                                 No existe ninguna campaña
                            </td>
                            <td class="px-6 py-4" align="center" >
                                 No existe ninguna campaña
                            </td>
                        </tr>                
                    @else
                        @foreach ($Tiposcampañas as $camp)
                            <tr class="bg-brand border-b border-brand-light">
                                <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                    {{$camp->Tnombre_Tipocampaña}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                    {{$camp->Tdescripcion_Tipocampaña}}
                                </th>
                                @if ($camp->Nestado_Tipocampaña == 1)
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-blue-500" align="center" >
                                        Habilitado
                                    </th>
                                @else
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-red-500" align="center" >
                                        Desabilitado
                                    </th>
                                @endif
                                
                                @if ($camp->Nestado_Tipocampaña == 1)
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        <div class="grid gap-1 mb-4 md:grid-cols-3 mt-1">
                                            <div>
                                                <form action="{{route('admin.Configuracion.update',$camp->PK_TiposCampañas)}}" method="POST" class="delete-form-campa">
                                                    @method('PUT')
                                                    @csrf
                                                    <input type="text" name="tipo" value="down" hidden >
                                                    <input type="text" name="confi" value="campa" hidden >
                                                    <button class="text-red-500" >
                                                        <span class="w-6 h-6 inline-flex justify-center items-center">
                                                            <i class="fa-solid fa-circle-down"></i>
                                                        </span>
                                                    </button>            
                                                </form>
                                            </div>
                                            <div class="text-green-500" >
                                                <a class="btnEditarCampa  text-green"
                                                    data-id="{{ $camp->PK_TiposCampañas }}"
                                                    data-nombre="{{ $camp->Tnombre_Tipocampaña }}"
                                                    data-descripcion="{{$camp->Tdescripcion_Tipocampaña}}"
                                                    >
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                            </div>
                                            <div>
                                                <a href="{{route('admin.Tipocampaña.show',$camp->PK_TiposCampañas)}}">
                                                    <i class="fa-solid fa-camera"></i>
                                                </a>
                                            </div>
                                        <div>
                                    </th>
                                @else
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        <div class="justify-center">
                                            <form action="{{route('admin.Configuracion.update',$camp->PK_TiposCampañas)}}" method="POST" class="up-form-campa">
                                                @method('PUT')
                                                @csrf
                                                <input type="text" name="tipo" value="up" hidden >
                                                <input type="text" name="confi" value="campa" hidden >
                                                <button class="text-blue-500" >
                                                    <span class="w-6 h-6 inline-flex justify-center items-center">
                                                        <i class="fa-solid fa-circle-up"></i>
                                                    </span>
                                                </button>            
                                            </form>
                                        </div>                                                    
                                    </th>                                             
                                @endif
                            </tr>                        
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>




        {{-- area --}}
        <div  id="area" role="tabpanel" aria-labelledby="area-tab">
            <div class="flex justify-end mb-4 ">
                <button id="btnFormulario-charla" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    <i class="fa-solid fa-chalkboard-user"></i>
                        Agregar Charla
                    </button>
            </div>
            
            <p class="text-sm text-gray-500 dark:text-gray-400">Tipos de Charlas</p>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-fg-brand-subtle">
                        <thead class="text-sm text-black bg-brand-strong">
                            <tr class="bg-brand border-b border-brand-light">
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Nombre de la charla
                                </th>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Descripción
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
                            @if (!$TiposCharlas)
                                <tr class="bg-brand border-b border-brand-light">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ninguna campaña
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ninguna campaña
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ninguna campaña
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ninguna campaña
                                    </th>
                                </tr>
                                
                            @else
                                @foreach ($TiposCharlas as $charla)
                                    <tr class="bg-brand border-b border-brand-light">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$charla->Tnombre_charla}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$charla->Tdescripcion_Tipocharla}}
                                        </th>
                                        @if ($charla->Nestado_Tipocharla == 1)
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-blue-500" align="center" >
                                                Habilitado
                                            </th>
                                        @else
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-red-500" align="center" >
                                                Desabilitado
                                            </th>
                                        @endif
                                        @if ($charla->Nestado_Tipocharla == 1)
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                                <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
                                                    <div>
                                                        <form action="{{route('admin.Configuracion.update',$charla->PK_TiposCharla)}}" method="POST" class="delete-form-charla">
                                                            @method('PUT')
                                                            @csrf
                                                            <input type="text" name="tipo" value="down" hidden >
                                                            <input type="text" name="confi" value="charla" hidden >
                                                            <button class="text-red-500" >
                                                                <span class="w-6 h-6 inline-flex justify-center items-center">
                                                                    <i class="fa-solid fa-circle-down"></i>
                                                                </span>
                                                            </button>            
                                                        </form>
                                                    </div>
                                                    <div class="text-green-500" >
                                                        <a class="btnEditarCharla  text-green"
                                                            data-id="{{ $charla->PK_TiposCharla }}"
                                                            data-nombre="{{ $charla->Tnombre_charla }}"
                                                            data-descripcion="{{$charla->Tdescripcion_Tipocharla}}"
                                                            >
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                    </div>

                                            </th>
                                        @else
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                                <div class="justify-center">
                                                    <form action="{{route('admin.Configuracion.update',$charla->PK_TiposCharla)}}" method="POST" class="up-form-charla">
                                                        @method('PUT')
                                                        @csrf
                                                        <input type="text" name="tipo" value="up" hidden >
                                                        <input type="text" name="confi" value="charla" hidden >
                                                        <button class="text-blue-500" >
                                                            <span class="w-6 h-6 inline-flex justify-center items-center">
                                                                <i class="fa-solid fa-circle-up"></i>
                                                            </span>
                                                        </button>            
                                                    </form>                                                    
                                            </th>   
                                            
                                        @endif
                            
                                    </tr>
                                    
                                @endforeach
                                
                            @endif
                            
                            
                        </tbody>
                    </table>
            </div>
            







        </div>
        {{-- tipo --}}
        <div  id="hardware" role="tabpanel" aria-labelledby="hardware-tab">
            
            <div class="flex justify-end mb-4 ">
                    <button id="agregar-asistente" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">                        
                        Agregar Expositor
                    </button>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Expositores</p>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-fg-brand-subtle">
                        <thead class="text-sm text-black bg-brand-strong">
                            <tr class="bg-brand border-b border-brand-light">
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
                                    Numero de contacto
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
                            @if (!$Tiposcampañas)
                                <tr class="bg-brand border-b border-brand-light">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ningun expositor
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ningun expositor
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ningun expositor
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ningun expositor
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ningun expositor
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ningun expositor
                                    </th>
                                </tr>
                                
                            @else
                                @foreach ($expositores as $expo)
                                    <tr class="bg-brand border-b border-brand-light">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$expo->Tnombre_expositor}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$expo->TapellidoP_expositor}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$expo->TapellidoM_expositor}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$expo->Tnumero_expositor}}
                                        </th>
                                        @if ($expo->Nestado_expositor == 1)
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-blue-500" align="center" >
                                                Habilitado
                                            </th>
                                        @else
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-red-500" align="center" >
                                                Desabilitado
                                            </th>
                                        @endif
                                        @if ($expo->Nestado_expositor == 1)
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                                <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
                                                    <div>
                                                        <form action="{{route('admin.Configuracion.update',$expo->PK_Expositores)}}" method="POST" class="delete-form-expo">
                                                            @method('PUT')
                                                            @csrf
                                                            <input type="text" name="tipo" value="down" hidden >
                                                            <input type="text" name="confi" value="expo" hidden >
                                                            <button class="text-red-500" >
                                                                <span class="w-6 h-6 inline-flex justify-center items-center">
                                                                    <i class="fa-solid fa-circle-down"></i>
                                                                </span>
                                                            </button>            
                                                        </form>
                                                    </div>
                                                    <div class="text-green-500" >
                                                        <a class="btnEditarExpo  text-green"
                                                            data-id="{{ $expo->PK_Expositores }}"
                                                            data-nombre="{{ $expo->Tnombre_expositor }}"
                                                            data-paterno="{{ $expo->TapellidoP_expositor }}"
                                                            data-materno="{{ $expo->TapellidoM_expositor }}"
                                                            data-numero="{{ $expo->Tnumero_expositor }}"
                                                            
                                                            >
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                    </div>

                                            </th>
                                        @else
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                                <div class="justify-center">
                                                    <form action="{{route('admin.Configuracion.update',$expo->PK_Expositores)}}" method="POST" class="up-form-expo">
                                                        @method('PUT')
                                                        @csrf
                                                        <input type="text" name="tipo" value="up" hidden >
                                                        <input type="text" name="confi" value="expo" hidden >
                                                        <button class="text-blue-500" >
                                                            <span class="w-6 h-6 inline-flex justify-center items-center">
                                                                <i class="fa-solid fa-circle-up"></i>
                                                            </span>
                                                        </button>            
                                                    </form>                                                    
                                            </th>   
                                            
                                        @endif
                            
                                    </tr>
                                    
                                @endforeach
                                
                            @endif
                            
                            
                        </tbody>
                    </table>
            </div>
            {{-- {{$tipos->links()}} --}}




        </div>


        {{-- sistemas --}}
        <div  id="sistema" role="tabpanel" aria-labelledby="sistema-tab">

            <div class="flex justify-end mb-4 ">
                    <button id="btnFormulario-especialidad" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">                        
                        Agregar especialidad
                    </button>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400">Expositores</p>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-fg-brand-subtle">
                        <thead class="text-sm text-black bg-brand-strong">
                            <tr class="bg-brand border-b border-brand-light">
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Nombre
                                </th>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Fecha de creación
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
                            @if (!$especialidadades)
                                <tr class="bg-brand border-b border-brand-light">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ninguna especialidad
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ninguna especialidad
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ninguna especialidad
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ninguna especialidad
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ninguna especialidad
                                    </th>
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                        No existe ninguna especialidad
                                    </th>
                                </tr>
                                
                            @else
                                @foreach ($especialidadades as $especialidad)
                                    <tr class="bg-brand border-b border-brand-light">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$especialidad->Tdescripcion_especialidad}}
                                        </th>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            {{$especialidad->created_at}}
                                        </th>
                                        @if ($especialidad->Nestado_especialidad == 1)
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-blue-500" align="center" >
                                                Habilitado
                                            </th>
                                        @else
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-red-500" align="center" >
                                                Desabilitado
                                            </th>
                                        @endif
                                        
                                        @if ($especialidad->Nestado_especialidad == 1)
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                                <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
                                                    <div>
                                                        <form action="{{route('admin.Configuracion.update',$especialidad->PK_Especialidades)}}" method="POST" class="delete-form-especi">
                                                            @method('PUT')
                                                            @csrf
                                                            <input type="text" name="tipo" value="down" hidden >
                                                            <input type="text" name="confi" value="espe" hidden >
                                                            <button class="text-red-500" >
                                                                <span class="w-6 h-6 inline-flex justify-center items-center">
                                                                    <i class="fa-solid fa-circle-down"></i>
                                                                </span>
                                                            </button>            
                                                        </form>
                                                    </div>
                                                    <div class="text-green-500" >
                                                        <a class="btnEditarEspecialidad  text-green"
                                                            data-id="{{ $especialidad->PK_Especialidades }}"
                                                            data-nombre="{{ $especialidad->Tdescripcion_especialidad }}"
                                                            >
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                    </div>

                                            </th>
                                        @else
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                                <div class="justify-center">
                                                    <form action="{{route('admin.Configuracion.update',$especialidad->PK_Especialidades)}}" method="POST" class="delete-form-especi">
                                                        @method('PUT')
                                                        @csrf
                                                        <input type="text" name="tipo" value="up" hidden >
                                                        <input type="text" name="confi" value="espe" hidden >
                                                        <button class="text-blue-500" >
                                                            <span class="w-6 h-6 inline-flex justify-center items-center">
                                                                <i class="fa-solid fa-circle-up"></i>
                                                            </span>
                                                        </button>            
                                                    </form>                                                    
                                            </th>   
                                            
                                        @endif
                            
                                    </tr>
                                    
                                @endforeach
                                
                            @endif
                            
                            
                        </tbody>
                    </table>
            </div>




        </div>


        
    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                document.querySelectorAll('.btnEditarCampa').forEach(button => {
                    button.addEventListener('click', function () {

                        const id = this.getAttribute('data-id');
                        const nombre = this.getAttribute('data-nombre');
                        const descripcion = this.getAttribute('data-descripcion');

                        Swal.fire({
                            title: 'Editar Campaña',
                            html: `
                                <form id="formEditarAsistente">
                                    @csrf
                                    <input type="hidden" id="tipo" name="tipo" value="3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Nombre de la campaña:</label>
                                        <input maxlength="100" type="text" id="nombre" value="${nombre}" class="swal2-input" style="width:75%;" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Descripción:</label>
                                        <textarea maxlength="200" style="width: 90%" id="descripcion" maxlength="200" class="swal2-textarea">${descripcion}</textarea>

                                    </div>

                                   
                                </form>
                            `,
                            showCancelButton: true,
                            confirmButtonText: 'Guardar cambios',
                            cancelButtonText: 'Cancelar',
                            focusConfirm: false,

                            preConfirm: () => {

                                const nombre = Swal.getPopup().querySelector('#nombre').value;
                                const descripcion = Swal.getPopup().querySelector('#descripcion').value;
                                const tipo = Swal.getPopup().querySelector('#tipo').value;
            

                                if (!nombre || !descripcion || !tipo) {
                                    Swal.showValidationMessage(`Completa todos los campos`);
                                    return false;
                                }

                                return { id, nombre, descripcion, tipo};
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {

                                const datos = result.value;
                                const formData = new FormData();
                                formData.append('_method', 'PUT');
                                formData.append('nombre', datos.nombre);
                                formData.append('descripcion', datos.descripcion);
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
                                        text: 'la campañafue editado correctamente'
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

                document.querySelectorAll('.btnEditarCharla').forEach(button => {
                    button.addEventListener('click', function () {

                        const id = this.getAttribute('data-id');
                        const nombre = this.getAttribute('data-nombre');
                        const descripcion = this.getAttribute('data-descripcion');

                        Swal.fire({
                            title: 'Editar Charla',
                            html: `
                                <form id="formEditarAsistente">
                                    @csrf
                                    <input type="hidden" id="tipo" name="tipo" value="4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Nombre de la campaña:</label>
                                        <input maxlength="100" type="text" id="nombre" value="${nombre}" class="swal2-input" style="width:75%;" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Descripción:</label>
                                        <textarea maxlength="200" style="width: 90%" id="descripcion" maxlength="200" class="swal2-textarea">${descripcion}</textarea>

                                    </div>

                                   
                                </form>
                            `,
                            showCancelButton: true,
                            confirmButtonText: 'Guardar cambios',
                            cancelButtonText: 'Cancelar',
                            focusConfirm: false,

                            preConfirm: () => {

                                const nombre = Swal.getPopup().querySelector('#nombre').value;
                                const descripcion = Swal.getPopup().querySelector('#descripcion').value;
                                const tipo = Swal.getPopup().querySelector('#tipo').value;
            

                                if (!nombre || !descripcion || !tipo) {
                                    Swal.showValidationMessage(`Completa todos los campos`);
                                    return false;
                                }

                                return { id, nombre, descripcion, tipo};
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {

                                const datos = result.value;
                                const formData = new FormData();
                                formData.append('_method', 'PUT');
                                formData.append('nombre', datos.nombre);
                                formData.append('descripcion', datos.descripcion);
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
                                        text: 'la campañafue editado correctamente'
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

                document.querySelectorAll('.btnEditarEspecialidad').forEach(button => {
                    button.addEventListener('click', function () {

                        const id = this.getAttribute('data-id');
                        const nombre = this.getAttribute('data-nombre');

                        Swal.fire({
                            title: 'Editar Especialidad',
                            html: `
                                <form id="formEditarAsistente">
                                    @csrf
                                    <input type="hidden" id="tipo" name="tipo" value="6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Nombre de la especialidad:</label>
                                        <input maxlength="100" type="text" id="nombre" value="${nombre}" class="swal2-input" style="width:75%;" required>
                                    </div>
                                   

                                   
                                </form>
                            `,
                            showCancelButton: true,
                            confirmButtonText: 'Guardar cambios',
                            cancelButtonText: 'Cancelar',
                            focusConfirm: false,

                            preConfirm: () => {

                                const nombre = Swal.getPopup().querySelector('#nombre').value;
                                
                                const tipo = Swal.getPopup().querySelector('#tipo').value;
            

                                if (!nombre || !tipo) {
                                    Swal.showValidationMessage(`Completa todos los campos`);
                                    return false;
                                }

                                return { id, nombre, tipo};
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {

                                const datos = result.value;
                                const formData = new FormData();
                                formData.append('_method', 'PUT');
                                formData.append('nombre', datos.nombre);
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
                                        text: 'la campañafue editado correctamente'
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
            document.addEventListener('DOMContentLoaded', function () {

                document.querySelectorAll('.btnEditarExpo').forEach(button => {
                    button.addEventListener('click', function () {

                        const id = this.getAttribute('data-id');
                        const nombre = this.getAttribute('data-nombre');
                        const apP = this.getAttribute('data-paterno');
                        const apM = this.getAttribute('data-materno');
                        const numero = this.getAttribute('data-numero');

                        Swal.fire({
                            title: 'Editar Expositor',
                            html: `
                                <form id="formEditarAsistente">
                                    @csrf

                                    <input type="hidden" id="tipo" name="tipo" value="5">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Nombre:</label>
                                        <input type="text" maxlength="45" id="nombre" value="${nombre}" class="swal2-input" style="width:90%;" required>
                                    </div>

                                    <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-900">Apellido Paterno:</label>
                                            <input type="text" maxlength="25" id="apellidosPat" value="${apP}" class="swal2-input" style="width:90%;" required>
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-900">Apellidos Materno:</label>
                                            <input type="text" maxlength="25" id="apellidosMat" value="${apM}" class="swal2-input" style="width: 90%;" required>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-900">Numero celular:</label>
                                        <input type="text" id="numero" maxlength="9"  oninput="this.value = this.value.replace(/[^0-9]/g, '');" value="${numero}" class="swal2-input" style="width:50%;" required>
                                    </div>
                                    
                                </form>
                            `,
                            showCancelButton: true,
                            confirmButtonText: 'Guardar cambios',
                            cancelButtonText: 'Cancelar',
                            focusConfirm: false,

                            preConfirm: () => {

                                const nombre = Swal.getPopup().querySelector('#nombre').value;
                                const apP = Swal.getPopup().querySelector('#apellidosPat').value;
                                const apM = Swal.getPopup().querySelector('#apellidosMat').value;
                                const celular = Swal.getPopup().querySelector('#numero').value;
                                const tipo = Swal.getPopup().querySelector('#tipo').value;
            

                                if (!nombre || !apP || !apM  || !celular || !tipo) {
                                    Swal.showValidationMessage(`Completa todos los campos`);
                                    return false;
                                }

                                return { id, nombre, apP, apM,celular , tipo};
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {

                                const datos = result.value;
                                const formData = new FormData();
                                formData.append('_method', 'PUT');
                                formData.append('nombre', datos.nombre);
                                formData.append('apP', datos.apP);
                                formData.append('apM', datos.apM);
                                formData.append('celular', datos.celular);
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
                                        text: 'la campañafue editado correctamente'
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
        //ELIMINAR ESPECIALIDAD
            forms = document.querySelectorAll('.delete-form-especi')
            //que recorra todos los formularios
            forms.forEach(form => {
                //que se ponga al escucha de ese formulario con el evento submit
                form.addEventListener('submit',function(e){ //e es el evento en si
                    //previne el evento 
                    e.preventDefault('');
                        Swal.fire({
                            title: "Deshabilitar esta especialidad?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Si, Deshabilitar especialidad",
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
        //ELIMINAR ESPECIALIDAD
            forms = document.querySelectorAll('.up-form-especi')
            //que recorra todos los formularios
            forms.forEach(form => {
                //que se ponga al escucha de ese formulario con el evento submit
                form.addEventListener('submit',function(e){ //e es el evento en si
                    //previne el evento 
                    e.preventDefault('');
                        Swal.fire({
                            title: "Deshabilitar esta especialidad?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Si, Deshabilitar especialidad",
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
        //que seleciona todos esos formularios que tengan ese nombre de delete-form-area 
            forms = document.querySelectorAll('.delete-form-expo')
            //que recorra todos los formularios
            forms.forEach(form => {
                //que se ponga al escucha de ese formulario con el evento submit
                form.addEventListener('submit',function(e){ //e es el evento en si
                    //previne el evento 
                    e.preventDefault('');
                        Swal.fire({
                            title: "Deshabilitar esta expositor?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Si, Deshabilitar expositor",
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
        //que seleciona todos esos formularios que tengan ese nombre de delete-form-area 
            forms = document.querySelectorAll('.delete-form-charla')
            //que recorra todos los formularios
            forms.forEach(form => {
                //que se ponga al escucha de ese formulario con el evento submit
                form.addEventListener('submit',function(e){ //e es el evento en si
                    //previne el evento 
                    e.preventDefault('');
                        Swal.fire({
                            title: "Deshabilitar este tipo de charla?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Si, Deshabilitar",
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
        //que seleciona todos esos formularios que tengan ese nombre de delete-form-area 
            forms = document.querySelectorAll('.delete-form-campa')
            //que recorra todos los formularios
            forms.forEach(form => {
                //que se ponga al escucha de ese formulario con el evento submit
                form.addEventListener('submit',function(e){ //e es el evento en si
                    //previne el evento 
                    e.preventDefault('');
                        Swal.fire({
                            title: "Deshabilitar este tipo de campaña?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Si, Deshabilitar",
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
        //que seleciona todos esos formularios que tengan ese nombre de delete-form-area 
            forms = document.querySelectorAll('.up-form-expo')
            //que recorra todos los formularios
            forms.forEach(form => {
                //que se ponga al escucha de ese formulario con el evento submit
                form.addEventListener('submit',function(e){ //e es el evento en si
                    //previne el evento 
                    e.preventDefault('');
                        Swal.fire({
                            title: "Habilitar esta expositor?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Si, habilitar expositor",
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
        //que seleciona todos esos formularios que tengan ese nombre de delete-form-area 
            forms = document.querySelectorAll('.up-form-charla')
            //que recorra todos los formularios
            forms.forEach(form => {
                //que se ponga al escucha de ese formulario con el evento submit
                form.addEventListener('submit',function(e){ //e es el evento en si
                    //previne el evento 
                    e.preventDefault('');
                        Swal.fire({
                            title: "Habilitar esta charla?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Si, habilitar charla",
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
        //que seleciona todos esos formularios que tengan ese nombre de delete-form-area 
            forms = document.querySelectorAll('.up-form-campa')
            //que recorra todos los formularios
            forms.forEach(form => {
                //que se ponga al escucha de ese formulario con el evento submit
                form.addEventListener('submit',function(e){ //e es el evento en si
                    //previne el evento 
                    e.preventDefault('');
                        Swal.fire({
                            title: "Habilitar esta tipo de campaña?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Si, habilitar",
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
            //para agregar usuario
                document.getElementById('agregar-asistente').addEventListener('click', function() {
                    Swal.fire({
                        title: 'Agregar Expositor',
                        html: `
                        <form id="formAsistente" >
                            
                            <div class="grid gap-4 text-left">
                                <input name="tipo" id="tipo" class="swal2-input" value="3" hidden>
                                <div>
                                    <label class="block text-sm font-medium text-gray-900">Nombre:</label>
                                    <input type="text" name="nombre" id=""
                                        class="swal2-input" style="width: 90%;"
                                        placeholder="Ingrese el nombre completo"
                                        maxlength="50" required>
                                </div>
                                <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Apellido Paterno:</label>
                                        <input type="text" name="apeP" id="" class="swal2-input" maxlength="30" required>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Apellido Materno:</label>
                                        <input type="text" name="apeM" id="" class="swal2-input" maxlength="30" required>
                                    </div>
                                </div>    
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-900">Numero:</label>
                                <input type="text" name="Numero" id="" class="swal2-input" maxlength="9" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
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

                            return fetch("{{ route('admin.Configuracion.store') }}", {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.text())
                            .then(text => {
                                console.log(text);   // <--- Esto te mostrará el HTML o error real
                                return JSON.parse(text);
                            })
                            .then(data => {
                                if (!data.ok) {
                                    Swal.showValidationMessage(data.msg || 'No se pudo registrar el expositor');
                                }
                                return data;
                            })
                            .catch(error => {
                                Swal.showValidationMessage(`Error: ${error}`);
                            });
                        }
                    }).then((result) => {
                        if (result.isConfirmed && result.value.ok) {
                            Swal.fire('Éxito', 'Expositor registrado correctamente', 'success')
                                .then(() => location.reload());
                        }
                    });
                });
        </script>
        <!-- Creacion de campaña -->
        <script>
            document.getElementById('btnFormulario').addEventListener('click', function() {
            Swal.fire({
                title: 'Formulario de creación de campaña',
                html: `
                <form id="form-campania" onsubmit="return false;">
                    <input id="tipo"  class="swal2-input" value="1" hidden>
                    <label>Nombre</label>
                    <input id="nombre" class="swal2-input" placeholder="Nombre de la campaña">
                    <label>Descripción</label>
                    <textarea id="mensaje" class="swal2-textarea" placeholder="Descripción de la campaña"></textarea>
                </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
                focusConfirm: false,
                preConfirm: () => {
                const nombre = document.getElementById('nombre').value
                const mensaje = document.getElementById('mensaje').value
                const tipo = document.getElementById('tipo').value


                if (!nombre || !mensaje) {
                    Swal.showValidationMessage('Completa todos los campos')
                    return false
                }

                // Retornamos los datos al then()
                return { nombre, mensaje ,tipo}
                }
            }).then((result) => {
                if (result.isConfirmed) {
                // 📨 Enviar al backend con fetch()
                fetch("{{ route('admin.Configuracion.store') }}", {
                    method: "POST",
                    headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(result.value)
                })
                .then(response => {
                    if (!response.ok) {
                    throw new Error("Error en el envío");
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire('Error', 'No se pudo crear la campaña', 'error')
                })
                .catch(error => {
                    Swal.fire('Éxito', 'La campaña fue creada correctamente', 'success')
                    
                });
                }
            })
            });
        </script>
        <!-- Creacion de especialidad -->
        <script>
            document.getElementById('btnFormulario-especialidad').addEventListener('click', function() {
            Swal.fire({
                title: 'Formulario de creación de especialidad',
                html: `
                <form id="form-campania" onsubmit="return false;">
                    <input id="tipo"  class="swal2-input" value="4" hidden>
                    <label>Nombre</label>
                    <input id="nombre" class="swal2-input" placeholder="Nombre de la especialidad">
                </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
                focusConfirm: false,
                preConfirm: () => {
                const nombre = document.getElementById('nombre').value
                const tipo = document.getElementById('tipo').value


                if (!nombre || !tipo) {
                    Swal.showValidationMessage('Completa todos los campos')
                    return false
                }

                // Retornamos los datos al then()
                return { nombre ,tipo}
                }
            }).then((result) => {
                if (result.isConfirmed) {
                // 📨 Enviar al backend con fetch()
                fetch("{{ route('admin.Configuracion.store') }}", {
                    method: "POST",
                    headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(result.value)
                })
                .then(response => {
                    if (!response.ok) {
                    throw new Error("Error en el envío");
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire('Error', 'No se pudo crear la especialidad', 'error')
                })
                .catch(error => {
                    Swal.fire('Éxito', 'La especialidad fue creada correctamente', 'success')
                    
                });
                }
            })
            });
        </script>
        <script>
            document.getElementById('btnFormulario-charla').addEventListener('click', function() {
            Swal.fire({
                title: 'Formulario de creación de tipos de charla',
                html: `
                <form id="form-campania" onsubmit="return false;">
                    <input id="tipo"  class="swal2-input" value="2" hidden>
                    <label>Nombre</label>
                    <input id="nombre" maxlength="100" class="swal2-input" placeholder="Nombre de la charla">
                    <label>Descripción</label>
                    <textarea id="mensaje" maxlength="200" class="swal2-textarea" placeholder="Descripción de charla"></textarea>
                </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
                focusConfirm: false,
                preConfirm: () => {
                const nombre = document.getElementById('nombre').value
                const mensaje = document.getElementById('mensaje').value
                const tipo = document.getElementById('tipo').value

                if (!nombre || !mensaje) {
                    Swal.showValidationMessage('Completa todos los campos')
                    return false
                }

                // Retornamos los datos al then()
                return { nombre, mensaje ,tipo }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                // 📨 Enviar al backend con fetch()
                fetch("{{ route('admin.Configuracion.store') }}", {
                    method: "POST",
                    headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(result.value)
                })
                .then(response => {
                    if (!response.ok) {
                    throw new Error("Error en el envío");
                    }
                    return response.json();
                })
                .then(data => {
                    Swal.fire('Error', 'No se pudo crear el tipo de charla', 'error')
                })
                .catch(error => {
                    Swal.fire('Éxito', 'La campaña fue tipo de charla', 'success')
                    
                });
                }
            })
            });
        </script>
    @endpush


</x-admin-layout>