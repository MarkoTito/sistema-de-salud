<x-admin-layout>
    
 no olvidar hacer el pan

    <form action="{{route('admin.Campañas.store')}}" method="POST"  >
        @csrf
        <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4">
            <div>
                <label for="campañas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Elige una Campaña</label>
                <select name="Campañas" id="miSelect-tipoCampaña"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value=""selected disabled >---Seleccioné una campaña---</option>
                    @foreach ($Tiposcampañas as $campaña)
                        <option value="{{$campaña->PK_TiposCampañas}}" >{{$campaña->Tnombre_Tipocampaña}}</option>
                    @endforeach
                </select>

            </div>
            <div>
                <div>
                {{-- Lugar de campaña --}}
                <label for="Tlugar_campaña" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Lugar:</label>
                <input name="Tlugar_campaña" type="text" id="Tlugar_campaña" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" maxlength="30"  required  placeholder="Ingrese el Host" required value="{{old('Tlugar_campaña')}}"/>
                @error('Tlugar_campaña')
                        <p class="text-red-600">*{{$message}}</p>
                @enderror
            </div>
            </div>
        </div>

        <div class="grid gap-6 mb-4 md:grid-cols-3 mt-4">
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
            <div>
                <label for="colaborador" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Elige un ente colaborativo</label>
                <select required name="colaborador" id="miSelect-colaborador"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value=""selected disabled >---Seleccioné un colaborador---</option>
                    @foreach ($Colaboradores as $colaborador)
                        <option value="{{$colaborador->PK_Colaborador}}" >{{$colaborador->Tnombre_colaborador}}</option>
                    @endforeach
                </select>

            </div>
        </div>
        
        {{-- <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Subir imagen:</label>
            <input type="file" name="imagen" accept="image/*"
                class="block w-full text-sm text-gray-200 
                    file:mr-4 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-600 file:text-white
                    hover:file:bg-blue-700
                    cursor-pointer"
            />
        </div> --}}





        <div class="flex justify-center mt-4" >
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Registrar Campaña
            </button>
        </div>


    </form>
    










    @push('js')
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