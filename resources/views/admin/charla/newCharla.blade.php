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
        'name'=> 'Agregar Charla',
    ]
    ]">

    <form action="{{route('admin.Charlas.store')}}" method="POST"  >
        @csrf
        <div class="flex justify-center">
            <div>
                <label for="charlas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                    Elige un tipo de charla
                </label>
                <select required name="charlas" id="miSelect-tipoCharla"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                        focus:ring-blue-500 focus:border-blue-500 block w-64 p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="" selected disabled>---Seleccioné una charla---</option>
                    @foreach ($Tiposcharlas as $tipo)
                        @if ($tipo->Nestado_Tipocharla==0)
                            
                        @else
                            <option value="{{$tipo->PK_TiposCharla}}">{{$tipo->Tnombre_charla}}</option>
                            
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grid gap-6 mb-4 md:grid-cols-3 mt-4">
            <div>
                <label for="DfechaIni_charla" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                    Fecha de Inicio:
                </label>
                <input name="DfechaIni_charla" type="date" id="DfechaIni_charla" required 
                    value="{{ old('DfechaIni_charla') }}" min="{{ date('Y-m-d') }}"
                    class="border border-gray-300 rounded-lg p-2.5 w-64">
                @error('DfechaIni_charla')
                    <p class="text-red-600">*{{$message}}</p>
                @enderror
            </div>

            <div>
                <label for="horaIni" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                    Hora de inicio:
                </label>    
                <input type="time" name="horaIni" id="horaIni" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>

            <div>
                <label for="horaFin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                    Hora de fin:
                </label>    
                <input type="time" name="horaFin" id="horaFin" required
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <p id="errorHora" class="text-red-600 text-sm mt-1 hidden">
                    * La hora de fin debe ser mayor que la hora de inicio.
                </p>
            </div>
        </div>

        <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
            <div>
                <label for="Tlugar_charla" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                    Lugar:
                </label>
                <input name="Tlugar_charla" type="text" id="Tlugar_charla" required maxlength="30"
                    placeholder="Ingrese el lugar"
                    value="{{ old('Tlugar_charla') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @error('Tlugar_charla')
                    <p class="text-red-600">*{{$message}}</p>
                @enderror
            </div>

            <div>
                <label for="TdescripcionLugar_charla" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                    Descripción exacta del lugar:
                </label>
                <input name="TdescripcionLugar_charla" type="text" id="TdescripcionLugar_charla" required maxlength="50"
                    placeholder="Ingrese descripción del lugar"
                    value="{{ old('TdescripcionLugar_charla') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                        focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @error('TdescripcionLugar_charla')
                    <p class="text-red-600">*{{$message}}</p>
                @enderror
            </div>
        </div>


        <br>
        <div class="flex justify-center mb-4">
            <div id="contenedor-selects">
                <div class="select-group">
                    <label>Seleccione a un Expositor:</label>
                    <select required name="opciones[]" id="miSelect-expositor" >
                    <option value="">-- Seleccione --</option>
                    @foreach ($expositores as $expo)
                            @if ($expo->Nestado_expositor ==0)
                                
                            @else
                                <option value="{{$expo->PK_Expositores}}" >{{$expo->Tnombre_expositor}}</option>
                            @endif
                    @endforeach
                    </select>
                    <label>
                    <input type="checkbox" class="agregarOtro"> ¿Agregar otro Expositor?
                    </label>
                </div>
            </div>

        </div>

        <br>
        @can('create-charlas')
            <div class="flex justify-center mb-4" >
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Registrar Campaña
                </button>
            </div>
            
        @endcan


    </form>
    



    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const horaIni = document.getElementById('horaIni');
                const horaFin = document.getElementById('horaFin');
                const errorHora = document.getElementById('errorHora');
                const form = horaIni.closest('form');

                function validarHoras() {
                    const inicio = horaIni.value;
                    const fin = horaFin.value;

                    if (inicio && fin && fin <= inicio) {
                        errorHora.classList.remove('hidden');
                        horaFin.setCustomValidity('La hora de fin debe ser mayor que la hora de inicio');
                    } else {
                        errorHora.classList.add('hidden');
                        horaFin.setCustomValidity('');
                    }
                }

                horaIni.addEventListener('change', validarHoras);
                horaFin.addEventListener('change', validarHoras);

                form.addEventListener('submit', (e) => {
                    validarHoras();
                    if (!form.checkValidity()) e.preventDefault();
                });
            });
        </script>

        <script>
        document.addEventListener('change', function(e) {
        if (e.target.classList.contains('agregarOtro')) {
            if (e.target.checked) {
            const contenedor = document.getElementById('contenedor-selects');
            const cantidadActual = contenedor.querySelectorAll('.select-group').length;

            // Límite de 6
            if (cantidadActual >= 6) {
                alert('Solo puedes agregar hasta 6 selecciones.');
                e.target.checked = false;
                return;
            }

            // Eliminar el checkbox del bloque actual
            const labelCheckbox = e.target.closest('label');
            if (labelCheckbox) {
                labelCheckbox.remove();
            }

            // Crear nuevo bloque select + checkbox
            const nuevoSelect = document.createElement('div');
            nuevoSelect.classList.add('select-group');
            nuevoSelect.innerHTML = `
                <br>
                <label>Seleccione a un colaborador:</label>
                <select required name="opciones[]" id="miSelect-colaborador" >
                <option value="">-- Seleccione a un colaborador --</option>
                    @foreach ($expositores as $expo)
                            <option value="{{$expo->PK_Expositores}}" >{{$expo->Tnombre_expositor}}</option>
                    @endforeach
                </select>
                <label>
                <input type="checkbox" class="agregarOtro"> ¿Agregar otro?
                </label>
            `;
            
            contenedor.appendChild(nuevoSelect);
            }
        }
        });
    </script>


        <script>
            $(document).ready(function() {
                $('#miSelect-tipoCharla').select2({
                placeholder: "---Seleccioné una campaña---",
                allowClear: true
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('#miSelect-expositor').select2({
                placeholder: "---Seleccioné un ente colaborador---",
                allowClear: true
                });
            });
        </script>





    @endpush

</x-admin-layout>   