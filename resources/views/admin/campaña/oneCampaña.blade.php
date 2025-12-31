<x-admin-layout :breadcrumbs="[
    [
        'name'=>'Menu',
        'href' => '/',
    ],
    [
        'name'=>'Campañas',
        'href' => route('admin.Campañas.index')
    ],
    [
        'name'=> 'Campaña',
    ]
    ]">
   
    <div class="flex justify-center mt-4">
        <h1 class="font-extrabold text-gray-900" style="font-size: 2rem;">
            {{ $campaña->Tnombre_Tipocampaña }}
        </h1>
    </div>
    
    @if ($estado == "Finalizar")

        <div class="flex justify-between items-center mb-4">            
            @can('update-campañas')
                <div>
                    <form action="{{route('admin.Campañas.update',$campaña->PK_Campaña)}}" method="POST" class="finalizar-form" >
                        @method('PUT')
                        @csrf
                        <input type="text" name="situacion" value="1" hidden>
                        <button type="submit"  class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                            {{$estado}}
                        </button>
                    </form>

                </div>
                
            @endcan
        </div>
    @endif
    @if ($estado == "Empesar antes de tiempo")
        <div class="flex justify-between items-center mb-4">
            @if (!$colaboradores)
                
            @else
                <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
                        <div>
                            <button id="mostrarColaboradores" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Colaboradores
                            </button>
                        </div>

                        <div>
                            <button id="mostrarEspecilidades" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                                Especialidades
                            </button>
                        </div>

                    </div>
                
            @endif
            @can('update-campañas')
                <div>
                    <form action="{{route('admin.Campañas.update',$campaña->PK_Campaña)}}" method="POST" class="adelantar-form" >
                        @method('PUT')
                        @csrf
                        <input type="text" name="situacion" value="2" hidden >
                        <button type="submit"  style="
                            background:#22c55e;
                            color:white;
                            padding:12px 24px;
                            font-size:16px;
                            line-height:1.2;
                            height:auto;
                        ">
                            {{$estado}}
                        </button>
                    </form>

                </div>
            @endcan
        </div>
        
    @endif
    @if ($estado == "reabrir campaña?")
        <div class="flex justify-between items-center mb-4">

            @if (!$colaboradores)
                
            @else
                <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
                        <div>
                            <button id="mostrarColaboradores" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Colaboradores
                            </button>
                        </div>

                        <div>
                            <button id="mostrarEspecilidades" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                                Especialidades
                            </button>
                        </div>

                    </div>
                
            @endif
            
            @can('update-campañas')
                <div>
                    <form action="{{route('admin.Campañas.update',$campaña->PK_Campaña)}}" method="POST" class="reabrir-form" >
                        @method('PUT')
                        @csrf
                        <input type="text" name="situacion" value="3" hidden >
                        <button type="submit"  style="background:#7c3aed; color:white; padding:8px 16px; border-radius:6px;">
                            {{$estado}}
                        </button>
                    </form>

                </div>
            @endcan
        </div>
        
    @endif


    <br>
    <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4 ">
        <div>
            @if ($imagen->isEmpty())
                <div style="position:relative; display:inline-block;">
                    <img src="https://www.stellamaris.com.pe/uploads/shares/BLOG/CAMPA__A_DE_SALUD_-_RESP__SOCIAL.jpg" class="mb-4"  height="450px" width="640px" alt="imagen de la campaña">
                    
                    <div class="grid gap-6 mb-4 md:grid-cols-3 mt-4 ">
                        <div>
                            <button id="mostrarEspecilidades"
                                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                                Especialidades
                            </button>
                        </div>
                        <div class="flex justify-center" >
                            <button id="mostrarDocumentos" 
                                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                Mostrar Documentos
                            </button>
                        </div>
                        <div>
                            <button id="mostrarColaboradores" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Colaboradores
                            </button>
                        </div>   
                    </div>                    
                    
                </div>



            @else
                <div class="mb-4">
                    <div class="swiper mySwiper w-full max-w-xl mb-4 ">
                        <div class="swiper-wrapper">
                            @foreach ($imagen as $img)
                                <div class="swiper-slide relative flex justify-center">
                                    <a href="{{route('admin.campaña.imagen.delete',$img->PK_Imagenes)}}"
                                    class="absolute top-2 right-2 bg-red-600 text-white p-2 rounded-full shadow hover:bg-red-700 transition">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                    {{-- <img src="{{ asset('storage/'.$img->Tpath_imagenes) }}"  class="rounded-lg shadow-lg w-full h-auto"> --}}
                                    <img src="/storage/{{ $img->Tpath_imagenes }}" 
                                        class="rounded-lg shadow-lg w-full h-auto">
                                </div>
                            @endforeach
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-pagination"></div>
                        </div>
            

                        <div class="grid gap-6 mb-4 md:grid-cols-3 mt-4 ">
                            <div>
                                <button id="mostrarEspecilidades"
                                        class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                                    Especialidades
                                </button>
                            </div>
                            <div class="flex justify-center" >
                                <button id="mostrarDocumentos" 
                                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                    Mostrar Documentos
                                </button>
                            </div>
                            <div>
                                <button id="mostrarColaboradores" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                    Colaboradores
                                </button>
                            </div>   
                        </div>          
                    </div> 
                </div>
            @endif
        </div>
        <div >
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
    
                @if ($campaña->PK_TiposCampañas==1)
                    <div class="grid gap-6  md:grid-cols-2 mb-4 ">
                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad de gatos:</label>    
                            <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$cantiGatos}}" disabled>                
                        </div>
                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad de perros:</label>    
                            <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$cantiPerros}}" disabled>                
                        </div>
    
    
                    </div>
                @else
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad de asistentes:</label>    
                        <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$cantidad}}" disabled>                
                    </div>
                @endif
        
                
                    
    
                @if ($estado == "reabrir campaña?")
                    <div>
                        <label for="fin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Fecha de Fin:</label>    
                        <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$campaña->DfechaFin_campaña}}" disabled>                
                    </div>
                    
                @else
                    
                @endif
            </div>
            
            {{-- aca van los botones
                aca si esta abiero a ingresar asistentes
                --}}
            @if ($estado == "Finalizar")  
                <div class="grid gap-16 mb-4 md:grid-cols-3">
                    @if (!$colaboradores)
                    @else
                        @can('view-campañas')
                            
                            <div>
                                <a href="{{route('admin.campañas.imagen',$campaña->PK_Campaña)}}">
                                    <button style="background:#7c3aed; color:white; padding:8px 16px; border-radius:6px;">
                                        <i class="fa-solid fa-camera"></i>
                                        Agregar Evidencia
                                    </button>
                                    
                                </a>
                            </div>
                            @can('create-asitentes')
                                @if ($campaña->PK_TiposCampañas==1)
                                    <div >
                                        <button
                                            id="agregar-asistente-mascota"
                                            class="swal2-confirm swal2-styled"
                                            style="
                                                background:#22c55e;
                                                color:white;
                                                padding:12px 24px;
                                                font-size:16px;
                                                line-height:1.2;
                                                height:auto;
                                            ">
                                            <i class="fa-solid fa-user"></i>
                                            Agregar Asistente
                                        </button>
                                    </div>
                                    {{-- para agregar documentos --}}
                                    <div>
                                        <a href="{{route('admin.campañas.index.documen',$campaña->PK_Campaña)}}">
                                            <button 
                                                style="
                                                    background:#facc15;
                                                    color:#000;
                                                    padding:12px 24px;
                                                    font-size:16px;
                                                    line-height:1.2;
                                                    height:auto;
                                                "
                                                >
                                                <i class="fa-regular fa-copy"></i>
                                                Agregar Lista
                                            </button>
                                        </a>
                                    </div>
                                @else
                                    <div >
                                        <button  class="swal2-confirm swal2-styled"
                                        style="
                                            background:#22c55e;
                                            color:white;
                                            padding:12px 24px;
                                            font-size:16px;
                                            line-height:1.2;
                                            height:auto;
                                        " id="agregar-asistente" >
                                            <i class="fa-solid fa-user"></i>
                                            Agregar Asistente                        
                                        </button>
                                    </div>

                                    {{-- para agregar documentos --}}
                                    <div>
                                        <a href="{{route('admin.campañas.index.documen',$campaña->PK_Campaña)}}">
                                            <button 
                                                style="
                                                    background:#facc15;
                                                    color:#000;
                                                    padding:12px 24px;
                                                    font-size:16px;
                                                    line-height:1.2;
                                                    height:auto;
                                                "
                                                >
                                                <i class="fa-regular fa-copy"></i>
                                                Agregar Lista
                                            </button>
                                        </a>
                                    </div>
                                @endif
                            @endcan
                            
                            
                            
                        @endcan
                    @endif
                </div>    
            @endif            
        </div>
    </div>

    @if ($estado == "Finalizar")

        <div class="flex justify-between items-center mb-4">
            <div>
                <form action="{{route('admin.Asitentes.look')}}" method="POST" >
                    @csrf
                    <input type="text" hidden name="idcampana" value="{{$campaña->PK_Campaña}}" required />
                    <div class="grid gap-6 mb-4 md:grid-cols-2">
                        <div>
                            <input type="text" id="first_name" name="dni" maxlength="8" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ingresar DNI" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                        </div>
                        <div>
                            <button required type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"><i class="fa-solid fa-magnifying-glass"></i></button> 
                        </div>
                    </div>

                </form>
            </div>

        </div>

        
    @else
        
    @endif
    
    <br>
    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
        <table class="w-full text-sm text-left rtl:text-right text-fg-brand-subtle">
            <thead class="text-sm text-black bg-brand-strong">
                <tr class="bg-brand border-b border-brand-light">
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        #
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Nombre
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Apellido Paterno
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Apellido Materno
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Numero DNI
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Numero de celular
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Edad
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (!$asistentes)
                    <tr class="bg-brand border-b border-brand-light">
                        <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                            No hay asistentes registrados
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                            No hay asistentes registrados
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                            No hay asistentes registrados
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                            No hay asistentes registrados
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                            No hay asistentes registrados
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                            No hay asistentes registrados
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap">
                            No hay asistentes registrados
                        </th>
                        
                    </tr>
                    
                @else
                    @php
                        $numero=1;
                    @endphp
                    @foreach ($asistentes as $asistente)
                    <tr class="bg-brand border-b border-brand-light">
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                {{$numero}}
                            </th>
                            @php
                                $numero=1+$numero;
                            @endphp
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                {{$asistente->Tnombre_asistente}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                {{$asistente->TapellidoP_asistente}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                {{$asistente->TapellidoM_asistente}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                {{$asistente->Tdni_asistente}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                {{$asistente->Tcelular_asistente}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                
                                {{$asistente->Nedad_asistente}}
                            </th>
                            
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                <div class="grid gap-6 mb-4 md:grid-cols-2">
                                    @can('update-asitentes')
                                        <div>
                                            <button class="btnEditarAsistente bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                                                data-id="{{ $asistente->PK_Asistentes }}"
                                                data-nombre="{{ $asistente->Tnombre_asistente }}"
                                                data-apellidoP="{{ $asistente->TapellidoP_asistente }}"
                                                data-apellidoM="{{ $asistente->TapellidoM_asistente }}"
                                                data-edad="{{ $asistente->Nedad_asistente }}"
                                                data-celular="{{ $asistente->Tcelular_asistente }}"
                                                data-dni="{{ $asistente->Tdni_asistente }}">
                                                Editar Asistente
                                            </button>
                                            
                                        </div>
                                    @endcan
                                    @can('delete-asitentes')
                                        <div>
                                            <form action="{{route('admin.Asitentes.edit2',$asistente->PK_Asistentes)}}" class="edit-form" method="POST">
                                                @csrf
                                                <input  hidden type="text" name="idCampaña" value="{{$campaña->PK_Campaña}}" id="">
                                                <button type="submit" 
                                                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                                    Eliminar 
                                                </button>
                                            </form>
                                        </div>
                                    @endcan
                                    
                                </div>
                                
                            </th>
                            
                        </tr>
                    @endforeach
                @endif
        </table>
    </div>
    <div class="mt-4">
        {{ $asistentes->links() }}
    </div>
    

   


    
   

    @push('js')

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.getElementById('mostrarColaboradores').addEventListener('click', function() {
                const colaboradores = {!! json_encode($colaboradores) !!}; 

                let tablaHTML = `
                    <table style="width:100%; border-collapse: collapse;">
                        
                        <tbody>
                            ${colaboradores.map(c => `
                                <tr>
                                    <td style="padding:8px; border-bottom:1px solid #ddd; text-align:center;">
                                        ${c.Tnombre_colaborador ?? '(sin nombre)'}
                                    </td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                `;

                Swal.fire({
                    title: ' Colaboradores',
                    html: tablaHTML,
                    width: 400,
                    confirmButtonText: 'Cerrar',
                    confirmButtonColor: '#2563eb'
                });
            });
        </script>

        <script>
            document.getElementById('mostrarEspecilidades').addEventListener('click', function() {
                const OnEspecialidadades = {!! json_encode($OnEspecialidadades) !!} || []; 

                let tablaHTML = `
                    <table style="width:100%; border-collapse: collapse;">
                        <tbody>
                            ${OnEspecialidadades.map(c => `
                                <tr>
                                    <td style="padding:8px; border-bottom:1px solid #ddd; text-align:center;">
                                        ${c.Tdescripcion_especialidad ?? '(sin nombre)'}
                                    </td>
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                `;

                Swal.fire({
                    title: 'Especialidades',
                    html: tablaHTML,
                    width: 400,
                    confirmButtonText: 'Cerrar',
                    confirmButtonColor: '#2563eb'
                });
            });
        </script>

        
        <script>
            //para agregar usuario
                document.getElementById('agregar-asistente').addEventListener('click', function() {
                    Swal.fire({
                        title: 'Agregar Asistente',
                        html: `
                        <form id="formAsistente" >
                            @csrf
                            <div class="grid gap-4 text-left">
                                
                                <input type="text" name="idCampaña" id=""  hidden value="{{$campaña->PK_Campaña}}" class="swal2-input" required>
                                <input type="number" name="TipoCampa" id="TipoCampa" hidden  value="{{$campaña->PK_TiposCampañas}}" class="swal2-input" required>
                                <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Nombre:</label>
                                        <input type="text" name="nombre" id=""
                                            class="swal2-input" style="width: 90%;"
                                            placeholder="Ingrese el nombre completo"
                                            maxlength="30" required>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Edad:</label>
                                        <input type="text" name="edad"
                                        class="swal2-input"
                                        maxlength="3"
                                        inputmode="numeric"
                                        pattern="[0-9]{1,2,3}"
                                        oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                        required>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Apellido Paterno:</label>
                                        <input type="text" name="apeP" id="" class="swal2-input" maxlength="25" required>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-900">Apellido Materno:</label>
                                        <input type="text" name="apeM" id="" class="swal2-input" maxlength="25" required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-900">DNI:</label>
                                        <input type="text" name="DNI" id="" class="swal2-input" maxlength="8" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                    </div>
    
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-900">Numero de celular:</label>
                                        <input type="text" name="celular" id="" class="swal2-input" maxlength="9" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                                    </div>
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
                            const form = document.getElementById('formAsistente');
                            const formData = new FormData(form);

                            return fetch("{{ route('admin.Asitentes.store') }}", {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (!data.ok) {
                                    Swal.showValidationMessage(data.msg || 'No se pudo registrar el asitente');
                                }
                                return data;
                            })
                            .catch(error => {
                                Swal.showValidationMessage(`Error: ${error}`);
                            });
                        }
                    }).then((result) => {
                        if (result.isConfirmed && result.value.ok) {
                            Swal.fire('Éxito', 'Asistente registrado correctamente', 'success')
                                .then(() => location.reload());
                        }
                    });
                });
        </script>


        <script>
            document.getElementById('agregar-asistente-mascota').addEventListener('click', function () {
            
                let maxMascotas = 5;
                let contadorMascotas = 1;
            
                Swal.fire({
                    title: 'Agregar Asistente',
                    width: '650px',
                    showCancelButton: true,
                    confirmButtonText: 'Registrar',
                    cancelButtonText: 'Cancelar',
                    focusConfirm: false,
            
                    html: `
                    <form id="formAsistente">
                        @csrf
            
                        <input type="hidden" name="idCampaña" value="{{ $campaña->PK_Campaña }}">
                        <input type="hidden" name="TipoCampa" value="{{ $campaña->PK_TiposCampañas }}">
            
                        <div class="grid gap-6 md:grid-cols-2 mt-4 mb-4">
                            <div>
                                <label>Nombre:</label>
                                <input type="text" name="nombre" class="swal2-input" maxlength="70" required>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-900">Edad:</label>
                                <input type="text" name="edad" class="swal2-input"
                                    maxlength="2"
                                    inputmode="numeric"
                                    pattern="[0-9]{1,2}"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                    required>
                            </div>
                            <div>
                                <label>Apellido Paterno:</label>
                                <input type="text" name="apeP" class="swal2-input" maxlength="50" required>
                            </div>
                            <div>
                                <label>Apellido Materno:</label>
                                <input type="text" name="apeM" class="swal2-input" maxlength="50" required>
                            </div>
                            <div>
                                <label>DNI:</label>
                                <input type="text" name="DNI" class="swal2-input" maxlength="8"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'')" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-900">Numero de celular:</label>
                                <input type="text" name="celular" id="" class="swal2-input" maxlength="9" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                            </div>
                        </div>

                        <div class="mb-4" >
                            <h2>Registro de mascota<h2>
                        </div>
                        <div id="contenedorMascotas">
                            <div class="mascota mb-4">
                                <div class="mb-4" >
                                    <label>Mascota #1:</label>
                                    <input type="text" name="mascotas[0][nombre]"
                                        class="swal2-input" maxlength="20" required>
                                </div>
                                <div class="mb-4" >
                                    <label>Especie:</label>
                                    <select name="mascotas[0][especie]" class="swal2-input" required>
                                        <option value="" disabled selected>-Seleccione-</option>
                                        <option value="1">Canino</option>
                                        <option value="2">Felino</option>
                                    </select>
                                </div>
                            </div>
                        </div>
            
                        <button type="button" id="btnAgregarMascota"
                            class="swal2-confirm swal2-styled"
                            style="background:#3085d6;margin-top:10px;">
                            + Agregar otra mascota
                        </button>
            
                    </form>
                    `,
            
                    didOpen: () => {
                        document.getElementById('btnAgregarMascota').addEventListener('click', () => {
            
                            if (contadorMascotas >= maxMascotas) {
                                Swal.showValidationMessage('Máximo 5 mascotas');
                                return;
                            }
                            contadorMascotas++;

                            document.getElementById('contenedorMascotas')
                                .insertAdjacentHTML('beforeend', `
                                    <div class="mascota">
                                        <div class="mb-4" >
                                            <label>Mascota #${contadorMascotas}:</label>
                                            <input type="text"
                                                name="mascotas[${contadorMascotas-1}][nombre]"
                                                class="swal2-input" maxlength="30" required>
                                        </div>
                                        
                                        <div class="mb-4" >
                                            <label>Especie:</label>
                                            <select name="mascotas[${contadorMascotas-1}][especie]"
                                                    class="swal2-input" required>
                                                <option value="" disabled selected>-Seleccione-</option>
                                                <option value="1">Canino</option>
                                                <option value="2">Felino</option>
                                            </select>
                                        </div>
                                    </div>
                                `);
                        });
                    },
            
                    preConfirm: () => {
                        const form = document.getElementById('formAsistente');
                        const formData = new FormData(form);
            
                        return fetch("{{ route('admin.Asitentes.store') }}", {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (!data.ok) {
                                Swal.showValidationMessage(data.msg || 'Error al registrar');
                            }
                            return data;
                        })
                        .catch(() => {
                            Swal.showValidationMessage('Error de servidor');
                        });
                    }
                }).then(result => {
                    if (result.isConfirmed && result.value.ok) {
                        Swal.fire('Éxito', 'Asistente registrado correctamente', 'success')
                            .then(() => location.reload());
                    }
                });
            
            });
        </script>
    

        <script>
                const swiper = new Swiper(".mySwiper", {
                    loop: true,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },
                });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function () {
            
                document.querySelectorAll('.btnEditarAsistente').forEach(button => {
                    button.addEventListener('click', function () {
            
                        const id        = this.getAttribute('data-id');
                        const nombre    = this.getAttribute('data-nombre');
                        const apellidoP = this.getAttribute('data-apellidoP');
                        const apellidoM = this.getAttribute('data-apellidoM');
                        const dni       = this.getAttribute('data-dni');
                        const edad      = this.getAttribute('data-edad');
                        const celular   = this.getAttribute('data-celular');
            
                        const nombreSeguro    = nombre.replace(/"/g, '&quot;');
                        const apellidoPSeguro = apellidoP.replace(/"/g, '&quot;');
                        const apellidoMSeguro = apellidoM.replace(/"/g, '&quot;');
            
                        Swal.fire({
                            title: 'Editar Asistentes',
                            showCancelButton: true,
                            confirmButtonText: 'Guardar cambios',
                            cancelButtonText: 'Cancelar',
                            focusConfirm: false,
            
                            html: `
                            <form id="formEditarAsistente">
            
                                <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
                                    <div>
                                        <label>Nombre:</label>
                                        <input type="text" id="nombre" maxlength="30" class="swal2-input"
                                               value="${nombreSeguro}" required>
                                    </div>
            
                                    
            
                                    <div>
                                        <label>Apellido Paterno:</label>
                                        <input type="text" id="apellidoP" maxlength="30" class="swal2-input"
                                               value="${apellidoPSeguro}" required>
                                    </div>
            
                                    <div>
                                        <label>Apellido Materno:</label>
                                        <input type="text" id="apellidoM" maxlength="30" class="swal2-input"
                                               value="${apellidoMSeguro}" required>
                                    </div>
                                    
            
                                    <div>
                                        <label>DNI:</label>
                                        <input type="text" id="dni" class="swal2-input"
                                               maxlength="8"
                                               oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                               value="${dni}" required>
                                    </div>
            
                                    <div>
                                        <label>Celular:</label>
                                        <input type="text" id="celular" class="swal2-input"
                                               maxlength="9"
                                               oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                               value="${celular}" required>
                                    </div>
                                    <div>
                                        <label>Edad:</label>
                                        <input type="number"
                                        id="edad"
                                        class="swal2-input"
                                        min="0" max="999"
                                        oninput="this.value=this.value.slice(0,3)"
                                        required
                                        style="width:50%;">
                                    </div>

                                </div>
                            </form>
                            `,
            
                            preConfirm: () => {
                                const nombre    = Swal.getPopup().querySelector('#nombre').value;
                                const apellidoP = Swal.getPopup().querySelector('#apellidoP').value;
                                const apellidoM = Swal.getPopup().querySelector('#apellidoM').value;
                                const dni       = Swal.getPopup().querySelector('#dni').value;
                                const edad      = Swal.getPopup().querySelector('#edad').value;
                                const celular   = Swal.getPopup().querySelector('#celular').value;
            
                                if (!nombre || !apellidoP || !apellidoM || !dni || !edad || !celular) {
                                    Swal.showValidationMessage('Completa todos los campos');
                                    return false;
                                }
            
                                return { id, nombre, apellidoP, apellidoM, dni, edad, celular };
                            }
            
                        }).then(result => {
                            if (result.isConfirmed) {
            
                                const d = result.value;
                                const formData = new FormData();
            
                                formData.append('_method', 'PUT');
                                formData.append('nombre', d.nombre);
                                formData.append('apellidoP', d.apellidoP);
                                formData.append('apellidoM', d.apellidoM);
                                formData.append('dni', d.dni);
                                formData.append('edad', d.edad);
                                formData.append('celular', d.celular);
            
                                fetch(`/admin/Asitentes/${d.id}`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: formData
                                })
                                .then(res => {
                                    if (!res.ok) throw new Error('Error al actualizar');
                                    return res.json();
                                })
                                .then(() => {
                                    Swal.fire(
                                        'Actualizado',
                                        'El asistente fue editado correctamente',
                                        'success'
                                    ).then(() => location.reload());
                                })
                                .catch(() => {
                                    Swal.fire('Error', 'No se pudo actualizar', 'error');
                                });
                            }
                        });
            
                    });
                });
            
            });
        </script>
            




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

        <script>
            document.getElementById('mostrarDocumentos').addEventListener('click', function() {
                const documentos = {!! json_encode($documentos) !!}; // tus documentos desde Laravel
                const deleteBase = "{{ route('admin.campañas.documentos.delete', ':id') }}";

                let tablaHTML = `
                    <table style="width:100%; border-collapse: collapse;">
                        <tbody>
                            ${documentos.map(c => `
                                <tr>
                                    <td style="padding:8px; border-bottom:1px solid #ddd; text-align:center;">
                                        ${c.Tnombre_documentos}
                                    </td>
                                    <td style="padding:8px; border-bottom:1px solid #ddd; text-align:center;">
                                        <a href="/storage/${c.Tpath_documentos}" target="_blank">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>
                                    <td style="padding:8px; border-bottom:1px solid #ddd; text-align:center;">
                                        <a href="${deleteBase.replace(':id', c.PK_Documentos)}">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    </td>
                                        
                                </tr>
                            `).join('')}
                        </tbody>
                    </table>
                `;

                Swal.fire({
                    title: 'Documentos',
                    html: tablaHTML,
                    width: 400,
                    confirmButtonText: 'Cerrar',
                    confirmButtonColor: '#2563eb'
                });
            });
        </script>
        
    @endpush





</x-admin-layout>