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
        <div class="flex justify-center items-center space-x-4">
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
                        <option value="{{$tipo->PK_TiposCharla}}">{{$tipo->Tnombre_charla}}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="DfechaIni_charla" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                    Fecha de Inicio:
                </label>
                <input name="DfechaIni_charla" type="date" id="DfechaIni_charla" required 
                    value="{{old('DfechaIni_charla')}}" min="{{ date('Y-m-d') }}"
                    class="border border-gray-300 rounded-lg p-2.5 w-64">
                @error('DfechaIni_charla')
                    <p class="text-red-600">*{{$message}}</p>
                @enderror
            </div>
        </div>


        <div class="grid gap-6 mb-4 md:grid-cols-3 mt-4">
            <div>
                {{-- Lugar de charla --}}
                <label for="Tlugar_charla" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Lugar:</label>
                <input name="Tlugar_charla" type="text" id="Tlugar_charla" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" maxlength="30"  required  placeholder="Ingrese el lugar" required value="{{old('Tlugar_charla')}}"/>
                @error('Tlugar_charla')
                        <p class="text-red-600">*{{$message}}</p>
                @enderror
            </div>
            <div>
                {{-- descipcion del lugar --}}
                <label for="TdescripcionLugar_charla" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Descripcion exacta del Lugar:</label>
                <input name="TdescripcionLugar_charla" type="text" id="TdescripcionLugar_charla" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" maxlength="30"  required  placeholder="Ingrese el lugar" required value="{{old('TdescripcionLugar_charla')}}"/>
                @error('TdescripcionLugar_charla')
                        <p class="text-red-600">*{{$message}}</p>
                @enderror
            </div>
            <div>
                <label for="time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Hora:</label>    
                <input type="time" name="hora" id="input"  class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required  >                
            </div>
         
        
            
            
            
        </div>
        <br>
        <div class="flex justify-center mb-4">
            <div id="contenedor-selects">
                <div class="select-group">
                    <label>Seleccione a un colaborador:</label>
                    <select required name="opciones[]" id="miSelect-colaborador" >
                    <option value="">-- Seleccione --</option>
                    @foreach ($Colaboradores as $colaborador)
                            <option value="{{$colaborador->PK_Colaborador}}" >{{$colaborador->Tnombre_colaborador}}</option>
                    @endforeach
                    </select>
                    <label>
                    <input type="checkbox" class="agregarOtro"> ¿Agregar otro colaborador?
                    </label>
                </div>
            </div>

        </div>

        <br>
        <div class="flex justify-center mb-4" >
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Registrar Campaña
            </button>
        </div>


    </form>
    



    @push('js')
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
                    @foreach ($Colaboradores as $colaborador)
                        <option value="{{$colaborador->PK_Colaborador}}" >{{$colaborador->Tnombre_colaborador}}</option>
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
                $('#miSelect-colaborador').select2({
                placeholder: "---Seleccioné un ente colaborador---",
                allowClear: true
                });
            });
        </script>





    @endpush

</x-admin-layout>   