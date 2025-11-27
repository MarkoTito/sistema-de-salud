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
        'name'=> 'Agregar Campaña',
    ]
    ]">
    
 {{-- no olvidar hacer el pan --}}

    <form action="{{route('admin.Campañas.store')}}" method="POST"  >
        @csrf
        <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
            <div>
                <label for="campañas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Elige una Campaña</label>
                <select required name="Campañas" id="miSelect-tipoCampaña"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value=""selected disabled >---Seleccioné una campaña---</option>
                    @foreach ($Tiposcampañas as $campaña)
                        @if ($campaña->Nestado_Tipocampaña == 0)
                            
                        @else
                            <option value="{{$campaña->PK_TiposCampañas}}" >{{$campaña->Tnombre_Tipocampaña}}</option>
                        @endif
                    @endforeach
                </select>

            </div>
            <div>
                <div>
                {{-- Lugar de campaña --}}
                <label for="Tlugar_campaña" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Lugar:</label>
                <input name="Tlugar_campaña" type="text" id="Tlugar_campaña" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" maxlength="30"  required  placeholder="Ingrese el lugar" required value="{{old('Tlugar_campaña')}}"/>
                @error('Tlugar_campaña')
                        <p class="text-red-600">*{{$message}}</p>
                @enderror
            </div>
            </div>
        </div>

        <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
            <div>
                {{-- Fecha de Inicio --}}
                <label for="DfechaIni_campaña" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Fecha de Inicio:</label>
                <input name="DfechaIni_campaña" type="date" id="DfechaIni_campaña"  required value="{{old('DfechaIni_campaña')}}" min="{{ date('Y-m-d') }}">
                @error('DfechaIni_campaña')
                        <p class="text-red-600">*{{$message}}</p>
                @enderror
            </div>
            <div>
                {{-- Hora de Inicio  --}}
                <label for="hora_inicio" class="block text-sm font-medium text-gray-700">Hora de inicio:</label>
                <input 
                    required
                    type="time" 
                    id="hora_inicio" 
                    name="hora_inicio" 
                    class="mt-1 block w-40 border border-gray-300 rounded-lg p-2 text-gray-700"
                >
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
                $('#miSelect-tipoCampaña').select2({
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