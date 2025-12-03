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
        'name'=> 'Editar Charla',
    ]
    ]">
    <form action="{{route('admin.Charlas.update',$charla->PK_Charlas)}}" method="POST">
        @method('PUT')
        @csrf
        <div class="flex justify-center mt-4">
            <select name="newtipo" id="miSelect-tipoCharla" style="width: 200%;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option  value=""selected  >---Seleccioné una charla---</option>
                @foreach ($Tiposcharlas as $charlas)
                    <option value="{{$charlas->PK_TiposCharla}}" {{$charlas->PK_TiposCharla == $charla->PK_TiposCharla  ? 'selected' : ''}}  >{{$charlas->Tnombre_charla}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <div class="flex justify-center mb-4 " >
            <img src="https://www.stellamaris.com.pe/uploads/shares/BLOG/CAMPA__A_DE_SALUD_-_RESP__SOCIAL.jpg" height="450px" width="640px" alt="imagen de la campaña">
        </div>
        <br>
        <div class="grid gap-6 mb-4 md:grid-cols-3 mb-4 ">
            
            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Fecha:</label>    
                <input type="date" name="fecha" id="-input" aria-label=" input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->DfechaIni_charla}}" >                
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                    Hora de inicio:
                </label>    
                <input type="time" name="hora" id="horaIni" required
                    value="{{ $charla->ThoraIni_charla }}"
                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                    dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">
                    Hora de fin:
                </label>    
                <input type="time" name="horafIN" id="horaFin" required
                    value="{{ $charla->ThoraFin_charla }}"
                    class="bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg 
                    focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5
                    dark:bg-gray-700 dark:border-gray-600 dark:text-white">

                <p id="errorHora" class="text-red-600 text-sm mt-1 hidden">
                    * La hora de fin debe ser mayor que la hora de inicio.
                </p>
            </div>



            @if ($charla->PK_TiposCharla ==1 )
                <div class="grid gap-6 mb-4 md:grid-cols-3 mb-4 ">
                    @if (!$charla->Ncantidad_felinos)
                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad de Gatos beneficiados:</label>    
                            <input maxlength="5"  style="width: 100%" name="canti_gato"   type="text" id="-input" aria-label=" input" class=" flex justify-centers mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="0" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />               
                        </div>
                        
                    @else
                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad de Gatos beneficiados:</label>    
                            <input maxlength="5" type="text" name="canti_gato" id="-input" aria-label=" input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->Ncantidad_felinos}}" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />              
                        </div>
                    @endif

                    @if (!$charla->Ncantidad_caninos)
                        <div  >
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad de Perros beneficiados:</label>    
                            <input maxlength="5" style="width: 100%" name="canti_perro" type="text" id="-input" aria-label=" input" class=" flex justify-centers mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="0" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />              
                        </div>
                        
                    @else
                        <div>
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad de Perros beneficiados:</label>    
                            <input maxlength="5" type="text" id="-input" name="canti_perro" aria-label=" input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->Ncantidad_caninos}}" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />                
                        </div>
                        
                    @endif

                </div>

            @else   
                @if (!$charla->Ncantidad_charla )
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad:</label>    
                        <input maxlength="5" type="text" name="canti"  id="-input" aria-label=" input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="0" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />               
                    </div>
                    
                @else
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad:</label>    
                        <input maxlength="5" type="text" name="canti" id="-input" aria-label=" input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->Ncantidad_charla}}" required oninput="this.value = this.value.replace(/[^0-9]/g, '');" />               
                    </div>
                    
                @endif

            @endif



            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Lugar:</label>    
                <input name="lugar" type="text" id="-input" aria-label=" input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->Tlugar_charla}}" >                
            </div>
            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Lugar especifico:</label>    
                <input name="lugarEspe" type="text" id="-input" aria-label=" input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->TdescripcionLugar_charla}}" >                
            </div>
        </div>
        
        @can('update-charlas')
            <div class="flex justify-center mt-4" >
                <button type="submit"  class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    Editar
                </button>
            </div>
            
        @endcan

    </form>


    @push('js')
        <script>
            $(document).ready(function() {
                $('#miSelect-tipoCharla').select2({
                placeholder: "---Seleccioné una campaña---",
                allowClear: true
                });
            });
        </script>
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
                        horaFin.setCustomValidity('La hora de fin debe ser mayor que la hora de inicio.');
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
        
    @endpush

</x-admin-layout>


