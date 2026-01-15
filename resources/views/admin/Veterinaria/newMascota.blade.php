<x-admin-layout :breadcrumbs="[
    [
        'name'=>'Menu',
        'href' => '/',
    ],
    [
        'name'=> 'Mascotas',
        'href' => route('admin.Mascotas.index')
    ],
    [
        'name'=> 'Registrar Mascotas',
    ]
    ]">

    <div>
        <button type="button"   class="bg-yellow-500 text-white px-4 py-2 rounded" onclick="mostrarFormulario()">
            Responsable ya registrado
        </button>
    </div>

    <div class="max-w-6xl mx-auto p-6">
        
        <div id="gallery" class="w-full" data-carousel="slide">
            
            <ol class="flex items-center w-full space-x-4 mb-6">
                <li id="s1" class="step-active flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-brand-subtle after:border-4 after:inline-block after:ms-4 after:rounded-full">
                    <span class="step-circle-active">
                        <i class="fa-solid fa-person"></i>
                        <span class="ml-2 text-sm">Registro responsables</span>
                    </span>
                </li>
    
                <li id="s2" class="step-inactive flex w-full items-center after:content-[''] after:w-full after:h-1 after:border-b after:border-default after:border-4 after:inline-block after:ms-4 after:rounded-full">
                    <span class="step-circle-inactive">
                        <i class="fa-solid fa-paw"></i>
                        <span class="ml-2 text-sm">Datos de la Mascota</span>
                    </span>
                </li>
    
                <li id="s3" class="step-inactive flex items-center w-full">
                    <span class="step-circle-inactive">
                        <i class="fa-solid fa-circle-check"></i>
                        <span class="ml-2 text-sm">Confirmación</span>
                    </span>
                </li>
            </ol>
    
        </div>
    </div>

    
    

    <div class="max-w-6xl mx-auto p-6">
        <!-- FORMULARIO COMPLETO -->
        <form id="form1" class="w-full" enctype="multipart/form-data">
    
            <!-- PASO 1 -->
            <div id="paso1">
                <h3 class="text-lg font-medium mb-4">Paso 1: Responsable</h3>
    
                <div class="grid gap-6 mb-4 md:grid-cols-3 mt-4">
                    <div class="mb-4">
                        <label class="text-sm">Nombre</label>
                        <input name="nombreRes" maxlength="55" type="text" class="border w-full p-2 rounded-lg" required  value="{{ old('nombreRes') }}" >
                        @error('nombreRes')
                            <p class="text-red-600">*{{$message}}</p>
                        @enderror
                    </div>
            
                    <div class="mb-4">
                        <label class="text-sm">Apellido Paterno:</label>
                        <input type="text" name="apePaRes" maxlength="30" class="border w-full p-2 rounded-lg" required value="{{ old('apePaRes') }}" >
                        @error('apePaRes')
                            <p class="text-red-600">*{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="text-sm">Apellido Materno:</label>
                        <input type="text" name="apeMaRes" maxlength="30" class="border w-full p-2 rounded-lg" required value="{{ old('apeMaRes') }}"  >
                        @error('apeMaRes')
                            <p class="text-red-600">*{{$message}}</p>
                        @enderror
                    </div>
    
                    <div class="mb-4">
                        <label class="text-sm">DNI:</label>
                        <input type="text" name="dniRes" maxlength="8" class="border w-full p-2 rounded-lg" value="{{ old('dniRes') }}"  oninput="this.value = this.value.replace(/[^0-9]/g, '');" required  />
                        @error('dniRes')
                            <p class="text-red-600">*{{$message}}</p>
                        @enderror
                    </div>
            
                    <div class="mb-4">
                        <label class="text-sm">Celular:</label>
                        <input type="text" name="numCelRes" maxlength="9" class="border w-full p-2 rounded-lg" value="{{ old('numCelRes') }}"  oninput="this.value = this.value.replace(/[^0-9]/g, '');" required  />
                        @error('numCelRes')
                            <p class="text-red-600">*{{$message}}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="text-sm">Direccion:</label>
                        <input type="text" name="direRes" maxlength="120" value="{{old('direRes')}}"  class="border w-full p-2 rounded-lg"  required >
                        @error('direRes')
                            <p class="text-red-600">*{{$message}}</p>
                        @enderror
                    </div>
                </div>
    
                <div class="grid gap-4 mb-4 md:grid-cols-2 mt-4">
                    {{-- opcional --}}
                    <div class="mb-4">
                        <label class="text-sm">Numero de Telefono Fijo:</label>
                        <input type="text" name="telFijo" maxlength="15" value="{{old('telFijo')}}" class="border w-full p-2 rounded-lg"  oninput="this.value = this.value.replace(/[^0-9]/g, '');" />
                        @error('telFijo')
                            <p class="text-red-600">*{{$message}}</p>
                        @enderror
                    </div>
                    {{-- opcional --}}
                    <div class="mb-4">
                        <label class="text-sm">Correo electronico:</label>
                        <input type="email" name="correo" value="{{old('correo')}}" class="border w-full p-2 rounded-lg" >
                        @error('email')
                            <p class="text-red-600">*{{$message}}</p>
                        @enderror
                    </div>
                    {{-- opcional --}}
                    <div class="mb-4">
                        <label class="text-sm">Foto de documento:</label>
                        <input type="file" accept="application/pdf,image/*" name="docuImagen" class="border w-full p-2 rounded-lg" >
                    </div>
                    {{-- opcional --}}
                    <div class="mb-4">
                        <label class="text-sm">Adjuntar Doc. - Residencia del Responsable (PDF):</label>
                        <input type="file" accept="application/pdf,image/*" name="residenciaDoc" class="border w-full p-2 rounded-lg" >
                    </div>
                    
                </div>

                <div class="flex justify-between items-center" >
                    <div>
                        <button type="button" id="next1" class="bg-blue-600 text-white px-4 py-2 rounded">
                            Siguiente
                        </button>

                    </div>
                    
                </div>
    

            </div>
    
            <!-- PASO 2 -->
            <div id="paso2" class="hidden">
                <h3 class="text-lg font-medium mb-4">Paso 2: Datos de la Mascota</h3>
                
                <div class="grid gap-6 mb-4 md:grid-cols-3 mt-4">
                    <div class="mb-4">
                        <label class="text-sm">Nombre:</label>
                        <input name="nombreMas" value="{{old('nombreMas')}}"  maxlength="55" type="text" class="border w-full p-2 rounded-lg" required  >
                        @error('nombreMas')
                            <p class="text-red-600">*{{$message}}</p>
                        @enderror
                    </div>
            
                    <div class="mb-4">
                        <label class="text-sm">Especie:</label>
                        <select required name="tipo" id="" style="width: 100%"  >
                            <option selected disabled  value="">Escoja una opción</option>

                            <option value="Canino" {{old('tipo')== "Canino" ? 'selected': '' }} >Canino</option>
                            <option value="Felino" {{old('tipo')== "Felino" ? 'selected': '' }}  >Felino</option>
                        </select>
                        @error('tipo')
                            <p class="text-red-600">*{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <div class="mb-4">
                            <label class="text-sm">Raza:</label>
                            <input name="raza" value="{{old('raza')}}"   maxlength="55" type="text" class="border w-full p-2 rounded-lg" required  >
                        </div>
                        @error('raza')
                            <p class="text-red-600">*{{$message}}</p>
                        @enderror
                    </div>
                    
                </div>
                
                
                <div class="grid gap-6 mb-4 md:grid-cols-3 mt-4">
                    <div class="mb-4">
                        <label class="text-sm">Sexo:</label>
                        <select required name="sexo"  style="width: 100%"  >
                            <option selected disabled  value="">Escoja una opción</option>
                            <option value="MACHO" {{old('sexo')== "MACHO" ? 'selected': '' }} >MACHO</option>
                            <option value="HEMBRA" {{old('sexo')== "HEMBRA" ? 'selected': '' }} >HEMBRA</option>
                        </select>
                        @error('sexo')
                            <p class="text-red-600">*{{$message}}</p>
                        @enderror
                    </div>
                    {{-- opcional --}}
                    <div class="mb-4">
                        <label class="text-sm">Fecha de Nacimiento:</label>
                        <input  type="Date" name="fechaNaci" class="border w-full p-2 rounded-lg" value="{{old('fechaNaci')}}"  max="{{ date('Y-m-d') }}" />
                        @error('fechaNaci')
                            <p class="text-red-600">*{{$message}}</p>
                        @enderror
                    </div>
            
                    <div class="mb-4">
                        <label class="text-sm">Color:</label>
                        <input required type="text"  name="color" maxlength="80"  value="{{old('color')}}"  class="border w-full p-2 rounded-lg"  />
                        @error('color')
                            <p class="text-red-600">*{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="text-sm">Antecedentes de Agresividad   :</label>
                        <select  required name="antecedentes" id="" style="width: 100%" >
                            <option selected disabled  value="">Escoja una opción</option>
                            <option value="Si" {{old('antecedentes')== "Si" ? 'selected': '' }} >Si</option>
                            <option value="No" {{old('antecedentes')== "No" ? 'selected': '' }}  >NO</option>
                        </select>
                        @error('antecedentes')
                            <p class="text-red-600">*{{$message}}</p>
                        @enderror
                    </div>
    
    
                    <div class="mb-4">
                    <label class="text-sm">Potencialmente Peligroso:</label>
                        <select  required name="peligrocidad" id="" style="width: 100%" >
                            <option selected disabled  value="">Escoja una opción</option>
                            <option value="Si" {{old('peligrocidad')== "Si" ? 'selected': '' }} >Si</option>
                            <option value="NO" {{old('peligrocidad')== "NO" ? 'selected': '' }} >No</option>
                        </select>
                        @error('peligrocidad')
                            <p class="text-red-600">*{{$message}}</p>
                        @enderror
                    </div>
                    {{-- opcional --}}
                    <div class="mb-4">
                        <label class="text-sm">Señas particulares:</label>
                        <input type="text" name="señales" maxlength="100" value="{{old('señales')}}"  class="border w-full p-2 rounded-lg"  />
                        @error('señales')
                            <p class="text-red-600">*{{$message}}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="grid gap-4 mb-4 md:grid-cols-3 mt-4">
                    {{-- opcional --}}
                    <div class="mb-4">
                        <label class="text-sm">Identificación :</label>
                        <select required name="identificacion" id="miSelect-identificacion" style="width: 100%" >
                            <option  selected disabled  value="">Escoja una opción</option>
                            @foreach ($identificadores as $iden)
                                <option value="{{$iden->PK_Identificacion}} {{old('identificacion')== $iden->PK_Identificacion ? 'selected': '' }} ">{{$iden->Tnombre_identificacion}}</option>
                            @endforeach
                        </select>
                        @error('identificacion')
                            <p class="text-red-600">*{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="text-sm">Fotografía de la Mascota: </label>
                        <input type="file" name="fotoMascota[]" multiple accept="application/pdf,image/*" class="border w-full p-2 rounded-lg" >
    
                    </div>
                    <div class="mb-4">
                        <label class="text-sm">Cartilla o Certificado de Vacunación:</label>
                        <input  type="file" accept="application/pdf,image/*" name="certiMascota" class="border w-full p-2 rounded-lg"  >
                    </div>
                    
                </div>
    
                <button type="button" id="back1" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Atrás</button>
                <button type="button" id="next2" class="bg-blue-600 text-white px-4 py-2 rounded">Siguiente</button>
            </div>
    
            <!-- PASO 3 -->
            <div id="paso3" class="hidden">
                <h3 class="text-lg font-medium mb-4">Paso 3: Confirmación</h3>
    
                <p class="mb-4">Revisa la información antes de enviar.</p>
    
                <button type="button" id="back2" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Atrás</button>
    
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
                    Finalizar y Enviar
                </button>
            </div>
    
        </form>


    </div>



    @push('css')
        <style>
            .step-active .step-circle-active {
                @apply flex items-center justify-center w-10 h-10 bg-brand-softer rounded-full;
            }
            .step-inactive .step-circle-inactive {
                @apply flex items-center justify-center w-10 h-10 bg-neutral-tertiary rounded-full;
            }
        </style>
    @endpush


    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            function mostrarFormulario() {
                Swal.fire({
                    title: 'Buscar responsable',
                    html: `
                        <input id="dni" class="swal2-input" placeholder="DNI" maxlength="8">
                    `,
                    confirmButtonText: 'Buscar',
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    allowOutsideClick: () => !Swal.isLoading(),
                    preConfirm: () => {
            
                        const dni = document.getElementById('dni').value;
            
                        if (!dni) {
                            Swal.showValidationMessage('Ingrese el DNI');
                            return false;
                        }
            
                        return fetch("{{ route('admin.Mascotas.responsable') }}", {
                            method: 'POST',
                            credentials: 'same-origin',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document
                                    .querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            },
                            body: JSON.stringify({ dni })
                        })
                        .then(res => res.json())
                        .then(data => {
                            // 🔑 cerramos SweetAlert y redirigimos
                            Swal.close();
                            window.location.href = data.url;
                        })
                        .catch(() => {
                            Swal.showValidationMessage('Error al procesar la solicitud');
                        });
                    }
                });
            }
        </script>
            
            
        
            



        <script>
            function validarMaximoImagenes(input) {
                if (input.files.length > 2) {
                    alert("Solo puedes subir un máximo de 2 imágenes.");
                    input.value = ""; // limpia el input
                }
            }
        </script>



        <script>
            window.onload = () => {

                const form = document.getElementById("form1");

                form.addEventListener("submit", async function (e) {
                    e.preventDefault();

                    const data = new FormData(this);

                    // Para verificar
                    console.log([...data.entries()]);

                    try {
                        const response = await fetch("{{ route('admin.Mascotas.store') }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: data
                        });

                        const result = await response.json();
                        console.log(result);

                    if (result.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Guardado",
                                text: "Los datos se guardaron correctamente"
                            }).then(() => {
                                window.location.href = "{{route('admin.Mascotas.index')}}";
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: "Ocurrió un problema guardando los datos"
                            });
                        }

                    } catch (error) {
                        console.error(error);
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "No se pudo enviar la información"
                        });
                    }

                });

            };
        </script>
        <script>
        document.addEventListener("DOMContentLoaded", () => {

            const paso1 = document.getElementById("paso1");
            const paso2 = document.getElementById("paso2");
            const paso3 = document.getElementById("paso3");

            const s1 = document.getElementById("s1");
            const s2 = document.getElementById("s2");
            const s3 = document.getElementById("s3");

            const form = document.getElementById("form1");

            function activarPaso(paso) {
                paso1.classList.add("hidden");
                paso2.classList.add("hidden");
                paso3.classList.add("hidden");

                s1.classList.add("step-inactive");
                s2.classList.add("step-inactive");
                s3.classList.add("step-inactive");

                s1.classList.remove("step-active");
                s2.classList.remove("step-active");
                s3.classList.remove("step-active");

                if (paso === 1) {
                    paso1.classList.remove("hidden");
                    s1.classList.add("step-active");
                }
                if (paso === 2) {
                    paso2.classList.remove("hidden");
                    s2.classList.add("step-active");
                }
                if (paso === 3) {
                    paso3.classList.remove("hidden");
                    s3.classList.add("step-active");
                }
            }

            // VALIDAR PASO 1 ANTES DE PASAR
            document.getElementById("next1").onclick = () => {
                const inputsPaso1 = paso1.querySelectorAll("input");

                // crear form temporal para validar solo este paso
                let ok = true;
                inputsPaso1.forEach(i => {
                    if (!i.checkValidity()) ok = false;
                });

                if (!ok) {
                    inputsPaso1[0].form.reportValidity();
                    return;
                }

                activarPaso(2);
            };

            // VALIDAR PASO 2 ANTES DE PASAR
            document.getElementById("next2").onclick = () => {
                const inputsPaso2 = paso2.querySelectorAll("input");

                let ok = true;
                inputsPaso2.forEach(i => {
                    if (!i.checkValidity()) ok = false;
                });

                if (!ok) {
                    inputsPaso2[0].form.reportValidity();
                    return;
                }

                activarPaso(3);
            };

            // ATRÁS
            document.getElementById("back1").onclick = () => activarPaso(1);
            document.getElementById("back2").onclick = () => activarPaso(2);


        });
        </script>
        <script>
            $(document).ready(function() {
                $('#miSelect-raza').select2({
                placeholder: "---Seleccioné una raza---",
                allowClear: true
                });
            });
        </script>



    @endpush



    
</x-admin-layout>