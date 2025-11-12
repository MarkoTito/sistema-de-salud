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
        'name'=> 'Editar Campaña',
    ]
    ]">

    <br>
    <form action="{{route('admin.Campañas.update',$campaña->PK_Campaña)}}" method="POST">
            @method('PUT')
            @csrf
            <input type="text" name="situacion" value="4"  hidden >
            <div class="flex justify-center mt-4" >
                <div>
                    <label for="campañas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Elige una Campaña</label>
                    <select name="newCampaña" id="miSelect-tipoCampaña" style="width: 200%;" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value=""selected disabled >---Seleccioné una campaña---</option>
                        @foreach ($Tiposcampañas as $campañaTipo)
                            <option value="{{$campañaTipo->PK_TiposCampañas}}" {{$campañaTipo->PK_TiposCampañas == $campaña->FK_Campaña_TipoId  ? 'selected' : ''}}  >{{$campañaTipo->Tnombre_Tipocampaña}}</option>
                        @endforeach
                    </select>
                    
                </div>
            </div>
            <div class="grid gap-6 mb-4 md:grid-cols-2 mt-4 ">
                
                <div>
                    @if (!$imagen || empty($imagen->Tpath_imagenes))
                        <img src="https://www.stellamaris.com.pe/uploads/shares/BLOG/CAMPA__A_DE_SALUD_-_RESP__SOCIAL.jpg" height="450px" width="640px" alt="imagen de la campaña">
                    @else
                        <div class="mb-4">
                            <img src="{{ asset('storage/'.$imagen->Tpath_imagenes) }}" height="450px" width="640px" alt="imagen de la campaña">
                        </div>
                    @endif
                </div>
                <div class="grid gap-6 mb-4 md:grid-cols-2">
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Lugar:</label>    
                        <input type="text" name="newLugar" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$campaña->Tlugar_campaña}}" >                
                    </div>
                    <div>
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Fecha de Inicio:</label>    
                        <input type="date" name="newFecha"  class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$campaña->DfechaIni_campaña}}" >                
                    </div>
                    <div  >
                        <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Hora:</label>    
                        <input type="time" name="newHora" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$campaña->ThoraIni_campaña}}" >                
                    </div>
                </div>
        
            </div>
            <div class="flex justify-center mt-4" >
                <button type="submit"  class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    Editar
                </button>
            </div>
    </form>
    




    @push('js')
        
        
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
            $(document).ready(function() {
                $('#miSelect-colaborador').select2({
                placeholder: "---Seleccioné un ente colaborador---",
                allowClear: true
                });
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
    @endpush





</x-admin-layout>