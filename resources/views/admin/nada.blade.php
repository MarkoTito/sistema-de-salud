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
        <li class="me-2" role="presentation">
            <button class="inline-block p-4 border-b-2 rounded-t-lg" id="usuario-tab" data-tabs-target="#usuario" type="button" role="tab" aria-controls="usuario" aria-selected="false">
            Usuarios
            </button>
        </li>
        
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
                        </tr>                
                    @else
                        @foreach ($Tiposcampañas as $charla)
                            <tr class="bg-brand border-b border-brand-light">
                                <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                    {{$charla->Tnombre_Tipocampaña}}
                                </th>
                                <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                    {{$charla->Tdescripcion_Tipocampaña}}
                                </th>
                                <td class="px-6 py-4" align="center" >
                                    <a href="{{route('admin.Tipocampaña.show',$charla->PK_TiposCampañas)}}">
                                            <i class="fa-solid fa-camera"></i>
                                    </a>
                                    <a href="">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                                    
                                <td class="px-6 py-4" align="center" >
                                        {{-- <a href="">
                                                <i class="fa-solid fa-download"></i>   
                                        </a> --}}
                                        {{-- <a href=" {{route('admin.Mascotas.show',$mascota->PK_Mascota)}} "> 
                                            <i class="fa-solid fa-eye"></i>   
                                        </a>
                                        <a href=" {{route('admin.Mascotas.edit',$mascota->PK_Mascota)}} "> 
                                            <i class="fa-solid fa-pen-to-square"></i>   
                                        </a> --}}
    
                                </td>
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
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            <a href="{{route('admin.Tipocampaña.show',$charla->PK_TiposCharla)}}">
                                                <i class="fa-solid fa-camera"></i>
                                            </a>
                                            <a href="">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </th>
                            
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
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-black" align="center" >
                                            <a href="{{route('admin.Tipocampaña.show',$expo->PK_Expositores)}}">
                                                <i class="fa-solid fa-camera"></i>
                                            </a>
                                            <a href="">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </th>
                            
                                    </tr>
                                    
                                @endforeach
                                
                            @endif
                            
                            
                        </tbody>
                    </table>
            </div>
            {{-- {{$tipos->links()}} --}}




        </div>


        {{-- sistemas --}}
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="sistema" role="tabpanel" aria-labelledby="sistema-tab">

            <div class="mb-4 flex justify-end " >
                <button data-modal-target="default-modal-sistema" data-modal-toggle="default-modal-sistema" class=" block  text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 " type="button">
                    Agregar Sistema
                </button>
            </div>

            {{-- <p class="text-sm text-gray-500 dark:text-gray-400">Formulario de tipo de sistema</p>
             --}}




            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3" align="center" >
                                Numero
                            </th>
                            <th scope="col" class="px-6 py-3" align="center" >
                                Tipo de Sistema
                            </th>
                            <th scope="col" class="px-6 py-3" align="center" >
                                Estado
                            </th>
                             <th scope="col" class="px-6 py-3" align="center" >
                                Deshabilitar / Habilitar
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        0
                        
                    </tbody>
                </table>
            </div>
            {{-- {{$tipos->links()}} --}}




        </div>


        {{-- usuarios --}}
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="usuario" role="tabpanel" aria-labelledby="usuario-tab">
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
                <form class="max-w-md mx-auto" action="" method="POST" > 
                    @csrf
                    
                    <div class="grid md:grid-cols-2 md:gap-6">
                        {{-- email --}}
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="email" name="email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Correo electronico</label>
                        </div>
                        {{-- permisos --}}
                        <div class="grid gap-6 mb-4 md:grid-cols-3" id="radios">
                            <div class="flex items-center">
                                <input id="default-radio-1" type="radio" value="nivel1" name="permiso" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-black">Nivel 1</label> 
                            </div>
                            <div class="flex items-center">
                                <input  id="default-radio-2" type="radio" value="nivel2" name="permiso" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label  for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-black">Nivel 2</label>
                            </div>
                            <div class="flex items-center">
                                <input  id="default-radio-2" type="radio" value="nivel3" name="permiso" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label  for="default-radio-2" class="ms-2 text-sm font-medium text-gray-900 dark:text-black">Nivel 3</label>
                            </div>
                            @error('permiso')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                            
                        </div>
                        
                    </div>

                    <div class="grid md:grid-cols-2 md:gap-6">
                        
                        <div class="relative z-0 w-full mb-5 group">
                            {{-- contraseña --}}
                            <input type="password" name="password" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Contraseña</label>
                        </div>

                        <div class="relative z-0 w-full mb-5 group">
                            {{-- confirmar contraseña --}}
                            <input type="password" name="password_confirmation" id="floating_repeat_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_repeat_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Confirmar contraseña</label>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-5 group">
                            {{-- nombre --}}
                            <input type="text" name="name" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            {{-- lastname --}}
                            <input type="text" name="lastname" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Apellido</label>
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
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Numero
                                </th>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Nombre
                                </th>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Apellido
                                </th>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3" align="center" >
                                    Eliminar
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            
                            
                        </tbody>
                    </table>
                </div>
                {{-- {{$tipos->links()}} --}}
            </div>















        </div>
    </div>

    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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