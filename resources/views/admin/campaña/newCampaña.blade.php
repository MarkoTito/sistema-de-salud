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
                <input name="Tlugar_campaña" type="text" id="Tlugar_campaña" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" maxlength="150"  required  placeholder="Ingrese el lugar" required value="{{old('Tlugar_campaña')}}"/>
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
        <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
            <div class="mb-4">
                <label>Seleccione a a los colaboradores:</label>
                <select id="selectColaboradores" class="w-full border rounded px-3 py-2">
                    <option value="" disabled selected>Seleccione a un colaborador</option>
                    @foreach ($Colaboradores as $colaborador)
                            <option value="{{$colaborador->PK_Colaborador}}" >{{$colaborador->Tnombre_colaborador}}</option>
                    @endforeach
                </select>
                <!-- Contenedor de chips -->
                <div id="contenedorTags" class="flex flex-wrap gap-2 mt-3"></div>
    
                <!-- hidden para enviar al backend -->
                <input type="hidden" name="colaborador" id="categoriasHidden">
            </div>

            <div class="mb-4">
                <label>Seleccione las especialidades:</label>
                <select id="selectCategorias2" class="w-full border rounded px-3 py-2">
                    <option value="" disabled selected>Seleccione una especialidad</option>
                    @foreach ($especialidadades as $espe)
                        @if ($espe->Nestado_especialidad == 0)
                        @else
                            <option value="{{$espe->PK_Especialidades}}" >{{$espe->Tdescripcion_especialidad}}</option>
                        @endif
                    @endforeach
                </select>
                <!-- Contenedor de chips -->
                <div id="contenedorTags2" class="flex flex-wrap gap-2 mt-3"></div>
    
                <!-- hidden para enviar al backend -->
                <input type="hidden" name="especialidad" id="categoriasHidden2">
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
            document.addEventListener("DOMContentLoaded", function () {
                const select = document.getElementById("selectColaboradores");
                const contenedor = document.getElementById("contenedorTags");
                const hidden = document.getElementById("categoriasHidden");

                select.addEventListener("change", function () {
                    const id = this.value;                     // PK del colaborador
                    const texto = this.options[this.selectedIndex].text; // Nombre del colaborador

                    // Evitar duplicados (revisando IDs)
                    const actuales = hidden.value ? hidden.value.split(",") : [];
                    if (actuales.includes(id)) return;

                    // Crear chip
                    const chip = document.createElement("span");
                    chip.className = "bg-teal-600 text-white px-3 py-1 rounded-full text-sm flex items-center gap-2";

                    chip.innerHTML = `
                        ${texto}
                        <button type="button" class="text-white font-bold">&times;</button>
                    `;

                    // Al eliminar
                    chip.querySelector("button").addEventListener("click", () => {
                        chip.remove();
                        actualizarHidden();
                    });

                    contenedor.appendChild(chip);
                    actualizarHidden();
                });

                function actualizarHidden() {
                    const chipsIDs = [];

                    // Para cada chip, busco su texto y lo convierto al ID otra vez
                    const opciones = Array.from(select.options);

                    contenedor.querySelectorAll("span").forEach(chip => {
                        const textoChip = chip.childNodes[0].textContent.trim();
                        const opcion = opciones.find(op => op.text === textoChip);
                        if (opcion) chipsIDs.push(opcion.value);
                    });

                    hidden.value = chipsIDs.join(",");
                }
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const select = document.getElementById("selectCategorias2");
                const contenedor = document.getElementById("contenedorTags2");
                const hidden = document.getElementById("categoriasHidden2");

                select.addEventListener("change", function () {
                    const id = this.value;                     // PK del colaborador
                    const texto = this.options[this.selectedIndex].text; // Nombre del colaborador

                    // Evitar duplicados (revisando IDs)
                    const actuales = hidden.value ? hidden.value.split(",") : [];
                    if (actuales.includes(id)) return;

                    // Crear chip
                    const chip = document.createElement("span");
                    chip.className = "bg-teal-600 text-white px-3 py-1 rounded-full text-sm flex items-center gap-2";

                    chip.innerHTML = `
                        ${texto}
                        <button type="button" class="text-white font-bold">&times;</button>
                    `;

                    // Al eliminar
                    chip.querySelector("button").addEventListener("click", () => {
                        chip.remove();
                        actualizarHidden();
                    });

                    contenedor.appendChild(chip);
                    actualizarHidden();
                });

                function actualizarHidden() {
                    const chipsIDs = [];

                    // Para cada chip, busco su texto y lo convierto al ID otra vez
                    const opciones = Array.from(select.options);

                    contenedor.querySelectorAll("span").forEach(chip => {
                        const textoChip = chip.childNodes[0].textContent.trim();
                        const opcion = opciones.find(op => op.text === textoChip);
                        if (opcion) chipsIDs.push(opcion.value);
                    });

                    hidden.value = chipsIDs.join(",");
                }
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