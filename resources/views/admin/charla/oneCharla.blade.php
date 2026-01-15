<x-admin-layout :breadcrumbs="[
    [
        'name'=>'Menu',
        'href' => '/',
    ],
    [
        'name'=>'Charlas',
        'href' => route('admin.Charlas.index')
    ],
    [
        'name'=> 'Charla',
    ]
    ]">
    
    <div class="flex justify-center mt-4">
        <h1 class="font-extrabold text-gray-900" style="font-size: 2rem;">
            {{ $charla->Tnombre_charla }}
        </h1>
    </div>
    
    @if ($Drestantes>0)
        <div class="flex justify-between items-center mb-4">
            @can('update-charlas')
                <div>
                    <a href="{{route('admin.charla.documento',$charla->PK_Charlas)}}">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" id="agregar-asistente" >
                            <i class="fa-solid fa-file"></i>
                            Agregar lista
                        </button>    
                    </a>
                </div>            
            @endcan
            
            @can('update-charlas')
                <div>
                    <a href="{{route('admin.charla.imagen',$charla->PK_Charlas)}}">
                        <button style="background:#7c3aed; color:white; padding:8px 16px; border-radius:6px;">
                            <i class="fa-solid fa-camera"></i>
                            Agregar Evidencia
                        </button>    
                    </a>
                    
                </div>
            @endcan
                
        </div>
    @endif
    
    <br>
    @if ($imagenes->isEmpty())
        <div class="flex justify-center mb-4 " >
            <img src="https://www.stellamaris.com.pe/uploads/shares/BLOG/CAMPA__A_DE_SALUD_-_RESP__SOCIAL.jpg" height="450px" width="640px" alt="imagen de la campaña">
        </div>
        @if ($Drestantes>0)
            <div class="flex justify-center mb-4 " >
                <button id="agregar-asistentes" type="submit"  style=" background:#22c55e; color:white; padding:12px 24px; font-size:16px; line-height:1.2; height:auto;">
                Agregar asistente                
                </button>
            </div>
            <div class="text-blue-500 flex justify-center "  >
                <p>*Queda {{$Drestantes}} dia(s) para subir la evidencia</p>  
            </div>
        @else
            <div class="text-red-500 flex justify-center "  >
                <p>*Se termino el tiempo para subir evidencia</p>  
            </div>
        @endif
        
    @else
        <div class="swiper mySwiper w-full max-w-xl">
            <div class="swiper-wrapper">
                @foreach ($imagenes as $img)
                    <div class="swiper-slide relative flex justify-center">
                        <a href="{{route('admin.charla.imagen.delete',$img->PK_Imagenes)}}"
                        class="absolute top-2 right-2 bg-red-600 text-white p-2 rounded-full shadow hover:bg-red-700 transition">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                        <img src="/storage/{{ $img->Tpath_imagenes }}" 
                            class="rounded-lg shadow-lg w-full h-auto">
                    </div>
                @endforeach
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
        
    @endif

    <br>
    <div class="grid gap-6 mb-4 md:grid-cols-3  ">
        
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Fecha:</label>    
            <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->DfechaIni_charla}}" disabled>                
        </div>
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Hora de inicio:</label>    
            <input type="time" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->ThoraIni_charla}}" disabled>                
        </div>
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Hora de fin:</label>    
            <input type="time" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->ThoraFin_charla}}" disabled>                
        </div>

        @if ($charla->PK_TiposCharla ==1 )
            <div class="grid gap-6  md:grid-cols-3 mb-4 ">
                @if (!$charla->Ncantidad_felinos)
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad de Gatos beneficiados:</label>    
                        <input style="width: 100%"  type="text" id="disabled-input" aria-label="disabled input" class=" flex justify-centers mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="0" disabled>                
                    </div>
                    
                @else
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad de Gatos beneficiados:</label>    
                        <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->Ncantidad_felinos}}" disabled>                
                    </div>
                @endif

                @if (!$charla->Ncantidad_caninos)
                    <div  >
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad de Perros beneficiados:</label>    
                        <input style="width: 100%" type="text" id="disabled-input" aria-label="disabled input" class=" flex justify-centers mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="0" disabled>                
                    </div>
                    
                @else
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad de Perros beneficiados:</label>    
                        <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->Ncantidad_caninos}}" disabled>                
                    </div>
                    
                @endif

            </div>

        @else   
            @if (!$cantidad)
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad:</label>    
                    <input type="text" name="canti"  id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="0" disabled>                
                </div>
                
            @else
                <div>
                    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad:</label>    
                    <input type="text" name="canti" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$cantidad}}" disabled>                
                </div>
                
            @endif

        @endif
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Lugar:</label>    
            <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->Tlugar_charla}}" disabled>                
        </div>
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Lugar especifico:</label>    
            <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->TdescripcionLugar_charla}}" disabled>                
        </div>
        
    </div>

    @if ($documentos->isEmpty())
        <div class="flex justify-between items-center mb-4">
            <button type="button"
                class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600"
                id="mostrarExpositores">
                <i class="fa-solid fa-user"></i>
                Ver Expositores
            </button>
        </div>
        
    @else
        <div class="flex justify-between items-center mb-4">

            <div>
                <button type="button"
                    class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600"
                    id="mostrarExpositores">
                    <i class="fa-solid fa-user"></i>
                    Ver Expositores
                </button>

            </div>
            <div>
                <button id="mostrarDocumentos" 
                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    Mostrar Documentos
                </button>

            </div>
        </div>
    
    @endif
    <div class="flex justify-between items-center mb-4">
        <form action="{{route('admin.Asitentes.look')}}" method="POST" >
            @csrf
            <div class="grid gap-6 mb-4 md:grid-cols-3">
                <input type="text" hidden name="idCharla" value="{{$charla->PK_Charlas}}" required />

                <div>
                    <input type="text" name="dni" id="first_name"  maxlength="8" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ingresar DNI"  oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                </div>
                <div>
                    <input type="text" name="nombre" maxlength="35" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ingresar nombre"   />
                </div>
                <div>
                    <input type="text" name="apePa" maxlength="35" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ingresar apellido"   />
                </div>                    
            </div>

            <div>
                <button required type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"><i class="fa-solid fa-magnifying-glass"></i></button> 
            </div>
            

        </form>
       

    </div>
    
    <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
        <table class="w-full text-sm text-left rtl:text-right text-fg-brand-subtle">
            <thead class="text-sm text-black bg-brand-strong">
                <tr class="bg-brand border-b border-brand-light">
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Nombre
                    </th>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Apellido Paterno
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Apellido Materno
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        N° DNI
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        N° Celular
                    </td>
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        Edad
                    </td>
                  
                    <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap bg-brand-strong" align="center" >
                        <a href="#" class="font-medium text-black hover:underline">Edit</a>
                    </td>
                </tr>
            </thead>
            <tbody>
                @if (!$asitentes)
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
                    @foreach ($asitentes as $asis)
                        <tr class="bg-brand border-b border-brand-light">
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                {{$asis->Tnombre_asistente}}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-fg-brand-subtle whitespace-nowrap"align="center" >
                                {{$asis->TapellidoP_asistente}}
                            </th>
                            <td class="px-6 py-4" align="center" >
                                {{$asis->TapellidoM_asistente}}
                            </td>
                            <td class="px-6 py-4" align="center" >
                                {{$asis->Tdni_asistente}}
                            </td>
                            <td class="px-6 py-4" align="center" >
                                {{$asis->Tcelular_asistente}}
                            </td>
                            <td class="px-6 py-4" align="center" >
                                {{$asis->Nedad_asistente}}
                            </td>
                            
                            <td class="px-6 py-4" align="center" >
                                <div class="grid gap-6 mb-4 md:grid-cols-2">
                                    {{-- <a class="text-green-600" > 
                                        <i class="fa-solid fa-pen-to-square"></i>   
                                    </a>   --}}
                                    <div>
                                        <button class="text-green-600 btnEditarAsistente "
                                            data-id="{{ $asis->PK_Asistentes }}"
                                            data-nombre="{{ $asis->Tnombre_asistente }}"
                                            data-apellidoP="{{ $asis->TapellidoP_asistente }}"
                                            data-apellidoM="{{ $asis->TapellidoM_asistente }}"
                                            data-edad="{{ $asis->Nedad_asistente }}"
                                            data-celular="{{ $asis->Tcelular_asistente }}"
                                            data-dni="{{ $asis->Tdni_asistente }}">
                                            <i class="fa-solid fa-pen-to-square"></i> 
                                        </button>
                                        
                                    </div>
                                    
    
                                    <div>
                                        <form action="{{route('admin.Asitentes.edit2',$asis->PK_Asistentes)}}" class="edit-form" method="POST">
                                            @csrf
                                            <input  hidden type="number" name="tipo" value="1" >
                                            <input  hidden type="text" name="idCharla" value="{{$charla->PK_Charlas}}" >
                                            <button type="submit"  class="text-red-600">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>        
                                    </div>

                                </div>
                            </td>
                        </tr>                        
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $asitentes->links() }}
    </div>







    @push('js')
        <script>
            //para agregar usuario
                document.getElementById('agregar-asistentes').addEventListener('click', function() {
                    Swal.fire({
                        title: 'Agregar Asistente',
                        html: `
                        <form id="formAsistente" >
                            @csrf

                            <input type="text" name="idCharla"   hidden value="{{$charla->PK_Charlas}}" class="swal2-input" required>
                            <input type="number" name="charla"  hidden value="1"  required>

                            <div class="grid gap-4 text-left">
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
                            <div>
                                <label class="block text-sm font-medium text-gray-900">Direccion:</label>
                                <input type="text" name="direccion" id="" class="swal2-input" maxlength="130" style="width: 90%;"required>
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
                document.getElementById('mostrarExpositores').addEventListener('click', function() {
                    const expositores = {!! json_encode($expositores) !!}; 

                    let tablaHTML = `
                        <table style="width:100%; border-collapse: collapse;">
                            
                            <tbody>
                                ${expositores.map(c => `
                                    <tr>
                                        <td style="padding:8px; border-bottom:1px solid #ddd; text-align:center;">
                                            ${c.Tnombre_expositor ?? '(sin nombre)'}
                                        </td>
                                        <td style="padding:8px; border-bottom:1px solid #ddd; text-align:center;">
                                            ${c.TapellidoP_expositor ?? '(sin apellido)'}
                                        </td>
                                        <td style="padding:8px; border-bottom:1px solid #ddd; text-align:center;">
                                            ${c.TapellidoM_expositor ?? '(sin apellido)'}
                                        </td>
                                    </tr>
                                `).join('')}
                            </tbody>
                        </table>
                    `;

                    Swal.fire({
                        title: ' expositores',
                        html: tablaHTML,
                        width: 400,
                        confirmButtonText: 'Cerrar',
                        confirmButtonColor: '#2563eb'
                    });
                });
            </script>

        <script>
            document.getElementById('mostrarDocumentos').addEventListener('click', function() {
                const documentos = {!! json_encode($documentos) !!}; // tus documentos desde Laravel
                const deleteBase = "{{ route('admin.charla.documentos.delete', ':id') }}";

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
        
    @endpush

</x-admin-layout>