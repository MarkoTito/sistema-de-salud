<x-admin-layout>
    
    <div class="flex justify-center mt-4">
        <h1 class="font-extrabold text-gray-900" style="font-size: 2rem;">
            {{ $charla->Tnombre_charla }}
        </h1>
    </div>
    
    <br>
    <div class="flex justify-center mb-4 " >
        <img src="https://www.stellamaris.com.pe/uploads/shares/BLOG/CAMPA__A_DE_SALUD_-_RESP__SOCIAL.jpg" height="450px" width="640px" alt="imagen de la campaña">

    </div>
    <br>
    <div class="grid gap-6 mb-4 md:grid-cols-3 mb-4 ">
        
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Fecha:</label>    
            <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->DfechaIni_charla}}" disabled>                
        </div>
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Hora:</label>    
            <input type="time" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->Thora_charla}}" disabled>                
        </div>
        @if (!$charla->Ncantidad_charla)
            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad:</label>    
                <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="0" disabled>                
            </div>
        @else
            <div>
                <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Cantidad:</label>    
                <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->Ncantidad_charla}}" disabled>                
            </div>
            
        @endif
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Lugar:</label>    
            <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->Tlugar_charla}}" disabled>                
        </div>
        <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Lugar especifico:</label>    
            <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->TdescripcionLugar_charla}}" disabled>                
        </div>
        {{-- <div>
            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-black">Hora:</label>    
            <input type="text" id="disabled-input" aria-label="disabled input" class="mb-6 bg-gray-100 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 cursor-not-allowed dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{$charla->}}" disabled>                
        </div> --}}
    </div>


</x-admin-layout>